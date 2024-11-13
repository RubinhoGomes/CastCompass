<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "profile".
 *
 * @property int $id
 * @property int $userID
 * @property string $nif
 * @property string $nome
 * @property string $dtaNascimento
 * @property string $genero
 * @property string $telemovel
 * @property string $morada
 *
 * @property Carrinhocompra[] $carrinhocompras
 * @property Favorito[] $favoritos
 * @property User $user
 */
class Profile extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'profile';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'userID', 'nif', 'nome', 'dtaNascimento', 'genero', 'telemovel', 'morada'], 'required'],
            [['id', 'userID'], 'integer'],
            [['dtaNascimento'], 'safe'],
            [['nif', 'genero'], 'string', 'max' => 50],
            [['nome', 'morada'], 'string', 'max' => 255],
            [['telemovel'], 'string', 'max' => 20],
            [['id'], 'unique'],
            [['userID'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['userID' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'userID' => 'User ID',
            'nif' => 'NIF',
            'nome' => 'Nome',
            'dtaNascimento' => 'Data Nascimento',
            'genero' => 'Genero',
            'telemovel' => 'Telemovel',
            'morada' => 'Morada',
        ];
    }

    /**
     * Gets query for [[Carrinhocompras]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCarrinhocompras()
    {
        return $this->hasMany(Carrinhocompra::class, ['profileID' => 'id']);
    }

    /**
     * Gets query for [[Favoritos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFavoritos()
    {
        return $this->hasMany(Favorito::class, ['profileID' => 'id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'userID']);
    }
}
