<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ServicosDream */

$this->title = 'Update do Serviço DREAMS: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Servicos Dreams', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="servicos-dream-update">

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
