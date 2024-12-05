<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "iva".
 *
 * @property int $id
 * @property float $valor
 * @property string $label
 *
 * @property Linhafatura[] $linhafaturas
 */
class Iva extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'iva';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['valor', 'label'], 'required'],
            [['valor'], 'number'],
            // Compare the value and return an error 
            ['valor', 'compare', 'compareValue' => 23, 'operator' => '<=', 'type' => 'number',
            'message' => 'O valor do IVA deve ser inferior a 23'],
            ['valor', 'compare', 'compareValue' => 1, 'operator' => '>=', 'type' => 'number',
            'message' => 'O valor do IVA deve ser superior ou igual a 1'],
            [['label'], 'string', 'max' => 150],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'valor' => 'Valor',
            'label' => 'Etiqueta',
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $this->valor = $this->valor / 100;
            return true;
        }
        return false;
    }

    /**
     * Gets query for [[Linhafaturas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLinhafaturas()
    {
        return $this->hasMany(Linhafatura::class, ['ivaID' => 'id']);
    }
    
    public function getProdutos()
    {
        return $this->hasMany(Produto::class, ['categoriaID' => 'id']);
    }
}
