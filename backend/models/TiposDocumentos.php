<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "isdb_tipos_documentos".
 *
 * @property integer $id
 * @property string $name
 * @property string $descricao
 * @property string $validade
 * @property integer $exigencia
 * @property integer $status
 * @property integer $criado_por
 * @property integer $actualizado_por
 * @property string $criado_em
 * @property string $actualizado_em
 * @property string $user_location
 */
class TiposDocumentos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'frlm_comite_tipos_documentos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name','abrev'], 'required'],
            [['descricao'], 'string'],
            [[ 'exigencia','status', 'criado_por', 'actualizado_por'], 'integer'],
            [['criado_em', 'actualizado_em'], 'safe'],
            [['name', 'validade', 'user_location'], 'string', 'max' => 150]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Nome Documento',
            'abrev'=>'Abreviatura',
            'descricao' => 'Descrição',
            'validade' => 'Validade',
            'exigencia' => 'Obrigatório',
            'status' => 'Status',
            'criado_por' => 'Criado Por',
            'actualizado_por' => 'Actualizado Por',
            'criado_em' => 'Criado Em',
            'actualizado_em' => 'Actualizado Em',
            'user_location' => 'User Location',
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
        $this->user_location=Yii::$app->request->userIP;}
    return parent::beforeSave($insert); 
}

}
