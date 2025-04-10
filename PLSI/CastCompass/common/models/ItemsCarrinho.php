<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "itemscarrinho".
 *
 * @property int $id
 * @property int $carrinhoID
 * @property int $produtoID
 * @property string $nome
 * @property int $quantidade
 * @property float $valorTotal
 *
 * @property Carrinho $carrinho
 * @property Produto $produto
 */
class ItemsCarrinho extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'itemscarrinho';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['carrinhoID', 'produtoID', 'nome', 'quantidade', 'valorTotal'], 'required'],
            [['carrinhoID', 'produtoID', 'quantidade'], 'integer'],
            [['valorTotal'], 'number'],
            [['nome'], 'string', 'max' => 255],
            [['carrinhoID'], 'exist', 'skipOnError' => true, 'targetClass' => Carrinho::class, 'targetAttribute' => ['carrinhoID' => 'id']],
            [['produtoID'], 'exist', 'skipOnError' => true, 'targetClass' => Produto::class, 'targetAttribute' => ['produtoID' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'carrinhoID' => 'Carrinho ID',
            'produtoID' => 'Produto ID',
            'nome' => 'Nome',
            'quantidade' => 'Quantidade',
            'valorTotal' => 'Valor Total',
        ];
    }

    public function getImagem() {
      $produto = Produto::findOne(['id' => $this->produtoID]);

      if($produto != NULL && !empty($produto->imagens)) {
        return $produto->imagens[0]->filename;
      }

      return NULL;
    }

    /**
     * Gets query for [[Carrinho]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCarrinho()
    {
        return $this->hasOne(Carrinho::class, ['id' => 'carrinhoID']);
    }

    /**
     * Gets query for [[Produto]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProduto()
    {
        return $this->hasOne(Produto::class, ['id' => 'produtoID']);
    }
}
