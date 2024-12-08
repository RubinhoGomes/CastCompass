<?php

namespace backend\modules\api\controllers;

use yii\rest\ActiveController;

/**
 * Default controller for the `api` module
 */
class IvaController extends ActiveController
{
    public $modelClass = 'common\models\Iva';

    public function actionCount()
    {
        $ivasmodel = new $this->modelClass;
        $recs = $ivasmodel::find()->all();
        return ['count' => count($recs)];
    }
}
