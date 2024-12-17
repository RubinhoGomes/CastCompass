<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "carrinhocompra".
 *
 * @property int $id
 * @property int $profileID
 * @property string $dataCompra
 * @property float $valorTotal
 * @property int $quantidade
 * @property int $metodoExpedicaoID
 * @property int $metodoPagamentoID
 *
 * @property Fatura[] $faturas
 * @property Itemscarrinho[] $itemscarrinhos
 * @property Metodoexpedicao $metodoExpedicao
 * @property Metodopagamento $metodoPagamento
 * @property Profile $profile
 */
class CarrinhoCompra extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'carrinhocompra';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['profileID', 'dataCompra', 'valorTotal', 'quantidade', 'metodoExpedicaoID', 'metodoPagamentoID'], 'required'],
            [['profileID', 'quantidade', 'metodoExpedicaoID', 'metodoPagamentoID'], 'integer'],
            [['dataCompra'], 'safe'],
            [['valorTotal'], 'number'],
            [['profileID'], 'exist', 'skipOnError' => true, 'targetClass' => Profile::class, 'targetAttribute' => ['profileID' => 'id']],
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
            'profileID' => 'Profile ID',
            'dataCompra' => 'Data Compra',
            'valorTotal' => 'Valor Total',
            'quantidade' => 'Quantidade',
            'metodoExpedicaoID' => 'Metodo Expedicao ID',
            'metodoPagamentoID' => 'Metodo Pagamento ID',
        ];
    }

    /**
     * Gets query for [[Faturas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFaturas()
    {
        return $this->hasMany(Fatura::class, ['carrinhoID' => 'id']);
    }

    /**
     * Gets query for [[Itemscarrinhos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getItemscarrinhos()
    {
        return $this->hasMany(Itemscarrinho::class, ['carrinhoID' => 'id']);
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

    /**
     * Gets query for [[Profile]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProfile()
    {
        return $this->hasOne(Profile::class, ['id' => 'profileID']);
    }
}
