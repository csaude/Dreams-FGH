<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "frlm_comite_quotas".
 *
 * @property integer $id
 * @property integer $member_id
 * @property string $data_pagamento
 * @property integer $meio_pagamento
 * @property integer $local_pagamento
 * @property string $receptor
 * @property integer $status
 * @property string $description
 * @property integer $criado_por
 * @property integer $actualizado_por
 * @property string $criado_em
 * @property string $actualizado_em
 * @property string $user_location
 * @property string $user_location2
 */
class Quotas extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'frlm_comite_quotas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['member_id', 'quota_id','quantia','data_pagamento', 'meio_pagamento', 'local_pagamento', 'receptor', 'status'], 'required'],
            [['member_id','quota_id', 'meio_pagamento',  'status', 'criado_por', 'actualizado_por'], 'integer'],
            [['criado_em', 'local_pagamento','actualizado_em'], 'safe'],
            [['data_pagamento'], 'string', 'max' => 15],
            [['receptor'], 'string', 'max' => 150],
            [['description'], 'string', 'max' => 250],
            [['user_location', 'user_location2'], 'string', 'max' => 100],
            [['quantia'], 'number', 'numberPattern' => '/^\s*[-+]?[0-9]*[.,]?[0-9]+([eE][-+]?[0-9]+)?\s*$/'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'quota_id'=> 'Tipo de Quota',
            'quantia'=> 'Quantia (MT)',
            'member_id' => 'Membro',
            'data_pagamento' => 'Data Pagamento',
            'meio_pagamento' => 'Forma de Pagamento',
            'local_pagamento' => 'Local Pagamento',
            'receptor' => 'Receptor',
            'status' => 'Status',
            'description' => 'Descrição do Pagamento',
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
        $this->user_location2=Yii::$app->request->userIP;
        }
    return parent::beforeSave($insert); 
}


         public function getMembro()
    {
        return $this->hasOne(Membros::className(), ['id' => 'member_id']);
    }

             public function getTipoQ()
    {
        return $this->hasOne(TiposDeQuotas::className(), ['id' => 'quota_id']);
    }
             public function getFormaP()
    {
        return $this->hasOne(ComiteFormaPagamento::className(), ['id' => 'meio_pagamento']);
    }
                 public function getLocalP()
    {
        return $this->hasOne(ComiteLocalidades::className(), ['id' => 'local_pagamento']);
    }
}
