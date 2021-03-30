<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Organizacoes */

$this->title = 'Novo Parceiro DREAMS';
$this->params['breadcrumbs'][] = ['label' => 'Parceiros', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="organizacoes-create">

<div class="panel panel-success">

<div class="panel-heading"><b><?= Html::encode($this->title) ?></b></div>
   <div class="panel-body">   

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
</div>

</div>
