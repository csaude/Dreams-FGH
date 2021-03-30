<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Distritos */

$this->title = 'Update Distrito: ' . $model->district_code;
$this->params['breadcrumbs'][] = ['label' => 'Distritos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->district_code, 'url' => ['view', 'id' => $model->district_code]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="distritos-update">

<div class="panel panel-success">

<div class="panel-heading"><b><?= Html::encode($this->title) ?></b></div>
   <div class="panel-body"> 

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
</div>

</div>
