<?php

namespace app\modules\basket\controllers;
use app\modules\basket\models\Address;
use app\modules\basket\models\Delivery;
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
        if(Yii::$app->request->post('order')) {
            if ($model->load(Yii::$app->request->post()) and $model->save(true)) {
                //Yii::$app->session->setFlash('success','Спасибо! Мы обязательно Вам перезвоним.');
            }
        }
        // Загрузка товаров;
        return $this->render('index',[
            'goodsBasket'=>$session['basket'],
            'model'=>$model,
        ]);
    }
}
