<?php

namespace app\models;

use Yii;

class Author extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName() {
      return 'author';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
      return [
        [['firstname', 'lastname'], 'required'],
      ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
      return [
        'id' => 'ID',
        'firstname' => 'Имя',
        'lastname' => 'Фамилия',
      ];
    }
    
}
