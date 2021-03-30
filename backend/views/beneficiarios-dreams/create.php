<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\BeneficiariosDreams */

$this->title = Yii::t('app', 'Create Beneficiarios Dreams');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Beneficiarios Dreams'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="beneficiarios-dreams-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
