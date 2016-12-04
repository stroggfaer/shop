<?php

namespace app\modules\basket\controllers;
use app\modules\basket\models\Address;
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
        $session->open();
        // Оформить заказ;
        $model = new Address();
        if (Yii::$app->request->post('order') && !empty($session['basket'])) {
                 // Добавляем адрес;
                if ($model->load(Yii::$app->request->post()) && $model->save(true)) {
                     $order = $model->getOrderItem($model->id);
                     return $this->redirect(['/basket/order',Yii::$app->session->setFlash('orderId',$order)]);
                }
          }
        // Загрузка товаров;
        return $this->render('index',[
            'goodsBasket'=>$session['basket'],
            'model'=>$model,
        ]);
    }
    // Номер заказа;
    public function actionOrder()
    {
        // Номер заказа;
        if(Yii::$app->session->hasFlash('orderId')) {
            return $this->render('order',[
                'orderItem'=>  Yii::$app->session->getFlash('orderId'),
            ]);
        }else{
            $session = Yii::$app->session;
            $session->destroy('basket');
            return $this->redirect(['/basket/']);
        }
    }
}
