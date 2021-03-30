<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ComiteCidades */

$this->title = 'Novo Comité de Cidade';
$this->params['breadcrumbs'][] = ['label' => 'Comite Cidades', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comite-cidades-create">

<div class="panel panel-success">

<div class="panel-heading"><b><?= Html::encode($this->title) ?></b></div>
   <div class="panel-body"> 

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
</div>

</div>
