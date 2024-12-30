<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\FaturaSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="fatura-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'carrinhoID') ?>

    <?= $form->field($model, 'valorTotal') ?>

    <?= $form->field($model, 'ivaTotal') ?>

    <?= $form->field($model, 'metodoPagamentoID') ?>

    <?php // echo $form->field($model, 'metodoExpedicaoID') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
