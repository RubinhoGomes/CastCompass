<?php

namespace backend\modules\api\controllers;

use yii\filters\auth\QueryParamAuth;
use yii\filters\contentNegotiator;
use yii\rest\ActiveController;
use yii\web\Response;
use yii\filters\auth\HttpBasicAuth;
use backend\modules\api\components\CustomAuth;

/**
 * Default controller for the `api` module
 */
class UserController extends ActiveController
{
    public $modelClass = 'common\models\User';

    public function behaviors()
    {
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
        $usersmodel = new $this->modelClass;
        $recs = $usersmodel::find()->all();
        return ['count' => count($recs)];
    }
}
