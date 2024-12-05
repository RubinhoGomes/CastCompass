<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Produto $model */

$this->title = $model->nome;
$this->params['breadcrumbs'][] = ['label' => 'Produtos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="produto-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
      'model' => $model,
        'attributes' => [
            'id',
            'nome',
            'marca',
            ['attribute' => 'preco', 'label' => 'Preço', 'format' => ['currency' ,'EUR']],
            'stock',
            'descricao:ntext',
            [
              'attribute' => 'categoriaID',
              'value' => function ($model) {
                return $model->categoria->nome; 
              },
            ],
            [
              'attribute' => 'ivaID',
              'value' => function ($model) {
                return $model->iva->label ?? 'Sem Iva'; 
              },
            ],
            [
              'attribute' => 'imagemID',
              'label' => 'Imagem',
              'value' => $imagem->filename ?? Yii::getAlias('@notAvailable'),
              'format' => ['image',['width'=>'100','height'=>'100']],
            ],                
        ],
    ]) ?>

</div>
