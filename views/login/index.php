<?php
  use yii\helpers\Html;
  use yii\widgets\ActiveForm;
?>

<div class="">
<?php
$form = ActiveForm::begin([
    'id' => 'login-form',
    'options' => ['class' => 'form-horizontal form-signin'],
]) ?>
    <?php echo $form->field($model, 'username') ?>
    <?php echo $form->field($model, 'password')->passwordInput() ?>

    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?php echo Html::submitButton('Войти', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
<?php ActiveForm::end() ?>
</div>