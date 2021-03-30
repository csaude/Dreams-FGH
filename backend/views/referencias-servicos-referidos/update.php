<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ReferenciasServicosReferidos */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Referencias Servicos Referidos',
]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Referencias Servicos Referidos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="referencias-servicos-referidos-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
