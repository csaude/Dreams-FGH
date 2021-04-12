<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\CurriculumServicos;

/**
 * CurriculumServicosSearch represents the model behind the search form about `app\models\CurriculumServicos`.
 */
class CurriculumServicosSearch extends CurriculumServicos
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['curriculum_id', 'servico_id', 'status', 'criado_por', 'actualizado_por'], 'integer'],
            [['description', 'criado_em', 'actualizado_em', 'user_location', 'user_location2'], 'safe'],
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
        $query = CurriculumServicos::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'curriculum_id' => $this->curriculum_id,
            'servico_id' => $this->servico_id,
            'status' => $this->status,
            'criado_por' => $this->criado_por,
            'actualizado_por' => $this->actualizado_por,
            'criado_em' => $this->criado_em,
            'actualizado_em' => $this->actualizado_em,
        ]);

        $query->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'user_location', $this->user_location])
            ->andFilterWhere(['like', 'user_location2', $this->user_location2]);

        return $dataProvider;
    }
}
