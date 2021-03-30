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
use app\models\JobCategory;
use yii\jui\AutoComplete;
use kartik\widgets\FileInput;
use  app\models\Membros;
use app\models\ComiteCelulas;
use app\models\ComiteCirculos;
use app\models\ComiteCidades;
use app\models\ComiteLocalidades;
use app\models\ComiteFormaPagamento;
use app\models\TiposDeQuotas;
/* @var $this yii\web\View */
/* @var $model app\models\Quotas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="quotas-form">

    <?php $form = ActiveForm::begin(); ?>
     
<?=
    $model->isNewRecord? $form->field($model, 'quota_id')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(TiposDeQuotas::find()->orderBy('name ASC')->asArray()->all(), 'id', 'name')
]):''
?> 

    <?php 
$person = Membros::find()->orderBy('emp_firstname ASC')->all();

$personMap = ArrayHelper::map($person,'id',function ($person, $defaultValue)
       { return  $person->emp_firstname." ".$person->emp_middle_name." ".$person->emp_lastname; });
?>

<?php

if(isset($_REQUEST['m'])) {?> 
<input type="hidden" name="Quotas[member_id]" value="<?= $_REQUEST['m']; ?>">
<?php } else {?>

<?=  $model->isNewRecord?  $form->field($model, 'member_id')->dropDownList(
$personMap, ['prompt'=>'[--selecione o membro --]',
        ]):''; 
}
    ?>



   
<?php
    $model->isNewRecord? $form->field($model, 'member_id')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(Membros::find()->orderBy('emp_lastname ASC')->asArray()->all(), 'id', 'emp_firstname')
]):''
?> 

 <?= $form->field($model, 'quantia')->textInput(['maxlength' => true]) ?> 
 <?=   $form->field($model, 'data_pagamento')->widget(DatePicker::classname(), [
   // 'options' => ['placeholder' => 'Data de Nascimento ...'],
    'language' => 'pt',
    'pluginOptions' => [
        'autoclose'=>true
    ]
]);  
?>

   
<?=
    $model->isNewRecord? $form->field($model, 'meio_pagamento')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(ComiteFormaPagamento::find()->orderBy('name ASC')->asArray()->all(), 'id', 'name')
]):''
?>

   


<?php

$list = ComiteLocalidades::find()
    ->select(['id', 'name'])
    ->asArray()
    ->all();

$optionsList = \yii\helpers\ArrayHelper::map($list, 'name', 'name');

$locais = ComiteLocalidades::find(['id', 'name'])->orderBy('name ASC')->asArray( )->all();
$data = ArrayHelper::getColumn($locais, 'name');
/*foreach ($locais as $local) {
   $a= $local['name'];
}*/
/* $form->field($model, 'local_pagamento')->widget(AutoComplete::className(), ['clientOptions' =>
        ['source' => $data1],]);*/

// $a= \yii\helpers\Json::encode($locais);
/*echo  AutoComplete::widget([
    'model' => $model,
    'attribute' => 'local_pagamento',
    'class'=>'form-control',
    'clientOptions' => [
      'source' =>$data1,
       'autoFill'=>true,
    'minLength'=>'1',
      
    ],
]);*/
 ?>




<?=
  $model->isNewRecord?  $form->field($model, 'receptor')->dropDownList(
$personMap, ['prompt'=>'[--selecione o membro que recebeu o valor--]',
        ]):''; 

    ?>
<?=
    $model->isNewRecord? $form->field($model, 'local_pagamento')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(ComiteLocalidades::find()->orderBy('name ASC')->asArray()->all(), 'id', 'name')
]):''
?>
<?php $form->field($model, 'local_pagamento')->widget(\yii\jui\AutoComplete::classname(), [
    'model' => $model,
    'attribute' => 'local_pagamento',
    'clientOptions' => [
        'source' => $data,
    ],
]) ?>
    <?= $form->field($model, 'description')->textArea(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->radioButtonGroup([1 => 'Liquidado', 0 => 'Não Liquidado']); ?>



   <div class="form-group">
         <?= Html::a('<i class="glyphicon glyphicon-backward"></i>', ['index'], ['class' => 'btn btn-warning']) ?>   
        <?= Html::submitButton($model->isNewRecord ? 'Salvar' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'disabled'=>false]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
