<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \frontend\models\SignupForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
   <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to signup:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup', 'enableClientValidation' => true,]); ?>
               
                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'nome')?>

                <?= $form->field($model, 'email')->input('email') ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <?= $form->field($model, 'nif')->textInput() ?>        

                <?= $form->field($model, 'genero')->dropDownList(['Masculino' => 'Masculino', 'Feminino' => 'Feminino', 'Outro' => 'Outro']) ?>

                <?= $form->field($model, 'telemovel')->textInput() ?>

                <?= $form->field($model, 'morada')->textInput() ?>

               <div class="form-group">
                    <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
