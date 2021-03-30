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
           <div class="panel-heading"><i class="fa fa-dashboard  text-primary"></i> <strong>  Indicador AGYW_Prev Desagregado por Tempo de Registo e Idade (MER 2.3) </strong></div>
  <div class="panel-body">


    <div class="row"> </div>


     <table width="100%" class="table table-dashed">
        <col width="174">
        <col width="117">
        <col width="119">
        <col width="154">
        <col width="142">

        
        <tr>
          <td colspan="5" bgcolor="#FFFFFF"><b>RESUMO NACIONAL Actualizado no dia 11 de Fevereiro de 2020</b></td>
        </tr>
       <tr>
          <td colspan="5" bgcolor="#FFFFFF"><b>Dados de 01 de Outubro de 2017 a 31 de Dezembro de 2019</b></td>
        </tr>
        <tr>
			
          <td colspan="5" bgcolor="#FFFFFF"><b>Total de Adolescentes Jovens Activos: 116.210</b></td>
        </tr> 
        <tr>
          <td colspan="5" bgcolor="#FFFFFF"><b>Total de adolescentes e Jovens do sexo feminino: 83.503</b></td>
        </tr> 
        <tr>
          <td colspan="5" bgcolor="#FFFFFF"><b>Total de Beneficiarias: 61.850</b></td>
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
			
         <td colspan="5" bgcolor="#FFFFFF"><b>Total de Adolescentes Jovens Activos: 2.227</b></td>
        </tr> 
        <tr>
          <td colspan="5" bgcolor="#FFFFFF"><b>Total de adolescentes e Jovens do sexo feminino: 2.224</b></td>
        </tr> 
		
        <tr>
          <td colspan="5" bgcolor="#FFFFFF"><b>Total de adolescentes e Jovens do sexo masculino: 3</b></td>
        </tr> 		
		
        <tr>
          <td colspan="5" bgcolor="#FFFFFF"><b>Total de Beneficiarias Activos: 1.735</b></td>
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
          <td width="706" colspan="5" bgcolor="#CD5C5C"><b>Número de Beneficiários DREAMS que receberam TODO pacote primário de serviços E pelos um serviço adicional do pacote secundário </b> </td>
        </tr>
        <tr>
          <td width="174" bgcolor="#FFE4E1">Tempo de registo como beneficiário DREAMS </td>
          <td bgcolor="#FFE4E1">10--14</td>
          <td bgcolor="#FFE4E1">15-19</td>
          <td bgcolor="#FFE4E1">20-24</td>
          <td bgcolor="#FFE4E1">25-29</td>
        </tr>
        <tr>
          <td bgcolor="#CD9B9B">0-6 meses </td>
          <td bgcolor="#CD9B9B"> 
		  	<?php 
			echo "40"; 
			?>
		  </td>
          <td bgcolor="#CD9B9B">
		  	<?php 
			echo "85"; 
			?>
		  </td>
          <td bgcolor="#CD9B9B">
		  	<?php 
			echo "21"; 
			?>
		  </td>
          <td bgcolor="#CD9B9B">
		  	<?php 
			echo "0"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#FFE4E1">7-12    meses </td>
          <td bgcolor="#FFE4E1">
		  	<?php 
			echo "186"; 
			?>
		  </td>
          <td bgcolor="#FFE4E1">
		  	<?php 
			echo "69"; 
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
          <td bgcolor="#CD9B9B">13-24    meses </td>
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
</b> </td>
        </tr>
        <tr>
          <td width="174" bgcolor="#FAEBD7">Tempo de registo como beneficiário DREAMS </td>
          <td bgcolor="#FAEBD7">10--14</td>
          <td bgcolor="#FAEBD7">15-19</td>
          <td bgcolor="#FAEBD7">20-24</td>
          <td bgcolor="#FAEBD7">25-29</td>
        </tr>
        <tr>
          <td bgcolor="#FFDEAD">0-6 meses </td>
          <td bgcolor="#FFDEAD"> 
		  	<?php 
			echo "164"; 
			?>
		  </td>
          <td bgcolor="#FFDEAD">
		  	<?php 
			echo "72"; 
			?>
		  </td>
          <td bgcolor="#FFDEAD">
		  	<?php 
			echo "7"; 
			?>
		  </td>
          <td bgcolor="#FFDEAD">
		  	<?php 
			echo "0"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#FAEBD7">7-12    meses </td>
          <td bgcolor="#FAEBD7">
		  	<?php 
			echo "676"; 
			?>
		  </td>
          <td bgcolor="#FAEBD7">
		  	<?php 
			echo "261"; 
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
          <td bgcolor="#FFDEAD">13-24    meses </td>
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
          <td colspan="5" bgcolor="#32CD32"><b>Número    de Beneficiários DREAMS que completaram pelo menos um serviço DREAMS mais não completaram o pacote primário de serviços </b></td>
        </tr>
        <tr>
          <td width="174" bgcolor="#F0FFF0">Tempo de registo como beneficiário DREAMS </td>
          <td bgcolor="#F0FFF0">10--14</td>
          <td bgcolor="#F0FFF0">15-19</td>
          <td bgcolor="#F0FFF0">20-24</td>
          <td bgcolor="#F0FFF0">25-29</td>
        </tr>
        <tr>
          <td bgcolor="#98FB98">0-6 meses </td>
          <td bgcolor="#98FB98">
		  	<?php 
			echo "29"; 
			?>
		  </td>
          <td bgcolor="#98FB98">
		  	<?php 
			echo "8"; 
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
          <td bgcolor="#F0FFF0">7-12    meses </td>
          <td bgcolor="#F0FFF0">
		  	<?php 
			echo "85"; 
			?>
		  </td>
          <td bgcolor="#F0FFF0">
		  	<?php 
			echo "32"; 
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
          <td bgcolor="#98FB98">13-24    meses </td>
          <td bgcolor="#98FB98">
		  	<?php 
			echo "0"; 
			?>
		  </td>
          <td bgcolor="#98FB98">
		  	<?php 
			echo "2"; 
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
          <td width="706" colspan="5" bgcolor="#1874CD"><b>Número de Beneficiários DREAMS que completaram pelo menos um serviço DREAMS</b> </td>
        </tr>
        <tr>
          <td width="174" bgcolor="#CAE1FF">Tempo de registo como beneficiário DREAMS </td>
          <td bgcolor="#CAE1FF">10--14</td>
          <td bgcolor="#CAE1FF">15-19</td>
          <td bgcolor="#CAE1FF">20-24</td>
          <td bgcolor="#CAE1FF">25-29</td>
        </tr>
        <tr >
          <td bgcolor="#6495ED">0-6 meses </td>
          <td bgcolor="#6495ED"> 
		  	<?php 
			echo "233"; 
			?>
		  </td>
          <td bgcolor="#6495ED">
		  	<?php 
			echo "165"; 
			?>
		  </td>
          <td bgcolor="#6495ED">
		  	<?php 
			echo "28"; 
			?>
		  </td>
          <td bgcolor="#6495ED">
		  	<?php 
			echo "0"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#CAE1FF">7-12    meses </td>
          <td bgcolor="#CAE1FF">
		  	<?php 
			echo "947"; 
			?>
		  </td>
          <td bgcolor="#CAE1FF">
		  	<?php 
			echo "362";  
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
          <td bgcolor="#6495ED">13-24    meses </td>
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
			          			
          <td colspan="5" bgcolor="#FFFFFF"><b>Total de Adolescentes Jovens Activos: 2.878/b></td>
        </tr> 
        <tr>
          <td colspan="5" bgcolor="#FFFFFF"><b>Total de adolescentes e Jovens do sexo feminino: 2.853</b></td>
        </tr> 
		
        <tr>
          <td colspan="5" bgcolor="#FFFFFF"><b>Total de adolescentes e Jovens do sexo masculino: 25</b></td>
        </tr> 		
		
        <tr>
          <td colspan="5" bgcolor="#FFFFFF"><b>Total de Beneficiarias Activos: 1.978</b></td>
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
          <td width="706" colspan="5" bgcolor="#CD5C5C"><b>Número de Beneficiários DREAMS que receberam TODO pacote primário de serviços E pelos um serviço adicional do pacote secundário </b> </td>
        </tr>
        <tr>
          <td width="174" bgcolor="#FFE4E1">Tempo de registo como beneficiário DREAMS </td>
          <td bgcolor="#FFE4E1">10--14</td>
          <td bgcolor="#FFE4E1">15-19</td>
          <td bgcolor="#FFE4E1">20-24</td>
          <td bgcolor="#FFE4E1">25-29</td>
        </tr>
        <tr>
          <td bgcolor="#CD9B9B">0-6 meses </td>
          <td bgcolor="#CD9B9B"> 
		  	<?php 
			echo "202"; 
			?>
		  </td>
          <td bgcolor="#CD9B9B">
		  	<?php 
			echo "226"; 
			?>
		  </td>
          <td bgcolor="#CD9B9B">
		  	<?php 
			echo "5"; 
			?>
		  </td>
          <td bgcolor="#CD9B9B">
		  	<?php 
			echo "0"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#FFE4E1">7-12    meses </td>
          <td bgcolor="#FFE4E1">
		  	<?php 
			echo "301"; 
			?>
		  </td>
          <td bgcolor="#FFE4E1">
		  	<?php 
			echo "177"; 
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
          <td bgcolor="#CD9B9B">13-24    meses </td>
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
		</b> </td>
        </tr>
        <tr>
          <td width="174" bgcolor="#FAEBD7">Tempo de registo como beneficiário DREAMS </td>
          <td bgcolor="#FAEBD7">10--14</td>
          <td bgcolor="#FAEBD7">15-19</td>
          <td bgcolor="#FAEBD7">20-24</td>
          <td bgcolor="#FAEBD7">25-29</td>
        </tr>
        <tr>
          <td bgcolor="#FFDEAD">0-6 meses </td>
          <td bgcolor="#FFDEAD"> 
		  	<?php 
			echo "212"; 
			?>
		  </td>
          <td bgcolor="#FFDEAD">
		  	<?php 
			echo "151"; 
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
        </tr>
        <tr>
          <td bgcolor="#FAEBD7">7-12    meses </td>
          <td bgcolor="#FAEBD7">
		  	<?php 
			echo "214"; 
			?>
		  </td>
          <td bgcolor="#FAEBD7">
		  	<?php 
			echo "162"; 
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
          <td bgcolor="#FFDEAD">13-24    meses </td>
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
          <td colspan="5" bgcolor="#32CD32"><b>Número de Beneficiários DREAMS que completaram pelo menos um serviço DREAMS mais não completaram o pacote primário de serviços </b></td>
        </tr>
        <tr>
          <td width="174" bgcolor="#F0FFF0">Tempo de registo como beneficiário DREAMS </td>
          <td bgcolor="#F0FFF0">10--14</td>
          <td bgcolor="#F0FFF0">15-19</td>
          <td bgcolor="#F0FFF0">20-24</td>
          <td bgcolor="#F0FFF0">25-29</td>
        </tr>
        <tr>
          <td bgcolor="#98FB98">0-6 meses </td>
          <td bgcolor="#98FB98">
		  	<?php 
			echo "95"; 
			?>
		  </td>
          <td bgcolor="#98FB98">
		  	<?php 
			echo "87"; 
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
          <td bgcolor="#F0FFF0">7-12    meses </td>
          <td bgcolor="#F0FFF0">
		  	<?php 
			echo "105"; 
			?>
		  </td>
          <td bgcolor="#F0FFF0">
		  	<?php 
			echo "35"; 
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
          <td bgcolor="#98FB98">13-24    meses </td>
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
          <td width="706" colspan="5" bgcolor="#1874CD"><b>Número de Beneficiários DREAMS que completaram pelo menos um serviço DREAMS</b> </td>
        </tr>
        <tr>
          <td width="174" bgcolor="#CAE1FF">Tempo de registo como beneficiário DREAMS </td>
          <td bgcolor="#CAE1FF">10--14</td>
          <td bgcolor="#CAE1FF">15-19</td>
          <td bgcolor="#CAE1FF">20-24</td>
          <td bgcolor="#CAE1FF">25-29</td>
        </tr>
        <tr>
          <td bgcolor="#6495ED">0-6 meses </td>
          <td bgcolor="#6495ED"> 
		  	<?php 
			echo "509"; 
			?>
		  </td>
          <td bgcolor="#6495ED">
		  	<?php 
			echo "464"; 
			?>
		  </td>
          <td bgcolor="#6495ED">
		  	<?php 
			echo "11"; 
			?>
		  </td>
          <td bgcolor="#6495ED">
		  	<?php 
			echo "0"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#CAE1FF">7-12    meses </td>
          <td bgcolor="#CAE1FF">
		  	<?php 
			echo "620"; 
			?>
		  </td>
          <td bgcolor="#CAE1FF">
		  	<?php 
			echo "374";  
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
          <td bgcolor="#6495ED">13-24    meses </td>
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
			
          <td colspan="5" bgcolor="#FFFFFF"><b>Total de Adolescentes Jovens Activos: 12.965 </b></td>
        </tr> 
        <tr>
          <td colspan="5" bgcolor="#FFFFFF"><b>Total de adolescentes e Jovens do sexo feminino: 12.685 </b></td>
        </tr> 
		
        <tr>
          <td colspan="5" bgcolor="#FFFFFF"><b>Total de adolescentes e Jovens do sexo masculino: 280 </b></td>
        </tr> 		
		
        <tr>
          <td colspan="5" bgcolor="#FFFFFF"><b>Total de Beneficiarias Activos: 9.592 </b></td>
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
		
          <td width="706" colspan="5" bgcolor="#CD5C5C"><b>Número de Beneficiários DREAMS que receberam TODO pacote primário de serviços E pelos um serviço adicional do pacote secundário </b> </td>
        </tr>
        <tr>
          <td width="174" bgcolor="#FFE4E1">Tempo de registo como beneficiário DREAMS </td>
          <td bgcolor="#FFE4E1">10--14</td>
          <td bgcolor="#FFE4E1">15-19</td>
          <td bgcolor="#FFE4E1">20-24</td>
          <td bgcolor="#FFE4E1">25-29</td>
        </tr>
        <tr>
          <td bgcolor="#CD9B9B">0-6 meses </td>
          <td bgcolor="#CD9B9B"> 
		  	<?php 
			echo "10"; 
			?>
		  </td>
          <td bgcolor="#CD9B9B">
		  	<?php 
			echo "574"; 
			?>
		  </td>
          <td bgcolor="#CD9B9B">
		  	<?php 
			echo "17"; 
			?>
		  </td>
          <td bgcolor="#CD9B9B">
		  	<?php 
			echo "0"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#FFE4E1">7-12    meses </td>
          <td bgcolor="#FFE4E1">
		  	<?php 
			echo "290"; 
			?>
		  </td>
          <td bgcolor="#FFE4E1">
		  	<?php 
			echo "2192"; 
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
          <td bgcolor="#CD9B9B">13-24    meses </td>
          <td bgcolor="#CD9B9B">
		  	<?php 
			echo "120"; 
			?>
		  </td>
          <td bgcolor="#CD9B9B">
		  	<?php 
			echo "1509"; 
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
          <td width="706" colspan="5" bgcolor="#F4A460"><b>Número de Beneficiários DREAMS que receberam TODO pacote primário de serviços mas não receberam nenhum serviço além do pacote primário</b> </td>
        </tr>
        <tr>
          <td width="174" bgcolor="#FAEBD7">Tempo de registo como beneficiário DREAMS </td>
          <td bgcolor="#FAEBD7">10--14</td>
          <td bgcolor="#FAEBD7">15-19</td>
          <td bgcolor="#FAEBD7">20-24</td>
          <td bgcolor="#FAEBD7">25-29</td>
        </tr>
        <tr>
          <td bgcolor="#FFDEAD">0-6 meses </td>
          <td bgcolor="#FFDEAD"> 
		  	<?php 
			echo "150"; 
			?>
		  </td>
          <td bgcolor="#FFDEAD">
		  	<?php 
			echo "888"; 
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
          <td bgcolor="#FAEBD7">7-12    meses </td>
          <td bgcolor="#FAEBD7">
		  	<?php 
			echo "2264"; 
			?>
		  </td>
          <td bgcolor="#FAEBD7">
		  	<?php 
			echo "217"; 
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
          <td bgcolor="#FFDEAD">13-24    meses </td>
          <td bgcolor="#FFDEAD">
		  	<?php 
			echo "33"; 
			?>
		  </td>
          <td bgcolor="#FFDEAD">
		  	<?php 
			echo "155"; 
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

 

        <tr>
          <td colspan="5" height="40" bgcolor="#FFFFFF"><b> </b></td>
        </tr>

        <tr>
          <td colspan="5" bgcolor="#32CD32"><b>Número    de Beneficiários DREAMS que completaram pelo menos um serviço DREAMS mais não completaram o pacote primário de serviços</b></td>
        </tr>
        <tr>
          <td width="174" bgcolor="#F0FFF0">Tempo de registo como beneficiário DREAMS </td>
          <td bgcolor="#F0FFF0">10--14</td>
          <td bgcolor="#F0FFF0">15-19</td>
          <td bgcolor="#F0FFF0">20-24</td>
          <td bgcolor="#F0FFF0">25-29</td>
        </tr>
        <tr>
          <td bgcolor="#98FB98">0-6 meses </td>
          <td bgcolor="#98FB98">
		  	<?php 
			echo "19"; 
			?>
		  </td>
          <td bgcolor="#98FB98">
		  	<?php 
			echo "177"; 
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
          <td bgcolor="#F0FFF0">7-12    meses </td>
          <td bgcolor="#F0FFF0">
		  	<?php 
			echo "311"; 
			?>
		  </td>
          <td bgcolor="#F0FFF0">
		  	<?php 
			echo "98"; 
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
          <td bgcolor="#98FB98">13-24    meses </td>
          <td bgcolor="#98FB98">
		  	<?php 
			echo "41"; 
			?>
		  </td>
          <td bgcolor="#98FB98">
		  	<?php 
			echo "523"; 
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
          <td width="706" colspan="5" bgcolor="#1874CD"><b>Número de Beneficiários DREAMS que completaram pelo menos um serviço DREAMS</b> </td>
        </tr>
        <tr>
          <td width="174" bgcolor="#CAE1FF">Tempo de registo como beneficiário DREAMS </td>
          <td bgcolor="#CAE1FF">10--14</td>
          <td bgcolor="#CAE1FF">15-19</td>
          <td bgcolor="#CAE1FF">20-24</td>
          <td bgcolor="#CAE1FF">25-29</td>
        </tr>
        <tr>
          <td bgcolor="#6495ED">0-6 meses </td>
          <td bgcolor="#6495ED"> 
		  	<?php 
			echo "179"; 
			?>
		  </td>
          <td bgcolor="#6495ED">
		  	<?php 
			echo "1639"; 
			?>
		  </td>
          <td bgcolor="#6495ED">
		  	<?php 
			echo "21"; 
			?>
		  </td>
          <td bgcolor="#6495ED">
		  	<?php 
			echo "0"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#CAE1FF">7-12    meses </td>
          <td bgcolor="#CAE1FF">
		  	<?php 
			echo "2865"; 
			?>
		  </td>
          <td bgcolor="#CAE1FF">
		  	<?php 
			echo "2507";  
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
          <td bgcolor="#6495ED">13-24    meses </td>
          <td bgcolor="#6495ED">
		  	<?php 
			echo "194"; 
			?>
		  </td>
          <td bgcolor="#6495ED">
		  	<?php 
			echo "2187"; 
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
          <td colspan="5" bgcolor="#FFFFFF"><b>Limpopo</b></td>
        </tr>
		
        <tr>
          <td colspan="5" bgcolor="#FFFFFF"><b>RESUMO Distrital</b></td>
        </tr>
        <tr>
			
          <td colspan="5" bgcolor="#FFFFFF"><b>Total de Adolescentes Jovens Activos: 6.727</b></td>
        </tr> 
        <tr>
          <td colspan="5" bgcolor="#FFFFFF"><b>Total de adolescentes e Jovens do sexo feminino: 6.628</b></td>
        </tr> 
		
        <tr>
          <td colspan="5" bgcolor="#FFFFFF"><b>Total de adolescentes e Jovens do sexo masculino: 99</b></td>
        </tr> 		
		
        <tr>
          <td colspan="5" bgcolor="#FFFFFF"><b>Total de Beneficiarias Activos: 4.634</b></td>
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
          <td width="706" colspan="5" bgcolor="#CD5C5C"><b>Número de Beneficiários DREAMS que receberam TODO pacote primário de serviços E pelos um serviço adicional do pacote secundário </b> </td>
        </tr>
        <tr>
          <td width="174" bgcolor="#FFE4E1">Tempo de registo como beneficiário DREAMS </td>
          <td bgcolor="#FFE4E1">10--14</td>
          <td bgcolor="#FFE4E1">15-19</td>
          <td bgcolor="#FFE4E1">20-24</td>
          <td bgcolor="#FFE4E1">25-29</td>
        </tr>
        <tr>
          <td bgcolor="#CD9B9B">0-6 meses </td>
          <td bgcolor="#CD9B9B"> 
		  	<?php 
			echo "15"; 
			?>
		  </td>
          <td bgcolor="#CD9B9B">
		  	<?php 
			echo "95"; 
			?>
		  </td>
          <td bgcolor="#CD9B9B">
		  	<?php 
			echo "48"; 
			?>
		  </td>
          <td bgcolor="#CD9B9B">
		  	<?php 
			echo "0"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#FFE4E1">7-12    meses </td>
          <td bgcolor="#FFE4E1">
		  	<?php 
			echo "366"; 
			?>
		  </td>
          <td bgcolor="#FFE4E1">
		  	<?php 
			echo "588"; 
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
          <td bgcolor="#CD9B9B">13-24    meses </td>
          <td bgcolor="#CD9B9B">
		  	<?php 
			echo "86"; 
			?>
		  </td>
          <td bgcolor="#CD9B9B">
		  	<?php 
			echo "567"; 
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
</b> </td>
        </tr>
        <tr>
          <td width="174" bgcolor="#FAEBD7">Tempo de registo como beneficiário DREAMS </td>
          <td bgcolor="#FAEBD7">10--14</td>
          <td bgcolor="#FAEBD7">15-19</td>
          <td bgcolor="#FAEBD7">20-24</td>
          <td bgcolor="#FAEBD7">25-29</td>
        </tr>
        <tr>
          <td bgcolor="#FFDEAD">0-6 meses </td>
          <td bgcolor="#FFDEAD"> 
		  	<?php 
			echo "129"; 
			?>
		  </td>
          <td bgcolor="#FFDEAD">
		  	<?php 
			echo "207"; 
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
          <td bgcolor="#FAEBD7">7-12    meses </td>
          <td bgcolor="#FAEBD7">
		  	<?php 
			echo "690"; 
			?>
		  </td>
          <td bgcolor="#FAEBD7">
		  	<?php 
			echo "513"; 
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
          <td bgcolor="#FFDEAD">13-24    meses </td>
          <td bgcolor="#FFDEAD">
		  	<?php 
			echo "54"; 
			?>
		  </td>
          <td bgcolor="#FFDEAD">
		  	<?php 
			echo "350"; 
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
          <td colspan="5" bgcolor="#32CD32"><b>Número    de Beneficiários DREAMS que completaram pelo menos um serviço DREAMS mais não completaram o pacote primário de serviços </b></td>
        </tr>
        <tr>
          <td width="174" bgcolor="#F0FFF0">Tempo de registo como beneficiário DREAMS </td>
          <td bgcolor="#F0FFF0">10--14</td>
          <td bgcolor="#F0FFF0">15-19</td>
          <td bgcolor="#F0FFF0">20-24</td>
          <td bgcolor="#F0FFF0">25-29</td>
        </tr>
        <tr>
          <td bgcolor="#98FB98">0-6 meses </td>
          <td bgcolor="#98FB98">
		  	<?php 
			echo "6"; 
			?>
		  </td>
          <td bgcolor="#98FB98">
		  	<?php 
			echo "26"; 
			?>
		  </td>
          <td bgcolor="#98FB98">
		  	<?php 
			echo "17"; 
			?>
		  </td>
          <td bgcolor="#98FB98">
		  	<?php 
			echo "0"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#F0FFF0">7-12    meses </td>
          <td bgcolor="#F0FFF0">
		  	<?php 
			echo "108"; 
			?>
		  </td>
          <td bgcolor="#F0FFF0">
		  	<?php 
			echo "127"; 
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
          <td bgcolor="#98FB98">13-24    meses </td>
          <td bgcolor="#98FB98">
		  	<?php 
			echo "13"; 
			?>
		  </td>
          <td bgcolor="#98FB98">
		  	<?php 
			echo "468"; 
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
          <td width="706" colspan="5" bgcolor="#1874CD"><b>Número de Beneficiários DREAMS que completaram pelo menos um serviço DREAMS</b> </td>
        </tr>
        <tr>
          <td width="174" bgcolor="#CAE1FF">Tempo de registo como beneficiário DREAMS </td>
          <td bgcolor="#CAE1FF">10--14</td>
          <td bgcolor="#CAE1FF">15-19</td>
          <td bgcolor="#CAE1FF">20-24</td>
          <td bgcolor="#CAE1FF">25-29</td>
        </tr>
        <tr>
          <td bgcolor="#6495ED">0-6 meses </td>
          <td bgcolor="#6495ED"> 
		  	<?php 
			echo "150"; 
			?>
		  </td>
          <td bgcolor="#6495ED">
		  	<?php 
			echo "328"; 
			?>
		  </td>
          <td bgcolor="#6495ED">
		  	<?php 
			echo "65"; 
			?>
		  </td>
          <td bgcolor="#6495ED">
		  	<?php 
			echo "0"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#CAE1FF">7-12    meses </td>
          <td bgcolor="#CAE1FF">
		  	<?php 
			echo "1164"; 
			?>
		  </td>
          <td bgcolor="#CAE1FF">
		  	<?php 
			echo "1228";  
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
          <td bgcolor="#6495ED">13-24    meses </td>
          <td bgcolor="#6495ED">
		  	<?php 
			echo "221"; 
			?>
		  </td>
          <td bgcolor="#6495ED">
		  	<?php 
			echo "1478"; 
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
          <td colspan="5" bgcolor="#FFFFFF"><b>Chongoene</b></td>
        </tr>

        <tr>
          <td colspan="5" bgcolor="#FFFFFF"><b>RESUMO Distrital</b></td>
        </tr>
        <tr>
			
          <td colspan="5" bgcolor="#FFFFFF"><b>Total de Adolescentes Jovens Activos: 4.176</b></td>
        </tr> 
        <tr>
          <td colspan="5" bgcolor="#FFFFFF"><b>Total de adolescentes e Jovens do sexo feminino: 4.106</b></td>
        </tr> 
		
        <tr>
          <td colspan="5" bgcolor="#FFFFFF"><b>Total de adolescentes e Jovens do sexo masculino: 70</b></td>
        </tr> 		
		
        <tr>
          <td colspan="5" bgcolor="#FFFFFF"><b>Total de Beneficiarias Activos: 2662</b></td>
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
          <td width="706" colspan="5" bgcolor="#CD5C5C"><b>Número de Beneficiários DREAMS que receberam TODO pacote primário de serviços E pelos um serviço adicional do pacote secundário </b> </td>
        </tr>
        <tr>
          <td width="174" bgcolor="#FFE4E1">Tempo de registo como beneficiário DREAMS </td>
          <td bgcolor="#FFE4E1">10--14</td>
          <td bgcolor="#FFE4E1">15-19</td>
          <td bgcolor="#FFE4E1">20-24</td>
          <td bgcolor="#FFE4E1">25-29</td>
        </tr>
        <tr>
          <td bgcolor="#CD9B9B">0-6 meses </td>
          <td bgcolor="#CD9B9B"> 
		  	<?php 
			echo "1"; 
			?>
		  </td>
          <td bgcolor="#CD9B9B">
		  	<?php 
			echo "52"; 
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
          <td bgcolor="#FFE4E1">7-12    meses </td>
          <td bgcolor="#FFE4E1">
		  	<?php 
			echo "28"; 
			?>
		  </td>
          <td bgcolor="#FFE4E1">
		  	<?php 
			echo "140"; 
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
          <td bgcolor="#CD9B9B">13-24    meses </td>
          <td bgcolor="#CD9B9B">
		  	<?php 
			echo "48"; 
			?>
		  </td>
          <td bgcolor="#CD9B9B">
		  	<?php 
			echo "1329"; 
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
</b> </td>
        </tr>
        <tr>
          <td width="174" bgcolor="#FAEBD7">Tempo de registo como beneficiário DREAMS </td>
          <td bgcolor="#FAEBD7">10--14</td>
          <td bgcolor="#FAEBD7">15-19</td>
          <td bgcolor="#FAEBD7">20-24</td>
          <td bgcolor="#FAEBD7">25-29</td>
        </tr>
        <tr>
          <td bgcolor="#FFDEAD">0-6 meses </td>
          <td bgcolor="#FFDEAD"> 
		  	<?php 
			echo "2"; 
			?>
		  </td>
          <td bgcolor="#FFDEAD">
		  	<?php 
			echo "3"; 
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
          <td bgcolor="#FAEBD7">7-12    meses </td>
          <td bgcolor="#FAEBD7">
		  	<?php 
			echo "153"; 
			?>
		  </td>
          <td bgcolor="#FAEBD7">
		  	<?php 
			echo "122"; 
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
          <td bgcolor="#FFDEAD">13-24    meses </td>
          <td bgcolor="#FFDEAD">
		  	<?php 
			echo "194"; 
			?>
		  </td>
          <td bgcolor="#FFDEAD">
		  	<?php 
			echo "68"; 
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
          <td colspan="5" bgcolor="#32CD32"><b>Número    de Beneficiários DREAMS que completaram pelo menos um serviço DREAMS mais não completaram o pacote primário de serviços </b></td>
        </tr>
        <tr>
          <td width="174" bgcolor="#F0FFF0">Tempo de registo como beneficiário DREAMS </td>
          <td bgcolor="#F0FFF0">10--14</td>
          <td bgcolor="#F0FFF0">15-19</td>
          <td bgcolor="#F0FFF0">20-24</td>
          <td bgcolor="#F0FFF0">25-29</td>
        </tr>
        <tr>
          <td bgcolor="#98FB98">0-6 meses </td>
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
          <td bgcolor="#F0FFF0">7-12    meses </td>
          <td bgcolor="#F0FFF0">
		  	<?php 
			echo "17"; 
			?>
		  </td>
          <td bgcolor="#F0FFF0">
		  	<?php 
			echo "12"; 
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
          <td bgcolor="#98FB98">13-24    meses </td>
          <td bgcolor="#98FB98">
		  	<?php 
			echo "15"; 
			?>
		  </td>
          <td bgcolor="#98FB98">
		  	<?php 
			echo "465"; 
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
          <td width="706" colspan="5" bgcolor="#1874CD"><b>Número de Beneficiários DREAMS que completaram pelo menos um serviço DREAMS</b> </td>
        </tr>
        <tr>
          <td width="174" bgcolor="#CAE1FF">Tempo de registo como beneficiário DREAMS </td>
          <td bgcolor="#CAE1FF">10--14</td>
          <td bgcolor="#CAE1FF">15-19</td>
          <td bgcolor="#CAE1FF">20-24</td>
          <td bgcolor="#CAE1FF">25-29</td>
        </tr>
        <tr>
          <td bgcolor="#6495ED">0-6 meses </td>
          <td bgcolor="#6495ED"> 
		  	<?php 
			echo "3"; 
			?>
		  </td>
          <td bgcolor="#6495ED">
		  	<?php 
			echo "58"; 
			?>
		  </td>
          <td bgcolor="#6495ED">
		  	<?php 
			echo "10"; 
			?>
		  </td>
          <td bgcolor="#6495ED">
		  	<?php 
			echo "0"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#CAE1FF">7-12    meses </td>
          <td bgcolor="#CAE1FF">
		  	<?php 
			echo "198"; 
			?>
		  </td>
          <td bgcolor="#CAE1FF">
		  	<?php 
			echo "274";  
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
          <td bgcolor="#6495ED">13-24    meses </td>
          <td bgcolor="#6495ED">
		  	<?php 
			echo "257"; 
			?>
		  </td>
          <td bgcolor="#6495ED">
		  	<?php 
			echo "1862"; 
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
          <td colspan="5" bgcolor="#FFFFFF"><b>Chokwe</b></td>
        </tr>  		
        <tr>
		
        <tr>
          <td colspan="5" bgcolor="#FFFFFF"><b>RESUMO Distrital</b></td>
        </tr>
        <tr>
			
          <td colspan="5" bgcolor="#FFFFFF"><b>Total de Adolescentes Jovens Activos: 6.392</b></td>
        </tr> 
        <tr>
          <td colspan="5" bgcolor="#FFFFFF"><b>Total de adolescentes e Jovens do sexo feminino: 6.317</b></td>
        </tr> 
		
        <tr>
          <td colspan="5" bgcolor="#FFFFFF"><b>Total de adolescentes e Jovens do sexo masculino: 75</b></td>
        </tr> 		
		
        <tr>
          <td colspan="5" bgcolor="#FFFFFF"><b>Total de Beneficiarias Activos: 4.447</b></td>
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
          <td width="706" colspan="5" bgcolor="#CD5C5C"><b>Número de Beneficiários DREAMS que receberam TODO pacote primário de serviços E pelos um serviço adicional do pacote secundário </b> </td>
        </tr>
        <tr>
          <td width="174" bgcolor="#FFE4E1">Tempo de registo como beneficiário DREAMS </td>
          <td bgcolor="#FFE4E1">10--14</td>
          <td bgcolor="#FFE4E1">15-19</td>
          <td bgcolor="#FFE4E1">20-24</td>
          <td bgcolor="#FFE4E1">25-29</td>
        </tr>
        <tr>
          <td bgcolor="#CD9B9B">0-6 meses </td>
          <td bgcolor="#CD9B9B"> 
		  	<?php 
			echo "26"; 
			?>
		  </td>
          <td bgcolor="#CD9B9B">
		  	<?php 
			echo "135"; 
			?>
		  </td>
          <td bgcolor="#CD9B9B">
		  	<?php 
			echo "37"; 
			?>
		  </td>
          <td bgcolor="#CD9B9B">
		  	<?php 
			echo "0"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#FFE4E1">7-12    meses </td>
          <td bgcolor="#FFE4E1">
		  	<?php 
			echo "68"; 
			?>
		  </td>
          <td bgcolor="#FFE4E1">
		  	<?php 
			echo "189"; 
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
          <td bgcolor="#CD9B9B">13-24    meses </td>
          <td bgcolor="#CD9B9B">
		  	<?php 
			echo "231"; 
			?>
		  </td>
          <td bgcolor="#CD9B9B">
		  	<?php 
			echo "1610"; 
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
</b> </td>
        </tr>
        <tr>
          <td width="174" bgcolor="#FAEBD7">Tempo de registo como beneficiário DREAMS </td>
          <td bgcolor="#FAEBD7">10--14</td>
          <td bgcolor="#FAEBD7">15-19</td>
          <td bgcolor="#FAEBD7">20-24</td>
          <td bgcolor="#FAEBD7">25-29</td>
        </tr>
        <tr>
          <td bgcolor="#FFDEAD">0-6 meses </td>
          <td bgcolor="#FFDEAD"> 
		  	<?php 
			echo "123"; 
			?>
		  </td>
          <td bgcolor="#FFDEAD">
		  	<?php 
			echo "123"; 
			?>
		  </td>
          <td bgcolor="#FFDEAD">
		  	<?php 
			echo "13"; 
			?>
		  </td>
          <td bgcolor="#FFDEAD">
		  	<?php 
			echo "0"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#FAEBD7">7-12    meses </td>
          <td bgcolor="#FAEBD7">
		  	<?php 
			echo "91"; 
			?>
		  </td>
          <td bgcolor="#FAEBD7">
		  	<?php 
			echo "204"; 
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
          <td bgcolor="#FFDEAD">13-24    meses </td>
          <td bgcolor="#FFDEAD">
		  	<?php 
			echo "170"; 
			?>
		  </td>
          <td bgcolor="#FFDEAD">
		  	<?php 
			echo "576"; 
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
          <td colspan="5" bgcolor="#32CD32"><b>Número    de Beneficiários DREAMS que completaram pelo menos um serviço DREAMS mais não completaram o pacote primário de serviços </b></td>
        </tr>
        <tr>
          <td width="174" bgcolor="#F0FFF0">Tempo de registo como beneficiário DREAMS </td>
          <td bgcolor="#F0FFF0">10--14</td>
          <td bgcolor="#F0FFF0">15-19</td>
          <td bgcolor="#F0FFF0">20-24</td>
          <td bgcolor="#F0FFF0">25-29</td>
        </tr>
        <tr>
          <td bgcolor="#98FB98">0-6 meses </td>
          <td bgcolor="#98FB98">
		  	<?php 
			echo "30"; 
			?>
		  </td>
          <td bgcolor="#98FB98">
		  	<?php 
			echo "18"; 
			?>
		  </td>
          <td bgcolor="#98FB98">
		  	<?php 
			echo "34"; 
			?>
		  </td>
          <td bgcolor="#98FB98">
		  	<?php 
			echo "0"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#F0FFF0">7-12    meses </td>
          <td bgcolor="#F0FFF0">
		  	<?php 
			echo "186"; 
			?>
		  </td>
          <td bgcolor="#F0FFF0">
		  	<?php 
			echo "84"; 
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
          <td bgcolor="#98FB98">13-24    meses </td>
          <td bgcolor="#98FB98">
		  	<?php 
			echo "85"; 
			?>
		  </td>
          <td bgcolor="#98FB98">
		  	<?php 
			echo "414"; 
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
          <td width="706" colspan="5" bgcolor="#1874CD"><b>Número de Beneficiários DREAMS que completaram pelo menos um serviço DREAMS</b> </td>
        </tr>
        <tr>
          <td width="174" bgcolor="#CAE1FF">Tempo de registo como beneficiário DREAMS </td>
          <td bgcolor="#CAE1FF">10--14</td>
          <td bgcolor="#CAE1FF">15-19</td>
          <td bgcolor="#CAE1FF">20-24</td>
          <td bgcolor="#CAE1FF">25-29</td>
        </tr>
        <tr>
          <td bgcolor="#6495ED">0-6 meses </td>
          <td bgcolor="#6495ED"> 
		  	<?php 
			echo "179"; 
			?>
		  </td>
          <td bgcolor="#6495ED">
		  	<?php 
			echo "276"; 
			?>
		  </td>
          <td bgcolor="#6495ED">
		  	<?php 
			echo "84"; 
			?>
		  </td>
          <td bgcolor="#6495ED">
		  	<?php 
			echo "0"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#CAE1FF">7-12    meses </td>
          <td bgcolor="#CAE1FF">
		  	<?php 
			echo "345"; 
			?>
		  </td>
          <td bgcolor="#CAE1FF">
		  	<?php 
			echo "477";  
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
          <td bgcolor="#6495ED">13-24    meses </td>
          <td bgcolor="#6495ED">
		  	<?php 
			echo "486"; 
			?>
		  </td>
          <td bgcolor="#6495ED">
		  	<?php 
			echo "2600"; 
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
			
          <td colspan="5" bgcolor="#FFFFFF"><b>Total de Adolescentes Jovens Activos: 19.366</b></td>
        </tr> 
        <tr>
          <td colspan="5" bgcolor="#FFFFFF"><b>Total de adolescentes e Jovens do sexo feminino: 15.725</b></td>
        </tr> 
		
        <tr>
          <td colspan="5" bgcolor="#FFFFFF"><b>Total de adolescentes e Jovens do sexo masculino: 3.641</b></td>
        </tr> 		
		
        <tr>
          <td colspan="5" bgcolor="#FFFFFF"><b>Total de Beneficiarias Activos: 10.862</b></td>
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
          <td width="706" colspan="5" bgcolor="#CD5C5C"><b>Número de Beneficiários DREAMS que receberam TODO pacote primário de serviços E pelos um serviço adicional do pacote secundário </b> </td>
        </tr>
        <tr>
          <td width="174" bgcolor="#FFE4E1">Tempo de registo como beneficiário DREAMS </td>
          <td bgcolor="#FFE4E1">10--14</td>
          <td bgcolor="#FFE4E1">15-19</td>
          <td bgcolor="#FFE4E1">20-24</td>
          <td bgcolor="#FFE4E1">25-29</td>
        </tr>
        <tr>
          <td bgcolor="#CD9B9B">0-6 meses </td>
          <td bgcolor="#CD9B9B"> 
		  	<?php 
			echo "116"; 
			?>
		  </td>
          <td bgcolor="#CD9B9B">
		  	<?php 
			echo "1211"; 
			?>
		  </td>
          <td bgcolor="#CD9B9B">
		  	<?php 
			echo "30"; 
			?>
		  </td>
          <td bgcolor="#CD9B9B">
		  	<?php 
			echo "0"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#FFE4E1">7-12    meses </td>
          <td bgcolor="#FFE4E1">
		  	<?php 
			echo "51"; 
			?>
		  </td>
          <td bgcolor="#FFE4E1">
		  	<?php 
			echo "764"; 
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
          <td bgcolor="#CD9B9B">13-24    meses </td>
          <td bgcolor="#CD9B9B">
		  	<?php 
			echo "261"; 
			?>
		  </td>
          <td bgcolor="#CD9B9B">
		  	<?php 
			echo "1399"; 
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
			echo "25"; 
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
</b> </td>
        </tr>
        <tr>
          <td width="174" bgcolor="#FAEBD7">Tempo de registo como beneficiário DREAMS </td>
          <td bgcolor="#FAEBD7">10--14</td>
          <td bgcolor="#FAEBD7">15-19</td>
          <td bgcolor="#FAEBD7">20-24</td>
          <td bgcolor="#FAEBD7">25-29</td>
        </tr>
        <tr>
          <td bgcolor="#FFDEAD">0-6 meses </td>
          <td bgcolor="#FFDEAD"> 
		  	<?php 
			echo "280"; 
			?>
		  </td>
          <td bgcolor="#FFDEAD">
		  	<?php 
			echo "42"; 
			?>
		  </td>
          <td bgcolor="#FFDEAD">
		  	<?php 
			echo "8"; 
			?>
		  </td>
          <td bgcolor="#FFDEAD">
		  	<?php 
			echo "0"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#FAEBD7">7-12    meses </td>
          <td bgcolor="#FAEBD7">
		  	<?php 
			echo "199"; 
			?>
		  </td>
          <td bgcolor="#FAEBD7">
		  	<?php 
			echo "214"; 
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
          <td bgcolor="#FFDEAD">13-24    meses </td>
          <td bgcolor="#FFDEAD">
		  	<?php 
			echo "1528"; 
			?>
		  </td>
          <td bgcolor="#FFDEAD">
		  	<?php 
			echo "1006"; 
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
			echo "71"; 
			?>
		  </td>
          <td bgcolor="#FAEBD7">
		  	<?php 
			echo "125"; 
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
          <td width="174" bgcolor="#F0FFF0">Tempo de registo como beneficiário DREAMS </td>
          <td  bgcolor="#F0FFF0">10--14</td>
          <td  bgcolor="#F0FFF0">15-19</td>
          <td  bgcolor="#F0FFF0">20-24</td>
          <td  bgcolor="#F0FFF0">25-29</td>
        </tr>
        <tr>
          <td bgcolor="#98FB98">0-6 meses </td>
          <td bgcolor="#98FB98">
		  	<?php 
			echo "30"; 
			?>
		  </td>
          <td bgcolor="#98FB98">
		  	<?php 
			echo "71"; 
			?>
		  </td>
          <td bgcolor="#98FB98">
		  	<?php 
			echo "14"; 
			?>
		  </td>
          <td bgcolor="#98FB98">
		  	<?php 
			echo "0"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#F0FFF0">7-12    meses </td>
          <td bgcolor="#F0FFF0">
		  	<?php 
			echo "78"; 
			?>
		  </td>
          <td bgcolor="#F0FFF0">
		  	<?php 
			echo "71"; 
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
          <td bgcolor="#98FB98">13-24    meses </td>
          <td bgcolor="#98FB98">
		  	<?php 
			echo "379"; 
			?>
		  </td>
          <td bgcolor="#98FB98">
		  	<?php 
			echo "2481"; 
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
			echo "74"; 
			?>
		  </td>
          <td bgcolor="#F0FFF0">
		  	<?php 
			echo "334"; 
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
          <td width="706" colspan="5" bgcolor="#1874CD"><b>Número de Beneficiários DREAMS que completaram pelo menos um serviço DREAMS</b> </td>
        </tr>
        <tr>
          <td width="174" bgcolor="#CAE1FF">Tempo de registo como beneficiário DREAMS </td>
          <td bgcolor="#CAE1FF">10--14</td>
          <td bgcolor="#CAE1FF">15-19</td>
          <td bgcolor="#CAE1FF">20-24</td>
          <td bgcolor="#CAE1FF">25-29</td>
        </tr>
        <tr>
          <td bgcolor="#6495ED">0-6 meses </td>
          <td bgcolor="#6495ED"> 
		  	<?php 
			echo "426"; 
			?>
		  </td>
          <td bgcolor="#6495ED">
		  	<?php 
			echo "1324"; 
			?>
		  </td>
          <td bgcolor="#6495ED">
		  	<?php 
			echo "52"; 
			?>
		  </td>
          <td bgcolor="#6495ED">
		  	<?php 
			echo "0"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#CAE1FF">7-12    meses </td>
          <td bgcolor="#CAE1FF">
		  	<?php 
			echo "328"; 
			?>
		  </td>
          <td bgcolor="#CAE1FF">
		  	<?php 
			echo "1049";  
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
          <td bgcolor="#6495ED">13-24    meses </td>
          <td bgcolor="#6495ED">
		  	<?php 
			echo "2168"; 
			?>
		  </td>
          <td bgcolor="#6495ED">
		  	<?php 
			echo "4886"; 
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
			echo "170"; 
			?>
		  </td>
          <td bgcolor="#CAE1FF">
		  	<?php 
			echo "459"; 
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
          <td width="706" colspan="5" bgcolor="#CD5C5C"><b>Número de Beneficiários DREAMS que receberam TODO pacote primário de serviços E pelos um serviço adicional do pacote secundário </b> </td>
        </tr>
        <tr>
          <td width="174" bgcolor="#FFE4E1">Tempo de registo como beneficiário DREAMS </td>
          <td bgcolor="#FFE4E1">10-14</td>
          <td bgcolor="#FFE4E1">15-19</td>
          <td bgcolor="#FFE4E1">20-24</td>
          <td bgcolor="#FFE4E1">25-29</td>
        </tr>
        <tr>
          <td bgcolor="#CD9B9B">0-6 meses </td>
          <td bgcolor="#CD9B9B"> 
		  	<?php 
			echo "134"; 
			?>
		  </td>
          <td bgcolor="#CD9B9B">
		  	<?php 
			echo "1680"; 
			?>
		  </td>
          <td bgcolor="#CD9B9B">
		  	<?php 
			echo "205"; 
			?>
		  </td>
          <td bgcolor="#CD9B9B">
		  	<?php 
			echo "0"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#FFE4E1">7-12    meses </td>
          <td bgcolor="#FFE4E1">
		  	<?php 
			echo "152"; 
			?>
		  </td>
          <td bgcolor="#FFE4E1">
		  	<?php 
			echo "829"; 
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
          <td bgcolor="#CD9B9B">13-24    meses </td>
          <td bgcolor="#CD9B9B">
		  	<?php 
			echo "362"; 
			?>
		  </td>
          <td bgcolor="#CD9B9B">
		  	<?php 
			echo "1393"; 
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
</b> </td>
        </tr>
        <tr>
          <td width="174" bgcolor="#FAEBD7">Tempo de registo como beneficiário DREAMS </td>
          <td bgcolor="#FAEBD7">10--14</td>
          <td bgcolor="#FAEBD7">15-19</td>
          <td bgcolor="#FAEBD7">20-24</td>
          <td bgcolor="#FAEBD7">25-29</td>
        </tr>
        <tr>
          <td bgcolor="#FFDEAD">0-6 meses </td>
          <td bgcolor="#FFDEAD"> 
		  	<?php 
			echo "1202"; 
			?>
		  </td>
          <td bgcolor="#FFDEAD">
		  	<?php 
			echo "447"; 
			?>
		  </td>
          <td bgcolor="#FFDEAD">
		  	<?php 
			echo "259"; 
			?>
		  </td>
          <td bgcolor="#FFDEAD">
		  	<?php 
			echo "0"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#FAEBD7">7-12    meses </td>
          <td bgcolor="#FAEBD7">
		  	<?php 
			echo "294"; 
			?>
		  </td>
          <td bgcolor="#FAEBD7">
		  	<?php 
			echo "108"; 
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
          <td bgcolor="#FFDEAD">13-24    meses </td>
          <td bgcolor="#FFDEAD">
		  	<?php 
			echo "255"; 
			?>
		  </td>
          <td bgcolor="#FFDEAD">
		  	<?php 
			echo "676"; 
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
          <td colspan="5" bgcolor="#32CD32"><b>Número    de Beneficiários DREAMS que completaram pelo menos um serviço DREAMS mais não completaram o pacote primário de serviços</b></td>
        </tr>
        <tr>
          <td width="174" bgcolor="#F0FFF0">Tempo de registo como beneficiário DREAMS </td>
          <td bgcolor="#F0FFF0">10--14</td>
          <td bgcolor="#F0FFF0">15-19</td>
          <td bgcolor="#F0FFF0">20-24</td>
          <td bgcolor="#F0FFF0">25-29</td>
        </tr>
        <tr>
          <td bgcolor="#98FB98">0-6 meses </td>
          <td bgcolor="#98FB98">
		  	<?php 
			echo "198"; 
			?>
		  </td>
          <td bgcolor="#98FB98">
		  	<?php 
			echo "32"; 
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
          <td bgcolor="#F0FFF0">7-12    meses </td>
          <td bgcolor="#F0FFF0">
		  	<?php 
			echo "33"; 
			?>
		  </td>
          <td bgcolor="#F0FFF0">
		  	<?php 
			echo "18"; 
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
          <td bgcolor="#98FB98">13-24    meses </td>
          <td bgcolor="#98FB98">
		  	<?php 
			echo "551"; 
			?>
		  </td>
          <td bgcolor="#98FB98">
		  	<?php 
			echo "419"; 
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
          <td width="706" colspan="5" bgcolor="#1874CD"><b>Número de Beneficiários DREAMS que completaram pelo menos um serviço DREAMS</b> </td>
        </tr>
        <tr>
          <td width="174" bgcolor="#CAE1FF">Tempo de registo como beneficiário DREAMS </td>
          <td bgcolor="#CAE1FF">10--14</td>
          <td bgcolor="#CAE1FF">15-19</td>
          <td bgcolor="#CAE1FF">20-24</td>
          <td bgcolor="#CAE1FF">25-29</td>
        </tr>
        <tr>
          <td bgcolor="#6495ED">0-6 meses </td>
          <td bgcolor="#6495ED"> 
		  	<?php 
			echo "1534"; 
			?>
		  </td>
          <td bgcolor="#6495ED">
		  	<?php 
			echo "2159"; 
			?>
		  </td>
          <td bgcolor="#6495ED">
		  	<?php 
			echo "467"; 
			?>
		  </td>
          <td bgcolor="#6495ED">
		  	<?php 
			echo "0"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#CAE1FF">7-12    meses </td>
          <td bgcolor="#CAE1FF">
		  	<?php 
			echo "479"; 
			?>
		  </td>
          <td bgcolor="#CAE1FF">
		  	<?php 
			echo "955";  
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
          <td bgcolor="#6495ED">13-24    meses </td>
          <td bgcolor="#6495ED">
		  	<?php 
			echo "1168"; 
			?>
		  </td>
          <td bgcolor="#6495ED">
		  	<?php 
			echo "2488"; 
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
          <td width="706" colspan="5" bgcolor="#CD5C5C"><b>Número de Beneficiários DREAMS que receberam TODO pacote primário de serviços E pelos um serviço adicional do pacote secundário </b> </td>
        </tr>
        <tr>
          <td width="174" bgcolor="#FFE4E1">Tempo de registo como beneficiário DREAMS </td>
          <td bgcolor="#FFE4E1">10--14</td>
          <td bgcolor="#FFE4E1">15-19</td>
          <td bgcolor="#FFE4E1">20-24</td>
          <td bgcolor="#FFE4E1">25-29</td>
        </tr>
        <tr>
          <td bgcolor="#CD9B9B">0-6 meses </td>
          <td bgcolor="#CD9B9B"> 
		  	<?php 
			echo "198"; 
			?>
		  </td>
          <td bgcolor="#CD9B9B">
		  	<?php 
			echo "1597"; 
			?>
		  </td>
          <td bgcolor="#CD9B9B">
		  	<?php 
			echo "236"; 
			?>
		  </td>
          <td bgcolor="#CD9B9B">
		  	<?php 
			echo "0"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#FFE4E1">7-12    meses </td>
          <td bgcolor="#FFE4E1">
		  	<?php 
			echo "272"; 
			?>
		  </td>
          <td bgcolor="#FFE4E1">
		  	<?php 
			echo "1642"; 
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
          <td bgcolor="#CD9B9B">13-24    meses </td>
          <td bgcolor="#CD9B9B">
		  	<?php 
			echo "1048"; 
			?>
		  </td>
          <td bgcolor="#CD9B9B">
		  	<?php 
			echo "2241"; 
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
</b> </td>
        </tr>
        <tr>
          <td width="174" bgcolor="#FAEBD7">Tempo de registo como beneficiário DREAMS </td>
          <td bgcolor="#FAEBD7">10--14</td>
          <td bgcolor="#FAEBD7">15-19</td>
          <td bgcolor="#FAEBD7">20-24</td>
          <td bgcolor="#FAEBD7">25-29</td>
        </tr>
        <tr>
          <td bgcolor="#FFDEAD">0-6 meses </td>
          <td bgcolor="#FFDEAD"> 
		  	<?php 
			echo "702"; 
			?>
		  </td>
          <td bgcolor="#FFDEAD">
		  	<?php 
			echo "386"; 
			?>
		  </td>
          <td bgcolor="#FFDEAD">
		  	<?php 
			echo "401"; 
			?>
		  </td>
          <td bgcolor="#FFDEAD">
		  	<?php 
			echo "0"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#FAEBD7">7-12    meses </td>
          <td bgcolor="#FAEBD7">
		  	<?php 
			echo "274"; 
			?>
		  </td>
          <td bgcolor="#FAEBD7">
		  	<?php 
			echo "248"; 
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
          <td bgcolor="#FFDEAD">13-24    meses </td>
          <td bgcolor="#FFDEAD">
		  	<?php 
			echo "620"; 
			?>
		  </td>
          <td bgcolor="#FFDEAD">
		  	<?php 
			echo "1321"; 
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
          <td width="706" colspan="5" bgcolor="#32CD32"> <b>Número    de Beneficiários DREAMS que completaram pelo menos um serviço DREAMS mais não completaram o pacote primário de serviços </b> </td>
        </tr>
        <tr>
          <td width="174" bgcolor="#F0FFF0">Tempo de registo como beneficiário DREAMS </td>
          <td bgcolor="#F0FFF0">10--14</td>
          <td bgcolor="#F0FFF0">15-19</td>
          <td bgcolor="#F0FFF0">20-24</td>
          <td bgcolor="#F0FFF0">25-29</td>
        </tr>
        <tr>
          <td bgcolor="#98FB98">0-6 meses </td>
          <td bgcolor="#98FB98">
		  	<?php 
			echo "341"; 
			?>
		  </td>
          <td bgcolor="#98FB98">
		  	<?php 
			echo "230"; 
			?>
		  </td>
          <td bgcolor="#98FB98">
		  	<?php 
			echo "10"; 
			?>
		  </td>
          <td bgcolor="#98FB98">
		  	<?php 
			echo "0"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#F0FFF0">7-12    meses </td>
          <td bgcolor="#F0FFF0">
		  	<?php 
			echo "573"; 
			?>
		  </td>
          <td bgcolor="#F0FFF0">
		  	<?php 
			echo "612"; 
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
          <td bgcolor="#98FB98">13-24    meses </td>
          <td bgcolor="#98FB98">
		  	<?php 
			echo "1565"; 
			?>
		  </td>
          <td bgcolor="#98FB98">
		  	<?php 
			echo "2131"; 
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
			echo "1"; 
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
          <td width="706" colspan="5" bgcolor="#1874CD"><b>Número de Beneficiários DREAMS que completaram pelo menos um serviço DREAMS</b> </td>
        </tr>
        <tr>
          <td width="174" bgcolor="#CAE1FF">Tempo de registo como beneficiário DREAMS </td>
          <td bgcolor="#CAE1FF">10--14</td>
          <td bgcolor="#CAE1FF">15-19</td>
          <td bgcolor="#CAE1FF">20-24</td>
          <td bgcolor="#CAE1FF">25-29</td>
        </tr>
        <tr>
          <td bgcolor="#6495ED">0-6 meses </td>
          <td bgcolor="#6495ED"> 
		  	<?php 
			echo "1241"; 
			?>
		  </td>
          <td bgcolor="#6495ED">
		  	<?php 
			echo "2213"; 
			?>
		  </td>
          <td bgcolor="#6495ED">
		  	<?php 
			echo "647"; 
			?>
		  </td>
          <td bgcolor="#6495ED">
		  	<?php 
			echo "0"; 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#CAE1FF">7-12    meses </td>
          <td bgcolor="#CAE1FF">
		  	<?php 
			echo "1119"; 
			?>
		  </td>
          <td bgcolor="#CAE1FF">
		  	<?php 
			echo "2502";  
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
          <td bgcolor="#6495ED">13-24    meses </td>
          <td bgcolor="#6495ED">
		  	<?php 
			echo "3233"; 
			?>
		  </td>
          <td bgcolor="#6495ED">
		  	<?php 
			echo "5693"; 
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
			echo "1"; 
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
<!--
<button class="btn btn-primary btn-block mb1 bg-navy" data-toggle="collapse" data-target="#subsidio"><b>SUBS&Iacute;DIO ESCOLAR E SESS&Otilde;ES SOBRE PREVEN&Ccedil;&Atilde;O DE HIV E VIOL&Ecirc;CIA POR DISTRITO</b></button>

<div id="subsidio" class="collapse">		
	<table width="100%" class="table table-dashed">
	

        <tr>
          <td width="174" bgcolor="#CD5C5C">Distrito </td>
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
          <td bgcolor="#FFE4E1">Chonguene </td>
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
          <td bgcolor="#CD9B9B">Beira </td>
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
          <td bgcolor="#CD9B9B">Limpopo </td>
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
-->

    </div>

  </div>
</div>

</div>
