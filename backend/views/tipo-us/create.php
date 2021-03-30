<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TipoUs */

$this->title = 'Create Tipo Us';
$this->params['breadcrumbs'][] = ['label' => 'Tipo uses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipo-us-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
