<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Metodopagamento $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="metodopagamento-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tipo')->dropDownList($metodos, ['prompt' => 'Escolha o tipo de pagamento']) ?>

      <div class="form-group">
          <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
      </div>

      <?php ActiveForm::end(); ?>

  </div>
