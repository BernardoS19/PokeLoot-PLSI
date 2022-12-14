<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Pedido_avaliacao;

/**
 * Pedido_avaliacaoSearch represents the model behind the search form of `common\models\Pedido_avaliacao`.
 */
class Pedido_avaliacaoSearch extends Pedido_avaliacao
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'carta_id'], 'integer'],
            [['estado', 'data_avaliacao'], 'safe'],
            [['valor_avaliado'], 'number'],
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
    public function search($params, $filtro = null, $user = null)
    {
        $query = Pedido_avaliacao::find();

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
            'user_id' => $this->user_id,
            'carta_id' => $this->carta_id,
            'valor_avaliado' => $this->valor_avaliado,
            'data_avaliacao' => $this->data_avaliacao,
        ]);

        $query->andFilterWhere(['like', 'estado', $this->estado]);

        if ($filtro){
            switch ($filtro){
                case 'por_autorizar':
                    $query->andFilterWhere(['estado' => 'Por Autorizar']);
                    break;
                case 'avaliados':
                    $query->andFilterWhere(['estado' => 'Avaliado']);
                    break;
                case 'todos_autorizados':
                    $query->andFilterWhere(['estado' => 'Autorizado']);
                    break;
            }
            if ($filtro == 'autorizados' && $user){
                $query->andFilterWhere(['estado' => 'Autorizado', 'user_id' => $user]);
            }

        }
        if (!$filtro && $user){
            $query->andFilterWhere(['user_id' => $user]);
        }
        return $dataProvider;
    }
}
