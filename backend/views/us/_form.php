<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;



use kartik\widgets\DepDrop;
use \kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use app\models\Provincias;
use app\models\Distritos;
use app\models\ComiteLocalidades;
use app\models\TipoUs;

use yii\helpers\Url;
use yii\bootstrap\Modal;
use kartik\widgets\DatePicker;
use kartik\form\ActiveForm;
use common\models\User;

/* @var $this yii\web\View */
/* @var $model app\models\Us */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="us-form">





    <?php $form = ActiveForm::begin(); ?>

<div class="row">
    <div class="col-lg-4">      
     <?= $form->field($model, 'provincia_id')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(Provincias::find()->orderBy('province_name ASC')->where('status IS NOT NULL')->asArray()->all(), 'id', 'province_name')
]);
?> 
    </div>

    <div class="col-lg-4"> 
		   <?= $form->field($model, 'distrito_id')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(Distritos::find()->asArray()->all(), 'district_code', 'district_name')
]);
?>
		
    </div>

  <?php /* $form->field($model, 'post_admin_id')->textInput()*/ ?>
<div class="col-lg-4"> 
<?php  echo  $form->field($model, 'post_admin_id')->widget(Select2::classname(), [
'data' => ArrayHelper::map(ComiteLocalidades::find()->asArray()->orderBy('name ASC')->all(), 'id', 'name'),'options' => ['placeholder' => 'Selecione o Posto Administrativo'], 
    'pluginOptions' => [
                    'allowClear' => true
                ],
]);
?>
</div>
</div>


<div class="row">
    <div class="col-lg-4"><?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?> </div>

    <div class="col-lg-4"><?= $form->field($model, 'cod_us')->textInput(['maxlength' => true]) ?></div>

    <div class="col-lg-4"><?php  echo  $form->field($model, 'nivel_id')->widget(Select2::classname(), [
'data' => ArrayHelper::map(TipoUs::find()->asArray()->orderBy('tipo ASC')->all(), 'id', 'tipo'),'options' => ['placeholder' => 'Selecione o nível Sanitário'], 
    'pluginOptions' => [
                    'allowClear' => true
                ],
]);
?>
</div>
</div>
    

<div class="row">
    <div class="col-lg-4"> 
    <?= $form->field($model, 'lat')->textInput(['maxlength' => true]) ?></div>
    <div class="col-lg-4"> <?= $form->field($model, 'lng')->textInput(['maxlength' => true]) ?>    
    </div>
</div>
<div class="row">
<div class="col-lg-4"> <?= $form->field($model, 'description')->textArea(['maxlength' => true]) ?></div>
</div>
 <div class="row">   
 <?= $form->field($model, 'status')->radioButtonGroup([1 => ' Activo', 0 => ' Inactivo']); ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
</div>
    <?php ActiveForm::end(); ?>





</div>
