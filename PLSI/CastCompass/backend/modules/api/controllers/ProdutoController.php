<?php

namespace backend\modules\api\controllers;

use yii\rest\ActiveController;
use yii\web\Response;
use yii\filters\ContentNegotiator;


/**
 * Default controller for the `api` module
 */
class ProdutoController extends ActiveController
{
    public $modelClass = 'common\models\Produto';

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
        $produtosmodel = new $this->modelClass;
        $recs = $produtosmodel::find()->all();
        return ['count' => count($recs)];
    }
}

