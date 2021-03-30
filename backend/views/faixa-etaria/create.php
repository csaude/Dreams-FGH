<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\FaixaEtaria */

$this->title = Yii::t('app', 'Create Faixa Etaria');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Faixa Etarias'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="faixa-etaria-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
