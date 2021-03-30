<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Organizacoes */

$this->title = 'Actualizar Organização: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Organizacoes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="organizacoes-update">

    <div class="panel panel-success">

<div class="panel-heading"><b><?= Html::encode($this->title) ?></b></div>
<div class="panel-body">   
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
</div>

</div>
