<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\NivelIntervensao */

$this->title = Yii::t('app', 'Nivel de Intervenção');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Niveis de Intervenção'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nivel-intervensao-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
