<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ServicosBeneficiados;

/**
 * ServicosBeneficiadosSearch represents the model behind the search form about `app\models\ServicosBeneficiados`.
 */
class ServicosBeneficiadosSearch extends ServicosBeneficiados
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'beneficiario_id','servico_id', 'us_id', 'activista_id', 'status', 'criado_por', 'actualizado_por'], 'integer'],
            [[ 'data_beneficio', 'description', 'criado_em', 'actualizado_em', 'user_location', 'user_location2'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = ServicosBeneficiados::find();

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
            'servico_id' => $this->servico_id,
            'us_id' => $this->us_id,
            'activista_id' => $this->activista_id,
            'data_beneficio' => $this->data_beneficio,
            'status' => $this->status,
            'criado_por' => $this->criado_por,
            'actualizado_por' => $this->actualizado_por,
            'criado_em' => $this->criado_em,
            'actualizado_em' => $this->actualizado_em,
        ]);

        $query->andFilterWhere(['like', 'beneficiario_id', $this->beneficiario_id])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'user_location', $this->user_location])
            ->andFilterWhere(['like', 'user_location2', $this->user_location2]);

        return $dataProvider;
    }
}
