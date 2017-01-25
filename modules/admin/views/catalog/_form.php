<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\widgets\Breadcrumbs;
use app\modules\catalog\models\Category;

/* @var $this yii\web\View */
/* @var $model app\modules\catalog\models\Category */
/* @var $form yii\widgets\ActiveForm */
?>
<?= Breadcrumbs::widget(['links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [], ]);?>
<div class="category-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php $parent = Category::find()->orderBy('title ASC')->all();
          $items = ArrayHelper::map(array_merge($parent),'id','title');
          $params = ['prompt' => 'Выберите категорию'];
    ?>

    <?=$form->field($model, 'parent_id')->DropDownList($items, $params);  ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'seo_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'seo_keywords')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'seo_description')->textarea(['rows' => 3]) ?>

    <?= $form->field($model, 'status')->checkbox(['disabled' => false,]); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
