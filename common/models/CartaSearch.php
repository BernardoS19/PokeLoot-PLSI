<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Carta;

/**
 * CartaSearch represents the model behind the search form of `common\models\Carta`.
 */
class CartaSearch extends Carta
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'verificado', 'imagem_id', 'tipo_id', 'elemento_id', 'colecao_id'], 'integer'],
            [['nome', 'descricao'], 'safe'],
            [['preco'], 'number'],
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
    public function search($params, $filtro = null)
    {
        $query = Carta::find();

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
            'preco' => $this->preco,
            'verificado' => $this->verificado,
            'imagem_id' => $this->imagem_id,
            'tipo_id' => $this->tipo_id,
            'elemento_id' => $this->elemento_id,
            'colecao_id' => $this->colecao_id,
        ]);

        $query->andFilterWhere(['like', 'nome', $this->nome])
            ->andFilterWhere(['like', 'descricao', $this->descricao]);

        if ($filtro){
            if ($filtro == 'sem_pedido'){
                //TODO: É PRECISO FAZER UM JOIN COM O PEDIDO_AVALIACAO PARA SABER SE JÁ EXISTE NUM PEDIDO OU NÃO
                $query->andFilterWhere(['verificado' => 0]);
            }
        }

        return $dataProvider;
    }
}
