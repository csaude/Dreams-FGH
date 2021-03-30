<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ComiteFormaPagamento */

$this->title = 'Actualizar Forma Pagamento: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Comite Forma Pagamentos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="comite-forma-pagamento-update">

<div class="panel panel-success">

<div class="panel-heading"><b><?= Html::encode($this->title) ?></b></div>
   <div class="panel-body">   

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
</div>

</div>
