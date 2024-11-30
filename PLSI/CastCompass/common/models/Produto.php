<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "produto".
 *
 * @property int $id
 * @property string $nome
 * @property string $marca
 * @property float $preco
 * @property int $stock
 * @property string $descricao
 * @property int $categoriaID
 *
 * @property Categoria $categoria
 * @property Favorito[] $favoritos
 * @property Imagem[] $imagens
 * @property Itemscarrinho[] $itemscarrinhos
 */
class Produto extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'produto';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome', 'marca', 'preco', 'stock', 'descricao', 'categoriaID'], 'required', 'message' => '{attribute} não pode estar vazio'],
            [['preco'], 'number'],
            [['stock', 'categoriaID'], 'integer'],
            [['descricao'], 'string'],
            [['nome', 'marca'], 'string', 'max' => 255],
            [['categoriaID'], 'exist', 'skipOnError' => true, 'targetClass' => Categoria::class, 'targetAttribute' => ['categoriaID' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nome' => 'Nome',
            'marca' => 'Marca',
            'preco' => 'Preco',
            'stock' => 'Stock',
            'descricao' => 'Descricao',
            'categoriaID' => 'Categoria',
        ];
    }

    /**
     * Gets query for [[Categoria]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategoria()
    {
        return $this->hasOne(Categoria::class, ['id' => 'categoriaID']);
    }

    /**
     * Gets query for [[Favoritos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFavoritos()
    {
        return $this->hasMany(Favorito::class, ['produtoID' => 'id']);
    }

    /**
     * Gets query for [[Imagem]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getImagens()
    {
        return $this->hasMany(Imagem::class, ['produtoID' => 'id']);
    }

    /**
     * Gets query for [[Itemscarrinhos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getItemscarrinhos()
    {
        return $this->hasMany(Itemscarrinho::class, ['produtoID' => 'id']);
    }
}
