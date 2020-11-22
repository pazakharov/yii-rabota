<?php

namespace app\models;

use Yii;
use app\models\common\Grafik;
use app\models\common\Resumegrafik;
use Symfony\Component\Console\Helper\Dumper;

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
 * @property string|null $about
 * @property file|null $foto
 *
 * @property Specializations $specialization
 * @property User $author
 */
class Resume extends \yii\db\ActiveRecord
{
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
            [['author_id', 'first_name', 'middle_name', 'last_name', 'birthdate', 'sex', 'city', 'mail', 'phone', 'specialization_id'], 'required'],
            [['author_id', 'specialization_id'], 'integer'],
            [['birthdate'], 'safe'],
            [['GrafikArray'], 'safe'],
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
            'id' => Yii::t('app', 'ID'),
            'author_id' => Yii::t('app', 'Author ID'),
            'first_name' => Yii::t('app', 'First Name'),
            'middle_name' => Yii::t('app', 'Middle Name'),
            'last_name' => Yii::t('app', 'Last Name'),
            'birthdate' => Yii::t('app', 'Birthdate'),
            'sex' => Yii::t('app', 'Sex'),
            'city' => Yii::t('app', 'City'),
            'mail' => Yii::t('app', 'Mail'),
            'phone' => Yii::t('app', 'Phone'),
            'specialization_id' => Yii::t('app', 'Specialization ID'),
            'about' => Yii::t('app', 'About'),
            'foto' => Yii::t('app', 'Foto'),
            'GrafikArray' => Yii::t('app', 'График'),

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
    
    public function getGrafikArray()
    {
        return $this->Grafiks->select('id')->column();
    }

    /**
     * {@inheritdoc}
     * @return \app\Query\models\ResumeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\Query\models\ResumeQuery(get_called_class());
    }

    public function beforeSave($insert) {

        
        $this->birthdate = \DateTime::createFromFormat('d.m.Y',$this->birthdate)->format('Y-m-d');
        
              
        return parent::beforeSave($insert);
    }
    
    public function beforeValidate()
    {
        
        $this->author_id = Yii::$app->user->id;

        return parent::beforeValidate();
    }

}
