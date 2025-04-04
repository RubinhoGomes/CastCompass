<?php

namespace backend\controllers;

use common\models\LoginForm;
use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use common\models\Fatura;
use common\models\LinhaFatura;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout', 'index', 'error'],
                        'allow' => true,
                        'roles' => ['admin', 'worker'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => \yii\web\ErrorAction::class,
                'layout' => 'main',
            ],
        ];
    }

    

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $fatura = Fatura::find()->all();
  
        $valores = $this->calculoProdutosTotais($fatura);

        return $this->render('index', ['valores' => $valores]);
    }

    public function calculoProdutosTotais($fatura){
      $produtosTotais = array_fill(0, 12, 0);
      $total = 0;
        foreach($fatura as $f){
            $linha = LinhaFatura::find()->where(['faturaID' => $f->id])->all();
            foreach($linha as $l){
              $total += $l->valor;
            }
            
            if($total != null){
              $produtosTotais[(int)Yii::$app->formatter->asDate($f->data, 'M') - 1] += round($total, 2);
            }

            $total = 0;
        }

      return $produtosTotais;
    }

    /**
     * Login action.
     *
     * @return string|Response
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $this->layout = 'main-login';

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {

          if(Yii::$app->user->identity->role == 'admin' || Yii::$app->user->identity->role == 'worker'){
            return $this->goBack();
          }
          
          Yii::$app->user->logout();
          Yii::$app->session->setFlash('error', 'Não tens permissões para aceder');
          return $this->redirect(['site/login']);
        }

        $model->password = '';

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

}
