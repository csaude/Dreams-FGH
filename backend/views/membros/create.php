<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Membros */

$this->title = 'Novo Beneficiário';
$this->params['breadcrumbs'][] = ['label' => 'Beneficiários', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="membros-create">
<div class="panel panel-success">

<div class="panel-heading"><b><i class="ion ion-person-add"></i> <?= Html::encode($this->title) ?> DREAMS</b></div>
   <div class="panel-body">   

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
</div>
</div>
