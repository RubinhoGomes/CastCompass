<?php
$this->title = 'Starter Page';
$this->params['breadcrumbs'] = [['label' => $this->title]];
use common\models\Profile;
use common\models\Categoria;
use common\models\Produto;
use common\models\Iva;
use common\models\Metodopagamento;
use common\models\Metodoexpedicao;
use common\models\Fatura;
use miloschuman\highcharts\Highcharts;

?>
<div class="container-fluid">

    <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <?php $smallBox = \hail812\adminlte\widgets\SmallBox::begin([
                'title' => $numProfile = Profile::find()->count(),
                'text' => 'Perfis',
                'icon' => 'fas fa-user',
                'theme' => 'success',
                'linkText' => 'Mais Informações',
                'linkUrl' => ['/user/index'],
            ]) ?>
            <?php \hail812\adminlte\widgets\SmallBox::end() ?>
            <?= \hail812\adminlte\widgets\SmallBox::widget([
                'title' => $numCategorias = Categoria::find()->count(),
                'text' => 'Categorias',
                'icon' => 'fa fa-list',
                'theme'=> 'red',
                'linkText' => 'Mais Informações',
                'linkUrl' => ['/categoria/index'],
            ]) ?>
            <?= \hail812\adminlte\widgets\SmallBox::widget([
                'title' => $numMetodopagamentos = Metodopagamento::find()->count(),
                'text' => 'Metodos de pagamento',
                'icon' => 'fa fa-credit-card',
                'linkText' => 'Mais Informações',
                'linkUrl' => ['/metodopagamento/index'],
            ]) ?>
        </div>

        <div class="col-md-4 col-sm-6 col-12">
            <?php $smallBox = \hail812\adminlte\widgets\SmallBox::begin([
                'title' => $numProdutos = Produto::find()->count(),
                'text' => 'Produtos',
                'icon' => 'fa fa-store',
                'theme' => 'success',
                'linkText' => 'Mais Informações',
                'linkUrl' => ['/produto/index'],
            ]) ?>
            <?php \hail812\adminlte\widgets\SmallBox::end() ?>
            <?= \hail812\adminlte\widgets\SmallBox::widget([
                'title' => $numIvas = Iva::find()->count(),
                'text' => 'Ivas',
                'theme'=> 'red',
                'icon' => 'fa fa-money-bill',
                'linkText' => 'Mais Informações',
                'linkUrl' => ['/iva/index'],
            ]) ?>
            <?= \hail812\adminlte\widgets\SmallBox::widget([
                'title' => $numMetodoexpedicao = Metodoexpedicao::find()->count(),
                'text' => 'Metodos de Entrega',
                'icon' => 'fa fa-truck',
                'linkText' => 'Mais Informações',
                'linkUrl' => ['/metodoexpedicao/index'],
            ]) ?>
        </div>

        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <?php $smallBox = \hail812\adminlte\widgets\SmallBox::begin([
                'title' => $numFaturas = Fatura::find()->count(),
                'text' => 'Faturas Emitidas',
                'icon' => 'fas fa-file-invoice-dollar',
                'theme' => 'success',
                'linkText' => 'Mais Informações',
                'linkUrl' => ['/fatura/index'],
            ]) ?>
            <?php \hail812\adminlte\widgets\SmallBox::end() ?>
            <?= \hail812\adminlte\widgets\SmallBox::widget([
              'title' => $numFaturasProcessadas = Fatura::find()->where(['estado' => 'Expedido'])->count(),
                'text' => 'Faturas Expedidas',
                'icon' => 'fa fa-file-invoice-dollar',
                'theme'=> 'red',
                'linkText' => 'Mais Informações',
                'linkUrl' => ['/fatura/index'],
            ]) ?>
            <?= \hail812\adminlte\widgets\SmallBox::widget([
                'title' => $numFaturasEntregues = Fatura::find()->where(['estado' => 'Entregue'])->count(),
                'text' => 'Faturas Entregues',
                'icon' => 'fa fa-truck-loading',
                'linkText' => 'Mais Informações',
                'linkUrl' => ['/fatura/index'],
            ]) ?>
        </div>
    </div>

<?= Highcharts::widget([
    'options' => [
        'title' => ['text' => 'Valor Total Vendidos por Mês'],
        'xAxis' => ['categories' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']],
        'yAxis' => ['title' => ['text' => 'Valor Monetario']],
        'series' => [
            [
                'name' => 'Valor Monetario',
                'data' => $valores
            ]
        ]
    ]
]) ?>



</div>
