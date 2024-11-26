<?php

use common\models\Profile;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var \frontend\models\SignupForm $model */

$this->title = 'Perfil de ' . Yii::$app->user->identity->profile->nome;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profile-index">

    <h1><?= $this->title ?></h1>

    <div class="container-fluid pb-5">
        <div class="row px-xl-5">
            <div class="col-lg-7 h-auto mb-30">
                <div class="h-100 bg-light p-30">
                    <h3 class="font-weight-semi-bold mb-4"><?= Yii::$app->user->identity->username ?></h3>
                    <h3 class="font-weight-semi-bold mb-4"><?= Yii::$app->user->identity->email ?></h3>
                    <h3 class="font-weight-semi-bold mb-4"><?= Yii::$app->user->identity->profile->nome ?></h3>
                    <h3 class="font-weight-semi-bold mb-4"><?= Yii::$app->user->identity->profile->dtaNascimento ?></h3>
                    <h3 class="font-weight-semi-bold mb-4"><?= Yii::$app->user->identity->profile->genero ?></h3>
                    <h3 class="font-weight-semi-bold mb-4"><?= Yii::$app->user->identity->profile->telemovel ?></h3>
                    <h3 class="font-weight-semi-bold mb-4"><?= Yii::$app->user->identity->profile->morada ?></h3>

                    <?= Html::a('Editar Perfil', ['update', 'id' => Yii::$app->user->id], ['class' => 'btn btn-primary px-3']) ?>
                </div>
            </div>
        </div>
    </div>
</div>
