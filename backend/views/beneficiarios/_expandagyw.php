<?php

use yii\helpers\Html;
use yii\widgets\DetailView;


use yii\helpers\Url;
use yii\bootstrap\Modal;
use kartik\widgets\DatePicker;
use kartik\form\ActiveForm;
use common\models\User;
use app\models\Educacao;
use app\models\TituloProfissional;
use app\models\ComiteProvincial;
use app\models\ComiteDistrital;
use app\models\ComiteNacionalidade;
use app\models\ComiteCidades;
use app\models\ComiteZonal;
use app\models\ComiteCirculos;
use app\models\ComiteCelulas;
use app\models\ComiteLocalidades;
use app\models\TipoCargos;
use app\models\JobCategory;
use app\models\ServicosBeneficiados;
use app\models\TipoServicos;

use app\models\ServicosDream;

if(!isset($model->member_id)) {  } else { $num=(int)$model->member_id;



?>


<div class="membros-view">

  <div class="col-lg-12">

  <div class="panel panel-success">
  <div class="panel-heading"><i class="fa fa-dashboard  text-primary"></i> <strong>
    Dados de Registo do Beneficiário:  <?= Html::encode($model->emp_number) ?> </strong></div>
  <div class="panel-body">
    <div class="row">


<!-- <div class="col-xs-5"> -->

  <!-- Total Services -->
  <div class="col-xs-12">
  <?php
  $tservicos= ServicosDream::find()->where(['=', 'status', 1])->count();
  $servicos= ServicosDream::find()->where(['=', 'status', 1])->all();
  $totalServicos=0;
  foreach ($servicos as $core) {
    $totalServicos = $totalServicos+ServicosBeneficiados::find()
     ->where(['=','beneficiario_id',$model->member_id])
     ->andWhere(['=', 'servico_id', $core->id])
     ->select('servico_id')->distinct()
     ->count();
  }

  ?>
	  
<!-- 
  <div  id="A<?= $num?>">
	  
	   <div class="inner-content text-center">
				<p><em>Cobertura Total</em></p>
                        <div class="c100 p<?php if ($tservicos==0) {echo 0;} else { echo  round(($totalServicos/$tservicos*100),1);} ?> center">
                            <span><?php if ($tservicos==0) {echo 0;} else { echo  round(($totalServicos/$tservicos*100),1);} ?>%</span>
                            <div class="slice"><div class="bar"></div><div class="fill"></div></div>
                        </div>                   
     </div>	  
  </div> -->


  </div>
  <!-- Fim Total Services-->

<!-- Core Services -->
<div class="col-xs-6">
<?php
$tcservicos= ServicosDream::find()->where(['core_service'=>1])->andWhere(['=', 'status', 1])->count();
$cservicos= ServicosDream::find()->where(['core_service'=>1])->andWhere(['=', 'status', 1])->all();
$coreServicos=0;
foreach ($cservicos as $core) {
  $coreServicos = $coreServicos+ServicosBeneficiados::find()
   ->where(['=','beneficiario_id',$model->member_id])
   ->andWhere(['=', 'servico_id', $core->id])
   ->andWhere(['=', 'status', 1])
   ->select('servico_id')->distinct()
   ->count();
}

?>

<!-- <div id="B<?= $num?>"> 

	   <div class="inner-content text-center">
				<p><em>Core-Services</em></p>
                        <div class="c100 p<?php if ($tcservicos==0) {echo 0;} else { echo  round(($coreServicos/$tcservicos*100),1);} ?> center">
                            <span><?php if ($tcservicos==0) {echo 0;} else { echo  round(($coreServicos/$tcservicos*100),1);} ?>%</span>
                            <div class="slice"><div class="bar"></div><div class="fill"></div></div>
                        </div>                   
     </div>	 	
		
	
		 </div> -->
</div>
<!-- Fim Core Services-->

<!-- Clinic Services -->
<div class="col-xs-6">
<?php
$tcliservicos= ServicosDream::find()->where(['servico_id'=>1])->andWhere(['=', 'status', 1])->count();
$cliservicos= ServicosDream::find()->where(['servico_id'=>1])->andWhere(['=', 'status', 1])->all();
$cliServices=0;
foreach ($cliservicos as $core) {

  $cliServices = $cliServices+ServicosBeneficiados::find()
   ->where(['=','beneficiario_id',$model->member_id])
   ->andWhere(['=', 'servico_id', $core->id])
   ->andWhere(['=', 'status', 1])
   ->select('servico_id')->distinct()
   ->count();
}

?>
<!-- <div id="C<?= $num?>"> 
	
		   <div class="inner-content text-center">
				<p><em>Servi&ccedil;os Clinicos</em></p>
                        <div class="c100 p<?php if ($tcliservicos==0) {echo 0;} else { echo  round(($cliServices/$tcliservicos*100),1);} ?> center">
                            <span><?php if ($tcliservicos==0) {echo 0;} else { echo  round(($cliServices/$tcliservicos*100),1);} ?>%</span>
                            <div class="slice"><div class="bar"></div><div class="fill"></div></div>
                        </div>                   
     </div>	  		
	 </div> -->
</div>
<!-- Fim Clinic Services-->

<!-- Community Services -->
<div class="col-xs-6">
<?php
$tcomservicos= ServicosDream::find()->where(['servico_id'=>2])->andWhere(['=', 'status', 1])->count();
$comservicos= ServicosDream::find()->where(['servico_id'=>2])->andWhere(['=', 'status', 1])->all();
$comServices=0;
foreach ($comservicos as $core) {

  $comServices = $comServices+ServicosBeneficiados::find()
   ->where(['=','beneficiario_id',$model->member_id])
   ->andWhere(['=', 'servico_id', $core->id])
   ->andWhere(['=', 'status', 1])
   ->select('servico_id')->distinct()
   ->count();
}

?>
<!-- <div id="D<?= $num?>"> 
	
		   <div class="inner-content text-center">
				<p><em>Servi&ccedil;os Comunitarios</em></p>
                        <div class="c100 p<?php if ($tcomservicos==0) {echo 0;} else { echo  round(($comServices/$tcomservicos*100),1);} ?> center">
                            <span><?php if ($tcomservicos==0) {echo 0;} else { echo  round(($comServices/$tcomservicos*100),1);} ?>%</span>
                            <div class="slice"><div class="bar"></div><div class="fill"></div></div>
                        </div>                   
     </div>	
	 </div> -->
</div>
<!-- Fim Community Services-->




<!-- </div> -->


<div class="col-xs-12">

  <!--copy from here -->
  <div class="col-lg-12">

      <div class="panel panel-info">
    <div class="panel-heading">
    <?php $conta = ServicosBeneficiados::find()->where(['beneficiario_id' => $model->id])->distinct()->count();
    if ($conta>0) { ?>
  <button data-toggle="collapse" data-target="#intervensoesDREAM">
    <i class="ion ion-medkit"> </i> Lista de Interven&ccedil;&otilde;es DREAMS
   <?php
     if($conta==0){echo  '<span class="label label-danger"> <i class="fa fa-medkit"></i>&nbsp;['.$conta.']</span>';}
        elseif ($conta<5) {echo  '<span class="label label-warning"> <i class="fa fa-medkit"></i>&nbsp;['.$conta.']</span>';}
        elseif ($conta<10) {echo  '<span class="label label-info"> <i class="fa fa-medkit"></i>&nbsp;['.$conta.']</span>';}
        else {
          echo  '<span class="label label-success"> <i class="fa fa-medkit"></i>&nbsp;['.$conta.']</span>';}

          ?>

                       <span class="label label-success"><i class="fa fa-stethoscope"></i>&nbsp;0</span>&nbsp;
               <span class="label label-info"><i class="fa fa-group"></i>&nbsp;0</span>&nbsp;
               <span class="label label-default"><i class="glyphicon glyphicon-education"></i>&nbsp;0</span>

  </button>
  <?php }
      ?>


  <?php Html::a('<i class="fa fa-plus-square"></i> Servi&ccedil;o DREAMS', ['servicos-beneficiados/create.dreams?m='.$model->id.'&ts=1'], ['data-toggle'=>'modal', 'data-target'=>'#myModal', 'class' => 'label label-primary']) ?>&nbsp;
  <?php Html::a('+ <i class="fa fa-group"></i> DREAMS COMUNIDADE', ['servicos-beneficiados/create.dreams?m='.$model->id.'&ts=2'], ['data-toggle'=>'modal', 'data-target'=>'#myModal', 'class' => 'label label-success']) ?>
    </div>

       <div class="panel-body">

        <div id="intervensoesDREAM" class="">
          <div class="progress">
              <div class="progress-bar progress-bar-<?php
     if($conta==0){echo "danger";}
        elseif ($conta<5) {echo  "warning";}
        elseif ($conta<10) {echo "info";}
        else { echo  "success";}

          ?>" role="progressbar" aria-valuenow="<?= $conta; ?>"
    aria-valuemin="0" aria-valuemax="10" style="width:<?= $conta/10*100; ?>%">
       <?= $conta/10*100; ?>% de Cobertura
            </div>
        </div>

           <table class="table table-bordered table-responsive">
     <thead>
    <tr> <th> Data</th> <th>Tipo de Serviço</th> <th>Serviço</th><th>  Interven&ccedil;&otilde;es</th><th>Ponto de Entrada</th>  <th> #  </th> </tr>
    </thead>
      <tbody>
    <?php $queryC = ServicosBeneficiados::find()->where(['=','beneficiario_id',$model->member_id])->count();

  if($queryC>0)
  {
  $query = ServicosBeneficiados::find()->where(['=','beneficiario_id',$model->member_id])
                     ->orderBy('data_beneficio DESC')
                    ->all();
  foreach($query as $query) {   ?>

    <tr>
  <td class='data_pagamento'> <?= date('d-m-Y', strtotime($query->data_beneficio)) ?>  </td>
  <?php  
    $queryTipoServico = TipoServicos::findOne($query->servicos['servico_id']);
  ?>
  <td  class='quota_id'> <?= $queryTipoServico['name']; ?> </td>
  <td  class='quota_id'> <?= $query->servicos['name']; ?> </td>
  <td  class='quota_id'> 
<?php /*if (isset(Yii::$app->user->identity->role)&&Yii::$app->user->identity->role>15) {echo $query->subServicos['name'];} else {echo "-";} */ ?> 

<?php if (isset(Yii::$app->user->identity->role)&&(Yii::$app->user->identity->role>15))
{echo $query->subServicos['name'];}
elseif(($query->servicos['oculto']==0)&&($query->subServicos['oculto']==0)) {echo $query->subServicos['name'];}  ?>

</td>
  <td  class='quota_id'> <?= $query->us['name']; ?> </td>
  <td class='status'>
    <a  <?php if( $query->servicos['core_service'] == 1) { ?> class="label label-success" <?php } else {?>
     class="label label-danger"  <?php } ?>

    href="<?php echo Url::toRoute('servicos-beneficiados/'.$query->id); ?>"  > <i class="glyphicon glyphicon-eye-open icon-success"></i>
             </a>&nbsp;


   <a  <?php if( $query->status == 1) { ?> class="label label-success" <?php } else {?>
     class="label label-danger"  <?php } ?>

    href="<?php echo Url::toRoute('servicos-beneficiados/update.dreams?id='.$query->id); ?>"  > <i class="glyphicon glyphicon-pencil icon-primary"></i>
             </a>

  <?php /* Html::a('<i class="fa fa-edit"></i>', ['servicos-beneficiados/update.dreams?id='.$model->id.'&ts=1'], ['data-toggle'=>'modal', 'data-target'=>'#myModal', 'class' => 'label label-primary']) */?>

  </td>
  </tr>

  <?php } //fim FOR

             ?>

  <?php }  //fim if query
  else {
  echo "<tr>
  <td colspan='5'> <i class='glyphicon glyphicon-envelope'> <font style='color:red'><i> Beneficiario sem serviços registados no sistema</i></font></td>
  </tr>";
  }
  ?>
       <tbody>
          </table>

  <span class="label label-success"> Core Service</span> <span class="label label-danger"> Non-Core Service</span>

        </div>
      </div>


  </div>
  </div>
  <!--copy to here -->

</div>

    </div>

	  <div class="row"> </div>
<div class="col-lg-3">
     <div class="panel panel-warning">

  <div class="panel-body">

    <div class="col-xs-12">

 <p align="center">
  <a
  href="<?php echo Url::toRoute('documentos-fotos/create.dreams?&profile='.$model->id.'&outros'); ?>"  >
 <?= Html::img('@web/img/emblema.png', ['class' => 'img-thumbnail','width' => '45px', 'alt' => $model->distrito['cod_distrito'].'/'.$model->member_id]) ?>
</a>
 <br>
 <small>República de Moçambique<br>
 Ministério da Saúde<br>
 Serviços de<br>
 SAÚDE REPRODUTIVA<br>
 De Adolescente e Jovens</small><br>


<font color="green"><b><?= $model->distrito['cod_distrito'].'/'.$model->member_id; ?> </b></font><br>
<?php if (isset(Yii::$app->user->identity->role)&&Yii::$app->user->identity->role==20) { ?>
<b><?= $model->emp_firstname.' '.$model->emp_lastname; ?> </b><br><br>
<?php } ?>
Ponto de Refer&ecirc;ncia:<br>
<b><span class="label label-success"><?= $model->us['name'];  ?></span></b>

</p>
<hr>
    </div>
</div>
</div>
</div>

    <div class="col-lg-5">
       <div class="panel panel-primary">
  <div class="panel-heading"> Dados Gerais</div>
  <div class="panel-body">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [

            'nacionalidade.name',
            'provincia.province_name',
          'distrito.district_name',
          [
             'attribute' => 'emp_birthday',
             'format'=>'raw',
	     'label'=>'idade',
 // 'value' => date('d-m-Y', strtotime($model->emp_birthday)),
	     'value' => $model->emp_birthday == NULL ? $model->idade_anos." anos" :
	   date("Y")-substr(date($model->emp_birthday, strtotime($model->emp_birthday)),-4)." anos",



        ],
                         [
             'attribute' => 'emp_gender',
             'format'=>'raw',
    
         'value' => $model->emp_gender == 1 ? 'M' : 'F',
        ],
 'encarregado_educacao',



        ],
    ]) ?>
</div>
</div>
    </div>

<div class="col-lg-4">
       <div class="panel panel-danger">
  <div class="panel-heading"><i class="glyphicon glyphicon-earphone"></i> Contactos</div>
  <div class="panel-body">
  <i class="glyphicon glyphicon-globe  text-danger"></i> <?= $model->coun_code; ?> <br>
<i class="glyphicon glyphicon-home  text-danger"></i> <?= $model->localidade['name']; ?>, <?= $model->emp_street1; ?> <br>
<i class="glyphicon glyphicon-phone-alt  text-danger"></i> <?= $model->emp_hm_telephone; ?> <br>
<i class="glyphicon glyphicon-phone  text-danger"></i> <?= $model->emp_mobile; ?> <br>
<i class="glyphicon glyphicon-envelope  text-danger"></i> <?= $model->emp_work_email; ?> <br>
  </div>
  </div>

      <div class="panel panel-info">
  <div class="panel-heading"> Parceiro/Acompanhante</div>
  <div class="panel-body">

<?php if($model->parceiro_benificiario_id>0) { ?>
<?php $gender=$model->parceiro['emp_gender'] == 1 ? '<i class="fa fa-male"></i>' : '<i class="fa fa-female"></i>'?>
<?php 
if(isset($model->parceiro->distrito['cod_distrito'])&& $model->parceiro->distrito['cod_distrito']>0){

echo  Html::a($model->parceiro->distrito['cod_distrito'].'/'.$model->parceiro['member_id'].' '.$gender, ['beneficiarios/view','id'=>$model->parceiro_benificiario_id], ['class' => 'btn btn-success']); 
}else {
echo '<font color=red>Parceiro com Nr='.$model->parceiro_benificiario_id.' nao existe</font>';
}

?>
<?php } ?>
  </div>
  </div>
  </div>


    </div>
    </div>

  </div>
</div>




<?php } // termina $num==1 ?>
