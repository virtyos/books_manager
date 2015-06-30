<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Author;
use app\models\Book;

use yii\web\UploadedFile;

use yii\filters\AccessControl;

class SiteController extends Controller
{

  public function behaviors() {
    return [
      'access' => [
        'class' => AccessControl::className(),
        'rules' => [
          [
            'allow' => true,
            'roles' => ['@']
          ]
        ]
      ]
    ];
  }
  
  public function actions() {
    return [
      'error' => [
        'class' => 'yii\web\ErrorAction',
      ]
    ];
  }

  public function actionIndex() {
    return $this->renderList();
  }
  
  public function actionView($id) {
    $model = $this->loadModel($id);
    return $this->render('view', [
      'model' => $model
    ]);
  }
  
  public function actionDelete($id) {
    $model = $this->loadModel($id);
    $model->delete();
    return $this->renderList();
  }
  
  public function actionUpdate($id) {
    $model = $this->loadModel($id);
    $model->scenario = 'update';
    if ($params = Yii::$app->request->post('Book')) {
      $model->setAttributes($params, false);
      $model->previewFile = UploadedFile::getInstance($model, 'previewFile');
      if ($model->validate()) {
        if ($model->previewFile) {
          $fileName = $model->previewFile->baseName . '.' . $model->previewFile->extension;
          $model->previewFile->saveAs(
            Yii::getAlias('@webroot/images') . '/' . $fileName);
          $model->preview = $fileName;
        }
        $model->save();
        return $this->render('_update_finish');
      }
    }
    return $this->render('update', [
      'model' => $model
    ]);
  }
  
  private function renderList() {
    $model = new Book;
    $searchParams = Yii::$app->request->get('Book');
    if ($searchParams) {
      $model->setAttributes($searchParams, false);
      $model->dateFrom = $searchParams['dateFrom'];
      $model->dateTo = $searchParams['dateTo'];
    }
    $provider = $model->search();
    return $this->render('index', [
      'provider' => $provider,
      'model' => $model,
    ]);   
  }
    
  private function loadModel($id) {
    $model = Book::find($id)->one();
    if (!$model) {
      throw new HttpException(404, 'Not Found');
    }
    return $model;
  }
  
}
