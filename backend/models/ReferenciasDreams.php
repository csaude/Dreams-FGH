<?php

namespace app\models;

use Yii;
use common\models\User;

/**
 * This is the model class for table "app_dream_referencias".
 *
 * @property integer $id
 * @property integer $beneficiario_id
 * @property string $nota_referencia
 * @property string $name
 * @property string $projecto
 * @property integer $referido_por
 * @property integer $notificar_ao
 * @property integer $status
 * @property string $description
 * @property integer $criado_por
 * @property integer $actualizado_por
 * @property string $criado_em
 * @property string $actualizado_em
 * @property string $user_location
 * @property string $user_location2
 *
 * @property AppDreamReferenciasS[] $appDreamReferenciasSes
 */
class ReferenciasDreams extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'app_dream_referencias';
    }

    /**
     * @inheritdoc
	 , 'status'
	*/
	    public function rules()
    {
        return [
            [['beneficiario_id', 'nota_referencia','referido_por', 'notificar_ao','projecto','refer_to', 'servico_id', 'ref_livro', 'num_livro'], 'required'],
            [['beneficiario_id', 'distrito_id', 'servico_id', 'status', 'criado_por', 'actualizado_por'], 'integer'],
            [['criado_em', 'actualizado_em','intervensao','status_ref'], 'safe'],
            [['nota_referencia'], 'string', 'max' => 100],
            [['name', 'description'], 'string', 'max' => 250],
            [['projecto'], 'string', 'max' => 150],
            [['refer_to', 'num_livro', 'ref_livro'], 'string', 'max' => 100],
            [['referido_por', 'notificar_ao', 'user_location', 'user_location2'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */

	public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'beneficiario_id' => Yii::t('app', 'Nº de Beneficiário'),
            'nota_referencia' => Yii::t('app', 'Nota Referência'),
            'name' => Yii::t('app', 'Título'),
			'distrito_id' => Yii::t('app', 'Distrito'),
            'projecto' => Yii::t('app', 'Organização'),
			'refer_to' => Yii::t('app', 'Referir Para'),
            'referido_por' => Yii::t('app', 'Referente'),
            'notificar_ao' => Yii::t('app', 'Notificar ao'),
            'num_livro' => Yii::t('app', 'Nº do Livro'),
            'ref_livro' => Yii::t('app', 'Cód Ref. no livro'),
            'servico_id'=>Yii::t('app', 'Tipo de Serviço'),
            'intervensao'=>Yii::t('app', 'Intervensões Principais'),
            'status' => Yii::t('app', 'Status'),
	    'status_ref' =>Yii::t('app','Estado'),
            'description' => Yii::t('app', 'Observações'),
            'criado_por' => Yii::t('app', 'Criado Por'),
            'actualizado_por' => Yii::t('app', 'Actualizado Por'),
            'criado_em' => Yii::t('app', 'Referido em'),
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

  }
  else
      {
      $this->actualizado_em=date("Y-m-d H:i:s");
      $this->actualizado_por=Yii::$app->user->identity->id;
      $this->user_location2=Yii::$app->request->userIP;

      }
  return parent::beforeSave($insert);
}

public function getBeneficiario()
{
   return $this->hasOne(Beneficiarios::className(), ['emp_number' => 'beneficiario_id']);
}

public function getReferente()
{
   return $this->hasOne(User::className(), ['id' => 'referido_por']);
}

public function getReceptor()
{
   return $this->hasOne(User::className(), ['id' => 'notificar_ao']);
}

public function getNreferente()
{
   return $this->hasOne(Profile::className(), ['user_id' => 'referido_por']);
}
	
	public function getNreceptor()
{
   return $this->hasMany(Profile::className(), ['user_id' => 'notificar_ao']);
}

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPontosReferidos()
    {
        return $this->hasMany(ReferenciasPontosDreams::className(), ['referencia_id' => 'id']);
    }
	
	  public function getTservico()
    {
        return $this->hasOne(TipoServicos::className(), ['id' => 'servico_id']);
    }
public function getOrganizacao()
    {
        return $this->hasOne(Organizacoes::className(), ['id' => 'projecto']);
    }
}
