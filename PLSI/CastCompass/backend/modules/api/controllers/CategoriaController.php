<?php

namespace backend\modules\api\controllers;

use yii\rest\ActiveController;

/**
 * Default controller for the `api` module
 */
class CategoriaController extends ActiveController
{
    public $modelClass = 'common\models\Categoria';

    public function actionCount()
    {
        $categoriasmodel = new $this->modelClass;
        $recs = $categoriasmodel::find()->all();
        return ['count' => count($recs)];
    }
}
