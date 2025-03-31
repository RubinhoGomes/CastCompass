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
    public function behaviors() {
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
    public function actionIndex() {
        $profile = Profile::findOne(['userID' => Yii::$app->user->id]);

        if ($profile == null) {
            return $this->redirect(['site/login']);
        }

        $carrinho = Carrinho::findOne(['profileID' => $profile->id]);

        if ($carrinho === NULL) {
            if ($this->CreateCarrinho($profile->id)) {
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

    public function atualizarPagamento(){
      var_dump($_POST);
      die();
    }

    public function CreateCarrinho($profileID) {
        $carrinho = new Carrinho();
        $carrinho->profileID = $profileID;
        $carrinho->valorTotal = NULL;
        $carrinho->quantidade = NULL;

        if ($carrinho->save(false)) {
            return true;
        }

        return false;
    }


    public function actionCheckout() {
        $profile = Profile::findOne(['userID' => Yii::$app->user->id]);

        if ($profile == null) {
            return $this->redirect(['site/login']);
        }

        $carrinho = Carrinho::findOne(['profileID' => $profile->id]);

        if ($carrinho === NULL) {
            if ($this->CreateCarrinho($profile->id)) {
                $carrinho = Carrinho::findOne(['profileID' => $profile->id]);
            }
        }

        $itens = Itemscarrinho::findAll(['carrinhoID' => $carrinho->id]);

        if ($itens == null) {
            Yii::$app->session->setFlash('error', 'O carrinho está vazio!');
            return $this->redirect(['site/shop']);
        }

        if (Yii::$app->request->isPost) {
            $this->fazerCompra($_POST["carrinhoId"], $_POST["metodoPagamento"], $_POST["metodoExpedicao"]);
        }

        $metodoPagamento = MetodoPagamento::find()->all();
        $metodoExpedicao = MetodoExpedicao::find()->all();

        return $this->render('checkout', ['carrinho' => $carrinho,
            'itens' => $itens,
            'metodoPagamento' => $metodoPagamento,
            'metodoExpedicao' => $metodoExpedicao,
        ]);
    }


    public function fazerCompra($carrinhoId, $metodoPagId, $metodoExpId) {
        $this->alterarValoresCarrinho($carrinhoId);

        $carrinho = Carrinho::findOne(['id' => $carrinhoId]);
        $itens = Itemscarrinho::findAll(['carrinhoID' => $carrinhoId]);

        // Fatura Code
        $fatura = new Fatura();

        $fatura->carrinhoID = $carrinhoId;
        $fatura->valorTotal = $carrinho->valorTotal;
        $fatura->ivaTotal = $this->calcularIvaTotal($carrinhoId);
        $fatura->data = strtotime(date('Y-m-d'));
        $fatura->metodoPagamentoID = $metodoPagId;
        $fatura->metodoExpedicaoID = $metodoExpId;

        if ($fatura->save(false)) {
            foreach ($itens as $item) {
                $produto = Produto::findOne(['id' => $item->produtoID]);
                $linhaFatura = new Linhafatura();
                $linhaFatura->faturaID = $fatura->id;
                $linhaFatura->produtoID = $item->produtoID;
                $linhaFatura->quantidade = $item->quantidade;
                $linhaFatura->valor = $item->valorTotal;
                $linhaFatura->valorIva = $item->valorTotal - ($this->subIva($produto->preco, $produto->ivaID) * $item->quantidade);
                $linhaFatura->ivaID = Produto::findOne(['id' => $item->produtoID])->ivaID;
                $linhaFatura->save(false);
                $produto->stock -= $item->quantidade;
                $produto->save(false);
            }
        }

        foreach ($itens as $item) {
            $item->delete();
        }

        $carrinho->valorTotal = 0;
        $carrinho->quantidade = 0;
        $carrinho->save(false);

        Yii::$app->session->setFlash('success', 'Compra efetuada com sucesso!');
        return $this->redirect(['site/index']);
    }

    public function calcularValorTotal($carrinhoId) {
        $carrinho = Carrinho::findOne(['id' => $carrinhoId]);
        $itens = Itemscarrinho::findAll(['carrinhoID' => $carrinhoId]);
        $valorTotal = 0;
        foreach ($itens as $item) {
            $valorTotal += $item->valorTotal;
        }
        $carrinho->valorTotal = $valorTotal;
        $carrinho->save(false);
    }

    public function calcularIvaTotal($carrinhoId) {
        $carrinho = Carrinho::findOne(['id' => $carrinhoId]);
        $itens = Itemscarrinho::findAll(['carrinhoID' => $carrinhoId]);
        $ivaTotal = 0;
        foreach ($itens as $item) {
            $produto = Produto::findOne(['id' => $item->produtoID]);
            $ivaTotal += $item->valorTotal - ($this->subIva($produto->preco, $produto->ivaID) * $item->quantidade);
        }

        return $ivaTotal;

    }

    public function calcularQuantidadeTotal($carrinhoId) {
        $carrinho = Carrinho::findOne(['id' => $carrinhoId]);
        $itens = Itemscarrinho::findAll(['carrinhoID' => $carrinhoId]);
        $quantidadeTotal = 0;
        foreach ($itens as $item) {
            $quantidadeTotal += $item->quantidade;
        }
        $carrinho->quantidade = $quantidadeTotal;
        $carrinho->save(false);
    }

    public function alterarValoresCarrinho($carrinhoId) {
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

        if ($ivaID == null) {
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
    public function actionView($id) {
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
     * Finds the Carrinho model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Carrinho the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Carrinho::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
