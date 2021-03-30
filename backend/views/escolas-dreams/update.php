<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\EscolasDreams */

$this->title = Yii::t('app', 'Actualizar {modelClass}: ', [
    'modelClass' => 'Escola Dreams',
]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Escolas Dreams'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="escolas-dreams-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="panel panel-success">
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
