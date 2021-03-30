<?php

//utehn phnu
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PersonSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'People';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="person-index">


    <?php //echo $this->render('_search', ['model' => $searchModel]);     ?>

    <?php
    $columns = [
        ['class' => 'yii\grid\SerialColumn'],
        //'id',
        'emp_number',
        [
            'attribute' => 'emp_firstname',
            'format' => 'raw',
            'value' => function($data) {
                return Html::a(Html::encode($data->emp_firstname), array('view', 'emp_number' => $data->emp_number));
            }
                ],
                [
                    'attribute' => 'emp_lastname',
                    'value' => function ($data) {
                        return md5($data->emp_lastname);
                    },
                ]
                ,
                'emp_gender',
                ['class' => '\kartik\grid\ActionColumn'],
            ];
            echo \kartik\grid\GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => $columns,
                'pjax' => true,
                'pjaxSettings' => [
                    //'neverTimeout' => true,
                    'options' => [
                        'enablePushState' => false,
                    ],
                ],
                'responsive' => true,
                'hover' => true,
                'panel' => [
                    'before' => '',
                //'after'=>''
                ],
                'toolbar' => [
                    ['content' =>
                    
                        Html::a('<i class="glyphicon glyphicon-plus"></i>', ['create'], ['class' => 'btn btn-flat btn-success'])
                    ],
                    '{export}',
                ],
                'exportConfig' => [
                    \kartik\grid\GridView::EXCEL => ['label' => 'Excel'],
                    \kartik\grid\GridView::CSV => ['label' => 'CSV'],
                    \kartik\grid\GridView::PDF => ['label' => 'PDF'],
                ],
            ]);
            ?>

</div>
