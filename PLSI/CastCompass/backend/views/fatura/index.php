<?php

use common\models\Fatura;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\FaturaSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Faturas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fatura-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<div class="row">
  <table class="table table-bordered table-hover">
    <thead class="thead-dark">
      <tr>
        <th>Id</th>
        <th>Nome do Utilizador</th>
        <th>Preço</th>
        <th>IVA</th>
        <th>Data</th>
        <th>Ações</th>
      </tr>          
    </thead>        
    <tbody>
      <?php foreach ($fatura as $fatura): ?>
        <tr data-toggle="collapse" data-target="#details-<?= $fatura->id ?>" class="accordion-toggle">
          <td><?= $fatura->id ?></td>
          <td><?= $fatura->carrinho->profile->nome ?></td>
          <td>€ <?= $fatura->valorTotal ?></td>
          <td>€ <?= $fatura->ivaTotal ?></td>
          <td><?= Yii::$app->formatter->asDate($fatura->data) ?></td>
          <td>
            <button class="btn btn-sm btn-primary">Detalhes</button>
          </td>
        </tr>
        <tr>
          <td colspan="6" class="hiddenRow">
            <div class="collapse" id="details-<?= $fatura->id ?>">
              <table class="table table-sm table-striped">
                <thead>
                  <tr>
                    <th>Id</th>
                    <th>Nome</th>
                    <th>Quantidade</th>
                    <th>Preço Unitário</th>
                    <th>Preço Total</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($fatura->linhafaturas as $item): ?>
                    <tr>
                      <td><?= $item->id ?></td>
                      <td><?= $item->produto->nome ?></td>
                      <td><?= $item->quantidade ?></td>
                      <td>€ <?= $item->produto->preco ?></td>
                      <td>€ <?= $item->valor ?></td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<!-- Optional: Add some CSS for better visibility -->
<style>
  .accordion-toggle {
    cursor: pointer;
  }
  .hiddenRow {
    padding: 0 !important;
  }
</style>

<!-- Include Bootstrap's JS and jQuery (if not already included in your layout) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script></div>
