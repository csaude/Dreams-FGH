<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\BeneficiariosDreams;

/** criado em 10 de Marco 2019
 * BeneficiariosDreamsSearch represents the model behind the search form about `app\models\BeneficiariosDreams`.
 */
class BeneficiariosDreamsSearch extends BeneficiariosDreams
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
          [['id', 'emp_number', 'membro_zona', 'membro_circulo','us_id', 'membro_celula', 'membro_localidade_id', 'emp_smoker', 'nation_code', 'emp_gender', 'emp_status', 'job_title_code', 'eeo_cat_code', 'work_station', 'termination_id', 'criado_por', 'actualizado_por','ponto_entrada'], 'integer'],
          [['member_id','emp_lastname', 'emp_firstname','criado_em', 'emp_middle_name', 'emp_nick_name', 'membro_data_admissao', 'membro_caratao_eleitor', 'membro_cargo_partido_id', 'ethnic_race_code', 'emp_birthday', 'emp_marital_status', 'emp_ssn_num', 'emp_sin_num', 'emp_other_id', 'emp_dri_lice_num', 'emp_dri_lice_exp_date', 'emp_military_service', 'emp_street1', 'emp_street2', 'city_code', 'coun_code', 'provin_code', 'district_code', 'emp_zipcode', 'emp_hm_telephone', 'emp_mobile', 'emp_work_telephone', 'emp_work_email', 'sal_grd_code', 'joined_date', 'emp_oth_email', 'bi', 'nuit', 'passaporte', 'dire', 'bi_data_i', 'bi_data_f', 'custom3', 'other_prof_info', 'nuit_data_i', 'nuit_data_f', 'custom7', 'custom8', 'custom9', 'custom10', 'criado_em', 'actualizado_em', 'user_location', 'user_location2','deficiencia_tipo','idade_anos','estudante','estudante_classe','estudante_escola','gravida','filhos','bairro_id','encarregado_educacao','deficiencia','parceiro_id','house_sustainer','married_before','pregant_or_breastfeed','employed','tested_hiv','vbg_exploracao_sexual','vbg_migrante_trafico','vbg_sexual_activa','vbg_relacao_multipla','vbg_vitima','vbg_vitima_trafico','alcohol_drugs_use','sti_history','orphan'], 'safe'],
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
  /*  {
        $query = BeneficiariosDreams::find()->where(['emp_gender'=>2])->andWhere(['emp_status'=>1]);*/
        {
          $query = Beneficiarios::find()->where(['NOT IN','emp_gender',[2]])->andWhere(['NOT IN','district_code',[7,18,26,27,29,30]])->andWhere(['emp_status'=>1]);
    		if (isset(Yii::$app->user->identity->role)&&(Yii::$app->user->identity->role>0)) {
    if(isset(Yii::$app->user->identity->provin_code)&&(Yii::$app->user->identity->provin_code>0)) {
    $prov=(int)Yii::$app->user->identity->provin_code;
    $query = Beneficiarios::find()->where(['provin_code'=>$prov])->andWhere(['NOT IN','district_code',[7,18,26,27,29,30]])->andWhere(['emp_gender'=>['2']])->andWhere(['emp_status'=>1]);

    } elseif(Yii::$app->user->identity->role==20) {


    $query = Beneficiarios::find()->where(['NOT IN','district_code',[7,18,26,27,29,30]])->andWhere(['emp_status'=>1])->andWhere(['=','emp_gender',2]);

    }

    } else {
    $query = Beneficiarios::find()->where(['emp_status'=>1])->andWhere(['emp_gender'=>'2'])->andWhere(['NOT IN','district_code',[7,18,26,27,29,30]]);
    }

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['id'=>SORT_DESC]]
        ]);


        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
             $query->where(['emp_gender'=>2]);
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'emp_number' => $this->emp_number,
            'idade_anos' => $this->idade_anos,
            'ponto_entrada' => $this->ponto_entrada,
            'parceiro_id' => $this->parceiro_id,
            'via' => $this->via,
            'estudante_classe' => $this->estudante_classe,
            'filhos' => $this->filhos,
            'bairro_id' => $this->bairro_id,
            'tested_hiv' => $this->tested_hiv,
            'membro_localidade_id' => $this->membro_localidade_id,
            'us_id' => $this->us_id,
            'membro_zona' => $this->membro_zona,
            'membro_circulo' => $this->membro_circulo,
            'membro_celula' => $this->membro_celula,
            'emp_smoker' => $this->emp_smoker,
            'nation_code' => $this->nation_code,
            'emp_gender' => $this->emp_gender,
            'emp_dri_lice_exp_date' => $this->emp_dri_lice_exp_date,
            'emp_status' => $this->emp_status,
            'job_title_code' => $this->job_title_code,
            'eeo_cat_code' => $this->eeo_cat_code,
            'work_station' => $this->work_station,
            'joined_date' => $this->joined_date,
            'termination_id' => $this->termination_id,
            'criado_por' => $this->criado_por,
            'actualizado_por' => $this->actualizado_por,
            'criado_em' => $this->criado_em,
            'actualizado_em' => $this->actualizado_em,
        //  'organizacao' => $this->organizacao,
        ]);

        if($this->orphan == "NULL"){
            $query->andWhere(['is', 'orphan', null]);
        } else{
            $query->andFilterWhere(['orphan' =>$this->orphan]);
        }

        if($this->estudante == "NULL"){
            $query->andWhere(['is', 'estudante', null]);
        } else{
            $query->andFilterWhere(['estudante' =>$this->estudante]);
        }

        if($this->gravida == "NULL"){
            $query->andWhere(['is', 'gravida', null]);
        } else{
            $query->andFilterWhere(['gravida' =>$this->gravida]);
        }
        if($this->house_sustainer == "NULL"){
            $query->andWhere(['is', 'house_sustainer', null]);
        } else{
            $query->andFilterWhere(['house_sustainer' =>$this->house_sustainer]);
        }
        if($this->deficiencia == "NULL"){
            $query->andWhere(['is', 'deficiencia', null]);
        } else{
            $query->andFilterWhere(['deficiencia' =>$this->deficiencia]);
        }
        if($this->married_before == "NULL"){
            $query->andWhere(['is', 'married_before', null]);
        } else{
            $query->andFilterWhere(['married_before' =>$this->married_before]);
        }
        if($this->pregant_or_breastfeed == "NULL"){
            $query->andWhere(['is', 'pregant_or_breastfeed', null]);
        } else{
            $query->andFilterWhere(['pregant_or_breastfeed' =>$this->pregant_or_breastfeed]);
        }
        if($this->employed == "NULL"){
            $query->andWhere(['is', 'employed', null]);
        } else{
            $query->andFilterWhere(['employed' =>$this->employed]);
        }
        if($this->vbg_exploracao_sexual == "NULL"){
            $query->andWhere(['is', 'vbg_exploracao_sexual', null]);
        } else{
            $query->andFilterWhere(['vbg_exploracao_sexual' =>$this->vbg_exploracao_sexual]);
        }
        if($this->vbg_migrante_trafico == "NULL"){
            $query->andWhere(['is', 'vbg_migrante_trafico', null]);
        } else{
            $query->andFilterWhere(['vbg_migrante_trafico' =>$this->vbg_migrante_trafico]);
        }
        if($this->vbg_sexual_activa == "NULL"){
            $query->andWhere(['is', 'vbg_sexual_activa', null]);
        } else{
            $query->andFilterWhere(['vbg_sexual_activa' =>$this->vbg_sexual_activa]);
        }
        if($this->vbg_relacao_multipla == "NULL"){
            $query->andWhere(['is', 'vbg_relacao_multipla', null]);
        } else{
            $query->andFilterWhere(['vbg_relacao_multipla' =>$this->vbg_relacao_multipla]);
        }
        if($this->vbg_vitima == "NULL"){
            $query->andWhere(['is', 'vbg_vitima', null]);
        } else{
            $query->andFilterWhere(['vbg_vitima' =>$this->vbg_vitima]);
        }
        if($this->vbg_vitima_trafico == "NULL"){
            $query->andWhere(['is', 'vbg_vitima_trafico', null]);
        } else{
            $query->andFilterWhere(['vbg_vitima_trafico' =>$this->vbg_vitima_trafico]);
        }
        if($this->alcohol_drugs_use == "NULL"){
            $query->andWhere(['is', 'alcohol_drugs_use', null]);
        } else{
            $query->andFilterWhere(['alcohol_drugs_use' =>$this->alcohol_drugs_use]);
        }
        if($this->sti_history == "NULL"){
            $query->andWhere(['is', 'sti_history', null]);
        } else{
            $query->andFilterWhere(['sti_history' =>$this->sti_history]);
        }
        

        $query->andFilterWhere(['like', 'member_id', $this->member_id])
            ->andFilterWhere(['like', 'emp_lastname', $this->emp_lastname])
            ->andFilterWhere(['like', 'emp_firstname', $this->emp_firstname])
            ->andFilterWhere(['like', 'emp_middle_name', $this->emp_middle_name])
            ->andFilterWhere(['like', 'emp_nick_name', $this->emp_nick_name])
            ->andFilterWhere(['like', 'emp_birthday', $this->emp_birthday])
            ->andFilterWhere(['like', 'estudante_escola', $this->estudante_escola])
            ->andFilterWhere(['like', 'encarregado_educacao', $this->encarregado_educacao])
            ->andFilterWhere(['like', 'deficiencia_tipo', $this->deficiencia_tipo])
            ->andFilterWhere(['like', 'coun_code', $this->coun_code])
            ->andFilterWhere(['like', 'provin_code', $this->provin_code])
            ->andFilterWhere(['like', 'district_code', $this->district_code])
            ->andFilterWhere(['like', 'city_code', $this->city_code])
            ->andFilterWhere(['like', 'membro_data_admissao', $this->membro_data_admissao])
            ->andFilterWhere(['like', 'membro_caratao_eleitor', $this->membro_caratao_eleitor])
            ->andFilterWhere(['like', 'membro_cargo_partido_id', $this->membro_cargo_partido_id])
            ->andFilterWhere(['like', 'ethnic_race_code', $this->ethnic_race_code])
            ->andFilterWhere(['like', 'emp_marital_status', $this->emp_marital_status])
            ->andFilterWhere(['like', 'emp_ssn_num', $this->emp_ssn_num])
            ->andFilterWhere(['like', 'emp_sin_num', $this->emp_sin_num])
            ->andFilterWhere(['like', 'emp_other_id', $this->emp_other_id])
            ->andFilterWhere(['like', 'emp_dri_lice_num', $this->emp_dri_lice_num])
            ->andFilterWhere(['like', 'emp_military_service', $this->emp_military_service])
            ->andFilterWhere(['like', 'emp_street1', $this->emp_street1])
            ->andFilterWhere(['like', 'emp_street2', $this->emp_street2])
            ->andFilterWhere(['like', 'emp_zipcode', $this->emp_zipcode])
            ->andFilterWhere(['like', 'emp_hm_telephone', $this->emp_hm_telephone])
            ->andFilterWhere(['like', 'emp_mobile', $this->emp_mobile])
            ->andFilterWhere(['like', 'emp_work_telephone', $this->emp_work_telephone])
            ->andFilterWhere(['like', 'emp_work_email', $this->emp_work_email])
            ->andFilterWhere(['like', 'sal_grd_code', $this->sal_grd_code])
            ->andFilterWhere(['like', 'emp_oth_email', $this->emp_oth_email])
            ->andFilterWhere(['like', 'bi', $this->bi])
            ->andFilterWhere(['like', 'nuit', $this->nuit])
            ->andFilterWhere(['like', 'passaporte', $this->passaporte])
            ->andFilterWhere(['like', 'dire', $this->dire])
            ->andFilterWhere(['like', 'bi_data_i', $this->bi_data_i])
            ->andFilterWhere(['like', 'bi_data_f', $this->bi_data_f])
            ->andFilterWhere(['like', 'custom3', $this->custom3])
            ->andFilterWhere(['like', 'other_prof_info', $this->other_prof_info])
            ->andFilterWhere(['like', 'nuit_data_i', $this->nuit_data_i])
            ->andFilterWhere(['like', 'nuit_data_f', $this->nuit_data_f])
            ->andFilterWhere(['like', 'custom7', $this->custom7])
            ->andFilterWhere(['like', 'custom8', $this->custom8])
            ->andFilterWhere(['like', 'custom9', $this->custom9])
            ->andFilterWhere(['like', 'custom10', $this->custom10])
         	// ->andFilterWhere(['like', 'organizacao', $this->organizacao])
            ->andFilterWhere(['like', 'user_location', $this->user_location])
            ->andFilterWhere(['like', 'user_location2', $this->user_location2]);

        return $dataProvider;
    }
}
