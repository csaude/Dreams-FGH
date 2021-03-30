<?php

use yii\helpers\Html;
use yii\grid\GridView;

use yii\helpers\ArrayHelper;
use app\models\Provincias;
/* @var $this yii\web\View */
/* @var $searchModel app\models\DistritosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Distritos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="distritos-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

 
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'cod_distrito',
            'district_name',
              [
            'attribute'=>'province_code',
            'value'=>'provincia.province_name',
            'filter'=>ArrayHelper::map(Provincias::find()->asArray()->all(), 'id' , 'province_name'),
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

     <p>
     <?= Html::a('<i class="glyphicon glyphicon-home"></i>', ['site/index'], ['class' => 'btn btn-danger']) ?>    
        <?= Html::a('<i class="fa fa-plus"></i> Novo Distrito', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
</div>
