<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Utilizadores */

$this->title = Yii::t('app', 'Actualizar {modelClass}: ', [
    'modelClass' => 'Utilizador',
]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Utilizador'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="utilizadores-update">

  
<div class="row">
  <div class="col-lg-12">
<div class="panel panel-success">
  <div class="panel-heading"> 
  <b><span class="glyphicon glyphicon-check" aria-hidden="true"></span> <?= Html::encode($this->title) ?>
 <font style="text-transform: uppercase; color:#000"><?php echo $model->username.' ('.$model->email.')'; ?> </font>
  </b>
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
