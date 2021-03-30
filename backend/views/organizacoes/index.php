<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OrganizacoesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Parceiros do Projecto DREAMS';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="organizacoes-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

  
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'id',
            'name',
            'abreviatura',
		   // 'distrito.district_name',
			          [
       'attribute'=> 'distrito_id',
    'format' => 'html',
       'label'=>'Distrito',
        'value' => function ($model) {
    return $model->distrito['district_name'];
  },
    ],
            'status',
            'description',
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
        <?= Html::a('<i class="fa fa-plus"></i> Nova Organização', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
</div>
