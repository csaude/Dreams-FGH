<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "frlm_comite_nacionalidade".
 *
 * @property integer $id
 * @property string $pais_id
 * @property string $name
 * @property string $description
 * @property integer $status
 * @property integer $criado_por
 * @property integer $actualizado_por
 * @property string $criado_em
 * @property string $actualizado_em
 * @property string $user_location
 * @property string $user_location2
 */
class ComiteNacionalidade extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'frlm_comite_nacionalidade';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'pais_id', 'name', 'description', 'criado_por', 'criado_em', 'user_location'], 'required'],
            [['id', 'status', 'criado_por', 'actualizado_por'], 'integer'],
            [['criado_em', 'actualizado_em'], 'safe'],
            [['pais_id'], 'string', 'max' => 11],
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
            'pais_id' => 'Pais ID',
            'name' => 'Nacionalidade',
            'description' => 'Description',
            'status' => 'Status',
            'criado_por' => 'Criado Por',
            'actualizado_por' => 'Actualizado Por',
            'criado_em' => 'Criado Em',
            'actualizado_em' => 'Actualizado Em',
            'user_location' => 'User Location',
            'user_location2' => 'User Location2',
        ];
    }
}
