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
                 <div class="col-lg-6">
                    <p> Metodo de Expedição: </p>
                    <select name="metodoExpedicao" id="metodoExpedicao">
                        <?php foreach ($metodoExpedicao as $metodo): ?>
                            <option value="<?= $metodo->id ?>"><?= $metodo->nome ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col-lg-6 text-right">
                  <p> Metodo de Pagamento: </p>
                  <select name="metodoPagamento" id="metodoPagamento">
                      <?php foreach ($metodoPagamento as $metodoP): ?>
                          <option value="<?= $metodoP->id ?>"><?= $metodoP->nome ?></option>
                      <?php endforeach; ?>
                  </select>
                </div>

                   <select name="carrinhoId" id="carrinhoId" style="display: none">
                      <option value="<?= $itens[0]->carrinhoID ?>"></option>
                  </select>

                <div class="form-group">
                  <?= Html::submitButton('Comprar', ['class' => 'btn btn-success']) ?>
                </div>

                <?php ActiveForm::end(); ?>

              </div>



                           

</div>
