<?php

namespace app\models\common;

use Yii;

/**
 * This is the model class for table "schedule".
 *
 * @property int $id
 * @property string $name
 *
 * @property ResumeSchedule[] $resumeschedules
 */
class Schedule extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'schedule';
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
     * Gets query for [[ResumeSchedules]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getResumeSchedules()
    {
        return $this->hasMany(ResumeSchedule::className(), ['schedule_id' => 'id']);
    }
}
