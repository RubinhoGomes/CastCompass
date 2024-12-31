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
    <div class="row g-4">
        <?php foreach ($faturas as $fatura): ?>
            <div class="col-md-6">
                <!-- Card -->
                <div class="card">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center"
                         data-bs-toggle="collapse"
                         data-bs-target="#collapse-<?php echo $fatura->id; ?>"
                         aria-expanded="false"
                         aria-controls="collapse-<?php echo $fatura->id; ?>"
                         style="cursor: pointer;">
                        <h5 class="mb-0"><?= $fatura->id ?></h5>
                        <small><?= $fatura->id ?></small>
                    </div>
                    <div id="collapse-<?= $fatura->id ?>" class="collapse">
                        <div class="card-body">
                            <h6>Products:</h6>
                            <ul class="list-group">
                              <?php foreach ($fatura->linhafaturas as $linhas): ?>
                              <a href="<?= Url::to(['site/detail', 'id' => $linhas->produto->id]) ?>">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <!-- Product Image -->
                                        <img src="<?= Yii::getAlias('@uploads') . '/' . $linhas->produto->imagens[0]->filename ?>" 
                                             alt="Product Image" 
                                             class="rounded me-3" 
                                             style="width: 40px; height: 40px; object-fit: cover;">
                                        <span><?= $linhas->produto->nome . ' (' . $linhas->quantidade . ')' ?></span>
</div>
                                    <span>€ <?= $linhas->produto->preco ?></span>
                                </li>
                              </a>
                            <?php endforeach; ?>
                            </ul>
                            <hr>
                            <div class="d-flex justify-content-between align-items-center">
                              <h6>Total: € <?= $fatura->valorTotal ?></h6>
                              <a href="<?= Url::to(['fatura/view', 'id' => $linhas->produto->id]) ?>" class="btn btn-primary btn-sm">Ver Fatura</a>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

