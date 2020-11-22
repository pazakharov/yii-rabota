<?php

namespace app\models\common;

use Yii;

/**
 * This is the model class for table "resumezanyatost".
 *
 * @property int $id
 * @property int $resume_id
 * @property int $zanyatost_id
 *
 * @property Resume $resume
 * @property Zanaytost $zanyatost
 */
class Resumezanyatost extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'resumezanyatost';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['resume_id', 'zanyatost_id'], 'required'],
            [['resume_id', 'zanyatost_id'], 'integer'],
            [['resume_id'], 'exist', 'skipOnError' => true, 'targetClass' => Resume::className(), 'targetAttribute' => ['resume_id' => 'id']],
            [['zanyatost_id'], 'exist', 'skipOnError' => true, 'targetClass' => Zanaytost::className(), 'targetAttribute' => ['zanyatost_id' => 'id']],
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
            'zanyatost_id' => 'Zanyatost ID',
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
     * Gets query for [[Zanyatost]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getZanyatost()
    {
        return $this->hasOne(Zanaytost::className(), ['id' => 'zanyatost_id']);
    }
}
