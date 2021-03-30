<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ReferenciasDreams */

$this->title = Yii::t('app', 'Referir Beneficiario');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Referencias Dreams'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="referencias-dreams-create">


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
