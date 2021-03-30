<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Membros;
use yii\helpers\ArrayHelper;
use app\models\TiposDeQuotas;
use app\models\ComiteLocalidades;
/* @var $this yii\web\View */
/* @var $searchModel app\models\QuotasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Lista geral das Quotas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="quotas-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

          //  'id',
           [
            'attribute'=>'member_id',
            'value'=>'membro.emp_lastname',
            'filter'=>ArrayHelper::map(Membros::find()->all(), 'id' , 'emp_lastname'),
            ],
           [
            'attribute'=>'member_id',
            'value'=>'membro.emp_firstname',
            'filter'=>ArrayHelper::map(Membros::find()->all(), 'id' , 'emp_firstname'),
            ],

             [
            'attribute'=>'quota_id',
            'value'=>'tipoQ.name',
            'filter'=>ArrayHelper::map(TiposDeQuotas::find()->all(), 'id' , 'name'),
            ],

            'data_pagamento',
                         [
            'attribute'=>'local_pagamento',
            'value'=>'localP.name',
            'filter'=>ArrayHelper::map(ComiteLocalidades::find()->all(), 'id' , 'name'),
            ],
            'quantia',

         //   'meio_pagamento',
        //    'local_pagamento',
            // 'receptor',
            // 'status',
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
   <p>
     <?= Html::a('<i class="glyphicon glyphicon-home"></i>', ['site/index'], ['class' => 'btn btn-danger']) ?>    
        <?= Html::a('<i class="fa fa-plus"></i> Nova Quota', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
</div>
