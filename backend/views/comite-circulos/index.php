<?php

use yii\helpers\Html;
use yii\grid\GridView;

use yii\helpers\ArrayHelper;
use app\models\ComiteZonal;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ComiteCirculosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Comités dos Círculos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comite-circulos-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

          //  'id',
                            [
            'attribute'=>'c_zona_id',
            'value'=>'cZonal.name',
            'filter'=>ArrayHelper::map(ComiteZonal::find()->asArray()->all(), 'id' , 'name'),
            ],
            'name',
            'description',
         //   'criado_por',
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
        <?= Html::a('<i class="fa fa-plus"></i> Novo Comité dos Círculos', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
</div>
