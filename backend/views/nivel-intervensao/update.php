<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\NivelIntervensao */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Nível de Intervenção',
]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Nível de Intervenção'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="nivel-intervensao-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
