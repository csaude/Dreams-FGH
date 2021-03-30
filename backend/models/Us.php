<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "app_dream_us".
 *
 * @property integer $id
 * @property integer $provincia_id
 * @property integer $nivel_id
 * @property integer $distrito_id
 * @property integer $post_admin_id
 * @property string $name
 * @property string $description
 * @property integer $criado_por
 * @property integer $actualizado_por
 * @property string $criado_em
 * @property string $actualizado_em
 * @property string $user_location
 * @property string $user_location2
 */
class Us extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'app_dream_us';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['provincia_id', 'nivel_id', 'distrito_id', 'post_admin_id', 'criado_por', 'status','actualizado_por'], 'integer'],
            [['distrito_id','provincia_id','nivel_id','post_admin_id','name','cod_us'], 'required'],
            [['criado_em', 'actualizado_em','cod_us'], 'safe'],
            [['name'], 'string', 'max' => 150],
            [['description'], 'string', 'max' => 250],
            [['user_location', 'user_location2','lat','lng'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'provincia_id' => Yii::t('app', 'Província'),
            'nivel_id' => Yii::t('app', 'Nível'),
            'cod_us' => Yii::t('app', 'Código da US'),
            'distrito_id' => Yii::t('app', 'Distrito'),
            'post_admin_id' => Yii::t('app', 'Posto Administrativo'),
            'name' => Yii::t('app', 'Nome da US'),
            'description' => Yii::t('app', 'Descrição'),
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
        $this->user_location2=Yii::$app->request->userIP; }
    return parent::beforeSave($insert); 
}


     public function getProvincia()
    {
        return $this->hasOne(Provincias::className(), ['id' => 'provincia_id']);
    }

           public function getDistrito()
    {
        return $this->hasOne(Distritos::className(), ['district_code' => 'distrito_id']);
    }

           public function getLocalidade()
    {
        return $this->hasOne(ComiteLocalidades::className(), ['id' => 'post_admin_id']);
    }

          public function getNivel()
    {
        return $this->hasOne(TipoUs::className(), ['id' => 'nivel_id']);
    }


}
