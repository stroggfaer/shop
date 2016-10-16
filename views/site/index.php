<?php

/* @var $this yii\web\View */
use yii\db\ActiveDataProvider;
$this->title = 'My Yii Application';

?>

<!--main-->
<div id="main">
    <div class="slides">
        <div class="items">
            <div class="item"><a href="#"><img src="files/slides/slide1.jpg" alt="" /></a></div>
            <div class="item"><a href="#"><img src="files/slides/slide1.jpg" alt="" /></a></div>
            <div class="item"><a href="#"><img src="files/slides/slide1.jpg" alt="" /></a></div>
        </div>
    </div>
    <!--Модуль-->
    <div class="module">
        <h2><a href="#" class="black">Новинки</a><span class="line-br"></span></h2>
        <h3 class="min-title">новая коллекция весна-лето 2016</h3>

        <div class="row">
            <?php if(!empty($newGoods)): ?>
                <?php foreach($newGoods as $key=>$item): ?>
                    <div class="col-md-4 col-sm-4  goods">
                        <div class="item">
                            <div class="images"><a href="/catalog/good/<?=$item->id?>"><img src="files/goods/big1.jpg" alt=""> </a></div>
                            <div class="block">
                                <div class="title"><?=$item->name?><span class="min-title">women</span></div>
                                <div class="price"> <?=$item->price?> р. <?=($item->price_d > 0) ? '<span class="price-discount">'.$item->price_d.' р.</span>' : ''?></div>
                                <div class="button_green" onclick="addBasket('<?=$item->id?>',true);"><div>Купить</div></div>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <div class="clear"></div>
    </div> <!--/Модуль-->

</div>
<!--/main-->

