<?php

namespace app\modules\basket\models;

use Yii;

/**
 * This is the model class for table "delivery".
 *
 * @property integer $id
 * @property string $title
 * @property string $price
 * @property integer $status
 */
class Delivery extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'delivery';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['price'], 'number'],
            [['status'], 'integer'],
            [['title'], 'string', 'max' => 128],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'price' => 'Price',
            'status' => 'Status',
        ];
    }
}
