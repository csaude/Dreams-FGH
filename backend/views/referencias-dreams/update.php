<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ReferenciasDreams */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Referencias Dreams',
]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Referencias Dreams'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="referencias-dreams-update">

    <div class="row">
      <div class="col-lg-12">
    <div class="panel panel-success">
      <div class="panel-heading"> <b>
        <span class="glyphicon glyphicon-check" aria-hidden="true"> </span> <?= Html::encode($this->title) ?></b>
      </div>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
  </div>
</div>
</div>





</div>
