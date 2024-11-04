<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
      'css/style.css',
      'css/style.min.css',
      'css/bootstrap-grid.css',
      'css/bootstrap-grid.min.css',
      'css/bootstrap-reboot.css',
      'css/bootstrap-reboot.min.css',
      'css/bootstrap.css',
      'css/bootstrap.min.css',
    ];
    public $js = [
      'js/main.js',
    ];
    public $lib = [
      // Animate CSS inside the Aninate folder
      'animate/animate.min.css',
      // Easing CSS inside the Easing Folder
      'easing/easing.js',
      'easing/easing.min.js',
      // Owl Carousel JS inside the OwlCarousel Folder
      'owlcarousel/owl.carousel.js',
      'owlcarousel/owl.carousel.min.js',
      // Owl Carousel Assets CSS inside the OwlCarousel Assets Folder
      'owlcarousel/assets/owl.carousel.css',
      'owlcarousel/assets/owl.carousel.min.css',
      'owlcarousel/assets/owl.theme.default.css',
      'owlcarousel/assets/owl.theme.default.min.css',
      'owlcarousel/assets/owl.theme.green.css',
      'owlcarousel/assets/owl.theme.green.min.css',
    ];
    public $scss = [
      'scss/style.scss',
      'scss/bootstrap/scss/*',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap5\BootstrapAsset',
    ];
}
