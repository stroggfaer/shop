<?php

namespace app\components\sidebar;
use yii\base\Widget;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use Yii;
use app\modules\user\models\LoginForm;
use yii\widgets\Pjax;

class WLogin extends Widget{
    public  $model;
    public function init() {

        if ($this->model === null) {
            $this->model = false;
        }
        parent::init();
    }
    public function run()
    {
       Pjax::begin(['id' => 'pjax-container-logon','linkSelector'=>'pjax-container-logon']);
        if (Yii::$app->user->isGuest) {
            $model = !empty($this->model) ? $this->model : new LoginForm();
            ?>
            <?php $form = ActiveForm::begin([
                'id' => 'login-form',
               // 'enableAjaxValidation'   => true,
                'enableClientValidation' => false,
                'validateOnBlur'         => false,
                'validateOnType'         => false,
                'validateOnChange'       => false,
                'validateOnSubmit'       => true,
                //'fieldConfig' => ['template' => "{label}\n{input}\n{error}",],
            ]); ?>
            <?= $form->field($model, 'email')->textInput(['class' => 'form-control placeholder', 'placeholder' => "E-mail", 'data-text' => "E-mail"])->label(false); ?>
            <?= $form->field($model, 'password')->passwordInput(['class' => 'form-control placeholder', 'placeholder' => "Пароль", 'data-text' => "Пароль",])->label(false); ?>
            <?= $form->field($model, 'rememberMe',['enableAjaxValidation' => false,'enableClientValidation' => false])->checkbox(['class' => 'form-control checkbox']); ?>
            <div class="form-group text-center reset">
                <?= Html::a('Регистрация', ['signup']) ?> | <?= Html::a('Забыли пароль?', ['password-reset-request']) ?>
            </div>
            <div class="form-group"><?= Html::submitButton('Вход', ['class' => 'btn button_vinous size-2', 'name' => 'login-button']) ?></div>
            <?php ActiveForm::end(); ?>
            <?php
        }else{

            //print_arr(Yii::$app->user->identity->username);
            ?>
            <div><a href="#"><?=Yii::$app->user->identity->username?></a> </div>
            <div><a href="/site/logout">Выход</a> </div>
          <?php
        }
        Pjax::end();
    }
}