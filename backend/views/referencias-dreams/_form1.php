<?php

use yii\helpers\Html;

use app\models\ReferenciasDreams;


use yii\bootstrap\Modal;
use kartik\form\ActiveForm;
use dektrium\user\models\Profile;
use kartik\widgets\DepDrop;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use common\models\User;
use \kartik\widgets\Select2;
use app\models\Beneficiarios;
use app\models\Parceiros;
use app\models\Us;
use app\models\ReferenciasPontosDreams;
use app\models\Organizacoes;
use app\models\ServicosDream;  //para seleccao de intervensoes
/* @var $this yii\web\View */
/* @var $model app\models\ReferenciasDreams */
/* @var $form yii\widgets\ActiveForm */
$pontos= new ReferenciasPontosDreams();
?>


<div class="referencias-dreams-form">


    <div class="panel-body">




      <?php if (isset(Yii::$app->user->identity->provin_code)&&Yii::$app->user->identity->provin_code>0) { ?>

    <?php $form = ActiveForm::begin(); ?>

		<?php
			//reiniciar variaveis
			$model->refer_to = 'US';
			$model->status = 1;
		?>

    <div class="row">
      <div class="col-lg-4">
    <?php
    if($model->isNewRecord) {
$conta = 1+ReferenciasDreams::find()->where(['criado_por' => Yii::$app->user->identity->id])->count();
if (strlen(utf8_decode($conta))==1) {$conta='00'.$conta;}
elseif(strlen(utf8_decode($conta))==1) { $conta='0'.$conta;}

  echo  $form->field($model, 'nota_referencia')
    ->textInput(['maxlength' => true, 'value'=>'REFDR'.Yii::$app->user->identity->id.Yii::$app->user->identity->provin_code.$conta,'readOnly'=> true]);

} else {
 echo  $form->field($model, 'nota_referencia')->textInput(['readOnly'=> true]);

}
    ?>
 </div>



 <div class="col-lg-4">

<?php if(!$model->isNewRecord) {


} else {



}?>



    <?php

if($model->isNewRecord) {

if (isset($_REQUEST['ben'])&&($_REQUEST['ben']>0)) {

 $bens=Beneficiarios::find() ->where(['=','id',$_REQUEST['ben']])->count();
if($bens>0) {
  ?>
<label class="control-label" for="referenciasdreams-beneficiario_id">Nº de Beneficiário</label>

<?php
echo  Html::activeDropDownList($model, 'beneficiario_id', ArrayHelper::map(Beneficiarios::find()
     ->where(['=','id',$_REQUEST['ben']])
     ->all(), 'emp_number', 'member_id'),
     ['class' => 'form-control','readOnly'=> true]);
   } else {
echo $form->field($model, 'beneficiario_id')->textInput(['readOnly' => true, 'placeholder'=>'000001']);

   }

   }
 else {
echo $form->field($model, 'beneficiario_id')->textInput(['maxlength' => true, 'placeholder'=>'000001']);

 }

}
   else { ?>
     <label class="control-label" for="referenciasdreams-beneficiario_id">Nº de Beneficiário</label>

  <?= Html::activeDropDownList($model, 'beneficiario_id', ArrayHelper::map(Beneficiarios::find()
    ->where(['=','provin_code',Yii::$app->user->identity->provin_code])
    ->all(), 'emp_number', 'member_id'),
    ['class' => 'form-control','readOnly'=> true]);
}
     ?>
</div>
		<div class="col-lg-4">
  <label class="control-label" for="referenciasdreams-referido_por">Referente</label>
    <?php
if($model->isNewRecord) { ?>
    <?= Html::activeDropDownList($model, 'referido_por', ArrayHelper::map(Profile::find()
    ->where(['=','user_id',Yii::$app->user->identity->id])
    ->all(), 'user_id', 'name'),
    ['class' => 'form-control','readOnly'=> true]); ?>
<?php } else {

echo  Html::activeDropDownList($model, 'referido_por', ArrayHelper::map(Profile::find()
  ->where(['=','user_id',$model->referido_por])
  ->all(), 'user_id', 'name'),
  ['class' => 'form-control','readOnly'=> true]);
}
  ?>
</div>

 <div class="col-lg-6">
<?php
	/*if($model->isNewRecord) {

if (isset($_REQUEST['ben'])&&($_REQUEST['ben']>0)) {

 $bens=Beneficiarios::find() ->where(['=','id',$_REQUEST['ben']])->count();
if($bens>0) { */
  ?>
<!--<label class="control-label" for="referenciasdreams-beneficiario_id">Nome do Beneficiário</label>-->

<?php /*
echo  Html::activeDropDownList($model, 'beneficiario_id', ArrayHelper::map(Beneficiarios::find()
     ->where(['=','id',$_REQUEST['ben']])
     ->all(), 'emp_number', 'emp_firstname'),
     ['class' => 'form-control','readOnly'=> true]);
   } else {

//nada
   }

   }
 else {
//nada

 }

} else {
	//Update User

	$bens=Beneficiarios::find() ->where(['=','id',$_REQUEST['id']])->count();
if($bens>0) {
  ?>
<label class="control-label" for="referenciasdreams-beneficiario_id">Nome do Beneficiário</label>

<?php
echo  Html::activeDropDownList($model, 'beneficiario_id', ArrayHelper::map(Beneficiarios::find()
     ->where(['=','id',$_REQUEST['ben']])
     ->all(), 'emp_number', 'emp_firstname'),
     ['class' => 'form-control','readOnly'=> true]);
   } else {
//ID nao existe no Update
}





	} */?>

</div>
</div>
		<hr>

<div class="row">
  <div class="col-lg-4">

	  <?= $form->field($model, 'refer_to')->radioButtonGroup(['US' => ' Unidade Sanitária', 'CM' => ' Comunidade']); ?>
	</div>
  <div class="col-lg-4"> <?= $form->field($model, 'num_livro')->textInput(['placeholder'=>'Nº do Livro','class' => 'form-control','maxlength' => true])->label(false) ?></div>
  <div class="col-lg-4"> <?= $form->field($model, 'ref_livro')->textInput(['placeholder'=>'Códido de Referência no livro','class' => 'form-control','maxlength' => true])->label(false) ?></div>
</div>




		<div class="row">
			<div class="col-lg-4">
				<?= $form->field($model, 'servico_id')->dropDownList([ '1' => ' Clinico','2' =>' Comunitário']); ?>
			</div>
			<div class="col-lg-4">

				   <?= $form->field($model, 'projecto')->widget(Select2::classname(), [
       'data' => ArrayHelper::map(Organizacoes::find()
       ->where(['>','distrito_id',0])
       ->asArray()->all(), 'abreviatura', 'name')
   ], ['id' => 'projecto', 'onchange' => 'if($(this).val() != 1) {
                    $("#'.Html::getInputId($model, 'description').'").val($(this).val());
                }
                else if($(this).val() == 2) {
                    $("#'.Html::getInputId($model, 'description').'").val($(this).val());
                } else if($(this).val() == 3){
                    $("#'.Html::getInputId($model, 'description').'").val($(this).val());
                }
   ']);
   ?>
				    <?php $form->field($model, 'projecto')
   ->radioButtonGroup(
   ['PCC' => 'PCC',
   'CHASS'=> 'CHASS',
   'TB CARE'=>'TB CARE',
   'ESTRADA'=>'ESTRADA',
   'Outro'=>'Outro',
   ], ['id' => 'projecto', 'onchange' => 'if($(this).val() != 1) {
                    $("#'.Html::getInputId($model, 'description').'").val($(this).val());
                }
                else if($(this).val() == 2) {
                    $("#'.Html::getInputId($model, 'description').'").val($(this).val());
                } else if($(this).val() == 3){
                    $("#'.Html::getInputId($model, 'description').'").val($(this).val());
                }
   ']); ?>
		</div>

		<div class="col-lg-4">
	 <?= $form->field($model, 'intervensao')->widget(Select2::classname(), [
      'data' => ArrayHelper::map(ServicosDream::find()->orderBy('name ASC')->asArray()->all(), 'id', 'name'),
      'options' => ['multiple'=>'multiple' ,'placeholder' => 'Selecione os Servicos'],
      'pluginOptions' => ['allowClear' => true],
  ]);
  ?>

    <?php $form->field($model, 'intervensao')->widget(Select2::classname(), [
   'data' =>['PREP'=>'PREP'],
   	'options' => ['multiple'=>'multiple' ,'placeholder' => 'Selecione aqui'],
       'pluginOptions' => [
                       'allowClear' => true
                   ],
   ]);
   ?>




</div>



			</div>

<div class="row">
 <!-- <div class="col-lg-3">
 <?php //$form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?php //$form->field($model, 'projecto')->textInput(['maxlength' => true,'placeholder'=>'Nome do Projecto']) ?>

    </div>-->

<div class="col-lg-12">
	<!-- DropList de notificados -->
    <?php /*  $form->field($model, 'notificar_ao')->textInput();*/ ?>
<!-- <label class="control-label" for="referenciasdreams-notificar_ao">Notificar ao</label>-->
<?php /* Html::activeDropDownList($model, 'notificar_ao', ArrayHelper::map(User::find()
->where(['=','provin_code',Yii::$app->user->identity->provin_code])
  ->andWhere(['<>','id',Yii::$app->user->identity->id])
->all(), 'id', 'email'),
['class' => 'form-control']); */?>

<?php /* $form->field($model, 'notificar_ao')->widget(Select2::classname(), [
'data' => ArrayHelper::map(User::find()
->where(['=','provin_code',Yii::$app->user->identity->provin_code])
->andWhere(['<>','id',Yii::$app->user->identity->id])->orderBy('email ASC')
->all(), 'id', 'email'),'options' => ['placeholder' => 'Selecione ...'],
  'pluginOptions' => [
                  'allowClear' => true
              ],
])->label(false);*/  ?>

	<?=  $form->field($model, 'notificar_ao')->widget(Select2::classname(), [
'data' => ArrayHelper::map(User::find()
->where(['=','provin_code',Yii::$app->user->identity->provin_code])
->andWhere(['<>','id',Yii::$app->user->identity->id])->orderBy('email ASC')
->all(), 'id', 'email'),'options' => ['placeholder' => 'Selecione ...'],
  'pluginOptions' => [
                  'allowClear' => true
              ],
]);  ?>
    </div>
    </div>

    <div class="row">
   <div class="col-lg-12">

      <?php
/*
  echo     $form->field($pontos, 'receptor_id')->widget(Select2::classname(), [
    'data' =>ArrayHelper::map(Us::find()
    ->where(['=','provincia_id',Yii::$app->user->identity->provin_code])
  //  ->andWhere(['<>','id',Yii::$app->user->identity->us_id])->orderBy('name ASC')
    ->all(), 'id', 'name'),
    	'options' => ['multiple'=>'multiple' ,'placeholder' => 'Encaminhar para...'],

        'pluginOptions' => [
                        'allowClear' => true
                    ],
    ])->label(false);
*/

    ?>




     <?= $form->field($model, 'description')->textArea(['maxlength' => true, 'rows' => '3']) ?>

   <?= $form->field($model, 'status')->radioButtonGroup([1 => ' Activo', '0' => ' Cancelado']); ?>
	   <?php $form->field($model, 'status')->dropDownList(['0' => ' Cancelado','value' => !empty($model->status) ? $model->status : 1]); ?>
   </div>
   </div>



    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Enviar Referencia') : Yii::t('app', 'Actualizar'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

    <?php } else {?>
  <div class="row">
      <div class="alert alert-warning">
  <strong>Aten&ccedil;&atilde;o!</strong>
  A sua conta de Utilizador n&atilde;o tem acesso a esta fun&ccedil;&atilde;o.
  <?= Html::a('<i class="glyphicon glyphicon-backward"></i> Voltar', ['site/index'], ['class' => 'btn btn-success']) ?>
  </div>

  </div>

    <?php } ?>




</div>

</div>
