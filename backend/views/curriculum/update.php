<?php

use yii\helpers\Html;


$this->title = Yii::t('app', 'Actualizar {modelClass}: ', [
    'modelClass' => 'Curriculum',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Curriculum'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="curriculum-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>