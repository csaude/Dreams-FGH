<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;

use kartik\form\ActiveForm;
use \kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use app\models\TipoServicos;
/* @var $this yii\web\View */
/* @var $model app\models\ServicosDream */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="servicos-dream-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>


    <?= $form->field($model, 'servico_id')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(TipoServicos::find()->orderBy('name ASC')->where('status IS NOT NULL')->asArray()->all(), 'id', 'name')
]);
?> 
<?= $form->field($model, 'core_service')->radioButtonGroup([0=> 'N&Atilde;O', 1=> 'SIM']); ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->radioButtonGroup([1 => ' Activo', 0 => ' Inactivo']); ?>

    

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
