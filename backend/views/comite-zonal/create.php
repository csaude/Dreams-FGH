<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ComiteZonal */

$this->title = 'Novo Comité Zonal';
$this->params['breadcrumbs'][] = ['label' => 'Comite Zonals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comite-zonal-create">

<div class="panel panel-success">

<div class="panel-heading"><b><?= Html::encode($this->title) ?></b></div>
   <div class="panel-body"> 

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
</div>

</div>
