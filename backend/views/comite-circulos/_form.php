<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use app\models\ComiteZonal;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $model app\models\ComiteCirculos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="comite-circulos-form">

    <?php $form = ActiveForm::begin(); ?>


    <label class="control-label" for="comite-circulos-c_zona_id">Comité Zonal</label>
<?php 
 if($model->isNewRecord)
 {   echo  Select2::widget([
    'name' => 'ComiteCirculos[c_zona_id]',
    'value' => 1, // value to initialize
    'data' => ArrayHelper::map(ComiteZonal::find()->all(), 'id', 'name'),
    'options' => ['multiple' => false,  'class' => 'form-group', 'placeholder' => 'Selecione o Comité da Zona ...'],
]);

} else {
?>

<?php
echo  Select2::widget([
    'name' => 'ComiteCirculos[c_zona_id]',
    'value' => $model->c_zona_id, // value to initialize
    'data' => ArrayHelper::map(ComiteZonal::find()->all(), 'id', 'name'),
    'options' => ['multiple' => false,   'placeholder' => 'Selecione o Comité da Zona ...'],
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
