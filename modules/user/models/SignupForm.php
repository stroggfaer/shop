<?php
namespace app\modules\user\models;

use yii\base\Model;
use Yii;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $phone;
    public $email;
    public $password;
    public $verifyCode;
    public $password_repeat;

    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
          //  ['username', 'match', 'pattern' => '#^[\w_-]+$#i'],
            ['username', 'unique', 'targetClass' => User::className(), 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 4, 'max' => 655],
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => User::className(), 'message' => 'This email address has already been taken.'],
            ['phone', 'required'],
            ['email', 'email','message'=>'Неправильный формат e-mail адреса! '],
            ['email', 'string', 'max' => 255],
            ['phone', 'filter', 'filter' => function ($value) {
                $phone = str_replace("_","",$value);
                $phone = str_replace(" ","",$value);
                $length = strlen($phone);
                if ($length != 12) $this->addError($phone, 'Неверный номер телефона');
                return $phone;
            }],
            [['password','password_repeat'], 'required'],
            ['password', 'string', 'min' => 4],
            ['password', 'compare', 'compareAttribute' => 'password_repeat'],
            //['verifyCode', 'captcha', 'captchaAction' => '/user/default/captcha'],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {

        if ($this->validate()) {
            $user = new User();
            $user->username = $this->username;
            $user->phone = $this->phone;
            $user->email = $this->email;
            $user->setPassword($this->password);
            $user->status = 1; //$user->status = User::STATUS_WAIT;
            $user->generateAuthKey();
            $user->generateEmailConfirmToken();

            // нужно добавить следующие три строки:
           // $auth = Yii::$app->authManager;
          //  $authorRole = $auth->getRole('user');
          //  $auth->assign($authorRole, $user->getId());

            if ($user->save()) {

                /*
                Yii::$app->mailer->compose('@app/modules/user/mails/emailConfirm', ['user' => $user])
                    ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name])
                    ->setTo($this->email)
                    ->setSubject('Email confirmation for ' . Yii::$app->name)
                    ->send();*/
                return $user;
            }
        }

        return null;
    }
}