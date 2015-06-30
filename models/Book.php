<?php

namespace app\models;

use Yii;
use yii\data\ActiveDataProvider;

class Book extends \yii\db\ActiveRecord
{

    public $previewFile;
    
    public $dateFrom;
    public $dateTo;
    /**
     * @inheritdoc
     */
    public static function tableName() {
      return 'book';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
      return [
        [['name', 'date', 'author_id'], 'required', 'on' => 'update'],
        ['previewFile', 'file', 'extensions'=> ['jpg', 'png']],
        [['dateFrom', 'dateTo', 'name', 'date', 'author_id'], 'safe']
      ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
      return [
        'id' => 'ID',
        'name' => 'Название',
        'date_create' => 'Дата добавления',
        'date_update' => 'Дата обновления',
        'preview' => 'Превью',
        'previewFile' => 'Превью',
        'date' => 'Дата выхода',
        'author_id' => 'Автор'
      ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor() {
      return $this->hasOne(Author::className(), ['id' => 'author_id'])->from(['author' => Author::tableName()]);
    }
    
    public function search() {
      $query = self::find();
      $query
        ->andFilterWhere(['like', 'name', $this->name]);
        
      if (!empty($this->author_id)) {
        $query->andWhere(['author_id' => $this->author_id]);
      }
      
      if (!empty($this->dateFrom) && !empty($this->dateTo)) {
         $query->andFilterWhere(['between', 'date', $this->dateFrom, $this->dateTo]);  
      }
        
 
      $dataProvider = new ActiveDataProvider([
        'query' => $query,
        'pagination' => [
          'pageSize' => 10,
        ],
      ]);
      
 
      return $dataProvider;
    }
    
}
