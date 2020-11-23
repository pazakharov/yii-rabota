<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "opyt".
 *
 * @property int $id
 * @property int $resume_id
 * @property string $date1
 * @property string $date2
 * @property string $organization
 * @property string $position
 * @property string|null $duties
 * @property int $year1
 * @property int $month1
 * @property int $year2
 * @property int $month2
 *
 * @property Resume $resume
 */
class Opyt extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'opyt';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['resume_id', 'date1', 'date2'], 'required'],
            [['resume_id', 'year1', 'month1', 'year2', 'month2'], 'integer'],
            [['date1', 'date2'], 'safe'],
            [['duties'], 'string'],
            [['organization', 'position'], 'string', 'max' => 255],
            [['resume_id'], 'exist', 'skipOnError' => true, 'targetClass' => Resume::className(), 'targetAttribute' => ['resume_id' => 'id']],
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
            'date1' => 'Date1',
            'date2' => 'Date2',
            'organization' => 'Organization',
            'position' => 'Position',
            'duties' => 'Duties',
            'year1' => 'Year1',
            'month1' => 'Month1',
            'year2' => 'Year2',
            'month2' => 'Month2',
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
}
