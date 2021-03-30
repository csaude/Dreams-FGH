<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Organizacoes */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Organizacoes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="organizacoes-view">

    <h1><?= Html::encode($this->title) ?></h1>

  

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
        //    'id',
            'name',
            'tipoParceria.name',
            'abreviatura',
            'description',
                             [
             'attribute' => 'status',
             'format'=>'raw',
             'value' => $model->status == 1 ? 'Activo' : 'Inactivo',
        ],
            
          /*  'criado_por',
            'actualizado_por',
            'criado_em',
            'actualizado_em',
            'user_location',
            'user_location2',*/
        ],
    ]) ?>

    <div class="panel-footer clearfix">
        <div class="pull-right">
         <div class="form-group">

      
       <?= Html::a('<i class="glyphicon glyphicon-backward"></i>', ['index'], ['class' => 'btn btn-warning']) ?>  
        <?= Html::a('Actualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Apagar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'disabled'=>true,
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </div> 
        </div>
    </div>

</div>
