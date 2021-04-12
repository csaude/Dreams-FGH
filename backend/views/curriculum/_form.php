<?php

use yii\helpers\Html;


use yii\helpers\ArrayHelper;
use kartik\form\ActiveForm;
?>

<div class="curriculum-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textArea(['maxlength' => true, 'rows' => '3']) ?>

    <?= $form->field($model, 'status')->radioButtonGroup([1 => ' Activo', '0' => ' Cancelado']); ?>

    <div class="form-group">
        <br/>
        <?= Html::a('<i class="glyphicon glyphicon-backward"></i>', ['index'], ['class' => 'btn btn-warning']) ?>
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Salvar') : Yii::t('app', 'Actualizar'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
