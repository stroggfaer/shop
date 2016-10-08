<?php
namespace app\controllers;
use app\modules\index\controllers\AppController;
use app\modules\catalog\models\Goods;
use app\modules\basket\models\Basket;
use Yii;



class AjaxBasketController extends AppController
{

    // Добавить товар в корзину /ajax-basket/add-basket;
    public function actionAddBasket()
    {
        // Параметры пост данные;
        $request = Yii::$app->request;
        if($request->post('addBasket')) {
            $id = $request->post('id');
            // Загруэка данные в сессия;
            $good = Goods::findOne($id);
            if (empty($good)) return false;
            $session = Yii::$app->session;
            $session->open();
            $addToBasket = new Basket();
            // Проверяем на количество пустоту и null;
            $counts = (isset($session['basket'][$good->id]['count']) && !empty($session['basket'][$good->id]['count']) ? $session['basket'][$good->id]['count'] : 0);
            if($good->count_max > $counts) {
                $addToBasket->addToBasket($good);
            }
            // Ответ данные JSON-формат;
            $response = Yii::$app->response;
            $response->format = \yii\web\Response::FORMAT_JSON;
            return $response->data = ['id' => $id,'countsBasket'=>$session['basket.count'],'basketMoney'=>$session['basket.money']];
        }
    }

}