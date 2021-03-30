<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "frlm_comite_organizacoes".
 *
 * @property integer $id
 * @property string $name
 * @property string $abreviatura
 * @property integer $status
 * @property string $description
 * @property integer $criado_por
 * @property integer $actualizado_por
 * @property string $criado_em
 * @property string $actualizado_em
 * @property string $user_location
 * @property string $user_location2
 
 * @property Beneficiarios[] $beneficiarios
 */
class Organizacoes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'app_dream_parceiros';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'status','distrito_id'], 'required'],
            [['status', 'criado_por', 'actualizado_por','parceria_id','distrito_id'], 'integer'],
            [['criado_em', 'actualizado_em'], 'safe'],
            [['name', 'description'], 'string', 'max' => 250],
            [['abreviatura'], 'string', 'max' => 200],
            [['user_location', 'user_location2'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Instituição Parceira',
            'abreviatura' => 'Abreviatura',
			'distrito_id'=>'Distrito',
            'parceria_id'=> 'Tipo de Parceria',
            'status' => 'Status',
            'description' => 'Descrição',
            'criado_por' => 'Criado Por',
            'actualizado_por' => 'Actualizado Por',
            'criado_em' => 'Criado Em',
            'actualizado_em' => 'Actualizado Em',
            'user_location' => 'User Location',
            'user_location2' => 'User Location2',
        ];
    }
         public function beforeSave($insert) {
  

    if ($this->isNewRecord) { 
        
     $this->criado_em=date("Y-m-d H:m:s"); 
     $this->criado_por=Yii::$app->user->identity->id;
     $this->user_location=Yii::$app->request->userIP;
    } 
    else 
        {
        $this->actualizado_em=date("Y-m-d H:m:s");
        $this->actualizado_por=Yii::$app->user->identity->id;
        $this->user_location2=Yii::$app->request->userIP; }
    return parent::beforeSave($insert); 
}

         public function getTipoParceria()
    {
        return $this->hasOne(ParceirosTipo::className(), ['id' => 'parceria_id']);
    }
	      public function getDistrito()
    {
        return $this->hasOne(Distritos::className(), ['district_code' => 'distrito_id']);
    }
  
      public function getBeneficiarios()
    {
        return $this->hasMany(Beneficiarios::className(),['parceiro_id' => 'id']);
    }
}
