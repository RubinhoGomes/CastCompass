<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "metodoexpedicao".
 *
 * @property int $id
 * @property string $nome
 *
 * @property Carrinhocompra[] $carrinhocompras
 */
class Metodoexpedicao extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'metodoexpedicao';
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
        return $this->hasMany(Carrinhocompra::class, ['metodoExpedicaoID' => 'id']);
    }
}
