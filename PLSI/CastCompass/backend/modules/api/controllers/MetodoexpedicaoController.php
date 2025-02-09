<?php

namespace backend\modules\api\controllers;

use common\models\Metodoexpedicao;
use yii\filters\auth\QueryParamAuth;
use yii\rest\ActiveController;
use yii\filters\ContentNegotiator;
use yii\web\Response;
use yii\filters\auth\HttpBasicAuth;
use backend\modules\api\components\CustomAuth;


/**
 * Default controller for the `api` module
 */
class MetodoexpedicaoController extends ActiveController
{
    public $modelClass = 'common\models\Metodoexpedicao';

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

    public function actionCount()
    {
        $metodosmodel = new $this->modelClass;
        $recs = $metodosmodel::find()->all();
        return ['count' => count($recs)];
    }

    public function actionMetodosexpedicao()
    {
        $metodoexpedicao = Metodoexpedicao::find()->all();

        return $metodoexpedicao;
    }
}
