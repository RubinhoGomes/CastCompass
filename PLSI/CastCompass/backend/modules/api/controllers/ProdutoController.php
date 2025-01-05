<?php

namespace backend\modules\api\controllers;

use yii\rest\ActiveController;
use yii\web\Response;
use yii\filters\ContentNegotiator;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\QueryParamAuth;


/**
 * Default controller for the `api` module
 */
class ProdutoController extends ActiveController
{
    public $modelClass = 'common\models\Produto';

    public function behaviors() {
        $behaviors = parent::behaviors();

        $behaviors['authenticator'] = ['class' =>
            HttpBasicAuth::className(),
            'auth' => [$this, 'auth'],
        ];

        $behaviors['contentNegotiator'] = [
            'class' => ContentNegotiator::class,
            'formats' => [
                'application/json' => Response::FORMAT_JSON,
            ],
        ];
        return $behaviors;
    }

    public function auth($username, $password)
    {
        $user = \common\models\User::findByUsername($username);
        if ($user && $user->validatePassword($password))
        {
            return $user;
        }
        throw new \yii\web\ForbiddenHttpException('No authentication'); //403
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

