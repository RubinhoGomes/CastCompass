<?php

namespace frontend\controllers;
use Yii;
use yii\web\Controller;
use common\models\Favorito;
use yii\web\NotFoundHttpException;
class  FavoritosController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }


    /* This functons adds a product to the user's favourites list.
     * Also, if that products already exists, delete it.
     * TODO: Change the logic. And Change the Shop, Too messy for showing differents Icons
     *
     */
    public function actionAdd($produtoID)
    {
        $favoritoNovo = new Favorito();

        if (Yii::$app->user->isGuest) {
            return $this->redirect(['site/login']);
        }

        $profileID = Yii::$app->user->identity->profile->id;

        $favorito = Favorito::find()
            ->where(['profileID' => $profileID, 'produtoID' => $produtoID])
            ->one();

        if ($favorito) {
          if ($favorito->delete()){
            Yii::$app->session->setFlash('success', 'Produto removido dos favoritos com sucesso!');
          }
        }
        else {
          $favoritoNovo->profileID = $profileID;
          $favoritoNovo->produtoID = $produtoID;
        }

        if($favoritoNovo->produtoID != null) {
          if ($favoritoNovo->save()) {
            Yii::$app->session->setFlash('success', 'Produto adicionado aos favoritos com sucesso!');
          } else {
            Yii::$app->session->setFlash('error', 'Erro ao adicionar produto aos favoritos');
          }
        }

        return $this->redirect(Yii::$app->request->referrer ?: ['site/shop']);
    }

    
}
