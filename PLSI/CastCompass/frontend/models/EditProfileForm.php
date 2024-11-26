<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;
use common\models\Profile;

class EditProfileForm extends Model
{
    public $username;
    public $email;
    public $nome;
    public $nif;
    public $dtaNascimento;
    public $genero;
    public $telemovel;
    public $morada;



    public function rules()
    {
        return [

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
        ];
    }

    public function save()
    {
        if (!$this->validate()) {
            return yii::error($this->errors);
        }

        $this->profile->nome = $this->nome;
        $this->profile->nif = $this->nif;
        $this->profile->dtaNascimento = $this->dtaNascimento;
        $this->profile->genero = $this->genero;
        $this->profile->telemovel = $this->telemovel;
        $this->profile->morada = $this->morada;

        return $this->profile->save(false);
    }
}