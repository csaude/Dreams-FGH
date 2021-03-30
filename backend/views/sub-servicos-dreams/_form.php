<?php

use yii\helpers\Html;

use kartik\widgets\DepDrop;
use \kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use kartik\widgets\DatePicker;
use kartik\form\ActiveForm;
use common\models\User;
use app\models\ServicosDream;


/* @var $this yii\web\View */
/* @var $model app\models\SubServicosDreams */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sub-servicos-dreams-form">

    <?php $form = ActiveForm::begin(); ?>

 <div class="row">
    <div class="col-lg-6">        <?= $form->field($model, 'servico_id')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(ServicosDream::find()->orderBy('name ASC')->where('status IS NOT NULL')->asArray()->all(), 'id', 'name')
]);
?> 
</div>
<div class="col-lg-6">

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    </div>
</div>


 <div class="row">

 <div class="col-lg-6">
    <?= $form->field($model, 'description')->textArea(['maxlength' => true]) ?>
</div>
</div>

 <div class="row">
 <div class="col-lg-3">
 <?= $form->field($model, 'status')->radioButtonGroup([1 => ' Activo', 0 => ' Inactivo']); ?>
 </div> 
  <div class="col-lg-3">
 <?= $form->field($model, 'oculto')->radioButtonGroup([1 => ' Sim', 0 => ' Nao']); ?>
 </div> 
 </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Salvar') : Yii::t('app', 'Actualizar'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
