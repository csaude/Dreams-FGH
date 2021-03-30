<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Membros */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="membros-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'emp_number')->textInput() ?>

    <?= $form->field($model, 'employee_id')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'emp_lastname')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'emp_firstname')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'emp_middle_name')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'emp_nick_name')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'emp_smoker')->textInput() ?>

    <?= $form->field($model, 'ethnic_race_code')->textInput(['maxlength' => 13]) ?>

    <?= $form->field($model, 'emp_birthday')->textInput() ?>

    <?= $form->field($model, 'nation_code')->textInput() ?>

    <?= $form->field($model, 'emp_gender')->textInput() ?>

    <?= $form->field($model, 'emp_marital_status')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'emp_ssn_num')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'emp_sin_num')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'emp_other_id')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'emp_dri_lice_num')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'emp_dri_lice_exp_date')->textInput() ?>

    <?= $form->field($model, 'emp_military_service')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'emp_status')->textInput() ?>

    <?= $form->field($model, 'job_title_code')->textInput() ?>

    <?= $form->field($model, 'eeo_cat_code')->textInput() ?>

    <?= $form->field($model, 'work_station')->textInput() ?>

    <?= $form->field($model, 'emp_street1')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'emp_street2')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'city_code')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'coun_code')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'provin_code')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'emp_zipcode')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'emp_hm_telephone')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'emp_mobile')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'emp_work_telephone')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'emp_work_email')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'sal_grd_code')->textInput(['maxlength' => 13]) ?>

    <?= $form->field($model, 'joined_date')->textInput() ?>

    <?= $form->field($model, 'emp_oth_email')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'termination_id')->textInput() ?>

    <?= $form->field($model, 'faculdade_id')->textInput() ?>

    <?= $form->field($model, 'curso_id')->textInput() ?>

    <?= $form->field($model, 'ano_conclusao12')->textInput(['maxlength' => 15]) ?>

    <?= $form->field($model, 'ano_conclusao')->textInput(['maxlength' => 15]) ?>

    <?= $form->field($model, 'custom1')->textInput(['maxlength' => 250]) ?>

    <?= $form->field($model, 'custom2')->textInput(['maxlength' => 250]) ?>

    <?= $form->field($model, 'custom3')->textInput(['maxlength' => 250]) ?>

    <?= $form->field($model, 'custom4')->textInput(['maxlength' => 250]) ?>

    <?= $form->field($model, 'custom5')->textInput(['maxlength' => 250]) ?>

    <?= $form->field($model, 'custom6')->textInput(['maxlength' => 250]) ?>

    <?= $form->field($model, 'custom7')->textInput(['maxlength' => 250]) ?>

    <?= $form->field($model, 'custom8')->textInput(['maxlength' => 250]) ?>

    <?= $form->field($model, 'custom9')->textInput(['maxlength' => 250]) ?>

    <?= $form->field($model, 'custom10')->textInput(['maxlength' => 250]) ?>

    <?= $form->field($model, 'criado_por')->textInput() ?>

    <?= $form->field($model, 'actualizado_por')->textInput() ?>

    <?= $form->field($model, 'criado_em')->textInput() ?>

    <?= $form->field($model, 'actualizado_em')->textInput() ?>

    <?= $form->field($model, 'user_location')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'user_location2')->textInput(['maxlength' => 200]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
