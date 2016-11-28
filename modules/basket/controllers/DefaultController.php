<?php

namespace app\modules\basket\controllers;
use app\modules\basket\models\Address;
use app\modules\basket\models\Delivery;
use app\modules\basket\models\OrderGoods;
use yii\web\Controller;
use Yii;
/**
 * Default controller for the `basket` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $session = Yii::$app->session;
        // Оформить заказ;
          $model = new Address();
        if (Yii::$app->request->post('order') && !empty($session['basket'])) {
                if ($model->load(Yii::$app->request->post()) && $model->save(true)) {
                    // Добавляем товар;
                    foreach($session['basket'] as $id => $value) {
                        $orderGoods = new OrderGoods();
                        $orderGoods->address_id = $model->id;
                        $orderGoods->goods_id = $id;
                        $orderGoods->save();
                    }
                    // return 'Спасибо! Мы обязательно Вам перезвоним. '.$model->id;
                }
          }
        // Загрузка товаров;
        return $this->render('index',[
            'goodsBasket'=>$session['basket'],
            'model'=>$model,
        ]);
    }
}
