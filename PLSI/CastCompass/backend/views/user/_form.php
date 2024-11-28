<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\User $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="user-form">


    <?php $form = ActiveForm::begin(['id' => 'form-signup', 'enableClientValidation' => true,]); ?>
    
    <?= $form->field($model, 'username')->textInput() ?>

    <?= $form->field($model, 'nome')->textInput() ?>  

    <?= $form->field($model, 'email')->textInput() ?>

    <?= $form->field($model, 'password')->passwordInput() ?>

    <?= $form->field($model, 'morada')->textInput() ?>

    <?= $form->field($model, 'nif')->textInput() ?>

    <?= $form->field($model, 'genero')->dropDownList(['Masculino' => 'Masculino', 'Feminino' => 'Feminino', 'Outro' => 'Outro'], ['prompt' => 'Selecione o Género']) ?>

    <?= $form->field($model, 'telemovel')->textInput() ?>

    <?= $form->field($model, 'role')->dropDownList(
      \yii\helpers\ArrayHelper::map(
        array_filter(Yii::$app->authManager->getRoles(), function($role) {
          return $role->name !== 'admin';
        }), 'name', 'name'),
        ['prompt' => 'Selecione a Role']
    ) ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

   <?php ActiveForm::end(); ?>

</div>
