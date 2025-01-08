<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Carrinho $model */

$this->title = 'Checkout';
$this->params['breadcrumbs'][] = ['label' => 'Carrinhos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="carrinho-checkout">

    <h1><?= Html::encode($this->title) ?></h1>

<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-lg-12 table-responsive mb-5">
            <table class="table table-light table-borderless table-hover text-center mb-0">
                <thead class="thead-dark">
                <tr>
                    <th>Produto</th>
                    <th>Quantidade</th>
                    <th>Preço</th>
                    <th>Imagem</th>
                </tr>
                </thead>
                <tbody class="align-middle">
                <?php foreach ($itens as $item): ?>
                <tr onclick="window.location='<?= \yii\helpers\Url::to(['site/detail', 'id' => $item->produtoID]) ?>'">
                    <td class="align-middle"><?= $item->nome ?></td>
                    <td class="align-middle">
                    <?= Html::encode($item->quantidade) ?>
                    </td>
                    <td class="align-middle"><?= number_format($item->valorTotal, 2, ',', '.') ?>$</td>
                    <td><div class="product-img position-relative overflow-hidden">
                      <?php if(!$item->getImagem()) {?>
                        <img src="<?=Yii::getAlias('@default') ?>" alt="Imagem padrão" class="img-fluid"  width="100">
                      <?php } else{ ?>
                        <img src="<?=Yii::getAlias('@uploads') . '/' . $item->getImagem() ?>" alt="Imagem do produto" class="img-fluid"  width="100">
                      <?php } ?>
                    </div></td>
                </tr>
                <?php endforeach; ?>                               
                </tbody>
            </table>

            <div class="row py-3">
                <?php $form = ActiveForm::begin(['id' => 'form-checkout', 'enableClientValidation' => true, 'options' => ['method' => 'post']]); ?>

                <div class="col-lg-6 mb-3">
                    <h5 class="mb-3">Método de Expedição:</h5>
                    <div class="form-group">
                        <div class="input-group">
                            <?= Html::dropDownList('metodoExpedicao', null,
                                \yii\helpers\ArrayHelper::map($metodoExpedicao, 'id', 'nome'), [
                                    'class' => 'form-control custom-select me',
                                    'prompt' => 'Selecione um método'
                                ])
                            ?>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 mb-3">
                    <h5 class="mb-3">Método de Pagamento:</h5>
                    <div class="form-group">
                        <div class="input-group">
                            <?= Html::dropDownList('metodoPagamento', null,
                                \yii\helpers\ArrayHelper::map($metodoPagamento, 'id', 'nome'), [
                                    'class' => 'form-control custom-select me',
                                    'prompt' => 'Selecione um método'
                                ])
                            ?>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12 text-center mt-4">
                    <input type="hidden" name="carrinhoId" id="carrinhoId" value="<?= $itens[0]->carrinhoID ?>">
                    <?= Html::submitButton('Finalizar Compra', ['class' => 'btn btn-success btn-lg px-5']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>

</div>
