<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ServicosBeneficiados */

$this->title = 'Serviço ao Beneficiario';
$this->params['breadcrumbs'][] = ['label' => 'Serviços Beneficiados', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="servicos-beneficiados-create">
	
	
	
     <div class="panel panel-success">
  <div class="panel-heading"><i class="ion ion-medkit"></i> <?= Html::encode($this->title) ?></div>
  <div class="panel-body"> 

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
		 </div>
		  </div>
		 
</div>
