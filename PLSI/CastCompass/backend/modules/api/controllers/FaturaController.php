<?php

namespace backend\modules\api\controllers;

use common\models\Carrinho;
use common\models\Fatura;
use common\models\ItemsCarrinho;
use common\models\Iva;
use common\models\Linhafatura;
use common\models\Metodoexpedicao;
use common\models\Metodopagamento;
use common\models\Produto;
use common\models\Profile;
use Yii;
use yii\filters\auth\QueryParamAuth;
use yii\rest\ActiveController;
use yii\filters\ContentNegotiator;
use yii\web\Response;
use yii\filters\auth\HttpBasicAuth;
use backend\modules\api\components\CustomAuth;


/**
 * Default controller for the `api` module
 */
class FaturaController extends ActiveController
{
    public $modelClass = 'common\models\Fatura';

    public function behaviors() {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => CustomAuth::className(),
        ];
        $behaviors['contentNegotiator'] = [
            'class' => ContentNegotiator::class,
            'formats' => [
                'application/json' => Response::FORMAT_JSON,
            ],
        ];
        return $behaviors;
    }

    public function actionCount() {
        $metodosmodel = new $this->modelClass;
        $recs = $metodosmodel::find()->all();
        return ['count' => count($recs)];
    }

    public function actionFaturascliente($id) {
        $profile = Profile::findOne($id);
        $carrinho = Carrinho::findOne(['profileID' => $profile->id]);
        $faturas = $carrinho->faturas;

        $dados = [];

        foreach ($faturas as $fatura) {
            $dados[] = [
                'id' => $fatura->id,
                'valorTotal' => $fatura->valorTotal,
                'ivaTotal' => $fatura->ivaTotal,
                'metodoExpedicaoID' => $fatura->metodoExpedicao->nome,
                'metodoPagamentoID' => $fatura->metodoPagamento->nome,
                'data' => $fatura->data,
                'estado' => $fatura->estado,
            ];
        }

        return $dados;
    }

    public function actionComprafinal($carrinhoID, $metodoExpedicaoID, $metodoPagamentoID) {
        $carrinho = Carrinho::findOne(['id' => $carrinhoID]);
        if (!$carrinho) {
            return ['error' => 'Carrinho não encontrado'];
        }

        $itemsCarrinho = ItemsCarrinho::findAll(['carrinhoID' => $carrinho->id]);
        if (empty($itemsCarrinho)) {
            return ['error' => 'O carrinho está vazio'];
        }

        $fatura = new Fatura();
        $fatura->carrinhoID = $carrinho->id;
        $fatura->valorTotal = $carrinho->valorTotal;
        $fatura->ivaTotal = $this->calcularIvaTotal($carrinho->id);
        $fatura->metodoExpedicaoID = $metodoExpedicaoID;
        $fatura->metodoPagamentoID = $metodoPagamentoID;
        $fatura->data = strtotime(date('Y-m-d'));
        $fatura->estado = 'Em Processamento';

        if ($fatura->save()) {
            foreach ($itemsCarrinho as $itemCarrinho) {
                $produto = Produto::findOne(['id' => $itemCarrinho->produtoID]);
                $linhaFatura = new Linhafatura();
                $linhaFatura->faturaID = $fatura->id;
                $linhaFatura->ivaID = Produto::findOne(['id' => $itemCarrinho->produtoID])->ivaID;
                $linhaFatura->quantidade = $itemCarrinho->quantidade;
                $linhaFatura->valor = $itemCarrinho->valorTotal;
                $linhaFatura->valorIva = $itemCarrinho->valorTotal - ($this->subIva($produto->preco, $produto->ivaID) * $itemCarrinho->quantidade);
                $linhaFatura->produtoID = $itemCarrinho->produtoID;

                if (!$linhaFatura->save()) {
                    return ['error' => 'Erro ao criar linha de fatura', 'details' => $linhaFatura->errors];
                }
            }
        } else {
            return ['error' => 'Erro ao salvar a fatura', 'details' => $fatura->errors];
        }

        foreach ($itemsCarrinho as $itemCarrinho) {
            $itemCarrinho->delete();
        }

        $carrinho->valorTotal = 0;
        $carrinho->quantidade = 0;
        $carrinho->save();
    }

    public function subIva($preco, $ivaID) {

        if ($ivaID == null) {
            return $preco;
        }

        $iva = Iva::findOne($ivaID);

        $preco = $preco / (1 + $iva->valor);

        return $preco;
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
}
