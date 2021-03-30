<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\FaixaEtariaServico */

$this->title = Yii::t('app', 'Create Faixa Etaria Servico');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Faixa Etaria Servicos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="faixa-etaria-servico-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
