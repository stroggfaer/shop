<?php

namespace app\modules\basket\models;


/**
 * This is the model class for table "address".
 *
 * @property integer $id
 * @property integer $delivery_id
 * @property string $fio
 * @property string $phone
 * @property string $email
 * @property string $address
 * @property string $comments
 * @property string $data_titme
 * @property integer $status
 */
class Address extends \yii\db\ActiveRecord
{
   // public $phone;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'address';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['delivery_id', 'status'], 'integer'],
            [['fio','phone','email','address','comments'], 'string'],
            ['phone', 'filter', 'filter' => function ($value) {
                $phone = str_replace("_","",$value);
                $phone = str_replace(" ","",$value);
                $length = strlen($phone);
                if ($length != 12) $this->addError($phone, 'Неверный номер телефона');
                return $phone;
            }],
            [['data_titme'], 'safe'],
            ['fio', 'string', 'min' => 4, 'max' => 255],
            ['fio','required','message' => 'Введите Фио!'],
            ['phone', 'required', 'message' => 'Введите телефон!'],
            ['email', 'required', 'message' => 'Введите email!'],
            ['email', 'email','message'=>'Неправильный формат e-mail адреса! '],
            ['address', 'required', 'message' => 'Введите адресс!'],
            ['data_titme', 'default', 'value' => date('Y-m-d H:s')],
            ['delivery_id','default', 'value' => 1001],
            ['status', 'default', 'value' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'delivery_id' => 'Delivery ID',
            'fio' => 'Fio',
            'phone' => 'Phone',
            'email' => 'Email',
            'address' => 'Address',
            'comments' => 'Comments',
            'data_titme' => 'Data Titme',
            'status' => 'Status',
        ];
    }

    // Загрузка выбор доставка;
    public function getDelivery()
    {
       return Delivery::find()->where(['status'=> 1])->asArray()->orderBy('id asc')->all();
    }



    // Оформить заказ;
    /*
    public function save()
    {


    }*/
}

