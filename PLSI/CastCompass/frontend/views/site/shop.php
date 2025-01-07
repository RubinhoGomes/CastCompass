<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */

/** @var \frontend\models\SignupForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use common\models\Favorito;

$this->title = 'Shop';
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
                        class="bg-light text-primary pr-3">Filter by Categoria</span></h5>
            <div class="bg-light p-4 mb-30">
                <form>
                    <div class="btn-success col-lg-6 custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <a class="btn px-3"
                           href="<?= yii\helpers\Url::to(['site/shop']) ?>">Reset Filters
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
                        class="bg-light text-primary pr-3">Filter by price</span></h5>
            <div class="bg-light p-4 mb-30">
                <form method="get" action="<?= yii\helpers\Url::to(['site/shop']) ?>">
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" name="price[]" value="all" id="price-all">
                        <label class="custom-control-label" for="price-all">All Price</label>
                        <span class="badge border font-weight-normal"><?= count($produtos) ?></span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" name="price[]" value="0-10" id="price-1">
                        <label class="custom-control-label" for="price-1">$0 - $10</label>
                        <span class="badge border font-weight-normal"><?= count($produtos) ?></span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" name="price[]" value="10-20" id="price-2">
                        <label class="custom-control-label" for="price-2">$10 - $20</label>
                        <span class="badge border font-weight-normal"><?= count($produtos) ?></span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" name="price[]" value="20-30" id="price-3">
                        <label class="custom-control-label" for="price-3">$20 - $30</label>
                        <span class="badge border font-weight-normal"><?= count($produtos) ?></span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" name="price[]" value="30-40" id="price-4">
                        <label class="custom-control-label" for="price-4">$30 - $40</label>
                        <span class="badge border font-weight-normal"><?= count($produtos) ?></span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between">
                        <input type="checkbox" class="custom-control-input" name="price[]" value="40-50" id="price-5">
                        <label class="custom-control-label" for="price-5">$40 - $50</label>
                        <span class="badge border font-weight-normal"><?= count($produtos) ?></span>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Apply Filters</button>
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
<<<<<<< HEAD

                                        <a class="btn btn-outline-dark btn-square"
                                           href="<?= yii\helpers\Url::to(['items-carrinho/create', 'produtoId' => $produto->id]) ?>"><i class="fa fa-shopping-cart"></i></a>
=======
                                      <a class="btn btn-outline-dark btn-square"
                                            href="<?= yii\helpers\Url::to(['items-carrinho/create', 'produtoId' => $produto->id]) ?>"><i class="fa fa-shopping-cart"></i></a>
<<<<<<< HEAD
>>>>>>> a621b26 (✅ Added A funcional Test ✅)
=======
>>>>>>> a621b26 (✅ Added A funcional Test ✅)
                                        <?php if (!Yii::$app->user->isGuest):
                                            $favorito = Favorito::find()->where(['produtoID' => $produto->id, 'profileID' => Yii::$app->user->identity->profile->id])->one(); ?>
                                            <a class="btn btn-outline-dark btn-square"
                                               href="<?= yii\helpers\Url::to(['favoritos/add', 'produtoID' => $produto->id]) ?>"><i
                                                        class="<?= Favorito::getIcon($favorito); ?> fa-heart"></i></a>
                                        <?php endif; ?>
                                        <a class="btn btn-outline-dark btn-square"
                                           href="<?= \yii\helpers\Url::to(['site/detail', 'id' => $produto->id]) ?>"><i class="fa fa-search"></i></a>
                                    </div>
                                </div>
                                <div class="text-center py-4">
                                    <a class="h6 text-decoration-none text-truncate"
                                       href=""><?= Html::encode($produto->nome) ?></a>
                                    <div class="d-flex align-items-center justify-content-center mt-2">
                                        <h5> <?= number_format($produto->preco, 2, ',', '.') ?>$</h5>
                                    </div>
                                </div>
                            </div>

                        </div>
                    <?php endforeach; ?>
                    <div class="col-12">
                        <nav>
                            <ul class="pagination justify-content-center">
                                <li class="page-item disabled"><a class="page-link" href="#">Previous</span></a></li>
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">Next</a></li>
                            </ul>
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
