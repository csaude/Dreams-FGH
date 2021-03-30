<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Us */

$this->title = 'Criar Unidade Sanitária';
$this->params['breadcrumbs'][] = ['label' => 'Unidades Sanitárias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="us-create">

<div class="panel panel-success">
  <div class="panel-heading"> 
  <b><span class="fa fa-hospital-o" aria-hidden="true"></span> <?= Html::encode($this->title) ?></b>
  </div>
  <div class="panel-body">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
</div>




</div>
