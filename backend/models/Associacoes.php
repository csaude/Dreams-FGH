<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "frlm_comite_membro_org".
 *
 * @property integer $id
 * @property integer $membro_id
 * @property integer $organizacao_id
 * @property integer $cargo_id
 * @property string $from_date
 * @property string $to_date
 * @property integer $status
 * @property string $description
 * @property integer $criado_por
 * @property integer $actualizado_por
 * @property string $criado_em
 * @property string $actualizado_em
 * @property string $user_location
 * @property string $user_location2
 *
 */
class Associacoes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'frlm_comite_membro_org';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['membro_id', 'status'], 'required'],
            [['membro_id', 'organizacao_id', 'cargo_id', 'status', 'criado_por', 'actualizado_por'], 'integer'],
            [['criado_em', 'actualizado_em'], 'safe'],
            [['from_date', 'to_date'], 'string', 'max' => 50],
            [['description'], 'string', 'max' => 250],
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
            'membro_id' => 'Membro',
            'organizacao_id' => 'Organização',
            'cargo_id' => 'Cargo',
            'from_date'=> 'Data início',
            'to_date'=> 'Data fim',
            'status' => 'Estado',
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
}
