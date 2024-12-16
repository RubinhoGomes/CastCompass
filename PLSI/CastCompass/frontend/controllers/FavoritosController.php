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

    public function actionAdd($produtoID)
    {
        $favorito = new Favorito();

        if (Yii::$app->user->isGuest) {
            return $this->redirect(['site/login']);
        }

        $profileID = Yii::$app->user->identity->profile->id;

        $existe = Favorito::find()
            ->where(['profileID' => $profileID, 'produtoID' => $produtoID])
            ->one();

        if ($existe) {
            Yii::$app->session->setFlash('info', 'O produto já está nos seus favoritos.');
        }else{
            $favorito->profileID = $profileID;
            $favorito->produtoID = $produtoID;

            if ($favorito->save()) {
                Yii::$app->session->setFlash('success', 'Produto adicionado aos favoritos com sucesso!');
            } else {
                Yii::$app->session->setFlash('error', 'Não foi possível adicionar o produto aos favoritos.');
            }

        }
        return $this->redirect(Yii::$app->request->referrer ?: ['site/shop']);
    }

    public function actionRemove($id)
    {
        $favorito = Favorito::findOne($id);

        if ($favorito && $favorito->profileID === Yii::$app->user->identity->profile->id) {
            $favorito->delete();
        }

        return $this->redirect(['favoritos/index']);
    }

}
