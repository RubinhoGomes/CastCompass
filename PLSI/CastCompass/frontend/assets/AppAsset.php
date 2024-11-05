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
      // Default CSS Files
      'css/style.css',
      'css/style.min.css',
      // Bootstrap CSS Files
      'css/bootstrap-grid.css',
      'css/bootstrap-grid.min.css',
      'css/bootstrap-reboot.css',
      'css/bootstrap-reboot.min.css',
      'css/bootstrap.css',
      'css/bootstrap.min.css',
      // Owl Carousel Assets CSS inside the OwlCarousel Assets Folder
      'lib/owlcarousel/assets/owl.carousel.css',
      'lib/owlcarousel/assets/owl.carousel.min.css',
      'lib/owlcarousel/assets/owl.theme.default.css',
      'lib/owlcarousel/assets/owl.theme.default.min.css',
      'lib/owlcarousel/assets/owl.theme.green.css',
      'lib/owlcarousel/assets/owl.theme.green.min.css',
      // Animate CSS inside the Aninate folder
      'lib/animate/animate.min.css',
    ];
    public $js = [
      'js/main.js',
      // Easing JS inside the Easing Folder
      'lib/easing/easing.js',
      'lib/easing/easing.min.js',
      // Owl Carousel JS inside the OwlCarousel Folder
      'lib/owlcarousel/owl.carousel.js',
      'lib/owlcarousel/owl.carousel.min.js',
    ];
    public $scss = [
      //SCSS Files
      'scss/style.scss',
      'scss/bootstrap/scss/bootstrap.scss',
      'scss/bootstrap/scss/mixins/_breakpoints.scss',
      'scss/bootstrap/scss/utilities/_align.scss',

    ];
    public $depends = [
      'yii\web\YiiAsset',
      'yii\bootstrap5\BootstrapAsset',
    ];
}
