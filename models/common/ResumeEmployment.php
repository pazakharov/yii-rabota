<?php

namespace app\models\common;

use app\models\Resume;
use Yii;

/**
 * This is the model class for table "ResumeEmployment".
 *
 * @property int $id
 * @property int $resume_id
 * @property int $employment_id
 *
 * @property Resume $resume
 * @property Employment $employment
 */
class ResumeEmployment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'resume_employment_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['resume_id', 'employment_id'], 'required'],
            [['resume_id', 'employment_id'], 'integer'],
            [['resume_id'], 'exist', 'skipOnError' => true, 'targetClass' => Resume::className(), 'targetAttribute' => ['resume_id' => 'id']],
            [['employment_id'], 'exist', 'skipOnError' => true, 'targetClass' => Employments::className(), 'targetAttribute' => ['employment_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'resume_id' => 'Resume ID',
            'employment_id' => 'Employment ID',
        ];
    }

    /**
     * Gets query for [[Resume]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getResume()
    {
        return $this->hasOne(Resume::className(), ['id' => 'resume_id']);
    }

    /**
     * Gets query for [[Employment]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmployment()
    {
        return $this->hasOne(Employments::className(), ['id' => 'employment_id']);
    }
}
