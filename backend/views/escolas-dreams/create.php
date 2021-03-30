<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\EscolasDreams */

$this->title = Yii::t('app', 'Escola Dreams');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Escolas Dreams'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="escolas-dreams-create">

    <div class="panel panel-success">
  <div class="panel-heading"> 
  <b><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> <?= Html::encode($this->title) ?></b>
  </div>
  <div class="panel-body">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
 </div>
</div>

</div>
