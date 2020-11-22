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
            [['author_id', 'first_name', 'middle_name', 'last_name', 'birthdate', 'sex', 'city', 'mail', 'phone', 'specialization_id','zp'], 'required'],
            [['author_id', 'specialization_id','zp'], 'integer'],
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
            'zp' => Yii::t('app', 'Зарплата'),

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
    
    public function setGrafikArray($array)
    {
        $this->_grafik_buffer = (array)$array;
    }

    public function getGrafikArray()
    {
        if ($this->_grafik_buffer === null){
            $this->_grafik_buffer =  $this->getGrafiks()->select('id')->column();
        }

        return  $this->_grafik_buffer; 
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

   
    /**
     * @param mixed $insert
     * @param mixed $changedAttributes
     * 
     * @return [type]
     */
    public function afterSave($insert, $changedAttributes)
    {
        $this->_updateGrafik();

       return parent::afterSave($insert, $changedAttributes);
    }

    /**
     * @return bool
     */
    private function _updateGrafik()
    {
        $this->unlinkAll('grafiks', true);

        
        

        foreach( $this->_grafik_buffer as $key => $grafik_id )
        {
            
        $this->link('grafiks', Grafik::findOne(['id' => $grafik_id]));

        }


    }


}
