<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */

/** @var \frontend\models\SignupForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Detalhes';
$this->params['breadcrumbs'][] = $this->title;
?>

<!-- Shop Detail Start -->
<div class="container-fluid pb-5">
    <div class="row px-xl-5">
        <div class="col-lg-5 mb-30">
            <div id="product-carousel" class="carousel slide" data-bs-ride="carousel">
                <div class="product-img position-relative overflow-hidden">
                    <?php if (!empty($produto->imagens)): ?>
                        <?php $image = $produto->imagens[0]; ?>
                        <img src="<?= Yii::getAlias('@uploads') . '/' . $image->filename ?>"
                             alt="<?= Html::encode($produto->nome) ?>" class="img-fluid">
                    <?php else: ?>
                        <img src="<?= Yii::getAlias('@default') ?>" alt="Imagem padrão" class="img-fluid">
                    <?php endif; ?>
                </div>
                <a class="carousel-control-prev" href="#product-carousel" data-bs-slide="prev">
                    <i class="fa fa-2x fa-angle-left text-dark"></i>
                </a>
                <a class="carousel-control-next" href="#product-carousel" data-bs-slide="next">
                    <i class="fa fa-2x fa-angle-right text-dark"></i>
                </a>
            </div>
        </div>

        <div class="col-lg-7 h-auto mb-30">
            <div class="h-100 bg-light p-30">
                <h3><?= Html::encode($produto->nome) ?></h3>
                <h5>Marca: <?= Html::encode($produto->marca) ?></h5>
                <h5>Categoria: <?= Html::encode($produto->categoria->genero) ?></h5>
                <h4 class="font-weight-semi-bold mb-4"><?= number_format($produto->preco, 2, ',', '.') ?>€</h4>

                <div class="d-flex align-items-center mb-4 pt-2">
                    <div class="input-group quantity mr-3" style="width: 130px;">
                        <div class="input-group-btn">
                        <a class="btn btn-primary" href="<?= yii\helpers\Url::to(['site/subtrair', 'id' => $produto->id, 'quantidade' => $quantidade]) ?>">
                            <i class="fa fa-minus"></i>
                          </a>
                        </div>
                        <span class="form-control text-center"><?= $quantidade ?></span>
                        <div class="input-group-btn">
                        <a class="btn btn-primary" href="<?= yii\helpers\Url::to(['site/adicionar', 'id' => $produto->id, 'quantidade' => $quantidade ]) ?>">
                                <i class="fa fa-plus"></i>
                          </a>
                        </div>
                    </div>
                    <a class="btn btn-primary px-3"
                       href="<?= yii\helpers\Url::to(['items-carrinho/adicionar-produto', 'idProduto' => $produto->id, 'quantidade' => $quantidade]) ?>"><i
                                class="fa fa-shopping-cart mr-1"></i> Adicionar ao Carrinho</a>
                </div>
            </div>

        </div>
    </div>

    <div class="row px-xl-5">
        <div class="col">
            <div class="bg-light p-30">
                <div class="nav nav-tabs mb-4">
                    <h3>Descrição</h3>
                </div>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="tab-pane-1">
                        <p><?= nl2br(Html::encode($produto->descricao)) ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Shop Detail End -->


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
</body>

</html>
