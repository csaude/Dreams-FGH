<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "hs_hr_district".
 *
 * @property string $district_code
 * @property string $district_name
 * @property string $province_code
 */
class Distritos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hs_hr_district';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['district_name'], 'required'],
            [['district_code','cod_distrito', 'province_code'], 'string', 'max' => 50],
            [['district_name'], 'unique'],
            [['district_name'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'district_code' => 'ID',
			'cod_distrito'=>'Código do Distrito',
            'district_name' => 'Nome do Distrito',
            'province_code' => 'Província',
        ];
    }
         public function getProvincia()
    {
        return $this->hasOne(Provincias::className(), ['id' => 'province_code']);
    }
}
