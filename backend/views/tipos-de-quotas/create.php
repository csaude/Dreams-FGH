<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TiposDeQuotas */

$this->title = 'Novo Tipo de Quotas';
$this->params['breadcrumbs'][] = ['label' => 'Tipos De Quotas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipos-de-quotas-create">

<div class="panel panel-success">

<div class="panel-heading"><b><?= Html::encode($this->title) ?></b></div>
   <div class="panel-body">   

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
</div>

</div>
