<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TipoUs */

$this->title = 'Update Tipo Us: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Tipo uses', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tipo-us-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
