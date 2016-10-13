<?php
/* @var $this \yii\web\View */
/* @var $content string */
use yii\helpers\Html;
;
use app\assets\AppAsset;

AppAsset::register($this);
$session = Yii::$app->session;
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
                <a href="/">
                  <div class="logo"><img src="/images/logo.jpg" alt="" class="ad img-circle"> </div>
                  <div class="title text-left">Руслан Zzzzzz</div>
                </a>
            </div>
            <!--Меню-->
            <div class="col-md-5 col-xs-5 menu-content" >
             <?=\app\components\WMenu::widget()?>
            </div> <!--.Меню-->
            <!--Корзина-->
            <div class="col-md-3 col-xs-4 cart desktop" >
                <a href="/basket/" class="icon-cart">Моя корзина</a>
                <div class="good">Товар: <b class="counts"><?=($session['basket.count'] > 0 ? $session['basket.count'] : 0)?></b> | Цена: <b class="money"><?= ($session['basket.money'] > 0 ? $session['basket.money'] : 0);?> р.</b></div>
            </div> <!--.Корзина-->
            <!--Корзина моб. версия-->
            <div class="col-xs-2 cart mobile" >
                <a href="/" class="icon-cart">
                    <div class="count counts"><?=$session['basket.count']?></div>
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
                        <?=\app\components\WCategory::widget()?>
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
<?php
\yii\bootstrap\Modal::begin([
    'header' => '<h2>Корзина</h2>',
    'id' => 'basket-modal',
    'size' => 'modal-lg',
    'footer' => '<button type="button" class="btn btn-default" data-dismiss="modal">Продолжить покупки</button>
        <a href="/basket/" class="btn btn-success no-border" style="color:#fff;">Оформить заказ</a>
        <button type="button" class="btn btn-danger" onclick="return deleteBasket();">Очистить корзину</button>'
]);

\yii\bootstrap\Modal::end();
?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>