<?php

namespace backend\modules\api\controllers;

use common\models\Carrinho;
use common\models\Fatura;
use common\models\Profile;
use yii\filters\auth\QueryParamAuth;
use yii\rest\ActiveController;
use yii\filters\ContentNegotiator;
use yii\web\Response;
use yii\filters\auth\HttpBasicAuth;
use backend\modules\api\components\CustomAuth;


/**
 * Default controller for the `api` module
 */
class FaturaController extends ActiveController
{
    public $modelClass = 'common\models\Fatura';

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

    public function actionCount() {
        $metodosmodel = new $this->modelClass;
        $recs = $metodosmodel::find()->all();
        return ['count' => count($recs)];
    }

    public function actionFaturascliente($id) {
        $profile = Profile::findOne($id);
        $carrinho = Carrinho::findOne(['profileID' => $profile->id]);
        $faturas = $carrinho->faturas;

        $dados = [];

        foreach ($faturas as $fatura) {
            $dados[] = [
                'id' => $fatura->id,
                'valorTotal' => $fatura->valorTotal,
                'ivaTotal' => $fatura->ivaTotal,
                'metodoExpedicaoID' => $fatura->metodoExpedicao->nome,
                'metodoPagamentoID' => $fatura->metodoPagamento->nome,
                'data' => $fatura->data,
                'estado' => $fatura->estado,
            ];
        }

        return $dados;
    }

}
