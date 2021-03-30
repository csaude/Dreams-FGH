<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "hs_hr_employee".
 *
 * @property integer $id
 * @property integer $emp_number
 * @property string $employee_id
 * @property string $emp_lastname
 * @property string $emp_firstname
 * @property string $emp_middle_name
 * @property string $emp_nick_name
 * @property integer $emp_smoker
 * @property string $ethnic_race_code
 * @property string $emp_birthday
 * @property integer $nation_code
 * @property integer $emp_gender
 * @property string $emp_marital_status
 * @property string $emp_ssn_num
 * @property string $emp_sin_num
 * @property string $emp_other_id
 * @property string $emp_dri_lice_num
 * @property string $emp_dri_lice_exp_date
 * @property string $emp_military_service
 * @property integer $emp_status
 * @property integer $job_title_code
 * @property integer $eeo_cat_code
 * @property integer $work_station
 * @property string $emp_street1
 * @property string $emp_street2
 * @property string $city_code
 * @property string $coun_code
 * @property string $provin_code
 * @property string $emp_zipcode
 * @property string $emp_hm_telephone
 * @property string $emp_mobile
 * @property string $emp_work_telephone
 * @property string $emp_work_email
 * @property string $sal_grd_code
 * @property string $joined_date
 * @property string $emp_oth_email
 * @property integer $termination_id
 * @property integer $faculdade_id
 * @property integer $curso_id
 * @property string $ano_conclusao12
 * @property string $ano_conclusao
 * @property string $custom1
 * @property string $custom2
 * @property string $custom3
 * @property string $custom4
 * @property string $custom5
 * @property string $custom6
 * @property string $custom7
 * @property string $custom8
 * @property string $custom9
 * @property string $custom10
 * @property integer $criado_por
 * @property integer $actualizado_por
 * @property string $criado_em
 * @property string $actualizado_em
 * @property string $user_location
 * @property string $user_location2
 */
class Membros extends \yii\db\ActiveRecord
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
            [['emp_number', 'emp_smoker', 'nation_code', 'emp_gender', 'emp_status', 'job_title_code', 'eeo_cat_code', 'work_station', 'termination_id', 'faculdade_id', 'curso_id', 'criado_por', 'actualizado_por'], 'integer'],
            [['emp_birthday', 'emp_dri_lice_exp_date', 'joined_date', 'criado_em', 'actualizado_em'], 'safe'],
            [['ano_conclusao12', 'ano_conclusao'], 'required'],
            [['employee_id', 'emp_hm_telephone', 'emp_mobile', 'emp_work_telephone', 'emp_work_email', 'emp_oth_email', 'user_location'], 'string', 'max' => 50],
            [['emp_lastname', 'emp_firstname', 'emp_middle_name', 'emp_nick_name', 'emp_ssn_num', 'emp_sin_num', 'emp_other_id', 'emp_dri_lice_num', 'emp_military_service', 'emp_street1', 'emp_street2', 'city_code', 'coun_code', 'provin_code'], 'string', 'max' => 100],
            [['ethnic_race_code', 'sal_grd_code'], 'string', 'max' => 13],
            [['emp_marital_status', 'emp_zipcode'], 'string', 'max' => 20],
            [['ano_conclusao12', 'ano_conclusao'], 'string', 'max' => 15],
            [['custom1', 'custom2', 'custom3', 'custom4', 'custom5', 'custom6', 'custom7', 'custom8', 'custom9', 'custom10'], 'string', 'max' => 250],
            [['user_location2'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'emp_number' => 'Emp Number',
            'employee_id' => 'Employee ID',
            'emp_lastname' => 'Emp Lastname',
            'emp_firstname' => 'Emp Firstname',
            'emp_middle_name' => 'Emp Middle Name',
            'emp_nick_name' => 'Emp Nick Name',
            'emp_smoker' => 'Emp Smoker',
            'ethnic_race_code' => 'Ethnic Race Code',
            'emp_birthday' => 'Emp Birthday',
            'nation_code' => 'Nation Code',
            'emp_gender' => 'Emp Gender',
            'emp_marital_status' => 'Emp Marital Status',
            'emp_ssn_num' => 'Emp Ssn Num',
            'emp_sin_num' => 'Emp Sin Num',
            'emp_other_id' => 'Emp Other ID',
            'emp_dri_lice_num' => 'Emp Dri Lice Num',
            'emp_dri_lice_exp_date' => 'Emp Dri Lice Exp Date',
            'emp_military_service' => 'Emp Military Service',
            'emp_status' => 'Emp Status',
            'job_title_code' => 'Job Title Code',
            'eeo_cat_code' => 'Eeo Cat Code',
            'work_station' => 'Work Station',
            'emp_street1' => 'Emp Street1',
            'emp_street2' => 'Emp Street2',
            'city_code' => 'City Code',
            'coun_code' => 'Coun Code',
            'provin_code' => 'Provin Code',
            'emp_zipcode' => 'Emp Zipcode',
            'emp_hm_telephone' => 'Emp Hm Telephone',
            'emp_mobile' => 'Emp Mobile',
            'emp_work_telephone' => 'Emp Work Telephone',
            'emp_work_email' => 'Emp Work Email',
            'sal_grd_code' => 'Sal Grd Code',
            'joined_date' => 'Joined Date',
            'emp_oth_email' => 'Emp Oth Email',
            'termination_id' => 'Termination ID',
            'faculdade_id' => 'Faculdade ID',
            'curso_id' => 'Curso ID',
            'ano_conclusao12' => 'Ano Conclusao12',
            'ano_conclusao' => 'Ano Conclusao',
            'custom1' => 'Custom1',
            'custom2' => 'Custom2',
            'custom3' => 'Custom3',
            'custom4' => 'Custom4',
            'custom5' => 'Custom5',
            'custom6' => 'Custom6',
            'custom7' => 'Custom7',
            'custom8' => 'Custom8',
            'custom9' => 'Custom9',
            'custom10' => 'Custom10',
            'criado_por' => 'Criado Por',
            'actualizado_por' => 'Actualizado Por',
            'criado_em' => 'Criado Em',
            'actualizado_em' => 'Actualizado Em',
            'user_location' => 'User Location',
            'user_location2' => 'User Location2',
        ];
    }
}
