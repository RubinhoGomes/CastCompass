<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Carrinho $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="carrinho-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'profileID')->textInput() ?>

    <?= $form->field($model, 'dataCompra')->textInput() ?>

    <?= $form->field($model, 'valorTotal')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'quantidade')->textInput() ?>

    <?= $form->field($model, 'metodoExpedicaoID')->textInput() ?>

    <?= $form->field($model, 'metodoPagamentoID')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
