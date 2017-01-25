<?php

namespace app\components\basket;
use yii\base\Widget;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use app\modules\index\models\MyHelper;
/*--------- Форма отправка заявки --------*/
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
        $user = (!empty(\Yii::$app->user->identity) ? \Yii::$app->user->identity : '');
        $fio = !empty($user->username) ? $user->username : '';
        $phone = !empty($user->phone) ? $user->phone : '';
        $email = !empty($user->email) ? $user->email : '';
        ?>
        <div class="panel panel-default">
            <div class="panel-heading">Адресс доставки</div>
            <div class="panel-body">
                <?= $this->form->field($this->model, 'fio')->textInput(['value'=>$fio,'autofocus' => true ,'class'=>'form-control placeholder','placeholder'=>"ФИО",'data-text'=>"ФИО"])->label(false)?>
                <?= $this->form->field($this->model, 'phone')->widget(\yii\widgets\MaskedInput::className(), ['clientOptions'=>['clearIncomplete'=>true],'type'=>'tel', 'id'=>'phone', 'name' => 'phone','class'=>'form-control placeholder phone center', 'mask' => ['+7 999 999 9999']])->textInput(['value'=>$phone,'placeholder' => 'phone'])->label(false)?>
                <?= $this->form->field($this->model, 'email')->textInput(['value'=>$email,'autofocus' => true ,'class'=>'form-control placeholder','placeholder'=>"Email",'data-text'=>"Email"])->label(false)?>
                <?= $this->form->field($this->model, 'address')->textInput(['autofocus' => true ,'class'=>'form-control placeholder','placeholder'=>"Адрес",'data-text'=>"Адрес"])->label(false)?>
                <?= $this->form->field($this->model, 'comments')->textarea(['rows' => 2, 'cols' => 5,'class'=>'form-control placeholder string','placeholder'=>"Комментарий",'data-text'=>"Комментарий"])->label(false);?>
                    <?= $this->form->field($this->model, 'delivery_id')->radioList($this->model->delivery,[
                        'item' => function ($index, $label, $name, $checked, $value) {
                            $checked = ($index === 0 ? 'checked' : '');
                            return '<div class="radio form-group"><label>'.Html::radio($name, $checked, ['value' => $label['id']]).$label['title'].' - <b>'.MyHelper::money($label['price']).' p.</b></label></div>';
                        },
                    ])->label('Способ Доставки'); ?>
            </div>
        </div>
        <?php
    }
}
