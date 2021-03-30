<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\GuiaReferencias */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Guia Referencias',
]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Guia Referencias'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="guia-referencias-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
