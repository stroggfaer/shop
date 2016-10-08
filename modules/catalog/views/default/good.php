<?php
use yii\helpers\Html;
use yii\widgets\ListView;

?>
<!---Карточка товара-->
<div id="good">
    <h1 class="title size-1"><?=$model->name?></h1>
    <div class="row">
        <div class="col-md-5 block-1">
            <div class="image">
                <img src="/files/goods/big1.jpg" alt="" class="ad">
            </div>
            <!--Миниатюр-->
            <div class="images">
                <div class="items">
                    <div class="item open"><a href="#"><img src="/files/slides/slide1.jpg" alt="" class="ad"/></a></div>
                    <div class="item"><a href="#"><img src="/files/slides/slide1.jpg" alt="" class="ad"/></a></div>
                    <div class="item margin-right"><a href="#"><img src="/files/slides/slide1.jpg" alt="" class="ad"/></a></div>
                    <div class="item"><a href="#"><img src="/files/slides/slide1.jpg" alt="" class="ad"/></a></div>
                    <div class="item"><a href="#"><img src="/files/slides/slide1.jpg" alt="" class="ad"/></a></div>
                </div>
            </div>  <!--Миниатюр-->
        </div>
        <div class="col-md-7 block-2">
            <div class="price <?=($model->price_d > 0) ? 'disc':''?>"><?=$model->price?> р.</div>
            <?=($model->price_d > 0) ? '<span class="price-discount">'.$model->price_d.' р.</span>' : ''?>
            <div class="block">
                <div class="button_vinous"><div>Добавить в корзину</div></div>
                <span class="buy"><a href="#" class="dashed">Купить в одинь клик</a></span>
            </div>
            <div class="options">
                <div class="title">Характеристики</div>
                <div class="i size">
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard
                </div>
            </div>
            <div class="description">
                <h2>Описание</h2>
                <div class="text">
                    <?=!empty($model->text) ? $model->text : 'Нет Описание'?>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Карточка товара-->
<?php

?>