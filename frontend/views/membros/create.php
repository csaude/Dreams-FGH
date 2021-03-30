<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Membros */

$this->title = 'Create Membros';
$this->params['breadcrumbs'][] = ['label' => 'Membros', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="membros-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
