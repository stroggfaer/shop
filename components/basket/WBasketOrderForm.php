<?php

namespace app\components\basket;
use yii\base\Widget;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;




class WBasketOrderForm extends Widget
{

    public $model;


    public function init() {

        if ($this->model === null) {
            $this->model = false;
        }
        parent::init();
    }
    public function run(){

        ?>
        <div class="panel panel-default">
            <div class="panel-heading">Адресс доставки</div>
            <div class="panel-body">
                <?php $form = ActiveForm::begin([
                    'id'                     => 'order-form',
                    'enableAjaxValidation'   => true,
                    'enableClientValidation' => false,
                    'validateOnBlur'         => false,
                    'validateOnType'         => false,
                    'validateOnChange'       => false,
                    'validateOnSubmit'       => true,
                ]); ?>
                <?= $form->field($this->model, 'fio')->textInput(['autofocus' => true ,'class'=>'form-control placeholder','placeholder'=>"ФИО",'data-text'=>"ФИО"])->label(false)?>
                <?= $form->field($this->model, 'phone',['template' => '<span class="phone">+7</span>{input}{error}{hint}'])->textInput(['maxlength' => 10 ,'class'=>'form-control placeholder phone center', 'autofocus' => true ,'id' => 'phone','placeholder'=>"Телефон",'data-text'=>"Телефон"])->label(false)?>
                <?= $form->field($this->model, 'email')->textInput(['autofocus' => true ,'class'=>'form-control placeholder','placeholder'=>"Email",'data-text'=>"Email"])->label(false)?>
                <?= $form->field($this->model, 'address')->textInput(['autofocus' => true ,'class'=>'form-control placeholder','placeholder'=>"Адрес",'data-text'=>"Адрес"])->label(false)?>
                <?= $form->field($this->model, 'comments')->textarea(['rows' => 2, 'cols' => 5,'class'=>'form-control placeholder string','placeholder'=>"Комментарий",'data-text'=>"Комментарий"])->label(false);?>
                <?= $form->field($this->model, 'delivery_id')->radioList($this->model->delivery,[
                    'item' => function ($index, $label, $name, $checked, $value) {
                        $checked = ($index === 0 ? 'checked' : '');
                        return '<div class="radio form-group"><label>'.Html::radio('delivery_id', $checked, ['value' => $label['id']]).$label['title'].' - <b>'.$label['price'].'</b></label></div>';
                    },
                ])->label('Способ Доставки'); ?>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
        <?php
    }
}
