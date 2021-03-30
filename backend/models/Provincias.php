<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "hs_hr_province".
 *
 * @property integer $id
 * @property string $province_name
 * @property string $province_code
 * @property string $cou_code
 */
class Provincias extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hs_hr_province';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'province_code'], 'required'],
            [['id','status'], 'integer'],
            [['province_name'], 'string', 'max' => 40],
            [['province_code', 'cou_code'], 'string', 'max' => 2],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'province_name' => 'Província',
            'province_code' => 'Código da Província',
            'cou_code' => 'Cod País',
            'status' => 'Status',
        ];
    }


}
