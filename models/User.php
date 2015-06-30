<?php

namespace app\models;

use Yii;

class User extends \yii\base\Model implements \yii\web\IdentityInterface {
  
    public static $id = 1;
    public static $login = 'admin';
    public static $password = '123';
    
    public static function findByUsername($username) {
      if ($username === self::$login) {
        return new User;
      }
      return null;
    }
    
    public function validatePassword($password) {
    if ($password === self::$password) {
        return true;
      }
      return false;
    }
  
    public static function findIdentity($id)
    {
      if ($id == self::$id) {
        return new User;
      }
      return null;
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
      return null;
    }

    public function getId()
    {
        return self::$id;
    }

    public function getAuthKey()
    {
        return null;
    }

    public function validateAuthKey($authKey)
    {
        return false;
    }  
}