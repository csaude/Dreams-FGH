<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\form\ActiveForm;
/* @var $this yii\web\View */
/* @var $model app\models\ParceirosTipo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="parceiros-tipo-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>



    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'status')->radioButtonGroup([1 => ' Activo', 0 => ' Inactivo']); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
