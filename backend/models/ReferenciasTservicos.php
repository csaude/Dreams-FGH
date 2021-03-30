<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "app_dream_ref_tservicos".
 *
 * @property integer $id
 * @property integer $tipo_servico_id
 * @property string $name
 * @property integer $status
 * @property string $description
 * @property integer $criado_por
 * @property integer $actualizado_por
 * @property string $criado_em
 * @property string $actualizado_em
 * @property string $user_location
 * @property string $user_location2
 *
 * @property AppDreamRefServicos[] $appDreamRefServicos
 * @property AppDreamTipoServicos $tipoServico
 */
class ReferenciasTservicos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'app_dream_ref_tservicos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tipo_servico_id', 'status', 'criado_por', 'actualizado_por'], 'integer'],
            [['name', 'status', 'description', 'criado_por', 'criado_em', 'user_location'], 'required'],
            [['criado_em', 'actualizado_em'], 'safe'],
            [['name', 'description'], 'string', 'max' => 250],
            [['user_location', 'user_location2'], 'string', 'max' => 100],
            [['tipo_servico_id'], 'exist', 'skipOnError' => true, 'targetClass' => AppDreamTipoServicos::className(), 'targetAttribute' => ['tipo_servico_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'tipo_servico_id' => Yii::t('app', 'Tipo Servico ID'),
            'name' => Yii::t('app', 'Name'),
            'status' => Yii::t('app', 'Status'),
            'description' => Yii::t('app', 'Description'),
            'criado_por' => Yii::t('app', 'Criado Por'),
            'actualizado_por' => Yii::t('app', 'Actualizado Por'),
            'criado_em' => Yii::t('app', 'Criado Em'),
            'actualizado_em' => Yii::t('app', 'Actualizado Em'),
            'user_location' => Yii::t('app', 'User Location'),
            'user_location2' => Yii::t('app', 'User Location2'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppDreamRefServicos()
    {
        return $this->hasMany(AppDreamRefServicos::className(), ['tservico_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoServico()
    {
        return $this->hasOne(AppDreamTipoServicos::className(), ['id' => 'tipo_servico_id']);
    }
}
