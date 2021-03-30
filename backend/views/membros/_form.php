<?php

use yii\helpers\Html;

use kartik\widgets\DepDrop;
use \kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use app\models\ComiteProvincial;
use app\models\ComiteDistrital;
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
/* @var $this yii\web\View */
/* @var $model app\models\Membros */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="membros-form">




    <?php $form = ActiveForm::begin(); ?>

<?php  round((strtotime(Date('d-m-Y'))-strtotime($model->emp_birthday))/31556926,0)<18; 

?>
<div class="row">

    <div class="col-lg-4">   
    <?= $form->field($model, 'provin_code')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(ComiteProvincial::find()->orderBy('name ASC')->where('status IS NOT NULL')->asArray()->all(), 'id', 'name')
]);
?> 
</div>

    <div class="col-lg-4"> <?= 
        
// Child level 1
 $form->field($model, 'district_code')->widget(DepDrop::classname(), [
    'data'=> ArrayHelper::map(ComiteDistrital::find()->orderBy('name ASC')->asArray()->all(), 'id', 'name'),
    'options' => ['placeholder' => 'Select ...'],
    'type' => DepDrop::TYPE_SELECT2,
    'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
    'pluginOptions'=>[
        'depends'=>['membros-provin_code'],
        'url' => Url::to(['/account/child-account']),
        'loadingText' => 'Loading child level 1 ...',
    ]
]);

?>    </div>
    <div class="col-lg-4"> 

    <?= // Child level 1
 $form->field($model, 'city_code')->widget(DepDrop::classname(), [
    'data'=> ArrayHelper::map(ComiteCidades::find()->orderBy('name ASC')->asArray()->all(), 'id', 'name'),
    'options' => ['placeholder' => 'Select ...'],
    'type' => DepDrop::TYPE_SELECT2,
    'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
    'pluginOptions'=>[
        'depends'=>['membros-provin_code'],
        'url' => Url::to(['/account/child-account']),
        'loadingText' => 'Loading child level 1 ...',
    ]
]);
?> 
        
    </div>
</div>




<div class="row">
   <div class="col-lg-4">
<?php
/*
echo AutoComplete::widget([
    'model' => $model,
    'options' => ['class'=>'form-control'],
    'attribute' => 'emp_nick_name',
    'clientOptions' => [
        'source' => ['USA', 'RUS'],
    ],
]);
*/
?>

    <?= $form->field($model, 'membro_zona')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(ComiteZonal::find()->orderBy('name ASC')->asArray()->all(), 'id', 'name')
]);
?> 
   </div>

    <div class="col-lg-4">
     <div class="input-group input-group" align="left">     
     <?= $form->field($model, 'membro_circulo')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(ComiteCirculos::find()->orderBy('name ASC')->asArray()->all(), 'id', 'name')
]);
?>
<a href="<?php echo Url::toRoute('comite-circulos/create'); ?>" class="fa fa-plus-circle fa-green"  style="color:green;"> Adicionar Círculo</a>
</div>
</div>

    <div class="col-lg-4">   
 <div class="input-group input-group">   

 <?= $form->field($model, 'membro_celula')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(ComiteCelulas::find()->orderBy('name ASC')->asArray()->all(), 'id', 'name')
]);
?> <a href="<?php echo Url::toRoute('comite-celulas/create'); ?>" class="fa fa-plus-circle fa-green"  style="color:green;"> Adicionar Celula</a>
</div>
</div>
</div>



  
  



<div class="row">


    <div class="col-lg-4"> 
    <?= 
    $model->isNewRecord ?  
    $form->field($model, 'member_id')->textInput( ['disabled' => false]): 
    $form->field($model, 'member_id')->textInput(Yii::$app->user->identity->role==20 ? '': ['disabled' => false]); ?>
    </div>
 <div class="col-lg-4"> 
 <?=   $form->field($model, 'membro_data_admissao')->widget(DatePicker::classname(), [
   // 'options' => ['placeholder' => 'Data de Nascimento ...'],
    'language' => 'pt',
    'pluginOptions' => [
        'autoclose'=>true
    ]
]);  
?>

 </div>    <div class="col-lg-4"> <?= $form->field($model, 'membro_caratao_eleitor')->textInput(['maxlength' => 50]) ?></div>   



</div>

<div class="row">  
<div class="col-lg-4">  <?= $form->field($model, 'emp_lastname')->textInput(['maxlength' => 100]) ?></div>
<div class="col-lg-4"> <?= $form->field($model, 'emp_middle_name')->textInput(['maxlength' => 100]) ?></div>
<div class="col-lg-4"> <?= $form->field($model, 'emp_firstname')->textInput(['maxlength' => 100]) ?></div>
 </div>   

   
  <div class="row">  
<div class="col-lg-4">
<?= 

 $form->field($model, 'emp_birthday')->widget(DatePicker::classname(), [
    'options' => ['placeholder' => 'Data de Nascimento ...'],
    'language' => 'pt',
    'pluginOptions' => [
        'autoclose'=>true
    ]
]);

?> </div>
<div class="col-lg-4">
    <?= $form->field($model, 'nation_code')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(ComiteNacionalidade::find()->orderBy('name ASC')->where('status IS NOT NULL')->asArray()->all(), 'id', 'name')
]);
?> 

</div>
<div class="col-lg-4">

    <label class="control-label" for="comite-celulas-subordinado_id">Cargo no Partido</label>
<?php 
 if($model->isNewRecord)
 {   echo  Select2::widget([
    'name' => 'Membros[membro_cargo_partido_id]',
    'value' => 1, // value to initialize
    'data' => ArrayHelper::map(TipoCargos::find()->orderBy('name ASC')->all(), 'id', 'name'),
    'options' => ['multiple' => false,  'class' => 'form-group', 'placeholder' => 'Selecione o Cargo no Partido...'],
]);

} else {
?>

<?php
echo  Select2::widget([
    'name' => 'Membros[membro_cargo_partido_id]',
    'value' => $model->membro_cargo_partido_id, // value to initialize
    'data' => ArrayHelper::map(TipoCargos::find()->orderBy('name ASC')->all(), 'id', 'name'),
    'options' => ['multiple' => false,   'placeholder' => 'Selecione o Cargo no Partido...'],
]);


}?>
</div></div>


<div class="row"> 



<div class="col-lg-4">
<?= $form->field($model, 'emp_military_service')->radioButtonGroup([1 => 'Regularizado', 0 => 'Não Regularizado']); ?>
</div>



<div class="col-lg-4">
<br><?= $form->field($model, 'emp_gender')->radioButtonGroup([1 => 'Masculino', 2 => 'Feminino']); ?>
</div>
 <div class="row">&nbsp;</div> 
 </div> 






<div class="row">&nbsp;</div>
<ul class="nav nav-tabs">
  <li class="active"><a data-toggle="tab" href="#docs">Documentos</a></li>
  <li><a data-toggle="tab" href="#profissao">Dados Profissionais</a></li>
  <li><a data-toggle="tab" href="#contactos">Contactos</a></li>
  <li><a data-toggle="tab" href="#quotas">Quotas</a></li>
  <li><a data-toggle="tab" href="#osp">OSP</a></li>
  <li><a data-toggle="tab" href="#cargos">Cargos no Estado</a></li>
  <li><a data-toggle="tab" href="#foto">Fotografia</a></li>
</ul>

<div class="tab-content">
  <div id="docs" class="tab-pane fade in active">
       <div class="card card-block">
   
<div class="row">  
<div class="col-lg-4"> 
<?= $form->field($model, 'nuit')->textInput(['maxlength' => 100]) ?>
<div class="col-sm-12"> <?php $form->field($model, 'custom8')->textInput(['maxlength' => 100]) ?></div>
    <div class="col-sm-12"> 
<?php $form->field($model, 'nuit_data_i')->widget(DatePicker::classname(), [
    'options' => ['placeholder' => 'Data de Emissão...', 'dateFormat' => 'dd-MM-YYYY'],
    'pluginOptions' => [
        'autoclose'=>true
    ]
])->label(false);
 ?>
</div>
<div class="col-sm-12">

<?php $form->field($model, 'nuit_data_f')->widget(DatePicker::classname(), [
    'options' => ['placeholder' => 'Data de Validade...'],
    'pluginOptions' => [
        'autoclose'=>true
    ]
])->label(false); ?>
 </div>
</div>

<div class="col-lg-4">  <?= $form->field($model, 'bi')->textInput(['maxlength' => 100]) ?>
<div class="col-sm-12"> <?= $form->field($model, 'custom7')->textInput(['maxlength' => 100]) ?></div>
<div class="col-sm-12"> 
<?= $form->field($model, 'bi_data_i')->widget(DatePicker::classname(), [
    'options' => ['placeholder' => 'Data de Emissão...', 'dateFormat' => 'dd-MM-YYYY'],
    'pluginOptions' => [
        'autoclose'=>true
    ]
])->label(false);
 ?>
</div>
<div class="col-sm-12">

<?= $form->field($model, 'bi_data_f')->widget(DatePicker::classname(), [
    'options' => ['placeholder' => 'Data de Validade...', 'dateFormat' => 'dd-MM-YYYY'],
    'pluginOptions' => [
        'autoclose'=>true
    ]
])->label(false); ?>
 </div>

</div>

<div class="col-lg-4"> 
<?= $form->field($model, 'passaporte')->textInput(['maxlength' => 100]) ?>
<div class="col-sm-12"> <?= $form->field($model, 'custom9')->textInput(['maxlength' => 100]) ?></div>
    <div class="col-sm-12"> 
<?= $form->field($model, 'bi_data_i')->widget(DatePicker::classname(), [
    'options' => ['placeholder' => 'Data de Emissão...', 'dateFormat' => 'dd-MM-YYYY'],
    'language' => 'pt',
    'pluginOptions' => [
        'autoclose'=>true
    ]
])->label(false);
 ?>
</div>
<div class="col-sm-12">

<?= $form->field($model, 'bi_data_f')->widget(DatePicker::classname(), [
    'options' => ['placeholder' => 'Data de Validade...', 'dateFormat' => 'dd-MM-YYYY'],
    'language' => 'pt',
    'pluginOptions' => [
        'autoclose'=>true
    ]
])->label(false); ?>
 </div>
</div>
</div>   

  </div>
  </div>


  <div id="profissao" class="tab-pane fade">
    <h3>Dados Profissionais</h3>
     <div class="card card-block">
    
<div class="row">

    <div class="col-lg-4">   
    <?= $form->field($model, 'sal_grd_code')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(Educacao::find()->orderBy('name ASC')->asArray()->all(), 'id', 'name'),'options' => ['placeholder' => 'Grau acadêmico'], 
    'pluginOptions' => [
                    'allowClear' => true
                ],
]);
?> 
</div>

    <div class="col-lg-4">   
    <?= $form->field($model, 'eeo_cat_code')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(JobCategory::find()->orderBy('name ASC')->asArray()->all(), 'id', 'name'),'options' => ['placeholder' => 'Área Profissional'], 
    'pluginOptions' => [
                    'allowClear' => true
                ],
]);
?> 
</div>

    <div class="col-lg-4">   
    <?= $form->field($model, 'job_title_code')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(TituloProfissional::find()->orderBy('job_title ASC')->asArray()->all(), 'id', 'job_title'),'options' => ['placeholder' => 'Título Profissional'], 
    'pluginOptions' => [
                    'allowClear' => true
                ],

]);
?> 
</div>

<div class="col-lg-8">
<?= $form->field($model, 'emp_street2')->textArea(['rows' => '3']) ?>

</div>
</div>


  </div>
</div>

  <div id="contactos" class="tab-pane fade">
    <h3>Contactos</h3>
      <div class="card card-block">
<div class="row">  
<div class="col-lg-4">
    <?php  echo  $form->field($model, 'membro_localidade_id')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(ComiteLocalidades::find()->asArray()->orderBy('name ASC')->all(), 'id', 'name'),'options' => ['placeholder' => 'Choisir une personne'], 
    'pluginOptions' => [
                    'allowClear' => true
                ],
]);

  
?>  </div> 

<div class="col-lg-4"> <?= $form->field($model, 'emp_nick_name', [
    'addon' => ['prepend' => ['content'=>'<i class="glyphicon glyphicon-user"></i>']]])->textInput(['maxlength' => 100]) ?>
    
</div> 

<div class="col-lg-4"> 
<?= $form->field($model, 'emp_street1', [
    'addon' => ['prepend' => ['content'=>'<i class="glyphicon glyphicon-home"></i>']]
]);
 ?>
    
</div> 

</div>
<div class="row">  
<div class="col-lg-4">  

<?= $form->field($model, 'emp_hm_telephone', [
    'addon' => ['prepend' => ['content'=>'<i class="glyphicon glyphicon-phone-alt"></i>']]
]);

 ?>
</div>
<div class="col-lg-4"> <?= $form->field($model, 'emp_mobile', [
    'addon' => ['prepend' => ['content'=>'<i class="glyphicon glyphicon-phone"></i>']]
]);

 ?> 
 </div>
<div class="col-lg-4"> <?= $form->field($model, 'emp_work_email', [
    'addon' => ['prepend' => ['content'=>'@']]
]);

 ?></div>
<div class="col-lg-8">
<?= $form->field($model, 'emp_street2')->textArea(['rows' => '3']) ?>

</div>


</div> 


  </div>
  </div>

<div id="quotas" class="tab-pane fade">
    <h3>Quotas</h3>
      <div class="card card-block">
   2016

      </div>
</div>


<div id="osp" class="tab-pane fade">
    <h3>OSP</h3>
      <div class="card card-block">
     
<?php
 $cargos = new ComiteCargos();

 ?>

<?= $form->field($model, 'custom8')->checkboxList(ArrayHelper::map(ComiteCargos::find()->all(), 'id', 'name'))->label(false) ?>




      </div>
</div>

<div id="cargos" class="tab-pane fade">
    <h3>Cargos no estado</h3>
      <div class="card card-block" style="overflow:scroll; height:200px;">

 <?= $form->field($model, 'id')->checkboxList(ArrayHelper::map(TipoCargos::find()->orderBy('name')->all(), 'id', 'name'))->label(false) ?>

      </div>
</div>
<div id="foto" class="tab-pane fade">
    <h3>Fotografia do Membro</h3>
      <div class="card card-block">
      <?=  $form->field($model, 'custom10')->widget(FileInput::classname(), [
    'options' => ['accept' => 'image/*'],
])->label(false); ?>

      </div>
</div>



</div>


    



<div class="col-lg-12">
<?= $form->field($model, 'emp_status')->radioButtonGroup([1 => ' Activo', 0 => ' Inactivo']); ?>
</div>

    <div class="form-group">
         <?= Html::a('<i class="glyphicon glyphicon-backward"></i>', ['index'], ['class' => 'btn btn-warning']) ?>   
        <?= Html::submitButton($model->isNewRecord ? 'Salvar' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'disabled'=>false]) ?>
    </div>

    <?php ActiveForm::end(); ?>





</div>
