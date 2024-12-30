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

    <p>
        <?= Html::a('Create Fatura', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

  <div class="card w-50">
    <!-- Card Header -->
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center" 
         data-bs-toggle="collapse" 
         data-bs-target="#receiptDetails" 
         aria-expanded="false" 
         aria-controls="receiptDetails">
      <div class="d-flex align-items-center">
        <img src="https://via.placeholder.com/50" alt="Receipt Image" class="rounded-circle me-3">
        <div>
          <h5 class="mb-0">Receipt #12345</h5>
          <small>Date: 2024-12-30</small>
        </div>
      </div>
      <span class="rotate-arrow">&#x25BC;</span> <!-- Down Arrow Icon -->
    </div>

    <!-- Collapsible Section -->
    <div id="receiptDetails" class="collapse">
      <div class="card-body">
        <h6 class="fw-bold mb-3">Products:</h6>
        <ul class="list-group">
          <li class="list-group-item d-flex justify-content-between">
            <span>Product 1</span>
            <span>$10.00</span>
          </li>
          <li class="list-group-item d-flex justify-content-between">
            <span>Product 2</span>
            <span>$15.50</span>
          </li>
          <li class="list-group-item d-flex justify-content-between">
            <span>Product 3</span>
            <span>$7.25</span>
          </li>
        </ul>
        <hr>
        <h6 class="fw-bold">Total: $32.75</h6>
      </div>
    </div>
  </div>

