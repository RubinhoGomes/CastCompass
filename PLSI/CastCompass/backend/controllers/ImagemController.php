<?php

namespace backend\controllers;

class ImagemController extends \yii\web\Controller
{


    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionCreate()
    {

      $imagem = new Imagem();
      
      $imagem->filename = $this->filename;
    
      $imagem->uploadImage();
      

    }
}
