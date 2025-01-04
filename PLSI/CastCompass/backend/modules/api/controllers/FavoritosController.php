<?php

namespace backend\modules\api\controllers;

use yii\filters\auth\QueryParamAuth;
use yii\rest\ActiveController;
use yii\filters\ContentNegotiator;
use yii\web\Response;
use yii\filters\auth\HttpBasicAuth;


/**
 * Default controller for the `api` module
 */
class FavoritosController extends ActiveController
{
    public $modelClass = 'common\models\Favorito';

    public function behaviors() {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => QueryParamAuth::className(),
            'tokenParam' => 'access-token',
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
}
