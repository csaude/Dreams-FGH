<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ReferenciasServicosReferidos */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Referencias Servicos Referidos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="referencias-servicos-referidos-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'referencia.nota_referencia',
            'servico.name',
        //    'name',
            'status',
            'description',
        //    'criado_por',
          //  'actualizado_por',
            'criado_em',
            'actualizado_em',
          /*  'user_location',
            'user_location2',*/
        ],
    ]) ?>

    <p>
        <?= Html::a(Yii::t('app', 'Actualizar'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Apagar'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

</div>
