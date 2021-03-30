<?php

use yii\helpers\Html;


use yii\helpers\ArrayHelper;
use kartik\form\ActiveForm;

use app\models\NivelIntervensao;

/* @var $this yii\web\View */
/* @var $model app\models\FaixaEtaria */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="faixa-etaria-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'faixa_etaria')->textInput(['maxlength' => true]) ?>


  <?=  Html::activeDropDownList($model, 'nivel_intervencao_id', ArrayHelper::map(NivelIntervensao::find()
         ->where(['=','status',1])
         ->all(), 'id', 'name'),
         ['class' => 'form-control','readOnly'=> false]); ?>


    <?= $form->field($model, 'description')->textArea(['maxlength' => true, 'rows' => '3']) ?>

    <?= $form->field($model, 'status')->radioButtonGroup([1 => ' Activo', '0' => ' Cancelado']); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
