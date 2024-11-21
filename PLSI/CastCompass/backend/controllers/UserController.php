<?php

namespace backend\controllers;

use common\models\User;
use backend\models\UserSearch;
use backend\models\UserForm;
use common\models\Profile;
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
      
      if(!Yii::$app->user->can('userViewBO')) {
          return $this->redirect(['site/login']);
      }

        return $this->render('view', [
            'model' => $this->findModel($id),
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

        $user = User::findOne($id);

        if(!$user){
          throw new NotFoundHttpException('O utilizador não existe.');
        }

        $profile = Profile::findOne(['userID' => $id]);

        if(!$profile){
          throw new NotFoundHttpException('O perfil do utilizador não existe.');
        }
        if ($user->load($this->request->post()) && $profile->load($this->request->post())) {

          $isValidalide = $user->validate() && $profile->validate();

          if($isValidalide){
            $user->save();
            $profile->save();
            return $this->redirect(['view', 'id' => $user->id]);
          }
        }

        /*$model = $this->findModel($id);*/
        /**/
        /*if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {*/
        /*    return $this->redirect(['view', 'id' => $model->id]);*/
        /*}*/
        /**/
 
        return $this->render('update', [
          'user' => $user,
          'profile' => $profile,

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
        $profile = Profile::findOne(['user_id' => $id]);

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
