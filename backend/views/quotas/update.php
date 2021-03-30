<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Quotas */

$this->title = $model->membro['emp_firstname'].' '.$model->membro['emp_middle_name'].' '. $model->membro['emp_lastname'];
$this->params['breadcrumbs'][] = ['label' => 'Quotas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->tipoQ['name'], 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="quotas-update">

    <div class="panel panel-success">

<div class="panel-heading"><b><?= Html::encode($this->title) ?></b></div>
<div class="panel-body">   
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
</div>

</div>
