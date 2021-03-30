<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MembrosSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="membros-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'emp_number') ?>

    <?= $form->field($model, 'employee_id') ?>

    <?= $form->field($model, 'emp_lastname') ?>

    <?= $form->field($model, 'emp_firstname') ?>

    <?php // echo $form->field($model, 'emp_middle_name') ?>

    <?php // echo $form->field($model, 'emp_nick_name') ?>

    <?php // echo $form->field($model, 'emp_smoker') ?>

    <?php // echo $form->field($model, 'ethnic_race_code') ?>

    <?php // echo $form->field($model, 'emp_birthday') ?>

    <?php // echo $form->field($model, 'nation_code') ?>

    <?php // echo $form->field($model, 'emp_gender') ?>

    <?php // echo $form->field($model, 'emp_marital_status') ?>

    <?php // echo $form->field($model, 'emp_ssn_num') ?>

    <?php // echo $form->field($model, 'emp_sin_num') ?>

    <?php // echo $form->field($model, 'emp_other_id') ?>

    <?php // echo $form->field($model, 'emp_dri_lice_num') ?>

    <?php // echo $form->field($model, 'emp_dri_lice_exp_date') ?>

    <?php // echo $form->field($model, 'emp_military_service') ?>

    <?php // echo $form->field($model, 'emp_status') ?>

    <?php // echo $form->field($model, 'job_title_code') ?>

    <?php // echo $form->field($model, 'eeo_cat_code') ?>

    <?php // echo $form->field($model, 'work_station') ?>

    <?php // echo $form->field($model, 'emp_street1') ?>

    <?php // echo $form->field($model, 'emp_street2') ?>

    <?php // echo $form->field($model, 'city_code') ?>

    <?php // echo $form->field($model, 'coun_code') ?>

    <?php // echo $form->field($model, 'provin_code') ?>

    <?php // echo $form->field($model, 'emp_zipcode') ?>

    <?php // echo $form->field($model, 'emp_hm_telephone') ?>

    <?php // echo $form->field($model, 'emp_mobile') ?>

    <?php // echo $form->field($model, 'emp_work_telephone') ?>

    <?php // echo $form->field($model, 'emp_work_email') ?>

    <?php // echo $form->field($model, 'sal_grd_code') ?>

    <?php // echo $form->field($model, 'joined_date') ?>

    <?php // echo $form->field($model, 'emp_oth_email') ?>

    <?php // echo $form->field($model, 'termination_id') ?>

    <?php // echo $form->field($model, 'faculdade_id') ?>

    <?php // echo $form->field($model, 'curso_id') ?>

    <?php // echo $form->field($model, 'ano_conclusao12') ?>

    <?php // echo $form->field($model, 'ano_conclusao') ?>

    <?php // echo $form->field($model, 'custom1') ?>

    <?php // echo $form->field($model, 'custom2') ?>

    <?php // echo $form->field($model, 'custom3') ?>

    <?php // echo $form->field($model, 'custom4') ?>

    <?php // echo $form->field($model, 'custom5') ?>

    <?php // echo $form->field($model, 'custom6') ?>

    <?php // echo $form->field($model, 'custom7') ?>

    <?php // echo $form->field($model, 'custom8') ?>

    <?php // echo $form->field($model, 'custom9') ?>

    <?php // echo $form->field($model, 'custom10') ?>

    <?php // echo $form->field($model, 'criado_por') ?>

    <?php // echo $form->field($model, 'actualizado_por') ?>

    <?php // echo $form->field($model, 'criado_em') ?>

    <?php // echo $form->field($model, 'actualizado_em') ?>

    <?php // echo $form->field($model, 'user_location') ?>

    <?php // echo $form->field($model, 'user_location2') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
