<?php

namespace app\models;

use Yii;
use app\models\common\Grafik;
use app\models\common\Zanaytost;
use app\models\common\Resumegrafik;
use app\models\common\Resumezanyatost;
use app\models\Opyt;
use Symfony\Component\CssSelector\Node\FunctionNode;
use yii\behaviors\TimestampBehavior;

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
    private $_grafik_buffer;
    private $_z_buffer;
    public $opyt;

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
            [['GrafikArray', 'ZArray', 'author_id', 'first_name', 'middle_name', 'last_name', 'birthdate', 'sex', 'city', 'mail', 'phone', 'specialization_id', 'zp'], 'required'],
            [['author_id', 'specialization_id', 'zp', 'created_at', 'updated_at'], 'integer'],
            [['birthdate'], 'safe'],
            [['GrafikArray', 'ZArray', 'opyt', 'opyt_check'], 'safe'],
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
            'GrafikArray' => Yii::t('app', 'График'),
            'ZArray' => Yii::t('app', 'Занятость'),
            'zp' => Yii::t('app', 'Зарплата'),
            'opyt' => Yii::t('app', 'Опыт работы'),
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

    private function _decline($num, $forms)
    {
        return $num % 10 == 1 && $num % 100 != 11 ? $forms[0] : ($num % 10 >= 2 && $num % 10 <= 4 && ($num % 100 < 10 || $num % 100 >= 20) ? $forms[1] : $forms[2]);
    }

    /**
     * Gets query for [[Grafiks]].
     *
     * @return \yii\db\ActiveQuery|\app\Query\models\UserQuery
     */

    public function getResumegrafik()
    {
        return $this->hasMany(Resumegrafik::className(), ['resume_id' => 'id']);
    }
    /**
     * Gets query for [[Grafiks]].
     *
     * @return \yii\db\ActiveQuery|\app\Query\models\UserQuery
     */

    public function getGrafiks()
    {
        return $this->hasMany(Grafik::className(), ['id' => 'grafik_id'])->via('resumegrafik');
    }

    /**
     * Gets query for [[Resumezanyatosts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getResumezanyatosts()
    {
        return $this->hasMany(Resumezanyatost::className(), ['resume_id' => 'id']);
    }

    /**
     * Gets query for [[Zanyatost]].
     *
     * @return \yii\db\ActiveQuery|\app\Query\models\UserQuery
     */

    public function getZanyatosts()
    {
        return $this->hasMany(Zanaytost::className(), ['id' => 'zanyatost_id'])->via('resumezanyatosts');
    }



    /**
     * @param array $array
     * 
     * @return void
     */
    public function setGrafikArray($array)
    {
        $this->_grafik_buffer = (array)$array;
    }

    /**
     * @return array
     */
    public function getGrafikArray()
    {
        if ($this->_grafik_buffer === null) {
            $this->_grafik_buffer =  $this->getGrafiks()->select('id')->column();
        }

        return  $this->_grafik_buffer;
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
            $this->_z_buffer =  $this->getZanyatosts()->select('id')->column();
        }
        return  $this->_z_buffer;
    }


    /**
     * Gets query for [[Opyts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOpyts()
    {
        return  $this->hasMany(Opyt::className(), ['resume_id' => 'id']);
    }

    /**
     * Gets query for [[Opyts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function setOpyt_check()
    {

        $this->opyt = $this->opyt_check;
    }

    /**
     * @return mixed
     */
    public function getOpyt_check()
    {
        if ($this->getOpyts()->count() > 0) {
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
        $stag = $this->getOpyts()->select('FROM_DAYS( to_days(MAX(DATE2)) - to_days(Min(DATE1)))')->scalar();
        return str_replace(0, '', substr($stag, 0, 4)) . ' ' . $this->_decline(substr($stag, 2, 2), ['год', 'года', 'лет']);
    }

    /**
     * {@inheritdoc}
     * @return \app\Query\models\ResumeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\Query\models\ResumeQuery(get_called_class());
    }
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
        $this->_updateGrafik();
        $this->_updateZanyatost();
        $this->_updateOpyt();
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

    private function _updateOpyt()
    {
        if (isset($this->opyt)) {
            if (count($this->opyt) > 0) {
                Opyt::deleteAll('resume_id = ' . $this->id);
                foreach ($this->opyt as $opyt) {
                    $opyt['resume_id'] = $this->id;
                    $opyt['date1'] = $opyt['year1'] . '-' . $opyt['month1'] . '-01 00:00:00';
                    if (isset($opyt['present_check'])) {
                        $opyt['date2'] = '0000-00-01 00:00:00';
                    } else {
                        $opyt['date2'] = $opyt['year2'] . '-' . $opyt['month2'] . '-01 00:00:00';
                    }
                    $Opyt_model = new Opyt();
                    $Opyt_model->attributes = $opyt;
                    $Opyt_model->save();
                }
            }
        }
    }


    /** 
     * @return bool
     */
    private function _updateGrafik()
    {
        $this->unlinkAll('grafiks', true);
        foreach ($this->_grafik_buffer as $key => $grafik_id) {
            $this->link('grafiks', Grafik::findOne(['id' => $grafik_id]));
        }
    }

    /**
     * @return bool
     */
    private function _updateZanyatost()
    {
        $this->unlinkAll('zanyatosts', true);
        foreach ($this->_z_buffer as $key => $z_id) {
            $this->link('zanyatosts', Zanaytost::findOne(['id' => $z_id]));
        }
    }


    /**
     * Выдает возможные занятости
     *
     * @return array
     */
    public static function getAvailibleZanyatost()
    {
        return Zanaytost::find()
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
    public static function getAvailibleGrafiks()
    {
        return Grafik::find()
            ->select(['name', 'id'])
            ->indexBy('id')
            ->column();
    }

    public function getLastopyt()
    {
        return $this->getOpyts()->orderBy('id DESC')->limit(1)->one();
    }

    public function getGrafiksNamesStr()
    {
        $grafik_array = [];

        foreach ($this->grafiks as $grafik) {
            $grafik_array[] = $grafik->name;
        }
        return implode(", ", $grafik_array);
    }

    public function getZanyatostNamesStr()
    {
        $zanyatost_array = [];
        foreach ($this->zanyatosts as $z) {
            $zanyatost_array[] = $z->name;
        }
        return implode(", ", $zanyatost_array);
    }
}
