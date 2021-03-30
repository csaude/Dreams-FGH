<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ReferenciasServicosReferidos */

$this->title = Yii::t('app', 'Create Referencias Servicos Referidos');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Referencias Servicos Referidos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="referencias-servicos-referidos-create">

    <h1><?php Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
