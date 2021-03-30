<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use kartik\widgets\DepDrop;
use \kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use app\models\Provincias;
use app\models\Distritos;
use app\models\Beneficiarios;
?>

<div class="beneficiarios-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    


<div class="row">
  <div class="col-lg-4">  <?= $form->field($model, 'emp_firstname') ?> </div>

  <div class="col-lg-4">  <?= $form->field($model, 'emp_lastname') ?> </div>
  <div class="col-lg-4">
    <label class="control-label"></label>
    <div class="form-group">
        <?= Html::submitButton('Pesquisar', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Cancelar', ['class' => 'btn btn-default']) ?>
    </div>
  </div>
</div>


    <?php ActiveForm::end(); ?>

</div>
