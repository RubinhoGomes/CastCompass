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

    public function actionAdicionarremoverfavorito($produtoID)
    {
        $user = \Yii::$app->user->identity;

        if (!$user) {
            return [
                'success' => false,
                'message' => 'Usuário não autenticado.',
            ];
        }

        $profile = \common\models\Profile::findOne(['userID' => $user->id]);

        if (!$profile) {
            return [
                'success' => false,
                'message' => 'Perfil do usuário não encontrado.',
            ];
        }

        $model = $this->modelClass::find()
            ->where(['produtoID' => $produtoID, 'profileID' => $profile->id])
            ->one();

        if ($model) {
            $model->delete();
            return [
                'success' => true,
                'message' => 'Favorito removido com sucesso.',
            ];
        } else {
            $model = new \common\models\Favorito();
            $model->profileID = $profile->id;
            $model->produtoID = $produtoID;

            if ($model->save()) {
                return [
                    'success' => true,
                    'message' => 'Favorito adicionado com sucesso.',
                ];
            } else {
                return [
                    'success' => false,
                    'message' => 'Erro ao adicionar favorito.',
                    'errors' => $model->errors,
                ];
            }
        }
    }
}
