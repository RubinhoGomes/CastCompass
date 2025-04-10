<?php

namespace backend\models;

use Yii;
use yii\rbac\Role;
use yii\base\Model;
use common\models\User;
use common\models\Profile;

/**
 * Signup form
 */
class UserForm extends Model
{
    public $id;
    public $username;
    public $email;
    public $password;
    public $nome;
    public $nif;
    public $dtaNascimento;
    public $genero;
    public $telemovel;
    public $morada;
    public $role;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
      return [
            ['role', 'required', 'message' => '{attribute} não pode estar vazio.'],
            
            ['username', 'trim'],
            ['username', 'required', 'message' => '{attribute} não pode estar vazio.'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required', 'message' => '{attribute} não pode estar vazio.'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['nome', 'trim'],
            ['nome', 'required', 'message' => '{attribute} não pode estar vazio.'],
            ['nome', 'string', 'max' => 255],

            ['nif', 'required', 'message' => '{attribute} não pode estar vazio.'],
            ['nif', 'string', 'max' => 50],

            // TODO: Data de Nascimento

            ['genero', 'required', 'message' => '{attribute} não pode estar vazio.'],
            ['genero', 'string', 'max' => 50],

            ['telemovel', 'required', 'message' => '{attribute} não pode estar vazio.'],
            ['telemovel', 'string', 'max' => 20],

            ['morada', 'required', 'message' => '{attribute} não pode estar vazia.'],
            ['morada', 'string', 'max' => 255],

            ['password', 'trim'],
            ['password', 'required', 'message' => '{attribute} não pode estar vazia.'],
            ['password', 'string', 'min' => Yii::$app->params['user.passwordMinLength']],
        ];
    }

/*
   public function __construct($id = null) {
      
      $user = User::findOne($id);
      $profile = Profile::findOne(['userID' => $id]);

      $UserForm = new UserForm();

      $UserForm->id = $user->id;
      $UserForm->username = $user->username;
      $UserForm->email = $user->email;
      $UserForm->nome = $profile->nome;
      $UserForm->nif = $profile->nif;
      $UserForm->dtaNascimento = $profile->dtaNascimento;
      $UserForm->genero = $profile->genero;
      $UserForm->telemovel = $profile->telemovel;
      $UserForm->morada = $profile->morada;

      $UserForm->role = Yii::$app->authManager->getRolesByUser($id);
  
      return $UserForm;
   }

 */
   /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */

    /*
    public function signup()
    {
        if (!$this->validate()) {
            return yii::error($this->errors);
        }

        $user = new User();
        $profile = new Profile();

        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();
        $user->status = User::STATUS_ACTIVE;
        $user->save(false);

        $profile->userID = $user->id;
        $profile->nome = $this->nome;
        $profile->nif = $this->nif;
        $profile->dtaNascimento = date('Y-m-d');
        $profile->genero = $this->genero;
        $profile->telemovel = $this->telemovel;
        $profile->morada = $this->morada;
        $profile->save(false);

        $auth = Yii::$app->authManager;
        $Role = $auth->getRole('client');
        $auth->assign($Role, $user->id);

        return $user;
    }
     */

    public function createForm() {

        if (!$this->validate()) {
            return null;
        }

        $user = new User();
        $profile = new Profile();

        // How this works?
        // Simple, we create an Role object, and we get the role from the authManager function
        // getRole, and we assign the role to the user. This way we can dinamically assign role
        $role = new Role();
        $role = Yii::$app->authManager->getRole($this->role);

        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();
        $user->status = User::STATUS_ACTIVE;
        $user->save();

        $profile->userID = $user->id;
        $profile->nome = $this->nome;
        $profile->nif = $this->nif;
        $profile->dtaNascimento = date('Y-m-d');
        $profile->genero = $this->genero;
        $profile->telemovel = $this->telemovel;
        $profile->morada = $this->morada;
        $profile->save(false);


        $this->id = $user->getId();
        
        $auth = Yii::$app->authManager;
        $auth->assign($role, $user->id);

        return $user;
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function updateForm() {
       /* if (!$this->validate()) {
            return null;
    }
        */

        $user = User::findOne($this->id);
        $profile = Profile::findOne(['userID' => $this->id]);

        $user->username = $this->username;
        $user->email = $this->email;
        $user->updated_at = date('Y-m-d H:i:s');
        $user->save(false);

        $profile->nome = $this->nome;
        $profile->nif = $this->nif;
        $profile->dtaNascimento = date('Y-m-d');
        $profile->genero = $this->genero;
        $profile->telemovel = $this->telemovel;
        $profile->morada = $this->morada;
        $profile->save(false);

        $auth = Yii::$app->authManager;
        $role = $auth->getRole($this->role);
        $auth->revokeAll($this->id);
        $auth->assign($role, $this->id);

        return true;
    }
 
    public function populateForm($id) {
      
      $user = User::findOne($id);
      $profile = Profile::findOne(['userID' => $id]);
  
      $userForm = new UserForm();
      
      $userForm->id = $user->id;
      $userForm->username = $user->username;
      $userForm->email = $user->email;
      $userForm->nome = $profile->nome;
      $userForm->nif = $profile->nif;
      $userForm->dtaNascimento = $profile->dtaNascimento;
      $userForm->genero = $profile->genero;
      $userForm->telemovel = $profile->telemovel;
      $userForm->morada = $profile->morada;

     $userForm->role = $user->getRole(); 

      return $userForm;
    }



    /**
     * Sends confirmation email to user
     * @param User $user user model to with email should be send
     * @return bool whether the email was sent
     */
    protected function sendEmail($user)
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($this->email)
            ->setSubject('Account registration at ' . Yii::$app->name)
            ->send();
    }

}
