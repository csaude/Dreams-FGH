<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\form\ActiveForm;
use app\models\ParceirosTipo;
use app\models\Distritos; //updated on 26 SEPT 2017
use kartik\widgets\DepDrop;
use \kartik\widgets\Select2;
/* @var $this yii\web\View */
/* @var $model app\models\Organizacoes */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="organizacoes-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'abreviatura')->textInput(['maxlength' => true]) ?>
 <?= $form->field($model, 'parceria_id')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(ParceirosTipo::find()->orderBy('name ASC')->where('status IS NOT NULL')->asArray()->all(), 'id', 'name')
]);
?> 

	<?php $form->field($model, 'distrito_id')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(Distritos::find()->asArray()->all(), 'district_code', 'district_name',['placeholder' => '--'])
]);
?>
	
	<?= $form->field($model, 'distrito_id')->widget(Select2::classname(), [
       'data' => ArrayHelper::map(Distritos::find()
       ->asArray()->all(), 'district_code', 'district_name')
   ], ['placeholder' => '--']);
   ?>




    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>


<?= $form->field($model, 'status')->radioButtonGroup([1 => ' Activo', 0 => ' Inactivo']); ?>


    <div class="form-group">
         <?= Html::a('<i class="glyphicon glyphicon-backward"></i>', ['index'], ['class' => 'btn btn-warning']) ?>   
        <?= Html::submitButton($model->isNewRecord ? 'Salvar' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'disabled'=>false]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
