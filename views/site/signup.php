<?php
use yii\captcha\Captcha;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\modules\user\models\SignupForm */

$this->title = 'Регистрация';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-default-signup" id="signup">
    <div class="row">
    <div class="col-md-8">
        <div class="panel panel-default">
        <div class="panel-heading"><?= Html::encode($this->title) ?></div>
        <div class="panel-body">
            <?php $form = ActiveForm::begin([
                'id' => 'form-signup','class'=>'form-horizontal',
                'enableClientValidation' => true,
                'validateOnBlur'         => false,
                'validateOnType'         => false,
                'validateOnChange'       => false,
                'validateOnSubmit'       => true,
            ]); ?>
            <?= $form->field($model, 'username')->textinput(['autofocus' => true ,'class'=>'form-control placeholder','placeholder'=>"ФИО"])->label(false)?>
            <?= $form->field($model, 'phone')->widget(\yii\widgets\MaskedInput::className(), ['clientOptions'=>['clearIncomplete'=>true],'type'=>'tel', 'id'=>'phone', 'name' => 'phone','class'=>'form-control placeholder phone center', 'mask' => ['+7 999 999 9999']])->textInput(['placeholder' => 'phone'])->label(false)?>
            <?= $form->field($model, 'email')->textinput(['autofocus' => true ,'class'=>'form-control placeholder','placeholder'=>"E-mail"])->label(false) ?>
            <?= $form->field($model, 'password_repeat')->passwordInput(['autofocus' => true ,'class'=>'form-control placeholder','placeholder'=>"Пароль"])->label(false); ?>
            <?= $form->field($model, 'password')->passwordInput(['autofocus' => true ,'class'=>'form-control placeholder','placeholder'=>"Повторит пароль"])->label(false)->hint('Длинна пароля не меньше 4 символов.'); ?>
            <?php /* $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                'captchaAction' => '/user/default/captcha',
                'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
            ]) */?>
            <div class="form-group">
                <?= Html::submitButton('Регистрация', ['class' => 'btn button_vinous', 'name' => 'signup-button']) ?>
            </div>
            <?php ActiveForm::end(); ?>
          </div>
      </div>
    </div>
    </div>
</div>