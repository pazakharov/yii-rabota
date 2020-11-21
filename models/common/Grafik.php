<?php

namespace app\models\common;

use Yii;

/**
 * This is the model class for table "grafik".
 *
 * @property int $id
 * @property string $name
 *
 * @property Resumegrafik[] $resumegrafiks
 */
class Grafik extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'grafik';
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
     * Gets query for [[Resumegrafiks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getResumegrafiks()
    {
        return $this->hasMany(Resumegrafik::className(), ['grafik_id' => 'id']);
    }
}
