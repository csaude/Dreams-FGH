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
use app\models\ComiteCargos;
use app\models\TipoCargos;
use app\models\Membros;
/* @var $this yii\web\View */
/* @var $model app\models\ComiteCargos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="comite-cargos-form">

    <?php $form = ActiveForm::begin(); ?>
<div class="row">     <div class="col-lg-6">

<label class="control-label" for="comitecargos-subordinado_id">Membro</label>
<?php
echo  Select2::widget([
    'name' => 'ComiteCargos[subordinado_id]',
    'value' => $model->subordinado_id, // value to initialize
    'data' => ArrayHelper::map(Membros::find()->all(), 'id', 'emp_lastname', 'emp_firstname'),
    'options' => ['multiple' => false,   'placeholder' => 'Selecione o Cargo...'],
]);

?>
 

<div class="help-block"></div>
</div> 





        <div class="col-lg-6">   
<label class="control-label" for="comitecargos-name">Cargo</label>
<?php 
 if($model->isNewRecord)
 {   echo  Select2::widget([
    'name' => 'ComiteCargos[name]',
    'value' => 1, // value to initialize
    'data' => ArrayHelper::map(TipoCargos::find()->all(), 'id', 'name'),
    'options' => ['multiple' => false,  'class' => 'form-group', 'placeholder' => 'Selecione o Cargo...'],
]);

} else {
?>

<?php
echo  Select2::widget([
    'name' => 'ComiteCargos[name]',
    'value' => $model->name, // value to initialize
    'data' => ArrayHelper::map(TipoCargos::find()->all(), 'id', 'name'),
    'options' => ['multiple' => false,   'placeholder' => 'Selecione o Cargo...'],
]);

}?>

<div class="help-block"></div>


</div>
</div>

<div class="row">     
<div class="col-lg-6"> 
<label class="control-label" for="comitecargos-name">Período</label>
<?php
echo DatePicker::widget([
    'name' => 'ComiteCargos[from_date]',
    'value' => '01-Feb-1996',
    'type' => DatePicker::TYPE_RANGE,
    'name2' => 'ComiteCargos[to_date]',
    'value2' => Date('d-M-Y'),
    'pluginOptions' => [
        'autoclose'=>true,
        'format' => 'dd-M-yyyy'
    ]
]);
?>
</div> 
<div class="col-lg-6"> <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?></div> 
</div>


    

   <?= $form->field($model, 'status')->radioButtonGroup([1 => 'Activo', 2 => 'Inactivo']); ?> 

       <div class="form-group">
      
         <?= Html::a('<i class="glyphicon glyphicon-backward"></i>', ['comite-cargos/index'], ['class' => 'btn btn-danger']) ?> 
        <?= Html::submitButton($model->isNewRecord ? 'Salvar' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'disabled'=>false]) ?>
    </div>


    <?php ActiveForm::end(); ?>

</div>
