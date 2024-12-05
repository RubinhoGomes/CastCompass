<?php

namespace backend\controllers;

use common\models\Produto;
use common\models\Categoria;
use common\models\Imagem;
use backend\models\ImagemForm;
use app\models\ProdutoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\filters\AccessControl;
use yii\helpers\FileHelper;
use Yii;

/**
 * ProdutoController implements the CRUD actions for Produto model.
 */
class ProdutoController extends Controller
{
  /**
   * @inheritDoc
   */
  public function behaviors()
  {
    return array_merge(
      parent::behaviors(),
      [
        'verbs' => [
          'class' => VerbFilter::className(),
          'actions' => [
            'delete' => ['POST'],
          ],
        ],
      ]
    );
  }

  /**
   * Lists all Produto models.
   *
   * @return string
   */
  public function actionIndex() {
    if(!Yii::$app->user->can('produtoIndexBO')) {
      throw new ForbiddenHttpException('Access denied');
    }

    $searchModel = new ProdutoSearch();
    $dataProvider = $searchModel->search($this->request->queryParams);
  
    return $this->render('index', [
      'searchModel' => $searchModel,
      'dataProvider' => $dataProvider,
    ]);
  }

  /**
   * Displays a single Produto model.
   * @param int $id ID
   * @return string
   * @throws NotFoundHttpException if the model cannot be found
   */
  public function actionView($id)
  {
    if(!Yii::$app->user->can('produtoViewBO')) {
      throw new ForbiddenHttpException('Access denied');
    }

    $imagem = $this->getImageAndPath($id);
 
    return $this->render('view', [
      'model' => $this->findModel($id),
      'imagem' => $imagem,
    ]);
  }

  /**
   * Creates a new Produto model.
   * If creation is successful, the browser will be redirected to the 'view' page.
   * @return string|\yii\web\Response
   */
  public function actionCreate()
  {
   if(!Yii::$app->user->can('produtoCreateBO')) {
      throw new ForbiddenHttpException('Access denied');
    }

    $model = new Produto();
    $imagem = new ImagemForm();

   if ($this->request->isPost) {
      if ($model->load($this->request->post()) && $model->save()) {
        $this->uploadImage($model->id, $imagem);
        return $this->redirect(['view', 'id' => $model->id]);
      }
    } else 
        $model->loadDefaultValues();

    return $this->render('create', [
      'model' => $model,
      'imagem' => $imagem,
    ]);
  }

  public function uploadImage($id, $imagem){

    if(Yii::$app->request->isPost){
      $imagem->imagens = UploadedFile::getInstances($imagem, 'imagens');

      if($imagem->saveImage($id)) {
        return true;
      }

      return false;
    }
  }
  /**
   * Updates an existing Produto model.
   * If update is successful, the browser will be redirected to the 'view' page.
   * @param int $id ID
   * @return string|\yii\web\Response
   * @throws NotFoundHttpException if the model cannot be found
   */
  public function actionUpdate($id)
  {
  
    if(!Yii::$app->user->can('produtoUpdateBO')) {
      throw new ForbiddenHttpException('Access denied');
    }
 
    $model = $this->findModel($id);
    $imagem = $this->getImageAndPath($id);

    if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
      return $this->redirect(['view', 'id' => $model->id]);
    }

    return $this->render('update', [
      'model' => $model,
      'imagem' => $imagem,
    ]);
  }


  /**
   * @brief This function return the path of the image and the filename with extension
   * @param int $id ID
   * @return string
   */
  public function getImageAndPath($id) {
    $imagem = Imagem::findOne(['produtoID' => $id]);

    if ($imagem == null) {
      return null;
    }
 
   $imagem->filename = Yii::getAlias('@backendUploads') . '/' . $imagem->filename;

    return $imagem;
  }


  /**
   * Deletes an existing Produto model.
   * If deletion is successful, the browser will be redirected to the 'index' page.
   * @param int $id ID
   * @return \yii\web\Response
   * @throws NotFoundHttpException if the model cannot be found
   */
  public function actionDelete($id)
  {
    if(!Yii::$app->user->can('produtoDeleteBO')) {
      throw new ForbiddenHttpException('Access denied');
    }
    
    $this->findModel($id)->delete();

    return $this->redirect(['index']);
  }
 

  /**
   * Finds the Produto model based on its primary key value.
   * If the model is not found, a 404 HTTP exception will be thrown.
   * @param int $id ID
   * @return Produto the loaded model
   * @throws NotFoundHttpException if the model cannot be found
   */
  protected function findModel($id)
  {
    if (($model = Produto::findOne(['id' => $id])) !== null) {
      return $model;
    }

    throw new NotFoundHttpException('The requested page does not exist.');
  }
}
