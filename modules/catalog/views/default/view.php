<?php
use app\components\WGoodsItem;
use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\Breadcrumbs;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\catalog\models\GoodsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $category->title;
$this->params['breadcrumbs'][] = ['class' => 'gray', 'label' => 'Каталог', 'url' => ['/catalog/']];
$this->params['breadcrumbs'][] = $this->title;


?>
<div id="goods-list">
    <?= Breadcrumbs::widget(['options' => ['class' => 'breadcrumb'],'tag' => 'ol','homeLink' => ['label' => 'Главная','class' => 'gray', 'url' => '/'], 'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],]);?>
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
        <h2><a href="#" class="black"><?=$this->title;?></a><span class="line-br"></span></h2>
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
<?php




?>