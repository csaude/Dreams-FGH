<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ComiteCirculos */

$this->title = 'Novo Comité dos Circulos';
$this->params['breadcrumbs'][] = ['label' => 'Comite Circulos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comite-circulos-create">

<div class="panel panel-success">

<div class="panel-heading"><b><?= Html::encode($this->title) ?></b></div>
   <div class="panel-body"> 

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
</div>

</div>
