<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ComiteDistrital */

$this->title = 'Novo  Comité Distrital';
$this->params['breadcrumbs'][] = ['label' => 'Comite Distritals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comite-distrital-create">

<div class="panel panel-success">

<div class="panel-heading"><b><?= Html::encode($this->title) ?></b></div>
   <div class="panel-body"> 

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
</div>

</div>
