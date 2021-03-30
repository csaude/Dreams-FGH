<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Us */

$this->title = 'Actualização da Us: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Unidades Sanitárias', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="us-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
