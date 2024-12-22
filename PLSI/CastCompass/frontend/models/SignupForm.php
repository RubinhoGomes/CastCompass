<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;
use common\models\Profile;
use common\models\Carrinho;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $nome;
    public $nif;
    public $dtaNascimento;
    public $genero;
    public $telemovel;
    public $morada;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
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


    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
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

        $carrinho = new Carrinho();
        $carrinho->profileID = $profile->id;
        $carrinho->dataCompra = NULL;
        $carrinho->valorTotal = NULL;
        $carrinho->quantidade = NULL;
        $carrinho->metodoPagamentoID = NULL;
        $carrinho->metodoExpedicaoID = NULL;
        $carrinho->save(false);


        return $user;
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
