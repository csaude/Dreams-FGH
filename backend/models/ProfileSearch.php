<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Profile;

/**
 * ProfileSearch represents the model behind the search form about `app\models\Profile`.
 */
class ProfileSearch extends Profile
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
      return [
          [['user_id', 'name', 'public_email', 'gravatar_email', 'gravatar_id', 'location', 'website', 'bio'], 'required'],
          [['user_id'], 'integer'],
          [['bio'], 'string'],
          [['name', 'public_email', 'gravatar_email', 'location', 'website'], 'string', 'max' => 255],
          [['gravatar_id'], 'string', 'max' => 100],
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
        $query = Profile::find();

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
          'user_id' => $this->user_id,
          'name' => $this->name,
          'public_email' => $this->public_email,
          'gravatar_email' => $this->gravatar_email,
          'gravatar_id' => $this->gravatar_id,
          'location' => $this->location,
          'website' => $this->website,
          'bio' => $this->bio,
        ]);

        $query->andFilterWhere(['like', 'id', $this->id])
            ->andFilterWhere(['like', 'user_id', $this->user_id])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'public_email', $this->public_email])
            ->andFilterWhere(['like', 'gravatar_id', $this->gravatar_id])
            ->andFilterWhere(['like', 'location', $this->location])
            ->andFilterWhere(['like', 'website', $this->website])
            ->andFilterWhere(['like', 'bio', $this->bio]);

        return $dataProvider;
    }
}

