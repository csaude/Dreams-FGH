<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "app_dream_tipo_us".
 *
 * @property integer $id
 * @property string $nivel
 * @property string $name
 * @property string $tipo
 * @property integer $status
 * @property string $description
 * @property integer $criado_por
 * @property integer $actualizado_por
 * @property string $criado_em
 * @property string $actualizado_em
 * @property string $user_location
 * @property string $user_location2
 */
class TipoUs extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'app_dream_tipo_us';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nivel', 'name','tipo', 'status'], 'required'],
            [['status', 'criado_por', 'actualizado_por'], 'integer'],
            [['criado_em', 'actualizado_em'], 'safe'],
            [['nivel', 'name'], 'string', 'max' => 50],
            [['tipo'], 'string', 'max' => 250],
            [['description'], 'string', 'max' => 550],
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
            'nivel' => Yii::t('app', 'Nível'),
            'name' => Yii::t('app', 'Nível da US'),
            'tipo' => Yii::t('app', 'Tipo de US'),
            'status' => Yii::t('app', 'Status'),
            'description' => Yii::t('app', 'Descrição'),
            'criado_por' => Yii::t('app', 'Criado Por'),
            'actualizado_por' => Yii::t('app', 'Actualizado Por'),
            'criado_em' => Yii::t('app', 'Criado Em'),
            'actualizado_em' => Yii::t('app', 'Actualizado Em'),
            'user_location' => Yii::t('app', 'User Location'),
            'user_location2' => Yii::t('app', 'User Location2'),
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
