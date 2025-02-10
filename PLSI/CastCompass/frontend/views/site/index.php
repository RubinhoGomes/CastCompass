<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \frontend\models\SignupForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Home';

?>

    <!-- Carousel Start -->
    <div class="container-fluid mb-3">
        <div class="row px-xl-5">
            <div class="col-lg-8">
                <div id="header-carousel" class="carousel slide carousel-fade mb-30 mb-lg-0" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#header-carousel" data-slide-to="0" class="active"></li>
                        <li data-target="#header-carousel" data-slide-to="1"></li>
                        <li data-target="#header-carousel" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item position-relative active" style="height: 430px;">
                            <img class="position-absolute w-100 h-100" src="<?= Yii::getAlias('@image') ?>/tenda-1.jpg" style="object-fit: cover;">
                            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                <div class="p-3" style="max-width: 700px;">
                                    <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">Campismo</h1>
                                    <p class="mx-md-5 px-5 animate__animated animate__bounceIn">Bem-vindo à nossa loja de campismo, onde a aventura começa! Aqui encontras tudo o que precisas para explorar a natureza com conforto e segurança.</p>
                                    <a class="btn btn-outline-light py-2 px-4 mt-3 animate__animated animate__fadeInUp" href="site/shop">Compre Agora</a>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item position-relative" style="height: 430px;">
                            <img class="position-absolute w-100 h-100" src="<?= Yii::getAlias('@image')?>/tenda-2.jpg" style="object-fit: cover;">
                            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                <div class="p-3" style="max-width: 700px;">
                                    <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">Tendas</h1>
                                    <p class="mx-md-5 px-5 animate__animated animate__bounceIn">As nossas tendas são sinónimo de qualidade e conforto, projetadas para garantir proteção e tranquilidade em todas as tuas aventuras ao ar livre.</p>
                                    <a class="btn btn-outline-light py-2 px-4 mt-3 animate__animated animate__fadeInUp" href="site/shop">Compre Agora</a>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item position-relative" style="height: 430px;">
                            <img class="position-absolute w-100 h-100" src="<?= Yii::getAlias('@image')?>/tenda-3.jpg" style="object-fit: cover;">
                            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                <div class="p-3" style="max-width: 700px;">
                                    <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">Equipamentos de campismos</h1>
                                    <p class="mx-md-5 px-5 animate__animated animate__bounceIn">Os nossos equipamentos de campismo combinam durabilidade, praticabilidade e inovação, para que possas aproveitar cada momento na natureza ao máximo.</p>
                                    <a class="btn btn-outline-light py-2 px-4 mt-3 animate__animated animate__fadeInUp" href="site/shop">Compre Agora</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="product-offer mb-30" style="height: 200px;">
                    <img class="img-fluid" src="<?= Yii::getAlias('@image') . '/'?>oferta-1.jpg" alt="">
                </div>
                <div class="product-offer mb-30" style="height: 200px;">
                    <img class="img-fluid" src="<?= Yii::getAlias('@image') . '/'?>oferta-2.jpg" alt="">
                </div>
            </div>
        </div>
    </div>
    <!-- Carousel End -->


    <!-- Featured Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5 pb-3">
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
                    <h1 class="fa fa-check text-primary m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0">Produtos de Qualidade</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
                    <h1 class="fa fa-shipping-fast text-primary m-0 mr-2"></h1>
                    <h5 class="font-weight-semi-bold m-0">Portes Grátis</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
                    <h1 class="fas fa-exchange-alt text-primary m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0">14-Dias para Reembolso</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
                    <h1 class="fa fa-phone-volume text-primary m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0">Suporte 24/7</h5>
                </div>
            </div>
        </div>
    </div>
    <!-- Featured End -->


    <!-- Categories Start -->
    <div class="container-fluid pt-5">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-light text-primary pr-3">Categorias</span></h2>
        <div class="row px-xl-5 pb-3">
            <?php foreach ($categorias as $categoria): ?>
            <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                <a class="text-decoration-none" href="<?= yii\helpers\Url::to(['site/shop', 'categoriaId' => $categoria->id]) ?>">
                    <div class="cat-item d-flex align-items-center mb-4">
                        <div class="flex-fill pl-3">
                            <h6><?= Html::encode($categoria->nome) ?></h6>
                            <small class="text-body"> <?= $categoria->getProdutos()->count(); ?> </small>
                        </div>
                    </div>
                </a>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <!-- Categories End -->


    <!-- Products Start -->
    <div class="container-fluid pt-5 pb-3">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-light text-primary pr-3">Produtos Destacados</span></h2>
        <div class="row px-xl-5">
            <?php foreach (array_slice($produtos, 0, 4) as $produto): ?>
            <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                <div class="product-item bg-light mb-4">
                    <div class="product-img position-relative overflow-hidden">
                        <?php if (!empty($produto->imagens)): ?>
                            <?php $image = $produto->imagens[0]; ?>
                            <img src="<?= Yii::getAlias('@uploadshome') . '/' . $image->filename ?>" alt="<?= Html::encode($produto->nome) ?>" class="img-fluid">
                        <?php else: ?>
                        <img src="<?= Yii::getAlias('@default')?>" alt="Imagem padrão" class="img-fluid">
                        <?php endif; ?>
                        <div class="product-action">
<!--                            <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>-->
<!--                            <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>-->
                            <a class="btn btn-outline-dark btn-square" href="<?= \yii\helpers\Url::to(['site/detail', 'id' => $produto->id]) ?>"><i class="fa fa-search"></i></a>
                        </div>
                    </div>
                    <div class="text-center py-4">
                        <a class="h6 text-decoration-none text-truncate" href="<?= \yii\helpers\Url::to(['site/detail', 'id' => $produto->id]) ?>"><?= Html::encode($produto->nome) ?></a>
                        <div class="d-flex align-items-center justify-content-center mt-2">
                            <h5><?= number_format($produto->preco, 2, ',', '.') ?>€</h5>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <!-- Products End -->


    <!-- Offer Start -->
    <div class="container-fluid pt-5 pb-3">
        <div class="row px-xl-5">
            <div class="col-md-6">
                <div class="product-offer mb-30" style="height: 300px;">
                <img class="img-fluid" src="<?= Yii::getAlias('@image') . '/'?>oferta-1.jpg" alt="">
                </div>
            </div>
            <div class="col-md-6">
                <div class="product-offer mb-30" style="height: 300px;">
                    <img class="img-fluid" src="<?= Yii::getAlias('@image') . '/'?>oferta-2.jpg" alt="">
                </div>
            </div>
        </div>
    </div>
    <!-- Offer End -->



    <!-- Vendor Start -->
    <div class="container-fluid py-5">
        <div class="row px-xl-5">
            <div class="col">
                <div class="owl-carousel vendor-carousel">
                    <div class="bg-light p-4">
                        <img src="<?= Yii::getAlias('@image') ?? Yii::getAlias('@imagePath') ?>/vendor-1.jpg" alt="">
                    </div>
                    <div class="bg-light p-4">
                        <img src="<?= Yii::getAlias('@image') . '/'?>vendor-2.jpg" alt="">
                    </div>
                    <div class="bg-light p-4">
                        <img src="<?= Yii::getAlias('@image') . '/'?>vendor-3.jpg" alt="">
                    </div>
                    <div class="bg-light p-4">
                        <img src="<?= Yii::getAlias('@image') . '/'?>vendor-4.jpg" alt="">
                    </div>
                    <div class="bg-light p-4">
                        <img src="<?= Yii::getAlias('@image') . '/'?>vendor-5.jpg" alt="">
                    </div>
                    <div class="bg-light p-4">
                        <img src="<?= Yii::getAlias('@image') . '/'?>vendor-6.jpg" alt="">
                    </div>
                    <div class="bg-light p-4">
                        <img src="<?= Yii::getAlias('@image') . '/'?>vendor-7.jpg" alt="">
                    </div>
                    <div class="bg-light p-4">
                        <img src="<?= Yii::getAlias('@image') . '/'?>vendor-8.jpg" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Vendor End -->

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="../../web/lib/easing/easing.min.js"></script>
    <script src="../../web/lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="../../web/mail/jqBootstrapValidation.min.js"></script>
    <script src="../../web/mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="../../web/js/main.js"></script>
</body>

</html>
