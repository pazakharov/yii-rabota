<?php

namespace app\models\common;

use Yii;

/**
 * This is the model class for table "zanaytost".
 *
 * @property int $id
 * @property string|null $name
 *
 * @property Resumezanyatost[] $resumezanyatosts
 */
class Zanaytost extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'zanaytost';
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
     * Gets query for [[Resumezanyatosts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getResumezanyatosts()
    {
        return $this->hasMany(Resumezanyatost::className(), ['zanyatost_id' => 'id']);
    }
}
