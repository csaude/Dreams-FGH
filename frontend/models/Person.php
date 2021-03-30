<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "person".
 *
 * @property integer $id
 * @property string $prename
 * @property string $fname
 * @property string $lname
 * @property string $mtype
 */
class Person extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hs_hr_employee';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['emp_number', 'emp_firstname', 'emp_lastname', 'emp_gender'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'emp_number' => 'ID',
            'emp_number' => 'คำนำหน้า',
            'emp_firstname' => 'ชื่อ',
            'emp_lastname' => 'สกุล',
            'emp_gender' => 'ใบประกอบ',
        ];
    }
}
