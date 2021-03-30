<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "app_dream_bairros".
 *
 * @property integer $id
 * @property integer $distrito_id
 * @property integer $post_admin_id
 * @property string $name
 * @property string $cod_us
 * @property string $description
 * @property string $lat
 * @property string $lng
 * @property integer $status
 * @property integer $criado_por
 * @property integer $actualizado_por
 * @property string $criado_em
 * @property string $actualizado_em
 * @property string $user_location
 * @property string $user_location2
 */
class Bairros extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'app_dream_bairros';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['distrito_id', 'name', 'post_admin_id' ], 'required'],
            [['distrito_id', 'post_admin_id', 'status', 'criado_por', 'actualizado_por'], 'integer'],
            [['criado_em', 'actualizado_em'], 'safe'],
            [['name'], 'string', 'max' => 150],
            [['cod_us'], 'string', 'max' => 25],
            [['description'], 'string', 'max' => 250],
            [['lat', 'lng', 'user_location', 'user_location2'], 'string', 'max' => 100],
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
            'post_admin_id' => Yii::t('app', 'Posto Administrativo'),
            'name' => Yii::t('app', 'Nome do Bairro'),
            'cod_us' => Yii::t('app', 'US mais Próxima'),
            'description' => Yii::t('app', 'Observação'),
            'lat' => Yii::t('app', 'Latitude'),
            'lng' => Yii::t('app', 'Longitude'),
            'status' => Yii::t('app', 'Status'),
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

                public function getPAdmin()
    {
        return $this->hasOne(ComiteLocalidades::className(), ['id' => 'post_admin_id']);
    }

                public function getUs()
    {
        return $this->hasOne(Us::className(), ['id' => 'cod_us']);
    }
}
