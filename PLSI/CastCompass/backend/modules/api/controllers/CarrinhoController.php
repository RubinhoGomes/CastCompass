<?php

namespace backend\modules\api\controllers;

use yii\filters\auth\QueryParamAuth;
use yii\rest\ActiveController;
use yii\filters\ContentNegotiator;
use yii\web\Response;
use yii\filters\auth\HttpBasicAuth;
use backend\modules\api\components\CustomAuth;


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


    public function actionCount()
    {
        $metodosmodel = new $this->modelClass;
        $recs = $metodosmodel::find()->all();
        return ['count' => count($recs)];
    }

    public function actionCriarcarrinho()
    {
        $user = \Yii::$app->user->identity;

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


}
