<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "frlm_comite_cidade".
 *
 * @property integer $id
 * @property integer $provincia_id
 * @property string $name
 * @property string $description
 * @property integer $criado_por
 * @property integer $actualizado_por
 * @property string $criado_em
 * @property string $actualizado_em
 * @property string $user_location
 * @property string $user_location2
 */
class ComiteCidade extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'frlm_comite_cidade';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['provincia_id', 'name', 'description', 'criado_por', 'criado_em', 'user_location'], 'required'],
            [['provincia_id', 'criado_por', 'actualizado_por'], 'integer'],
            [['criado_em', 'actualizado_em'], 'safe'],
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
            'provincia_id' => 'Provincia ID',
            'name' => 'Name',
            'description' => 'Description',
            'criado_por' => 'Criado Por',
            'actualizado_por' => 'Actualizado Por',
            'criado_em' => 'Criado Em',
            'actualizado_em' => 'Actualizado Em',
            'user_location' => 'User Location',
            'user_location2' => 'User Location2',
        ];
    }
}
