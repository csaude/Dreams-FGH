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
use app\models\FaixaEtaria;
use app\models\FaixaEtariaServico;



use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model app\models\Membros */

$this->title = "INDICADORES DREAMS";
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

$todosActivos= Beneficiarios::find()
->where(['=','emp_status', 1])
->andWhere(['emp_gender'=>2])
->andWhere(['gravida'=>1])
->andWhere(['<','idade_anos',18])
->asArray()
->all();

 $beneficiarios=ArrayHelper::getColumn($todosActivos,'id');


$faixaEt=FaixaEtariaServico::find()->where(['=','status',1])->andWhere(['IN','faixa_id',[1,4,7]])->asArray()->all();
$faixaEtSer=ArrayHelper::getColumn($faixaEt,'servico_id');

$Servicos = ServicosBeneficiados::find()
    ->where(['=', 'status', 1])
    ->andWhere(['=', 'servico_id',9 ])
    ->andWhere(['IN', 'beneficiario_id', $beneficiarios])
    ->andWhere(['IN', 'servico_id', $faixaEtSer])
    ->distinct('beneficiario_id')
    ->count(); 
//echo $Servicos;

//foreach($faixaEt as  $faixa)
 //{echo " ".$faixa['id']." ";}

?>


<?php

function periodo($data_r) {

$hoje=date("Y-m-d H:i:s");


$earlier = new DateTime($hoje);
$later = new DateTime($data_r);

$periodo = $later->diff($earlier)->format("%a");

return $periodo;
}?>


<?php     periodo("2019-03-01 14:12:06");

$meses = ServicosBeneficiados::find()
    ->where(['=', 'status', 1])
    ->andWhere(['IN', 'beneficiario_id', $beneficiarios] )
    ->asArray()->all(); 


foreach($meses as $dias) {  
   periodo($dias["criado_em"])."<br>";
}

?>

<h2>
<?php
//echo "Todos Beneficiarios ACtivos, do Sexo F, Que ja ja esteve Gravida, idade <18: <br> ".$todosActivos;
?></h2>


<div class="membros-view">

	<div class="col-lg-12">

	<div class="panel panel-primary">
           <div class="panel-heading"><i class="fa fa-dashboard  text-primary"></i> <strong> Indicador AGYW_Prev Desagregado por Tempo de Registo e Idade (MER 2.3) </strong></div>
  <div class="panel-body">


    <div class="row"> </div>


     <table width="100%" class="table table-dashed">
        <col width="174">
        <col width="117">
        <col width="119">
        <col width="154">
        <col width="142">

        <tr>
          <td colspan="5" bgcolor="#FFFFFF"><b>RESUMO NACIONAL Actualizado no dia 20 de setembro de 2019</b></td>
        </tr>
        <tr>
			
          <td colspan="5" bgcolor="#FFFFFF"><b>Total de Adolescentes Jovens Activos: 105.835</b></td>
        </tr> 
        <tr>
          <td colspan="5" bgcolor="#FFFFFF"><b>Total de adolescentes e Jovens do sexo feminino: 83.423</b></td>
        </tr> 
        <tr>
          <td colspan="5" bgcolor="#FFFFFF"><b>Total de Beneficiarias: 74.611</b></td>
        </tr>  
        
</table>



<button class="btn btn-primary btn-block  mb1 black bg-darken-1" data-toggle="collapse" data-target="#maputo"><b>PROVINCIA DE MAPUTO</b></button>

<div id="maputo" class="collapse">
<table width="100%" class="table table-dashed">

        <tr>
          <td colspan="5" bgcolor="#FFFFFF"><b>PROVINCIA DE MAPUTO</b></td>
        </tr>		
        <tr>
          <td colspan="5" bgcolor="#FFFFFF"><b>Matutuine</b></td>
        </tr>
		
		
        <tr>
          <td colspan="5" bgcolor="#FFFFFF"><b>RESUMO Distrital</b></td>
        </tr>
        <tr>
			
          <td colspan="5" bgcolor="#FFFFFF"><b>Total de Adolescentes Jovens Activos: 2.164</b></td>
        </tr> 
        <tr>
          <td colspan="5" bgcolor="#FFFFFF"><b>Total de adolescentes e Jovens do sexo feminino: 2.162</b></td>
        </tr> 
		
        <tr>
          <td colspan="5" bgcolor="#FFFFFF"><b>Total de adolescentes e Jovens do sexo masculino: 2</b></td>
        </tr> 		
		
        <tr>
          <td colspan="5" bgcolor="#FFFFFF"><b>Total de Beneficiarias Activos: 2.152</b></td>
        </tr> 
	
		

        <tr>
          <td colspan="5" height="40" bgcolor="#FFFFFF"><b> </b></td>
        </tr>

        <tr>
          <td colspan="5" bgcolor="#FFFFFF"><b>Numerador</b></td>
        </tr>		
		
        <tr>
          <td colspan="5" height="40" bgcolor="#FFFFFF"><b> </b></td>
        </tr>
  		
        <tr>
          <td width="706" colspan="5" bgcolor="#CD5C5C"><b>Número de Beneficiários DREAMS que receberam TODO pacote primário de serviços E pelos um serviço adicional do pacote secundário </b> </td>
        </tr>
        <tr>
          <td width="174" bgcolor="#FFE4E1">Tempo de registo como beneficiário DREAMS </td>
          <td bgcolor="#FFE4E1">10--14</td>
          <td bgcolor="#FFE4E1">15-19</td>
          <td bgcolor="#FFE4E1">20-24</td>
          <td bgcolor="#FFE4E1">25-29</td>
        </tr>
        <tr>
          <td bgcolor="#CD9B9B">0-6 meses </td>
          <td bgcolor="#CD9B9B"> 
		  	<?php 
			echo "46"; 
			?>
		  </td>
          <td bgcolor="#CD9B9B">
		  	<?php 
			echo "1"; 
			?>
		  </td>
          <td bgcolor="#CD9B9B">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#CD9B9B">
		  	<?php 
			echo "0"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#FFE4E1">7-12    meses </td>
          <td bgcolor="#FFE4E1">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#FFE4E1">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#FFE4E1">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#FFE4E1">
		  	<?php 
			echo"0"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#CD9B9B">13-24    meses </td>
          <td bgcolor="#CD9B9B">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#CD9B9B">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#CD9B9B">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#CD9B9B">
		  	<?php 
			echo "0"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#FFE4E1">25 meses ou +</td>
          <td bgcolor="#FFE4E1">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#FFE4E1">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#FFE4E1">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#FFE4E1">
		  	<?php 
			echo "0"; 
			?>
		  </td>
        </tr>

        <tr>
          <td colspan="5" height="40" bgcolor="#FFFFFF"><b> </b></td>
        </tr>
				
        <tr>
          <td width="706" colspan="5" bgcolor="#F4A460"><b>Número de Beneficiários DREAMS que receberam TODO pacote primário de serviços mas não receberam nenhum serviço além do pacote primário
</b> </td>
        </tr>
        <tr>
          <td width="174" bgcolor="#FAEBD7">Tempo de registo como beneficiário DREAMS </td>
          <td bgcolor="#FAEBD7">10--14</td>
          <td bgcolor="#FAEBD7">15-19</td>
          <td bgcolor="#FAEBD7">20-24</td>
          <td bgcolor="#FAEBD7">25-29</td>
        </tr>
        <tr>
          <td bgcolor="#FFDEAD">0-6 meses </td>
          <td bgcolor="#FFDEAD"> 
		  	<?php 
			echo "5"; 
			?>
		  </td>
          <td bgcolor="#FFDEAD">
		  	<?php 
			echo "1"; 
			?>
		  </td>
          <td bgcolor="#FFDEAD">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#FFDEAD">
		  	<?php 
			echo "0"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#FAEBD7">7-12    meses </td>
          <td bgcolor="#FAEBD7">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#FAEBD7">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#FAEBD7">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#FAEBD7">
		  	<?php 
			echo "0"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#FFDEAD">13-24    meses </td>
          <td bgcolor="#FFDEAD">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#FFDEAD">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#FFDEAD">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#FFDEAD">
		  	<?php 
			echo "0"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#FAEBD7">25 meses ou +</td>
          <td bgcolor="#FAEBD7">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#FAEBD7">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#FAEBD7">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#FAEBD7">
		  	<?php 
			echo "0"; 
			?>
		  </td>
        </tr>		
	
        <tr>
          <td colspan="5" height="40" bgcolor="#FFFFFF"><b> </b></td>
        </tr>	

		     
		<tr>
          <td colspan="5" bgcolor="#32CD32"><b>Número    de Beneficiários DREAMS que completaram pelo menos um serviço DREAMS mais não completaram o pacote primário de serviços </b></td>
        </tr>
        <tr>
          <td width="174" bgcolor="#F0FFF0">Tempo de registo como beneficiário DREAMS </td>
          <td bgcolor="#F0FFF0">10--14</td>
          <td bgcolor="#F0FFF0">15-19</td>
          <td bgcolor="#F0FFF0">20-24</td>
          <td bgcolor="#F0FFF0">25-29</td>
        </tr>
        <tr>
          <td bgcolor="#98FB98">0-6 meses </td>
          <td bgcolor="#98FB98">
		  	<?php 
			echo "1164"; 
			?>
		  </td>
          <td bgcolor="#98FB98">
		  	<?php 
			echo "505"; 
			?>
		  </td>
          <td bgcolor="#98FB98">
		  	<?php 
			echo "206"; 
			?>
		  </td>
          <td bgcolor="#98FB98">
		  	<?php 
			echo "2"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#F0FFF0">7-12    meses </td>
          <td bgcolor="#F0FFF0">
		  	<?php 
			echo "13"; 
			?>
		  </td>
          <td bgcolor="#F0FFF0">
		  	<?php 
			echo "3"; 
			?>
		  </td>
          <td bgcolor="#F0FFF0">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#F0FFF0">
		  	<?php 
			echo "0"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#98FB98">13-24    meses </td>
          <td bgcolor="#98FB98">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#98FB98">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#98FB98">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#98FB98">
		  	<?php 
			echo "0"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#F0FFF0">25 meses ou +</td>
          <td bgcolor="#F0FFF0">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#F0FFF0">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#F0FFF0">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#F0FFF0">
		  	<?php 
			echo "0"; 
			?>
		  </td>
        </tr>
		

        <tr>
          <td colspan="5" height="40" bgcolor="#FFFFFF"><b> </b></td>
        </tr>

        <tr>
          <td colspan="5" bgcolor="#FFFFFF"><b>Denominador</b></td>
        </tr>		
		
        <tr>
          <td colspan="5" height="40" bgcolor="#FFFFFF"><b> </b></td>
        </tr>	
	
        <tr>
          <td width="706" colspan="5" bgcolor="#1874CD"><b>Número de Beneficiários DREAMS que completaram pelo menos um serviço DREAMS</b> </td>
        </tr>
        <tr>
          <td width="174" bgcolor="#CAE1FF">Tempo de registo como beneficiário DREAMS </td>
          <td bgcolor="#CAE1FF">10--14</td>
          <td bgcolor="#CAE1FF">15-19</td>
          <td bgcolor="#CAE1FF">20-24</td>
          <td bgcolor="#CAE1FF">25-29</td>
        </tr>
        <tr >
          <td bgcolor="#6495ED">0-6 meses </td>
          <td bgcolor="#6495ED"> 
		  	<?php 
			echo "1215"; 
			?>
		  </td>
          <td bgcolor="#6495ED">
		  	<?php 
			echo "507"; 
			?>
		  </td>
          <td bgcolor="#6495ED">
		  	<?php 
			echo "206"; 
			?>
		  </td>
          <td bgcolor="#6495ED">
		  	<?php 
			echo "2"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#CAE1FF">7-12    meses </td>
          <td bgcolor="#CAE1FF">
		  	<?php 
			echo "13"; 
			?>
		  </td>
          <td bgcolor="#CAE1FF">
		  	<?php 
			echo "3";  
			?>
		  </td>
          <td bgcolor="#CAE1FF">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#CAE1FF">
		  	<?php 
			echo "0"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#6495ED">13-24    meses </td>
          <td bgcolor="#6495ED">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#6495ED">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#6495ED">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#6495ED">
		  	<?php 
			echo "0"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#CAE1FF">25 meses ou +</td>
          <td bgcolor="#CAE1FF">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#CAE1FF">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#CAE1FF">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#CAE1FF">
		  	<?php 
			echo "0"; 
			?>
		  </td>
        </tr>		
		
        <tr>
          <td colspan="5" height="40" bgcolor="#FFFFFF"><b> </b></td>
        </tr>

		

        <tr>
          <td colspan="5" height="40" bgcolor="#FFFFFF"><b> </b></td>
        </tr>

        <tr>
          <td colspan="5" bgcolor="#FFFFFF"><b>Namaacha</b></td>
        </tr>
		
		
        <tr>
          <td colspan="5" bgcolor="#FFFFFF"><b>RESUMO Distrital</b></td>
        </tr>
        <tr>
			
          <td colspan="5" bgcolor="#FFFFFF"><b>Total de Adolescentes Jovens Activos: 2,602</b></td>
        </tr> 
        <tr>
          <td colspan="5" bgcolor="#FFFFFF"><b>Total de adolescentes e Jovens do sexo feminino: 2.578</b></td>
        </tr> 
		
        <tr>
          <td colspan="5" bgcolor="#FFFFFF"><b>Total de adolescentes e Jovens do sexo masculino: 24</b></td>
        </tr> 		
		
        <tr>
          <td colspan="5" bgcolor="#FFFFFF"><b>Total de Beneficiarias Activos: 2.562</b></td>
        </tr> 
						
		

        <tr>
          <td colspan="5" height="40" bgcolor="#FFFFFF"><b> </b></td>
        </tr>

        <tr>
          <td colspan="5" bgcolor="#FFFFFF"><b>Numerador</b></td>
        </tr>		
		
        <tr>
          <td colspan="5" height="40" bgcolor="#FFFFFF"><b> </b></td>
        </tr>
  		
        <tr>
          <td width="706" colspan="5" bgcolor="#CD5C5C"><b>Número de Beneficiários DREAMS que receberam TODO pacote primário de serviços E pelos um serviço adicional do pacote secundário </b> </td>
        </tr>
        <tr>
          <td width="174" bgcolor="#FFE4E1">Tempo de registo como beneficiário DREAMS </td>
          <td bgcolor="#FFE4E1">10--14</td>
          <td bgcolor="#FFE4E1">15-19</td>
          <td bgcolor="#FFE4E1">20-24</td>
          <td bgcolor="#FFE4E1">25-29</td>
        </tr>
        <tr>
          <td bgcolor="#CD9B9B">0-6 meses </td>
          <td bgcolor="#CD9B9B"> 
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#CD9B9B">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#CD9B9B">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#CD9B9B">
		  	<?php 
			echo "0"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#FFE4E1">7-12    meses </td>
          <td bgcolor="#FFE4E1">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#FFE4E1">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#FFE4E1">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#FFE4E1">
		  	<?php 
			echo"0"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#CD9B9B">13-24    meses </td>
          <td bgcolor="#CD9B9B">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#CD9B9B">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#CD9B9B">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#CD9B9B">
		  	<?php 
			echo "0"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#FFE4E1">25 meses ou +</td>
          <td bgcolor="#FFE4E1">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#FFE4E1">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#FFE4E1">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#FFE4E1">
		  	<?php 
			echo "0"; 
			?>
		  </td>
        </tr>
			
        <tr>
          <td colspan="5" height="40" bgcolor="#FFFFFF"><b> </b></td>
        </tr>        
		
		<tr>
          <td width="706" colspan="5" bgcolor="#F4A460"><b>Número de Beneficiários DREAMS que receberam TODO pacote primário de serviços mas não receberam nenhum serviço além do pacote primário
		</b> </td>
        </tr>
        <tr>
          <td width="174" bgcolor="#FAEBD7">Tempo de registo como beneficiário DREAMS </td>
          <td bgcolor="#FAEBD7">10--14</td>
          <td bgcolor="#FAEBD7">15-19</td>
          <td bgcolor="#FAEBD7">20-24</td>
          <td bgcolor="#FAEBD7">25-29</td>
        </tr>
        <tr>
          <td bgcolor="#FFDEAD">0-6 meses </td>
          <td bgcolor="#FFDEAD"> 
		  	<?php 
			echo "3"; 
			?>
		  </td>
          <td bgcolor="#FFDEAD">
		  	<?php 
			echo "3"; 
			?>
		  </td>
          <td bgcolor="#FFDEAD">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#FFDEAD">
		  	<?php 
			echo "0"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#FAEBD7">7-12    meses </td>
          <td bgcolor="#FAEBD7">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#FAEBD7">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#FAEBD7">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#FAEBD7">
		  	<?php 
			echo "0"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#FFDEAD">13-24    meses </td>
          <td bgcolor="#FFDEAD">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#FFDEAD">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#FFDEAD">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#FFDEAD">
		  	<?php 
			echo "0"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#FAEBD7">25 meses ou +</td>
          <td bgcolor="#FAEBD7">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#FAEBD7">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#FAEBD7">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#FAEBD7">
		  	<?php 
			echo "0"; 
			?>
		  </td>
        </tr>		

        <tr>
          <td colspan="5" height="40" bgcolor="#FFFFFF"><b> </b></td>
        </tr>
		

        <tr>
          <td colspan="5" bgcolor="#32CD32"><b>Número de Beneficiários DREAMS que completaram pelo menos um serviço DREAMS mais não completaram o pacote primário de serviços </b></td>
        </tr>
        <tr>
          <td width="174" bgcolor="#F0FFF0">Tempo de registo como beneficiário DREAMS </td>
          <td bgcolor="#F0FFF0">10--14</td>
          <td bgcolor="#F0FFF0">15-19</td>
          <td bgcolor="#F0FFF0">20-24</td>
          <td bgcolor="#F0FFF0">25-29</td>
        </tr>
        <tr>
          <td bgcolor="#98FB98">0-6 meses </td>
          <td bgcolor="#98FB98">
		  	<?php 
			echo "1129"; 
			?>
		  </td>
          <td bgcolor="#98FB98">
		  	<?php 
			echo "741"; 
			?>
		  </td>
          <td bgcolor="#98FB98">
		  	<?php 
			echo "97"; 
			?>
		  </td>
          <td bgcolor="#98FB98">
		  	<?php 
			echo "0"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#F0FFF0">7-12    meses </td>
          <td bgcolor="#F0FFF0">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#F0FFF0">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#F0FFF0">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#F0FFF0">
		  	<?php 
			echo "0"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#98FB98">13-24    meses </td>
          <td bgcolor="#98FB98">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#98FB98">
		  	<?php 
			echo "3"; 
			?>
		  </td>
          <td bgcolor="#98FB98">
		  	<?php 
			echo "3"; 
			?>
		  </td>
          <td bgcolor="#98FB98">
		  	<?php 
			echo "0"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#F0FFF0">25 meses ou +</td>
          <td bgcolor="#F0FFF0">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#F0FFF0">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#F0FFF0">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#F0FFF0">
		  	<?php 
			echo "0"; 
			?>
		  </td>
        </tr>

        <tr>
          <td colspan="5" height="40" bgcolor="#FFFFFF"><b> </b></td>
        </tr>

        <tr>
          <td colspan="5" bgcolor="#FFFFFF"><b>Denominador</b></td>
        </tr>		
		
        <tr>
          <td colspan="5" height="40" bgcolor="#FFFFFF"><b> </b></td>
        </tr>
		
       <tr>
          <td width="706" colspan="5" bgcolor="#1874CD"><b>Número de Beneficiários DREAMS que completaram pelo menos um serviço DREAMS</b> </td>
        </tr>
        <tr>
          <td width="174" bgcolor="#CAE1FF">Tempo de registo como beneficiário DREAMS </td>
          <td bgcolor="#CAE1FF">10--14</td>
          <td bgcolor="#CAE1FF">15-19</td>
          <td bgcolor="#CAE1FF">20-24</td>
          <td bgcolor="#CAE1FF">25-29</td>
        </tr>
        <tr>
          <td bgcolor="#6495ED">0-6 meses </td>
          <td bgcolor="#6495ED"> 
		  	<?php 
			echo "1132"; 
			?>
		  </td>
          <td bgcolor="#6495ED">
		  	<?php 
			echo "744"; 
			?>
		  </td>
          <td bgcolor="#6495ED">
		  	<?php 
			echo "97"; 
			?>
		  </td>
          <td bgcolor="#6495ED">
		  	<?php 
			echo "0"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#CAE1FF">7-12    meses </td>
          <td bgcolor="#CAE1FF">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#CAE1FF">
		  	<?php 
			echo "0";  
			?>
		  </td>
          <td bgcolor="#CAE1FF">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#CAE1FF">
		  	<?php 
			echo "0"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#6495ED">13-24    meses </td>
          <td bgcolor="#6495ED">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#6495ED">
		  	<?php 
			echo "3"; 
			?>
		  </td>
          <td bgcolor="#6495ED">
		  	<?php 
			echo "3"; 
			?>
		  </td>
          <td bgcolor="#6495ED">
		  	<?php 
			echo "0"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#CAE1FF">25 meses ou +</td>
          <td bgcolor="#CAE1FF">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#CAE1FF">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#CAE1FF">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#CAE1FF">
		  	<?php 
			echo "0"; 
			?>
		  </td>
        </tr>			
		
</table>
</div>

<button class="btn btn-primary btn-block mb1 black bg-teal" data-toggle="collapse" data-target="#gaza"><b>PROVINCIA DE GAZA</b></button>

<div id="gaza" class="collapse">

<table width="100%" class="table table-dashed">
        <tr>
          <td colspan="5" bgcolor="#FFFFFF"><b>PROVINCIA DE GAZA</b></td>
        </tr>	

        <tr>
          <td colspan="5" bgcolor="#FFFFFF"><b>Cidade de Xai Xai</b></td>
        </tr>  		
        <tr>
		
        <tr>
          <td colspan="5" bgcolor="#FFFFFF"><b>RESUMO Distrital</b></td>
        </tr>
        <tr>
			
          <td colspan="5" bgcolor="#FFFFFF"><b>Total de Adolescentes Jovens Activos: 12.691</b></td>
        </tr> 
        <tr>
          <td colspan="5" bgcolor="#FFFFFF"><b>Total de adolescentes e Jovens do sexo feminino: 12.183</b></td>
        </tr> 
		
        <tr>
          <td colspan="5" bgcolor="#FFFFFF"><b>Total de adolescentes e Jovens do sexo masculino:508</b></td>
        </tr> 		
		
        <tr>
          <td colspan="5" bgcolor="#FFFFFF"><b>Total de Beneficiarias Activos: 11.644</b></td>
        </tr> 
		 				
		
		
        <tr>
          <td colspan="5" height="40" bgcolor="#FFFFFF"><b> </b></td>
        </tr>

        <tr>
          <td colspan="5" bgcolor="#FFFFFF"><b>Numerador</b></td>
        </tr>		
		
        <tr>
          <td colspan="5" height="40" bgcolor="#FFFFFF"><b> </b></td>
        </tr>		
		
          <td width="706" colspan="5" bgcolor="#CD5C5C"><b>Número de Beneficiários DREAMS que receberam TODO pacote primário de serviços E pelos um serviço adicional do pacote secundário </b> </td>
        </tr>
        <tr>
          <td width="174" bgcolor="#FFE4E1">Tempo de registo como beneficiário DREAMS </td>
          <td bgcolor="#FFE4E1">10--14</td>
          <td bgcolor="#FFE4E1">15-19</td>
          <td bgcolor="#FFE4E1">20-24</td>
          <td bgcolor="#FFE4E1">25-29</td>
        </tr>
        <tr>
          <td bgcolor="#CD9B9B">0-6 meses </td>
          <td bgcolor="#CD9B9B"> 
		  	<?php 
			echo "1874"; 
			?>
		  </td>
          <td bgcolor="#CD9B9B">
		  	<?php 
			echo "1252"; 
			?>
		  </td>
          <td bgcolor="#CD9B9B">
		  	<?php 
			echo "415"; 
			?>
		  </td>
          <td bgcolor="#CD9B9B">
		  	<?php 
			echo "0"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#FFE4E1">7-12    meses </td>
          <td bgcolor="#FFE4E1">
		  	<?php 
			echo "118"; 
			?>
		  </td>
          <td bgcolor="#FFE4E1">
		  	<?php 
			echo "52"; 
			?>
		  </td>
          <td bgcolor="#FFE4E1">
		  	<?php 
			echo "43"; 
			?>
		  </td>
          <td bgcolor="#FFE4E1">
		  	<?php 
			echo"0"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#CD9B9B">13-24    meses </td>
          <td bgcolor="#CD9B9B">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#CD9B9B">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#CD9B9B">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#CD9B9B">
		  	<?php 
			echo "0"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#FFE4E1">25 meses ou +</td>
          <td bgcolor="#FFE4E1">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#FFE4E1">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#FFE4E1">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#FFE4E1">
		  	<?php 
			echo "0"; 
			?>
		  </td>
        </tr>

        <tr>
          <td colspan="5" height="40" bgcolor="#FFFFFF"><b> </b></td>
        </tr>
			
        <tr>
          <td width="706" colspan="5" bgcolor="#F4A460"><b>Número de Beneficiários DREAMS que receberam TODO pacote primário de serviços mas não receberam nenhum serviço além do pacote primário</b> </td>
        </tr>
        <tr>
          <td width="174" bgcolor="#FAEBD7">Tempo de registo como beneficiário DREAMS </td>
          <td bgcolor="#FAEBD7">10--14</td>
          <td bgcolor="#FAEBD7">15-19</td>
          <td bgcolor="#FAEBD7">20-24</td>
          <td bgcolor="#FAEBD7">25-29</td>
        </tr>
        <tr>
          <td bgcolor="#FFDEAD">0-6 meses </td>
          <td bgcolor="#FFDEAD"> 
		  	<?php 
			echo "5"; 
			?>
		  </td>
          <td bgcolor="#FFDEAD">
		  	<?php 
			echo "5"; 
			?>
		  </td>
          <td bgcolor="#FFDEAD">
		  	<?php 
			echo "5"; 
			?>
		  </td>
          <td bgcolor="#FFDEAD">
		  	<?php 
			echo "0"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#FAEBD7">7-12    meses </td>
          <td bgcolor="#FAEBD7">
		  	<?php 
			echo "5"; 
			?>
		  </td>
          <td bgcolor="#FAEBD7">
		  	<?php 
			echo "5"; 
			?>
		  </td>
          <td bgcolor="#FAEBD7">
		  	<?php 
			echo "5"; 
			?>
		  </td>
          <td bgcolor="#FAEBD7">
		  	<?php 
			echo "0"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#FFDEAD">13-24    meses </td>
          <td bgcolor="#FFDEAD">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#FFDEAD">
		  	<?php 
			echo "1"; 
			?>
		  </td>
          <td bgcolor="#FFDEAD">
		  	<?php 
			echo "1"; 
			?>
		  </td>
          <td bgcolor="#FFDEAD">
		  	<?php 
			echo "0"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#FAEBD7">25 meses ou +</td>
          <td bgcolor="#FAEBD7">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#FAEBD7">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#FAEBD7">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#FAEBD7">
		  	<?php 
			echo "0"; 
			?>
		  </td>

 

        <tr>
          <td colspan="5" height="40" bgcolor="#FFFFFF"><b> </b></td>
        </tr>

        <tr>
          <td colspan="5" bgcolor="#32CD32"><b>Número    de Beneficiários DREAMS que completaram pelo menos um serviço DREAMS mais não completaram o pacote primário de serviços</b></td>
        </tr>
        <tr>
          <td width="174" bgcolor="#F0FFF0">Tempo de registo como beneficiário DREAMS </td>
          <td bgcolor="#F0FFF0">10--14</td>
          <td bgcolor="#F0FFF0">15-19</td>
          <td bgcolor="#F0FFF0">20-24</td>
          <td bgcolor="#F0FFF0">25-29</td>
        </tr>
        <tr>
          <td bgcolor="#98FB98">0-6 meses </td>
          <td bgcolor="#98FB98">
		  	<?php 
			echo "2"; 
			?>
		  </td>
          <td bgcolor="#98FB98">
		  	<?php 
			echo "350"; 
			?>
		  </td>
          <td bgcolor="#98FB98">
		  	<?php 
			echo "199"; 
			?>
		  </td>
          <td bgcolor="#98FB98">
		  	<?php 
			echo "2"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#F0FFF0">7-12    meses </td>
          <td bgcolor="#F0FFF0">
		  	<?php 
			echo "1401"; 
			?>
		  </td>
          <td bgcolor="#F0FFF0">
		  	<?php 
			echo "1652"; 
			?>
		  </td>
          <td bgcolor="#F0FFF0">
		  	<?php 
			echo "797"; 
			?>
		  </td>
          <td bgcolor="#F0FFF0">
		  	<?php 
			echo "8"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#98FB98">13-24    meses </td>
          <td bgcolor="#98FB98">
		  	<?php 
			echo "144"; 
			?>
		  </td>
          <td bgcolor="#98FB98">
		  	<?php 
			echo "1605"; 
			?>
		  </td>
          <td bgcolor="#98FB98">
		  	<?php 
			echo "867"; 
			?>
		  </td>
          <td bgcolor="#98FB98">
		  	<?php 
			echo "4"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#F0FFF0">25 meses ou +</td>
          <td bgcolor="#F0FFF0">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#F0FFF0">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#F0FFF0">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#F0FFF0">
		  	<?php 
			echo "0"; 
			?>
		  </td>
        </tr>
		
		
        <tr>
          <td colspan="5" height="40" bgcolor="#FFFFFF"><b> </b></td>
        </tr>

        <tr>
          <td colspan="5" bgcolor="#FFFFFF"><b>Denominador</b></td>
        </tr>		
		
        <tr>
          <td colspan="5" height="40" bgcolor="#FFFFFF"><b> </b></td>
        </tr>

	
        <tr>
          <td width="706" colspan="5" bgcolor="#1874CD"><b>Número de Beneficiários DREAMS que completaram pelo menos um serviço DREAMS</b> </td>
        </tr>
        <tr>
          <td width="174" bgcolor="#CAE1FF">Tempo de registo como beneficiário DREAMS </td>
          <td bgcolor="#CAE1FF">10--14</td>
          <td bgcolor="#CAE1FF">15-19</td>
          <td bgcolor="#CAE1FF">20-24</td>
          <td bgcolor="#CAE1FF">25-29</td>
        </tr>
        <tr>
          <td bgcolor="#6495ED">0-6 meses </td>
          <td bgcolor="#6495ED"> 
		  	<?php 
			echo "1881"; 
			?>
		  </td>
          <td bgcolor="#6495ED">
		  	<?php 
			echo "1607"; 
			?>
		  </td>
          <td bgcolor="#6495ED">
		  	<?php 
			echo "619"; 
			?>
		  </td>
          <td bgcolor="#6495ED">
		  	<?php 
			echo "2"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#CAE1FF">7-12    meses </td>
          <td bgcolor="#CAE1FF">
		  	<?php 
			echo "1524"; 
			?>
		  </td>
          <td bgcolor="#CAE1FF">
		  	<?php 
			echo "1709";  
			?>
		  </td>
          <td bgcolor="#CAE1FF">
		  	<?php 
			echo "845"; 
			?>
		  </td>
          <td bgcolor="#CAE1FF">
		  	<?php 
			echo "8"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#6495ED">13-24    meses </td>
          <td bgcolor="#6495ED">
		  	<?php 
			echo "144"; 
			?>
		  </td>
          <td bgcolor="#6495ED">
		  	<?php 
			echo "1606"; 
			?>
		  </td>
          <td bgcolor="#6495ED">
		  	<?php 
			echo "868"; 
			?>
		  </td>
          <td bgcolor="#6495ED">
		  	<?php 
			echo "4"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#CAE1FF">25 meses ou +</td>
          <td bgcolor="#CAE1FF">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#CAE1FF">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#CAE1FF">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#CAE1FF">
		  	<?php 
			echo "0"; 
			?>
		  </td>
        </tr>				
		
        <tr>
          <td colspan="5" height="40" bgcolor="#FFFFFF"><b> </b></td>
        </tr>

        <tr>
          <td colspan="5" bgcolor="#FFFFFF"><b>Limpopo</b></td>
        </tr>
		
        <tr>
          <td colspan="5" bgcolor="#FFFFFF"><b>RESUMO Distrital</b></td>
        </tr>
        <tr>
			
          <td colspan="5" bgcolor="#FFFFFF"><b>Total de Adolescentes Jovens Activos: 7.067</b></td>
        </tr> 
        <tr>
          <td colspan="5" bgcolor="#FFFFFF"><b>Total de adolescentes e Jovens do sexo feminino: 6.931</b></td>
        </tr> 
		
        <tr>
          <td colspan="5" bgcolor="#FFFFFF"><b>Total de adolescentes e Jovens do sexo masculino: 136</b></td>
        </tr> 		
		
        <tr>
          <td colspan="5" bgcolor="#FFFFFF"><b>Total de Beneficiarias Activos: 6.516</b></td>
        </tr> 
				
		

        <tr>
          <td colspan="5" height="40" bgcolor="#FFFFFF"><b> </b></td>
        </tr>

        <tr>
          <td colspan="5" bgcolor="#FFFFFF"><b>Numerador</b></td>
        </tr>		
		
        <tr>
          <td colspan="5" height="40" bgcolor="#FFFFFF"><b> </b></td>
        </tr>
  		
        <tr>
          <td width="706" colspan="5" bgcolor="#CD5C5C"><b>Número de Beneficiários DREAMS que receberam TODO pacote primário de serviços E pelos um serviço adicional do pacote secundário </b> </td>
        </tr>
        <tr>
          <td width="174" bgcolor="#FFE4E1">Tempo de registo como beneficiário DREAMS </td>
          <td bgcolor="#FFE4E1">10--14</td>
          <td bgcolor="#FFE4E1">15-19</td>
          <td bgcolor="#FFE4E1">20-24</td>
          <td bgcolor="#FFE4E1">25-29</td>
        </tr>
        <tr>
          <td bgcolor="#CD9B9B">0-6 meses </td>
          <td bgcolor="#CD9B9B"> 
		  	<?php 
			echo "32"; 
			?>
		  </td>
          <td bgcolor="#CD9B9B">
		  	<?php 
			echo "82"; 
			?>
		  </td>
          <td bgcolor="#CD9B9B">
		  	<?php 
			echo "34"; 
			?>
		  </td>
          <td bgcolor="#CD9B9B">
		  	<?php 
			echo "0"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#FFE4E1">7-12    meses </td>
          <td bgcolor="#FFE4E1">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#FFE4E1">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#FFE4E1">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#FFE4E1">
		  	<?php 
			echo"0"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#CD9B9B">13-24    meses </td>
          <td bgcolor="#CD9B9B">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#CD9B9B">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#CD9B9B">
		  	<?php 
			echo "1"; 
			?>
		  </td>
          <td bgcolor="#CD9B9B">
		  	<?php 
			echo "0"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#FFE4E1">25 meses ou +</td>
          <td bgcolor="#FFE4E1">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#FFE4E1">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#FFE4E1">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#FFE4E1">
		  	<?php 
			echo "0"; 
			?>
		  </td>
        </tr>
		
        <tr>
          <td colspan="5" height="40" bgcolor="#FFFFFF"><b> </b></td>
        </tr>
		
        <tr>
          <td width="706" colspan="5" bgcolor="#F4A460"><b>Número de Beneficiários DREAMS que receberam TODO pacote primário de serviços mas não receberam nenhum serviço além do pacote primário
</b> </td>
        </tr>
        <tr>
          <td width="174" bgcolor="#FAEBD7">Tempo de registo como beneficiário DREAMS </td>
          <td bgcolor="#FAEBD7">10--14</td>
          <td bgcolor="#FAEBD7">15-19</td>
          <td bgcolor="#FAEBD7">20-24</td>
          <td bgcolor="#FAEBD7">25-29</td>
        </tr>
        <tr>
          <td bgcolor="#FFDEAD">0-6 meses </td>
          <td bgcolor="#FFDEAD"> 
		  	<?php 
			echo "5"; 
			?>
		  </td>
          <td bgcolor="#FFDEAD">
		  	<?php 
			echo "5"; 
			?>
		  </td>
          <td bgcolor="#FFDEAD">
		  	<?php 
			echo "5"; 
			?>
		  </td>
          <td bgcolor="#FFDEAD">
		  	<?php 
			echo "0"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#FAEBD7">7-12    meses </td>
          <td bgcolor="#FAEBD7">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#FAEBD7">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#FAEBD7">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#FAEBD7">
		  	<?php 
			echo "0"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#FFDEAD">13-24    meses </td>
          <td bgcolor="#FFDEAD">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#FFDEAD">
		  	<?php 
			echo "1"; 
			?>
		  </td>
          <td bgcolor="#FFDEAD">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#FFDEAD">
		  	<?php 
			echo "0"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#FAEBD7">25 meses ou +</td>
          <td bgcolor="#FAEBD7">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#FAEBD7">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#FAEBD7">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#FAEBD7">
		  	<?php 
			echo "0"; 
			?>
		  </td>
        </tr>		

	
        <tr>
          <td colspan="5" height="40" bgcolor="#FFFFFF"><b> </b></td>
        </tr>

		
        <tr>
          <td colspan="5" bgcolor="#32CD32"><b>Número    de Beneficiários DREAMS que completaram pelo menos um serviço DREAMS mais não completaram o pacote primário de serviços </b></td>
        </tr>
        <tr>
          <td width="174" bgcolor="#F0FFF0">Tempo de registo como beneficiário DREAMS </td>
          <td bgcolor="#F0FFF0">10--14</td>
          <td bgcolor="#F0FFF0">15-19</td>
          <td bgcolor="#F0FFF0">20-24</td>
          <td bgcolor="#F0FFF0">25-29</td>
        </tr>
        <tr>
          <td bgcolor="#98FB98">0-6 meses </td>
          <td bgcolor="#98FB98">
		  	<?php 
			echo "752"; 
			?>
		  </td>
          <td bgcolor="#98FB98">
		  	<?php 
			echo "922"; 
			?>
		  </td>
          <td bgcolor="#98FB98">
		  	<?php 
			echo "325"; 
			?>
		  </td>
          <td bgcolor="#98FB98">
		  	<?php 
			echo "0"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#F0FFF0">7-12    meses </td>
          <td bgcolor="#F0FFF0">
		  	<?php 
			echo "466"; 
			?>
		  </td>
          <td bgcolor="#F0FFF0">
		  	<?php 
			echo "569"; 
			?>
		  </td>
          <td bgcolor="#F0FFF0">
		  	<?php 
			echo "256"; 
			?>
		  </td>
          <td bgcolor="#F0FFF0">
		  	<?php 
			echo "1"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#98FB98">13-24    meses </td>
          <td bgcolor="#98FB98">
		  	<?php 
			echo "169"; 
			?>
		  </td>
          <td bgcolor="#98FB98">
		  	<?php 
			echo "1097"; 
			?>
		  </td>
          <td bgcolor="#98FB98">
		  	<?php 
			echo "944"; 
			?>
		  </td>
          <td bgcolor="#98FB98">
		  	<?php 
			echo "23"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#F0FFF0">25 meses ou +</td>
          <td bgcolor="#F0FFF0">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#F0FFF0">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#F0FFF0">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#F0FFF0">
		  	<?php 
			echo "0"; 
			?>
		  </td>
        </tr>
		
		
        <tr>
          <td colspan="5" height="40" bgcolor="#FFFFFF"><b> </b></td>
        </tr>

        <tr>
          <td colspan="5" bgcolor="#FFFFFF"><b>Denominador</b></td>
        </tr>		
		
        <tr>
          <td colspan="5" height="40" bgcolor="#FFFFFF"><b> </b></td>
        </tr>
		
        <tr>
          <td width="706" colspan="5" bgcolor="#1874CD"><b>Número de Beneficiários DREAMS que completaram pelo menos um serviço DREAMS</b> </td>
        </tr>
        <tr>
          <td width="174" bgcolor="#CAE1FF">Tempo de registo como beneficiário DREAMS </td>
          <td bgcolor="#CAE1FF">10--14</td>
          <td bgcolor="#CAE1FF">15-19</td>
          <td bgcolor="#CAE1FF">20-24</td>
          <td bgcolor="#CAE1FF">25-29</td>
        </tr>
        <tr>
          <td bgcolor="#6495ED">0-6 meses </td>
          <td bgcolor="#6495ED"> 
		  	<?php 
			echo "789"; 
			?>
		  </td>
          <td bgcolor="#6495ED">
		  	<?php 
			echo "1009"; 
			?>
		  </td>
          <td bgcolor="#6495ED">
		  	<?php 
			echo "364"; 
			?>
		  </td>
          <td bgcolor="#6495ED">
		  	<?php 
			echo "0"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#CAE1FF">7-12    meses </td>
          <td bgcolor="#CAE1FF">
		  	<?php 
			echo "466"; 
			?>
		  </td>
          <td bgcolor="#CAE1FF">
		  	<?php 
			echo "569";  
			?>
		  </td>
          <td bgcolor="#CAE1FF">
		  	<?php 
			echo "256"; 
			?>
		  </td>
          <td bgcolor="#CAE1FF">
		  	<?php 
			echo "1"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#6495ED">13-24    meses </td>
          <td bgcolor="#6495ED">
		  	<?php 
			echo "169"; 
			?>
		  </td>
          <td bgcolor="#6495ED">
		  	<?php 
			echo "1098"; 
			?>
		  </td>
          <td bgcolor="#6495ED">
		  	<?php 
			echo "945"; 
			?>
		  </td>
          <td bgcolor="#6495ED">
		  	<?php 
			echo "23"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#CAE1FF">25 meses ou +</td>
          <td bgcolor="#CAE1FF">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#CAE1FF">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#CAE1FF">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#CAE1FF">
		  	<?php 
			echo "0"; 
			?>
		  </td>
        </tr>			

        <tr>
          <td colspan="5" height="40" bgcolor="#FFFFFF"><b> </b></td>
        </tr>

        <tr>
          <td colspan="5" bgcolor="#FFFFFF"><b>Chongoene</b></td>
        </tr>

        <tr>
          <td colspan="5" bgcolor="#FFFFFF"><b>RESUMO Distrital</b></td>
        </tr>
        <tr>
			
          <td colspan="5" bgcolor="#FFFFFF"><b>Total de Adolescentes Jovens Activos: 6.010</b></td>
        </tr> 
        <tr>
          <td colspan="5" bgcolor="#FFFFFF"><b>Total de adolescentes e Jovens do sexo feminino: 5.881</b></td>
        </tr> 
		
        <tr>
          <td colspan="5" bgcolor="#FFFFFF"><b>Total de adolescentes e Jovens do sexo masculino: 129</b></td>
        </tr> 		
		
        <tr>
          <td colspan="5" bgcolor="#FFFFFF"><b>Total de Beneficiarias Activos: 5.434</b></td>
        </tr> 
						
		
		
        <tr>
          <td colspan="5" height="40" bgcolor="#FFFFFF"><b> </b></td>
        </tr>

        <tr>
          <td colspan="5" bgcolor="#FFFFFF"><b>Numerador</b></td>
        </tr>		
		
        <tr>
          <td colspan="5" height="40" bgcolor="#FFFFFF"><b> </b></td>
        </tr>
  		
        <tr>
          <td width="706" colspan="5" bgcolor="#CD5C5C"><b>Número de Beneficiários DREAMS que receberam TODO pacote primário de serviços E pelos um serviço adicional do pacote secundário </b> </td>
        </tr>
        <tr>
          <td width="174" bgcolor="#FFE4E1">Tempo de registo como beneficiário DREAMS </td>
          <td bgcolor="#FFE4E1">10--14</td>
          <td bgcolor="#FFE4E1">15-19</td>
          <td bgcolor="#FFE4E1">20-24</td>
          <td bgcolor="#FFE4E1">25-29</td>
        </tr>
        <tr>
          <td bgcolor="#CD9B9B">0-6 meses </td>
          <td bgcolor="#CD9B9B"> 
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#CD9B9B">
		  	<?php 
			echo "3"; 
			?>
		  </td>
          <td bgcolor="#CD9B9B">
		  	<?php 
			echo "2"; 
			?>
		  </td>
          <td bgcolor="#CD9B9B">
		  	<?php 
			echo "0"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#FFE4E1">7-12    meses </td>
          <td bgcolor="#FFE4E1">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#FFE4E1">
		  	<?php 
			echo "2"; 
			?>
		  </td>
          <td bgcolor="#FFE4E1">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#FFE4E1">
		  	<?php 
			echo"0"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#CD9B9B">13-24    meses </td>
          <td bgcolor="#CD9B9B">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#CD9B9B">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#CD9B9B">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#CD9B9B">
		  	<?php 
			echo "0"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#FFE4E1">25 meses ou +</td>
          <td bgcolor="#FFE4E1">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#FFE4E1">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#FFE4E1">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#FFE4E1">
		  	<?php 
			echo "0"; 
			?>
		  </td>
        </tr>

        <tr>
          <td colspan="5" height="40" bgcolor="#FFFFFF"><b> </b></td>
        </tr>
			
        <tr>
          <td width="706" colspan="5" bgcolor="#F4A460"><b>Número de Beneficiários DREAMS que receberam TODO pacote primário de serviços mas não receberam nenhum serviço além do pacote primário
</b> </td>
        </tr>
        <tr>
          <td width="174" bgcolor="#FAEBD7">Tempo de registo como beneficiário DREAMS </td>
          <td bgcolor="#FAEBD7">10--14</td>
          <td bgcolor="#FAEBD7">15-19</td>
          <td bgcolor="#FAEBD7">20-24</td>
          <td bgcolor="#FAEBD7">25-29</td>
        </tr>
        <tr>
          <td bgcolor="#FFDEAD">0-6 meses </td>
          <td bgcolor="#FFDEAD"> 
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#FFDEAD">
		  	<?php 
			echo "5"; 
			?>
		  </td>
          <td bgcolor="#FFDEAD">
		  	<?php 
			echo "2"; 
			?>
		  </td>
          <td bgcolor="#FFDEAD">
		  	<?php 
			echo "0"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#FAEBD7">7-12    meses </td>
          <td bgcolor="#FAEBD7">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#FAEBD7">
		  	<?php 
			echo "1"; 
			?>
		  </td>
          <td bgcolor="#FAEBD7">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#FAEBD7">
		  	<?php 
			echo "0"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#FFDEAD">13-24    meses </td>
          <td bgcolor="#FFDEAD">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#FFDEAD">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#FFDEAD">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#FFDEAD">
		  	<?php 
			echo "0"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#FAEBD7">25 meses ou +</td>
          <td bgcolor="#FAEBD7">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#FAEBD7">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#FAEBD7">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#FAEBD7">
		  	<?php 
			echo "0"; 
			?>
		  </td>
        </tr>		

	

        <tr>
          <td colspan="5" height="40" bgcolor="#FFFFFF"><b> </b></td>
        </tr>

        <tr>
          <td colspan="5" bgcolor="#32CD32"><b>Número    de Beneficiários DREAMS que completaram pelo menos um serviço DREAMS mais não completaram o pacote primário de serviços </b></td>
        </tr>
        <tr>
          <td width="174" bgcolor="#F0FFF0">Tempo de registo como beneficiário DREAMS </td>
          <td bgcolor="#F0FFF0">10--14</td>
          <td bgcolor="#F0FFF0">15-19</td>
          <td bgcolor="#F0FFF0">20-24</td>
          <td bgcolor="#F0FFF0">25-29</td>
        </tr>
        <tr>
          <td bgcolor="#98FB98">0-6 meses </td>
          <td bgcolor="#98FB98">
		  	<?php 
			echo "65"; 
			?>
		  </td>
          <td bgcolor="#98FB98">
		  	<?php 
			echo "191"; 
			?>
		  </td>
          <td bgcolor="#98FB98">
		  	<?php 
			echo "64"; 
			?>
		  </td>
          <td bgcolor="#98FB98">
		  	<?php 
			echo "0"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#F0FFF0">7-12    meses </td>
          <td bgcolor="#F0FFF0">
		  	<?php 
			echo "215"; 
			?>
		  </td>
          <td bgcolor="#F0FFF0">
		  	<?php 
			echo "222"; 
			?>
		  </td>
          <td bgcolor="#F0FFF0">
		  	<?php 
			echo "87"; 
			?>
		  </td>
          <td bgcolor="#F0FFF0">
		  	<?php 
			echo "0"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#98FB98">13-24    meses </td>
          <td bgcolor="#98FB98">
		  	<?php 
			echo "158"; 
			?>
		  </td>
          <td bgcolor="#98FB98">
		  	<?php 
			echo "1437"; 
			?>
		  </td>
          <td bgcolor="#98FB98">
		  	<?php 
			echo "1083"; 
			?>
		  </td>
          <td bgcolor="#98FB98">
		  	<?php 
			echo "34"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#F0FFF0">25 meses ou +</td>
          <td bgcolor="#F0FFF0">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#F0FFF0">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#F0FFF0">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#F0FFF0">
		  	<?php 
			echo "0"; 
			?>
		  </td>
        </tr>
		
        <tr>
          <td colspan="5" height="40" bgcolor="#FFFFFF"><b> </b></td>
        </tr>

        <tr>
          <td colspan="5" bgcolor="#FFFFFF"><b>Denominador</b></td>
        </tr>		
		
        <tr>
          <td colspan="5" height="40" bgcolor="#FFFFFF"><b> </b></td>
        </tr>
		
        <tr>
          <td width="706" colspan="5" bgcolor="#1874CD"><b>Número de Beneficiários DREAMS que completaram pelo menos um serviço DREAMS</b> </td>
        </tr>
        <tr>
          <td width="174" bgcolor="#CAE1FF">Tempo de registo como beneficiário DREAMS </td>
          <td bgcolor="#CAE1FF">10--14</td>
          <td bgcolor="#CAE1FF">15-19</td>
          <td bgcolor="#CAE1FF">20-24</td>
          <td bgcolor="#CAE1FF">25-29</td>
        </tr>
        <tr>
          <td bgcolor="#6495ED">0-6 meses </td>
          <td bgcolor="#6495ED"> 
		  	<?php 
			echo "65"; 
			?>
		  </td>
          <td bgcolor="#6495ED">
		  	<?php 
			echo "199"; 
			?>
		  </td>
          <td bgcolor="#6495ED">
		  	<?php 
			echo "68"; 
			?>
		  </td>
          <td bgcolor="#6495ED">
		  	<?php 
			echo "0"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#CAE1FF">7-12    meses </td>
          <td bgcolor="#CAE1FF">
		  	<?php 
			echo "215"; 
			?>
		  </td>
          <td bgcolor="#CAE1FF">
		  	<?php 
			echo "225";  
			?>
		  </td>
          <td bgcolor="#CAE1FF">
		  	<?php 
			echo "87"; 
			?>
		  </td>
          <td bgcolor="#CAE1FF">
		  	<?php 
			echo "0"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#6495ED">13-24    meses </td>
          <td bgcolor="#6495ED">
		  	<?php 
			echo "158"; 
			?>
		  </td>
          <td bgcolor="#6495ED">
		  	<?php 
			echo "1437"; 
			?>
		  </td>
          <td bgcolor="#6495ED">
		  	<?php 
			echo "1083"; 
			?>
		  </td>
          <td bgcolor="#6495ED">
		  	<?php 
			echo "34"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#CAE1FF">25 meses ou +</td>
          <td bgcolor="#CAE1FF">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#CAE1FF">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#CAE1FF">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#CAE1FF">
		  	<?php 
			echo "0"; 
			?>
		  </td>
        </tr>			
		

        <tr>
          <td colspan="5" height="40" bgcolor="#FFFFFF"><b> </b></td>
        </tr>

        <tr>
          <td colspan="5" bgcolor="#FFFFFF"><b>Chokwe</b></td>
        </tr>  		
        <tr>
		
        <tr>
          <td colspan="5" bgcolor="#FFFFFF"><b>RESUMO Distrital</b></td>
        </tr>
        <tr>
			
          <td colspan="5" bgcolor="#FFFFFF"><b>Total de Adolescentes Jovens Activos: 6.745</b></td>
        </tr> 
        <tr>
          <td colspan="5" bgcolor="#FFFFFF"><b>Total de adolescentes e Jovens do sexo feminino: 6.529</b></td>
        </tr> 
		
        <tr>
          <td colspan="5" bgcolor="#FFFFFF"><b>Total de adolescentes e Jovens do sexo masculino: 216</b></td>
        </tr> 		
		
        <tr>
          <td colspan="5" bgcolor="#FFFFFF"><b>Total de Beneficiarias Activos: 5.713</b></td>
        </tr>  				
		
		
        <tr>
          <td colspan="5" height="40" bgcolor="#FFFFFF"><b> </b></td>
        </tr>

        <tr>
          <td colspan="5" bgcolor="#FFFFFF"><b>Numerador</b></td>
        </tr>		
		
        <tr>
          <td colspan="5" height="40" bgcolor="#FFFFFF"><b> </b></td>
        </tr>
  
  <tr>		
          <td width="706" colspan="5" bgcolor="#CD5C5C"><b>Número de Beneficiários DREAMS que receberam TODO pacote primário de serviços E pelos um serviço adicional do pacote secundário </b> </td>
        </tr>
        <tr>
          <td width="174" bgcolor="#FFE4E1">Tempo de registo como beneficiário DREAMS </td>
          <td bgcolor="#FFE4E1">10--14</td>
          <td bgcolor="#FFE4E1">15-19</td>
          <td bgcolor="#FFE4E1">20-24</td>
          <td bgcolor="#FFE4E1">25-29</td>
        </tr>
        <tr>
          <td bgcolor="#CD9B9B">0-6 meses </td>
          <td bgcolor="#CD9B9B"> 
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#CD9B9B">
		  	<?php 
			echo "86"; 
			?>
		  </td>
          <td bgcolor="#CD9B9B">
		  	<?php 
			echo "8"; 
			?>
		  </td>
          <td bgcolor="#CD9B9B">
		  	<?php 
			echo "0"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#FFE4E1">7-12    meses </td>
          <td bgcolor="#FFE4E1">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#FFE4E1">
		  	<?php 
			echo "56"; 
			?>
		  </td>
          <td bgcolor="#FFE4E1">
		  	<?php 
			echo "8"; 
			?>
		  </td>
          <td bgcolor="#FFE4E1">
		  	<?php 
			echo"0"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#CD9B9B">13-24    meses </td>
          <td bgcolor="#CD9B9B">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#CD9B9B">
		  	<?php 
			echo "1"; 
			?>
		  </td>
          <td bgcolor="#CD9B9B">
		  	<?php 
			echo "1"; 
			?>
		  </td>
          <td bgcolor="#CD9B9B">
		  	<?php 
			echo "0"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#FFE4E1">25 meses ou +</td>
          <td bgcolor="#FFE4E1">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#FFE4E1">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#FFE4E1">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#FFE4E1">
		  	<?php 
			echo "0"; 
			?>
		  </td>
        </tr>

        <tr>
          <td colspan="5" height="40" bgcolor="#FFFFFF"><b> </b></td>
        </tr>
				
        <tr>
          <td width="706" colspan="5" bgcolor="#F4A460"><b>Número de Beneficiários DREAMS que receberam TODO pacote primário de serviços mas não receberam nenhum serviço além do pacote primário
</b> </td>
        </tr>
        <tr>
          <td width="174" bgcolor="#FAEBD7">Tempo de registo como beneficiário DREAMS </td>
          <td bgcolor="#FAEBD7">10--14</td>
          <td bgcolor="#FAEBD7">15-19</td>
          <td bgcolor="#FAEBD7">20-24</td>
          <td bgcolor="#FAEBD7">25-29</td>
        </tr>
        <tr>
          <td bgcolor="#FFDEAD">0-6 meses </td>
          <td bgcolor="#FFDEAD"> 
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#FFDEAD">
		  	<?php 
			echo "3"; 
			?>
		  </td>
          <td bgcolor="#FFDEAD">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#FFDEAD">
		  	<?php 
			echo "0"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#FAEBD7">7-12    meses </td>
          <td bgcolor="#FAEBD7">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#FAEBD7">
		  	<?php 
			echo "1"; 
			?>
		  </td>
          <td bgcolor="#FAEBD7">
		  	<?php 
			echo "1"; 
			?>
		  </td>
          <td bgcolor="#FAEBD7">
		  	<?php 
			echo "0"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#FFDEAD">13-24    meses </td>
          <td bgcolor="#FFDEAD">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#FFDEAD">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#FFDEAD">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#FFDEAD">
		  	<?php 
			echo "0"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#FAEBD7">25 meses ou +</td>
          <td bgcolor="#FAEBD7">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#FAEBD7">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#FAEBD7">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#FAEBD7">
		  	<?php 
			echo "0"; 
			?>
		  </td>
        </tr>		
	

        <tr>
          <td colspan="5" height="40" bgcolor="#FFFFFF"><b> </b></td>
        </tr>

        <tr>
          <td colspan="5" bgcolor="#32CD32"><b>Número    de Beneficiários DREAMS que completaram pelo menos um serviço DREAMS mais não completaram o pacote primário de serviços </b></td>
        </tr>
        <tr>
          <td width="174" bgcolor="#F0FFF0">Tempo de registo como beneficiário DREAMS </td>
          <td bgcolor="#F0FFF0">10--14</td>
          <td bgcolor="#F0FFF0">15-19</td>
          <td bgcolor="#F0FFF0">20-24</td>
          <td bgcolor="#F0FFF0">25-29</td>
        </tr>
        <tr>
          <td bgcolor="#98FB98">0-6 meses </td>
          <td bgcolor="#98FB98">
		  	<?php 
			echo "187"; 
			?>
		  </td>
          <td bgcolor="#98FB98">
		  	<?php 
			echo "310"; 
			?>
		  </td>
          <td bgcolor="#98FB98">
		  	<?php 
			echo "162"; 
			?>
		  </td>
          <td bgcolor="#98FB98">
		  	<?php 
			echo "2"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#F0FFF0">7-12    meses </td>
          <td bgcolor="#F0FFF0">
		  	<?php 
			echo "420"; 
			?>
		  </td>
          <td bgcolor="#F0FFF0">
		  	<?php 
			echo "379"; 
			?>
		  </td>
          <td bgcolor="#F0FFF0">
		  	<?php 
			echo "257"; 
			?>
		  </td>
          <td bgcolor="#F0FFF0">
		  	<?php 
			echo "20"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#98FB98">13-24    meses </td>
          <td bgcolor="#98FB98">
		  	<?php 
			echo "296"; 
			?>
		  </td>
          <td bgcolor="#98FB98">
		  	<?php 
			echo "1906"; 
			?>
		  </td>
          <td bgcolor="#98FB98">
		  	<?php 
			echo "839"; 
			?>
		  </td>
          <td bgcolor="#98FB98">
		  	<?php 
			echo "95"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#F0FFF0">25 meses ou +</td>
          <td bgcolor="#F0FFF0">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#F0FFF0">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#F0FFF0">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#F0FFF0">
		  	<?php 
			echo "0"; 
			?>
		  </td>
        </tr>
		
        <tr>
          <td colspan="5" height="40" bgcolor="#FFFFFF"><b> </b></td>
        </tr>

        <tr>
          <td colspan="5" bgcolor="#FFFFFF"><b>Denominador</b></td>
        </tr>		
		
        <tr>
          <td colspan="5" height="40" bgcolor="#FFFFFF"><b> </b></td>
        </tr>
		
        <tr>
          <td width="706" colspan="5" bgcolor="#1874CD"><b>Número de Beneficiários DREAMS que completaram pelo menos um serviço DREAMS</b> </td>
        </tr>
        <tr>
          <td width="174" bgcolor="#CAE1FF">Tempo de registo como beneficiário DREAMS </td>
          <td bgcolor="#CAE1FF">10--14</td>
          <td bgcolor="#CAE1FF">15-19</td>
          <td bgcolor="#CAE1FF">20-24</td>
          <td bgcolor="#CAE1FF">25-29</td>
        </tr>
        <tr>
          <td bgcolor="#6495ED">0-6 meses </td>
          <td bgcolor="#6495ED"> 
		  	<?php 
			echo "187"; 
			?>
		  </td>
          <td bgcolor="#6495ED">
		  	<?php 
			echo "399"; 
			?>
		  </td>
          <td bgcolor="#6495ED">
		  	<?php 
			echo "170"; 
			?>
		  </td>
          <td bgcolor="#6495ED">
		  	<?php 
			echo "2"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#CAE1FF">7-12    meses </td>
          <td bgcolor="#CAE1FF">
		  	<?php 
			echo "420"; 
			?>
		  </td>
          <td bgcolor="#CAE1FF">
		  	<?php 
			echo "436";  
			?>
		  </td>
          <td bgcolor="#CAE1FF">
		  	<?php 
			echo "266"; 
			?>
		  </td>
          <td bgcolor="#CAE1FF">
		  	<?php 
			echo "20"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#6495ED">13-24    meses </td>
          <td bgcolor="#6495ED">
		  	<?php 
			echo "296"; 
			?>
		  </td>
          <td bgcolor="#6495ED">
		  	<?php 
			echo "1907"; 
			?>
		  </td>
          <td bgcolor="#6495ED">
		  	<?php 
			echo "840"; 
			?>
		  </td>
          <td bgcolor="#6495ED">
		  	<?php 
			echo "95"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#CAE1FF">25 meses ou +</td>
          <td bgcolor="#CAE1FF">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#CAE1FF">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#CAE1FF">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#CAE1FF">
		  	<?php 
			echo "0"; 
			?>
		  </td>
        </tr>			

        <tr>
          <td colspan="5" height="70" bgcolor="#FFFFFF"><b> </b></td>
        </tr>
</table>
</div>

<button class="btn btn-success btn-block mb1 bg-orange" data-toggle="collapse" data-target="#sofala"><b>PROVINCIA DE SOFALA</b></button>

<div id="sofala" class="collapse">

<table width="100%" class="table table-dashed">
        <tr>
          <td colspan="5" bgcolor="#FFFFFF"><b>PROVINCIA DE SOFALA</b></td>
        </tr>	

        <tr>
          <td colspan="5" bgcolor="#FFFFFF"><b>Cidade da Beira</b></td>
        </tr>
		
        <tr>
          <td colspan="5" bgcolor="#FFFFFF"><b>RESUMO Distrital</b></td>
        </tr>
        <tr>
			
          <td colspan="5" bgcolor="#FFFFFF"><b>Total de Adolescentes Jovens Activos: 24.635</b></td>
        </tr> 
        <tr>
          <td colspan="5" bgcolor="#FFFFFF"><b>Total de adolescentes e Jovens do sexo feminino: 17.758</b></td>
        </tr> 
		
        <tr>
          <td colspan="5" bgcolor="#FFFFFF"><b>Total de adolescentes e Jovens do sexo masculino: 6.877</b></td>
        </tr> 		
		
        <tr>
          <td colspan="5" bgcolor="#FFFFFF"><b>Total de Beneficiarias Activos: 15.162</b></td>
        </tr> 
		
        <tr>
          <td colspan="5" bgcolor="#FFFFFF"><b>Total de Beneficiarias que receberam  um serviço qualquer : </b></td>
        </tr>  				
		
		

        <tr>
          <td colspan="5" height="40" bgcolor="#FFFFFF"><b> </b></td>
        </tr>

        <tr>
          <td colspan="5" bgcolor="#FFFFFF"><b>Numerador</b></td>
        </tr>		
		
        <tr>
          <td colspan="5" height="40" bgcolor="#FFFFFF"><b> </b></td>
        </tr>
  		
        <tr>
          <td width="706" colspan="5" bgcolor="#CD5C5C"><b>Número de Beneficiários DREAMS que receberam TODO pacote primário de serviços E pelos um serviço adicional do pacote secundário </b> </td>
        </tr>
        <tr>
          <td width="174" bgcolor="#FFE4E1">Tempo de registo como beneficiário DREAMS </td>
          <td bgcolor="#FFE4E1">10--14</td>
          <td bgcolor="#FFE4E1">15-19</td>
          <td bgcolor="#FFE4E1">20-24</td>
          <td bgcolor="#FFE4E1">25-29</td>
        </tr>
        <tr>
          <td bgcolor="#CD9B9B">0-6 meses </td>
          <td bgcolor="#CD9B9B"> 
		  	<?php 
			echo "21"; 
			?>
		  </td>
          <td bgcolor="#CD9B9B">
		  	<?php 
			echo "103"; 
			?>
		  </td>
          <td bgcolor="#CD9B9B">
		  	<?php 
			echo "35"; 
			?>
		  </td>
          <td bgcolor="#CD9B9B">
		  	<?php 
			echo "1"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#FFE4E1">7-12    meses </td>
          <td bgcolor="#FFE4E1">
		  	<?php 
			echo "9"; 
			?>
		  </td>
          <td bgcolor="#FFE4E1">
		  	<?php 
			echo "76"; 
			?>
		  </td>
          <td bgcolor="#FFE4E1">
		  	<?php 
			echo "40"; 
			?>
		  </td>
          <td bgcolor="#FFE4E1">
		  	<?php 
			echo"2"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#CD9B9B">13-24    meses </td>
          <td bgcolor="#CD9B9B">
		  	<?php 
			echo "8"; 
			?>
		  </td>
          <td bgcolor="#CD9B9B">
		  	<?php 
			echo "65"; 
			?>
		  </td>
          <td bgcolor="#CD9B9B">
		  	<?php 
			echo "16"; 
			?>
		  </td>
          <td bgcolor="#CD9B9B">
		  	<?php 
			echo "1"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#FFE4E1">25 meses ou +</td>
          <td bgcolor="#FFE4E1">
		  	<?php 
			echo "1"; 
			?>
		  </td>
          <td bgcolor="#FFE4E1">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#FFE4E1">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#FFE4E1">
		  	<?php 
			echo "0"; 
			?>
		  </td>
        </tr>

        <tr>
          <td colspan="5" height="40" bgcolor="#FFFFFF"><b> </b></td>
        </tr>
		 		
        <tr>
          <td width="706" colspan="5" bgcolor="#F4A460"><b>Número de Beneficiários DREAMS que receberam TODO pacote primário de serviços mas não receberam nenhum serviço além do pacote primário
</b> </td>
        </tr>
        <tr>
          <td width="174" bgcolor="#FAEBD7">Tempo de registo como beneficiário DREAMS </td>
          <td bgcolor="#FAEBD7">10--14</td>
          <td bgcolor="#FAEBD7">15-19</td>
          <td bgcolor="#FAEBD7">20-24</td>
          <td bgcolor="#FAEBD7">25-29</td>
        </tr>
        <tr>
          <td bgcolor="#FFDEAD">0-6 meses </td>
          <td bgcolor="#FFDEAD"> 
		  	<?php 
			echo "5"; 
			?>
		  </td>
          <td bgcolor="#FFDEAD">
		  	<?php 
			echo "5"; 
			?>
		  </td>
          <td bgcolor="#FFDEAD">
		  	<?php 
			echo "5"; 
			?>
		  </td>
          <td bgcolor="#FFDEAD">
		  	<?php 
			echo "0"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#FAEBD7">7-12    meses </td>
          <td bgcolor="#FAEBD7">
		  	<?php 
			echo "2"; 
			?>
		  </td>
          <td bgcolor="#FAEBD7">
		  	<?php 
			echo "5"; 
			?>
		  </td>
          <td bgcolor="#FAEBD7">
		  	<?php 
			echo "5"; 
			?>
		  </td>
          <td bgcolor="#FAEBD7">
		  	<?php 
			echo "0"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#FFDEAD">13-24    meses </td>
          <td bgcolor="#FFDEAD">
		  	<?php 
			echo "3"; 
			?>
		  </td>
          <td bgcolor="#FFDEAD">
		  	<?php 
			echo "5"; 
			?>
		  </td>
          <td bgcolor="#FFDEAD">
		  	<?php 
			echo "4"; 
			?>
		  </td>
          <td bgcolor="#FFDEAD">
		  	<?php 
			echo "0"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#FAEBD7">25 meses ou +</td>
          <td bgcolor="#FAEBD7">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#FAEBD7">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#FAEBD7">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#FAEBD7">
		  	<?php 
			echo "0"; 
			?>
		  </td>
        </tr>			

        <tr>
          <td colspan="5" height="40" bgcolor="#FFFFFF"><b> </b></td>
        </tr>

        <tr>
          <td colspan="5" bgcolor="#32CD32"><b>Número    de Beneficiários DREAMS que completaram pelo menos um serviço DREAMS mais não completaram o pacote primário de serviços</b></td>
        </tr>
        <tr>
          <td width="174" bgcolor="#F0FFF0">Tempo de registo como beneficiário DREAMS </td>
          <td  bgcolor="#F0FFF0">10--14</td>
          <td  bgcolor="#F0FFF0">15-19</td>
          <td  bgcolor="#F0FFF0">20-24</td>
          <td  bgcolor="#F0FFF0">25-29</td>
        </tr>
        <tr>
          <td bgcolor="#98FB98">0-6 meses </td>
          <td bgcolor="#98FB98">
		  	<?php 
			echo "782"; 
			?>
		  </td>
          <td bgcolor="#98FB98">
		  	<?php 
			echo "1974"; 
			?>
		  </td>
          <td bgcolor="#98FB98">
		  	<?php 
			echo "727"; 
			?>
		  </td>
          <td bgcolor="#98FB98">
		  	<?php 
			echo "1"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#F0FFF0">7-12    meses </td>
          <td bgcolor="#F0FFF0">
		  	<?php 
			echo "333"; 
			?>
		  </td>
          <td bgcolor="#F0FFF0">
		  	<?php 
			echo "864"; 
			?>
		  </td>
          <td bgcolor="#F0FFF0">
		  	<?php 
			echo "433"; 
			?>
		  </td>
          <td bgcolor="#F0FFF0">
		  	<?php 
			echo "3"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#98FB98">13-24    meses </td>
          <td bgcolor="#98FB98">
		  	<?php 
			echo "1811"; 
			?>
		  </td>
          <td bgcolor="#98FB98">
		  	<?php 
			echo "2802"; 
			?>
		  </td>
          <td bgcolor="#98FB98">
		  	<?php 
			echo "1216"; 
			?>
		  </td>
          <td bgcolor="#98FB98">
		  	<?php 
			echo "19"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#F0FFF0">25 meses ou +</td>
          <td bgcolor="#F0FFF0">
		  	<?php 
			echo "186"; 
			?>
		  </td>
          <td bgcolor="#F0FFF0">
		  	<?php 
			echo "275"; 
			?>
		  </td>
          <td bgcolor="#F0FFF0">
		  	<?php 
			echo "137"; 
			?>
		  </td>
          <td bgcolor="#F0FFF0">
		  	<?php 
			echo "0"; 
			?>
		  </td>
        </tr>

        <tr>
          <td colspan="5" height="40" bgcolor="#FFFFFF"><b> </b></td>
        </tr>

        <tr>
          <td colspan="5" bgcolor="#FFFFFF"><b>Denominador</b></td>
        </tr>		
		
        <tr>
          <td colspan="5" height="40" bgcolor="#FFFFFF"><b> </b></td>
        </tr>
	
        <tr>
          <td width="706" colspan="5" bgcolor="#1874CD"><b>Número de Beneficiários DREAMS que completaram pelo menos um serviço DREAMS</b> </td>
        </tr>
        <tr>
          <td width="174" bgcolor="#CAE1FF">Tempo de registo como beneficiário DREAMS </td>
          <td bgcolor="#CAE1FF">10--14</td>
          <td bgcolor="#CAE1FF">15-19</td>
          <td bgcolor="#CAE1FF">20-24</td>
          <td bgcolor="#CAE1FF">25-29</td>
        </tr>
        <tr>
          <td bgcolor="#6495ED">0-6 meses </td>
          <td bgcolor="#6495ED"> 
		  	<?php 
			echo "808"; 
			?>
		  </td>
          <td bgcolor="#6495ED">
		  	<?php 
			echo "2082"; 
			?>
		  </td>
          <td bgcolor="#6495ED">
		  	<?php 
			echo "767"; 
			?>
		  </td>
          <td bgcolor="#6495ED">
		  	<?php 
			echo "2"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#CAE1FF">7-12    meses </td>
          <td bgcolor="#CAE1FF">
		  	<?php 
			echo "344"; 
			?>
		  </td>
          <td bgcolor="#CAE1FF">
		  	<?php 
			echo "945";  
			?>
		  </td>
          <td bgcolor="#CAE1FF">
		  	<?php 
			echo "478"; 
			?>
		  </td>
          <td bgcolor="#CAE1FF">
		  	<?php 
			echo "5"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#6495ED">13-24    meses </td>
          <td bgcolor="#6495ED">
		  	<?php 
			echo "1822"; 
			?>
		  </td>
          <td bgcolor="#6495ED">
		  	<?php 
			echo "2872"; 
			?>
		  </td>
          <td bgcolor="#6495ED">
		  	<?php 
			echo "1236"; 
			?>
		  </td>
          <td bgcolor="#6495ED">
		  	<?php 
			echo "20"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#CAE1FF">25 meses ou +</td>
          <td bgcolor="#CAE1FF">
		  	<?php 
			echo "187"; 
			?>
		  </td>
          <td bgcolor="#CAE1FF">
		  	<?php 
			echo "275"; 
			?>
		  </td>
          <td bgcolor="#CAE1FF">
		  	<?php 
			echo "137"; 
			?>
		  </td>
          <td bgcolor="#CAE1FF">
		  	<?php 
			echo "0"; 
			?>
		  </td>
        </tr>	

        <tr>
          <td colspan="5" height="70" bgcolor="#FFFFFF"><b> </b></td>
        </tr>

</table>

</div>

<button class="btn btn-success btn-block" data-toggle="collapse" data-target="#zambezia"><b>PROVINCIA ZAMBÉZIA</b></button>

<div id="zambezia" class="collapse">

<table width="100%" class="table table-dashed">
        <tr>
          <td colspan="5" bgcolor="#FFFFFF"><b>PROVINCIA ZAMBÉZIA</b></td>
        </tr>	


        <tr>
          <td colspan="5" bgcolor="#FFFFFF"><b>Nicoadala</b></td>
        </tr>
		
        <tr>
          <td colspan="5" bgcolor="#FFFFFF"><b>RESUMO Distrital</b></td>
        </tr>
        <tr>
			
          <td colspan="5" bgcolor="#FFFFFF"><b>Total de Adolescentes Jovens Activos: 16.043</b></td>
        </tr> 
        <tr>
          <td colspan="5" bgcolor="#FFFFFF"><b>Total de adolescentes e Jovens do sexo feminino: 11.941</b></td>
        </tr> 
		
        <tr>
          <td colspan="5" bgcolor="#FFFFFF"><b>Total de adolescentes e Jovens do sexo masculino: 4.102</b></td>
        </tr> 		
		
        <tr>
          <td colspan="5" bgcolor="#FFFFFF"><b>Total de Beneficiarias Activos: 9.989</b></td>
        </tr> 
		
        <tr>
          <td colspan="5" bgcolor="#FFFFFF"><b>Total de Beneficiarias que receberam  um serviço qualquer : </b></td>
        </tr>  				
		
		

        <tr>
          <td colspan="5" height="40" bgcolor="#FFFFFF"><b> </b></td>
        </tr>

        <tr>
          <td colspan="5" bgcolor="#FFFFFF"><b>Numerador</b></td>
        </tr>		
		
        <tr>
          <td colspan="5" height="40" bgcolor="#FFFFFF"><b> </b></td>
        </tr>
  		
        <tr>
          <td width="706" colspan="5" bgcolor="#CD5C5C"><b>Número de Beneficiários DREAMS que receberam TODO pacote primário de serviços E pelos um serviço adicional do pacote secundário </b> </td>
        </tr>
        <tr>
          <td width="174" bgcolor="#FFE4E1">Tempo de registo como beneficiário DREAMS </td>
          <td bgcolor="#FFE4E1">10-14</td>
          <td bgcolor="#FFE4E1">15-19</td>
          <td bgcolor="#FFE4E1">20-24</td>
          <td bgcolor="#FFE4E1">25-29</td>
        </tr>
        <tr>
          <td bgcolor="#CD9B9B">0-6 meses </td>
          <td bgcolor="#CD9B9B"> 
		  	<?php 
			echo "4"; 
			?>
		  </td>
          <td bgcolor="#CD9B9B">
		  	<?php 
			echo "338"; 
			?>
		  </td>
          <td bgcolor="#CD9B9B">
		  	<?php 
			echo "29"; 
			?>
		  </td>
          <td bgcolor="#CD9B9B">
		  	<?php 
			echo "0"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#FFE4E1">7-12    meses </td>
          <td bgcolor="#FFE4E1">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#FFE4E1">
		  	<?php 
			echo "94"; 
			?>
		  </td>
          <td bgcolor="#FFE4E1">
		  	<?php 
			echo "10"; 
			?>
		  </td>
          <td bgcolor="#FFE4E1">
		  	<?php 
			echo"0"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#CD9B9B">13-24    meses </td>
          <td bgcolor="#CD9B9B">
		  	<?php 
			echo "1"; 
			?>
		  </td>
          <td bgcolor="#CD9B9B">
		  	<?php 
			echo "20"; 
			?>
		  </td>
          <td bgcolor="#CD9B9B">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#CD9B9B">
		  	<?php 
			echo "0"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#FFE4E1">25 meses ou +</td>
          <td bgcolor="#FFE4E1">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#FFE4E1">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#FFE4E1">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#FFE4E1">
		  	<?php 
			echo "0"; 
			?>
		  </td>
        </tr>

        <tr>
          <td colspan="5" height="40" bgcolor="#FFFFFF"><b> </b></td>
        </tr>
				
        <tr>
          <td width="706" colspan="5" bgcolor="#F4A460"><b>Número de Beneficiários DREAMS que receberam TODO pacote primário de serviços mas não receberam nenhum serviço além do pacote primário
</b> </td>
        </tr>
        <tr>
          <td width="174" bgcolor="#FAEBD7">Tempo de registo como beneficiário DREAMS </td>
          <td bgcolor="#FAEBD7">10--14</td>
          <td bgcolor="#FAEBD7">15-19</td>
          <td bgcolor="#FAEBD7">20-24</td>
          <td bgcolor="#FAEBD7">25-29</td>
        </tr>
        <tr>
          <td bgcolor="#FFDEAD">0-6 meses </td>
          <td bgcolor="#FFDEAD"> 
		  	<?php 
			echo "3"; 
			?>
		  </td>
          <td bgcolor="#FFDEAD">
		  	<?php 
			echo "5"; 
			?>
		  </td>
          <td bgcolor="#FFDEAD">
		  	<?php 
			echo "5"; 
			?>
		  </td>
          <td bgcolor="#FFDEAD">
		  	<?php 
			echo "0"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#FAEBD7">7-12    meses </td>
          <td bgcolor="#FAEBD7">
		  	<?php 
			echo "2"; 
			?>
		  </td>
          <td bgcolor="#FAEBD7">
		  	<?php 
			echo "5"; 
			?>
		  </td>
          <td bgcolor="#FAEBD7">
		  	<?php 
			echo "4"; 
			?>
		  </td>
          <td bgcolor="#FAEBD7">
		  	<?php 
			echo "0"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#FFDEAD">13-24    meses </td>
          <td bgcolor="#FFDEAD">
		  	<?php 
			echo "1"; 
			?>
		  </td>
          <td bgcolor="#FFDEAD">
		  	<?php 
			echo "5"; 
			?>
		  </td>
          <td bgcolor="#FFDEAD">
		  	<?php 
			echo "1"; 
			?>
		  </td>
          <td bgcolor="#FFDEAD">
		  	<?php 
			echo "0"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#FAEBD7">25 meses ou +</td>
          <td bgcolor="#FAEBD7">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#FAEBD7">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#FAEBD7">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#FAEBD7">
		  	<?php 
			echo "0"; 
			?>
		  </td>
        </tr>			

        <tr>
          <td colspan="5" height="40" bgcolor="#FFFFFF"><b> </b></td>
        </tr>

        <tr>
          <td colspan="5" bgcolor="#32CD32"><b>Número    de Beneficiários DREAMS que completaram pelo menos um serviço DREAMS mais não completaram o pacote primário de serviços</b></td>
        </tr>
        <tr>
          <td width="174" bgcolor="#F0FFF0">Tempo de registo como beneficiário DREAMS </td>
          <td bgcolor="#F0FFF0">10--14</td>
          <td bgcolor="#F0FFF0">15-19</td>
          <td bgcolor="#F0FFF0">20-24</td>
          <td bgcolor="#F0FFF0">25-29</td>
        </tr>
        <tr>
          <td bgcolor="#98FB98">0-6 meses </td>
          <td bgcolor="#98FB98">
		  	<?php 
			echo "1069"; 
			?>
		  </td>
          <td bgcolor="#98FB98">
		  	<?php 
			echo "1402"; 
			?>
		  </td>
          <td bgcolor="#98FB98">
		  	<?php 
			echo "1364"; 
			?>
		  </td>
          <td bgcolor="#98FB98">
		  	<?php 
			echo "1"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#F0FFF0">7-12    meses </td>
          <td bgcolor="#F0FFF0">
		  	<?php 
			echo "283"; 
			?>
		  </td>
          <td bgcolor="#F0FFF0">
		  	<?php 
			echo "744"; 
			?>
		  </td>
          <td bgcolor="#F0FFF0">
		  	<?php 
			echo "495"; 
			?>
		  </td>
          <td bgcolor="#F0FFF0">
		  	<?php 
			echo "9"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#98FB98">13-24    meses </td>
          <td bgcolor="#98FB98">
		  	<?php 
			echo "597"; 
			?>
		  </td>
          <td bgcolor="#98FB98">
		  	<?php 
			echo "1341"; 
			?>
		  </td>
          <td bgcolor="#98FB98">
		  	<?php 
			echo "658"; 
			?>
		  </td>
          <td bgcolor="#98FB98">
		  	<?php 
			echo "90"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#F0FFF0">25 meses ou +</td>
          <td bgcolor="#F0FFF0">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#F0FFF0">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#F0FFF0">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#F0FFF0">
		  	<?php 
			echo "0"; 
			?>
		  </td>
        </tr>


        <tr>
          <td colspan="5" height="40" bgcolor="#FFFFFF"><b> </b></td>
        </tr>

        <tr>
          <td colspan="5" bgcolor="#FFFFFF"><b>Denominador</b></td>
        </tr>		
		
        <tr>
          <td colspan="5" height="40" bgcolor="#FFFFFF"><b> </b></td>
        </tr>
	
        <tr>
          <td width="706" colspan="5" bgcolor="#1874CD"><b>Número de Beneficiários DREAMS que completaram pelo menos um serviço DREAMS</b> </td>
        </tr>
        <tr>
          <td width="174" bgcolor="#CAE1FF">Tempo de registo como beneficiário DREAMS </td>
          <td bgcolor="#CAE1FF">10--14</td>
          <td bgcolor="#CAE1FF">15-19</td>
          <td bgcolor="#CAE1FF">20-24</td>
          <td bgcolor="#CAE1FF">25-29</td>
        </tr>
        <tr>
          <td bgcolor="#6495ED">0-6 meses </td>
          <td bgcolor="#6495ED"> 
		  	<?php 
			echo "1076"; 
			?>
		  </td>
          <td bgcolor="#6495ED">
		  	<?php 
			echo "1745"; 
			?>
		  </td>
          <td bgcolor="#6495ED">
		  	<?php 
			echo "1398"; 
			?>
		  </td>
          <td bgcolor="#6495ED">
		  	<?php 
			echo "1"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#CAE1FF">7-12    meses </td>
          <td bgcolor="#CAE1FF">
		  	<?php 
			echo "285"; 
			?>
		  </td>
          <td bgcolor="#CAE1FF">
		  	<?php 
			echo "843";  
			?>
		  </td>
          <td bgcolor="#CAE1FF">
		  	<?php 
			echo "509"; 
			?>
		  </td>
          <td bgcolor="#CAE1FF">
		  	<?php 
			echo "9"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#6495ED">13-24    meses </td>
          <td bgcolor="#6495ED">
		  	<?php 
			echo "599"; 
			?>
		  </td>
          <td bgcolor="#6495ED">
		  	<?php 
			echo "1366"; 
			?>
		  </td>
          <td bgcolor="#6495ED">
		  	<?php 
			echo "659"; 
			?>
		  </td>
          <td bgcolor="#6495ED">
		  	<?php 
			echo "90"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#CAE1FF">25 meses ou +</td>
          <td bgcolor="#CAE1FF">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#CAE1FF">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#CAE1FF">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#CAE1FF">
		  	<?php 
			echo "0"; 
			?>
		  </td>
        </tr>			

        <tr>
          <td colspan="5" height="40" bgcolor="#FFFFFF"><b> </b></td>
        </tr>

        <tr>
          <td colspan="5" bgcolor="#FFFFFF"><b>Quelimane</b></td>
        </tr>
		
        <tr>
          <td colspan="5" bgcolor="#FFFFFF"><b>RESUMO Distrital</b></td>
        </tr>
        <tr>
			
          <td colspan="5" bgcolor="#FFFFFF"><b>Total de Adolescentes Jovens Activos: 27.878</b></td>
        </tr> 
        <tr>
          <td colspan="5" bgcolor="#FFFFFF"><b>Total de adolescentes e Jovens do sexo feminino: 17.460</b></td>
        </tr> 
		
        <tr>
          <td colspan="5" bgcolor="#FFFFFF"><b>Total de adolescentes e Jovens do sexo masculino: 10.418</b></td>
        </tr> 		
		
        <tr>
          <td colspan="5" bgcolor="#FFFFFF"><b>Total de Beneficiarias Activos: 15.439</b></td>
        </tr> 
		
        <tr>
          <td colspan="5" bgcolor="#FFFFFF"><b>Total de Beneficiarias que receberam  um serviço qualquer : </b></td>
        </tr>  		
		
		

        <tr>
          <td colspan="5" height="40" bgcolor="#FFFFFF"><b> </b></td>
        </tr>

        <tr>
          <td colspan="5" bgcolor="#FFFFFF"><b>Numerador</b></td>
        </tr>		
		
        <tr>
          <td colspan="5" height="40" bgcolor="#FFFFFF"><b> </b></td>
        </tr>
  		
        <tr>
          <td width="706" colspan="5" bgcolor="#CD5C5C"><b>Número de Beneficiários DREAMS que receberam TODO pacote primário de serviços E pelos um serviço adicional do pacote secundário </b> </td>
        </tr>
        <tr>
          <td width="174" bgcolor="#FFE4E1">Tempo de registo como beneficiário DREAMS </td>
          <td bgcolor="#FFE4E1">10--14</td>
          <td bgcolor="#FFE4E1">15-19</td>
          <td bgcolor="#FFE4E1">20-24</td>
          <td bgcolor="#FFE4E1">25-29</td>
        </tr>
        <tr>
          <td bgcolor="#CD9B9B">0-6 meses </td>
          <td bgcolor="#CD9B9B"> 
		  	<?php 
			echo "3"; 
			?>
		  </td>
          <td bgcolor="#CD9B9B">
		  	<?php 
			echo "80"; 
			?>
		  </td>
          <td bgcolor="#CD9B9B">
		  	<?php 
			echo "3"; 
			?>
		  </td>
          <td bgcolor="#CD9B9B">
		  	<?php 
			echo "8"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#FFE4E1">7-12    meses </td>
          <td bgcolor="#FFE4E1">
		  	<?php 
			echo "1"; 
			?>
		  </td>
          <td bgcolor="#FFE4E1">
		  	<?php 
			echo "34"; 
			?>
		  </td>
          <td bgcolor="#FFE4E1">
		  	<?php 
			echo "51"; 
			?>
		  </td>
          <td bgcolor="#FFE4E1">
		  	<?php 
			echo"0"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#CD9B9B">13-24    meses </td>
          <td bgcolor="#CD9B9B">
		  	<?php 
			echo "1"; 
			?>
		  </td>
          <td bgcolor="#CD9B9B">
		  	<?php 
			echo "73"; 
			?>
		  </td>
          <td bgcolor="#CD9B9B">
		  	<?php 
			echo "2"; 
			?>
		  </td>
          <td bgcolor="#CD9B9B">
		  	<?php 
			echo "0"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#FFE4E1">25 meses ou +</td>
          <td bgcolor="#FFE4E1">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#FFE4E1">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#FFE4E1">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#FFE4E1">
		  	<?php 
			echo "0"; 
			?>
		  </td>
        </tr>

        <tr>
          <td colspan="5" height="40" bgcolor="#FFFFFF"><b> </b></td>
        </tr>
			
        <tr>
          <td width="706" colspan="5" bgcolor="#F4A460"><b>Número de Beneficiários DREAMS que receberam TODO pacote primário de serviços mas não receberam nenhum serviço além do pacote primário
</b> </td>
        </tr>
        <tr>
          <td width="174" bgcolor="#FAEBD7">Tempo de registo como beneficiário DREAMS </td>
          <td bgcolor="#FAEBD7">10--14</td>
          <td bgcolor="#FAEBD7">15-19</td>
          <td bgcolor="#FAEBD7">20-24</td>
          <td bgcolor="#FAEBD7">25-29</td>
        </tr>
        <tr>
          <td bgcolor="#FFDEAD">0-6 meses </td>
          <td bgcolor="#FFDEAD"> 
		  	<?php 
			echo "4"; 
			?>
		  </td>
          <td bgcolor="#FFDEAD">
		  	<?php 
			echo "5"; 
			?>
		  </td>
          <td bgcolor="#FFDEAD">
		  	<?php 
			echo "4"; 
			?>
		  </td>
          <td bgcolor="#FFDEAD">
		  	<?php 
			echo "0"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#FAEBD7">7-12    meses </td>
          <td bgcolor="#FAEBD7">
		  	<?php 
			echo "1"; 
			?>
		  </td>
          <td bgcolor="#FAEBD7">
		  	<?php 
			echo "5"; 
			?>
		  </td>
          <td bgcolor="#FAEBD7">
		  	<?php 
			echo "4"; 
			?>
		  </td>
          <td bgcolor="#FAEBD7">
		  	<?php 
			echo "0"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#FFDEAD">13-24    meses </td>
          <td bgcolor="#FFDEAD">
		  	<?php 
			echo "1"; 
			?>
		  </td>
          <td bgcolor="#FFDEAD">
		  	<?php 
			echo "5"; 
			?>
		  </td>
          <td bgcolor="#FFDEAD">
		  	<?php 
			echo "4"; 
			?>
		  </td>
          <td bgcolor="#FFDEAD">
		  	<?php 
			echo "0"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#FAEBD7">25 meses ou +</td>
          <td bgcolor="#FAEBD7">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#FAEBD7">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#FAEBD7">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#FAEBD7">
		  	<?php 
			echo "0"; 
			?>
		  </td>
        </tr>		


        <tr>
          <td colspan="5" height="40" bgcolor="#FFFFFF"><b> </b></td>
        </tr>		
		
        <tr>
          <td width="706" colspan="5" bgcolor="#32CD32"> <b>Número    de Beneficiários DREAMS que completaram pelo menos um serviço DREAMS mais não completaram o pacote primário de serviços </b> </td>
        </tr>
        <tr>
          <td width="174" bgcolor="#F0FFF0">Tempo de registo como beneficiário DREAMS </td>
          <td bgcolor="#F0FFF0">10--14</td>
          <td bgcolor="#F0FFF0">15-19</td>
          <td bgcolor="#F0FFF0">20-24</td>
          <td bgcolor="#F0FFF0">25-29</td>
        </tr>
        <tr>
          <td bgcolor="#98FB98">0-6 meses </td>
          <td bgcolor="#98FB98">
		  	<?php 
			echo "1096"; 
			?>
		  </td>
          <td bgcolor="#98FB98">
		  	<?php 
			echo "2528"; 
			?>
		  </td>
          <td bgcolor="#98FB98">
		  	<?php 
			echo "980"; 
			?>
		  </td>
          <td bgcolor="#98FB98">
		  	<?php 
			echo "0"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#F0FFF0">7-12    meses </td>
          <td bgcolor="#F0FFF0">
		  	<?php 
			echo "1005"; 
			?>
		  </td>
          <td bgcolor="#F0FFF0">
		  	<?php 
			echo "1547"; 
			?>
		  </td>
          <td bgcolor="#F0FFF0">
		  	<?php 
			echo "280"; 
			?>
		  </td>
          <td bgcolor="#F0FFF0">
		  	<?php 
			echo "16"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#98FB98">13-24    meses </td>
          <td bgcolor="#98FB98">
		  	<?php 
			echo "1900"; 
			?>
		  </td>
          <td bgcolor="#98FB98">
		  	<?php 
			echo "3604"; 
			?>
		  </td>
          <td bgcolor="#98FB98">
		  	<?php 
			echo "1050"; 
			?>
		  </td>
          <td bgcolor="#98FB98">
		  	<?php 
			echo "49"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#F0FFF0">25 meses ou +</td>
          <td bgcolor="#F0FFF0">
		  	<?php 
			echo "190"; 
			?>
		  </td>
          <td bgcolor="#F0FFF0">
		  	<?php 
			echo "274"; 
			?>
		  </td>
          <td bgcolor="#F0FFF0">
		  	<?php 
			echo "136"; 
			?>
		  </td>
          <td bgcolor="#F0FFF0">
		  	<?php 
			echo "0"; 
			?>
		  </td>
        </tr>
		
        <tr>
          <td colspan="5" height="40" bgcolor="#FFFFFF"><b> </b></td>
        </tr>

        <tr>
          <td colspan="5" bgcolor="#FFFFFF"><b>Denominador</b></td>
        </tr>		
		
        <tr>
          <td colspan="5" height="40" bgcolor="#FFFFFF"><b> </b></td>
        </tr>
 		
        <tr>
          <td width="706" colspan="5" bgcolor="#1874CD"><b>Número de Beneficiários DREAMS que completaram pelo menos um serviço DREAMS</b> </td>
        </tr>
        <tr>
          <td width="174" bgcolor="#CAE1FF">Tempo de registo como beneficiário DREAMS </td>
          <td bgcolor="#CAE1FF">10--14</td>
          <td bgcolor="#CAE1FF">15-19</td>
          <td bgcolor="#CAE1FF">20-24</td>
          <td bgcolor="#CAE1FF">25-29</td>
        </tr>
        <tr>
          <td bgcolor="#6495ED">0-6 meses </td>
          <td bgcolor="#6495ED"> 
		  	<?php 
			echo "1103"; 
			?>
		  </td>
          <td bgcolor="#6495ED">
		  	<?php 
			echo "2613"; 
			?>
		  </td>
          <td bgcolor="#6495ED">
		  	<?php 
			echo "987"; 
			?>
		  </td>
          <td bgcolor="#6495ED">
		  	<?php 
			echo "8"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#CAE1FF">7-12    meses </td>
          <td bgcolor="#CAE1FF">
		  	<?php 
			echo "1007"; 
			?>
		  </td>
          <td bgcolor="#CAE1FF">
		  	<?php 
			echo "1586";  
			?>
		  </td>
          <td bgcolor="#CAE1FF">
		  	<?php 
			echo "335"; 
			?>
		  </td>
          <td bgcolor="#CAE1FF">
		  	<?php 
			echo "16"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#6495ED">13-24    meses </td>
          <td bgcolor="#6495ED">
		  	<?php 
			echo "1902"; 
			?>
		  </td>
          <td bgcolor="#6495ED">
		  	<?php 
			echo "3682"; 
			?>
		  </td>
          <td bgcolor="#6495ED">
		  	<?php 
			echo "1056"; 
			?>
		  </td>
          <td bgcolor="#6495ED">
		  	<?php 
			echo "49"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#CAE1FF">25 meses ou +</td>
          <td bgcolor="#CAE1FF">
		  	<?php 
			echo "190"; 
			?>
		  </td>
          <td bgcolor="#CAE1FF">
		  	<?php 
			echo "274"; 
			?>
		  </td>
          <td bgcolor="#CAE1FF">
		  	<?php 
			echo "136"; 
			?>
		  </td>
          <td bgcolor="#CAE1FF">
		  	<?php 
			echo "0"; 
			?>
		  </td>
        </tr>		
		

      </table>
</div> 

<button class="btn btn-primary btn-block mb1 bg-navy" data-toggle="collapse" data-target="#subsidio"><b>SUBS&Iacute;DIO ESCOLAR E SESS&Otilde;ES SOBRE PREVEN&Ccedil;&Atilde;O DE HIV E VIOL&Ecirc;CIA POR DISTRITO</b></button>

<div id="subsidio" class="collapse">		
	<table width="100%" class="table table-dashed">
	

        <tr>
          <td width="174" bgcolor="#CD5C5C">Distrito </td>
          <td bgcolor="#CD5C5C">Subsídio Escolar</td>
          <td bgcolor="#CD5C5C"></td>
          <td bgcolor="#CD5C5C">Sessões sobre Prevenção de HIV e Violência</td>
        </tr>
        <tr>
          <td bgcolor="#CD9B9B">Chokwe</td>
          <td bgcolor="#CD9B9B"> 
		  	<?php 
			echo "62"; 
			?>
		  </td>
          <td bgcolor="#CD9B9B">
		  	<?php 
			echo ""; 
			?>
		  </td>
          <td bgcolor="#CD9B9B">
		  	<?php 
			echo "245"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#FFE4E1">Chonguene </td>
          <td bgcolor="#FFE4E1">
		  	<?php 
			echo "44"; 
			?>
		  </td>
          <td bgcolor="#FFE4E1">
		  	<?php 
			echo ""; 
			?>
		  </td>
          <td bgcolor="#FFE4E1">
		  	<?php 
			echo "403"; 
			?>
		  </td>

        </tr>
        <tr>
          <td bgcolor="#CD9B9B">Beira </td>
          <td bgcolor="#CD9B9B">
		  	<?php 
			echo "17"; 
			?>
		  </td>
          <td bgcolor="#CD9B9B">
		  	<?php 
			echo ""; 
			?>
		  </td>
          <td bgcolor="#CD9B9B">
		  	<?php 
			echo "1961"; 
			?>
		  </td>

        </tr>
        <tr>
          <td bgcolor="#FFE4E1">Xai Xai</td>
          <td bgcolor="#FFE4E1">
		  	<?php 
			echo "16"; 
			?>
		  </td>
          <td bgcolor="#FFE4E1">
		  	<?php 
			echo ""; 
			?>
		  </td>
          <td bgcolor="#FFE4E1">
		  	<?php 
			echo "9706"; 
			?>
		  </td>

        </tr>
        <tr>
          <td bgcolor="#CD9B9B">Limpopo </td>
          <td bgcolor="#CD9B9B">
		  	<?php 
			echo "254"; 
			?>
		  </td>
          <td bgcolor="#CD9B9B">
		  	<?php 
			echo ""; 
			?>
		  </td>
          <td bgcolor="#CD9B9B">
		  	<?php 
			echo "957"; 
			?>
		  </td>

        </tr>

        <tr>
          <td bgcolor="#FFE4E1">Matutuine</td>
          <td bgcolor="#FFE4E1">
		  	<?php 
			echo "175"; 
			?>
		  </td>
          <td bgcolor="#FFE4E1">
		  	<?php 
			echo ""; 
			?>
		  </td>
          <td bgcolor="#FFE4E1">
		  	<?php 
			echo "631"; 
			?>
		  </td>

        </tr>

        <tr>
          <td bgcolor="#CD9B9B">Namaacha</td>
          <td bgcolor="#CD9B9B">
		  	<?php 
			echo "457"; 
			?>
		  </td>
          <td bgcolor="#CD9B9B">
		  	<?php 
			echo ""; 
			?>
		  </td>
          <td bgcolor="#CD9B9B">
		  	<?php 
			echo "478"; 
			?>
		  </td>

        </tr>

        <tr>
          <td bgcolor="#FFE4E1">Nicoadala</td>
          <td bgcolor="#FFE4E1">
		  	<?php 
			echo "47"; 
			?>
		  </td>
          <td bgcolor="#FFE4E1">
		  	<?php 
			echo ""; 
			?>
		  </td>
          <td bgcolor="#FFE4E1">
		  	<?php 
			echo "8697"; 
			?>
		  </td>

        </tr>

        <tr>
          <td bgcolor="#CD9B9B">Quelimane</td>
          <td bgcolor="#CD9B9B">
		  	<?php 
			echo "90"; 
			?>
		  </td>
          <td bgcolor="#CD9B9B">
		  	<?php 
			echo ""; 
			?>
		  </td>
          <td bgcolor="#CD9B9B">
		  	<?php 
			echo "6215"; 
			?>
		  </td>

        </tr>

        <tr>
          <td bgcolor="#FFE4E1">Total</td>
          <td bgcolor="#FFE4E1">
		  	<?php 
			echo "1324"; 
			?>
		  </td>
          <td bgcolor="#FFE4E1">
		  	<?php 
			echo ""; 
			?>
		  </td>
          <td bgcolor="#FFE4E1">
		  	<?php 
			echo "38059"; 
			?>
		  </td>

        </tr>		
		
</table>
</div>


    </div>

  </div>
</div>

</div>
