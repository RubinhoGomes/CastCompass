<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Metodopagamento $model */

$this->title = 'Criar Metodo de Pagamento';
$this->params['breadcrumbs'][] = ['label' => 'Metodo de Pagamentos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="metodopagamento-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'metodos' => $metodos,
    ]) ?>

</div>
