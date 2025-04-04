<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Carrinho;

/**
 * CarrinhoSearch represents the model behind the search form of `common\models\Carrinho`.
 */
class CarrinhoSearch extends Carrinho
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'profileID', 'quantidade', 'metodoExpedicaoID', 'metodoPagamentoID'], 'integer'],
            [['dataCompra'], 'safe'],
            [['valorTotal'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Carrinho::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'profileID' => $this->profileID,
            'dataCompra' => $this->dataCompra,
            'valorTotal' => $this->valorTotal,
            'quantidade' => $this->quantidade,
            'metodoExpedicaoID' => $this->metodoExpedicaoID,
            'metodoPagamentoID' => $this->metodoPagamentoID,
        ]);

        return $dataProvider;
    }
}
