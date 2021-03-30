<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ComiteCelulas */

$this->title = 'Actualizar Comité  da Celula: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Comite Celulas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="comite-celulas-update">

<div class="panel panel-success">

<div class="panel-heading"><b><?= Html::encode($this->title) ?></b></div>
   <div class="panel-body"> 

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
</div>

</div>
