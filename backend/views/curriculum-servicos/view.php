<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = 'Curriculum: ' . $model->curriculum->id . ' - Serviço: ' . $model->servico->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Curriculum Serviços'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="curriculum-servico-view">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'curriculum.name',
            'servico.name',
            'status',
            'description',
        ],
    ]) ?>

    <?= Html::a('<i class="glyphicon glyphicon-backward"></i>', ['index'], ['class' => 'btn btn-warning']) ?>

    <?= Html::a(Yii::t('app', 'Actualizar'), ['update', 'curriculum_id' => $model->curriculum->id, 'servico_id' => $model->servico->id], ['class' => 'btn btn-primary']) ?>
    <?= Html::a(Yii::t('app', 'Apagar'), ['delete', 'curriculum_id' => $model->curriculum->id, 'servico_id' => $model->servico->id], [
        'class' => 'btn btn-danger',
        'data' => [
            'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
            'method' => 'post',
        ],
    ]) ?>

</div>