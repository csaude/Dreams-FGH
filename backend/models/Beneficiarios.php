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
 * @property integer $membro_zona
 * @property integer $membro_circulo
 * @property integer $membro_celula
 * @property string $membro_data_admissao
 * @property integer $membro_localidade_id
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
 * @property string $city_code
 * @property string $coun_code
 * @property string $provin_code
 * @property string $district_code
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
 * @property User $user;
 * @property Organizacoes $organizacoes
*NOVAS 12.02.2019  ,'house_sustainer','married_before','pregant_or_breastfeed','employed','tested_hiv'
 */
class Beneficiarios extends \yii\db\ActiveRecord
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
            [['emp_firstname'], 'match', 'not'=>true, 'pattern' => '/[^a-zA-Z_-àáâãèéêìíòóõúçÀÁÂÃÈÉÊÌÍÒÓÕÚÇ]/', 'message'=>'Apenas letras são válidas!'],
            [['emp_lastname'], 'match', 'not'=>true, 'pattern' => '/[^a-zA-Z_-àáâãèéêìíòóõúçÀÁÂÃÈÉÊÌÍÒÓÕÚÇ\s]/', 'message'=>'Apenas letras são válidas!'],
            [['emp_number', 'parceiro_benificiario_id', 'membro_zona', 'membro_circulo', 'membro_celula', 'membro_localidade_id', 'emp_smoker', 'nation_code', 'emp_gender', 'emp_status', 'job_title_code', 'eeo_cat_code', 'work_station', 'termination_id', 'criado_por', 'actualizado_por','us_id','parceiro_id','via', 'vbg_tempo', 'vbg_vsex_tempo'], 'integer'],
		[['emp_mobile'], 'integer', 'message' => 'O valor do {attribute} só pode ter números'],
[['idade_anos'], 'integer', 'min' => 10, 'message' => 'O valor da {attribute} não pode ser menor que 10'],
[['parceiro_id'],'integer','message'=>'O Valor {attribute} não existe'],
            [['emp_birthday','district_code','emp_lastname','emp_firstname', 'emp_gender', 'provin_code','ponto_entrada','bairro_id','encarregado_educacao'], 'required'],
            [['emp_dri_lice_exp_date', 'joined_date', 'criado_em', 'actualizado_em','deficiencia_tipo','estudante','estudante_classe','estudante_escola','gravida','filhos','deficiencia','house_sustainer','married_before','pregant_or_breastfeed','employed','tested_hiv','vbg_vitima_trafico','vbg_exploracao_sexual','vbg_migrante_trafico','vbg_sexual_activa','vbg_relacao_multipla','vbg_vitima','vbg_sex_worker'], 'safe'],
            [['member_id', 'membro_caratao_eleitor', 'membro_cargo_partido_id', 'emp_hm_telephone',  'emp_work_telephone', 'emp_work_email', 'emp_oth_email', 'bi_data_i', 'bi_data_f', 'nuit_data_i', 'nuit_data_f', 'user_location'], 'string', 'max' => 50],
            [['emp_lastname', 'emp_firstname', 'emp_middle_name', 'emp_nick_name', 'emp_ssn_num', 'emp_sin_num', 'emp_other_id', 'emp_dri_lice_num', 'emp_military_service', 'emp_street1', 'emp_street2', 'city_code', 'coun_code', 'provin_code', 'district_code'], 'string', 'max' => 100],
            [['emp_birthday','membro_data_admissao', 'emp_marital_status', 'emp_zipcode'], 'string', 'max' => 20],
            [['ethnic_race_code', 'sal_grd_code', 'vbg_tipo_violencia'], 'string', 'max' => 13],
            [['bi', 'nuit', 'passaporte', 'dire'], 'string', 'max' => 15],
            [['custom3', 'other_prof_info', 'custom7', 'custom8', 'custom9', 'custom10'], 'string', 'max' => 250],
            [['user_location2'], 'string', 'max' => 200],
//	    [['emp_birthday'], 'validateDateOfBirth'],
	//    [['emp_birthday'], 'date', 'format' => 'php:m/d/Y', 'message'=>'O formato da data nao esta correcta'],
        ];
    }

    /**
     * @inheritdoc
     */
/*
public function validateDateOfBirth($attribute)
{
    $dateTime = DateTime::createFromFormat('m/d/Y', $this->$attribute);
    $errors = DateTime::getLastErrors();
    if (!empty($errors['warning_count'])) {
        $this->addError($attribute, 'Formato da Data Invalido');
    }
}
*/

/* Getter for person full name */
public function getFullName() {
    return $this->emp_firstname . ' ' . $this->emp_lastname;
}


    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'emp_number' => 'Nº Registo',
            'member_id' => 'Código do Beneficiário',
            'fullName' => Yii::t('app', 'Nome Completo'),
            'emp_lastname' => 'Apelido',
	    'ponto_entrada'=> 'Ponto de Entrada',
            'emp_firstname' => 'Nome',
            'emp_middle_name' => 'Nome do meio',
            'emp_nick_name' => 'Alcunha',
            'parceiro_id' =>'Parceiro Dreams',
          	'parceiro_benificiario_id' => 'NUI do Parceiro do Beneficiario',
	    'via'=>'Segunda Via',
            'idade_anos' =>'Idade (em anos)',
            'estudante' =>'Vai a Escola',
            'estudante_classe' =>'Classe',
            'estudante_escola' =>'Nome da Instituição de Ensino',
            'gravida' =>'Já esteve Gravida?',
            'filhos' =>'Tem Filhos?',
            'bairro_id' =>'Onde Mora', 
	    'us_id'=>'Ponto de Entrada',
            'encarregado_educacao' =>'Com quem mora?',
            'deficiencia' =>'Tem Deficiência',
            'deficiencia_tipo'=>'Tipo de Deficiência',
            'membro_zona' => 'Comité de Zona',
            'membro_circulo' => 'Círculo',
            'membro_celula' => 'Celula',
            'membro_data_admissao'=>'Data de Admissão',
            'membro_localidade_id'=>'Posto Administrativo',
            'membro_caratao_eleitor'=>'Nº Cartão de Eleitor',
            'membro_cargo_partido_id'=>'Cargo Ocupado',
            'emp_smoker' => 'Fumante',
            'ethnic_race_code' => 'Raça Etnica',
            'emp_birthday' => 'Data Nascimento',
            'nation_code' => 'Nacionalidade',
            'emp_gender' => 'Sexo',
            'emp_marital_status' => 'Estado Civil',
            'emp_ssn_num' => 'Emp Ssn Num',
            'emp_sin_num' => 'Emp Sin Num',
            'emp_other_id' => 'Emp Other ID',
            'emp_dri_lice_num' => 'Num Carta de Condução',
            'emp_dri_lice_exp_date' => 'Validade da CC',
            'emp_military_service' => 'Serviço Militar',
            'emp_status' => 'Status',
            'job_title_code' => 'Título',
            'eeo_cat_code' => 'Área Profissional',
            'work_station' => 'Local de Trabalho',
            'emp_street1' => 'Morada(Bairro)',
            'emp_street2' => 'Observações',
            'city_code' => 'Cidade',
            'coun_code' => 'País',
            'provin_code' => 'Provincia',
            'district_code' => 'Distrito',
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
	        'house_sustainer' => 'Sustenta a Casa?',
            'married_before' => 'Já foi Casada?',
            'pregant_or_breastfeed' => 'Está Grávida ou a amamentar?',
            'employed' => 'Trabalha?',
            'tested_hiv' => 'Já fez Teste de HIV?',
	        'vbg_exploracao_sexual' => 'Vítima de Exploração sexual?',
            'vbg_migrante_trafico' => 'Migrante?',
            'vbg_sexual_activa' => 'Sexualmente Activa?',
            'vbg_relacao_multipla' => 'Relações Múltiplas e Concorrentes?',
            'vbg_vitima' => 'Vítima de Violéncia Baseada no Gênero?',
            'vbg_sex_worker' =>'Trabalhadora de Sexo?',
            'vbg_vitima_trafico'=>'Vítima de Tráfico?',
            'vbg_tipo_violencia' => 'Tipo de Violéncia:',
            'vbg_tempo' => 'Tempo: ',
            'vbg_vsex_tempo' => 'Tempo: ',
          	'parceiro_benificiario_id' => ' ',
        ];
    }

     public function beforeSave($insert) {
  date_default_timezone_set('Africa/Maputo');

    if ($this->isNewRecord) { 
        
     $this->criado_em=date("Y-m-d H:i:s"); 
     $this->criado_por=Yii::$app->user->identity->id;
     $this->user_location=Yii::$app->request->userIP;
     // Linha adicionada para parceiro Dreams / Gerzelio 03/03/2020
     $this->parceiro_id = Yii::$app->user->identity->parceiro_id;
     $this->coun_code="MZ";

     $ben=Beneficiarios::find()
    ->where(['id' => Beneficiarios::find()->max('id')])
    ->one();
     $emp_number = $ben->id+1;
     $this->emp_number=$emp_number;
		
	 $len = strlen($emp_number);

switch ($len) {
    case 2:   $this->member_id='00000'.$emp_number;
        break;

   case 3:   $this->member_id='0000'.$emp_number;
        break;

  case 4:   $this->member_id='000'.$emp_number;
        break;
   case 5:   $this->member_id='00'.$emp_number;
        break;
    case 6:   $this->member_id='0'.$emp_number;
        break;
      default: $this->member_id=$emp_number;
}


	/*if($len==2) {
	$this->member_id='00000'.$emp_number;
	} else {
	$this->member_id='00000'.$emp_number;
	}*/
		
    } 
    else 
        {
        $this->actualizado_em=date("Y-m-d H:i:s");
        $this->actualizado_por=Yii::$app->user->identity->id;
        $this->user_location2=Yii::$app->request->userIP;
      	// Linha adicionada para parceiro Dreams / Gerzelio 03/03/2020
     	$this->parceiro_id = Yii::$app->user->identity->parceiro_id;
        $this->coun_code="MZ"; }
    return parent::beforeSave($insert); 
}



public function afterSave($insert, $changedAttributes)
{
        parent::afterSave($insert, $changedAttributes);
        //your logic
}
  

         public function getCProvincial()
    {
        return $this->hasOne(ComiteProvincial::className(), ['id' => 'provin_code']);
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
  
    //Organizacoes
    public function getOrganizacoes()
    {
        return $this->hasOne(Organizacoes::className(), ['id' => 'parceiro_id']);
    }
  


}
