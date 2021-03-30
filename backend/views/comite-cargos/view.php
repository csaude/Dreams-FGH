<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ComiteCargos */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Comite Cargos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comite-cargos-view">

    <h1><?= Html::encode($this->title) ?></h1>



    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
          //  'id',   
            'name',
            'from_date',
            'to_date',
            'subordinado_id',
            'description',
            'status',            
         /*   'criado_por',
            'actualizado_por',
            'criado_em',
            'actualizado_em',
            'user_location',
            'user_location2',*/
        ],
    ]) ?>
   <p> <?= Html::a('<i class="glyphicon glyphicon-home"></i>', ['comite-cargos/index'], ['class' => 'btn btn-danger']) ?>  
        <?= Html::a('<i class="glyphicon glyphicon-pencil"></i> Actualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('<i class="glyphicon glyphicon-remove"></i> Remover', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
</div>
