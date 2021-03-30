<?php

use yii\helpers\Html;



use kartik\widgets\DepDrop;
use \kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use app\models\Provincias;
use app\models\Distritos;
use app\models\ComiteLocalidades;
use app\models\Us;

use yii\helpers\Url;
use yii\bootstrap\Modal;
use kartik\widgets\DatePicker;
use kartik\form\ActiveForm;
use common\models\User;
/* @var $this yii\web\View */
/* @var $model app\models\Bairros */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bairros-form">


    <?php $form = ActiveForm::begin(); ?>

<div class="row">
    <div class="col-lg-12"> 
     <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
</div>
</div>

<div class="row">
        <div class="col-lg-4"> 
			
   		
			
			
			
			
    <?= $form->field($model, 'distrito_id')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(Distritos::find()->asArray()->all(), 'district_code', 'district_name')
]);
?>
</div>

<div class="col-lg-4"> 
    <?= $form->field($model, 'post_admin_id')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(ComiteLocalidades::find()->orderBy('name ASC')->asArray()->all(), 'id', 'name')
]);
?>
</div>


<div class="col-lg-4"> 
    <?= $form->field($model, 'cod_us')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(Us::find()->orderBy('name ASC')->asArray()->all(), 'id', 'name')
]);
?>
</div>

</div>
    

   

   
 <div class="form-group">
    <?= $form->field($model, 'description')->textarea(['rows' => 4]) ?>
</div>
    
<div class="row">
        <div class="col-lg-6"> <?= $form->field($model, 'lat')->textInput(['maxlength' => true]) ?></div>
        <div class="col-lg-6"> <?= $form->field($model, 'lng')->textInput(['maxlength' => true]) ?></div>
</div>
    

   <?= $form->field($model, 'status')->radioButtonGroup([1 => ' Activo', 0 => ' Inactivo']); ?>


   <div class="form-group">
         <?= Html::a('<i class="glyphicon glyphicon-backward"></i>', ['index'], ['class' => 'btn btn-warning']) ?>   
        <?= Html::submitButton($model->isNewRecord ? 'Salvar' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'disabled'=>false]) ?>
    </div>



    <?php ActiveForm::end(); ?>

</div>
