<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Benefs */

$this->title = Yii::t('app', 'Create Benefs');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Benefs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="benefs-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
