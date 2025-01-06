<?php

namespace backend\modules\api\controllers;

use yii\filters\auth\QueryParamAuth;
use yii\rest\ActiveController;
use yii\filters\ContentNegotiator;
use yii\web\Response;
use yii\filters\auth\HttpBasicAuth;
use backend\modules\api\components\CustomAuth;
use common\models\Produto;

/**
 * Default controller for the `api` module
 */
class FavoritosController extends ActiveController
{
    public $modelClass = 'common\models\Favorito';

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


    public function authf($username, $password)
    {
        $user = \common\models\User::findByUsername($username);
        if ($user && $user->validatePassword($password))
        {
            return $user;
        }
        throw new \yii\web\ForbiddenHttpException('No authentication'); //403
    }
    public function actionCount()
    {
        $metodosmodel = new $this->modelClass;
        $recs = $metodosmodel::find()->all();
        return ['count' => count($recs)];
    }

    public function actionProfilefavoritos($profileID)
    {
        if (!$profileID) {
            throw new NotFoundHttpException('Profile ID não fornecido');
        }

        $favoritos = \common\models\Favorito::find()
            ->where(['profileID' => $profileID])
            ->all();

        if (!$favoritos) {
            return ['message' => 'Nenhum favorito encontrado para este perfil.'];
        }

        return $favoritos;
    }

    public function actionCountfavoritos($profileID){
        $count = $this->modelClass::find()
            ->where(['profileID' => $profileID])
            ->count();

        return ['Numero de favoritos do profile' => $count];

    }

    public function actionAdicionarfavorito()
    {
        $user = \Yii::$app->user->identity;
        if (!$user) {
            throw new \yii\web\ForbiddenHttpException('Usuário não autenticado.');
        }

        $profile = \common\models\Profile::findOne(['userID' => $user->id]);
        if (!$profile) {
            throw new \yii\web\NotFoundHttpException('Perfil não encontrado para o usuário.');
        }

        $request = \Yii::$app->request;
        $produtoID = $request->post('produtoID');

        if (!$produtoID) {
            return [
                'status' => 'error',
                'message' => 'ID do produto não fornecido.',
            ];
        }

        $favoritoExistente = \common\models\Favorito::find()
            ->where(['profileID' => $profile->id, 'produtoID' => $produtoID])
            ->one();

        if ($favoritoExistente) {
            return [
                'status' => 'error',
                'message' => 'Este item já está nos favoritos.',
            ];
        }

        $favorito = new $this->modelClass;
        $favorito->profileID = $profile->id;
        $favorito->$produtoID = $produtoID;

        if ($favorito->save()) {
            return [
                'status' => 'success',
                'message' => 'Produto adicionado aos favoritos com sucesso.',
                'data' => $favorito,
            ];
        } else {
            return [
                'status' => 'error',
                'message' => 'Erro ao adicionar o item aos favoritos.',
                'errors' => $favorito->errors,
            ];
        }
    }
}
