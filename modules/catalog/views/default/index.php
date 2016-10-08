<?php
use app\components\WGoodsItem;
use yii\helpers\Html;
use yii\widgets\ListView;
?>
<div id="goods-list">
    <!--Хлебная крошка-->
    <ol class="breadcrumb">
        <li><a href="#" class="gray" >Главная</a></li>
        <li><a href="#" class="gray" >Одежда</a></li>
        <li class="active">Куртка</li>
    </ol> <!--/Хлебная крошка-->
    <!--Сортировка-->
    <div class="sort-filter">
        <b>Сортировка:</b>
        <span class="grey">Название</span>
        <span class="grey">Дата добавления</span>
        <span class="grey"> Цена</span>
        <span class="grey">Популярность</span>
    </div><!--/Сортировка-->
    <!--Модуль-->
    <div class="module">
        <h2><a href="#" class="black"><?= $this->context->action->uniqueId ?></a><span class="line-br"></span></h2>

            <?= ListView::widget([
                'dataProvider' => $dataProvider,
                'options' => [
                    'tag' => 'div',
                    'id'=> 'goods-new',
                    'class' => 'row',
                ],
                'itemOptions' => ['class' => 'col-md-4 col-sm-4  goods'],
                'layout' => "
                           <div class='items'>{items}<div class='clear'></div> </div>\n{pager}
                           ",
                'itemView' => function ($model) {
                   // return Html::a(Html::encode($model->title), ['good', 'id' => $model->id]);
                    return WGoodsItem::widget([
                        'model' => $model,
                    ]);
                },
            ]) ?>

        <div class="clear"></div>
    </div> <!--/Модуль-->
</div>
