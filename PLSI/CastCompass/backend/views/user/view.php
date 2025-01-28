<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\User $model */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="user-view">

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
    'username',
    [
      'attribute' => 'profile.nome',
      'label' => 'Nome',
    ],
    'email:email',
    [
      'attribute' => 'profile.nif',
      'label' => 'NIF',
    ],
    [
      'attribute' => 'profile.dtaNascimento',
      'label' => 'Data de Nascimento',
    ],
    [
      'attribute' => 'profile.genero',
      'label' => 'Género',
    ],
    [
      'attribute' => 'profile.telemovel',
      'label' => 'Telemóvel',
    ],
    [
      'attribute' => 'profile.morada',
      'label' => 'Morada',
    ],
    'auth_key',
    'password_hash',
    'password_reset_token',
    'role',
    'created_at:date',
    'updated_at:date',
    'verification_token',
  ],
]) ?>

    <h2>Faturas (<?= $model->profile->nome?>)</h2>
<table class="table table-striped table-bordered">
  <thead class="table-dark">
    <tr>
      <th>Data</th>
      <th>Iva Total</th>
      <th>Valor Total</th>
      <th>Estado</th>
      <th>Detalhes</th>
    </tr>
  </thead>
  <tbody>
    <?php if ($fatura == null): ?>
      <tr>
        <td colspan="5">Não existem faturas para este cliente (<?= $model->profile->nome ?>)</td>
      </tr>
    <?php else: ?>
      <?php foreach ($fatura as $fatura): ?>
        <tr data-toggle="collapse" data-target="#details-<?= $fatura->id ?>" class="accordion-toggle">
          <td><?= Yii::$app->formatter->asDate($fatura->data) ?></td>
          <td><?= $fatura->ivaTotal ?>€</td>
          <td><?= $fatura->valorTotal ?>€</td>
          <td><?= $fatura->estado ?></td>
          <td>
            <button class="btn btn-sm btn-primary" data-toggle="collapse" data-target="#details-<?= $fatura->id ?>">Detalhes</button>
          </td>
        </tr>
        <tr>
          <td colspan="5" class="hiddenRow">
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
                      <td><?= $item->produto->preco ?>€</td>
                      <td><?= $item->valor ?>€</td>
                    </tr>
                  <?php endforeach; ?>
                  <?php if($fatura->estado != $fatura->getEstado(2)){ ?>
                  <tr>
                    <td colspan="5" class="text-center">
                    <a href="<?= Url::to(['fatura/update-estado', 'idUser' => $model->id, 'idFatura' => $fatura->id, 'estado' => $fatura->updateEstado($fatura->estado)]) ?>">
                    <button class="btn btn-sm btn-success">Alterar Estado (<?= $fatura->updateEstado($fatura->estado) ?>)
                </button></a>
                    </td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </td>
        </tr>
      <?php endforeach; ?>
    <?php endif; ?>
  </tbody>
</table>
</div>
