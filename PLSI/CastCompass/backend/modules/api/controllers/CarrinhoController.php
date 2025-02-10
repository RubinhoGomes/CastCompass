<?php

namespace backend\modules\api\controllers;

use yii\filters\auth\QueryParamAuth;
use yii\rest\ActiveController;
use yii\filters\ContentNegotiator;
use yii\web\Response;
use yii\filters\auth\HttpBasicAuth;
use backend\modules\api\components\CustomAuth;
use common\models\User;
use common\models\Carrinho;
use common\models\ItemsCarrinho;
use Yii;

/**
 * Default controller for the `api` module
 */
class CarrinhoController extends ActiveController
{
    public $modelClass = 'common\models\Carrinho';

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

    public function actionCarregarcomprafinal() {

    }

    public function actionProdutos($id) {
        $carrinho = Carrinho::findOne(['profileID' => $id]);

        if (!$carrinho) {
            return ['error' => 'Carrinho não encontrado.'];
        }

        $items = ItemsCarrinho::find()->where(['carrinhoID' => $carrinho->id])->all();

        if (empty($items)) {
            return ['message' => 'O carrinho está vazio.'];
        }

        $result = [];
        foreach ($items as $item) {
            $result[] = [
                'id' => $item->id,
                'produtoID' => $item->produtoID,
                'nome' => $item->nome,
                'quantidade' => $item->quantidade,
                'valorTotal' => $item->valorTotal,
                'imagem' => $item->getImagem(),
            ];
        }

        return $result;
    }

    public function actionAddproduto($profileID, $produtoID) {
        $carrinho = Carrinho::findOne(['profileID' => $profileID]);
        $quantidade = 1;

        if (!$carrinho) {
            return ['error' => 'Carrinho não encontrado.'];
        }

        $item = ItemsCarrinho::findOne(['carrinhoID' => $carrinho->id, 'produtoID' => $produtoID]);

        if ($item) {
            $item->quantidade += $quantidade;
            $item->valorTotal += $item->produto->preco * $quantidade;
        } else {
            $item = new ItemsCarrinho();
            $item->carrinhoID = $carrinho->id;
            $item->produtoID = $produtoID;
            $item->nome = $item->produto->nome;
            $item->quantidade = $quantidade;
            $item->valorTotal = $item->produto->preco * $quantidade;
        }

        if ($item->save()) {
            $this->atualizarCarrinho($carrinho);
            return ['success' => 'Item adicionado ao carrinho.'];
        }

        return ['error' => 'Erro ao adicionar item ao carrinho.'];
    }

    public function actionRemoverproduto($profileID, $produtoID) {
        $carrinho = Carrinho::findOne(['profileID' => $profileID]);

        if (!$carrinho) {
            return ['error' => 'Carrinho não encontrado.'];
        }

        $item = ItemsCarrinho::findOne(['carrinhoID' => $carrinho->id, 'produtoID' => $produtoID]);

        if (!$item) {
            return ['error' => 'Item não encontrado no carrinho.'];
        }

        if ($item->delete()) {
            $this->atualizarCarrinho($carrinho);
            return ['success' => 'Item removido do carrinho.'];
        }

        return ['error' => 'Erro ao remover item do carrinho.'];
    }

    private function atualizarCarrinho($carrinho) {
        $items = ItemsCarrinho::find()->where(['carrinhoID' => $carrinho->id])->all();

        $carrinho->quantidade = 0;
        $carrinho->valorTotal = 0;

        foreach ($items as $item) {
            $carrinho->quantidade += $item->quantidade;
            $carrinho->valorTotal += $item->valorTotal;
        }

        $carrinho->save();
    }

    public function actionCriarcarrinho() {
        $user = User::findOne(['auth_key' => Yii::$app->request->get('token')]);

        if (!$user) {
            return [
                'status' => 'error',
                'message' => 'Usuário não autenticado.',
            ];
        }

        $profile = \common\models\Profile::findOne(['userID' => $user->id]);

        if (!$profile) {
            return [
                'status' => 'error',
                'message' => 'Perfil não encontrado.',
            ];
        }

        $carrinho = new $this->modelClass;
        $carrinho->profileID = $profile->id;
        $carrinho->valorTotal = 0;
        $carrinho->quantidade = 0;

        if ($carrinho->save()) {
            return [
                'status' => 'success',
                'message' => 'Carrinho criado com sucesso.',
                'data' => $carrinho,
            ];
        } else {
            return [
                'status' => 'error',
                'message' => 'Erro ao criar o carrinho.',
                'errors' => $carrinho->errors,
            ];
        }
    }

    public function actionCarrinho($profileID) {
        $carrinho = Carrinho::findOne(['profileID' => $profileID]);

        if (!$carrinho) {
            return ['error' => 'Carrinho não encontrado.'];
        }

        $itens = ItemsCarrinho::find()->where(['carrinhoID' => $carrinho->id])->all();

        if (empty($itens)) {
            return ['message' => 'O carrinho está vazio.'];
        }

        $itensData = [];
        foreach ($itens as $item) {
            $itensData[] = [
                'id' => $item->id,
                'produtoID' => $item->produtoID,
                'nome' => $item->nome,
                'quantidade' => $item->quantidade,
                'valorTotal' => $item->valorTotal,
                'imagem' => 'http://172.22.21.205/CastCompass/PLSI/CastCompass/frontend/web/uploads/' . $item->getImagem($item->produtoID),
            ];
        }

        $data = [
            'id' => $carrinho->id,
            'profileID' => $carrinho->profileID,
            'valorTotal' => $carrinho->valorTotal,
            'quantidade' => $carrinho->quantidade,
            'items' => $itensData,
        ];

        return $data;
    }

    private function getImagem($produtoID) {
        $imagem = Imagem::findOne(['produtoID' => $produtoID]);
        return $imagem->filename;
    }

    public function actionAumentarquantidade() {
        $item = ItemsCarrinho::findOne(Yii::$app->request->post('id'));
        $item->quantidade += 1;
        $item->valorTotal += $item->produto->preco;

        if ($item->save()) {
            $carrinho = Carrinho::findOne($item->carrinhoID);
            $this->atualizarCarrinho($carrinho);
            return ['success' => 'Quantidade aumentada com sucesso.'];
        }

        return ['error' => 'Erro ao aumentar quantidade.'];
    }

    public function actionDiminuirquantidade() {
        $item = ItemsCarrinho::findOne(Yii::$app->request->post('id'));
        $item->quantidade -= 1;
        $item->valorTotal -= $item->produto->preco;

        if ($item->save()) {
            $carrinho = Carrinho::findOne($item->carrinhoID);
            $this->atualizarCarrinho($carrinho);
            return ['success' => 'Quantidade diminuída com sucesso.'];
        }

        return ['error' => 'Erro ao diminuir quantidade.'];
    }
}
