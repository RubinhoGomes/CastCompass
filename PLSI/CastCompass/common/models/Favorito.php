<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "favorito".
 *
 * @property int $id
 * @property int $profileID
 * @property int $produtoID
 *
 * @property Produto $produto
 * @property Profile $profile
 */
class Favorito extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'favorito';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['profileID', 'produtoID'], 'required'],
            [['profileID', 'produtoID'], 'integer'],
            [['profileID'], 'exist', 'skipOnError' => true, 'targetClass' => Profile::class, 'targetAttribute' => ['profileID' => 'id']],
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
            'profileID' => 'Profile ID',
            'produtoID' => 'Produto ID',
        ];
    }

    /*
     * @brief This function returns the "keyword" to the icon. If the favourite doens't exists
     * returns the "hollow / empty" keyword. Otherwise it returns the "full" keyword.
     */
    public static function getIcon($favorito) {
      if($favorito != null) {
        return "fas";
      }

      return "far";

    }

    /**
     * Gets query for [[Produto]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProduto()
    {
        return $this->hasOne(Produto::class, ['id' => 'produtoID']);
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
