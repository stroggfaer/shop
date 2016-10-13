<?php

namespace app\modules\basket\controllers;

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
        // Загрузка товаров;
        return $this->render('index',['goodsBasket'=>$session['basket']]);
    }
}
