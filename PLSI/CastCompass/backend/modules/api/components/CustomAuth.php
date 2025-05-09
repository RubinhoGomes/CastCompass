<?php

namespace backend\modules\api\components;

use Yii;
use common\models\User;
use yii\filters\auth\AuthMethod;
use yii\web\ForbiddenHttpException;

class CustomAuth extends AuthMethod
{
    public function authenticate($user, $request, $response)
    {
        $token = $request->getQueryParam('token');
        if (!empty($token)) {
            $identity = User::findIdentityByAccessToken($token);
            if ($identity) {
                return $identity;
            }
            throw new ForbiddenHttpException('No authentication');
        }
        throw new ForbiddenHttpException('Sem Token');
    }
}
