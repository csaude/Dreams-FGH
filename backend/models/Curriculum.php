<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "app_dream_curriculum".
 *
 * @property integer $id
 * @property string $name
 * @property integer $status
 * @property string $description
 * @property integer $criado_por
 * @property integer $actualizado_por
 * @property string $criado_em
 * @property string $actualizado_em
 * @property string $user_location
 * @property string $user_location2
 */

class Curriculum extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'app_dream_curriculum';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status', 'criado_por', 'actualizado_por'], 'integer'],
            [['status', 'name'], 'required'],
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
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Curriculum'),
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
        
        } else {
            $this->actualizado_em=date("Y-m-d H:m:s");
            $this->actualizado_por=Yii::$app->user->identity->id;
            $this->user_location2=Yii::$app->request->userIP;
        
        }

        return parent::beforeSave($insert);
    }

}