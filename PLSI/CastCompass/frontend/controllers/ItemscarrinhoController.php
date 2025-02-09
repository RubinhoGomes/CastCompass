<?php

namespace frontend\controllers;

use Yii;
use common\models\Itemscarrinho;
use common\models\Produto;
use common\models\Carrinho;
use common\models\Profile;


class ItemsCarrinhoController extends \yii\web\Controller
{
    public function actionIndex() {
        return $this->render('index');
    }

    public function getProfile($id) {
        return Profile::findOne(['userID' => $id])->id;
    }

    public function actionCreate($produtoId) {
        if (Yii::$app->user->isGuest) {
            Yii::$app->session->setFlash('error', 'Tens de estar logado para adicionar produtos ao carrinho!');
            return $this->redirect(['site/login']);
        }

        $profile = Profile::findOne(['userID' => Yii::$app->user->id]);
        $produto = Produto::findOne($produtoId);
        $carrinho = Carrinho::findOne(['profileID' => $this->getProfile(Yii::$app->user->id)]);

        if ($carrinho === NULL) {
            if ($this->CreateCarrinho($profile->id)) {
                $carrinho = Carrinho::findOne(['profileID' => $profile->id]);
            }
        }

        if ($this->checkExists($produtoId, $carrinho)) {
            $item = Itemscarrinho::findOne(['produtoID' => $produtoId, 'carrinhoID' => $carrinho->id]);
            $item->quantidade += 1;
            $item->valorTotal += $produto->preco;
            $item->save();

            $carrinho->valorTotal += $produto->preco;
            $carrinho->quantidade += 1;
            $carrinho->save();
        
            Yii::$app->session->setFlash('success', 'Produto ja existe no carrinho, foi adicionado mais uma quantidade ao produto com sucesso!');

        } else {
            $item = new Itemscarrinho();
            $item->produtoID = $produtoId;
            $item->carrinhoID = $carrinho->id;
            $item->nome = $produto->nome;
            $item->quantidade = 1;
            $item->valorTotal = $produto->preco;
            $item->save();

            $carrinho->valorTotal += $produto->preco;
            $carrinho->quantidade += 1;
            $carrinho->save();

            Yii::$app->session->setFlash('success', 'Produto adicionado ao carrinho com sucesso!');

        }

        return $this->redirect(['site/shop']);
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

    public function checkExists($produtoId, $carrinho) {
        $itens = Itemscarrinho::findAll(['carrinhoID' => $carrinho->id, 'produtoID' => $produtoId]);
        if ($itens != NULL) {
            return true;
        }

        return false;
    }

    public function actionAddQuant($produtoId) {
        $produto = Produto::findOne($produtoId);
        $carrinho = Carrinho::findOne(['profileID' => $this->getProfile(Yii::$app->user->id)]);
        $item = Itemscarrinho::findOne(['produtoID' => $produtoId, 'carrinhoID' => $carrinho->id]);
        $item->quantidade += 1;
        $item->valorTotal += $produto->preco;
        $item->save();

        $carrinho->valorTotal += $produto->preco;
        $carrinho->quantidade += 1;
        $carrinho->save();

        Yii::$app->session->setFlash('success', 'Quantidade do produto aumentada com sucesso!');

        return $this->redirect(['carrinho/index']);
    }

    public function actionSubQuant($produtoId) {
        $produto = Produto::findOne($produtoId);
        $carrinho = Carrinho::findOne(['profileID' => $this->getProfile(Yii::$app->user->id)]);
        $item = Itemscarrinho::findOne(['produtoID' => $produtoId, 'carrinhoID' => $carrinho->id]);

        if ($item->quantidade > 1) {
            $item->quantidade -= 1;
            $item->valorTotal -= $produto->preco;
            $item->save();

            $carrinho->valorTotal -= $produto->preco;
            $carrinho->quantidade -= 1;
            $carrinho->save();

            Yii::$app->session->setFlash('success', 'Quantidade do produto diminuida com sucesso!');

        } else {
            $carrinho->valorTotal -= $item->valorTotal;
            $carrinho->quantidade -= 1;

            $item->delete();
            $carrinho->save();

            Yii::$app->session->setFlash('success', 'Produto removido do carrinho com sucesso!');
        }

        return $this->redirect(['carrinho/index']);
    }

    public function actionRemove($produtoId) {
        $produto = Produto::findOne($produtoId);
        $carrinho = Carrinho::findOne(['profileID' => $this->getProfile(Yii::$app->user->id)]);
        $item = Itemscarrinho::findOne(['produtoID' => $produtoId, 'carrinhoID' => $carrinho->id]);
        if ($item->delete() && $this->atualizarCarrinho($carrinho, $item->valorTotal, $item->quantidade)) {
            Yii::$app->session->setFlash('success', 'Produto removido do carrinho com sucesso!');
        } else {
            Yii::$app->session->setFlash('error', 'Erro ao remover produto do carrinho!');
        }

        return $this->redirect(['carrinho/index']);
    }

    public function atualizarCarrinho($carrinho, $valor, $quantidade) {
        $carrinho->valorTotal -= $valor;
        $carrinho->quantidade -= $quantidade;
        return $carrinho->save();
    }

    public function actionAdicionarProduto($idProduto, $quantidade){

      $userId = Yii::$app->user->id;

      $profileId = Profile::findOne(['userID' => $userId])->id;

      $carrinho = Carrinho::findOne(['profileID' => $profileId]);

      if($carrinho == NULL){
        if($this->createCarrinho($userId)){
          $carrinho = Carrinho::findOne(['profileID' => $profileId]);
        }
      }
      
      $produto = Produto::findOne($idProduto);
  
      if($this->checkExists($idProduto, $carrinho)){
        $item = Itemscarrinho::findOne(['produtoID' => $idProduto, 'carrinhoID' => $carrinho->id]);
        $item->quantidade += $quantidade;
        $item->valorTotal += $produto->preco * $quantidade;
        $item->save();
  
        $carrinho->valorTotal += $produto->preco * $quantidade;
        $carrinho->quantidade += $quantidade;
        $carrinho->save();
  
        Yii::$app->session->setFlash('success', 'Produto ja existe no carrinho, foi adicionado mais ' . $quantidade . ' quantidade(s) ao produto com sucesso!');
  
      } else {
        $item = new Itemscarrinho();
        $item->produtoID = $idProduto;
        $item->carrinhoID = $carrinho->id;
        $item->nome = $produto->nome;
        $item->quantidade = $quantidade;
        $item->valorTotal = $produto->preco * $quantidade;
        $item->save();
  
        $carrinho->valorTotal += $produto->preco * $quantidade;
        $carrinho->quantidade += $quantidade;
        $carrinho->save();
  
        Yii::$app->session->setFlash('success', 'Produto adicionado ao carrinho com sucesso!');
  
      }

      return $this->redirect(['site/shop']);

    }

}
