<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\SubServicosDreams */

$this->title = Yii::t('app', 'Sub Serviços Dreams');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sub Serviços Dreams'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sub-servicos-dreams-create">

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
