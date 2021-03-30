<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MembrosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Membros';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="membros-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Membros', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'emp_number',
            'employee_id',
            'emp_lastname',
            'emp_firstname',
            // 'emp_middle_name',
            // 'emp_nick_name',
            // 'emp_smoker',
            // 'ethnic_race_code',
            // 'emp_birthday',
            // 'nation_code',
            // 'emp_gender',
            // 'emp_marital_status',
            // 'emp_ssn_num',
            // 'emp_sin_num',
            // 'emp_other_id',
            // 'emp_dri_lice_num',
            // 'emp_dri_lice_exp_date',
            // 'emp_military_service',
            // 'emp_status',
            // 'job_title_code',
            // 'eeo_cat_code',
            // 'work_station',
            // 'emp_street1',
            // 'emp_street2',
            // 'city_code',
            // 'coun_code',
            // 'provin_code',
            // 'emp_zipcode',
            // 'emp_hm_telephone',
            // 'emp_mobile',
            // 'emp_work_telephone',
            // 'emp_work_email:email',
            // 'sal_grd_code',
            // 'joined_date',
            // 'emp_oth_email:email',
            // 'termination_id',
            // 'faculdade_id',
            // 'curso_id',
            // 'ano_conclusao12',
            // 'ano_conclusao',
            // 'custom1',
            // 'custom2',
            // 'custom3',
            // 'custom4',
            // 'custom5',
            // 'custom6',
            // 'custom7',
            // 'custom8',
            // 'custom9',
            // 'custom10',
            // 'criado_por',
            // 'actualizado_por',
            // 'criado_em',
            // 'actualizado_em',
            // 'user_location',
            // 'user_location2',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
