<?php

use yii\helpers\Html;

use kartik\form\ActiveForm;
/* @var $this yii\web\View */
/* @var $model app\models\TiposDeQuotas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tipos-de-quotas-form">

    <?php $form = ActiveForm::begin(); ?>

<div class="row">

    <div class="col-lg-4">   
<?= $form->field($model, 'name')->textInput(['maxlength' => true, 'placeholder'=>'Tipo de Quota'])->label(false); ?>
</div>
<div class="col-lg-4">   <?= $form->field($model, 'description')->textInput(['maxlength' => true, 'placeholder'=>'Descrição'])->label(false); ?></div>
    <div class="col-lg-4">   
<?= $form->field($model, 'status')->radioButtonGroup([1 => ' Activo', 0 => ' Inactivo'])->label(false); ?> 
</div>


</div>  <div class="form-group">
 <?= Html::a('<i class="glyphicon glyphicon-backward"></i>', ['index'], ['class' => 'btn btn-warning']) ?>  
        <?= Html::submitButton($model->isNewRecord ? 'Salvar' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

  
    <?php ActiveForm::end(); ?>

</div>
