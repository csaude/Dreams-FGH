<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ParceirosTipo */

$this->title = 'Update Parceiros Tipo: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Parceiros Tipos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="parceiros-tipo-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
