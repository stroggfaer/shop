<?php
/* @var $this \yii\web\View */
/* @var $content string */
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<?php


?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8" />
    <!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="<?= Yii::$app->charset ?>">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div id="br-shadow"></div>
<div class="container">
    <!--Header-->
    <div id="header">
        <div class="br-1"></div>
        <div class="br-2"></div>
        <div class="row">
            <div class="menu-bar">
                <a id="nav-toggle" href="#"><span></span></a>
            </div>
            <div class="col-xs-5  col-md-4" >
                <div class="logo"><img src="/images/logo.jpg" alt="" class="ad img-circle"> </div>
                <div class="title text-left">Руслан Zzzzzz</div>
            </div>
            <!--Меню-->
            <div class="col-md-5 col-xs-5 menu-content" >
             <?=\app\components\WMenu::widget()?>
            </div> <!--.Меню-->
            <!--Корзина-->
            <div class="col-md-3 col-xs-4 cart desktop" >
                <a href="/basket/" class="icon-cart">Моя корзина</a>
                <div class="good">Товар: <b>0</b> | Цена: <b>90 000 р.</b></div>
            </div> <!--.Корзина-->
            <!--Корзина моб. версия-->
            <div class="col-xs-2 cart mobile" >
                <a href="/" class="icon-cart">
                    <div class="count">5</div>
                    <div class="c">Корзина</div>
                </a>
            </div><!--Корзина моб. версия-->
        </div>
        <div class="clear"></div>
    </div> <!--/Header-->
    <!--Content-->
    <div id="center">
        <div class="row">
            <!--sidebar-->
            <div class="col-md-3 col-sm-12 sidebar">
                <div class="row">
                    <div class="col-sm-12 block">
                        <h2 class="title">Поиск по сайту</h2>
                        <form class="search" role="search">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Поиск">
                            </div>
                            <button type="submit" class="btn btn-default">Отправить</button>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 block">
                        <h2 class="title">Каталог</h2>
                        <div class="navbar">
                            <div class="nav">
                                <div class="item"><a href="#" class="open-down">Одежда</a></div>
                                <div class="item"><a href="#">Одежда</a></div>
                                <div class="item"><a href="#">Одежда</a></div>
                                <div class="item groups">
                                    <a href="#">Одежда <span class="open-down"></span></a>
                                    <div class="i"><a href="#">Телефон</a></div>
                                    <div class="i"><a href="#">Телефон</a></div>
                                    <div class="i groups">
                                        <a href="#">Часы <span class="open-down"></span></a>
                                        <div class="i"><a href="#">Телефон</a></div>
                                        <div class="i"><a href="#">Телефон</a></div>
                                        <div class="i groups">
                                            <a href="#">Часы <span class="open-down"></span></a>
                                            <div class="i"><a href="#">Часы</a></div>
                                            <div class="i"><a href="#">Часы</a></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="item"><a href="#">Одежда</a></div>
                                <div class="item"><a href="#">Одежда</a></div>
                                <div class="item"><a href="#">Одежда</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!--/sidebar-->
            <div class="col-lg-9 col-md-9 col-sm-12 content">
                <?= $content ?>
            </div>
            <div class="clear"></div>
        </div>
    </div>
    <!--footer-->
    <div id="footer">
        <div class="row">
            <div class="col-xs-6 bottom footer-menu">
                <p class="bottom-menu">
                    <a href="#" class="white">Главная</a>
                    <span>|</span>
                    <a href="#" class="white">Главная</a>
                    <span>|</span>
                    <a href="#" class="white">Главная</a>
                    <span>|</span>
                    <a href="#" class="white">Главная</a>
                    <span>|</span>
                    <a href="#" class="white">Главная</a>
                </p>
            </div>
            <div class="col-md-6 col-xs-12 bottom"><span class="copyright">© 2016 Руслан Zzzzzzzz. Сайт создан на RendWeb</span></div>
        </div>
        <div class="clear"></div>
    </div><!--/footer-->
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>