<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Membros */

$this->title = 'Actualizar Beneficiário: ' . ' ' . $model->emp_firstname." ".$model->emp_middle_name." ".$model->emp_lastname;
$this->params['breadcrumbs'][] = ['label' => 'Membros', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->emp_firstname." ".$model->emp_middle_name." ".$model->emp_lastname, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="membros-update">

    <div class="panel panel-success">

<div class="panel-heading"><b><?= Html::encode($this->title) ?></b></div>
<div class="panel-body">   
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
</div>
</div>
