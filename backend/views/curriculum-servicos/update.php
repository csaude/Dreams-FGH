<?php

use yii\helpers\Html;

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Curriculum Serviço',
]) . $model->curriculum->id . ' - ' . $model->servico->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Curriculum Servicos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Curriculum Servicos'), 'url' => ['view', 'curriculum_id' => $model->curriculum->id, 'servico_id' => $model->servico->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="curriculum-servico-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
