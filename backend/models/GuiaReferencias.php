<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "app_dream_referencias".
 *
 * @property integer $id
 * @property integer $beneficiario_id
 * @property integer $servico_id
 * @property string $name
 * @property string $projecto
 * @property integer $referido_por
 * @property integer $notificar_ao
 * @property integer $status
 * @property string $description
 * @property integer $criado_por
 * @property integer $actualizado_por
 * @property string $criado_em
 * @property string $actualizado_em
 * @property string $user_location
 * @property string $user_location2
 *
 * @property AppDreamReferenciasS[] $appDreamReferenciasSes
 */
class GuiaReferencias extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'app_dream_referencias';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['beneficiario_id','referido_por', 'projecto', 'notificar_ao', 'status'], 'required'],
            [['beneficiario_id',  'referido_por', 'notificar_ao', 'status', 'criado_por', 'actualizado_por'], 'integer'],
            [['criado_em', 'actualizado_em'], 'safe'],
            [['beneficiario_id'], 'validateBeneficiario'],
            [['name', 'description'], 'string', 'max' => 250],
            [['projecto'], 'string', 'max' => 150],
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
            'beneficiario_id' => Yii::t('app', 'Nº Beneficiário'),
            'name' => Yii::t('app', 'Nome Beneficiário'),
            'projecto' => Yii::t('app', 'Projecto'),
            'referido_por' => Yii::t('app', 'Referido Por'),
            'notificar_ao' => Yii::t('app', 'Notificar Ao'),
            'status' => Yii::t('app', 'Status'),
            'description' => Yii::t('app', 'Observações'),
            'criado_por' => Yii::t('app', 'Criado Por'),
            'actualizado_por' => Yii::t('app', 'Actualizado Por'),
            'criado_em' => Yii::t('app', 'Criado Em'),
            'actualizado_em' => Yii::t('app', 'Actualizado Em'),
            'user_location' => Yii::t('app', 'User Location'),
            'user_location2' => Yii::t('app', 'User Location2'),
        ];
    }


    public function validateBeneficiario($attribute, $params)
{
    if ($this->beneficiario_id<1) {


        return    $this->addError($attribute, 'Incorrect username or password.');

    }
}

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppDreamReferenciasSes()
    {
        return $this->hasMany(AppDreamReferenciasS::className(), ['referencia_id' => 'id']);
    }
}
