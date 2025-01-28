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
 * @property int $metodoExpedicaoID
 * @property int $data
 * @property int $metodoPagamentoID
 * @property string $estado
 *
 * @property Carrinho $carrinho
 * @property Linhafatura[] $linhafaturas
 * @property Metodoexpedicao $metodoExpedicao
 * @property Metodopagamento $metodoPagamento
 */
class Fatura extends \yii\db\ActiveRecord
{

  public static function getEstado(int $position){
    switch ($position) {
      case 0:
        return "Em Processamento";
        break;
      case 1:
        return "Expedido";
        break;
      case 2:
        return "Entregue";
        break;
      default:
        return "Em Processamento";
        break;
    } 
  }

  public static function getEstadoPosition(string $estado){
    switch ($estado) {
      case "Em Processamento":
        return 0;
        break;
      case "Expedido":
        return 1;
        break;
      case "Entregue":
        return 2;
        break;
      default:
        return 0;
        break;
    }
  }

  public static function updateEstado(string $estado){
    switch ($estado) {
      case "Em Processamento":
        return "Expedido";
        break;
      case "Expedido":
        return "Entregue";
        break;
      default:
        return "Erro";
        break;
    }
  }
  
  public static function getUserId(Fatura $fatura){
    return $fatura->carrinho->profile->user->id;
  }



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
            [['carrinhoID', 'valorTotal', 'ivaTotal', 'metodoExpedicaoID', 'data', 'metodoPagamentoID'], 'required'],
            [['carrinhoID', 'metodoExpedicaoID', 'data', 'metodoPagamentoID'], 'integer'],
            [['valorTotal', 'ivaTotal'], 'number'],
            [['estado'], 'string'],
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
            'carrinhoID' => 'Carrinho ID',
            'valorTotal' => 'Valor Total',
            'ivaTotal' => 'Iva Total',
            'metodoExpedicaoID' => 'Metodo Expedicao ID',
            'data' => 'Data',
            'metodoPagamentoID' => 'Metodo Pagamento ID',
            'estado' => 'Estado',
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
