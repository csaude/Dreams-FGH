<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ReferenciasDreams;


use yii\helpers\ArrayHelper;
/**
 * ReferenciasDreamsPendentesSearch represents the model behind the search form about `app\models\ReferenciasDreams`.
 */
class ReferenciasDreamsPendentesSearch extends ReferenciasDreams
{
    public $start;
    public $end;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nota_referencia', 'beneficiario_id','referido_por', 'notificar_ao','refer_to', 'projecto','start'], 'safe'],
            [['end'], 'safe']
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
            $query = ReferenciasDreams::find()->where(['IN','beneficiario_id',$ben_id])->andWhere(['status'=>1])->orderBy(['criado_em' => SORT_DESC]);
        } else {
            $query = ReferenciasDreams::find()->where(['status'=>1])->orderBy(['criado_em' => SORT_DESC]);
        }


        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'beneficiario_id' => $this->beneficiario_id,
            'criado_em' => $this->criado_em,
            'referido_por' => $this->referido_por,
            'notificar_ao' => $this->notificar_ao,
	        'refer_to'=>$this->refer_to,
        ]);

        // grid filtering conditions
       
        $query->andFilterWhere(['status_ref'=>0]); 
        $query->andFilterWhere(['>=', 'criado_em', $this->start])
            ->andFilterWhere(['<=', 'criado_em', $this->end])
            ->andFilterWhere(['like', 'nota_referencia', $this->nota_referencia])
            ->andFilterWhere(['=', 'projecto', $this->projecto])
	        ->andFilterWhere(['=', 'notificar_ao', $this->notificar_ao])
	        ->andFilterWhere(['like', 'refer_to', $this->refer_to])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }

    public function searchPendentes($ids){

        $query = ReferenciasDreams::find()->where(['in', 'id', $ids])->orderBy(['criado_em' => SORT_DESC]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $query->andWhere(['status_ref'=>0]);

        return $dataProvider;
    }
}
