<?php

use common\models\Profile;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var \frontend\models\SignupForm $model */
/** @var common\models\Profile $model */

$this->title = 'Perfil de ' . Yii::$app->user->identity->profile->nome;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profile-index">
    <h1 class="text-center mb-5"><?= $this->title ?></h1>

    <div class="container-fluid pb-5">
        <div class="row justify-content-center px-xl-5">
            <div class="col-lg-7 h-auto mb-30">
                <div class="h-100 bg-light p-4 shadow rounded">
                    <h3 class="text-center mb-4">Detalhes do Perfil</h3>
                    <div class="profile-details">
                        <div class="d-flex align-items-center mb-3">
                            <i class="fas fa-user-circle fa-2x text-primary mr-3"></i>
                            <h5 class="mb-0"><?= Yii::$app->user->identity->username ?></h5>
                        </div>
                        <div class="d-flex align-items-center mb-3">
                            <i class="fas fa-envelope fa-2x text-primary mr-3"></i>
                            <h5 class="mb-0"><?= Yii::$app->user->identity->email ?></h5>
                        </div>
                        <div class="d-flex align-items-center mb-3">
                            <i class="fas fa-id-card fa-2x text-primary mr-3"></i>
                            <h5 class="mb-0"><?= Yii::$app->user->identity->profile->nome ?></h5>
                        </div>
                        <div class="d-flex align-items-center mb-3">
                            <i class="fas fa-calendar-alt fa-2x text-primary mr-3"></i>
                            <h5 class="mb-0"><?= Yii::$app->user->identity->profile->dtaNascimento ?></h5>
                        </div>
                        <div class="d-flex align-items-center mb-3">
                            <i class="fas fa-venus-mars fa-2x text-primary mr-3"></i>
                            <h5 class="mb-0"><?= Yii::$app->user->identity->profile->genero ?></h5>
                        </div>
                        <div class="d-flex align-items-center mb-3">
                            <i class="fas fa-phone fa-2x text-primary mr-3"></i>
                            <h5 class="mb-0"><?= Yii::$app->user->identity->profile->telemovel ?></h5>
                        </div>
                        <div class="d-flex align-items-center mb-3">
                            <i class="fas fa-map-marker-alt fa-2x text-primary mr-3"></i>
                            <h5 class="mb-0"><?= Yii::$app->user->identity->profile->morada ?></h5>
                        </div>
                    </div>
                    <div class="text-center mt-4">
                        <?= Html::a('Editar Perfil', ['update', 'id' => Yii::$app->user->id], ['class' => 'btn btn-primary btn-lg px-4']) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

