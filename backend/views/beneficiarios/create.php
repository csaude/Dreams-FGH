<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Beneficiarios */

$this->title = 'Cadastro de Novo Beneficiário';
$this->params['breadcrumbs'][] = ['label' => 'Beneficiarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="beneficiarios-create">
    <?php //consentimento
//  include_once("alertas.php"); 
?>
<div class="panel panel-primary">
  <div class="panel-heading"> 
  <b><span class="glyphicon glyphicon-check" aria-hidden="true"></span> <?= Html::encode($this->title) ?></b>
  </div>
  <div class="panel-body">

    

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>


  </div>
</div>



</div>
