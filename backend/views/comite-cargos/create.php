<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ComiteCargos */

$this->title = 'Novo Cargo do Partido';
$this->params['breadcrumbs'][] = ['label' => 'Cargos do Partido', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comite-cargos-create">

<div class="panel panel-success">

<div class="panel-heading"><b><?= Html::encode($this->title) ?></b></div>
   <div class="panel-body"> 


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
</div>
</div>
