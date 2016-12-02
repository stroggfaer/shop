<?php

namespace app\modules\basket\models;
use app\modules\basket\models\OrderGoods;
use app\modules\basket\models\OrderItem;
use Yii;
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
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderItems()
    {
        return $this->hasMany(OrderItem::className(), ['address_id' => 'id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDeliveryOne()
    {
        return $this->hasOne(Delivery::className(), ['id' => 'delivery_id']);
    }
    // Загрузка выбор доставка;
    public static function getDelivery()
    {
       return Delivery::find()->where(['status'=> 1])->asArray()->orderBy('id asc')->all();
    }

    // Оформить заказ;
    public static function getOrderItem($id)
    {
        $session = Yii::$app->session;
        $session->open();
        // Добавляем товар;
        foreach($session['basket'] as $good_id => $value) {
            $orderGoods = new OrderGoods();
            $orderGoods->address_id = $id;
            $orderGoods->goods_id = $good_id;
            $orderGoods->save();
        }
        $total_money = Address::getResultMoney($id);
        // Добавляем номер заказа;
        $orderItem = new OrderItem();
        $orderItem->address_id = $id;
        $orderItem->price = $total_money['total_money'];
        $orderItem->type = 1;
        $orderItem->date = date('Y-m-d H:i');
        $orderItem->status = 1;
        $orderItem->save(false);
        return $orderItem->id;
    }
    // Подсчет суммы доставки;
    public static function getResultMoney($address_id = false, $delivery_id = false)
    {
        $session = Yii::$app->session;
        $session->open();
        // Рассчет результат доставки;
        if(!empty($address_id) && empty($delivery_id)) {
            // Загрузка доставка;
            $delivery_price = Delivery::find()
                ->select(['address.id AS id', 'delivery.price','delivery.title'])
                ->leftJoin(Address::tableName(), 'delivery.id = address.delivery_id')
                ->where(['address.status' => 1, 'delivery.status' => 1, 'address.id' => $address_id])->asArray()->one();
        }
        // Рассчет результат доставки;
        if(empty($address_id) && !empty($delivery_id)) {
            $delivery_price = Delivery::find()->where(['status' => 1, 'id' => $delivery_id])->asArray()->one();
        }
        // Расчет цены;
        $delivery_price['total_money'] = (!empty($delivery_price) && isset($delivery_price) && $delivery_price['price'] > 0 ? $session['basket.money'] + $delivery_price['price'] : $session['basket.money']);
        $delivery_price['money'] =  $session['basket.money'];
        return  $delivery_price;
    }
}

