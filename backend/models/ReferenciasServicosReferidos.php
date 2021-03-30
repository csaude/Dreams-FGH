<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "app_dream_referencias_s".
 *
 * @property integer $id
 * @property integer $referencia_id
 * @property integer $servico_id
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
 * @property AppDreamReferencias $referencia
 * @property AppDreamServicos $servico
 */
class ReferenciasServicosReferidos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'app_dream_referencias_s';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[ 'servico_id','status'], 'required'],
            [['referencia_id', 'servico_id', 'status', 'criado_por', 'actualizado_por'], 'integer'],
            [['criado_em', 'actualizado_em'], 'safe'],
            [['name', 'description'], 'string', 'max' => 250],
            [['user_location', 'user_location2'], 'string', 'max' => 100],
            [['referencia_id'], 'exist', 'skipOnError' => true, 'targetClass' => ReferenciasDreams::className(), 'targetAttribute' => ['referencia_id' => 'id']],
            [['servico_id'], 'exist', 'skipOnError' => true, 'targetClass' => ServicosDream::className(), 'targetAttribute' => ['servico_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'referencia_id' => Yii::t('app', 'Referência'),
            'servico_id' => Yii::t('app', 'Serviço Referido'),
            'name' => Yii::t('app', 'Name'),
            'status' => Yii::t('app', 'Status'),
            'description' => Yii::t('app', 'Observação'),
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReferencia()
    {
        return $this->hasOne(ReferenciasDreams::className(), ['id' => 'referencia_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServico()
    {
        return $this->hasOne(ServicosDream::className(), ['id' => 'servico_id']);
    }
}
