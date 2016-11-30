<?php

namespace app\components\basket;
use yii\base\Widget;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;




class WBasketOrderForm extends Widget
{

    public $model;
    public $form;

    public function init() {

        if ($this->model === null) {
            $this->model = false;
        }
        if ($this->form === null) {
            $this->form = false;
        }
        parent::init();
    }
    public function run(){

        ?>
        <div class="panel panel-default">
            <div class="panel-heading">Адресс доставки</div>
            <div class="panel-body">
                <?= $this->form->field($this->model, 'fio')->textInput(['autofocus' => true ,'class'=>'form-control placeholder','placeholder'=>"ФИО",'data-text'=>"ФИО"])->label(false)?>
                <?= $this->form->field($this->model, 'phone')->widget(\yii\widgets\MaskedInput::className(), ['clientOptions'=>['clearIncomplete'=>true],'type'=>'tel', 'id'=>'phone', 'name' => 'phone','class'=>'form-control placeholder phone center', 'mask' => ['+7 999 999 9999']])->textInput(['placeholder' => 'phone'])->label(false)?>
                <?= $this->form->field($this->model, 'email')->textInput(['autofocus' => true ,'class'=>'form-control placeholder','placeholder'=>"Email",'data-text'=>"Email"])->label(false)?>
                <?= $this->form->field($this->model, 'address')->textInput(['autofocus' => true ,'class'=>'form-control placeholder','placeholder'=>"Адрес",'data-text'=>"Адрес"])->label(false)?>
                <?= $this->form->field($this->model, 'comments')->textarea(['rows' => 2, 'cols' => 5,'class'=>'form-control placeholder string','placeholder'=>"Комментарий",'data-text'=>"Комментарий"])->label(false);?>
                <?= $this->form->field($this->model, 'delivery_id')->radioList($this->model->delivery,[
                    'item' => function ($index, $label, $name, $checked, $value) {
                        $checked = ($index === 0 ? 'checked' : '');
                        return '<div class="radio form-group"><label>'.Html::radio($name, $checked, ['value' => $label['id']]).$label['title'].' - <b>'.$label['price'].'</b></label></div>';
                    },
                ])->label('Способ Доставки'); ?>
            </div>
        </div>
        <?php
    }
}
