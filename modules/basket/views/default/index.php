<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\widgets\Pjax;
use app\modules\index\models\MyHelper;

//print_arr($model->resultmoney);
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
                    <div class="price"><?=MyHelper::money($item['price'])?> р.</div>
                    <div class="art">Количество: <b><?=$item['count']?></b></div>
                </div>
                <div class="clear"></div>
            </div>
        </div>
        <?php endforeach; ?>
    </div> <!--Список товара-->
    <div class="row">
    <?php $form = ActiveForm::begin([
        'id'                     => 'order-form',
        'enableAjaxValidation'   => true,
        'enableClientValidation' => true,
        'validateOnBlur'         => false,
        'validateOnType'         => false,
        'validateOnChange'       => false,
        'validateOnSubmit'       => true,
    ]); ?>
        <!--Офрмить заказ-->
        <div class="order-form col-sm-7">
            <?=\app\components\basket\WBasketOrderForm::widget(['model'=>$model,'form'=>$form])?>
        </div><!--/Офрмить заказ-->
        <div class="total col-sm-5">
            <?php Pjax::begin(['id'=>'pjax-delivery_id', 'clientOptions' => ['method' => 'POST'], 'timeout' => false,'enablePushState'=>true]); ?>
                <?=\app\components\basket\WBasketResult::widget(['model'=>$model->getResultMoney(false,1001)])?>
            <?php Pjax::end(); ?>
            <?= Html::submitButton('Оформить', ['class' => 'btn button_vinous size-1', 'name' => 'order', 'value'=>'true']) ?>
        </div>
     <?php ActiveForm::end(); ?>
    </div>
    <?php else:?>
       <div class="text">Корзина пуста!</div>
    <?php endif; ?>
</div>
<!--Карточка товара-->
