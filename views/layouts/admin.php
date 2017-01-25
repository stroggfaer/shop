<?php
/* @var $this \yii\web\View */
/* @var $content string */
use yii\helpers\Html;
use app\assets\AdminAsset;

AdminAsset::register($this);
$session = Yii::$app->session;

?>
<?php $this->beginPage() ?>

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
                            <h2 class="title">Навигация</h2>
                            <div id="menu">
                                <?php foreach(\Yii::$app->controller->actionNavigation as $key => $navigation): ?>
                                    <div class="item">
                                        <a class="nobor title" href="<?=$navigation['link'];?>"><?=$navigation['title'];?></a>
                                        <?php if(!empty($navigation['items'])): ?>
                                            <?php foreach($navigation['items'] as $k => $nav): ?>
                                                <div class="i"><a href="<?=$nav['link']?>" class="nobor"><?=$nav['title']?></a></div>
                                            <?php endforeach;?>
                                        <?php endif; ?>
                                    </div>
                                <?php endforeach; ?>
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