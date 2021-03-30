<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ServicosDream */

$this->title = 'Create Servicos Dream';
$this->params['breadcrumbs'][] = ['label' => 'Servicos Dreams', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="servicos-dream-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
