<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Bairros */

$this->title = Yii::t('app', 'Adicionar Bairro');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Bairros'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bairros-create">

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
