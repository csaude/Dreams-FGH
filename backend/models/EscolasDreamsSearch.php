<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\EscolasDreams;

/**
 * EscolasDreamsSearch represents the model behind the search form about `app\models\EscolasDreams`.
 */
class EscolasDreamsSearch extends EscolasDreams
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'distrito_id', 'bairro_id', 'criado_por', 'actualizado_por'], 'integer'],
            [['lat', 'lng', 'name', 'description', 'criado_em', 'actualizado_em', 'user_location', 'user_location2'], 'safe'],
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
        $query = EscolasDreams::find();

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
            'distrito_id' => $this->distrito_id,
            'bairro_id' => $this->bairro_id,
            'criado_por' => $this->criado_por,
            'actualizado_por' => $this->actualizado_por,
            'criado_em' => $this->criado_em,
            'actualizado_em' => $this->actualizado_em,
        ]);

        $query->andFilterWhere(['like', 'lat', $this->lat])
            ->andFilterWhere(['like', 'lng', $this->lng])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'user_location', $this->user_location])
            ->andFilterWhere(['like', 'user_location2', $this->user_location2]);

        return $dataProvider;
    }
}
