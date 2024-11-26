<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use frontend\models\EditProfileForm;
use common\models\Profile;

class UserController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionEditProfile()
    {
        $profile = Profile::findOne(['userID' => Yii::$app->user->id]);

        $model = new EditProfileForm($profile);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Perfil atualizado com sucesso.');
            return $this->redirect(['user/index']);
        }

        return $this->render('editar', [
            'model' => $model,
        ]);
    }

}
