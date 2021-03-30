<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\GuiaReferencias;

/**
 * GuiaReferenciasSearch represents the model behind the search form about `app\models\GuiaReferencias`.
 */
class GuiaReferenciasSearch extends GuiaReferencias
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'beneficiario_id', 'referido_por', 'notificar_ao', 'status', 'criado_por', 'actualizado_por'], 'integer'],
            [['name', 'projecto', 'description', 'criado_em', 'actualizado_em', 'user_location', 'user_location2'], 'safe'],
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
        $query = GuiaReferencias::find();

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
            'beneficiario_id' => $this->beneficiario_id,
            'referido_por' => $this->referido_por,
            'notificar_ao' => $this->notificar_ao,
            'status' => $this->status,
            'criado_por' => $this->criado_por,
            'actualizado_por' => $this->actualizado_por,
            'criado_em' => $this->criado_em,
            'actualizado_em' => $this->actualizado_em,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'projecto', $this->projecto])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
