<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "app_dream_pontos_entrada".
 *
 * @property integer $id
 * @property string $abrev
 * @property string $name
 * @property string $description
 * @property integer $criado_por
 * @property integer $actualizado_por
 * @property string $criado_em
 * @property string $actualizado_em
 * @property string $user_location
 * @property string $user_location2
 */
class PontosDeEntrada extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'app_dream_pontos_entrada';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['abrev', 'name'], 'required'],
            [['criado_por', 'actualizado_por'], 'integer'],
            [['criado_em', 'actualizado_em'], 'safe'],
            [['abrev'], 'string', 'max' => 10],
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
            'id' => Yii::t('app', 'ID'),
            'abrev' => Yii::t('app', 'PE'),
            'name' => Yii::t('app', 'Ponto de Entrada'),
            'description' => Yii::t('app', 'Descrição do PE'),
            'criado_por' => Yii::t('app', 'Criado Por'),
            'actualizado_por' => Yii::t('app', 'Actualizado Por'),
            'criado_em' => Yii::t('app', 'Criado Em'),
            'actualizado_em' => Yii::t('app', 'Actualizado Em'),
            'user_location' => Yii::t('app', 'User Location'),
            'user_location2' => Yii::t('app', 'User Location2'),
        ];
    }
}
