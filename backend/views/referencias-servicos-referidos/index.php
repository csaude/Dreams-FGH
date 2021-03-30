<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ReferenciasServicosReferidosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Referencias Servicos Referidos');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="referencias-servicos-referidos-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Referencias Servicos Referidos'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

        //    'id',
            'referencia.nota_referencia',
            'servico.name',
          //  'name',
          ['attribute'=> 'status',
                 'format' => 'html',
              //   'label'=>'Estado',
                  'value' => function ($model) {
                 return  $model->status==1 ?  '<font color="green"><b>Activo</b></font>': '<font color="red">Inactivo</font>';
                 },
                 ],
            // 'description',
             'criado_por',
            // 'actualizado_por',
             'criado_em',
             'actualizado_em',
            // 'user_location',
            // 'user_location2',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
