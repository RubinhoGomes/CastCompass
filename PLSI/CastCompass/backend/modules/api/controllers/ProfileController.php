<?php

namespace backend\modules\api\controllers;

use common\models\Profile;
use common\models\User;
use yii\filters\auth\QueryParamAuth;
use yii\rest\ActiveController;
use yii\filters\ContentNegotiator;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\filters\auth\HttpBasicAuth;
use backend\modules\api\components\CustomAuth;


/**
 * Default controller for the `api` module
 */
class ProfileController extends ActiveController
{
    public $modelClass = 'common\models\Profile';

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
        $profilesmodel = new $this->modelClass;
        $recs = $profilesmodel::find()->all();
        return ['count' => count($recs)];
    }

    public function actionProcurarnomes($nome)
    {
        $profiles = $this->modelClass::find()
            ->where(['nome' => $nome])->all();
        return $profiles;
    }
    
    public function actionUtilizador($id) {
        $utilizador = $this->modelClass::findOne($id);

        $data = [
          'id' => $utilizador->user->id,
          'idProfile' => $utilizador->id,
            'nome' => $utilizador->nome,
            'username' => $utilizador->user->username,
            'email' => $utilizador->user->email,
            'nif' => $utilizador->nif,
            'dtaNascimento' => $utilizador->dtaNascimento,
            'genero' => $utilizador->genero,
            'telemovel' => $utilizador->telemovel,
            'morada' => $utilizador->morada,
            'token' => $utilizador->user->auth_key,
        ];

        return $data;
    }

    public function actionAtualizar($id) {
        $profile = Profile::findOne($id);

        $profile->nome = \Yii::$app->request->post('nome');
        $profile->nif = \Yii::$app->request->post('nif');
        $profile->dtaNascimento = \Yii::$app->request->post('dtaNascimento');
        $profile->genero = \Yii::$app->request->post('genero');
        $profile->telemovel = \Yii::$app->request->post('telemovel');
        $profile->morada = \Yii::$app->request->post('morada');
        $profile->save();
        return $profile;
    }

    public function actionApagar($id) {
        $profile = Profile::findOne($id);
        $utilizador = User::findOne($profile->userID);

        $profile->delete();
        $utilizador->delete();
        return $utilizador;
    }
}
