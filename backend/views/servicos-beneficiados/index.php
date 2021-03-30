<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ServicosBeneficiadosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Serviços Beneficiados';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="servicos-beneficiados-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Servicos Beneficiados', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'id',
            'servico_id',
            'beneficiario_id',
            'us_id',
            'activista_id',
             'data_beneficio',
             'status',
            // 'description',
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
