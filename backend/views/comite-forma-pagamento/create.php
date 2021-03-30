<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ComiteFormaPagamento */

$this->title = 'Nova Forma de Pagamento';
$this->params['breadcrumbs'][] = ['label' => 'Comite Forma Pagamentos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comite-forma-pagamento-create">

<div class="panel panel-success">

<div class="panel-heading"><b><?= Html::encode($this->title) ?></b></div>
   <div class="panel-body">   

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
</div>

</div>
