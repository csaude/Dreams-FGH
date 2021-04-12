<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "app_dream_curriculum_servicos".
 *
 * @property integer $curriculum_id
 * @property integer $servico_id
 * @property integer $status
 * @property string $description
 * @property integer $criado_por
 * @property integer $actualizado_por
 * @property string $criado_em
 * @property string $actualizado_em
 * @property string $user_location
 * @property string $user_location2
 */

class CurriculumServicos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'app_dream_curriculum_servicos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['curriculum_id', 'servico_id', 'status'], 'required'],
            [['curriculum_id', 'servico_id', 'status', 'criado_por', 'actualizado_por'], 'integer'],
            [['criado_em', 'actualizado_em'], 'safe'],
            [['criado_em', 'actualizado_em'], 'safe'],
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
            'curriculum_id' => Yii::t('app', 'Curriculum'),
            'servico_id' => Yii::t('app', 'Serviço'),
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
            
        } else {
            $this->actualizado_em=date("Y-m-d H:m:s");
            $this->actualizado_por=Yii::$app->user->identity->id;
            $this->user_location2=Yii::$app->request->userIP;
        
        }

        return parent::beforeSave($insert);
    }

    public function getCurriculum()
    {
        return $this->hasOne(Curriculum::className(), ['id' => 'curriculum_id']);
    }

    public function getServico()
    {
        return $this->hasOne(ServicosDream::className(), ['id' => 'servico_id']);
    }

}