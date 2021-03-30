<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use yii\helpers\ArrayHelper;
use app\models\Distritos;
use app\models\ComiteProvincial;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $model app\models\ComiteCidades */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="comite-cidades-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php $form->field($model, 'provincia_id')->textInput() ?>

    <label class="control-label" for="comitecidades-provincia_id">Comité Provincial</label>
<?php 
 if($model->isNewRecord)
 {   echo  Select2::widget([
    'name' => 'ComiteCidades[provincia_id]',
    'value' => 1, // value to initialize
    'data' => ArrayHelper::map(ComiteProvincial::find()->all(), 'id', 'name'),
    'options' => ['multiple' => false,   'placeholder' => 'Selecione o Comité Provincial ...'],
]);

} else {
?>

<?php
echo  Select2::widget([
    'name' => 'ComiteCidades[provincia_id]',
    'value' => $model->provincia_id, // value to initialize
    'data' => ArrayHelper::map(ComiteProvincial::find()->all(), 'id', 'name'),
    'options' => ['multiple' => false,   'placeholder' => 'Selecione o Comité Provincial ...'],
]);


}?>
<div class="help-block"></div>
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

  
    <div class="form-group">
    <?= Html::a('<i class="glyphicon glyphicon-home"></i>', ['comite-cidades/index'], ['class' => 'btn btn-danger']) ?> 
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>


    <?php ActiveForm::end(); ?>

</div>
