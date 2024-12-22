<?php

use common\models\Carrinho;
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
                    <th>Products</th>
                    <th>Price</th>
                    <th>Imagem</th>
                </tr>
                </thead>
                <tbody class="align-middle">
                <?php foreach ($itens as $item): ?>
                <tr onclick="window.location='<?= \yii\helpers\Url::to(['site/detail', 'id' => $item->produtoID]) ?>'">
                    <td class="align-middle"><?= Html::encode($item->quantidade) ?></td>
                    <td class="align-middle"><?= number_format($item->valorTotal, 2, ',', '.') ?>$</td>
                    <td><div class="product-img position-relative overflow-hidden">
                        <img src="<?=Yii::getAlias('@default') ?>" alt="Imagem padrão" class="img-fluid"  width="100">
                        </div></td>
</tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</div>
