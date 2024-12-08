<?php

namespace backend\modules\api\controllers;

use yii\rest\ActiveController;

/**
 * Default controller for the `api` module
 */
class ProfileController extends ActiveController
{
    public $modelClass = 'common\models\Profile';

    public function actionCount()
    {
        $profilesmodel = new $this->modelClass;
        $recs = $profilesmodel::find()->all();
        return ['count' => count($recs)];
    }
}
