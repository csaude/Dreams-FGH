<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;



use app\models\ComiteCirculos;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $model app\models\ComiteCelulas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="comite-celulas-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php $form->field($model, 'c_circulo_id')->textInput() ?>

    <label class="control-label" for="comite-celulas-c_circulo_id">Comité do Círculo</label>
<?php 
 if($model->isNewRecord)
 {   echo  Select2::widget([
    'name' => 'ComiteCelulas[c_circulo_id]',
    'value' => 1, // value to initialize
    'data' => ArrayHelper::map(ComiteCirculos::find()->all(), 'id', 'name'),
    'options' => ['multiple' => false,  'class' => 'form-group', 'placeholder' => 'Selecione o Comité do Círculo ...'],
]);

} else {
?>

<?php
echo  Select2::widget([
    'name' => 'ComiteCelulas[c_circulo_id]',
    'value' => $model->c_circulo_id, // value to initialize
    'data' => ArrayHelper::map(ComiteCirculos::find()->all(), 'id', 'name'),
    'options' => ['multiple' => false,   'placeholder' => 'Selecione o Comité do Círculo ...'],
]);


}?>

<div class="help-block"></div>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>



     <div class="form-group">
        <?= Html::a('<i class="glyphicon glyphicon-home"></i>', ['comite-circulos/index'], ['class' => 'btn btn-danger']) ?> 
        <?= Html::submitButton($model->isNewRecord ? 'Salvar' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'disabled'=>false]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
