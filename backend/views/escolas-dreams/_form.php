<?php

use yii\helpers\Html;


use kartik\widgets\DepDrop;
use \kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use app\models\Provincias;
use app\models\Distritos;
use app\models\Bairros;
use app\models\Us;

use yii\helpers\Url;
use yii\bootstrap\Modal;
use kartik\widgets\DatePicker;
use kartik\form\ActiveForm;
use common\models\User;

/* @var $this yii\web\View */
/* @var $model app\models\EscolasDreams */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="escolas-dreams-form">

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
            
    <?= $form->field($model, 'bairro_id')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(Bairros::find()->asArray()->all(), 'id', 'name')
]);
?>
</div>
</div>



    <div class="row">
    <div class="col-lg-4"><?= $form->field($model, 'lat')->textInput(['maxlength' => true]) ?></div>

    <div class="col-lg-4"><?= $form->field($model, 'lng')->textInput(['maxlength' => true]) ?></div>

    </div>

<div class="row">
    <div class="col-lg-8"><?= $form->field($model, 'description')->textArea(['maxlength' => true]) ?></div>
</div>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Salvar') : Yii::t('app', 'Actualizar'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
