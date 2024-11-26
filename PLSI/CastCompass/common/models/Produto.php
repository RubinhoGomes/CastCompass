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
 * @property int $imagemID
 *
 * @property Categoria $categoria
 * @property Favorito[] $favoritos
 * @property Imagem $imagem
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
            [['nome', 'marca', 'preco', 'stock', 'descricao', 'categoriaID', 'imagemID'], 'required'],
            [['preco'], 'number'],
            [['stock', 'categoriaID', 'imagemID'], 'integer'],
            [['descricao'], 'string'],
            [['nome', 'marca'], 'string', 'max' => 255],
            [['categoriaID'], 'exist', 'skipOnError' => true, 'targetClass' => Categoria::class, 'targetAttribute' => ['categoriaID' => 'id']],
            [['imagemID'], 'exist', 'skipOnError' => true, 'targetClass' => Imagem::class, 'targetAttribute' => ['imagemID' => 'id']],
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
            'categoriaID' => 'Categoria ID',
            'imagemID' => 'Imagem ID',
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
    public function getImagem()
    {
        return $this->hasOne(Imagem::class, ['id' => 'imagemID']);
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
