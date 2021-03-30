<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Utilizadores;

/**
 * UtilizadoresSearch represents the model behind the search form about `app\models\Utilizadores`.
 */
class UtilizadoresSearch extends Utilizadores
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'provin_code', 'city_code', 'localidade_id', 'us_id', 'parceiro_id', 'role', 'status', 'ccord_id', 'confirmed_at', 'blocked_at', 'confirmation_sent_at', 'entry_point','recovery_sent_at', 'registered_from', 'logged_in_from', 'logged_in_at'], 'integer'],
            [['username', 'email', 'name', 'user_location2', 'password_hash', 'auth_key', 'password_reset_token', 'district_code', 'created_at', 'updated_at', 'confirmation_token', 'unconfirmed_email', 'recovery_token', 'registration_ip','phone_number'], 'safe'],
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
        $query = Utilizadores::find()->where(['>','id',1]);

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
            'provin_code' => $this->provin_code,
            'city_code' => $this->city_code,
            'localidade_id' => $this->localidade_id,
            'us_id' => $this->us_id,
            'parceiro_id' => $this->parceiro_id,
            'entry_point'=>$this->entry_point,
            'role' => $this->role,
            'status' => $this->status,
            'ccord_id' => $this->ccord_id,
            'confirmed_at' => $this->confirmed_at,
            'blocked_at' => $this->blocked_at,
            'confirmation_sent_at' => $this->confirmation_sent_at,
            'recovery_sent_at' => $this->recovery_sent_at,
            'registered_from' => $this->registered_from,
            'logged_in_from' => $this->logged_in_from,
            'logged_in_at' => $this->logged_in_at,
            'phone_number'=> $this->phone_number,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'name', $this->name])
           ->andFilterWhere(['like', 'phone_number', $this->phone_number])
            ->andFilterWhere(['like', 'user_location2', $this->user_location2])
            ->andFilterWhere(['like', 'password_hash', $this->password_hash])
            ->andFilterWhere(['like', 'auth_key', $this->auth_key])
            ->andFilterWhere(['like', 'password_reset_token', $this->password_reset_token])
            ->andFilterWhere(['like', 'district_code', $this->district_code])
            ->andFilterWhere(['like', 'created_at', $this->created_at])
            ->andFilterWhere(['like', 'updated_at', $this->updated_at])
            ->andFilterWhere(['like', 'confirmation_token', $this->confirmation_token])
            ->andFilterWhere(['like', 'unconfirmed_email', $this->unconfirmed_email])
            ->andFilterWhere(['like', 'recovery_token', $this->recovery_token])
            ->andFilterWhere(['like', 'registration_ip', $this->registration_ip]);

        return $dataProvider;
    }
}
