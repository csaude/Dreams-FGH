<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use yii\helpers\ArrayHelper;
use app\models\Distritos;
use app\models\ComiteProvincial;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $model app\models\ComiteDistrital */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="comite-distrital-form">

    <?php $form = ActiveForm::begin(); ?> 
<label class="control-label" for="comiteprovincial-c_provincial_id">Comité Provincial</label>
<?php 
 if($model->isNewRecord)
 {   echo  Select2::widget([
    'name' => 'ComiteDistrital[c_provincial_id]',
    'value' => 1, // value to initialize
    'data' => ArrayHelper::map(ComiteProvincial::find()->all(), 'id', 'name'),
    'options' => ['multiple' => false,  'class' => 'form-group', 'placeholder' => 'Selecione o Comité Provincial ...'],
]);

} else {
?>

<?php
echo  Select2::widget([
    'name' => 'ComiteDistrital[c_provincial_id]',
    'value' => $model->c_provincial_id, // value to initialize
    'data' => ArrayHelper::map(ComiteProvincial::find()->all(), 'id', 'name'),
    'options' => ['multiple' => false,   'placeholder' => 'Selecione o Comité Provincial ...'],
]);


}?>

<div class="help-block"></div>

<label class="control-label" for="comitedistrital-distrito_id">Distrito</label>
<?php 
 if($model->isNewRecord)
 {   echo  Select2::widget([
    'name' => 'ComiteDistrital[distrito_id]',
    'value' => 1, // value to initialize
    'data' => ArrayHelper::map(Distritos::find()->all(), 'district_code', 'district_name'),
    'options' => ['multiple' => false,   'placeholder' => 'Selecione o Distrito ...'],
]);

} else {
?>

<?php
echo  Select2::widget([
    'name' => 'ComiteDistrital[distrito_id]',
    'value' => $model->distrito_id, // value to initialize
    'data' => ArrayHelper::map(Distritos::find()->all(), 'district_code', 'district_name'),
    'options' => ['multiple' => false,  'placeholder' => 'Selecione o Distrito ...'],
]);


}?>

<div class="help-block"></div>




    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
    <?= Html::a('<i class="glyphicon glyphicon-home"></i>', ['comite-distrital/index'], ['class' => 'btn btn-danger']) ?> 
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
