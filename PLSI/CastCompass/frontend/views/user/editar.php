<?php

/** @var yii\web\View $this */
/** @var yii\widgets\ActiveForm $form */
/** @var frontend\models\EditProfileForm $model */

use yii\widgets\ActiveForm;
use yii\helpers\Html;

$this->title = 'Editar Perfil';
$this->params['breadcrumbs'][] = ['label' => 'Perfil', 'url' => ['profile']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="user-edit-profile">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Edite as informações do seu perfil abaixo:</p>

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'nif')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'dtaNascimento')->input('date') ?>
    <?= $form->field($model, 'genero')->dropDownList(['Masculino' => 'Masculino', 'Feminino' => 'Feminino'], ['prompt' => 'Selecione o Gênero']) ?>
    <?= $form->field($model, 'telemovel')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'morada')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Salvar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>