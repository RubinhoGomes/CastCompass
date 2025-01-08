<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */

/** @var \frontend\models\SignupForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Sobre Nós';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-about">
    <h1>Bem-vindo à Nossa Loja de Campismo!</h1>
    <h2><?= Html::encode($this->title) ?></h2>

    <p>Na nossa loja de campismo, a aventura está sempre à tua espera! Oferecemos uma vasta seleção de tendas, equipamentos e acessórios para todas as tuas aventuras ao ar livre. Seja para iniciantes ou exploradores experientes, garantimos produtos de alta qualidade e atendimento especializado para que possas aproveitar ao máximo a natureza com segurança e conforto.</p>
</div>
