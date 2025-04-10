<?php

namespace backend\controllers;

use common\models\Metodoexpedicao;
use backend\models\MetodoexpedicaoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\filters\VerbFilter;
use Yii;

/**
 * MetodoexpedicaoController implements the CRUD actions for Metodoexpedicao model.
 */
class MetodoexpedicaoController extends Controller
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
     * Lists all Metodoexpedicao models.
     *
     * @return string
     */
    public function actionIndex()
    {
        if(!Yii::$app->user->can('encomendaIndexBO')) {
          throw new ForbiddenHttpException('Access denied');
        }

        $searchModel = new MetodoexpedicaoSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Metodoexpedicao model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
      if(!Yii::$app->user->can('encomendaViewBO')) {
        throw new ForbiddenHttpException('Access denied');
      }

        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Metodoexpedicao model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
      if(!Yii::$app->user->can('encomendaCreateBO')) {
        throw new ForbiddenHttpException('Access denied');
      }

      $model = new Metodoexpedicao();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Metodoexpedicao model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
      if(!Yii::$app->user->can('encomendaUpdateBO')) {
        throw new ForbiddenHttpException('Access denied');
      }

      $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Metodoexpedicao model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
      if(!Yii::$app->user->can('encomendaDeleteBO')) {
        throw new ForbiddenHttpException('Access denied');
      }
     
      $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Metodoexpedicao model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Metodoexpedicao the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Metodoexpedicao::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
