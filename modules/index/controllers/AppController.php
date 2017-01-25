<?php

namespace app\modules\index\controllers;


use app\modules\index\models\Pages;
use app\modules\catalog\models\Category;
use  Yii;
use yii\web\Controller;
use yii\db\Connection;
/**
 * Default controller for the `AppController` module
 */

class AppController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public $layout = '@app/views/layouts/main';
    public $pagesMenu;
    public $categoryMain;
    // CEO;
    protected function setMeta($title = null, $keywords = null, $description = null){
        $this->view->title = $title;
        $this->view->registerMetaTag(['name' => 'keywords', 'content' => "$keywords"]);
        $this->view->registerMetaTag(['name' => 'description', 'content' => "$description"]);
    }

    public function init()
    {
        // Загрузка меню;
        $pagesMenu = Pages::getPages();



        parent::init();

    }
    public function actionIndex()
    {

        return $this->render('index');
    }
}
