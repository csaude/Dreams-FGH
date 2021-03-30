<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ParceirosTipo */

$this->title = 'Novo Tipo de Parceria';
$this->params['breadcrumbs'][] = ['label' => 'Parceiros Tipos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="parceiros-tipo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
