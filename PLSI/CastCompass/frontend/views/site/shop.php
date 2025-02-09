<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */

/** @var \frontend\models\SignupForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use common\models\Favorito;
use yii\widgets\LinkPager;

$this->title = 'Loja';
$this->params['breadcrumbs'][] = $this->title;
?>
<!-- Breadcrumb Start -->
<!--<div class="container-fluid">-->
<!--    <div class="row px-xl-5">-->
<!--        <div class="col-12">-->
<!--            <nav class="breadcrumb bg-light mb-30">-->
<!--                <a class="breadcrumb-item text-dark" href="#">Home</a>-->
<!--                <a class="breadcrumb-item text-dark" href="#">Shop</a>-->
<!--                <span class="breadcrumb-item active">Shop List</span>-->
<!--            </nav>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->
<!-- Breadcrumb End -->


<!-- Shop Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <!-- Shop Sidebar Start -->
        <div class="col-lg-3 col-md-4">
            <h5 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span
                        class="bg-light text-primary pr-3">Filtrar por Categoria</span></h5>
            <div class="bg-light p-4 mb-30">
                <form>
                    <div class="btn-success col-lg-6 custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <a class="btn px-3"
                           href="<?= yii\helpers\Url::to(['site/shop']) ?>">Remover Filtros
                        </a>
                    </div>
                    <?php foreach ($categorias as $categoria): ?>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <a class="btn px-3"
                               href="<?= yii\helpers\Url::to(['site/shop', 'categoriaId' => $categoria->id]) ?>">
                                <?= Html::encode($categoria->nome) ?>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </form>
            </div>
            <!-- Price Start -->
            <h5 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span
                        class="bg-light text-primary pr-3">Filtrar por Preço</span></h5>
            <div class="bg-light p-4 mb-30">
                <form method="get" action="<?= yii\helpers\Url::to(['site/shop']) ?>">
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" name="price[]" value="all" id="price-all">
                        <label class="custom-control-label" for="price-all">Qualquer Preço</label>
                        <span class="badge border font-weight-normal"><?= count($produtos) ?></span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" name="price[]" value="0-25" id="price-1">
                        <label class="custom-control-label" for="price-1">0€ - 25€</label>
                        <span class="badge border font-weight-normal"><?= count($produtos) ?></span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" name="price[]" value="25-50" id="price-2">
                        <label class="custom-control-label" for="price-2">25€ - 50€</label>
                        <span class="badge border font-weight-normal"><?= count($produtos) ?></span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" name="price[]" value="50-75" id="price-3">
                        <label class="custom-control-label" for="price-3">50€ - 75€</label>
                        <span class="badge border font-weight-normal"><?= count($produtos) ?></span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" name="price[]" value="75-100" id="price-4">
                        <label class="custom-control-label" for="price-4">75€ - 100€</label>
                        <span class="badge border font-weight-normal"><?= count($produtos) ?></span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between">
                        <input type="checkbox" class="custom-control-input" name="price[]" value="100-150" id="price-5">
                        <label class="custom-control-label" for="price-5">100€ - 150€</label>
                        <span class="badge border font-weight-normal"><?= count($produtos) ?></span>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Aplicar Filtros</button>
                </form>
            </div>
            <!-- Price End -->

        </div>
        <!-- Shop Sidebar End -->


        <!-- Shop Product Start -->
        <div class="col-lg-9 col-md-8">
            <div class="row pb-3">
                <div class="row">
                    <?php foreach ($produtos as $produto): ?>
                        <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                            <div class="product-item bg-light mb-4">
                                <div class="product-img position-relative overflow-hidden">
                                    <?php if (!empty($produto->imagens)): ?>
                                        <?php $image = $produto->imagens[0]; ?>
                                        <img src="<?= Yii::getAlias('@uploads') . '/' . $image->filename ?>"
                                             alt="<?= Html::encode($produto->nome) ?>" class="img-fluid">
                                    <?php else: ?>
                                        <img src="<?= Yii::getAlias('@default') ?>" alt="Imagem padrão"
                                             class="img-fluid">
                                    <?php endif; ?>
                                    <div class="product-action">
                                        <a class="btn btn-outline-dark btn-square"
                                           href="<?= yii\helpers\Url::to(['items-carrinho/create', 'produtoId' => $produto->id]) ?>"><i
                                                    class="fa fa-shopping-cart"></i></a>
                                        <?php if (!Yii::$app->user->isGuest):
                                            $favorito = Favorito::find()->where(['produtoID' => $produto->id, 'profileID' => Yii::$app->user->identity->profile->id])->one(); ?>
                                            <a class="btn btn-outline-dark btn-square"
                                               href="<?= yii\helpers\Url::to(['favoritos/add', 'produtoID' => $produto->id]) ?>"><i
                                                        class="<?= Favorito::getIcon($favorito); ?> fa-heart"></i></a>
                                        <?php endif; ?>
                                        <a class="btn btn-outline-dark btn-square"
                                           href="<?= \yii\helpers\Url::to(['site/detail', 'id' => $produto->id]) ?>"><i
                                                    class="fa fa-search"></i></a>
                                    </div>
                                </div>
                                <div class="text-center py-4">
                                    <a class="h6 text-decoration-none text-truncate"
                                       href="<?= \yii\helpers\Url::to(['site/detail', 'id' => $produto->id]) ?>"><?= Html::encode($produto->nome) ?></a>
                                    <div class="d-flex align-items-center justify-content-center mt-2">
                                        <h5> <?= number_format($produto->preco, 2, ',', '.') ?>€</h5>
                                    </div>
                                </div>
                            </div>

                        </div>
                    <?php endforeach; ?>
                    <div class="col-12">
                        <nav>
                            <?= LinkPager::widget([
                                'pagination' => $paginas,
                                'options' => ['class' => 'pagination justify-content-center'],
                                'linkOptions' => ['class' => 'page-link'],
                                'prevPageLabel' => 'Previous',
                                'nextPageLabel' => 'Next',
                                'disabledPageCssClass' => 'disabled',
                                'activePageCssClass' => 'active',
                            ]); ?>
                        </nav>
                    </div>
                </div>
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
    <!-- Shop End -->


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="mail/jqBootstrapValidation.min.js"></script>
    <script src="mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
