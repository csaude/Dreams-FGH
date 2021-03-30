<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ServicosBeneficiados */

$this->title = 'Actualizar Serviço ao: ' . $model->beneficiario_id;
$this->params['breadcrumbs'][] = ['label' => 'Servicos Beneficiados', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->beneficiario_id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="servicos-beneficiados-update">

    <div class="panel panel-success">
  <div class="panel-heading"><i class="ion ion-medkit"></i> <?= Html::encode($this->title) ?></div>
  <div class="panel-body"> 

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
		 </div>
		  </div>

</div>
