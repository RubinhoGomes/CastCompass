<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "fatura".
 *
 * @property int $id
 * @property int $carrinhoID
 * @property float $valorTotal
 * @property float $ivaTotal
 *
 * @property Carrinhocompra $carrinho
 * @property Linhafatura[] $linhafaturas
 */
class Fatura extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'fatura';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['carrinhoID', 'valorTotal', 'ivaTotal'], 'required'],
            [['carrinhoID'], 'integer'],
            [['valorTotal', 'ivaTotal'], 'number'],
            [['carrinhoID'], 'exist', 'skipOnError' => true, 'targetClass' => Carrinhocompra::class, 'targetAttribute' => ['carrinhoID' => 'id']],
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
            'valorTotal' => 'Valor Total',
            'ivaTotal' => 'Iva Total',
        ];
    }

    /**
     * Gets query for [[Carrinho]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCarrinho()
    {
        return $this->hasOne(Carrinhocompra::class, ['id' => 'carrinhoID']);
    }

    /**
     * Gets query for [[Linhafaturas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLinhafaturas()
    {
        return $this->hasMany(Linhafatura::class, ['faturaID' => 'id']);
    }
}
