<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Membros */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Membros', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="membros-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'emp_number',
            'employee_id',
            'emp_lastname',
            'emp_firstname',
            'emp_middle_name',
            'emp_nick_name',
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
            'city_code',
            'coun_code',
            'provin_code',
            'emp_zipcode',
            'emp_hm_telephone',
            'emp_mobile',
            'emp_work_telephone',
            'emp_work_email:email',
            'sal_grd_code',
            'joined_date',
            'emp_oth_email:email',
            'termination_id',
            'faculdade_id',
            'curso_id',
            'ano_conclusao12',
            'ano_conclusao',
            'custom1',
            'custom2',
            'custom3',
            'custom4',
            'custom5',
            'custom6',
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
