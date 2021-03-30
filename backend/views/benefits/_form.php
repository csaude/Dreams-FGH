<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Benefs */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="benefs-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'emp_number')->textInput() ?>

    <?= $form->field($model, 'member_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'emp_lastname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'emp_firstname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'emp_middle_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'emp_nick_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ponto_entrada')->textInput() ?>

    <?= $form->field($model, 'parceiro_id')->textInput() ?>

    <?= $form->field($model, 'via')->textInput() ?>

    <?= $form->field($model, 'idade_anos')->textInput() ?>

    <?= $form->field($model, 'estudante')->textInput() ?>

    <?= $form->field($model, 'estudante_classe')->textInput() ?>

    <?= $form->field($model, 'estudante_escola')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'gravida')->textInput() ?>

    <?= $form->field($model, 'filhos')->textInput() ?>

    <?= $form->field($model, 'bairro_id')->textInput() ?>

    <?= $form->field($model, 'encarregado_educacao')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'deficiencia')->textInput() ?>

    <?= $form->field($model, 'deficiencia_tipo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'coun_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'provin_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'district_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'city_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'membro_localidade_id')->textInput() ?>

    <?= $form->field($model, 'us_id')->textInput() ?>

    <?= $form->field($model, 'membro_zona')->textInput() ?>

    <?= $form->field($model, 'membro_circulo')->textInput() ?>

    <?= $form->field($model, 'membro_celula')->textInput() ?>

    <?= $form->field($model, 'membro_data_admissao')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'membro_caratao_eleitor')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'membro_cargo_partido_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'emp_smoker')->textInput() ?>

    <?= $form->field($model, 'ethnic_race_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'emp_birthday')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nation_code')->textInput() ?>

    <?= $form->field($model, 'emp_gender')->textInput() ?>

    <?= $form->field($model, 'emp_marital_status')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'emp_ssn_num')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'emp_sin_num')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'emp_other_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'emp_dri_lice_num')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'emp_dri_lice_exp_date')->textInput() ?>

    <?= $form->field($model, 'emp_military_service')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'emp_status')->textInput() ?>

    <?= $form->field($model, 'job_title_code')->textInput() ?>

    <?= $form->field($model, 'eeo_cat_code')->textInput() ?>

    <?= $form->field($model, 'work_station')->textInput() ?>

    <?= $form->field($model, 'emp_street1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'emp_street2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'emp_zipcode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'emp_hm_telephone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'emp_mobile')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'emp_work_telephone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'emp_work_email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sal_grd_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'joined_date')->textInput() ?>

    <?= $form->field($model, 'emp_oth_email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'termination_id')->textInput() ?>

    <?= $form->field($model, 'bi')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nuit')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'passaporte')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dire')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bi_data_i')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bi_data_f')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'custom3')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'other_prof_info')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nuit_data_i')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nuit_data_f')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'custom7')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'custom8')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'custom9')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'custom10')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'criado_por')->textInput() ?>

    <?= $form->field($model, 'actualizado_por')->textInput() ?>

    <?= $form->field($model, 'criado_em')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'actualizado_em')->textInput() ?>

    <?= $form->field($model, 'user_location')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_location2')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
