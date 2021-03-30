<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "app_dream_faixa_etaria".
 *
 * @property integer $id
 * @property string $faixa_etaria
 * @property integer $nivel_intervencao_id
 * @property integer $status
 * @property string $description
 * @property integer $criado_por
 * @property integer $actualizado_por
 * @property string $criado_em
 * @property string $actualizado_em
 * @property string $user_location
 * @property string $user_location2
 */
class FaixaEtaria extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'app_dream_faixa_etaria';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nivel_intervencao_id', 'status', 'criado_por', 'actualizado_por'], 'integer'],
            [['status', 'nivel_intervencao_id'], 'required'],
            [['criado_em', 'actualizado_em'], 'safe'],
            [['faixa_etaria'], 'string', 'max' => 50],
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
            'id' => Yii::t('app', 'ID'),
            'faixa_etaria' => Yii::t('app', 'Faixa Etária'),
            'nivel_intervencao_id' => Yii::t('app', 'Nivel Intervenção'),
            'status' => Yii::t('app', 'Status'),
            'description' => Yii::t('app', 'Observação'),
            'criado_por' => Yii::t('app', 'Criado Por'),
            'actualizado_por' => Yii::t('app', 'Actualizado Por'),
            'criado_em' => Yii::t('app', 'Criado Em'),
            'actualizado_em' => Yii::t('app', 'Actualizado Em'),
            'user_location' => Yii::t('app', 'Criado Por'),
            'user_location2' => Yii::t('app', 'Actualizado Por'),
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

 public function getNivelIntervensao()
{
return $this->hasOne(NivelIntervensao::className(), ['id' => 'nivel_intervencao_id']);
}



}
