<?php

use yii\helpers\Html;

use kartik\form\ActiveForm;
use \kartik\widgets\Select2;
use yii\helpers\ArrayHelper;

use app\models\ServicosDream;
use app\models\Curriculum;

?>

<div class="curriculum-servico-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'curriculum_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Curriculum::find()
            ->where(['=', 'status', 1])
            ->all(), 'id', 'name'),
        'options' => ['placeholder' => '--Selecione Aqui--'],
    ]); ?>

    <?= $form->field($model, 'servico_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(ServicosDream::find()
            ->where(['=', 'status', 1])
            ->all(), 'id', 'name'),
        'options' => ['placeholder' => '--Selecione Aqui--'],
    ]); ?>

    <?= $form->field($model, 'description')->textArea(['maxlength' => true, 'rows' => '3']) ?>

    <?= $form->field($model, 'status')->radioButtonGroup([1 => ' Activo', '0' => ' Cancelado']); ?>

    <div class="form-group">
        <?= Html::a('<i class="glyphicon glyphicon-backward"></i>', ['index'], ['class' => 'btn btn-warning']) ?>
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Salvar') : Yii::t('app', 'Actualizar'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>