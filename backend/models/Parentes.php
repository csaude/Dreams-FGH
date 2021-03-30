<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "app_dream_parentes".
 *
 * @property integer $id
 * @property string $relacao_parentesco
 * @property string $name
 * @property string $description
 * @property integer $criado_por
 * @property integer $actualizado_por
 * @property string $criado_em
 * @property string $actualizado_em
 * @property string $user_location
 * @property string $user_location2
 */
class Parentes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'app_dream_parentes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'description', 'criado_por', 'criado_em', 'user_location'], 'required'],
            [['criado_por', 'actualizado_por'], 'integer'],
            [['criado_em', 'actualizado_em'], 'safe'],
            [['relacao_parentesco', 'user_location', 'user_location2'], 'string', 'max' => 100],
            [['name'], 'string', 'max' => 150],
            [['description'], 'string', 'max' => 250],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'relacao_parentesco' => Yii::t('app', 'Relacao Parentesco'),
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
            'criado_por' => Yii::t('app', 'Criado Por'),
            'actualizado_por' => Yii::t('app', 'Actualizado Por'),
            'criado_em' => Yii::t('app', 'Criado Em'),
            'actualizado_em' => Yii::t('app', 'Actualizado Em'),
            'user_location' => Yii::t('app', 'User Location'),
            'user_location2' => Yii::t('app', 'User Location2'),
        ];
    }
}
