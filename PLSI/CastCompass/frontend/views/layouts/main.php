<?php

/** @var \yii\web\View $this */

/** @var string $content */

use common\widgets\Alert;
use frontend\assets\AppAsset;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use yii\bootstrap5\Dropdown;
use common\models\Categoria;
use yii\helpers\Url;
use common\models\Favorito;
use common\models\Carrinho;
use common\models\ItemsCarrinho;;

if (!Yii::$app->user->isGuest) {
$profileID = Yii::$app->user->identity->profile->id;
    $numFavoritos = Favorito::find()
        ->where(['profileID' => $profileID])
        ->count();
    $carrinho = Carrinho::findOne(['profileID' => $profileID]);
if($carrinho){
    $numCarrinho = ItemsCarrinho::find()
        ->where(['carrinhoID' => $carrinho->id])
        ->count();
    } else {
        $numCarrinho = 0;
    }
} else {
  $numFavoritos = 0;
  $numCarrinho = 0;
}

AppAsset::register($this);
$categorias = Categoria::find()->all();
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>" class="h-100">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <?php $this->registerCsrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <style>
        .text-truncate {
            white-space: normal;
            word-wrap: break-word;
            display: block;
        }
    </style>
    <body class="d-flex flex-column h-100">
    <?php $this->beginBody() ?>

    <header>

        <div class="container-fluid bg-dark mb-30 mt-30">
            <div class="row px-xl-5">
                <!-- Vertical Navbar for Categories (left side) -->
                <div class="col-lg-3 d-none d-lg-block">
                    <div class="position-relative">
                        <!-- Botão Categories -->
                        <a class="btn d-flex align-items-center justify-content-between bg-primary w-100"
                           data-toggle="collapse" href="#navbar-vertical" style="height: 65px; padding: 0 30px;">
                            <h6 class="text-dark m-0"><i class="fa fa-bars mr-2"></i>Categories</h6>
                            <i class="fa fa-angle-down text-dark"></i>
                        </a>

                        <!-- Imagem ao lado, fora do botão -->
                        <a href="<?= Yii::$app->homeUrl ?>">
                            <img src="<?= Yii::$app->request->baseUrl ?>/img/image.jpg" alt="Icon"
                                 class="position-absolute"
                                 style="top: 50%; left: -63px; transform: translateY(-50%); width: 65px; height: 65px;">
                        </a>
                    </div>
                    <nav class="collapse position-absolute navbar navbar-vertical navbar-light align-items-start p-0 bg-light"
                         id="navbar-vertical" style="width: calc(100% - 30px); z-index: 999;">
                        <div class="navbar-nav w-100">
                            <?php foreach ($categorias as $categoria): ?>
                                <a href="<?= yii\helpers\Url::to(['site/shop', 'categoriaId' => $categoria->id]) ?>" class="nav-item nav-link">   <?= Html::encode($categoria->nome) ?></a>
                            <?php endforeach; ?>
                        </div>

                    </nav>

                </div>

                <!-- Main Navbar (right side) -->
                <div class="col-lg-9">
                    <nav class="navbar navbar-expand-lg bg-dark navbar-dark py-3 py-lg-0 px-0">
                        <a href="" class="text-decoration-none d-block d-lg-none">
                            <span class="h1 text-uppercase text-dark bg-light px-2">Cast</span>
                            <span class="h1 text-uppercase text-light bg-primary px-2 ml-n1">Compass</span>
                        </a>
                        <button type="button" class="navbar-toggler" data-toggle="collapse"
                                data-target="#navbarCollapse">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                            <div class="navbar-nav mr-auto py-0">
                                <a href="<?= Yii::$app->homeUrl ?>" class="nav-item nav-link active">Home</a>
                                <a href="<?= Url::to(['/site/shop']) ?>" class="nav-item nav-link">Shop</a>
                                <div class="nav-item dropdown">
                                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Pages <i
                                                class="fa fa-angle-down mt-1"></i></a>
                                    <div class="dropdown-menu bg-primary rounded-0 border-0 m-0">
                                        <a href="<?= Url::to(['/carrinho/index']) ?>" class="dropdown-item">Carrinho</a>
                                        <a href="<?= Url::to(['/favoritos/index']) ?>" class="dropdown-item">Favoritos</a>
                                        <a href="<?= Url::to(['/user/view/', 'id' => Yii::$app->user->id]) ?>" class="dropdown-item">Perfil</a>
                                        <a href="<?= Url::to(['/fatura/index']) ?>" class="dropdown-item">Faturas</a>
                                    </div>
                                </div>
                                <a href="<?= Url::to(['/site/contact']) ?>" class="nav-item nav-link">Contact</a>
                                <a href="<?= Url::to(['/site/about']) ?>" class="nav-item nav-link">About</a>
                            </div>
                            <div class="navbar-nav ml-auto py-0">
                                <?php if (Yii::$app->user->isGuest): ?>
                                    <!-- If guest, show Login and Signup -->
                                    <a href="<?= Url::to(['/site/login']) ?>" class="nav-item nav-link">Login</a>
                                    <a href="<?= Url::to(['/site/signup']) ?>" class="nav-item nav-link">Signup</a>
                                <?php else: ?>
                                    <!-- If logged in, show Profile and Logout -->
                                    <div class="nav-item dropdown">
                                        <a href="#" class="nav-link dropdown-toggle"
                                           data-toggle="dropdown"><?= Yii::$app->user->identity->username ?> <i
                                                    class="fa fa-angle-down"></i></a>
                                        <div class="dropdown-menu bg-primary rounded-0 border-0 m-0">
                                            <a href="<?= Url::to(['/user/view/', 'id' => Yii::$app->user->id]) ?>" class="dropdown-item">Profile</a>
                                            <a href="<?= Url::to(['/fatura/index']) ?>" class="dropdown-item">Faturas</a>

                                            <!-- Form to handle logout -->
                                            <?php echo Html::beginForm(['/site/logout'], 'post'); ?>
                                            <?= Html::submitButton('Logout (' . Yii::$app->user->identity->username . ')', ['class' => 'dropdown-item']) ?>
                                            <?php echo Html::endForm(); ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="navbar-nav ml-auto py-0 d-none d-lg-block">
                                <a href="<?= Url::to(['/favoritos/index']) ?>" class="btn px-0">
                                    <i class="fas fa-heart text-primary"></i>
                                    <span class="badge text-primary border border-secondary rounded-circle"
                                          style="padding-bottom: 2px;"><?= $numFavoritos ?></span>
                                </a>
                                <a href="<?= Url::to(['/carrinho/index']) ?>" class="btn px-0 ml-3">
                                    <i class="fas fa-shopping-cart text-primary"></i>
                                    <span class="badge text-primary border border-secondary rounded-circle"
                                    style="padding-bottom: 2px;"><?= $numCarrinho ?></span>
                                </a>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>

    </header>

    <main role="main" class="flex-shrink-0">
        <div class="container-fluid mt-3 py-xl-4">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= Alert::widget() ?>
            <?= $content ?>
        </div>
    </main>

    <footer class="footer mt-auto py-3 text-muted">
        <div class="container-fluid bg-dark text-secondary mt-1 pt-1">
            <div class="row px-xl-5 pt-5">
                <div class="col-lg-4 col-md-12 mb-5 pr-3 pr-xl-5">
                    <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>Rua de Leiria</p>
                    <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>support@castcompass.cc</p>
                    <p class="mb-0"><i class="fa fa-phone-alt text-primary mr-3"></i>+351 261 347 552</p>
                </div>
                <div class="col-lg-8 col-md-12">
                    <div class="row">
                        <div class="col-md-4 mb-5">
                            <h5 class="text-secondary text-uppercase mb-4">Quick Shop</h5>
                            <div class="d-flex flex-column justify-content-start">
                                <a class="text-secondary mb-2" href="<?= Yii::$app->homeUrl ?>"><i class="fa fa-angle-right mr-2"></i>Home</a>
                                <a class="text-secondary mb-2" href="<?= Url::to(['/carrinho/index']) ?>"><i class="fa fa-angle-right mr-2"></i>Carrinho</a>
                                <a class="text-secondary" href="<?= Url::to(['/site/contact']) ?>"><i class="fa fa-angle-right mr-2"></i>Contact Us</a>
                            </div>
                        </div>

                        <div class="col-md-4 mb-5">
                            <h6 class="text-secondary text-uppercase mt-4 mb-3">Follow Us</h6>
                            <div class="d-flex">
                                <a class="btn btn-primary btn-square mr-2" href="#"><i class="fab fa-twitter"></i></a>
                                <a class="btn btn-primary btn-square mr-2" href="#"><i
                                            class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-primary btn-square mr-2" href="#"><i
                                            class="fab fa-linkedin-in"></i></a>
                                <a class="btn btn-primary btn-square" href="#"><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="container-fluid">
            <p class="float-start">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>
            <p class="float-end"><?= Yii::powered() ?></p>
        </div>
    </footer>

    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage();
