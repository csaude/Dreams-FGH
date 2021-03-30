<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ReferenciasDreams;


use yii\helpers\ArrayHelper;
/**
 * ReferenciasDreamsSearch represents the model behind the search form about `app\models\ReferenciasDreams`.
 */
class ReferenciasDreamsSearch extends ReferenciasDreams
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'beneficiario_id', 'referido_por', 'notificar_ao', 'status', 'criado_por', 'actualizado_por'], 'integer'],
            [['status_ref','nota_referencia', 'name', 'projecto', 'description', 'criado_em', 'actualizado_em', 'user_location', 'user_location2','refer_to'], 'safe'],
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
      if (isset(Yii::$app->user->identity->provin_code)&&(Yii::$app->user->identity->provin_code>0)) {
      $prov=Yii::$app->user->identity->provin_code;
      $provis = Provincias::find()->where(['id'=>$prov])->asArray()->one();
      $dist= Distritos::find()->where(['province_code'=>$provis])->asArray()->all();

      $bens=Beneficiarios::find()->where(['IN','district_code',$dist])->andWhere(['emp_status'=>1])->asArray()->all();
      $ben_id=ArrayHelper::getColumn($bens, 'id');
       $referidos=ReferenciasDreams::find()->where(['IN','beneficiario_id',$ben_id])->andWhere(['status'=>1])->asArray()->all();
      $ids = ArrayHelper::getColumn($referidos, 'beneficiario_id');
$query = ReferenciasDreams::find()->where(['IN','beneficiario_id',$ids])->andWhere(['status'=>1])->orderBy(['criado_em' => SORT_DESC]);
    } else {
        $query = ReferenciasDreams::find()->where(['status'=>1])->orderBy(['criado_em' => SORT_DESC]);
}

// $query = ReferenciasDreams::find()->orderBy(['criado_em' => SORT_DESC]);;

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
	    'status_ref' => $this->status_ref,
            'criado_por' => $this->criado_por,
            'actualizado_por' => $this->actualizado_por,
            'criado_em' => $this->criado_em,
	    'refer_to'=>$this->refer_to,
            'actualizado_em' => $this->actualizado_em,
        ]);

        $query->andFilterWhere(['like', 'nota_referencia', $this->nota_referencia])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['=', 'projecto', $this->projecto])
	    ->andFilterWhere(['=', 'notificar_ao', $this->notificar_ao])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'user_location', $this->user_location])
	    ->andFilterWhere(['like', 'refer_to', $this->refer_to])
            ->andFilterWhere(['like', 'user_location2', $this->user_location2]);

        return $dataProvider;
    }
}
