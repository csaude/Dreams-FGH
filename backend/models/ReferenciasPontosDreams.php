<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "app_dream_referidos".
 *
 * @property integer $id
 * @property integer $referencia_id
 * @property integer $receptor_id
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
 * @property AppDreamUs $receptor
 */
class ReferenciasPontosDreams extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'app_dream_referidos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
          //  [['referencia_id', 'status'], 'required'],
            [['referencia_id', 'receptor_id', 'status', 'criado_por', 'actualizado_por'], 'integer'],
            [['criado_em', 'actualizado_em'], 'safe'],
            [['description'], 'string', 'max' => 250],
            [['user_location', 'user_location2'], 'string', 'max' => 100],
            [['referencia_id'], 'exist', 'skipOnError' => true,
            'targetClass' => ReferenciasDreams::className(), 'targetAttribute' => ['referencia_id' => 'id']],
            [['receptor_id'], 'exist', 'skipOnError' => true,
            'targetClass' => Us::className(), 'targetAttribute' => ['receptor_id' => 'id']],
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
            'receptor_id' => Yii::t('app', 'Local'),
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
      $this->user_location2=Yii::$app->request->userIP;

      }
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
    public function getReceptor()
    {
        return $this->hasOne(Us::className(), ['id' => 'receptor_id']);
    }
}
