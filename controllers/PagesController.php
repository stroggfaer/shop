<?php

namespace app\controllers;
use app\modules\index\controllers\AppController;
use app\modules\index\models\Pages;

use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

class PagesController extends AppController
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['get'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }
    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionPage($p)
    {
        $pages = Pages::getPageRow($p);
        if(!empty($pages)){
            return $this->render($p, [ 'pages' => $pages,]);
        }else {
            $exception = Yii::$app->errorHandler->exception;
            return $this->render('/site/error',['exception' => $exception, 'name' => '404', 'message' => '404']);
        }
    }
}
