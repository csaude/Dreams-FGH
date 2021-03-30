<?php

use yii\helpers\Html;


use kartik\widgets\DepDrop;
use \kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use app\models\Provincias;
use app\models\Distritos;
use app\models\ComiteCidades;
use app\models\ComiteNacionalidade;
use app\models\ComiteZonal;
use app\models\ComiteCirculos;
use app\models\ComiteCelulas;
use app\models\ComiteLocalidades;
use app\models\TipoCargos;
use app\models\ComiteCargos;


use yii\helpers\Url;
use yii\bootstrap\Modal;
use kartik\widgets\DatePicker;
use kartik\form\ActiveForm;
use common\models\User;
use app\models\Educacao;
use app\models\TituloProfissional;
use app\models\JobCategory;
use yii\jui\AutoComplete;
use kartik\widgets\FileInput;

use yii\widgets\MaskedInput;
use app\models\Beneficiarios;
use app\models\Bairros;
use app\models\Us;
use app\models\PontosDeEntrada;
/* @var $this yii\web\View */
/* @var $model app\models\Beneficiarios */
/* @var $form yii\widgets\ActiveForm */
?>


<div class="beneficiarios-form">

   <?php $form = ActiveForm::begin(); ?>


<div class="row">
  <div class="col-lg-6">

<div class="panel panel-success">
  <div class="panel-heading"> 
  <b><span class="glyphicon glyphicon-check" aria-hidden="true"></span> Dados Pessoais</b>
  </div>
  <div class="panel-body">



<?php  MaskedInput::widget([
    'name' => 'member_id',
    'mask' => 'aa/9999999',
]);
?>

	  <?php if(!$model->isNewRecord&&$model->emp_gender==2) { ?>
<div class="row">

  <div class="col-lg-6">   <?= $form->field($model, 'emp_number')->textInput(['readonly'=>true]) ?></div>

    <div class="col-lg-6"> <?= $form->field($model, 'member_id')->textInput(['readonly'=>true])->widget(\yii\widgets\MaskedInput::className(), [
    'mask' => '9999999',
]) ?></div>


</div>
<?php } ?>
	  
	  <?php if($model->isNewRecord) { ?>

<div class="row">
  <div class="col-lg-6">  <?= $form->field($model, 'emp_lastname')->textInput() ?></div>

    <div class="col-lg-6"> <?= $form->field($model, 'emp_firstname')->textInput() ?></div>
</div>
<?php } elseif(isset(Yii::$app->user->identity->role)&&(Yii::$app->user->identity->role==20))
{ ?>
	  <div class="row">
    <div class="col-lg-6">  <?= $form->field($model, 'emp_lastname')->textInput() ?></div>

      <div class="col-lg-6"> <?= $form->field($model, 'emp_firstname')->textInput() ?></div>
  </div>
<?php }?>

	  
<div class="row">
   <div class="col-lg-6">
<button class="btn btn-success" data-toggle="collapse" data-target="#data" disabled> Data de Nascimento <span class="glyphicon glyphicon-calendar"></span></button>

<?= $form->field($model, 'emp_birthday')->widget(\yii\widgets\MaskedInput::className(), [
    'mask' => '99/99/9999',
]) ?>

<!--  <div class="form-group field-beneficiarios-emp_birthday">
<label class="control-label" for="beneficiarios-emp_birthday">Data Nascimento</label>
<input type="text" id="beneficiarios-emp_birthday" class="form-control" name="Beneficiarios[emp_birthday]">
</div> -->
<!--
<div id="data" class="">

   <?php $form->field($model, 'emp_birthday')->widget(DatePicker::classname(), [
    'options' => ['placeholder' => 'Data de Nascimento...', 'dateFormat' => 'mm/dd/yyyy'],
'pluginOptions' => [
        'autoclose'=>true
    ]
]);
 ?>
</div> -->   </div>

	   <div class="col-lg-6">
		   <?php $form->field($model, 'idade_anos')->input('number', ['placeholder'=>'Idade (em anos)', 'min' => 10, 'max' => 24])->label(false) ?>
<button class="btn btn-warning" data-toggle="collapse" data-target="#idade" disabled>Não Conhece a Data de Nascimento </button>
      <div id="idade" class="">
	<?= $form->field($model, 'idade_anos')->dropDownList(array_combine(range(10, 24), range(10, 24)),
	array('prompt'=>'Idade (em anos)','class' => 'form-control')); ?>
</div>
	</div>
</div>



<div class="row">

    <div class="col-lg-12">
    <?= $form->field($model, 'nation_code')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(ComiteNacionalidade::find()->orderBy('name ASC')->where(['status'=>1])->asArray()->all(), 'id', 'name')
]);
?>

    </div>
	  </div>
<div class="row">
<?php
if(isset(Yii::$app->user->identity->provin_code)&&(Yii::$app->user->identity->provin_code>0)&&
isset(Yii::$app->user->identity->district_code)&&(Yii::$app->user->identity->district_code>0)&&
isset(Yii::$app->user->identity->localidade_id)&&(Yii::$app->user->identity->localidade_id>0))
{ ?>

  <input type="hidden" value="1" id="beneficiarios-nation_code" class="form-control" name="Beneficiarios[nation_code]">
  <input type="hidden" value="<?= Yii::$app->user->identity->provin_code; ?>" id="beneficiarios-provin_code" class="form-control" name="Beneficiarios[provin_code]">
  <input type="hidden" value="<?= Yii::$app->user->identity->district_code; ?>" id="beneficiarios-district_code" class="form-control" name="Beneficiarios[district_code]">
  <input type="hidden" value="<?= Yii::$app->user->identity->localidade_id; ?>" id="beneficiarios-membro_localidade_id" class="form-control" name="Beneficiarios[membro_localidade_id]">

<?php
} else { ?>


    <div class="col-lg-4">
<label class="control-label" for="beneficiarios-provin_code">Província</label>
<?= Html::activeDropDownList($model, 'provin_code', ArrayHelper::map(Provincias::find()->where(['status'=>1])->all(), 'id', 'province_name'),
['class' => 'form-control','prompt'=>'--Província--',
 'onchange'=>'$.post("lists.dreams?id='.'"+$(this).val(), function(data) {
    $("select#beneficiarios-district_code").html(data);
 });',
]); ?>

</div>

    <div class="col-lg-4"> 

    <label class="control-label" for="beneficiarios-district_code">Distrito</label>
<?= Html::activeDropDownList($model, 'district_code', ArrayHelper::map(Distritos::find()->all(), 'district_code', 'district_name'),
['class' => 'form-control','prompt'=>'--Distrito--',
  'onchange'=>'$.post("localidades.dreams?id='.'"+$(this).val(), function(data) {
    $("select#beneficiarios-membro_localidade_id").html(data);
 });',
]);  ?> 

</div>
	    <div class="col-lg-4"> 
	   <label class="control-label" for="beneficiarios-membro_localidade_id">Posto Administrativo</label>
  <?= Html::activeDropDownList($model, 'membro_localidade_id', ArrayHelper::map(ComiteLocalidades::find()->all(), 'id', 'name'),
  ['class' => 'form-control','prompt'=>'--Posto Administrativo--',
  'onchange'=>'$.post("bairros.dreams?id='.'"+$(this).val(), function(data) {
    $("select#beneficiarios-bairro_id").html(data);
  });',
  ]);  ?> 
</div>
	<?php } ?>
</div>
	  <div class="row"> 
		  <div class="col-lg-12">&nbsp; </div>
	  </div>
 <div class="row">

   <div class="col-lg-4">  
<?= $form->field($model, 'emp_gender')->radioButtonGroup([1 => 'M', 2 => 'F']); ?>  
    </div>
	   <div class="col-lg-8">
      <?= $form->field($model, 'ponto_entrada')->radioButtonGroup([1 => 'US', 2 => 'CM', 3 => 'ES']); ?>
     </div>

</div>

</div>
 </div>


</div>

	
 <div class="col-lg-6"> 

<div class="panel panel-success">
  <div class="panel-heading"> 
  <b><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Critérios de Eligibilidade Gerais</b>
  </div>
  <div class="panel-body">

<div class="row"> 
  <?php if(!$model->isNewRecord&&$model->emp_gender==2) { ?>
    <div class="col-lg-4">
  <?php } else {?>  <div class="col-lg-6"> <?php }?>

    <?php
    if(isset(Yii::$app->user->identity->provin_code)&&(Yii::$app->user->identity->provin_code>0)&&
    isset(Yii::$app->user->identity->district_code)&&(Yii::$app->user->identity->district_code>0)&&
    isset(Yii::$app->user->identity->localidade_id)&&(Yii::$app->user->identity->localidade_id>0))
    {
      echo  $form->field($model, 'bairro_id')->widget(Select2::classname(), [
      'data' => ArrayHelper::map(Bairros::find()->where(['distrito_id'=>Yii::$app->user->identity->district_code])->asArray()->orderBy('name ASC')->all(), 'id', 'name'),'options' => ['placeholder' => 'Selecione o Bairro'],
      'pluginOptions' => [
                      'allowClear' => true
                  ],
      ]);
} else {
  echo  $form->field($model, 'bairro_id')->widget(Select2::classname(), [
'data' => ArrayHelper::map(Bairros::find()->asArray()->orderBy('name ASC')->all(), 'id', 'name'),'options' => ['placeholder' => 'Selecione o Bairro'],
'pluginOptions' => [
              'allowClear' => true
          ],
]);
} ?>

    <?php /* echo  $form->field($model, 'bairro_id')->widget(Select2::classname(), [
'data' => ArrayHelper::map(Bairros::find()->asArray()->orderBy('name ASC')->all(), 'id', 'name'),'options' => ['placeholder' => 'Selecione o Bairro'], 
    'pluginOptions' => [
                    'allowClear' => true
                ],
]);*/
?> 
  </div>

  <?php if(!$model->isNewRecord&&$model->emp_gender==2) { ?>
    <div class="col-lg-4">
  <?php } else {?>  <div class="col-lg-6"> <?php }?>

 <?= $form->field($model, 'encarregado_educacao')->widget(Select2::classname(), [
'data' =>['Pais'=>'Pais','Avós'=>'Avós','Parceiro'=>'Parceiro','Sozinho'=>'Sozinho','Outros familiares'=>'Outros familiares'],
	'options' => ['multiple'=>'multiple' ,'placeholder' => 'Selecione aqui'],
    'pluginOptions' => [
                    'allowClear' => true
                ],
]);
?>
  </div>

<?php if(!$model->isNewRecord&&$model->emp_gender==2) { ?>
  <div class="col-lg-4">
  <?= $form->field($model, 'house_sustainer')->checkBox([1 => 'SIM', 0 => 'NÃO']); ?>
  </div>
<?php } ?>



  </div>

<div class="row">
   <div class="col-lg-6"> 

<?php 	
if(isset(Yii::$app->user->identity->provin_code)&&(Yii::$app->user->identity->provin_code>0)&&
isset(Yii::$app->user->identity->district_code)&&(Yii::$app->user->identity->district_code>0)&&
isset(Yii::$app->user->identity->localidade_id)&&(Yii::$app->user->identity->localidade_id>0))
{ 
	   
	   
	 echo  $form->field($model, 'us_id')->widget(Select2::classname(), [
'data' => ArrayHelper::map(Us::find()->where(['distrito_id'=>Yii::$app->user->identity->district_code])->asArray()->asArray()->orderBy('name ASC')
->all(), 'id', 'name'),'options' => ['placeholder' => 'Local mais Proximo'],
    'pluginOptions' => [
                    'allowClear' => true
                ],
])->label(false);    
	   
} /*elseif(!$model->isNewRecord) {

    if($model->ponto_entrada==1&&$model->district_code>0)    {
 echo  $form->field($model, 'us_id')->widget(Select2::classname(), [
'data' => ArrayHelper::map(Us::find()->where(['distrito_id'=>$model->district_code])->asArray()->asArray()->orderBy('name ASC')
->all(), 'id', 'name'),'options' => ['placeholder' => 'US mais Proxima'],
    'pluginOptions' => [
                    'allowClear' => true
                ],
])->label(false); }
elseif($model->ponto_entrada==2)
{


} else

{}


}*/ else { }   
	   
	   
?>
	   
	   
	   
	   
 </div> 
 <div class="col-lg-6"> 
 
 </div>
  </div>

<div class="row">

  <div class="col-lg-6" align="right"> 
  <?=  $form->field($model, 'estudante')->checkBox([1 => 'SIM', NULL => 'NÃO']); ?>
 <?php //$form->field($model, 'estudante')->textInput(); ?>
 </div>
  <div class="col-lg-6" align="left">  
<?php $form->field($model, 'estudante_classe')->textInput(['placeholder'=>'Se SIM, que classe (frequenta ou frequentou)'])->label(false); ?>
  <?= $form->field($model, 'estudante_classe')->dropDownList(array_combine(range(1, 12), range(1, 12)),array(
        'prompt'=>'Se SIM, que classe (frequenta ou frequentou)',
        'class' => 'form-control',
    ),['onchange'=>''])->label(false) ?>
</div>
  </div>
<div class="row">

  <div class="col-lg-6"> 
</div>
  <div class="col-lg-6">  
  <?= $form->field($model, 'estudante_escola')->textInput(['placeholder'=>'Nome da Instituição de Ensino'])->label(false); ?>
 
  </div>
  
  </div>

<div class="row">
  <div class="col-lg-6"  align="right"> 
  <?= $form->field($model, 'deficiencia')->checkBox([1 => 'SIM', 0 => 'NÃO']); ?>
 </div>

  <div class="col-lg-6"  align="left">
   <?php $form->field($model, 'deficiencia_tipo')->textInput(['placeholder'=>'Deficiência (fisica/mental), especifique'])->label(false); ?>
<?=  $form->field($model, 'deficiencia_tipo')->widget(Select2::classname(), ['data' => ['' => '--Tipo de Deficiência--','Não Anda' => 'Não Anda',
'Não Fala' =>'Não Fala',
'Não Vê'=>'Não Vê',
'Não Ouve'=>'Não Ouve',
'Tem Algum Membro Amputado ou Deformado'=>'Tem Algum Membro Amputado ou Deformado',
'Tem Algum atraso Mental'=>'Tem Algum atraso Mental'],
 ])->label(false); ?>
 </div>
 <div class="col-lg-1"></div>

  </div>
<?php if(!$model->isNewRecord&&$model->emp_gender==2) { ?>
<div class="row">

<div class="col-lg-4">
  <?= $form->field($model, 'married_before')->checkBox([1 => 'SIM', 0 => 'NÃO']
  , ['selected'=>1]); ?>
 </div>

  <div class="col-lg-4"> 
  <?= $form->field($model, 'gravida')->checkBox([1 => 'SIM', 0 => 'NÃO']
  , ['selected'=>1]); ?>
 </div>

  <div class="col-lg-4">
  <?= $form->field($model, 'filhos')->checkBox([1 => 'SIM', 0 => 'NÃO']); ?> 
 </div>
  </div>

<div class="row">
 <div class="col-lg-10">
 <?= $form->field($model, 'pregant_or_breastfeed')->checkBox([1 => 'SIM', 0 => 'NÃO']); ?>
</div>
  </div>

  <div class="row">
   <div class="col-lg-6">
<?=  $form->field($model, 'employed')->widget(Select2::classname(),
['data' => ['0' => 'Não Trabalha','1' => 'Empregada Doméstica','2' => 'Babá (Cuida das Crianças)','3' => 'Outros'],
'options' => ['placeholder' => '--Selecione Aqui--'],
'pluginOptions' => ['allowClear' => true],
 ]); ?>
</div>

<div class="col-lg-6">
<?=  $form->field($model, 'tested_hiv')->widget(Select2::classname(),
['data' => ['0' => 'Não','1' => 'SIM (>3 meses)','2' => 'SIM (<3 meses)'],
'options' => ['placeholder' => '--Selecione Aqui--'],
'pluginOptions' => ['allowClear' => true],
 ]); ?>
</div>
</div>



<?php } ?>

  </div>
  </div>



  </div>
</div>

<div class="row">
  <div class="col-lg-6">   

<div class="panel panel-success">
  <div class="panel-heading"> 
  <b><span class="glyphicon glyphicon-phone-alt" aria-hidden="true"></span> Contactos</b>
  </div>
  <div class="panel-body">
 <div class="card card-block">
<div class="row">  
<div class="col-lg-6">
<?= $form->field($model, 'emp_nick_name', [
    'addon' => ['prepend' => ['content'=>'<i class="glyphicon glyphicon-user"></i>']]])->textInput(['maxlength' => 100]) ?>

   </div> 

<div class="col-lg-6"> 
<?= $form->field($model, 'emp_street1', [
    'addon' => ['prepend' => ['content'=>'<i class="glyphicon glyphicon-home"></i>']]
]);
 ?>  
</div> 

</div>
<div class="row">  

<div class="col-lg-6"> <?= $form->field($model, 'emp_mobile', [
    'addon' => ['prepend' => ['content'=>'<i class="glyphicon glyphicon-phone"></i>']]
]);

 ?> 
 </div>
	<div class="col-lg-6">  
<?= $form->field($model, 'emp_work_email', [
    'addon' => ['prepend' => ['content'=>'@']]
]);

 ?>
</div>
	
 </div>
 <div class="row"> 
<div class="col-lg-12">
<?php $form->field($model, 'emp_street2')->textArea(['rows' => '3']) ?>

	<?php if(isset(Yii::$app->user->identity->role)&&Yii::$app->user->identity->role==20) { ?>

<?php if($model->isNewRecord) { ?>
	<?= $form->field($model, 'emp_status')->radioButtonGroup([1 => ' Activo', 0 => ' Inactivo']); ?>
  <?php } else { //Novo ?>
    <?= $form->field($model, 'emp_status')->radioButtonGroup([1 => ' Activo', 0 => ' Inactivo', 2 => ' Transferido', 3 => ' Óbito',25=>' Fora da Faixa Etária']); ?>
    <?php } ?>



 <?php } else {?>
	
<input type="hidden" value="1" id="beneficiarios-emp_status" class="form-control" name="Beneficiarios[emp_status]"> 
	<?php } ?>
</div>
</div>

 </div>

    </div>
</div>

</div>





<?php if(!$model->isNewRecord&&$model->emp_gender==2) { ?> <div class="col-lg-6">
<div class="panel panel-danger">
  <div class="panel-heading">
  <b><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> Critérios de Eligibilidade Específicos</b>
  </div>
  <div class="panel-body">
<table>
  
    <tr> <td align="right">Sexualmente Activa?</td><td>&nbsp;</td><td>&nbsp;<?=  $form->field($model,'vbg_sexual_activa')->widget(Select2::classname(),['data' => ['0' => 'Não','1' => 'SIM'],'options' => ['placeholder' => '--Selecione Aqui--'],'pluginOptions' => ['allowClear' => true],])->label(false); ?></td></tr>
 <tr> <td align="right">Relações Múltiplas e Concorrentes?</td><td>&nbsp;</td><td>&nbsp;<?=  $form->field($model, 'vbg_relacao_multipla')->widget(Select2::classname(),['data' => ['0' => 'Não','1' => 'SIM'],'options' => ['placeholder' => '--Selecione Aqui--'],'pluginOptions' => ['allowClear' => true],])->label(false); ?></td></tr>
 

  <tr> <td align="right">Migrante?</td>
    <td>&nbsp;</td><td><?=  $form->field($model,'vbg_migrante_trafico')->widget(Select2::classname(),['data' => ['0' => 'Não','1' => 'SIM'],'options' => ['placeholder' => '--Selecione Aqui--'],'pluginOptions' => ['allowClear' => true],
   ])->label(false); ?></td></tr>
 <tr> <td align="right">Vítima de Tráfico?</td>
     <td>&nbsp;</td><td><?=  $form->field($model,'vbg_vitima_trafico')->widget(Select2::classname(),['data' => ['0' => 'Não','1' => 'SIM'],'options' => ['placeholder' => '--Selecione Aqui--'],'pluginOptions' => ['allowClear' => true],
    ])->label(false); ?></td></tr>
  
    <tr> <td align="right" width="60%">Vítima de Exploração sexual?</td> <td width="10%">&nbsp;</td><td>&nbsp;<?=  $form->field($model, 'vbg_exploracao_sexual')->widget(Select2::classname(),
['data' => ['0' => 'Não','1' => 'SIM'],'options' => ['placeholder' => '--Selecione Aqui--'],'pluginOptions' => ['allowClear' => true],])->label(false); ?></td></tr>


  <?php if($model->idade_anos>=18) {?>
<tr> <td align="right" width="60%">Trabalhadora de Sexo?</td> <td width="10%">&nbsp;</td><td>&nbsp;<?=  $form->field($model, 'vbg_sex_worker')
->widget(Select2::classname(),['data' => ['0' => 'Não','1' => 'SIM'],'options' => ['placeholder' => '--Selecione Aqui--'],'pluginOptions' => ['allowClear' => true],])->label(false); ?></td></tr>
<?php }?>
  
  <tr> <td align="right">Vítima de Violéncia Baseada no Gênero?</td><td>&nbsp;</td><td>&nbsp;<?=  $form->field($model, 'vbg_vitima')->widget(Select2::classname(),['data' => ['0' => 'Não','1' => 'SIM'],'options' => ['placeholder' => '--Selecione Aqui--'],'pluginOptions' => ['allowClear' => true],])->label(false); ?></td></tr>
</table>
    
    
</div>
 </div>
</div> <?php }?>


<div class="col-lg-6">
<div class="panel panel-success">
  <div class="panel-heading"> 
  <b><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> Outras Informações</b>
  </div>
  <div class="panel-body">

<?= $form->field($model, 'parceiro_id', [
    'addon' => ['prepend' => ['content'=>'<i class="fa fa-male"></i>']]])->textInput(['maxlength' => 15,'placeholder'=>'NUI do Parceiro do Beneficiario']) ?>
	  <?php $model->isNewRecord ?'': $form->field($model, 'via')->checkBox([1 => 'SIM', NULL => 'NÃO']); ?>
</div> 
 </div>

</div>
</div>






    <div class="form-group">
         <?= Html::a('<i class="glyphicon glyphicon-backward"></i>', ['index'], ['class' => 'btn btn-warning']) ?>   
        <?= Html::submitButton($model->isNewRecord ? 'Salvar' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'disabled'=>false]) ?>
    </div>


  <?php ActiveForm::end(); ?>
</div>

<!-- <div class="input-group date">
    <input class="form-control"  type="date" date-date-format="mm/dd/yyyy">
    <div class="input-group-addon">
        <span class="glyphicon glyphicon-th"></span>
    </div>
</div>

<input type="text" name="input" placeholder="YYYY-MM-DD" required 
pattern="(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])/(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])/(?:30))|(?:(?:0[13578]|1[02])-31))" title="Enter a date in this format YYYY/MM/DD"/>
-->

<?php

 MaskedInput::widget([
    'name' => 'input-32',
    'clientOptions' => ['alias' =>  'mm/dd/yyyy']
]);

?>
