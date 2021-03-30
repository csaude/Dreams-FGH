<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "frlm_comite_provincial".
 *
 * @property integer $id
 * @property integer $provincia_id
 * @property string $name
 * @property string $description
 * @property integer $status
 * @property integer $criado_por
 * @property integer $actualizado_por
 * @property string $criado_em
 * @property string $actualizado_em
 * @property string $user_location
 * @property string $user_location2
 */
class ComiteProvincial extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'frlm_comite_provincial';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['provincia_id', 'name', 'description', 'criado_por', 'criado_em', 'user_location'], 'required'],
            [['provincia_id', 'status', 'criado_por', 'actualizado_por'], 'integer'],
            [['criado_em', 'actualizado_em'], 'safe'],
            [['name'], 'string', 'max' => 150],
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
            'provincia_id' => 'Provincia ID',
            'name' => 'Comité Provincial',
            'description' => 'Descrição',
            'status' => 'Status',
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
