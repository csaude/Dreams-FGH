<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "hs_hr_employee".
 *
 * @property integer $id
 * @property integer $emp_number
 * @property string $employee_id
 * @property string $emp_lastname
 * @property string $emp_firstname
 * @property string $emp_middle_name
 * @property string $emp_nick_name
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
 * @property string $city_code
 * @property string $coun_code
 * @property string $provin_code
 * @property string $emp_zipcode
 * @property string $emp_hm_telephone
 * @property string $emp_mobile
 * @property string $emp_work_telephone
 * @property string $emp_work_email
 * @property string $sal_grd_code
 * @property string $joined_date
 * @property string $emp_oth_email
 * @property integer $termination_id
 * @property integer $faculdade_id
 * @property integer $curso_id
 * @property string $ano_conclusao12
 * @property string $ano_conclusao
 * @property string $custom1
 * @property string $custom2
 * @property string $custom3
 * @property string $custom4
 * @property string $custom5
 * @property string $custom6
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
class Membros extends \yii\db\ActiveRecord
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
            [['emp_number', 'emp_smoker', 'nation_code', 'emp_gender', 'emp_status', 'job_title_code', 'eeo_cat_code', 'work_station', 'termination_id',  'criado_por', 'actualizado_por','district_code','membro_zona','membro_circulo','membro_celula','membro_localidade_id'], 'integer'],
            [[ 'emp_dri_lice_exp_date', 'joined_date', 'membro_cargo_partido_id','criado_em', 'actualizado_em'], 'safe'],
            [['emp_birthday','emp_lastname','emp_firstname', 'emp_middle_name','emp_gender', 'provin_code', 'nation_code'], 'required'],
            [['member_id', 'emp_hm_telephone', 'emp_mobile', 'emp_work_telephone', 'emp_work_email', 'emp_oth_email', 'user_location','membro_caratao_eleitor'], 'string', 'max' => 50],
            [['emp_lastname', 'emp_firstname', 'emp_middle_name', 'emp_nick_name', 'emp_ssn_num', 'emp_sin_num', 'emp_other_id', 'emp_dri_lice_num', 'emp_military_service', 'emp_street1', 'emp_street2', 'city_code', 'coun_code', 'provin_code'], 'string', 'max' => 100],
            [['ethnic_race_code', 'sal_grd_code'], 'string', 'max' => 13],
            [['emp_marital_status', 'emp_zipcode','membro_data_admissao'], 'string', 'max' => 20],
            [['bi', 'nuit','passaporte', 'dire'], 'string', 'max' => 15],
            [['bi_data_f', 'bi_data_i', 'custom3', 'other_prof_info', 'nuit_data_i', 'nuit_data_f', 'custom7', 'custom8', 'custom9', 'custom10'], 'string', 'max' => 250],
            [['user_location2'], 'string', 'max' => 200],
          //  ['emp_birthday', 'validateDates'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'emp_number' => 'Nº Registo',
            'member_id' => 'Nº Cartão de Membro',
            'emp_lastname' => 'Apelido',
            'emp_firstname' => 'Primeiro nome',
            'emp_middle_name' => 'Nome do meio',
            'emp_nick_name' => 'Naturalidade',
            'membro_zona' => 'Comité de Zona',
            'membro_circulo' => 'Círculo',
            'membro_celula' => 'Celula',
            'membro_data_admissao'=>'Data de Admissão no Partido',
            'membro_localidade_id'=>'Localidade',
            'membro_caratao_eleitor'=>'Nº Cartão de Eleitor',
            'membro_cargo_partido_id'=>'Cargo no Partido',
            'emp_smoker' => 'Emp Smoker',
            'ethnic_race_code' => 'Ethnic Race Code',
            'emp_birthday' => 'Data Nascimento',
            'nation_code' => 'Nacionalidade',
            'emp_gender' => 'Sexo',
            'emp_marital_status' => 'Estado Civil',
            'emp_ssn_num' => 'Emp Ssn Num',
            'emp_sin_num' => 'Emp Sin Num',
            'emp_other_id' => 'Emp Other ID',
            'emp_dri_lice_num' => 'Emp Dri Lice Num',
            'emp_dri_lice_exp_date' => 'Emp Dri Lice Exp Date',
            'emp_military_service' => 'Serviço Militar',
            'emp_status' => 'Status',
            'job_title_code' => 'Título',
            'eeo_cat_code' => 'Área Profissional',
            'work_station' => 'Local de Trabalho',
            'emp_street1' => 'Morada(Bairro)',
            'emp_street2' => 'Outros Contactos',
            'city_code' => 'Comité da Cidade',
            'coun_code' => 'País',
            'provin_code' => 'Comité Provincial',
            'district_code' => 'Comité Distrital',
            'emp_zipcode' => 'Emp Zipcode',
            'emp_hm_telephone' => 'Tel/Fax',
            'emp_mobile' => 'Telemóvel',
            'emp_work_telephone' => 'Emp Work Telephone',
            'emp_work_email' => 'E-mail',
            'sal_grd_code' => 'Grau acadêmico',
            'joined_date' => 'Data de Admissão',
            'emp_oth_email' => 'Emp Oth Email',
            'termination_id' => 'Termination ID',
            'bi' => 'BI',
            'nuit' => 'NUIT',
            'passaporte' => 'Passaporte',
            'dire' => 'DIRE',
            'bi_data_f' => 'Data Validade BI',
            'bi_data_i' => 'Data Emissão BI',
            'custom3' => 'Custom3',
            'other_prof_info' => 'Mais info Profissional',
            'nuit_data_i' => 'Data Emissão NUIT',
            'nuit_data_f' => 'Data Validade NUIT',
            'custom7' => 'Entidade Emissora BI',
            'custom8' => 'Entidade Emissora NUIT',
            'custom9' => 'Entidade Emissora Passaporte',
            'custom10' => 'Custom10',
            'criado_por' => 'Criado Por',
            'actualizado_por' => 'Actualizado Por',
            'criado_em' => 'Criado Em',
            'actualizado_em' => 'Actualizado Em',
            'user_location' => 'User Location',
            'user_location2' => 'User Location2',
        ];
    }



  public function validateAge($model, $attribute)
    {
 
/*
$d1 = new DateTime('d-m-Y');
$d2 = new $model->$attribute;

$diff = intval($d2->diff($d1));
$anos=intval($diff->y);
if($anos>18) { return true;} else {return false;}*/
//return $diff->y;
 
   }

public function validateDates(){
//strtotime(Date('d-m-Y'));
$d1 =  round((strtotime(Date('Y-m-d'))-strtotime($this->emp_birthday))/31556926,0); 
   // if(strtotime($this->emp_birthday) <= strtotime($d1))
    if(strtotime($this->emp_birthday) <18)    
    {
        $this->addError('emp_birthday','Por favor,  a idade não confere com os termos definitos nos estatutos');

    }
}


 public function beforeSave($insert) {
  

    if ($this->isNewRecord) { 
        
     $this->criado_em=date("Y-m-d H:m:s"); 
     $this->criado_por=Yii::$app->user->identity->id;
     $this->user_location=Yii::$app->request->userIP;
     $this->coun_code="MZ";
    } 
    else 
        {
        $this->actualizado_em=date("Y-m-d H:m:s");
        $this->actualizado_por=Yii::$app->user->identity->id;
        $this->user_location2=Yii::$app->request->userIP;
        $this->coun_code="MZ"; }
    return parent::beforeSave($insert); 
}


         public function getCProvincial()
    {
        return $this->hasOne(ComiteProvincial::className(), ['id' => 'provin_code']);
    }
         public function getCDistrital()
    {
        return $this->hasOne(ComiteDistrital::className(), ['id' => 'district_code']);
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
        return $this->hasOne(User::className(), ['id' => 'criado_por']);
    }
    public function getCargo()
    {
        return $this->hasOne(ComiteCargos::className(), ['id' => 'membro_cargo_partido_id']);
    }

    
}
