<?php


?>

<!---Карточка товара-->
<div id="basket">
    <h1 class="title size-1">Оформление заказа</h1>
    <?php if(!empty($goodsBasket) && isset($goodsBasket)):?>
    <!--Список товара-->
    <div class="good-basket">
        <?php foreach($goodsBasket as $id => $item):  ?>
        <div class="item i-<?= $id?>">
            <button type="button"  onclick="return deleteBasket('<?= $id?>');" class="close" aria-hidden="true" title="Удалить с корзины">&times;</button>
            <div class="row">
                <div class="image col-xs-2"><img src="/files/goods/big1.jpg"></div>
                <div class="block col-xs-10">
                    <div class="title"><?=$item['name']?></div>
                    <div class="min-title">women</div>
                    <div class="price"><?=$item['price']?> р.</div>
                    <div class="art">Количество: <b><?=$item['count']?></b></div>
                </div>
                <div class="clear"></div>
            </div>
        </div>
        <?php endforeach; ?>
    </div> <!--Список товара-->
    <div class="row">
        <!--Офрмить заказ-->
        <div class="order-form col-sm-7">
            <?=\app\components\basket\WBasketOrderForm::widget(['model'=>$model])?>
        </div><!--/Офрмить заказ-->
        <div class="total col-sm-5">
            <table class="table">
                <tr>
                    <td>Стоимость</td>
                    <td><b>13 516 руб.</b></td>
                </tr>
                <tr>
                    <td>Доставка</td>
                    <td>бесплатно</td>
                </tr>
                <tr>
                    <td>ИТОГО</td>
                    <td><b>13 516 руб.</b></td>
                </tr>
            </table>
            <div class="button_vinous"><div>Оформить</div></div>
        </div>
    </div>
    <?php else:?>
       <div class="text">Корзина пуста!</div>
    <?php endif; ?>
</div>
<!--Карточка товара-->
