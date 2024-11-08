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

AppAsset::register($this);
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
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header>
<?php
NavBar::begin([
  'brandLabel' => Yii::$app->name,
  'brandUrl' => Yii::$app->homeUrl,
  'options' => [
    'class' => 'navbar navbar-expand-md navbar-secondary bg-secondary container-fluid fixed-top py-1 px-xl-5 col-lg-6 d-none d-lg-block d-inline-flex align-items-center',
  ],
]);
$menuItems = [
  ['label' => 'Home', 'url' => ['/site/index']],
  ['label' => 'About', 'url' => ['/site/about']],
  ['label' => 'Contact', 'url' => ['/site/contact']],
];

/*
if (Yii::$app->user->isGuest) {
  $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
}
 */

echo Nav::widget([
  'options' => ['class' => 'navbar-nav me-auto mb-2 mb-md-0'],
  'items' => $menuItems,
]);

$myAccountItems = [];

if (Yii::$app->user->isGuest) {
  $myAccountItems = [
  ['label' => 'Signup', 'url' => ['/site/signup']],
  ['label' => 'Login', 'url' => ['/site/login']],
];
} else {
  $myAccountItems = [
    HTML::beginForm(['/user/profile'], 'get'),
    HTML::submitButton('Profile', ['class' => 'btn text-decoration-none']),
    HTML::endForm(),
    HTML::beginForm(['/site/logout'], 'post'),
    HTML::submitButton('Logout ('. Yii::$app->user->identity->username .')', ['class' => 'btn text-decoration-none']),
    HTML::endForm()  
  ];
}

echo Nav::widget([
  'options' => ['class' => 'navbar-nav ms-auto mb-2 mb-md-0 d-flex'],
  'items' => [
    [
      'label' => 'My Account',
      'items' => $myAccountItems,
    ],
  ],
]);

/*
if (Yii::$app->user->isGuest) {
  echo Html::tag('div',Html::a('Login',['/site/login'],['class' => ['btn btn-link login text-decoration-none']]),['class' => ['d-flex']]);
} else {
  echo Html::beginForm(['/site/logout'], 'post', ['class' => 'd-flex'])
    . Html::submitButton(
      'Logout (' . Yii::$app->user->identity->username . ')',
      ['class' => 'btn btn-link logout text-decoration-none']
    )
    . Html::endForm();
}

 */
NavBar::end();
?>
</header>

<main role="main" class="flex-shrink-0">
    <div class="container">
<?= Breadcrumbs::widget([
  'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<footer class="footer mt-auto py-3 text-muted">
    <div class="container">
        <p class="float-start">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>
        <p class="float-end"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage();
