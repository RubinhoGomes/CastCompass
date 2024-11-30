<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\UploadedFile;
use common\models\Categoria;

/** @var yii\web\View $this */
/** @var common\models\Produto $model */
/** @var yii\widgets\ActiveForm $form */

    // Alter the code to input the image and assign the path to the image filename
    /* <?= $form->field($model, 'imagemID')->textInput() ?> */

    // Alter the code to input the category and assign the category ID
    // Add and Dropdown List with all the categories
    /* <?= $form->field($model, 'categoriaID')->textInput() ?> */

?>

<div class="produto-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'marca')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'preco')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'stock')->textInput() ?>

    <?= $form->field($model, 'descricao')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'categoriaID')->dropDownList(\yii\helpers\ArrayHelper::map(
  Categoria::find()->all(), 'id', 'genero'), ['prompt' => 'Selecione uma categoria']) ?>

    <?= $form->field($imagem, 'imagens[]')->fileInput(['multiple' => true, 'accept' => 'image/*']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
