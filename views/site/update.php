<?php
  use yii\helpers\Html;
  use yii\widgets\ActiveForm;
  use yii\helpers\ArrayHelper;
  
  use app\models\Author;
  
  use yii\jui\DatePicker;
?>
<div class="site-index">
      <?php
        $form = ActiveForm::begin([
          'id' => 'update-form',
          'enableClientValidation' => true,
          'options' => ['enctype' => 'multipart/form-data'],
        ]) 
      ?>     
      <div class="form-group">      
          <?php echo  $form->field($model, 'author_id')->dropDownList(
              ArrayHelper::map(Author::find()->all(), 'id', 'lastname'),        
              ['prompt'=>'писатель']
          )->label(false); ?>
        </div>
        <?php echo $form->errorSummary($model); ?>
        <div class="form-group">
        <?php echo  $form->field($model, 'name')
                ->textInput(['placeholder' => $model->getAttributeLabel( 'name' )])
                ->label(false); ?>
        </div>
        <div class="form-group">
          <?php echo $form->field($model, 'previewFile')->fileInput() ?>
          <?php
            echo empty($model->preview) ? '' : 
              Html::img('/images/' . $model->preview, ['width' => '100']);
          ?>
        </div>
        <div class="form-group">
        <?php
          echo DatePicker::widget([
            'model' => $model,
            'attribute' => 'date',
            'clientOptions' => [
              'autoclose' => true,
              'dateFormat' => 'yy-mm-dd'
            ]
          ]);
        ?>
        </div>
        <div class="form-group">
        <?php
          echo DatePicker::widget([
            'model' => $model,
            'attribute' => 'date_create',
            'clientOptions' => [
              'autoclose' => true,
              'dateFormat' => 'yy-mm-dd'
            ]
          ]);
        ?>
        </div>
        

      <div class="form-group">
            <?php echo Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
      </div>
      <?php ActiveForm::end() ?>  
</div>