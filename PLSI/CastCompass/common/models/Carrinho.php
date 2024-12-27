<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "carrinho".
 *
 * @property int $id
 * @property int $profileID
 * @property float $valorTotal
 * @property int $quantidade
 *
 * @property Fatura[] $faturas
 * @property Itemscarrinho[] $itemscarrinhos
 * @property Profile $profile
 */
class Carrinho extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'carrinho';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['profileID', 'valorTotal', 'quantidade'], 'required'],
            [['profileID', 'quantidade'], 'integer'],
            [['valorTotal'], 'number'],
            [['profileID'], 'exist', 'skipOnError' => true, 'targetClass' => Profile::class, 'targetAttribute' => ['profileID' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'profileID' => 'Utilizador',
            'valorTotal' => 'Valor Total',
            'quantidade' => 'Quantidade',
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
     * Gets query for [[Profile]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProfile()
    {
        return $this->hasOne(Profile::class, ['id' => 'profileID']);
    }
}
