<?php

namespace app\models\common;

use Yii;

/**
 * This is the model class for table "employments".
 *
 * @property int $id
 * @property string|null $name
 *
 * @property ResumeEmployment[] $ResumeEmployments
 */
class Employments extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'employments';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    /**
     * Gets query for [[ResumeEmployments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getResumeEmployments()
    {
        return $this->hasMany(ResumeEmployment::className(), ['employment_id' => 'id']);
    }
}
