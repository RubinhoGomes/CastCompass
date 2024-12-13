<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="['site/index']" class="brand-link">
        <img src="<?=$assetDir?>/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Cast&Compass</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?=$assetDir?>/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"><?=Yii::$app->user->identity->username?></a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <!-- href be escaped -->
        <!-- <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div> -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <?php
            
echo \hail812\adminlte\widgets\Menu::widget([
    'items' => [
        [
            'label' => 'Paginas',
            'icon' => 'tachometer-alt',
            'badge' => '<span class="right badge badge-info"></span>',
            'items' => [
                ['label' => 'Main', 'url' => ['site/index'], 'iconStyle' => 'far', 'visible' => Yii::$app->user->can('loginBO')],
                ['label' => 'Perfil', 'url' => ['user/index'], 'iconStyle' => 'fa fa-user', 'visible' => Yii::$app->user->can('userIndexBO')],
                ['label' => 'Categoria', 'url' => ['categoria/index'], 'iconStyle' => 'fa fa-list', 'visible' => Yii::$app->user->can('categoriaIndexBO')],
                ['label' => 'Produto', 'url' => ['produto/index'], 'iconStyle' => 'fa fa-store', 'visible' => Yii::$app->user->can('produtoIndexBO')],
                ['label' => 'Iva', 'url' => ['iva/index'], 'iconStyle' => 'fa fa-money-bill', 'visible' => Yii::$app->user->can('ivaIndexBO')],
                ['label' => 'Metodos de Pagamentos', 'url' => ['metodopagamento/index'], 'iconStyle' => 'fa fa-credit-card', 'visible' => Yii::$app->user->can('mpIndexBO')],
                ['label' => 'Metodos de Entrega', 'url' => ['metodoexpedicao/index'], 'iconStyle' => 'fa fa-car', 'visible' => Yii::$app->user->can('encomendaIndexBO')]
                // ['label' => 'Futuro', 'iconStyle' => 'far'], fa-credit-card WORKS
            ]
        ],
        ['label' => 'Cast&Compass', 'header' => true],
        ['label' => 'Gii', 'icon' => 'file-code', 'url' => ['/gii'], 'target' => '_blank', 'visible' => Yii::$app->user->can('admin')],
        ['label' => 'Debug', 'icon' => 'bug', 'url' => ['/debug'], 'target' => '_blank', 'visible' => Yii::$app->user->can('admin')],
        //['label' => 'Inicio', 'header' => true, 'icon' => 'tachometer-alt', 'visible' => !Yii::$app->user->can('admin')],
        ['label' => 'Voltar Para o Inicio', 'icon' => '', 'url' => ['../../frontend/web/'], 'visible' => !Yii::$app->user->can('admin')],
    ]
]);
            ?>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
