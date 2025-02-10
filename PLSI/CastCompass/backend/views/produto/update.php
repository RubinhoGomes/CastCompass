<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Categoria;
use common\models\Iva;

/** @var yii\web\View $this */
/** @var common\models\Produto $model */

$this->title = 'Editar Produto: ' . $model->nome;
$this->params['breadcrumbs'][] = ['label' => 'Produtos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Editar';
?>
<div class="produto-update">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nome')->textInput() ?>

    <?= $form->field($model, 'descricao')->textInput() ?>

    <?= $form->field($model, 'preco')->textInput() ?>

    <?= $form->field($model, 'stock')->textInput() ?>

    <?= $form->field($model, 'categoriaID')->dropDownList(\yii\helpers\ArrayHelper::map(
      Categoria::find()->all(), 'id', 'nome'),
      ['prompt' => 'Selecione a Categoria']
    ) ?>

    <?= $form->field($model, 'ivaID')->dropDownList(\yii\helpers\ArrayHelper::map(
      Iva::find()->all(), 'id', 'label'),
      ['prompt' => 'Selecione o IVA']
    ) ?>


<div class="p-2">
    <h3>Imagens</h3>
    <?php if (!empty($imagemProduto)) { ?>
        <table class="table table-bordered text-center">
            <thead>
                <tr>
                    <th>Imagem</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($imagemProduto as $img) { ?>
                    <tr>
                        <td>
                            <img src="<?= $img->filename ?? Yii::getAlias('@notAvailable') ?>" width="200" class="img-thumbnail">
                        </td>
                        <td class="text-center align-middle">
                            <?= Html::a('Delete', ['delete-image', 'id' => $img->id], [
                                'class' => 'btn btn-danger',
                                'data-method' => 'post',
                                'data-confirm' => 'Tens a certeza que queres eliminar?',
                            ]) ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="text-muted">Nenhuma imagem disponível.</p>
    <?php } ?>
</div>
 
  <?= $form->field($imagem, 'imagens[]')->fileInput(['multiple' => true, 'accept' => 'image/*']) ?> 

      <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
      </div>

    <?php ActiveForm::end(); ?>


</div>
