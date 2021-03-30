<?php

use yii\helpers\Html;
use yii\grid\GridView;

use yii\helpers\ArrayHelper;
use app\models\Distritos;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ComiteDistritalSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Comités Distritais';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comite-distrital-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

  
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'id',
            'cProvincial.name',
              [
            'attribute'=>'distrito_id',
            'value'=>'distrito.district_name',
            'filter'=>ArrayHelper::map(Distritos::find()->asArray()->all(), 'district_code' , 'district_name'),
            ],
           // 'distrito_id',
            'name',
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
        <?= Html::a('<i class="fa fa-plus"></i> Novo Comite Distrital', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

</div>
