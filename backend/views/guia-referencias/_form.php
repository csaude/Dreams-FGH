<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\checkbox\CheckboxX;
use kartik\widgets\ActiveForm;
use app\models\ReferenciasServicos;
/* @var $this yii\web\View */
/* @var $model app\models\GuiaReferencias */
/* @var $form yii\widgets\ActiveForm */
use app\models\ServicosDream;

?>

<div class="guia-referencias-form">



  <div id="printableArea">
  <div id="content">
  <table width="100%"   class="table table-bordered  table-condensed">
    <tr>
      <td   bgcolor="#261657" bgcolor="" align="center"><font color="#fff" size="+1"><b>

        <span class="fa fa-exchange" aria-hidden="true"></span> Lista de Benefici&aacute;rios Referidos e Enviados
          </b></font></td>
      </tr>
    <tr>
      <td   bgcolor="#808080" align="center">
        <font color="#fff" size="+1"><b>
        </b></font>    </td>
      </tr>
    </table>
  <div>
     <p>

  <ul class="nav nav-tabs">
      <li class="active"><a data-toggle="tab" href="#home"><i class="fa fa-plus"></i> Referir</a></li>
      <li><a data-toggle="tab" href="#menu1"><i class="fa fa-hand-o-down"></i> Recebidos </a></li>
      <li><a data-toggle="tab" href="#menu2"><i class="fa fa-hand-o-up"></i> Referidos</a></li>
    </ul>

    <div class="tab-content">


      <div id="home" class="tab-pane fade in active">
        <h2><span class="fa fa-user success" aria-hidden="true"></span> Referir Benefici&aacute;rio</h2>
      <div class="col-xs-12">
      <div class="panel panel-primary">
      <div class="panel-heading"><i class="fa fa-plus"></i> <b> Referir Benefici&aacute;rio </b> </div>
      <div class="panel-body">
        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'beneficiario_id')->textInput(['disabled' => 'disabled','placeholder'=>'0000XXX']) ?>

        <?php $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'projecto')
        ->radioButtonGroup(
        ['PCC' => 'PCC',
        'CHASS N'=> 'CHASS N',
        'CHASS SMT'=>'CHASS SMT',
        'TB CARE'=>'TB CARE',
        'ESTRADA'=>'ESTRADA',
        'Outro'=>'Outro',
        ], ['id' => 'pilih_dulu', 'onchange' => 'if($(this).val() != 1) {
                         $("#'.Html::getInputId($model, 'description').'").val($(this).val());
                     }
                     else if($(this).val() == 2) {
                         $("#'.Html::getInputId($model, 'description').'").val($(this).val());
                     } else if($(this).val() == 3){
                         $("#'.Html::getInputId($model, 'description').'").val($(this).val());
                     }
        ']); ?>





        <?= $form->field($model, 'referido_por')->textInput(['disabled' => 'disabled']) ?>

        <?= $form->field($model, 'notificar_ao')->textInput(['disabled' => 'disabled']) ?>

        <?= $form->field($model, 'description')->textArea(['maxlength' => true]) ?>

        <?= $form->field($model, 'status')->radioButtonGroup([1 => ' Activo', 0 => ' Inactivo'])->label(false); ?>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Enviar') : Yii::t('app', 'Actualizar'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>
      </div>
      </div>
      </div>

      </div>


      <div id="menu1" class="tab-pane fade">

       <h2><span class="fa fa-group danger" aria-hidden="true"></span> Lista de Benefici&aacute;rios Recebidos</h2>

  <div class="col-xs-12">
    <div class="panel panel-danger">
    <div class="panel-heading"><i class="fa fa-group"></i> <b> Lista de Benefici&aacute;rios Recebidos </b> </div>
    <div class="panel-body">
    </div>
    </div>
    </div>

  </div>



  <div id="menu2" class="tab-pane fade">

    <h2><span class="fa fa-group success" aria-hidden="true"></span> Lista de Benefici&aacute;rios Referidos</h2>
  <div class="col-xs-12">
  <div class="panel panel-warning">
  <div class="panel-heading"><i class="fa fa-group"></i> <b> Lista de Benefici&aacute;rios Referidos </b> </div>
  <div class="panel-body">

  </div>
  </div>
  </div>


  </div>

    </div>



  </p>

  </div>


  </div>







</div>
