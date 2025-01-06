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
class MetodopagamentoController extends ActiveController
{
    public $modelClass = 'common\models\Metodopagamento';

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
}
