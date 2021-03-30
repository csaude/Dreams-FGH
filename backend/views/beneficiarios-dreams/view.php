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
use app\models\ReferenciasDreams;
use app\models\Beneficiarios;
/* @var $this yii\web\View */
/* @var $model app\models\Membros */
if (isset(Yii::$app->user->identity->role)&&Yii::$app->user->identity->role==20) {
$this->title = $model->emp_firstname." ".$model->emp_middle_name." ".$model->emp_lastname; } else {

  $this->title = $model->distrito['cod_distrito'].'/'.$model->member_id;
}
$this->params['breadcrumbs'][] = ['label' => 'Beneficiários', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>




<?php
if($model->id==1){
if (isset(Yii::$app->user->identity->role)&&Yii::$app->user->identity->role==20) {
  $firsts=Beneficiarios::find()
  ->where(['=','emp_birthday',''])
  ->andWhere('idade_anos <> :idade_anos',[':idade_anos' => 0])
  ->andWhere(['=','emp_status',1])
  ->all();


$todos=Beneficiarios::find()
  ->where(['=','emp_birthday',''])
  ->andWhere('idade_anos <> :idade_anos',[':idade_anos' => 0])
  ->andWhere(['=','emp_status',1])
  ->count();


echo 'Todos='.$todos.'<br>';
  foreach ($firsts as $first) {

        echo $first->id.'-'.$first->idade_anos.'-'.$first->emp_birthday.'<br>';

    if($first->emp_birthday>0)
    {   }
    else {

       $ano=substr($first->criado_em, 0, 4)-$model->idade_anos;
       $mes=substr($first->criado_em, 5, 2);
       $dia=substr($first->criado_em, 8, 2);
      $data=$mes.'/'.$dia.'/'.$ano;
      // update an existing row of data
    //  $benef = Beneficiarios::find()->where('id'=$first->id);
    //echo $first->id.'ttttttt';
      $benef = Beneficiarios::find()->where(['=','id', $first->id])->one();
  $first->emp_birthday = $data;
      $first->save();
      $customer = Beneficiarios::findOne($first->id);
      $customer->emp_birthday = $data;
      $customer->save();

    }

  }
$this->title = $model->emp_firstname." ".$model->emp_middle_name." ".$model->emp_lastname; } else {

  $this->title = $model->distrito['cod_distrito'].'/'.$model->member_id;
}

}//model id=1
?>




<?php
//Se o beneficiario tiver idade sem data_nasc ele calcula a data

if($model->id==1) {

/*
$total = Beneficiarios::find()->where(['emp_status'=>1])->all();
echo $total = Beneficiarios::find()->where(['emp_status'=>1])->andWhere(['=','emp_birthday',""])->andWhere(['=','idade_anos',""])->count();

foreach ($total as $modelo) {


 if(!$modelo->emp_birthday=="")
 {  }
 elseif(!$modelo->idade_anos=="") {
    $ano=substr($modelo->criado_em, 0, 4)-$modelo->idade_anos;
    $mes=substr($modelo->criado_em, 5, 2);
    $dia=substr($modelo->criado_em, 8, 2);
   $data=$mes.'/'.$dia.'/'.$ano;
   // update an existing row of data
   $benef = Beneficiarios::findOne($modelo->id);
   $benef->emp_birthday = $data;
   $benef->save();
 }else{}
}
*/
  }
 ?>



<div class="membros-view">

	<div class="col-lg-12">

	<div class="panel panel-success">
  <div class="panel-heading"><i class="fa fa-dashboard  text-primary"></i> <strong> Dados de Registo do Beneficiário:  <?= Html::encode($this->title) ?> </strong></div>
  <div class="panel-body">
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
<?php
//Se o beneficiario tiver idade sem data_nasc ele calcula a data
 if(!$model->emp_birthday=="")
 {  }
 elseif(!$model->idade_anos=="") {
    $ano=substr($model->criado_em, 0, 4)-$model->idade_anos;
    $mes=substr($model->criado_em, 5, 2);
    $dia=substr($model->criado_em, 8, 2);
   $data=$mes.'/'.$dia.'/'.$ano;
   // update an existing row of data
   $benef = Beneficiarios::findOne($model->id);
   $benef->emp_birthday = $data;
   $benef->save();
 }else{} ?>
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

'value' => $model->emp_birthday == NULL ? $model->idade_anos." anos" :
date("Y")-substr(date($model->emp_birthday, strtotime($model->emp_birthday)),-4)." anos",
	//  'value' => date('d-m-Y', strtotime($model->emp_birthday)),
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
<?php if($model->parceiro_id>0) { ?>
<?php $gender=$model->parceiro['emp_gender'] == 1 ? '<i class="fa fa-male"></i>' : '<i class="fa fa-female"></i>'?>
<?php

if(isset($model->parceiro->distrito['cod_distrito'])&& $model->parceiro->distrito['cod_distrito']>0){

echo  Html::a($model->parceiro->distrito['cod_distrito'].'/'.$model->parceiro['member_id'].' '.$gender, ['beneficiarios/view','id'=>$model->parceiro_id], ['class' => 'btn btn-success']);
}else {
echo '<font color=red>Parceiro com Nr='.$model->distrito['cod_distrito'].'/'.$model->parceiro_id.' n&atilde;o existe</font>';
}

 // Html::a($model->parceiro->distrito['cod_distrito'].'/'.$model->parceiro['member_id'].' '.$gender, ['beneficiarios/view','id'=>$model->parceiro_id], ['class' => 'btn btn-success']);



?>
<?php } ?>
  </div>
  </div>
  </div>


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
	     <?php $refs=ReferenciasDreams::find()
			->where(['beneficiario_id' => $model->id])
			->andWhere(['status' => 1])
			->distinct()->count();

			if($refs>0) {	?>
	<span class="label label-danger"><i class="fa fa-external-link-square"></i> &nbsp;
		<?= $refs; ?> </span>
<?php } //fim benef tem referencia ?>
</button>
<?php }



	  ?>

<?php
// Calculate age from a specified date
/*     function get_age($birthday)
     {
        list($month, $day, $year) = explode("/", $birthday);
        $year_diff  = date("Y") - $year;
        $month_diff = date("m") - $month;
        $day_diff   = date("d") - $day;
        if($month_diff < 0)
    	{
    		$year_diff--;
    	}
        else if(($month_diff == 0) && ($day_diff < 0))
    	{
    		$year_diff--;
    	}
        return $year_diff;
    }
     $idade=get_age($model->emp_birthday);

if($idade<10||$idade>24) {
  echo "<h2 align=center><font color=red>A Idade <font color=blue>(".$idade." anos) </font> ,do Beneficiario Invalida!<br> Por favor, actualize-a para proceder com o fornecimento dos servi&ccedil;os!</font> </h2>";
$sem_idade=true;
} else { */?>

<a class="label label-primary" href="/backend/web/index.php/servicos-beneficiados/create.dreams?m=<?= $model->id;?>&amp;ts=1.dreams"
     target="_self"><i class="fa fa-plus-square"></i> Servi&ccedil;o DREAMS</a>&nbsp;

<?php Html::a('<i class="fa fa-plus-square"></i> Servi&ccedil;o DREAMS', ['servicos-beneficiados/create.dreams?m='.$model->id.'&ts=1'], ['data-toggle'=>'modal', 'data-target'=>'#myModal', 'target'=>'_blank','class' => 'label label-primary']) ?>&nbsp;
<?php Html::a('+ <i class="fa fa-group"></i> DREAMS COMUNIDADE', ['servicos-beneficiados/create.dreams?m='.$model->id.'&ts=2'], ['data-toggle'=>'modal', 'data-target'=>'#myModal', 'class' => 'label label-success']) ?>
	  	 <?= Html::a('<i class="fa fa-external-link-square"></i>
Referir Beneficiário', ['referencias-dreams/create','ben' => $model->id], ['class' => 'label label-danger']) ?>
<?php /*}*/ ?>
  </div>

		 <div class="panel-body">

			<div id="intervensoesDREAM" class="collapse">
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

				 <table class="table table-bordered">

  <tr> <th> Data</th> <th>Serviço</th><th>  Interven&ccedil;&otilde;es</th><th>Ponto de Entrada</th>  <th> #  </th> </tr>
	<?php $queryC = ServicosBeneficiados::find()->where(['=','beneficiario_id',$model->member_id])->count();

if($queryC>0)
{
$query = ServicosBeneficiados::find()->where(['=','beneficiario_id',$model->member_id])
									 ->orderBy('data_beneficio DESC')
									->all();
foreach($query as $query) {		?>



	<tr>
<td class='data_pagamento'> <?= date('d-m-Y', strtotime($query->data_beneficio)) ?>  </td>
<td  class='quota_id'> <?= $query->servicos['name']; ?> </td>
<td  class='quota_id'>
<?php //if (isset(Yii::$app->user->identity->role)&&Yii::$app->user->identity->role>15) {echo $query->subServicos['name'];} else {echo "-";} ?>
<?php if (isset(Yii::$app->user->identity->role)&&(Yii::$app->user->identity->role>15))
{echo $query->subServicos['name'];}
elseif($query->servicos['oculto']==0) {echo $query->subServicos['name'];}  ?>

</td>
<td  class='quota_id'> <?= $query->us['name']; ?> </td>
<td class='status'>
	<?php if (isset(Yii::$app->user->identity->role)&&Yii::$app->user->identity->role==10) { } else { ?>
  <a  <?php if( $query->status == 1) { ?> class="label label-success" <?php } else {?>
   class="label label-danger"  <?php } ?>

  href="<?php echo Url::toRoute('servicos-beneficiados/'.$query->id); ?>"  > <i class="glyphicon glyphicon-eye-open icon-success"></i>
           </a>
	<?php } ?>
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



				</table>
<p align="right">
	<a class="label label-primary" href="/backend/web/index.php/servicos-beneficiados/create.dreams?m=<?= $model->id;?>&amp;ts=1.dreams" data-toggle="modal"  target="_self"><i class="fa fa-plus-square"></i> Servi&ccedil;o DREAMS</a>&nbsp;

<?php Html::a('<i class="fa fa-plus-square"></i> Servi&ccedil;o DREAMS', ['servicos-beneficiados/create.dreams?m='.$model->id.'&ts=1'], ['data-toggle'=>'modal', 'data-target'=>'#myModal', 'class' => 'label label-primary']) ?>&nbsp;

<?php Html::a('<i class="fa fa-plus-square"></i> Servi&ccedil;o DREAMS', ['servicos-beneficiados/create.dreams?m='.$model->id.'&ts=1'], ['data-toggle'=>'modal', 'data-target'=>'#myModal', 'target'=>'_blank', 'class' => 'label label-primary']) ?>&nbsp;
<?php Html::a('+ <i class="fa fa-group"></i> DREAMS COMUNIDADE', ['servicos-beneficiados/create.dreams?m='.$model->id.'&ts=2'], ['data-toggle'=>'modal', 'data-target'=>'#myModal', 'class' => 'label label-success']) ?>

</p>

<span class="label label-success"> confirmada</span> <span class="label label-danger"> Aguarda confirmação</span>

			</div>
		</div>


</div>
</div>


	     <div class="panel-footer clearfix">
        <div class="pull-right">
         <div class="form-group">

        <?= Html::a('<i class="glyphicon glyphicon-backward"></i>', ['index'], ['class' => 'btn btn-warning']) ?>
        <?= Html::a('Actualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
		  <?= Html::a('<i class="fa fa-external-link-square"></i> Referir Beneficiário', ['referencias-dreams/create','ben' => $model->id], ['class' => 'btn btn-danger']) ?>

	    <?= Html::a('<i class="fa fa-plus"></i> Novo Beneficiário', ['create'], ['class' => 'btn btn-success']) ?>
        <?php Html::a('Apagar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'disabled'=>true,
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </div>
        </div>
    </div> <!-- END Clearfix -->

	<div class="row">
<div class="col-lg-4"> </div>
<div class="col-lg-4"> </div>
<div class="col-lg-4">

 <div class="panel panel-warning">
 <p align="right"> <small> User: <?=  Yii::$app->request->userIP;?> (<?= Yii::$app->user->identity->username;?>)&nbsp; <br>
 Criado em: <?= $model->criado_em ?>&nbsp;
(<?php echo $model->user['email']; ?>)
	 <br>
  <?php if($model->actualizado_em!=NULL) {echo "Actualizado em: ". $model->actualizado_em; } ?>
  &nbsp;<br> <?php if($model->actualizado_em!=NULL) {echo "Actualizado por: ". $model->user_location2.' ('.$model->update['email'].')'; }





	 ?>&nbsp;


 </small></p>
 </div>
</div>
</div>




		</div>
		</div>






	</div>
</div>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Adicionar <?php if (isset($_REQUEST['t'])) {echo $_REQUEST['t'];}  else {} ?></h4>
      </div>
      <div class="modal-body">
  <?php $form = ActiveForm::begin(); ?>

<?= Html::img('@web/img/logo3.png', ['height'=>'75px','alt' => 'Layering DREAMS']) ?>
<?php ActiveForm::end(); ?>



      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
      </div>
    </div>

  </div>
</div>
