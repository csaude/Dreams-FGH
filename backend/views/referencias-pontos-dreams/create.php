<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ReferenciasPontosDreams */

$this->title = Yii::t('app', 'Referir Para');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Referencias Pontos Dreams'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="referencias-pontos-dreams-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
