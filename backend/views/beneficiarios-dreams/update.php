<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\BeneficiariosDreams */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Beneficiarios Dreams',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Beneficiarios Dreams'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="beneficiarios-dreams-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
