<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Provincias;
use app\models\Distritos;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Distritos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="distritos-form">



    <?php $form = ActiveForm::begin(); ?>
 
<?php 
 if($model->isNewRecord)
 {   echo  Select2::widget([
    'name' => 'Distritos[province_code]',
    'value' => 5, // value to initialize
    'data' => ArrayHelper::map(Provincias::find()->all(), 'id', 'province_name'),
    'options' => ['multiple' => false, 'placeholder' => 'Selecione a Província ...'],
]);

} else {
	 
	 
?>

<?= Html::activeDropDownList($model, 'province_code',ArrayHelper::map(Provincias::find()->all(), 'id', 'province_name'),['class' => 'form-control']); }?>
<div class="help-block"></div>

	 <div class="row">
 <div class="col-xs-3"> <?= $form->field($model, 'cod_distrito')->textInput(['maxlength' => true])->widget(\yii\widgets\MaskedInput::className(), [
    'mask' => '9999',
]) ?></div>
<div class="col-xs-9">
    <?= $form->field($model, 'district_name')->textInput(['maxlength' => 100]) ?>
</div>
		 </div>
     <div class="form-group">
        <?= Html::a('<i class="glyphicon glyphicon-home"></i>', ['site/index'], ['class' => 'btn btn-danger']) ?> 
        <?= Html::submitButton($model->isNewRecord ? 'Salvar' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'disabled'=>false]) ?>
    </div>

    <?php ActiveForm::end(); ?>





</div>

