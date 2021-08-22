<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\daterange\DateRangePicker;

/* @var $this yii\web\View */
/* @var $model app\models\ReferenciasPendentesDreamsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="referencias-dreams-search">

    <?php $form = ActiveForm::begin([
        'action' => ['pendentes'],
        'method' => 'get',
    ]); 
    ?>

    <div class="row">

        <div class="col-lg-6">
            <?= 
                $form->field($model, 'start', [
                'options'=>['class'=>'input-group drp-container']
                ])->widget(DateRangePicker::classname(), [
                'useWithAddon'=>true,
                'readonly' => true,
                'pluginOptions'=>[
                    'language'=>'pt',
                    'singleDatePicker'=>true,
                    'hideInput'=>true,
                    'showDropdowns'=>false,
                    'maxYear' => 2025,
                    'minYear' => 2017,
                    'autoclose'=>true,
                    'locale' => ['format' => 'YYYY-MM-DD'],
                ]
                ])->label('Data Inicio');

            ?>
        </div>

        <div class="col-lg-6">
            <?= 

                $form->field($model, 'end', [
                'options'=>['class'=>'input-group drp-container']
                ])->widget(DateRangePicker::classname(), [
                'useWithAddon'=>true,
                'readonly' => true,
                'pluginOptions'=>[
                    'language'=>'pt',
                    'singleDatePicker'=>true,
                    'hideInput'=>true,
                    'showDropdowns'=>false,
                    'maxYear' => 2025,
                    'minYear' => 2017,
                    'autoclose'=>true,
                    'locale' => ['format' => 'YYYY-MM-DD'],
                ]
                ])->label('Data Fim');

            ?>
        </div>
    </div>

    <?php // $form->field($model, 'id') ?>

    <?php // $form->field($model, 'beneficiario_id') ?>

    <?php // $form->field($model, 'nota_referencia') ?>

    <?php // $form->field($model, 'name') ?>

    <?php // $form->field($model, 'projecto') ?>

    <?php // echo $form->field($model, 'referido_por') ?>

    <?php // echo $form->field($model, 'notificar_ao') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'criado_por') ?>

    <?php // echo $form->field($model, 'actualizado_por') ?>

    <?php // echo $form->field($model) ?>

    <?php // echo $form->field($model, 'actualizado_em') ?>

    <?php // echo $form->field($model, 'user_location') ?>

    <?php // echo $form->field($model, 'user_location2') ?>

    <div class="form-group pull-right">
        </br>
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <!-- <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?> -->
    </div>

    <?php ActiveForm::end(); ?>

</div>
