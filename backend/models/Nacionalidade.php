<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "hs_hr_country".
 *
 * @property string $cou_code
 * @property string $name
 * @property string $cou_name
 * @property string $iso3
 * @property integer $numcode
 */
class Nacionalidade extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hs_hr_country';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cou_code'], 'required'],
            [['numcode'], 'integer'],
            [['cou_code'], 'string', 'max' => 2],
            [['name', 'cou_name'], 'string', 'max' => 80],
            [['iso3'], 'string', 'max' => 3],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cou_code' => Yii::t('app', 'Cód País'),
            'name' => Yii::t('app', 'Nacionalidade'),
            'cou_name' => Yii::t('app', 'País'),
            'iso3' => Yii::t('app', 'Iso3'),
            'numcode' => Yii::t('app', 'Numcode'),
        ];
    }
}
