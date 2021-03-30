<?php

use yii\helpers\Html;

use kartik\form\ActiveForm;
use yii\helpers\ArrayHelper;

use app\models\ServicosDream;
use app\models\FaixaEtaria;

/* @var $this yii\web\View */
/* @var $model app\models\FaixaEtariaServico */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="faixa-etaria-servico-form">

    <?php $form = ActiveForm::begin(); ?>



           <?=  Html::activeDropDownList($model, 'servico_id', ArrayHelper::map(ServicosDream::find()
                  ->where(['=','status',1])
                  ->all(), 'id', 'name'),
                  ['class' => 'form-control','readOnly'=> false]); ?>

                  <?=  Html::activeDropDownList($model, 'faixa_id', ArrayHelper::map(FaixaEtaria::find()
                         ->where(['=','status',1])
                         ->orderBy('nivel_intervencao_id')
                         ->all(), 'id', 'faixa_etaria','nivel_intervencao_id'),
                         ['class' => 'form-control','readOnly'=> false]); ?>



      <?= $form->field($model, 'description')->textArea(['maxlength' => true, 'rows' => '3']) ?>

      <?= $form->field($model, 'status')->radioButtonGroup([1 => ' Activo', '0' => ' Cancelado']); ?>




    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
