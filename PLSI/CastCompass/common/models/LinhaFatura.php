<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "linhafatura".
 *
 * @property int $id
 * @property int $faturaID
 * @property int $ivaID
 * @property int $quantidade
 * @property float $valor
 * @property float $valorIva
 * @property int $produtoID
 *
 * @property Fatura $fatura
 * @property Iva $iva
 * @property Produto $produto
 */
class Linhafatura extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'linhafatura';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['faturaID', 'ivaID', 'quantidade', 'valor', 'valorIva', 'produtoID'], 'required'],
            [['faturaID', 'ivaID', 'quantidade', 'produtoID'], 'integer'],
            [['valor', 'valorIva'], 'number'],
            [['faturaID'], 'exist', 'skipOnError' => true, 'targetClass' => Fatura::class, 'targetAttribute' => ['faturaID' => 'id']],
            [['ivaID'], 'exist', 'skipOnError' => true, 'targetClass' => Iva::class, 'targetAttribute' => ['ivaID' => 'id']],
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
            'faturaID' => 'Fatura ID',
            'ivaID' => 'Iva ID',
            'quantidade' => 'Quantidade',
            'valor' => 'Valor',
            'valorIva' => 'Valor Iva',
            'produtoID' => 'Produto ID',
        ];
    }

    /**
     * Gets query for [[Fatura]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFatura()
    {
        return $this->hasOne(Fatura::class, ['id' => 'faturaID']);
    }

    /**
     * Gets query for [[Iva]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIva()
    {
        return $this->hasOne(Iva::class, ['id' => 'ivaID']);
    }

    /**
     * Gets query for [[Produto]].
     *
     * @return \yii\db\ActiveQuery1000
     */
    public function getProduto()
    {
        return $this->hasOne(Produto::class, ['id' => 'produtoID']);
    }
}
