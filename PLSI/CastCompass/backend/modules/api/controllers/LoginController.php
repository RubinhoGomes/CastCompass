<?php

namespace backend\modules\api\controllers;


use yii\filters\auth\HttpBasicAuth;
use yii\rest\Controller;
use yii\web\BadRequestHttpException;
use yii\web\ForbiddenHttpException;
use yii\web\ServerErrorHttpException;
use yii\web\UnprocessableEntityHttpException;
use common\models\User;
class LoginController extends Controller
{
    public $user;

    public function behaviors()
    {

        $behaviors = parent::behaviors();

        $behaviors['authenticator'] = [
            'class' => HttpBasicAuth::className(),
            'auth' => [$this, 'auth'],
            'only' => ['login'],
        ];

        return $behaviors;
    }

    public function auth($username, $password)
    {
        $user = User::findByUsername($username);
        if ($user && $user->validatePassword($password)) {
            $this->user = $user;
            return $user;
        }
        throw new ForbiddenHttpException('No authentication'); //403
    }


    public function actionLogin()
    {
        if ($this->user->profile) {
            return [
                'id' => $this->user->id,
                'idProfile' => $this->user->profile->id,
                'username' => $this->user->username,
                'email' => $this->user->email,
                'token' => $this->user->auth_key,
            ];
        } else {
            throw new BadRequestHttpException('Perfil não foi encontrado.');
        }
    }

}
