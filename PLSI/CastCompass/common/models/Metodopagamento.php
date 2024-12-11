<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "metodopagamento".
 *
 * @property int $id
 * @property string $nome
 *
 * @property Carrinhocompra[] $carrinhocompras
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

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome'], 'required'],
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
        ];
    }

    /**
     * Gets query for [[Carrinhocompras]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCarrinhocompras()
    {
        return $this->hasMany(Carrinhocompra::class, ['metodoPagamentoID' => 'id']);
    }
}
