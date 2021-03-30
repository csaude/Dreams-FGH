<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\BenefsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="benefs-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'emp_number') ?>

    <?= $form->field($model, 'member_id') ?>

    <?= $form->field($model, 'emp_lastname') ?>

    <?= $form->field($model, 'emp_firstname') ?>

    <?php // echo $form->field($model, 'emp_middle_name') ?>

    <?php // echo $form->field($model, 'emp_nick_name') ?>

    <?php // echo $form->field($model, 'ponto_entrada') ?>

    <?php // echo $form->field($model, 'parceiro_id') ?>

    <?php // echo $form->field($model, 'via') ?>

    <?php // echo $form->field($model, 'idade_anos') ?>

    <?php // echo $form->field($model, 'estudante') ?>

    <?php // echo $form->field($model, 'estudante_classe') ?>

    <?php // echo $form->field($model, 'estudante_escola') ?>

    <?php // echo $form->field($model, 'gravida') ?>

    <?php // echo $form->field($model, 'filhos') ?>

    <?php // echo $form->field($model, 'bairro_id') ?>

    <?php // echo $form->field($model, 'encarregado_educacao') ?>

    <?php // echo $form->field($model, 'deficiencia') ?>

    <?php // echo $form->field($model, 'deficiencia_tipo') ?>

    <?php // echo $form->field($model, 'coun_code') ?>

    <?php // echo $form->field($model, 'provin_code') ?>

    <?php // echo $form->field($model, 'district_code') ?>

    <?php // echo $form->field($model, 'city_code') ?>

    <?php // echo $form->field($model, 'membro_localidade_id') ?>

    <?php // echo $form->field($model, 'us_id') ?>

    <?php // echo $form->field($model, 'membro_zona') ?>

    <?php // echo $form->field($model, 'membro_circulo') ?>

    <?php // echo $form->field($model, 'membro_celula') ?>

    <?php // echo $form->field($model, 'membro_data_admissao') ?>

    <?php // echo $form->field($model, 'membro_caratao_eleitor') ?>

    <?php // echo $form->field($model, 'membro_cargo_partido_id') ?>

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

    <?php // echo $form->field($model, 'emp_zipcode') ?>

    <?php // echo $form->field($model, 'emp_hm_telephone') ?>

    <?php // echo $form->field($model, 'emp_mobile') ?>

    <?php // echo $form->field($model, 'emp_work_telephone') ?>

    <?php // echo $form->field($model, 'emp_work_email') ?>

    <?php // echo $form->field($model, 'sal_grd_code') ?>

    <?php // echo $form->field($model, 'joined_date') ?>

    <?php // echo $form->field($model, 'emp_oth_email') ?>

    <?php // echo $form->field($model, 'termination_id') ?>

    <?php // echo $form->field($model, 'bi') ?>

    <?php // echo $form->field($model, 'nuit') ?>

    <?php // echo $form->field($model, 'passaporte') ?>

    <?php // echo $form->field($model, 'dire') ?>

    <?php // echo $form->field($model, 'bi_data_i') ?>

    <?php // echo $form->field($model, 'bi_data_f') ?>

    <?php // echo $form->field($model, 'custom3') ?>

    <?php // echo $form->field($model, 'other_prof_info') ?>

    <?php // echo $form->field($model, 'nuit_data_i') ?>

    <?php // echo $form->field($model, 'nuit_data_f') ?>

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
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
