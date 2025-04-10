<?php

namespace backend\controllers;

use common\models\Metodopagamento;
use backend\models\MetodopagamentoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\filters\VerbFilter;
use Yii;

/**
 * MetodopagamentoController implements the CRUD actions for Metodopagamento model.
 */
class MetodopagamentoController extends Controller
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
   * Lists all Metodopagamento models.
   *
   * @return string
   */
  public function actionIndex() {
    if(!Yii::$app->user->can('mpIndexBO')) {
      throw new ForbiddenHttpException('Access denied');
    }

    $searchModel = new MetodopagamentoSearch();
    $dataProvider = $searchModel->search($this->request->queryParams);

    return $this->render('index', [
      'searchModel' => $searchModel,
      'dataProvider' => $dataProvider,
    ]);
  }

  /**
   * Displays a single Metodopagamento model.
   * @param int $id ID
   * @return string
   * @throws NotFoundHttpException if the model cannot be found
   */
  public function actionView($id) {
    if(!Yii::$app->user->can('mpViewBO')) {
      throw new ForbiddenHttpException('Access denied');
    }

    return $this->render('view', [
      'model' => $this->findModel($id),
    ]);
  }

  /**
   * Creates a new Metodopagamento model.
   * If creation is successful, the browser will be redirected to the 'view' page.
   * @return string|\yii\web\Response
   */
  public function actionCreate() {
    if(!Yii::$app->user->can('mpCreateBO')) {
      throw new ForbiddenHttpException('Access denied');
    }

    $model = new Metodopagamento();

    if ($this->request->isPost) {
      if ($model->load($this->request->post()) && $model->save()) {
        return $this->redirect(['view', 'id' => $model->id]);
      }
    } else {
      $model->loadDefaultValues();
    }

    return $this->render('create', [
      'model' => $model,
      'metodos' => $model->getMetodos(),
    ]);
  }

  /**
   * Updates an existing Metodopagamento model.
   * If update is successful, the browser will be redirected to the 'view' page.
   * @param int $id ID
   * @return string|\yii\web\Response
   * @throws NotFoundHttpException if the model cannot be found
   */
  public function actionUpdate($id) {
    if(!Yii::$app->user->can('mpUpdateBO')) {
      throw new ForbiddenHttpException('Access denied');
    }

    $model = $this->findModel($id);

    if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
      return $this->redirect(['view', 'id' => $model->id]);
    }

    return $this->render('update', [
      'model' => $model,
      'metodos' => $model->getMetodos(),
    ]);
  }

  /**
   * Deletes an existing Metodopagamento model.
   * If deletion is successful, the browser will be redirected to the 'index' page.
   * @param int $id ID
   * @return \yii\web\Response
   * @throws NotFoundHttpException if the model cannot be found
   */
  public function actionDelete($id) {
    if(!Yii::$app->user->can('mpDeleteBO')) {
      throw new ForbiddenHttpException('Access denied');
    }

    $this->findModel($id)->delete();

    return $this->redirect(['index']);
  }


  /**
   * Finds the Metodopagamento model based on its primary key value.
   * If the model is not found, a 404 HTTP exception will be thrown.
   * @param int $id ID
   * @return Metodopagamento the loaded model
   * @throws NotFoundHttpException if the model cannot be found
   */
  protected function findModel($id) {
    if (($model = Metodopagamento::findOne(['id' => $id])) !== null) {
      return $model;
    }

    throw new NotFoundHttpException('The requested page does not exist.');
  }
}
