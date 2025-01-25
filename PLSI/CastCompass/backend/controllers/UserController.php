<?php

namespace backend\controllers;

use common\models\User;
use backend\models\UserSearch;
use backend\models\UserForm;
use common\models\Profile;
use common\models\Carrinho;
use common\models\Fatura;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all User models.
     *
     * @return string
     */
    public function actionIndex()
    {
        if(!Yii::$app->user->can('userIndexBO')) {
          return $this->redirect(['site/login']);
        }

        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param int $id
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
      // Redirect the user to the login page if they don't have the necessary permissions
      if(!Yii::$app->user->can('userViewBO')) {
        return $this->redirect(['site/login']);
      }

      // Find's the user and the profile using the id passed
      $user = $this->findModel($id);
      $profile = Profile::findOne(['userID' => $id]);
      $carrinho = Carrinho::findOne(['profileID' => $profile->id]) ?? null;

      // If the user has a cart, the find all the invoices related to that cart
      // If null, set the fatura to null
      if($carrinho != null) {
        $fatura = Fatura::find(['carrinhoID' => $carrinho->id])->all() ?? null;
      } else { $fatura = null; }

        return $this->render('view', [
          'model' => $user,
          'fatura' => $fatura,
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
      if(!Yii::$app->user->can('userCreateBO')) {
        return $this->redirect(['site/login']);
      }
        
      $model = new UserForm();
        
      if ($model->load($this->request->post()) && $model->createForm()) {
        return $this->redirect(['view', 'id' => $model->id]);
      }   

        return $this->render('create', [
          'model' => $model,
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if (!Yii::$app->user->can('userUpdateBO')) {
            return $this->redirect(['site/login']);
        }

        $user = new UserForm();
        $user = $user->populateForm($id);

        if ($user->load($this->request->post()) && $user->updateForm()) {
            return $this->redirect(['view', 'id' => $user->id]);
        }

        return $this->render('update', [
          'user' => $user,
        ]);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        
        if (!Yii::$app->user->can('userDeleteBO')) {
            return $this->redirect(['site/login']);
        }

        $user = User::findOne($id);
        $profile = Profile::findOne(['userID' => $id]);

        $user->delete();
        $profile->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
