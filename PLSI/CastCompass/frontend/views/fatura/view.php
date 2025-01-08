<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var common\models\Fatura $model */

$this->title = Yii::$app->formatter->asDate($model->data);
$this->params['breadcrumbs'][] = ['label' => 'Faturas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="fatura-view">

    <h1><?= Html::encode($this->title) ?></h1>
   <div class="row">
        <div class="col">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-primary">
                    <tr>
                        <th class="text-center">#</th>
                        <th>Nome do Produto</th>
                        <th class="text-center">Quantidade</th>
                        <th class="text-end">Preço</th>
                        <th class="text-end">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $total = 1;
                    foreach ($model->linhafaturas as $linha): 
                    ?>
                        <tr>
                            <td class="text-center"><?= $total++ ?></td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="<?= Yii::getAlias('@uploads') . '/' . $linha->produto->imagens[0]->filename ?? Yii::getAlia('@default') ?>" 
                                         alt="Product Image" 
                                         class="rounded me-3" 
                                         style="width: 50px; height: 50px; object-fit: cover;">
                                    <?= $linha->produto->nome ?>
                                </div>
                            </td>
                            <td class="text-center"><?= $linha->quantidade ?></td>
                            <td class="text-end">€ <?= number_format($linha->produto->preco, 2) ?></td>
                            <td class="text-end">€ <?= number_format($linha->valor, 2) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="4" class="text-end">Total:</th>
                        <th class="text-end text-primary">€ <?= number_format($model->valorTotal, 2) ?></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="row mt-4">
        <div class="col text-end">
<!--            <a href="/fatura/download-pdf?id=--><?php //= $model->id ?><!--" class="btn btn-success">Download PDF</a>-->
            <a href="" class="btn btn-success">Download PDF</a>
            <a href="<?= Url::to(['fatura/print', 'id' => $model->id]) ?>" class="btn btn-info">Imprimir Fatura</a>
            <a href=" <?= Url::to(['fatura/index'])  ?>" class="btn btn-secondary">Voltar para as Faturas</a>
        </div>
    </div>
</div>    
</div>
