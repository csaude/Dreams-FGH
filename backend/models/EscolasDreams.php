<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "app_dream_escolas".
 *
 * @property integer $id
 * @property integer $distrito_id
 * @property integer $bairro_id
 * @property string $lat
 * @property string $lng
 * @property string $name
 * @property string $description
 * @property integer $criado_por
 * @property integer $actualizado_por
 * @property string $criado_em
 * @property string $actualizado_em
 * @property string $user_location
 * @property string $user_location2
 */
class EscolasDreams extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'app_dream_escolas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['distrito_id', 'name'], 'required'],
            [['distrito_id', 'bairro_id', 'criado_por', 'actualizado_por'], 'integer'],
            [['criado_em', 'actualizado_em'], 'safe'],
            [['lat', 'lng', 'user_location', 'user_location2'], 'string', 'max' => 100],
            [['name'], 'string', 'max' => 150],
            [['description'], 'string', 'max' => 250],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'distrito_id' => Yii::t('app', 'Distrito'),
            'bairro_id' => Yii::t('app', 'Bairro'),
            'description' => Yii::t('app', 'Observação'),
            'lat' => Yii::t('app', 'Latitude'),
            'lng' => Yii::t('app', 'Longitude'),
            'name' => Yii::t('app', 'Nome da Escola'),
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
        $this->user_location2=Yii::$app->request->userIP;
       
        }
    return parent::beforeSave($insert); 
}

            public function getDistritos()
    {
        return $this->hasOne(Distritos::className(), ['district_code' => 'distrito_id']);
    }

                public function getBairros()
    {
        return $this->hasOne(Bairros::className(), ['id' => 'bairro_id']);
    }
}
