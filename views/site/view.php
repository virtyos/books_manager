<?php
use yii\widgets\DetailView;
use yii\helpers\Html;
  

echo DetailView::widget([
    'model' => $model,
    'attributes' => [
        'id',              
        'name',
        [
          'attribute' => 'author_id',
          'value' => $model->author->lastname,
        ],
        [
         'attribute' => 'preview',
         'format' => 'raw',
         'value' => empty($model->preview) ? null : 
            Html::img('/images/' . $model->preview, ['width' => '100'])
          ,
        ],
        'date:date',
        'date_create:date'       
    ],
]);

?>