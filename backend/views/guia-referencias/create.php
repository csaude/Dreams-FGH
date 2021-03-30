<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\GuiaReferencias */

$this->title = Yii::t('app', 'Emitir Guia de Referência');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Guia Referencias'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="guia-referencias-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
