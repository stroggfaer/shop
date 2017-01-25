<?php
namespace app\controllers;
use app\modules\index\controllers\AppController;
use app\modules\catalog\models\Goods;
use app\modules\basket\models\Basket;
use app\modules\basket\models\Address;
use Yii;



class AjaxBasketController extends AppController
{

    // Добавить товар в корзину /ajax-basket/add-basket;
    public function actionAddBasket()
    {
        // Параметры пост данные;
        $request = Yii::$app->request;
        if ($request->post('addBasket')) {
            $id = $request->post('id');
            // Загруэка данные в сессия;
            $good = Goods::findOne($id);
            if (empty($good)) return false;
            $session = Yii::$app->session;
            $session->open();
            $addToBasket = new Basket();
            // Проверяем на количество пустоту и null;
            $counts = (isset($session['basket'][$good->id]['count']) && !empty($session['basket'][$good->id]['count']) ? $session['basket'][$good->id]['count'] : 0);
            if ($good->count_max > $counts) {
                $addToBasket->addToBasket($good);
            }
            // Ответ данные JSON-формат;
            // $response = Yii::$app->response;
            //$response->format = \yii\web\Response::FORMAT_JSON;
            // return $response->data = ['id' => $id,'countsBasket'=>$session['basket.count'],'basketMoney'=>$session['basket.money']];
            return \app\components\basket\WBasketModalGoods::widget([
                'basket' => $session['basket'],
                'counts' => $session['basket.count'],
                'money' => $session['basket.money'],
            ]);
        }
    }
    // Удалить товар с корзины;
    public function actionDeleteBasket()
    {
        // Параметры пост данные;
        $request = Yii::$app->request;
        if ($request->post('deleteBasket')) {
            $id = $request->post('id');
            $modal = $request->post('modal');
            $session = Yii::$app->session;
            $session->open();
            $deleteToBasket = new Basket();
            $deleteToBasket->deleteBasket($id);
            // Загрузка данные;
            if(isset($modal)) {
                return \app\components\basket\WBasketModalGoods::widget([
                    'basket' => $session['basket'],
                    'counts' => $session['basket.count'],
                    'money' => $session['basket.money'],
                ]);
            }else{
                //

            }
        }
        // Очистить корзины;
        if ($request->post('clearBasket')) {
            $session = Yii::$app->session;
            $session->remove('basket');
            $session->remove('basket.count');
            $session->remove('basket.money');
            return \app\components\basket\WBasketModalGoods::widget([
                'basket' => $session['basket'],
            ]);
        }

    }

    // Пересчет суммы корзины;
    public function actionResultMoney()
    {
        $request = Yii::$app->request;
        if ($request->post('delivery_id')) {
            $model = Address::getResultMoney(false,intval($request->post('delivery_id')));
            return \app\components\basket\WBasketResult::widget(['model'=>$model]);
        }

    }
    // Обновления формы;
    public function actionOrderForm()
    {
        $request = Yii::$app->request;
        if ($request->post('_form')) {
            return \app\components\basket\WBasketOrderForm::widget();
        }
    }
}