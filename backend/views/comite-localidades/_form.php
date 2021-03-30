<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use yii\helpers\ArrayHelper;
use app\models\Distritos;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $model app\models\ComiteLocalidades */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="comite-localidades-form">

    <?php $form = ActiveForm::begin(); ?>

           <label class="control-label" for="comitelocalidades-distrito_id"> Distrito</label>
<?php 
 if($model->isNewRecord)
 {   echo  Select2::widget([
    'name' => 'ComiteLocalidades[c_distrito_id]',
    'value' => 1, // value to initialize
    'data' => ArrayHelper::map(Distritos::find()->all(), 'district_code', 'district_name'),
    'options' => ['multiple' => false,   'placeholder' => 'Selecione o Distrito ...'],
]);

} else {
?>

<?php
echo  Select2::widget([
    'name' => 'ComiteLocalidades[c_distrito_id]',
    'value' => $model->c_distrito_id, // value to initialize
    'data' => ArrayHelper::map(Distritos::find()->all(), 'district_code', 'district_name'),
    'options' => ['multiple' => false,  'placeholder' => 'Selecione o Distrito ...'],
]);


}?>
<div class="row">&nbsp;</div>
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>




         <div class="form-group">
    <?= Html::a('<i class="glyphicon glyphicon-home"></i>', ['comite-localidades/index'], ['class' => 'btn btn-danger']) ?> 
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
 

    <?php ActiveForm::end(); ?>

</div>
