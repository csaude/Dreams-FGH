<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ComiteCirculos */

$this->title = 'Actualizar Comité do Circulo: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Comite Circulos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="comite-circulos-update">

<div class="panel panel-success">

<div class="panel-heading"><b><?= Html::encode($this->title) ?></b></div>
   <div class="panel-body"> 

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
</div>

</div>
