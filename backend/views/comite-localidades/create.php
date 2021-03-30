<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ComiteLocalidades */

$this->title = 'Novo Posto Administrativo';
$this->params['breadcrumbs'][] = ['label' => 'Postos Administrativos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="postos-administrativos-create">

<div class="panel panel-success">

<div class="panel-heading"><b><?= Html::encode($this->title) ?></b></div>
   <div class="panel-body"> 

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
</div>

</div>
