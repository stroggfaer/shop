<?php

namespace app\modules\basket\models;

use Yii;

/**
 * This is the model class for table "order_goods".
 *
 * @property integer $id
 * @property integer $address_id
 * @property integer $goods_id
 * @property integer $status
 *
 * @property Address $address
 */
class OrderGoods extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_goods';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
           // [['id'], 'required'],
            [['address_id', 'goods_id', 'status'], 'integer']
            //[['address_id'], 'exist', 'skipOnError' => true, 'targetClass' => Address::className(), 'targetAttribute' => ['address_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'address_id' => 'Address ID',
            'goods_id' => 'Goods ID',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    /*
    public function getAddress()
    {
        return $this->hasOne(Address::className(), ['id' => 'address_id']);
    }*/
}
