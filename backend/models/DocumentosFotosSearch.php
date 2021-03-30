<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\DocumentosFotos;

/**
 * DocumentosFotosSearch represents the model behind the search form about `app\models\DocumentosFotos`.
 */
class DocumentosFotosSearch extends DocumentosFotos
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'tipos_documentos_id', 'emp_number', 'criado_por', 'actualizado_por', 'status'], 'integer'],
            [['anexo', 'criado_em', 'actualizado_em', 'user_location'], 'safe'],
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
        $query = DocumentosFotos::find();

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
            'tipos_documentos_id' => $this->tipos_documentos_id,
            'emp_number' => $this->emp_number,
            'criado_por' => $this->criado_por,
            'actualizado_por' => $this->actualizado_por,
            'criado_em' => $this->criado_em,
            'actualizado_em' => $this->actualizado_em,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'anexo', $this->anexo])
            ->andFilterWhere(['like', 'user_location', $this->user_location]);

        return $dataProvider;
    }
}
