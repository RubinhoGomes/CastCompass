<?php

namespace frontend\controllers;

use common\models\Profile;
use common\models\Carrinho;
use common\models\CarrinhoSearch;
use common\models\Itemscarrinho;
use common\models\Fatura;
use common\models\Linhafatura;
use common\models\Produto;
use common\models\Iva;
use common\models\MetodoPagamento;
use common\models\MetodoExpedicao;
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
      
      $this->calcularValorTotal($carrinho->id);
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


    public function actionCheckout() {
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
      
      if(Yii::$app->request->isPost){
        $this->fazerCompra($_POST["carrinhoId"], $_POST["metodoPagamento"], $_POST["metodoExpedicao"]);
      }
        
      $metodoPagamento = MetodoPagamento::find()->all();
      $metodoExpedicao = MetodoExpedicao::find()->all();

      return $this->render('checkout', [ 'carrinho' => $carrinho,
        'itens' => $itens,
        'metodoPagamento' => $metodoPagamento,
        'metodoExpedicao' => $metodoExpedicao,
      ]);
    }


    public function fazerCompra($carrinhoId, $metodoPagId, $metodoExpId){
      $this->alterarValoresCarrinho($carrinhoId);

      $carrinho = Carrinho::findOne(['id' => $carrinhoId]);
      $itens = Itemscarrinho::findAll(['carrinhoID' => $carrinhoId]);
      
      // Fatura Code
      $fatura = new Fatura();

      $fatura->carrinhoID = $carrinhoId;
      $fatura->valorTotal = $carrinho->valorTotal;
      $fatura->ivaTotal = $this->calcularIvaTotal($carrinhoId);
      $fatura->metodoPagamentoID = $metodoPagId;
      $fatura->metodoExpedicaoID = $metodoExpId;

      if($fatura->save(false)){
        foreach($itens as $item){
          $produto = Produto::findOne(['id' => $item->produtoID]);
          $linhaFatura = new Linhafatura();
          $linhaFatura->faturaID = $fatura->id;
          $linhaFatura->produtoID = $item->produtoID;
          $linhaFatura->quantidade = $item->quantidade;
          $linhaFatura->valor = $item->valorTotal;
          $linhaFatura->valorIva = $item->valorTotal - ($this->subIva($produto->preco, $produto->ivaID) * $item->quantidade);
          $linhaFatura->ivaID = Produto::findOne(['id' => $item->produtoID])->ivaID;
          $linhaFatura->save(false);
        }
      }

      foreach($itens as $item){
        $item->delete();
      }

      Yii::$app->session->setFlash('success', 'Compra efetuada com sucesso!');
      return $this->redirect(['site/index']);

    }

    public function calcularValorTotal($carrinhoId){
      $carrinho = Carrinho::findOne(['id' => $carrinhoId]);
      $itens = Itemscarrinho::findAll(['carrinhoID' => $carrinhoId]);
      $valorTotal = 0;
      foreach($itens as $item){
        $valorTotal += $item->valorTotal;
      }
      $carrinho->valorTotal = $valorTotal;
      $carrinho->save(false);
    }

    public function calcularIvaTotal($carrinhoId){
      $carrinho = Carrinho::findOne(['id' => $carrinhoId]);
      $itens = Itemscarrinho::findAll(['carrinhoID' => $carrinhoId]);
      $ivaTotal = 0;
      foreach($itens as $item){
        $produto = Produto::findOne(['id' => $item->produtoID]);
        $ivaTotal += $item->valorTotal - ($this->subIva($produto->preco, $produto->ivaID) * $item->quantidade);
      }
      
      return $ivaTotal;

    }

    public function calcularQuantidadeTotal($carrinhoId){
      $carrinho = Carrinho::findOne(['id' => $carrinhoId]);
      $itens = Itemscarrinho::findAll(['carrinhoID' => $carrinhoId]);
      $quantidadeTotal = 0;
      foreach($itens as $item){
        $quantidadeTotal += $item->quantidade;
      }
      $carrinho->quantidade = $quantidadeTotal;
      $carrinho->save(false);
    }

    public function alterarValoresCarrinho($carrinhoId){
      $this->calcularValorTotal($carrinhoId);
      $this->calcularQuantidadeTotal($carrinhoId);
    }

    /**
     * @brief This function subtracts the IVA from the price to get the original value
     * @param float $preco Price
     * @param int $ivaID IVA ID
     * @return float
     */
    public function subIva($preco, $ivaID) {

      if($ivaID == null) {
        return $preco;
      }

      $iva = Iva::findOne($ivaID);

      $preco = $preco / (1 + $iva->valor);

      return $preco;
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
