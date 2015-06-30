<?php
namespace app\models;

use Yii;

class LoginForm extends \yii\base\Model
{
    public $username;
    public $password;
    public $rememberMe = true;

    public function rules() {
        return [
          [['username', 'password'], 'required'],
          ['rememberMe', 'boolean'],
          ['password', 'validatePassword'],
        ];
    }
    
    public function attributeLabels() {
      return [
        'username' => 'логин',
        'password' => 'пароль',
      ];
    }
    
    public function validatePassword($attribute, $params) {
      if (!$this->hasErrors()) {
        $user = User::findByUsername($this->username);

        if (!$user || !$user->validatePassword($this->password)) {
            $this->addError($attribute, 'Неверный логин или пароль');
        }
      }
    }
    
    public function login() {
      
      if ($this->validate()) {
        $user = User::findByUsername($this->username);
        Yii::$app->user->login($user, $this->rememberMe ? 3600*24*30 : 0);
        return true;
      } 
      return false;
    }
}
