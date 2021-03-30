<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ohrm_education".
 *
 * @property integer $id
 * @property string $name
 */
class Educacao extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ohrm_education';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'name'], 'required'],
            [['id'], 'integer'],
            [['name'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Grau Acadêmico',
        ];
    }
}
