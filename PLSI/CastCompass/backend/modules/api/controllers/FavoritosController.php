<?php

namespace backend\modules\api\controllers;

use yii\filters\auth\QueryParamAuth;
use yii\rest\ActiveController;
use yii\filters\ContentNegotiator;
use yii\web\Response;
use yii\filters\auth\HttpBasicAuth;
use backend\modules\api\components\CustomAuth;
use common\models\Produto;
use common\models\Imagem;
use Yii;

/**
 * Default controller for the `api` module
 */
class FavoritosController extends ActiveController
{
  public $modelClass = 'common\models\Favorito';

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

  public function actionProfilefavoritos($profileID)
  {
    if (!$profileID) {
      throw new NotFoundHttpException('Profile ID não fornecido');
    }

    $favoritos = \common\models\Favorito::find()
      ->where(['profileID' => $profileID])
      ->all();

    if (!$favoritos) {
      return ['message' => 'Nenhum favorito encontrado para este perfil.'];
    }

    $data = [];

    foreach ($favoritos as $favorito) {
      $produto = Produto::findOne($favorito->produtoID);
      $imagem = Imagem::findOne(['produtoID' => $produto->id]);

      if ($produto) {
        $data[] = [
          'id' => $favorito->id,
          'idProduto' => $produto->id,
          'idUtilizador' => $favorito->profileID,
          'nome' => $produto->nome,
          'marca' => $produto->marca,
          'descricao' => $produto->descricao,
          'preco' => $produto->preco,
          'categoria' => $produto->categoria->nome,
          'imagem' => 'http://172.22.21.205/CastCompass/PLSI/CastCompass/frontend/web/uploads/' . $imagem->filename,
        ];
      }
    }

    return $data;
  }

  public function actionCountfavoritos($profileID){
    $count = $this->modelClass::find()
                  ->where(['profileID' => $profileID])
                  ->count();

    return ['Numero de favoritos do profile' => $count];

  }

    public function actionAdicionar($produtoID) {
        $user = \Yii::$app->user->identity;

        if (!$user) {
            return [
                'success' => false,
                'message' => 'Usuário não autenticado.',
            ];
        }

        $profile = \common\models\Profile::findOne(['userID' => $user->id]);

        if (!$profile) {
            return [
                'success' => false,
                'message' => 'Perfil do usuário não encontrado.',
            ];
        }

        $existingFavorite = $this->modelClass::findOne(['produtoID' => $produtoID, 'profileID' => $profile->id]);

        if ($existingFavorite) {
            return [
                'success' => false,
                'message' => 'O produto já está na lista de favoritos.',
            ];
        }

        $model = new \common\models\Favorito();
        $model->profileID = $profile->id;
        $model->produtoID = $produtoID;

        if ($model->save()) {
            return [
                'success' => true,
                'message' => 'Favorito adicionado com sucesso.',
            ];
        }

        return [
            'success' => false,
            'message' => 'Erro ao adicionar favorito.',
            'errors' => $model->errors,
        ];
    }

    public function actionRemover($profileID,$produtoID) {

        $profile = \common\models\Profile::findOne(['id' => $profileID]);

        if (!$profile) {
            return ['error' => 'Perfil do usuário não encontrado.'];
        }

        $favorito = $this->modelClass::findOne(['profileID' => $profileID, 'produtoID' => $produtoID]);

        if (!$favorito) {
            return ['error' => 'Favorito não encontrado.'];
        }

        if ($favorito->delete()) {
            return ['success' => 'Favorito removido com sucesso.'];
        }

        return ['error' => 'Erro ao remover favorito.'];
    }
}
