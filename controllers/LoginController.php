<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;

use app\models\LoginForm;

class LoginController extends Controller
{


  public function actionIndex() {
    $model = new LoginForm();
    if ($loginFormParams = Yii::$app->request->getBodyParam('LoginForm')) {
      $model->setAttributes($loginFormParams, false);
      if ($model->login()) {
        Yii::$app->response->redirect(array('site'));
      }
    }
    return $this->render('index', [
      'model' => $model
    ]);
  }
    

}
