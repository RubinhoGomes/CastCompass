<?php

namespace backend\modules\api\controllers;

use yii\rest\ActiveController;
use yii\web\Response;
use yii\filters\ContentNegotiator;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\QueryParamAuth;
use backend\modules\api\components\CustomAuth;


/**
 * Default controller for the `api` module
 */
class ProdutoController extends ActiveController
{
    public $modelClass = 'common\models\Produto';

    public function behaviors() {
        $behaviors = parent::behaviors();


        $behaviors['contentNegotiator'] = [
            'class' => ContentNegotiator::class,
            'formats' => [
                'application/json' => Response::FORMAT_JSON,
            ],
        ];
        return $behaviors;
    }

   public function actionAll() {

        $produtos = $this->modelClass::find()->all();

        foreach ($produtos as $produto) {

          $imagem = Imagem::findOne(['produtoID' => $produto->id]);

          $data[] = [
            'id' => $produto->id,
            'nome' => $produto->nome,
            'marca' => $produto->marca,
            'preco' => $produto->preco,
            'stock' => $produto->stock,
            'iva' => $produto->iva->valor * 100,
            'descricao' => $produto->descricao,
            'categoria' => $produto->categoria->nome,
            'imagem' => '172.22.21.205/CastCompass/PLSI/CastCompass/frontend/web/uploads/' . $imagem->filename,
          ];
        }

        return $data;
    }

    public function actionProduto($id) {
      $produto = $this->modelClass::findOne($id);
  
      $imagem = Imagem::findOne(['produtoID' => $id]);

      $data = [
        'id' => $produto->id,
        'nome' => $produto->nome,
        'marca' => $produto->marca,
        'preco' => $produto->preco,
        'stock' => $produto->stock,
        'iva' => $produto->iva->valor * 100,
        'descricao' => $produto->descricao,
        'categoria' => $produto->categoria->nome,
        'imagem' => 'http://172.22.21.205/CastCompass/PLSI/CastCompass/frontend/web/uploads/' . $imagem->filename,
      ];
 
      return $data;
    }
 
    public function actionCountproducts($categoriaID){
        $count = $this->modelClass::find()
            ->where(['categoriaID' => $categoriaID])
            ->count();

        return ['Numero produtos da categoria' => $count];

    }

    public function actionCount()
    {
        $produtosmodel = new $this->modelClass;
        $recs = $produtosmodel::find()->all();
        return ['count' => count($recs)];
    }

    public function actionProcurarnomes($nome)
    {
        $produtos = $this->modelClass::find()
            ->where(['nome' => $nome])->all();
        return $produtos;
    }

    public function actionFiltrarporcategoria($categoriaid){
        $produtos = $this->modelClass::find()
            ->where(['categoriaID' => $categoriaid])->all();
        return $produtos;
    }

    public function actionPreco($id)
    {
        $rec = $this->modelClass::find()->select(['preco'])
            ->where(['id' => $id])->one(); //objeto json
        return $rec;
    }


    public function actionMarca($id)
    {
        $rec = $this->modelClass::find()->select(['marca'])
            ->where(['id' => $id])->one(); //objeto json
        return $rec;
    }


    public function actionStock($id)
    {
        $rec = $this->modelClass::find()->select(['stock'])
            ->where(['id' => $id])->one(); //objeto json
        return $rec;
    }

    public function actionNome($id)
    {
        $rec = $this->modelClass::find()->select(['nome'])
            ->where(['id' => $id])->one(); //objeto json
        return $rec;
    }

    public function actionDescricao($id)
    {
        $rec = $this->modelClass::find()->select(['descricao'])
            ->where(['id' => $id])->one(); //objeto json
        return $rec;
    }


}

