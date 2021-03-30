<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use yii\helpers\ArrayHelper;
use app\models\ComiteDistrital;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $model app\models\ComiteZonal */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="comite-zonal-form">

    <?php $form = ActiveForm::begin(); ?>

       <label class="control-label" for="comitezonal-distrito_id">Comité Distrital</label>
<?php 
 if($model->isNewRecord)
 {   echo  Select2::widget([
    'name' => 'ComiteZonal[c_distrito_id]',
    'value' => 1, // value to initialize
    'data' => ArrayHelper::map(ComiteDistrital::find()->all(), 'id', 'name'),
    'options' => ['multiple' => false,   'placeholder' => 'Selecione o Comité Distrital ...'],
]);

} else {
?>

<?php
echo  Select2::widget([
    'name' => 'ComiteZonal[c_distrito_id]',
    'value' => $model->c_distrito_id, // value to initialize
    'data' => ArrayHelper::map(ComiteDistrital::find()->all(), 'id', 'name'),
    'options' => ['multiple' => false,  'placeholder' => 'Selecione o Comité Distrital ...'],
]);


}?>

<div class="help-block"></div>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>



      <div class="form-group">
    <?= Html::a('<i class="glyphicon glyphicon-home"></i>', ['comite-zonal/index'], ['class' => 'btn btn-danger']) ?> 
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
