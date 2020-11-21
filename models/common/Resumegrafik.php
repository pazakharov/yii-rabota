<?php

namespace app\models\common;

use Yii;

/**
 * This is the model class for table "resumegrafik".
 *
 * @property int $id
 * @property int $resume_id
 * @property int $grafik_id
 *
 * @property Grafik $grafik
 * @property Resume $resume
 */
class Resumegrafik extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'resumegrafik';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['resume_id', 'grafik_id'], 'required'],
            [['resume_id', 'grafik_id'], 'integer'],
            [['grafik_id'], 'exist', 'skipOnError' => true, 'targetClass' => Grafik::className(), 'targetAttribute' => ['grafik_id' => 'id']],
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
            'grafik_id' => 'Grafik ID',
        ];
    }

    /**
     * Gets query for [[Grafik]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGrafik()
    {
        return $this->hasOne(Grafik::className(), ['id' => 'grafik_id']);
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
