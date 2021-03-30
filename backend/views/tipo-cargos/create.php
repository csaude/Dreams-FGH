<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TipoCargos */

$this->title = 'Novo Cargo';
$this->params['breadcrumbs'][] = ['label' => 'Tipo Cargos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipo-cargos-create">

<div class="panel panel-success">

<div class="panel-heading"><b><?= Html::encode($this->title) ?></b></div>
   <div class="panel-body">   

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
</div>

</div>
