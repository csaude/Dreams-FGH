<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Person;

/**
 * PersonSearch represents the model behind the search form about `app\models\Person`.
 */
class PersonSearch extends Person
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['emp_number'], 'integer'],
            [['emp_number', 'emp_firstname', 'emp_lastname', 'emp_gender'], 'safe'],
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
        $query = Person::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'emp_number' => $this->emp_number,
        ]);

        $query->andFilterWhere(['like', 'emp_number', $this->emp_number])
            ->andFilterWhere(['like', 'emp_firstname', $this->emp_firstname])
            ->andFilterWhere(['like', 'emp_lastname', $this->emp_lastname])
            ->andFilterWhere(['like', 'emp_gender', $this->emp_gender]);

        return $dataProvider;
    }
}
