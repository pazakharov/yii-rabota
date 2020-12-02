<?php

namespace app\models;

use Yii;
use yii\db\Query;
use app\models\Experience;
use app\models\common\Schedule;
use app\models\common\Employments;
use yii\behaviors\TimestampBehavior;
use app\models\common\ResumeSchedule;
use app\models\common\ResumeEmployment;

/**
 * This is the model class for table "resume".
 *
 * @property int $id
 * @property int $author_id
 * @property string $first_name
 * @property string $middle_name
 * @property string $last_name
 * @property string $birthdate
 * @property string $sex
 * @property string $city
 * @property string $mail
 * @property string $phone
 * @property int $specialization_id
 * @property int $zp
 * @property string|null $about
 * @property file|null $foto
 *
 * @property Specializations $specialization
 * @property User $author
 */
class Resume extends \yii\db\ActiveRecord
{
    private $_schedule_buffer;
    private $_z_buffer;
    public $experience;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'resume';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ScheduleArray', 'ZArray', 'author_id', 'first_name', 'middle_name', 'last_name', 'birthdate', 'sex', 'city', 'mail', 'phone', 'specialization_id', 'zp'], 'required'],
            [['author_id', 'specialization_id', 'zp', 'created_at', 'updated_at'], 'integer'],
            [['birthdate'], 'safe'],
            [['ScheduleArray', 'ZArray', 'experience', 'experience_check'], 'safe'],
            [['about'], 'string'],
            [['first_name', 'middle_name', 'last_name', 'sex', 'city', 'mail', 'phone'], 'string', 'max' => 255],
            [['specialization_id'], 'exist', 'skipOnError' => true, 'targetClass' => Specializations::className(), 'targetAttribute' => ['specialization_id' => 'id']],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['author_id' => 'id']],
            [['foto'], 'string', 'max' => '255'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID резюме'),
            'author_id' => Yii::t('app', 'ID Автора резюме'),
            'first_name' => Yii::t('app', 'Имя'),
            'middle_name' => Yii::t('app', 'Отчество'),
            'last_name' => Yii::t('app', 'Фамилия'),
            'birthdate' => Yii::t('app', 'Др'),
            'sex' => Yii::t('app', 'Пол'),
            'city' => Yii::t('app', 'Город'),
            'mail' => Yii::t('app', 'Mail'),
            'phone' => Yii::t('app', 'Телефон'),
            'specialization_id' => Yii::t('app', 'ID Специализации'),
            'about' => Yii::t('app', 'Обо мне'),
            'foto' => Yii::t('app', 'Фото'),
            'ScheduleArray' => Yii::t('app', 'График'),
            'ZArray' => Yii::t('app', 'Занятость'),
            'zp' => Yii::t('app', 'Зарплата'),
            'experience' => Yii::t('app', 'Опыт работы'),
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * Gets query for [[Specialization]].
     *
     * @return \yii\db\ActiveQuery|\app\Query\models\SpecializationsQuery
     */
    public function getSpecialization()
    {
        return $this->hasOne(Specializations::className(), ['id' => 'specialization_id']);
    }

    /**
     * Gets query for [[Author]].
     *
     * @return \yii\db\ActiveQuery|\app\Query\models\UserQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(User::className(), ['id' => 'author_id']);
    }

    public function getAge()
    {
        $age = (int)(date('Y')) - (int)substr($this->birthdate, 0, 4);
        $age = $age . ' ' . $this->_decline($age, ['год', 'года', 'лет']);
        return $age;
    }

    /**
     * Возвращает правильную форму  ['год', 'года', 'лет']
     * 
     * @param integer $num
     * @param array $forms
     * 
     * @return string
     */
    private function _decline($num, $forms)
    {
        return $num % 10 == 1 && $num % 100 != 11 ? $forms[0] : ($num % 10 >= 2 && $num % 10 <= 4 && ($num % 100 < 10 || $num % 100 >= 20) ? $forms[1] : $forms[2]);
    }

    /**
     * Gets query for [[Schedules]].
     *
     * @return \yii\db\ActiveQuery|\app\Query\models\UserQuery
     */

    public function getResumeSchedule()
    {
        return $this->hasMany(ResumeSchedule::className(), ['resume_id' => 'id']);
    }
    /**
     * Gets query for [[Schedules]].
     *
     * @return \yii\db\ActiveQuery|\app\Query\models\UserQuery
     */

    public function getSchedules()
    {
        return $this->hasMany(Schedule::className(), ['id' => 'schedule_id'])->via('resumeSchedule');
    }

    /**
     * Gets query for [[ResumeEmployments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getResumeEmployments()
    {
        return $this->hasMany(ResumeEmployment::className(), ['resume_id' => 'id']);
    }

    /**
     * Gets query for [[Employment]].
     *
     * @return \yii\db\ActiveQuery|\app\Query\models\UserQuery
     */

    public function getEmployments()
    {
        return $this->hasMany(Employments::className(), ['id' => 'employment_id'])->via('resumeEmployments');
    }

    /**
     * @param array $array
     * 
     * @return void
     */
    public function setScheduleArray($array)
    {
        $this->_schedule_buffer = (array)$array;
    }

    /**
     * @return array
     */
    public function getScheduleArray()
    {
        if ($this->_schedule_buffer === null) {
            $this->_schedule_buffer =  $this->getSchedules()->select('id')->column();
        }

        return  $this->_schedule_buffer;
    }

    /**
     * @param array $array
     */
    public function setZArray($array)
    {
        $this->_z_buffer = (array)$array;
    }

    /**
     * @return array
     */
    public function getZArray()
    {
        if ($this->_z_buffer === null) {
            $this->_z_buffer =  $this->getEmployments()->select('id')->column();
        }
        return  $this->_z_buffer;
    }

    /**
     * Gets query for [[Experiences]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getExperiencs()
    {
        return  $this->hasMany(Experience::className(), ['resume_id' => 'id']);
    }

    /**
     * Gets query for [[Experiences]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function setExperience_check()
    {

        $this->experience = $this->experience_check;
    }

    /**
     * @return mixed
     */
    public function getExperience_check()
    {
        if ($this->getExperiencs()->count() > 0) {
            return 1;
        } else {
            return null;
        }
    }

    /**
     * @return string
     */
    public function getStag()
    {
        $stag = $this->getExperiencs()->select('FROM_DAYS( to_days(MAX(DATE2)) - to_days(Min(DATE1)))')->scalar();
        return str_replace(0, '', substr($stag, 0, 4)) . ' ' . $this->_decline(substr($stag, 2, 2), ['год', 'года', 'лет']);
    }

    /**
     * @param mixed $insert
     * 
     * @return [type]
     */
    public function beforeSave($insert)
    {
        $this->birthdate = \DateTime::createFromFormat('d.m.Y', $this->birthdate)->format('Y-m-d');

        return parent::beforeSave($insert);
    }

    /**
     * @return bool
     */
    public function beforeValidate()
    {
        if (!isset($this->author_id)) {
            $this->author_id = Yii::$app->user->id;
        }
        return parent::beforeValidate();
    }

    /**
     * @param mixed $insert
     * @param mixed $changedAttributes
     * 
     * @return [type]
     */

    /**
     * @param mixed $insert
     * @param mixed $changedAttributes
     * 
     * @return void
     */
    public function afterSave($insert, $changedAttributes)
    {
        $this->_updateSchedule();
        $this->_updateEmployment();
        $this->_updateExperience();
        return parent::afterSave($insert, $changedAttributes);
    }

    /**
     * @return void
     */
    public function afterValidate()
    {
        foreach ($this->getErrors() as $key => $value) {
            Yii::$app->session->addFlash('error', $value[0]);
        }
        return parent::afterValidate();
    }

    private function _updateExperience()
    {
        if (isset($this->experience)) {
            if (count($this->experience) > 0) {
                Experience::deleteAll('resume_id = ' . $this->id);
                foreach ($this->experience as $experience) {
                    $experience['resume_id'] = $this->id;
                    $experience['date1'] = $experience['year1'] . '-' . $experience['month1'] . '-01 00:00:00';
                    if (isset($experience['present_check'])) {
                        $experience['date2'] = '0000-00-01 00:00:00';
                    } else {
                        $experience['date2'] = $experience['year2'] . '-' . $experience['month2'] . '-01 00:00:00';
                    }
                    $Experience_model = new Experience();
                    $Experience_model->attributes = $experience;
                    $Experience_model->save();
                }
            }
        }
    }


    /** 
     * @return bool
     */
    private function _updateSchedule()
    {
        $this->unlinkAll('schedules', true);
        foreach ($this->_schedule_buffer as $key => $schedule_id) {
            $this->link('schedules', Schedule::findOne(['id' => $schedule_id]));
        }
    }

    /**
     * @return bool
     */
    private function _updateEmployment()
    {
        $this->unlinkAll('employments', true);
        foreach ($this->_z_buffer as $key => $z_id) {
            $this->link('employments', Employments::findOne(['id' => $z_id]));
        }
    }


    /**
     * Выдает возможные занятости
     *
     * @return array
     */
    public static function getAvailibleEmployments()
    {
        return Employments::find()
            ->select(['name', 'id'])
            ->indexBy('id')
            ->column();
    }

    /**
     * Выдает возможные Специализации
     *
     * @return void
     */
    public static function getAvailibleSpecializations()
    {
        return Specializations::find()
            ->select(['name', 'id'])
            ->indexBy('id')
            ->column();
    }

    /**
     * Выдает возможные Графики
     *
     * @return void
     */
    public static function getAvailibleSchedules()
    {
        return Schedule::find()
            ->select(['name', 'id'])
            ->indexBy('id')
            ->column();
    }

    /**
     * Последний опыт работы или ничего
     * @return mix
     */
    public function getLastexperience()
    {
        return $this->getExperiencs()->orderBy('id DESC')->limit(1)->one();
    }

    /**
     * Строка с наименованиями видов графиков для резюме
     * @return string
     */
    public function getSchedulesNamesStr()
    {
        $schedule_array = [];

        foreach ($this->schedules as $schedule) {
            $schedule_array[] = $schedule->name;
        }
        return implode(", ", $schedule_array);
    }

    /**
     * Строка с наименованиями видов занятостей для резюме
     * @return string
     */
    public function getEmploymentNamesStr()
    {
        $employment_array = [];
        foreach ($this->employments as $z) {
            $employment_array[] = $z->name;
        }
        return implode(", ", $employment_array);
    }

    /**
     * Список городов встречающихся в резюме
     * @return array 
     */
    public static function getAvalibleCitiesArray()
    {
        $query = new Query();
        $cities = $query->select('city')
            ->from('resume')
            ->GroupBy('city')
            ->createCommand()
            ->queryColumn();
        return array_combine(array_values($cities), array_values($cities));
    }

    public function transactionSave()
    {
        $transaction = Yii::$app->db->beginTransaction();
        try {
            $this->save();
            $transaction->commit();
        } catch (\Exception $e) {
            $transaction->rollBack();
            return false;
            Yii::$app->session->addFlash('error', 'Не удалось сохранить резюме');
        }
        return true;
    }
}
