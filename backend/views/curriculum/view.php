<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Curriculum'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="curriculum-view">
    <h1><?= Html::encode($this->title) ?></h1><br />


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'description',
            [
                'attribute' => 'status',
                'format' => 'raw',
                'value' => $model->status == 1 ? 'Activo' : 'Inactivo',
            ],
        ],
    ]) ?>

    
    <div class="panel-footer clearfix">
    <br />
        <div class="pull-left">
            <div class="form-group">


                <?= Html::a('<i class="glyphicon glyphicon-backward"></i>', ['index'], ['class' => 'btn btn-warning']) ?>
                <?= Html::a('Actualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Apagar', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'disabled' => true,
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]) ?>
            </div>
        </div>
    </div>

</div>