<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Quotas;

/**
 * QuotasSearch represents the model behind the search form about `app\models\Quotas`.
 */
class QuotasSearch extends Quotas
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id','quota_id', 'member_id', 'meio_pagamento', 'local_pagamento', 'status', 'criado_por', 'actualizado_por'], 'integer'],
            [['data_pagamento', 'receptor', 'description', 'criado_em', 'actualizado_em', 'user_location', 'user_location2'], 'safe'],
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
        $query = Quotas::find();

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
            'quota_id'=> $this->quota_id,
            'member_id' => $this->member_id,
            'meio_pagamento' => $this->meio_pagamento,
            'local_pagamento' => $this->local_pagamento,
            'status' => $this->status,
            'criado_por' => $this->criado_por,
            'actualizado_por' => $this->actualizado_por,
            'criado_em' => $this->criado_em,
            'actualizado_em' => $this->actualizado_em,
        ]);

        $query->andFilterWhere(['like', 'data_pagamento', $this->data_pagamento])
            ->andFilterWhere(['like', 'receptor', $this->receptor])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'user_location', $this->user_location])
            ->andFilterWhere(['like', 'user_location2', $this->user_location2]);

        return $dataProvider;
    }
}
