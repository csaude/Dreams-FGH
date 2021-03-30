<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "hs_hr_employee".
 *
 * @property integer $id
 * @property integer $emp_number
 * @property string $member_id
 * @property string $emp_lastname
 * @property string $emp_firstname
 * @property string $emp_middle_name
 * @property string $emp_nick_name
 * @property integer $ponto_entrada
 * @property integer $parceiro_id
 * @property integer $via
 * @property integer $idade_anos
 * @property integer $estudante
 * @property integer $estudante_classe
 * @property string $estudante_escola
 * @property integer $gravida
 * @property integer $filhos
 * @property integer $bairro_id
 * @property string $encarregado_educacao
 * @property integer $deficiencia
 * @property string $deficiencia_tipo
 * @property string $coun_code
 * @property string $provin_code
 * @property string $district_code
 * @property string $city_code
 * @property integer $membro_localidade_id
 * @property integer $us_id
 * @property integer $membro_zona
 * @property integer $membro_circulo
 * @property integer $membro_celula
 * @property string $membro_data_admissao
 * @property string $membro_caratao_eleitor
 * @property string $membro_cargo_partido_id
 * @property integer $emp_smoker
 * @property string $ethnic_race_code
 * @property string $emp_birthday
 * @property integer $nation_code
 * @property integer $emp_gender
 * @property string $emp_marital_status
 * @property string $emp_ssn_num
 * @property string $emp_sin_num
 * @property string $emp_other_id
 * @property string $emp_dri_lice_num
 * @property string $emp_dri_lice_exp_date
 * @property string $emp_military_service
 * @property integer $emp_status
 * @property integer $job_title_code
 * @property integer $eeo_cat_code
 * @property integer $work_station
 * @property string $emp_street1
 * @property string $emp_street2
 * @property string $emp_zipcode
 * @property string $emp_hm_telephone
 * @property string $emp_mobile
 * @property string $emp_work_telephone
 * @property string $emp_work_email
 * @property string $sal_grd_code
 * @property string $joined_date
 * @property string $emp_oth_email
 * @property integer $termination_id
 * @property string $bi
 * @property string $nuit
 * @property string $passaporte
 * @property string $dire
 * @property string $bi_data_i
 * @property string $bi_data_f
 * @property string $custom3
 * @property string $other_prof_info
 * @property string $nuit_data_i
 * @property string $nuit_data_f
 * @property string $custom7
 * @property string $custom8
 * @property string $custom9
 * @property string $custom10
 * @property integer $criado_por
 * @property integer $actualizado_por
 * @property string $criado_em
 * @property string $actualizado_em
 * @property string $user_location
 * @property string $user_location2
 */
class Benefs extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hs_hr_employee';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['emp_number', 'ponto_entrada', 'parceiro_id', 'via', 'idade_anos', 'estudante', 'estudante_classe', 'gravida', 'filhos', 'bairro_id', 'deficiencia', 'membro_localidade_id', 'us_id', 'membro_zona', 'membro_circulo', 'membro_celula', 'emp_smoker', 'nation_code', 'emp_gender', 'emp_status', 'job_title_code', 'eeo_cat_code', 'work_station', 'termination_id', 'criado_por', 'actualizado_por'], 'integer'],
            [['ponto_entrada', 'district_code', 'membro_data_admissao', 'passaporte', 'dire'], 'required'],
            [['emp_dri_lice_exp_date', 'joined_date', 'actualizado_em'], 'safe'],
            [['member_id', 'membro_caratao_eleitor', 'membro_cargo_partido_id', 'emp_birthday', 'emp_hm_telephone', 'emp_mobile', 'emp_work_telephone', 'emp_work_email', 'emp_oth_email', 'bi_data_i', 'bi_data_f', 'nuit_data_i', 'nuit_data_f', 'user_location'], 'string', 'max' => 50],
            [['emp_lastname', 'emp_firstname', 'emp_middle_name', 'emp_nick_name', 'coun_code', 'provin_code', 'district_code', 'city_code', 'emp_ssn_num', 'emp_sin_num', 'emp_other_id', 'emp_dri_lice_num', 'emp_military_service', 'emp_street1', 'emp_street2', 'criado_em'], 'string', 'max' => 100],
            [['estudante_escola', 'encarregado_educacao'], 'string', 'max' => 150],
            [['deficiencia_tipo', 'custom3', 'other_prof_info', 'custom7', 'custom8', 'custom9', 'custom10'], 'string', 'max' => 250],
            [['membro_data_admissao', 'emp_marital_status', 'emp_zipcode'], 'string', 'max' => 20],
            [['ethnic_race_code', 'sal_grd_code'], 'string', 'max' => 13],
            [['bi', 'nuit', 'passaporte', 'dire'], 'string', 'max' => 15],
            [['user_location2'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'emp_number' => Yii::t('app', 'Emp Number'),
            'member_id' => Yii::t('app', 'Member ID'),
            'emp_lastname' => Yii::t('app', 'Emp Lastname'),
            'emp_firstname' => Yii::t('app', 'Emp Firstname'),
            'emp_middle_name' => Yii::t('app', 'Emp Middle Name'),
            'emp_nick_name' => Yii::t('app', 'Emp Nick Name'),
            'ponto_entrada' => Yii::t('app', 'Ponto Entrada'),
            'parceiro_id' => Yii::t('app', 'Parceiro ID'),
            'via' => Yii::t('app', 'Via'),
            'idade_anos' => Yii::t('app', 'Idade Anos'),
            'estudante' => Yii::t('app', 'Estudante'),
            'estudante_classe' => Yii::t('app', 'Estudante Classe'),
            'estudante_escola' => Yii::t('app', 'Estudante Escola'),
            'gravida' => Yii::t('app', 'Gravida'),
            'filhos' => Yii::t('app', 'Filhos'),
            'bairro_id' => Yii::t('app', 'Bairro'),
            'encarregado_educacao' => Yii::t('app', 'Encarregado Educacao'),
            'deficiencia' => Yii::t('app', 'Deficiencia'),
            'deficiencia_tipo' => Yii::t('app', 'Deficiencia Tipo'),
            'coun_code' => Yii::t('app', 'Coun Code'),
            'provin_code' => Yii::t('app', 'Provincia'),
            'district_code' => Yii::t('app', 'Distrito'),
            'city_code' => Yii::t('app', 'City Code'),
            'membro_localidade_id' => Yii::t('app', 'Membro Localidade ID'),
            'us_id' => Yii::t('app', 'Us ID'),
            'membro_zona' => Yii::t('app', 'Membro Zona'),
            'membro_circulo' => Yii::t('app', 'Membro Circulo'),
            'membro_celula' => Yii::t('app', 'Membro Celula'),
            'membro_data_admissao' => Yii::t('app', 'Membro Data Admissao'),
            'membro_caratao_eleitor' => Yii::t('app', 'Membro Caratao Eleitor'),
            'membro_cargo_partido_id' => Yii::t('app', 'Membro Cargo Partido ID'),
            'emp_smoker' => Yii::t('app', 'Emp Smoker'),
            'ethnic_race_code' => Yii::t('app', 'Ethnic Race Code'),
            'emp_birthday' => Yii::t('app', 'Emp Birthday'),
            'nation_code' => Yii::t('app', 'Nation Code'),
            'emp_gender' => Yii::t('app', 'Emp Gender'),
            'emp_marital_status' => Yii::t('app', 'Emp Marital Status'),
            'emp_ssn_num' => Yii::t('app', 'Emp Ssn Num'),
            'emp_sin_num' => Yii::t('app', 'Emp Sin Num'),
            'emp_other_id' => Yii::t('app', 'Emp Other ID'),
            'emp_dri_lice_num' => Yii::t('app', 'Emp Dri Lice Num'),
            'emp_dri_lice_exp_date' => Yii::t('app', 'Emp Dri Lice Exp Date'),
            'emp_military_service' => Yii::t('app', 'Emp Military Service'),
            'emp_status' => Yii::t('app', 'Emp Status'),
            'job_title_code' => Yii::t('app', 'Job Title Code'),
            'eeo_cat_code' => Yii::t('app', 'Eeo Cat Code'),
            'work_station' => Yii::t('app', 'Work Station'),
            'emp_street1' => Yii::t('app', 'Emp Street1'),
            'emp_street2' => Yii::t('app', 'Emp Street2'),
            'emp_zipcode' => Yii::t('app', 'Emp Zipcode'),
            'emp_hm_telephone' => Yii::t('app', 'Emp Hm Telephone'),
            'emp_mobile' => Yii::t('app', 'Emp Mobile'),
            'emp_work_telephone' => Yii::t('app', 'Emp Work Telephone'),
            'emp_work_email' => Yii::t('app', 'Emp Work Email'),
            'sal_grd_code' => Yii::t('app', 'Sal Grd Code'),
            'joined_date' => Yii::t('app', 'Joined Date'),
            'emp_oth_email' => Yii::t('app', 'Emp Oth Email'),
            'termination_id' => Yii::t('app', 'Termination ID'),
            'bi' => Yii::t('app', 'Bi'),
            'nuit' => Yii::t('app', 'Nuit'),
            'passaporte' => Yii::t('app', 'Passaporte'),
            'dire' => Yii::t('app', 'Dire'),
            'bi_data_i' => Yii::t('app', 'Bi Data I'),
            'bi_data_f' => Yii::t('app', 'Bi Data F'),
            'custom3' => Yii::t('app', 'Custom3'),
            'other_prof_info' => Yii::t('app', 'Other Prof Info'),
            'nuit_data_i' => Yii::t('app', 'Nuit Data I'),
            'nuit_data_f' => Yii::t('app', 'Nuit Data F'),
            'custom7' => Yii::t('app', 'Custom7'),
            'custom8' => Yii::t('app', 'Custom8'),
            'custom9' => Yii::t('app', 'Custom9'),
            'custom10' => Yii::t('app', 'Custom10'),
            'criado_por' => Yii::t('app', 'Criado Por'),
            'actualizado_por' => Yii::t('app', 'Actualizado Por'),
            'criado_em' => Yii::t('app', 'Criado Em'),
            'actualizado_em' => Yii::t('app', 'Actualizado Em'),
            'user_location' => Yii::t('app', 'User Location'),
            'user_location2' => Yii::t('app', 'User Location2'),
        ];
    }

    public function getNacionalidade()
{
  return $this->hasOne(Nacionalidade::className(), ['cou_code' => 'coun_code']);
}

 public function getProvincia()
{
  return $this->hasOne(Provincias::className(), ['id' => 'provin_code']);
}

     public function getDistrito()
{
  return $this->hasOne(Distritos::className(), ['district_code' => 'district_code']);
}

     public function getUs()
{
  return $this->hasOne(Us::className(), ['id' => 'us_id']);
}

     public function getCCidade()
{
  return $this->hasOne(ComiteCidades::className(), ['id' => 'city_code']);
}

       public function getCZona()
{
  return $this->hasOne(ComiteZonal::className(), ['id' => 'membro_zona']);
}

           public function getCCirculo()
{
  return $this->hasOne(ComiteCirculos::className(), ['id' => 'membro_circulo']);
}


           public function getCCelula()
{
  return $this->hasOne(ComiteCelulas::className(), ['id' => 'membro_celula']);
}

public function getLocalidade()
{
  return $this->hasOne(ComiteLocalidades::className(), ['id' => 'membro_localidade_id']);
}

public function getBairros()
{
  return $this->hasOne(Bairros::className(), ['id' => 'bairro_id']);
}

public function getGrau()
{
  return $this->hasOne(Educacao::className(), ['id' => 'sal_grd_code']);
}

public function getCategoria()
{
  return $this->hasOne(JobCategory::className(), ['id' => 'eeo_cat_code']);
}

public function getTitulo()
{
  return $this->hasOne(TituloProfissional::className(), ['id' => 'job_title_code']);
}

public function getUser()
{
  return $this->hasOne(Utilizadores::className(), ['id' => 'criado_por']);
}

public function getUpdate()
{
  return $this->hasOne(Utilizadores::className(), ['id' => 'actualizado_por']);
}

public function getCargo()
{
  return $this->hasOne(TipoCargos::className(), ['id' => 'membro_cargo_partido_id']);
}

public function getParceiro()
{
  return $this->hasOne(Beneficiarios::className(), ['id' => 'parceiro_id']);
}
//Ponto de entrada
public function getPe()
{
  return $this->hasOne(PontosDeEntrada::className(), ['id' => 'ponto_entrada']);
}


}
