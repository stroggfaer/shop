<?php

namespace app\modules\basket\models;

use Yii;

/**
 * This is the model class for table "order_item".
 *
 * @property integer $id
 * @property integer $address_id
 * @property integer $good_id
 * @property string $price
 * @property integer $type
 * @property string $date
 * @property integer $status
 */
class OrderItem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_item';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['address_id','type', 'status'], 'integer'],
            [['price'], 'number'],
            [['date'], 'safe'],
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
            'price' => 'Price',
            'type' => 'Type',
            'date' => 'Date',
            'status' => 'Status',
        ];
    }
}

