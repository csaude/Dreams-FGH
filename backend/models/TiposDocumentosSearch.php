<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TiposDocumentos;

/**
 * TiposDocumentosSearch represents the model behind the search form about `app\models\TiposDocumentos`.
 */
class TiposDocumentosSearch extends TiposDocumentos
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'exigencia', 'status', 'criado_por', 'actualizado_por'], 'integer'],
            [['name','abrev', 'descricao', 'validade', 'criado_em', 'actualizado_em', 'user_location'], 'safe'],
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
        $query = TiposDocumentos::find();

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
            'id' => $this->id,
            'exigencia' => $this->exigencia,
            'status' => $this->status,
            'criado_por' => $this->criado_por,
            'actualizado_por' => $this->actualizado_por,
            'criado_em' => $this->criado_em,
            'actualizado_em' => $this->actualizado_em,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'abrev', $this->abrev])
            ->andFilterWhere(['like', 'descricao', $this->descricao])
            ->andFilterWhere(['like', 'validade', $this->validade])
            ->andFilterWhere(['like', 'user_location', $this->user_location]);

        return $dataProvider;
    }
}
