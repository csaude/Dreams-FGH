<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use \kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use app\models\ComiteZonal;
use app\models\ComiteCirculos;
use app\models\ComiteCelulas;
use app\models\ComiteLocalidades;
/* @var $this yii\web\View */
/* @var $model app\models\MembrosSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="membros-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
<!--
<div class="panel panel-default">
    <div class="panel-body">

 <div class="row">
 <div class="form-group">
<br>

    <div class="col-lg-3"> 
  
  <?php Select2::widget([
    'name' => 'MembrosSearch[membro_circulo]',
    'value' => '--', // value to initialize
    'data' => ArrayHelper::map(ComiteCirculos::find()->all(), 'id', 'name'),
    'options' => ['multiple' => false,  'class' => 'form-group', 'placeholder' => 'Comité do Círculo...'],
]);

?>
</div>

    <div class="col-lg-3"> 
   <?php $form->field($model, 'membro_localidade_id')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(ComiteLocalidades::find()
->orderBy('name ASC')->asArray()->all(), 'id', 'name')
]);
?> 
 <?php Select2::widget([
    'name' => 'MembrosSearch[membro_localidade_id]',
    'value' => '--', // value to initialize
    'data' => ArrayHelper::map(ComiteLocalidades::find()->all(), 'id', 'name'),
    'options' => ['multiple' => false,  'class' => 'form-group', 'placeholder' => 'Localidade...'],
]);

?>
        </div>


    <div class="col-lg-3"> 
     <?php Select2::widget([
    'name' => 'MembrosSearch[membro_zona]',
    'value' => '--', // value to initialize
    'data' => ArrayHelper::map(ComiteZonal::find()->all(), 'id', 'name'),
    'options' => ['multiple' => false,  'class' => 'form-group', 'placeholder' => 'Comité de Zona...'],
]);

?> </div>
   

    <div class="col-lg-3"> 

      <?php Select2::widget([
    'name' => 'MembrosSearch[membro_celula]',
    'value' => '--', // value to initialize
    'data' => ArrayHelper::map(ComiteCelulas::find()->all(), 'id', 'name'),
    'options' => ['multiple' => true,  'class' => 'form-group', 'placeholder' => 'Selecione a Célula...'],
]);

?>
     <?php $form->field($model, 'membro_celula')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(ComiteCelulas::find()->joinWith('cCirculo')->orderBy('name ASC')->asArray()->all(), 'id', 'name')
]);
?> </div>



    </div>
    </div>
<br>

 <div class="row">

 <div class="col-lg-3"> 
 <div class="form-group">
         <?= Html::submitButton('<i class="glyphicon glyphicon-search"></i>', ['class' => 'btn btn-primary']) ?>
         <?= Html::a('Reset', ['index'], ['class' => 'btn btn-default']) ?> 
        <?php Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
 </div>
 </div> <div class="col-lg-9"> </div>
 </div>

</div>
</div>

-->
    <?php // $form->field($model, 'id') ?>

    <?php // $form->field($model, 'emp_number') ?>

    <?php //  $form->field($model, 'member_id') ?>

    <?php //  $form->field($model, 'emp_lastname') ?>

    <?php //  $form->field($model, 'emp_firstname') ?>

    <?php // echo $form->field($model, 'emp_middle_name') ?>

    <?php // echo $form->field($model, 'emp_nick_name') ?>

    <?php // echo $form->field($model, 'emp_smoker') ?>

    <?php // echo $form->field($model, 'ethnic_race_code') ?>

    <?php // echo $form->field($model, 'emp_birthday') ?>

    <?php // echo $form->field($model, 'nation_code') ?>

    <?php // echo $form->field($model, 'emp_gender') ?>

    <?php // echo $form->field($model, 'emp_marital_status') ?>

    <?php // echo $form->field($model, 'emp_ssn_num') ?>

    <?php // echo $form->field($model, 'emp_sin_num') ?>

    <?php // echo $form->field($model, 'emp_other_id') ?>

    <?php // echo $form->field($model, 'emp_dri_lice_num') ?>

    <?php // echo $form->field($model, 'emp_dri_lice_exp_date') ?>

    <?php // echo $form->field($model, 'emp_military_service') ?>

    <?php // echo $form->field($model, 'emp_status') ?>

    <?php // echo $form->field($model, 'job_title_code') ?>

    <?php // echo $form->field($model, 'eeo_cat_code') ?>

    <?php // echo $form->field($model, 'work_station') ?>

    <?php // echo $form->field($model, 'emp_street1') ?>

    <?php // echo $form->field($model, 'emp_street2') ?>

    <?php // echo $form->field($model, 'city_code') ?>

    <?php // echo $form->field($model, 'coun_code') ?>

    <?php // echo $form->field($model, 'provin_code') ?>

    <?php // echo $form->field($model, 'emp_zipcode') ?>

    <?php // echo $form->field($model, 'emp_hm_telephone') ?>

    <?php // echo $form->field($model, 'emp_mobile') ?>

    <?php // echo $form->field($model, 'emp_work_telephone') ?>

    <?php // echo $form->field($model, 'emp_work_email') ?>

    <?php // echo $form->field($model, 'sal_grd_code') ?>

    <?php // echo $form->field($model, 'joined_date') ?>

    <?php // echo $form->field($model, 'emp_oth_email') ?>

    <?php // echo $form->field($model, 'termination_id') ?>

    <?php // echo $form->field($model, 'faculdade_id') ?>

    <?php // echo $form->field($model, 'curso_id') ?>

    <?php // echo $form->field($model, 'ano_conclusao12') ?>

    <?php // echo $form->field($model, 'ano_conclusao') ?>

    <?php // echo $form->field($model, 'custom1') ?>

    <?php // echo $form->field($model, 'custom2') ?>

    <?php // echo $form->field($model, 'custom3') ?>

    <?php // echo $form->field($model, 'custom4') ?>

    <?php // echo $form->field($model, 'custom5') ?>

    <?php // echo $form->field($model, 'custom6') ?>

    <?php // echo $form->field($model, 'custom7') ?>

    <?php // echo $form->field($model, 'custom8') ?>

    <?php // echo $form->field($model, 'custom9') ?>

    <?php // echo $form->field($model, 'custom10') ?>

    <?php // echo $form->field($model, 'criado_por') ?>

    <?php // echo $form->field($model, 'actualizado_por') ?>

    <?php // echo $form->field($model, 'criado_em') ?>

    <?php // echo $form->field($model, 'actualizado_em') ?>

    <?php // echo $form->field($model, 'user_location') ?>

    <?php // echo $form->field($model, 'user_location2') ?>

   

    <?php ActiveForm::end(); ?>

</div>
