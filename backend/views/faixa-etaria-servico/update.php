<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\FaixaEtariaServico */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Faixa Etaria Servico',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Faixa Etaria Servicos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="faixa-etaria-servico-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
