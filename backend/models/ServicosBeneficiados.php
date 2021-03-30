<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "app_dream_beneficiario_servicos".
 *
 * @property integer $id
 * @property integer $servico_id
 * @property string $name
 * @property integer $us_id
 * @property integer $activista_id
 * @property string $data_beneficio
 * @property integer $status
 * @property string $description
 * @property integer $criado_por
 * @property integer $actualizado_por
 * @property string $criado_em
 * @property string $actualizado_em
 * @property string $user_location
 * @property string $user_location2
 */
class ServicosBeneficiados extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'app_dream_beneficiario_servicos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['servico_id','ponto_entrada','sub_servico_id','us_id','beneficiario_id', 'activista_id', 'status', 'criado_por', 'actualizado_por'], 'integer'],
            [['servico_id','beneficiario_id','ponto_entrada','data_beneficio','status'], 'required'],
            [['data_beneficio', 'criado_em','sub_servico_id', 'actualizado_em','resultado','provedor'], 'safe'],
            [['beneficiario_id', 'description'], 'string', 'max' => 250],
            [['user_location', 'user_location2'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'servico_id' => Yii::t('app', 'Serviço'),			
			'sub_servico_id'=>Yii::t('app', 'Sub-Serviço/Intervenção'),
	   		'ponto_entrada'=>Yii::t('app', 'Ponto de Entrada'),
			'resultado'=>Yii::t('app', 'Observação do Resultado'),
            'beneficiario_id' => Yii::t('app', 'Beneficiário'),
            'us_id' => Yii::t('app', 'Localização'),
            'activista_id' => Yii::t('app', 'Activista'),
            'data_beneficio' => Yii::t('app', 'Data Benefício'),
	    'provedor' => Yii::t('app', 'Provedor do Serviço'), //actualizado em 17.10.2018
            'status' => Yii::t('app', 'Status'),
            'description' => Yii::t('app', 'Outras Observações'),
            'criado_por' => Yii::t('app', 'Criado Por'),
            'actualizado_por' => Yii::t('app', 'Actualizado Por'),
            'criado_em' => Yii::t('app', 'Criado Em'),
            'actualizado_em' => Yii::t('app', 'Actualizado Em'),
            'user_location' => Yii::t('app', 'User Location'),
            'user_location2' => Yii::t('app', 'User Location2'),
        ];
    }

      public function beforeSave($insert) {
date_default_timezone_set('Africa/Maputo');  

    if ($this->isNewRecord) { 
        
     $this->criado_em=date("Y-m-d H:i:s"); 
     $this->criado_por=Yii::$app->user->identity->id;
     $this->user_location=Yii::$app->request->userIP;
     $this->activista_id=Yii::$app->user->identity->id;
    } 
    else 
        {
        $this->actualizado_em=date("Y-m-d H:i:s");
        $this->actualizado_por=Yii::$app->user->identity->id;
        $this->user_location2=Yii::$app->request->userIP;
        $this->activista_id=Yii::$app->user->identity->id;
        }
    return parent::beforeSave($insert); 
}

            public function getServicos()
    {
        return $this->hasOne(ServicosDream::className(), ['id' => 'servico_id']);
    }
	
	      public function getSubServicos()
    {
        return $this->hasOne(SubServicosDreams::className(), ['id' => 'sub_servico_id']);
    }
	
	            public function getBeneficiario()
    {
        return $this->hasOne(Beneficiarios::className(), ['id' => 'beneficiario_id']);
    }

                public function getUs()
    {
        return $this->hasOne(Us::className(), ['id' => 'us_id']);
    }
		//Ponto de entrada
	  public function getPe()
    {
        return $this->hasOne(PontosDeEntrada::className(), ['id' => 'ponto_entrada']);
    }

    public function getReceptor()
  {
     return $this->hasOne(Profile::className(), ['user_id' => 'criado_por']);
  }


}
