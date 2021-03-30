<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "frlm_comite_distrital".
 *
 * @property integer $id
 * @property integer $c_provincial_id
 * @property integer $distrito_id
 * @property string $name
 * @property string $description
 * @property integer $criado_por
 * @property integer $actualizado_por
 * @property string $criado_em
 * @property string $actualizado_em
 * @property string $user_location
 * @property string $user_location2
 */
class ComiteDistrital extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'frlm_comite_distrital';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['c_provincial_id', 'distrito_id', 'name'], 'required'],
            [['c_provincial_id', 'distrito_id', 'criado_por', 'actualizado_por'], 'integer'],
            [['criado_em', 'actualizado_em', 'criado_por', 'user_location'], 'safe'],
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
            'c_provincial_id' => 'Comité Provincial',
            'distrito_id' => 'Distrito',
            'name' => 'Comité Distrital',
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


         public function getCProvincial()
    {
        return $this->hasOne(ComiteProvincial::className(), ['id' => 'c_provincial_id']);
    }


         public function getDistrito()
    {
        return $this->hasOne(Distritos::className(), ['district_code' => 'distrito_id']);
    }
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'criado_por']);
    }


}
