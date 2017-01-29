<?php

namespace app\modules\catalog\models;

use Yii;

/**
 * This is the model class for table "images".
 *
 * @property integer $id
 * @property string $hash
 * @property integer $type
 * @property integer $status
 *
 * @property Goods[] $goods
 */
class Images extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'images';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['hash'], 'required'],
            [['type', 'status'], 'integer'],
            [['hash','exp'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'hash' => 'Hash',
            'type' => 'Type',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGoods()
    {
        return $this->hasMany(Goods::className(), ['image_id' => 'id']);
    }
}
