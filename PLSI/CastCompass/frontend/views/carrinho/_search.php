<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\CarrinhoSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="carrinho-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'profileID') ?>

    <?= $form->field($model, 'dataCompra') ?>

    <?= $form->field($model, 'valorTotal') ?>

    <?= $form->field($model, 'quantidade') ?>

    <?php // echo $form->field($model, 'metodoExpedicaoID') ?>

    <?php // echo $form->field($model, 'metodoPagamentoID') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
