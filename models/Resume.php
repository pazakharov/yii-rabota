<?php

namespace app\models;

use Yii;

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
            [['about'], 'string'],
            [['first_name', 'middle_name', 'last_name', 'sex', 'city', 'mail', 'phone'], 'string', 'max' => 255],
            [['specialization_id'], 'exist', 'skipOnError' => true, 'targetClass' => Specializations::className(), 'targetAttribute' => ['specialization_id' => 'id']],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['author_id' => 'id']],
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
     * {@inheritdoc}
     * @return \app\Query\models\ResumeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\Query\models\ResumeQuery(get_called_class());
    }
}
