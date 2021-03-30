<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Beneficiarios */


if (isset(Yii::$app->user->identity->role)&&Yii::$app->user->identity->role==20) {
$this->title = 'Beneficiário: ' .$model->emp_firstname." ".$model->emp_middle_name." ".$model->emp_lastname; } 
else {

  $this->title = 'Beneficiário: ' . $model->distrito['cod_distrito'].'/'.$model->member_id;
}
$this->params['breadcrumbs'][] = ['label' => 'Beneficiarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="beneficiarios-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
