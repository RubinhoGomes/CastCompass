<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Produto $model */

$this->title = "Produto: " . $model->nome;
$this->params['breadcrumbs'][] = ['label' => 'Produtos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="produto-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Editar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Apagar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Deseja mesmo apagar?',
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
              'format' => 'raw',
              'value' => function ($model) {
                return \yii\helpers\HTML::a($model->categoria->nome, 
                  ['categoria/view', 'id' => $model->categoria->id]); 
              },
            ],
            [
              'attribute' => 'ivaID',
              'format' => 'raw',
              'value' => function ($model) {
                return \yii\helpers\HTML::a( 
                  $model->iva->label ?? 'Sem Iva',
                  ['iva/view', 'id' => $model->iva->id]
                ); 
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
