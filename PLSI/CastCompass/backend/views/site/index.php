<?php
$this->title = 'Starter Page';
$this->params['breadcrumbs'] = [['label' => $this->title]];
use common\models\Profile;
use common\models\Categoria;
use common\models\Produto;
use common\models\Iva;
use common\models\Metodopagamento;
use common\models\Metodoexpedicao;

?>
<div class="container-fluid">

    <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <?php $smallBox = \hail812\adminlte\widgets\SmallBox::begin([
                'title' => $numProfile = Profile::find()->count(),
                'text' => 'Perfis',
                'icon' => 'fas fa-user',
                'theme' => 'success',
                'linkText' => 'More Info',
                'linkUrl' => ['/user/index'],
            ]) ?>
            <?php \hail812\adminlte\widgets\SmallBox::end() ?>
            <?= \hail812\adminlte\widgets\SmallBox::widget([
                'title' => $numCategorias = Categoria::find()->count(),
                'text' => 'Categorias',
                'icon' => 'fa fa-list',
                'theme'=> 'red',
                'linkText' => 'More Info',
                'linkUrl' => ['/categoria/index'],
            ]) ?>
            <?= \hail812\adminlte\widgets\SmallBox::widget([
                'title' => $numMetodopagamentos = Metodopagamento::find()->count(),
                'text' => 'Metodos de pagamento',
                'icon' => 'fa fa-credit-card',
                'linkText' => 'More Info',
                'linkUrl' => ['/metodopagamento/index'],
            ]) ?>
        </div>

        <div class="col-md-4 col-sm-6 col-12">
            <?php $smallBox = \hail812\adminlte\widgets\SmallBox::begin([
                'title' => $numProdutos = Produto::find()->count(),
                'text' => 'Produtos',
                'icon' => 'fa fa-store',
                'theme' => 'success',
                'linkText' => 'More Info',
                'linkUrl' => ['/produto/index'],
            ]) ?>
            <?php \hail812\adminlte\widgets\SmallBox::end() ?>
            <?= \hail812\adminlte\widgets\SmallBox::widget([
                'title' => $numIvas = Iva::find()->count(),
                'text' => 'Ivas',
                'theme'=> 'red',
                'icon' => 'fa fa-money-bill',
                'linkText' => 'More Info',
                'linkUrl' => ['/iva/index'],
            ]) ?>
            <?= \hail812\adminlte\widgets\SmallBox::widget([
                'title' => $numMetodoexpedicao = Metodoexpedicao::find()->count(),
                'text' => 'Metodos de Entrega',
                'icon' => 'fa fa-truck',
                'linkText' => 'More Info',
                'linkUrl' => ['/metodoexpedicao/index'],
            ]) ?>
        </div>

    </div>


</div>