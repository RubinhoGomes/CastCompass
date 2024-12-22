<?php

namespace frontend\controllers;

use common\models\Profile;
use common\models\Carrinho;
use common\models\CarrinhoSearch;
use common\models\Itemscarrinho;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;

/**
 * CarrinhoController implements the CRUD actions for Carrinho model.
 */
class CarrinhoController extends Controller
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
     * Lists all Carrinho models.
     *
     * @return string
     */
    public function actionIndex()
    {
      $profile = Profile::findOne(['userID' => Yii::$app->user->id]);
     
      if($profile == null) {
        return $this->redirect(['site/login']);
      }
      
      $carrinho = Carrinho::findOne(['profileID' => $profile->id]);

      if($carrinho === NULL) {
        if($this->CreateCarrinho($profile->id)) {
          $carrinho = Carrinho::findOne(['profileID' => $profile->id]);
        }
      }

      $itens = Itemscarrinho::findAll(['carrinhoID' => $carrinho->id]);

      return $this->render('index', [
        'carrinho' => $carrinho,
        'itens' => $itens,
      ]);
    }

    public function CreateCarrinho($profileID) {
      $carrinho = new Carrinho();
      $carrinho->profileID = $profileID;
      $carrinho->dataCompra = NULL;
      $carrinho->valorTotal = NULL;
      $carrinho->quantidade = NULL;
      $carrinho->metodoPagamentoID = NULL;
      $carrinho->metodoExpedicaoID = NULL;
      if($carrinho->save(false)) {
        return true;
      }

      return false;
    }


    /**
     * Displays a single Carrinho model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionAdd($idCarrinho, $idProduto, $quantidade) {
        $carrinho = findModel($idCarrinho);
        $item = new Itemscarrinho();
        $item->carrinhoID = idCarrinho;
        $item->produtoID = idProduto;
        $item->quantidade = $quantidade;

        return $this->redirect(['index']);
    }

    /**
     * Creates a new Carrinho model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Carrinho();

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
     * Updates an existing Carrinho model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Carrinho model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Carrinho model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Carrinho the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Carrinho::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
