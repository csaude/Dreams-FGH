<?php


use yii\helpers\Html;
use yii\helpers\ArrayHelper;

use kartik\widgets\DepDrop;
use \kartik\widgets\Select2;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use kartik\widgets\DatePicker;
use kartik\form\ActiveForm;
use common\models\User;
use yii\jui\AutoComplete;
use app\models\TipoCargos;

/* @var $this yii\web\View */
/* @var $model app\models\TipoCargos */
/* @var $form yii\widgets\ActiveForm */
?>
 
<div class="tipo-cargos-form">

   
    <?php $form = ActiveForm::begin(); ?>
<div class="row">     <div class="col-lg-6">   
  <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>   

</div>

        <div class="col-lg-6">   
    <label class="control-label" for="comite-celulas-subordinado_id">Superior Hierárquico</label>
<?php 
 if($model->isNewRecord)
 {   echo  Select2::widget([
    'name' => 'TipoCargos[subordinado_id]',
    'value' => 1, // value to initialize
    'data' => ArrayHelper::map(TipoCargos::find()->all(), 'id', 'name'),
    'options' => ['multiple' => false,  'class' => 'form-group', 'placeholder' => 'Selecione o Superior Hierárquico...'],
]);

} else {
?>

<?php
echo  Select2::widget([
    'name' => 'TipoCargos[subordinado_id]',
    'value' => $model->subordinado_id, // value to initialize
    'data' => ArrayHelper::map(TipoCargos::find()->all(), 'id', 'name'),
    'options' => ['multiple' => false,   'placeholder' => 'Selecione o Comité do Círculo ...'],
]);


}?>



<div class="help-block"></div>
<?php
 DatePicker::widget([
    'name' => 'TipoCargos[from_date]',
    'value' => '01-Feb-1996',
    'type' => DatePicker::TYPE_RANGE,
    'name2' => 'TipoCargos[to_date]',
    'value2' => Date('d-M-Y'),
    'pluginOptions' => [
        'autoclose'=>true,
        'format' => 'dd-M-yyyy'
    ]
]);
?>


</div>
</div>


    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

   <?= $form->field($model, 'status')->radioButtonGroup([1 => 'Activo', 2 => 'Inactivo']); ?> 

       <div class="form-group">
      
         <?= Html::a('<i class="glyphicon glyphicon-backward"></i>', ['comite-cargos/index'], ['class' => 'btn btn-danger']) ?> 
        <?= Html::submitButton($model->isNewRecord ? 'Salvar' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'disabled'=>false]) ?>
    </div>


    <?php ActiveForm::end(); ?>

</div>
