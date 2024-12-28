<?php

use common\models\Carrinho;
use common\models\ItemsCarrinho;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\CarrinhoSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Carrinhos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="carrinho-index">

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
                    <th>Remover</th>
                </tr>
                </thead>
                <tbody class="align-middle">
                <?php foreach ($itens as $item): ?>
                <tr onclick="window.location='<?= \yii\helpers\Url::to(['site/detail', 'id' => $item->produtoID]) ?>'">
                    <td class="align-middle"><?= $item->nome ?></td>
                    <td class="align-middle">
                    <a class="btn btn-primary btn-minus" href="<?= yii\helpers\Url::to(['items-carrinho/sub-quant', 'produtoId' => $item->produtoID]) ?>" style="color: pink"><i class="fas fa-minus"></i></a>
                    <?= Html::encode($item->quantidade) ?>
                    <a class="btn btn-primary btn-plus"  href="<?= yii\helpers\Url::to(['items-carrinho/add-quant', 'produtoId' => $item->produtoID]) ?>" style="color: pink"><i class="fas fa-plus"></i></a>
                    </td>
                    <td class="align-middle"><?= number_format($item->valorTotal, 2, ',', '.') ?>$</td>
                    <td><div class="product-img position-relative overflow-hidden">
                      <?php if(!$item->getImagem()) {?>
                        <img src="<?=Yii::getAlias('@default') ?>" alt="Imagem padrão" class="img-fluid"  width="100">
                      <?php } else{ ?>
                        <img src="<?=Yii::getAlias('@uploads') . '/' . $item->getImagem() ?>" alt="Imagem do produto" class="img-fluid"  width="100">
                      <?php } ?>
                    </div></td>
                    <td class="align-middle">
                        <a class="btn btn-sm btn-danger" href="<?= yii\helpers\Url::to(['items-carrinho/remove', 'produtoId' => $item->produtoID]) ?>"><i class="fa fa-times"></i> Remover</a></td>
                </tr>
                <?php endforeach; ?>                               
                </tbody>
            </table>

            <div class="row py-3">
                <div class="col-lg-6">
                    <a href="<?= Url::to(['site/shop']) ?>" class="btn btn-primary">Continuar comprando</a>
                </div>
                <div>
                  <p><?= $carrinho->valorTotal ?></p>
                </div>
                <div class="col-lg-6 text-right">
                    <a href="<?= Url::to(['carrinho/checkout']) ?>" class="btn btn-primary">Finalizar compra</a>
                </div>          

        </div>
    </div>
</div>

</div>
