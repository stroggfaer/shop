<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\tinymce\TinyMce;
use kartik\date\DatePicker;
use kartik\widgets\FileInput;
use kartik\widgets\TouchSpin;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\modules\catalog\models\Goods */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="goods-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    <!--
    <?= $form->field($model, 'id')->textInput() ?>

    <?= $form->field($model, 'variation_id')->textInput() ?>

    <?= $form->field($model, 'image_id')->textInput() ?>
     -->
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'text')->widget(TinyMce::className(), [
        'options' => ['rows' => 6],
    ]) ?>
    <div class="row">
      <?= $form->field($model, 'price')->widget(TouchSpin::classname(),[
          'pluginOptions' => ['prefix' => '$'],
      ]) ?>

      <?= $form->field($model, 'price_d')->widget(TouchSpin::classname(),[
          'pluginOptions' => ['prefix' => '$'],
      ]) ?>
    </div>
    <?= $form->field($model, 'show_main')->checkbox(['disabled' => false,]); ?>

    <?= $form->field($model, 'count')->widget(TouchSpin::classname(),[
        'pluginOptions' => [
            'buttonup_class' => 'btn btn-primary',
            'buttondown_class' => 'btn btn-info',
            'buttonup_txt' => '<i class="glyphicon glyphicon-plus-sign"></i>',
            'buttondown_txt' => '<i class="glyphicon glyphicon-minus-sign"></i>'
        ]
    ]) ?>

    <?= $form->field($model, 'date')->widget(DatePicker::classname(), [
        //'options' => ['placeholder' => 'Enter birth date ...'],
        'value' => date('d-m-y'),
        'pluginOptions' => [
            'autoclose'=>true,
            'format' => 'd-M-yyyy'
        ]
    ]);?>

    <?= $form->field($model, 'count_max')->widget(TouchSpin::classname(),[
        'pluginOptions' => [
            'buttonup_class' => 'btn btn-primary',
            'buttondown_class' => 'btn btn-info',
            'buttonup_txt' => '<i class="glyphicon glyphicon-plus-sign"></i>',
            'buttondown_txt' => '<i class="glyphicon glyphicon-minus-sign"></i>'
        ]
    ]) ?>
    <?=

    $form->field($model_images, 'imageFiles[]')->widget(
        FileInput::classname(), [
            'options' => ['multiple' => true],
            'pluginOptions' => ['previewFileType' => 'any',
                'uploadUrl' => Url::to(['/admin/ajax-backend/file-upload']),
                'uploadExtraData' => [
                    'image_id' => 1001,
                    'cat_id' => 'Nature'
                ],
                'maxFileCount' => 6
            ],
        ]
    );
    ?>
    <?= $form->field($model, 'status')->checkbox(['disabled' => false,]); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
