<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TipoServicos */

$this->title = 'Criar Tipo de Serviço';
$this->params['breadcrumbs'][] = ['label' => 'Tipo Servicos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipo-servicos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
