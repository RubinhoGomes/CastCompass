<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "metodopagamento".
 *
 * @property int $id
 * @property string $nome
 * @property string $tipo
 *
 * @property Fatura[] $faturas
 */
class Metodopagamento extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'metodopagamento';
    }

    public function getMetodos()
    {
        return [
            'Cartao' => 'Cartão de Crédito',
            'MBWay' => 'MBWay',
            'Email' => 'Email',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome', 'tipo'], 'required'],
            [['tipo'], 'string'],
            [['nome'], 'string', 'max' => 255],
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
            'tipo' => 'Tipo',
        ];
    }

    /**
     * Gets query for [[Faturas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFaturas()
    {
        return $this->hasMany(Fatura::class, ['metodoPagamentoID' => 'id']);
    }
}
