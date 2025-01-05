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
class ProfileController extends ActiveController
{
    public $modelClass = 'common\models\Profile';

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


}
