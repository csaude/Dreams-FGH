<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ComiteCelulas */

$this->title = 'Novo Comité das Celulas';
$this->params['breadcrumbs'][] = ['label' => 'Comite Celulas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comite-celulas-create">

<div class="panel panel-success">

<div class="panel-heading"><b><?= Html::encode($this->title) ?></b></div>
   <div class="panel-body"> 

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
</div>

</div>
