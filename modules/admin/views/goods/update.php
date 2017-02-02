<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\catalog\models\Goods */

$this->title = 'Update Goods: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Goods', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="goods-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'model_images' => $model_images,
    ]) ?>

</div>
