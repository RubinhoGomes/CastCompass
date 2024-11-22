<?php

use common\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\UserSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Utilizadores';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); 

        // This line of code allows you to search using a "search bar" below the User Label
        // 'filterModel' => $searchModel,
?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'username',
            'role',
            [
              'attribute' => 'nome',
              'value' => function ($model) {
                return $model->profile->nome;
              }
            ],

            [
              'attribute' => 'morada',
              'value' => function ($model) {
                return $model->profile->morada;
              }
            ],

            [
              'attribute' => 'telemovel',
              'value' => function ($model) {
                return $model->profile->telemovel;
              }
            ],

            //'auth_key',
            //'password_hash',
            //'password_reset_token',
            'email:email',
            // 'status',
            // 'created_at:date',
            // 'updated_at:date',
            //'verification_token',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, User $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
