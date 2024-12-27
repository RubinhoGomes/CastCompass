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
 * @property int $metodoPagamentoID
 * @property int $metodoExpedicaoID
 *
 * @property Carrinho $carrinho
 * @property Linhafatura[] $linhafaturas
 * @property Metodoexpedicao $metodoExpedicao
 * @property Metodopagamento $metodoPagamento
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
            [['carrinhoID', 'valorTotal', 'ivaTotal', 'metodoPagamentoID', 'metodoExpedicaoID'], 'required'],
            [['carrinhoID', 'metodoPagamentoID', 'metodoExpedicaoID'], 'integer'],
            [['valorTotal', 'ivaTotal'], 'number'],
            [['carrinhoID'], 'exist', 'skipOnError' => true, 'targetClass' => Carrinho::class, 'targetAttribute' => ['carrinhoID' => 'id']],
            [['metodoExpedicaoID'], 'exist', 'skipOnError' => true, 'targetClass' => Metodoexpedicao::class, 'targetAttribute' => ['metodoExpedicaoID' => 'id']],
            [['metodoPagamentoID'], 'exist', 'skipOnError' => true, 'targetClass' => Metodopagamento::class, 'targetAttribute' => ['metodoPagamentoID' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'carrinhoID' => 'Carrinho',
            'valorTotal' => 'Valor Total',
            'ivaTotal' => 'Iva Total',
            'metodoPagamentoID' => 'Metodo Pagamento',
            'metodoExpedicaoID' => 'Metodo Expedicao',
        ];
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
     * Gets query for [[Linhafaturas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLinhafaturas()
    {
        return $this->hasMany(Linhafatura::class, ['faturaID' => 'id']);
    }

    /**
     * Gets query for [[MetodoExpedicao]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMetodoExpedicao()
    {
        return $this->hasOne(Metodoexpedicao::class, ['id' => 'metodoExpedicaoID']);
    }

    /**
     * Gets query for [[MetodoPagamento]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMetodoPagamento()
    {
        return $this->hasOne(Metodopagamento::class, ['id' => 'metodoPagamentoID']);
    }
}
