<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Distritos;

/**
 * DistritosSearch represents the model behind the search form about `app\models\Distritos`.
 */
class DistritosSearch extends Distritos
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['district_code','cod_distrito', 'district_name', 'province_code'], 'safe'],
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
        $query = Distritos::find();

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
        $query->andFilterWhere(['like', 'district_code', $this->district_code])
            ->andFilterWhere(['like', 'district_name', $this->district_name])
			->andFilterWhere(['like', 'cod_distrito', $this->cod_distrito])
            ->andFilterWhere(['like', 'province_code', $this->province_code]);

        return $dataProvider;
    }
}
