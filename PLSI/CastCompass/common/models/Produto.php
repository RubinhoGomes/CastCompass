<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "produto".
 *
 * @property int $id
 * @property string $nome
 * @property string $marca
 * @property float $preco
 * @property int $stock
 * @property string $descricao
 * @property int $categoriaID
 *
 * @property Categoria $categoria
 * @property Favorito[] $favoritos
 * @property Imagem[] $imagens
 * @property Itemscarrinho[] $itemscarrinhos
 */
class Produto extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'produto';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome', 'marca', 'preco', 'stock', 'descricao', 'categoriaID', 'ivaID'], 'required', 'message' => '{attribute} não pode estar vazio'],
            [['preco'], 'number'],
            [['stock', 'categoriaID'], 'integer'],
            [['descricao'], 'string'],
            [['nome', 'marca'], 'string', 'max' => 255],
            [['categoriaID'], 'exist', 'skipOnError' => true, 'targetClass' => Categoria::class, 'targetAttribute' => ['categoriaID' => 'id']],
            [['ivaID'], 'exist', 'skipOnError' => true, 'targetClass' => Iva::class, 'targetAttribute' => ['ivaID' => 'id']],
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
            'marca' => 'Marca',
            'preco' => 'Preco',
            'stock' => 'Stock',
            'descricao' => 'Descricao',
            'categoriaID' => 'Categoria',
            'ivaID' => 'Iva',
        ];
    }


    /**
     * @brief This function adds the IVA to the price
     * @ It calculates the price with the IVA, given the price and the IVA ID
     * @param $preco
     * @param $idIva
     * @return float
     */
    public function addIvaPrice($preco, $idIva){
      $iva = Iva::findOne($idIva);
      $preco += ($preco * $iva->valor);
      return $preco;
    }


    /**
     * @brief This function is called before saving the model
     * @param $preco
     * {@inheritdoc}
     */
    public function beforeSave($insert){
        if(parent::beforeSave($insert)){
          $this->preco = $this->addIvaPrice($this->preco, $this->ivaID);
          return true;
        }
        return false;
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        $id=$this->id;
        $nome=$this->nome;
        $marca=$this->marca;
        $preco=$this->preco;
        $stock=$this->stock;
        $descricao=$this->descricao;
        $categoriaID=$this->categoriaID;
        $ivaID=$this->ivaID;

        $mensagem = "Um novo produto {$this->nome} foi adicionado.";
        $mensagem2 = "O produto {$this->nome} foi atualizado.";

        if($insert)
            $this->FazPublishNoMosquitto("INSERT",$mensagem);
        else
            $this->FazPublishNoMosquitto("UPDATE",$mensagem2);
    }
        public function beforeDelete()
    {
        if (parent::beforeDelete()) {
            foreach ($this->imagens as $imagem) {
                $imagem->delete();
            }

            foreach ($this->favoritos as $favorito) {
                $favorito->delete();
            }

            foreach ($this->itemscarrinhos as $item) {
                $item->delete();
            }

            return true;
        }

        return false;
    }

    public function afterDelete()
    {
        parent::afterDelete();

        $message = "O produto {$this->nome} foi eliminado.";

        $this->FazPublishNoMosquitto('DELETE', $message);
    }


    private function FazPublishNoMosquitto($canal, $msg)
    {
        $server = '127.0.0.1';
        $port = 1883;
        $username = "admin";
        $password = "12345678";
        $client_id = 'phpMQTT-publisher';

        $mqtt = new \common\mosquitto\phpMQTT($server, $port, $client_id);

        if ($mqtt->connect(true, NULL, $username, $password)) {
            $mqtt->publish($canal, $msg, 0);
            $mqtt->close();
        } else {
            file_put_contents("debug.output","Time out!");
        }
    }

    /**
     * Gets query for [[Categoria]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategoria()
    {
        return $this->hasOne(Categoria::class, ['id' => 'categoriaID']);
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
     * Gets query for [[Favoritos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFavoritos()
    {
        return $this->hasMany(Favorito::class, ['produtoID' => 'id']);
    }

    /**
     * Gets query for [[Imagem]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getImagens()
    {
        return $this->hasMany(Imagem::class, ['produtoID' => 'id']);
    }

    /**
     * Gets query for [[Itemscarrinhos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getItemscarrinhos()
    {
        return $this->hasMany(Itemscarrinho::class, ['produtoID' => 'id']);
    }
}
