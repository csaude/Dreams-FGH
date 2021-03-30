<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ServicosDream */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Servicos Dreams', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="servicos-dream-view">

    <h1><?= Html::encode($this->title) ?></h1>



    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
           // 'id',
            'tipoServico.name',
            'name',
            
            'description',

                                  [
             'attribute' => 'status',
             'format'=>'raw',
             'value' => $model->status == 1 ? 'Activo' : 'Inactivo',
        ],
           
            /*'criado_por',
            'actualizado_por',
            'criado_em',
            'actualizado_em',
            'user_location',
            'user_location2',*/
        ],
    ]) ?>
    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
</div>
