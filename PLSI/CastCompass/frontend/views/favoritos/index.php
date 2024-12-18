<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \frontend\models\SignupForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use common\models\Favorito;

$favoritos = Favorito::find()->where(['profileID' => Yii::$app->user->identity->profile->id])->all();
$this->title = 'Favoritos';
$this->params['breadcrumbs'][] = $this->title;
?>
<!-- Cart Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-lg-12 table-responsive mb-5">
            <table class="table table-light table-borderless table-hover text-center mb-0">
                <thead class="thead-dark">
                <tr>
                    <th>Products</th>
                    <th>Price</th>
                    <th>Imagem</th>
                    <th>Remove</th>
                </tr>
                </thead>
                <tbody class="align-middle">
                <?php foreach ($favoritos as $favorito): ?>
                <tr onclick="window.location='<?= \yii\helpers\Url::to(['site/detail', 'id' => $favorito->produto->id]) ?>'">
                    <td class="align-middle"><?= Html::encode($favorito->produto->nome) ?></td>
                    <td class="align-middle"><?= number_format($favorito->produto->preco, 2, ',', '.') ?>$</td>
                    <td><div class="product-img position-relative overflow-hidden">
                            <?php if (!empty($produto->imagens)): ?>
                                <?php $image = $produto->imagens[0]; ?>
                                <img src="<?= Yii::getAlias('@uploads') . '/' . $image->filename ?>" alt="<?= Html::encode($produto->nome) ?>"  width="100" class="img-fluid">
                            <?php else: ?>
                                <img src="<?=Yii::getAlias('@default') ?>" alt="Imagem padrão" class="img-fluid"  width="100">
                            <?php endif; ?>
                        </div></td>
                    <td class="align-middle">
                        <a class="btn btn-sm btn-danger" href="<?= yii\helpers\Url::to(['favoritos/remove', 'id' => $favorito->id]) ?>"><i class="fa fa-times"></i> Remover</a></td>
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Cart End -->


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