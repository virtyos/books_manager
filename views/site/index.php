<?php
  use yii\grid\GridView;
  use yii\helpers\ArrayHelper;
  use app\models\Author;
  
  use yii\helpers\Html;
  use yii\widgets\ActiveForm;
  
  use yii\jui\DatePicker;
  
  use yii\helpers\Url;
?>
<?php
  $this->registerJs('
    $(".fancybox").fancybox({
      helpers: {
        overlay: {
          locked: false
        }
      }       
    });
    $("a.view_button").fancybox({
      type: "ajax",
      ajax : {
        type    : "POST",
      },
      helpers: {
        overlay: {
          locked: false
        }
      }      
    });
  ');
?>
<div class="site-index">
    <div class="body-content">
      <div style="margin-bottom: 30px;">
      <?php
        $form = ActiveForm::begin([
          'id' => 'filter-form',
          'enableClientValidation' => false,
          'method' => 'get',
          'action' => '/site'
        ]) 
      ?>     
      <div class="form-group" style="overflow: hidden">      
        <div style="float: left;  width: 200px;">
          <?php echo  $form->field($model, 'author_id')->dropDownList(
              ArrayHelper::map(Author::find()->all(), 'id', 'lastname'),        
              ['prompt'=>'писатель']
          )->label(false); ?>
        </div>
        <div style="float: left; width: 200px; margin-left: 30px;">
        <?php echo  $form->field($model, 'name')
                ->textInput(['placeholder' => $model->getAttributeLabel( 'name' )])
                ->label(false); ?>
        </div> 
      </div>
 
      <div class="form-group"> 
        Дата выхода книги. &nbsp;&nbsp;&nbsp; от &nbsp;&nbsp;&nbsp;
        <?php
          echo DatePicker::widget([
            'model' => $model,
            'attribute' => 'dateFrom',
            'clientOptions' => [
              'autoclose' => true,
              'dateFormat' => 'yy-mm-dd'
            ]
          ])
        ?>
        
        &nbsp;&nbsp;&nbsp; до &nbsp;&nbsp;&nbsp;
        
        <?php
          echo DatePicker::widget([
            'model' => $model,
            'attribute' => 'dateTo',
            'clientOptions' => [
              'autoclose' => true,
              'dateFormat' => 'yy-mm-dd'
            ]
          ])
        ?>
      </div>

      <div class="form-group">
            <?php echo Html::submitButton('Поиск', ['class' => 'btn btn-primary']) ?>
      </div>
      <?php ActiveForm::end() ?>      
      </div>
        
      <?php
        \yii\widgets\Pjax::begin(['id' => 'books-grid-pjax', 'enablePushState' => false, 'timeout' => 6000]);
        echo GridView::widget([
          'id' => 'books-grid',
          'dataProvider' => $provider,
          'columns' => [
            'id',
            'name',
            [
              'attribute' => 'author_id',
              'value' => 'author.lastname',
              'filter' => ArrayHelper::map(Author::find()->all(), 'id', 'lastname'),
            ],
            [
              'attribute' => 'preview',
              'format' => 'raw',
              'value' => function($data) { return empty($data->preview) ? null : 
                Html::a(Html::img('/images/' . $data->preview, ['width' => '100']), 
                '/images/' . $data->preview, ['class' => 'fancybox', 'data-pjax' => '0']); 
              },
            ],
            [
              'attribute' => 'date'
            ],
            [
              'attribute' => 'date_create'
            ],
            [
              'header' => 'Действия',
              'class' => \yii\grid\ActionColumn::className(),
              'template'=>'{update} {view} {delete}',
              'buttons' => [
                'delete' => function ($url, $model) {
                  return Html::a('<span class="glyphicon glyphicon-trash"></span>', 'javascript:deleteBook('.$model->id.')', [
                    'title' =>'Удалить',
                    'class' => 'delete_button',
                ]);},
                'view' => function ($url, $model) {
                  return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, [
                    'title' =>'Просмотр',
                    'class' => 'view_button',
                    'data-pjax' => '0'               
                ]);},
                'update' => function ($url, $model) {
                  return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:updateBook('.$model->id.')', [
                    'title' =>'Редактирование',
                    'target' => '_blank',
                    'data-pjax' => '0'               
                ]);},                
              ]
            ]
          ]
        ]);
        \yii\widgets\Pjax::end();
      ?>
    </div>
</div>

<script>
  function deleteBook(id) {
    if (confirm("Точно удалить?")) {
      $.post('<?php echo Url::toRoute(['delete', 'id' => '']);?>' + id, {1:1}, function(result) {
        refreshGrid();
      })
    }
  }
  
  function updateBook(id) {
    var myWindow = window.open('<?php echo Url::toRoute(['update', 'id' => '']);?>' + id, "myWindow", "width=500, height=500");
  }
  
  function refreshGrid() {
    $.pjax.reload({container: '#books-grid-pjax', timeout: 6000});
  }
</script>

