<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Metodoexpedicao $model */

$this->title = 'Criar Metodo de Entrega';
$this->params['breadcrumbs'][] = ['label' => 'Metodo de Entrega', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="metodoexpedicao-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
