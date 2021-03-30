<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ComiteCargos */

$this->title = 'Actualizar Cargos do Partido: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Cargos do Partido', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="comite-cargos-update">

<div class="panel panel-success">

<div class="panel-heading"><b><?= Html::encode($this->title) ?></b></div>
   <div class="panel-body"> 


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
</div>
</div>
