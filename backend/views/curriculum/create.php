<?php

use yii\helpers\Html;

$this->title = Yii::t('app', 'Registar Curriculum');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Curriculum'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="curriculum-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>