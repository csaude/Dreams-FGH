<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;


use kartik\widgets\DepDrop;
use \kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use kartik\widgets\DatePicker;
use kartik\form\ActiveForm;
use common\models\User;
use app\models\ServicosDream;
use app\models\Beneficiarios;
use app\models\Us;
use app\models\SubServicosDreams;
use app\models\TipoServicos;
use kartik\daterange\DateRangePicker;
/* @var $this yii\web\View */
/* @var $model app\models\ServicosBeneficiados */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="servicos-beneficiados-form">

    <?php $form = ActiveForm::begin(); ?>
<div class="row"> 
<div class="col-lg-12"> 
 <?php 
//if(isset($_REQUEST['id'])) {$_REQUEST['m']=filter_var($_REQUEST['id'], FILTER_SANITIZE_NUMBER_INT);}
if(isset($_REQUEST['m'])&&$_REQUEST['m']>0) {

	$idb=filter_var($_REQUEST['m'], FILTER_SANITIZE_NUMBER_INT);
$person = Beneficiarios::find()->where(['=','id',$idb])->all();

$personMap = ArrayHelper::map($person,'member_id',function ($person, $defaultValue)
       { 
		   if (isset(Yii::$app->user->identity->role)&&Yii::$app->user->identity->role==20) {
        echo '<h2>'.$person->emp_firstname." ".$person->emp_middle_name." ".$person->emp_lastname.'</h2>';
        } else {  

        echo '<h2>'.$person->distrito['cod_distrito'].'/'.$person->member_id.'</h2>';
        }
	   
	   });	
	
	
echo $form->field($model, 'beneficiario_id')->hiddenInput(['value'=>$_REQUEST['m']])->label(false);
} else {

$person = Beneficiarios::find()->orderBy('emp_firstname ASC')->all();

$personMap = ArrayHelper::map($person,'member_id',function ($person, $defaultValue)
       { return  $person->emp_firstname." ".$person->emp_middle_name." ".$person->emp_lastname; });

if($model->isNewRecord) { }
echo $form->field($model, 'beneficiario_id')->dropDownList(
$personMap, ['prompt'=>'[--selecione o Beneficiario --]',
        ]);

}
?>

	</div>
	

	<div class="col-lg-4">
		<label class="control-label" for="servicosbeneficiados-servico_id">&Aacute;rea de Serviços</label>
<?=
 Html::activeDropDownList($model, 'tipo_servico_id', ArrayHelper::map(TipoServicos::find()->where(['=','status',1])->all(), 'id', 'name'),
['class' => 'form-control','prompt'=>'--Selecione o Tipo de Serviço--',
 'onchange'=>'$.post("servicos.dreams?id='.'"+$(this).val(), function(data) {
    $("select#servicosbeneficiados-servico_id").html(data);
 });',
]); 

?>
<div class="help-block"></div>
</div>
	
<div class="col-lg-4">
<label class="control-label" for="servicosbeneficiados-servico_id"> Serviço</label>
<?php  


if(!$model->isNewRecord) { 

echo Html::activeDropDownList($model, 'servico_id', ArrayHelper::map(ServicosDream::find()->all(), 'id', 'name'),
['class' => 'form-control',
 'onchange'=>'$.post("listas.dreams?id='.'"+$(this).val(), function(data) {
    $("select#servicosbeneficiados-sub_servico_id").html(data);
 });',
]); 

} else {


if (isset($_REQUEST['ts'])&&($_REQUEST['ts']>0)) {echo Html::activeDropDownList($model, 'servico_id', ArrayHelper::map(ServicosDream::find()->where(['=','servico_id',$_REQUEST['ts']])->andWhere(['=','status',1])->all(), 'id', 'name'),
['class' => 'form-control',
 'onchange'=>'$.post("listas.dreams?id='.'"+$(this).val(), function(data) {
    $("select#servicosbeneficiados-sub_servico_id").html(data);
 });',
]); } else {

  echo Html::activeDropDownList($model, 'servico_id', ArrayHelper::map(ServicosDream::find()->where(['=','servico_id',$_REQUEST['ts']])->andWhere(['=','status',1])->all(), 'id', 'name'),
['class' => 'form-control','prompt'=>'--Selecione o Serviço--',
 'onchange'=>'$.post("listas.dreams?id='.'"+$(this).val(), function(data) {
    $("select#servicosbeneficiados-sub_servico_id").html(data);
 });',
]);  
}
}//is New
 ?>
<div class="help-block"></div>
</div>

<div class="col-lg-4">        <?= $form->field($model, 'sub_servico_id')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(SubServicosDreams::find()->orderBy('name ASC')->where(['=','status',1])->asArray()->all(), 'id', 'name')
]);
?>
</div>	
	<div class="col-lg-4"> <br>
     <?= $form->field($model, 'ponto_entrada')->radioButtonGroup([1 => 'US', 2 => 'CM', 3 => 'ES']); ?>
 </div> 
<div class="col-lg-4"> 	
<?= $form->field($model, 'us_id')->dropDownList(ArrayHelper::map(
   Us::find()->orderBy('name ASC')
   ->where(['provincia_id'=>(int)Yii::$app->user->identity->provin_code])
 ->andWhere('status IS NOT NULL')->all(),'id','name'),['prompt'=>'---']);
?>


</div> 
	
	<div class="col-lg-4"> 
	<?php // $form->field($model, 'resultado')->textInput();
?> 

  

 <?= $form->field($model, 'data_beneficio')->widget(DatePicker::classname(), [
    'options' => ['placeholder' => 'Data da Sessão...', 'dateFormat' => 'dd-MM-YYYY'],
    'pluginOptions' => [
        'autoclose'=>true
    ]
]);
 ?> 





 </div>

</div> <div class="col-lg-12"> 
	<?php $form->field($model, 'activista_id')->textInput() ?> 
</div>


<div class="col-lg-12">
<?= $form->field($model, 'provedor')->textInput(['readonly'=>false,'placeholder' => 'Nome do Provedor do Serviço']) ?>
</div>

	 <div class="col-lg-12">
	<?= $form->field($model, 'description')->textArea(['maxlength' => true, 'rows' => '3']) ?>
 </div> </div>  
		 <div class="col-lg-12">
<?php $form->field($model, 'status')->radio( ['1' => ' Activo', '0' => ' Cancelado']);?>
			 
	<?= $form->field($model, 'status')->dropDownList([1 => 'Activo', 0 => 'Cancelado']); ?>		 
			 
	<?php $form->field($model, 'status')->checkbox(['value' => 1])->label('Status'); ?>
 <?php $form->field($model, 'status')->radioButtonGroup(['1' => ' Activo', '0' => ' Cancelado']); ?>
 </div> 

 <div class="col-lg-12">
    <div class="form-group">

<?php if(isset($_REQUEST['atender']) &&isset($_REQUEST['m'])&&($_REQUEST['m']>0)&&($_REQUEST['atender']==sha1(1)))   {?>
          <?= Html::submitButton($model->isNewRecord ? 'Atender' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    <?php } else { ?>
        <?= Html::submitButton($model->isNewRecord ? 'Salvar' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
		<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
<?php }?> 
    </div>
</div>
	
</div>	
    <?php ActiveForm::end(); ?>

</div>


