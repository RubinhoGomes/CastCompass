<?php

namespace backend\modules\api\controllers;

use yii\rest\ActiveController;

/**
 * Default controller for the `api` module
 */
class ProdutoController extends ActiveController
{
    public $modelClass = 'common\models\Produto';

    public function actionCount()
    {
        $produtosmodel = new $this->modelClass;
        $recs = $produtosmodel::find()->all();
        return ['count' => count($recs)];
    }
}

