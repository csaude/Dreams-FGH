<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Benefs */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Benefs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="benefs-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'emp_number',
            'member_id',
            'emp_lastname',
            'emp_firstname',
            'emp_middle_name',
            'emp_nick_name',
            'ponto_entrada',
            'parceiro_id',
            'via',
            'idade_anos',
            'estudante',
            'estudante_classe',
            'estudante_escola',
            'gravida',
            'filhos',
            'bairro_id',
            'encarregado_educacao',
            'deficiencia',
            'deficiencia_tipo',
            'coun_code',
            'provin_code',
            'district_code',
            'city_code',
            'membro_localidade_id',
            'us_id',
            'membro_zona',
            'membro_circulo',
            'membro_celula',
            'membro_data_admissao',
            'membro_caratao_eleitor',
            'membro_cargo_partido_id',
            'emp_smoker',
            'ethnic_race_code',
            'emp_birthday',
            'nation_code',
            'emp_gender',
            'emp_marital_status',
            'emp_ssn_num',
            'emp_sin_num',
            'emp_other_id',
            'emp_dri_lice_num',
            'emp_dri_lice_exp_date',
            'emp_military_service',
            'emp_status',
            'job_title_code',
            'eeo_cat_code',
            'work_station',
            'emp_street1',
            'emp_street2',
            'emp_zipcode',
            'emp_hm_telephone',
            'emp_mobile',
            'emp_work_telephone',
            'emp_work_email:email',
            'sal_grd_code',
            'joined_date',
            'emp_oth_email:email',
            'termination_id',
            'bi',
            'nuit',
            'passaporte',
            'dire',
            'bi_data_i',
            'bi_data_f',
            'custom3',
            'other_prof_info',
            'nuit_data_i',
            'nuit_data_f',
            'custom7',
            'custom8',
            'custom9',
            'custom10',
            'criado_por',
            'actualizado_por',
            'criado_em',
            'actualizado_em',
            'user_location',
            'user_location2',
        ],
    ]) ?>

</div>
