<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Utilizadores */

$this->title = Yii::t('app', 'Novo Utilizador');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Utilizador'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="utilizadores-create">

<div class="row">
  <div class="col-lg-12">
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
  </div>
</div>
