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
      <div class="panel-heading"><i class="fa fa-dashboard  text-primary"></i> <strong> Indicador AGYW_Prev Desagregado por Tempo de Registo e Idade (MER 2.4) </strong></div>
      <div class="panel-body">


        <div class="row"> </div>
        <table width="100%" class="table table-dashed">
          <col width="174">
          <col width="117">
          <col width="119">
          <col width="154">
          <col width="142">

          <tr>
            <td colspan="5" bgcolor="#FFFFFF"><b>RESUMO NACIONAL Actualizado no dia 27 de Maio de 2020</b></td>
          </tr>
          <tr>
            <td colspan="5" bgcolor="FFFFFF"><b>Dados de 01 de Outubro de 2019 a 31 de Marco de 2020</b></td>
         </tr>
          <tr>

            <td colspan="5" bgcolor="#FFFFFF"><b>Total de Adolescentes e Jovens Registados: 152.209</b></td>
          </tr>
          <tr>
            <td colspan="5" bgcolor="#FFFFFF"><b>Total de adolescentes e Jovens do sexo feminino: 127.616</b></td>
          </tr>
          <tr>
            <td colspan="5" bgcolor="#FFFFFF"><b>Total de Beneficiarias: 87.428</b></td>
          </tr>
          <tr>
            <td colspan="5" bgcolor="#FFFFFF"><b>Total de Beneficiarias Activas: 35.547</b></td>
          </tr>

        </table>


        <button class="btn btn-primary btn-block  mb1 black bg-darken-1" data-toggle="collapse" data-target="#maputo"><b>PROVINCIA DE MAPUTO</b></button>

        <div id="maputo" class="collapse">
          <table width="100%" class="table table-dashed">
            <!-- MAPUTO !-->
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

              <td colspan="5" bgcolor="#FFFFFF"><b>Total de Adolescentes Jovens Registados: 6.655</b></td>
            </tr>
            <tr>
              <td colspan="5" bgcolor="#FFFFFF"><b>Total de adolescentes e Jovens do sexo feminino: 6.647</b></td>
            </tr>

            <tr>
              <td colspan="5" bgcolor="#FFFFFF"><b>Total de adolescentes e Jovens do sexo masculino: 8</b></td>
            </tr>

            <tr>
              <td colspan="5" bgcolor="#FFFFFF"><b>Total de Beneficiarias: 6.102</b></td>
            </tr>
          <tr>
            <td colspan="5" bgcolor="#FFFFFF"><b>Total de Beneficiarias Activas: 3.741</b></td>
          </tr>



            <tr>
              <td colspan="5" height="40" bgcolor="#FFFFFF"><b> </b></td>
            </tr>

            <tr>
              <td colspan="5" bgcolor="#FFFFFF"><b>Numerador</b></td>
            </tr>

            <tr>
              <td colspan="6" height="40" bgcolor="#FFFFFF"><b> </b></td>
            </tr>

            <tr>
              <td width="706" colspan="6" bgcolor="#66A5F4"><b>Número de Beneficiários DREAMS que completaram o pacote primario de serviços DREAMS, mas que não receberam nenhum outro serviço além do pacote primário
                </b> </td>
            </tr>
            <tr>
              <td width="174" bgcolor="#ffffff">Tempo de registo como beneficiário DREAMS</td>
              <td bgcolor="#ffffff">10-14</td>
              <td bgcolor="#ffffff">15-19</td>
              <td bgcolor="#ffffff">20-24</td>
              <td bgcolor="#ffffff">25-29</td>
              <td bgcolor="#ffffff">Sub-total</td>

            </tr>
            <tr>
              <td bgcolor="#CD9B9B">0-6 meses</td>
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
              <td bgcolor="#CD9B9B">
                <?php
                echo "0";
                ?>
              </td>
            </tr>
            <tr>
              <td bgcolor="#FFE4E1">7-12 meses </td>
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
              <td bgcolor="#FFE4E1">
                <?php
                echo "0";
                ?>
              </td>
            </tr>
            <tr>
              <td bgcolor="#CD9B9B">13-24 meses </td>
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
              <td width="706" colspan="6" bgcolor="#F4A460"><b>Número de Beneficiários DREAMS que completaram o pacote primario de serviços DREAMS e que receberam pelo menos um serviço do pacote secundário</b> </td>
            </tr>
            <tr>
              <td width="174" bgcolor="#FAEBD7">Tempo de registo como beneficiário DREAMS</td>
              <td bgcolor="#FAEBD7">10-14</td>
              <td bgcolor="#FAEBD7">15-19</td>
              <td bgcolor="#FAEBD7">20-24</td>
              <td bgcolor="#FAEBD7">25-29</td>
              <td bgcolor="#FAEBD7">Sub-total</td>
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
              <td bgcolor="#FFDEAD">
                <?php
                echo "2";
                ?>
              </td>
            </tr>
            <tr>
              <td bgcolor="#FAEBD7">7-12 meses </td>
              <td bgcolor="#FAEBD7">
                <?php
                echo "15";
                ?>
              </td>
              <td bgcolor="#FAEBD7">
                <?php
                echo "17";
                ?>
              </td>
              <td bgcolor="#FAEBD7">
                <?php
                echo "7";
                ?>
              </td>
              <td bgcolor="#FAEBD7">
                <?php
                echo "0";
                ?>
              </td>
              <td bgcolor="#FAEBD7">
                <?php
                echo "39";
                ?>
              </td>
            </tr>
            <tr>
              <td bgcolor="#FFDEAD">13-24 meses </td>
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
              <td bgcolor="#FAEBD7">
                <?php
                echo "0";
                ?>
              </td>
            </tr>

            <tr>
              <td colspan="6" height="40" bgcolor="#FFFFFF"><b> </b></td>
            </tr>


            <tr>
              <td colspan="5" bgcolor="#FFFFFF"><b>Denominador</b></td>
            </tr>

            <tr>
              <td colspan="5" height="40" bgcolor="#FFFFFF"><b> </b></td>
            </tr>


            <tr>
              <td colspan="6" bgcolor="#32CD32"><b>Número de Beneficiários DREAMS que completaram pelo menos um serviço DREAMS mais não completaram o pacote primário de serviços </b></td>
            </tr>
            <tr>
              <td width="174" bgcolor="#F0FFF0">Tempo de registo como beneficiário DREAMS </td>
              <td bgcolor="#F0FFF0">10-14</td>
              <td bgcolor="#F0FFF0">15-19</td>
              <td bgcolor="#F0FFF0">20-24</td>
              <td bgcolor="#F0FFF0">25-29</td>
              <td bgcolor="#F0FFF0">Sub Total</td>
            </tr>
            <tr>
              <td bgcolor="#98FB98">0-6 meses </td>
              <td bgcolor="#98FB98">
                <?php
                echo "75";
                ?>
              </td>
              <td bgcolor="#98FB98">
                <?php
                echo "71";
                ?>
              </td>
              <td bgcolor="#98FB98">
                <?php
                echo "360";
                ?>
              </td>
              <td bgcolor="#98FB98">
                <?php
                echo "0";
                ?>
              </td>
              <td bgcolor="#98FB98">
                <?php
                echo "506";
                ?>
              </td>
            </tr>
            <tr>
              <td bgcolor="#F0FFF0">7-12 meses </td>
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
                echo "1";
                ?>
              </td>
            </tr>
            <tr>
              <td bgcolor="#98FB98">13-24 meses </td>
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
              <td bgcolor="#F0FFF0">
                <?php
                echo "0";
                ?>
              </td>
            </tr>


            <tr>
              <td colspan="6" height="40" bgcolor="#FFFFFF"><b> </b></td>
            </tr>

            <tr>
              <td width="706" colspan="6" bgcolor="#1874CD"><b>Número de Beneficiários DREAMS que começaram um serviço DREAMS mas não completaram</b> </td>
            </tr>
            <tr>
              <td width="174" bgcolor="#CAE1FF">Tempo de registo como beneficiário DREAMS </td>
              <td bgcolor="#CAE1FF">10-14</td>
              <td bgcolor="#CAE1FF">15-19</td>
              <td bgcolor="#CAE1FF">20-24</td>
              <td bgcolor="#CAE1FF">25-29</td>
              <td bgcolor="#CAE1FF">Sub total</td>
            </tr>
            <tr>
              <td bgcolor="#6495ED">0-6 meses </td>
              <td bgcolor="#6495ED">
                <?php
                echo "1851";
                ?>
              </td>
              <td bgcolor="#6495ED">
                <?php
                echo "1137";
                ?>
              </td>
              <td bgcolor="#6495ED">
                <?php
                echo "145";
                ?>
              </td>
              <td bgcolor="#6495ED">
                <?php
                echo "0";
                ?>
              </td>
              <td bgcolor="#6495ED">
                <?php
                echo "3133";
                ?>
              </td>
            </tr>
            <tr>
              <td bgcolor="#CAE1FF">7-12 meses </td>
              <td bgcolor="#CAE1FF">
                <?php
                echo "16";
                ?>
              </td>
              <td bgcolor="#CAE1FF">
                <?php
                echo "34";
                ?>
              </td>
              <td bgcolor="#CAE1FF">
                <?php
                echo "9";
                ?>
              </td>
              <td bgcolor="#CAE1FF">
                <?php
                echo "0";
                ?>
              </td>
              <td bgcolor="#CAE1FF">
                <?php
                echo "59";
                ?>
              </td>
            </tr>
            <tr>
              <td bgcolor="#6495ED">13-24 meses </td>
              <td bgcolor="#6495ED">
                <?php
                echo "0";
                ?>
              </td>
              <td bgcolor="#6495ED">
                <?php
                echo "1";
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
                echo "1";
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
              <td bgcolor="#CAE1FF">
                <?php
                echo "0";
                ?>
              </td>
            </tr>

            <tr>
              <td colspan="6" height="40" bgcolor="#FFFFFF"><b> </b></td>
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

              <td colspan="5" bgcolor="#FFFFFF"><b>Total de Adolescentes Jovens Registados: 6.344</b></td>
            </tr>
            <tr>
              <td colspan="5" bgcolor="#FFFFFF"><b>Total de adolescentes e Jovens do sexo feminino: 6.314</b></td>
            </tr>

            <tr>
              <td colspan="5" bgcolor="#FFFFFF"><b>Total de adolescentes e Jovens do sexo masculino: 30</b></td>
            </tr>

            <tr>
              <td colspan="5" bgcolor="#FFFFFF"><b>Total de Beneficiarias: 4.935</b></td>
            </tr>
          <tr>
            <td colspan="5" bgcolor="#FFFFFF"><b>Total de Beneficiarias Activas: 2.976</b></td>
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
            <td width="706" colspan="6" bgcolor="#66A5F4"><b>Número de Beneficiários DREAMS que completaram o pacote primario de serviços DREAMS, mas que não receberam nenhum outro serviço além do pacote primário
                </b> </td>
            </tr>
            <tr>
              <td width="174" bgcolor="#ffffff">Tempo de registo como beneficiário DREAMS</td>
              <td bgcolor="#ffffff">10-14</td>
              <td bgcolor="#ffffff">15-19</td>
              <td bgcolor="#ffffff">20-24</td>
              <td bgcolor="#ffffff">25-29</td>
              <td bgcolor="#ffffff">Sub-total</td>

            </tr>
            <tr>
              <td bgcolor="#CD9B9B">0-6 meses</td>
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
              <td bgcolor="#CD9B9B">
                <?php
                echo "0";
                ?>
              </td>
            </tr>
            <tr>
              <td bgcolor="#FFE4E1">7-12 meses </td>
              <td bgcolor="#FFE4E1">
                <?php
                echo "4";
                ?>
              </td>
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
                echo "5";
                ?>
              </td>
            </tr>
            <tr>
              <td bgcolor="#CD9B9B">13-24 meses </td>
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
              <td width="706" colspan="6" bgcolor="#F4A460"><b>Número de Beneficiários DREAMS que completaram o pacote primario de serviços DREAMS e que receberam pelo menos um serviço do pacote secundário</b> </td>
            </tr>
            <tr>
              <td width="174" bgcolor="#FAEBD7">Tempo de registo como beneficiário DREAMS</td>
              <td bgcolor="#FAEBD7">10-14</td>
              <td bgcolor="#FAEBD7">15-19</td>
              <td bgcolor="#FAEBD7">20-24</td>
              <td bgcolor="#FAEBD7">25-29</td>
              <td bgcolor="#FAEBD7">Sub-total</td>
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
              <td bgcolor="#FAEBD7">7-12 meses </td>
              <td bgcolor="#FAEBD7">
                <?php
                echo "23";
                ?>
              </td>
              <td bgcolor="#FAEBD7">
                <?php
                echo "10";
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
                echo "34";
                ?>
              </td>
            </tr>
            <tr>
              <td bgcolor="#FFDEAD">13-24 meses </td>
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
              <td colspan="5" bgcolor="#FFFFFF"><b>Denominador</b></td>
            </tr>

            <tr>
              <td colspan="6" height="40" bgcolor="#FFFFFF"><b> </b></td>
            </tr>

            
            <tr>
              <td colspan="6" bgcolor="#32CD32"><b>Número de Beneficiários DREAMS que completaram pelo menos um serviço DREAMS mais não completaram o pacote primário de serviços </b></td>
            </tr>
            <tr>
              <td width="174" bgcolor="#F0FFF0">Tempo de registo como beneficiário DREAMS </td>
              <td bgcolor="#F0FFF0">10-14</td>
              <td bgcolor="#F0FFF0">15-19</td>
              <td bgcolor="#F0FFF0">20-24</td>
              <td bgcolor="#F0FFF0">25-29</td>
              <td bgcolor="#F0FFF0">Sub Total</td>
            </tr>
            <tr>
              <td bgcolor="#98FB98">0-6 meses </td>
              <td bgcolor="#98FB98">
                <?php
                echo "70";
                ?>
              </td>
              <td bgcolor="#98FB98">
                <?php
                echo "72";
                ?>
              </td>
              <td bgcolor="#98FB98">
                <?php
                echo "243";
                ?>
              </td>
              <td bgcolor="#98FB98">
                <?php
                echo "0";
                ?>
              </td>
              <td bgcolor="#98FB98">
                <?php
                echo "385";
                ?>
              </td>
            </tr>
            <tr>
              <td bgcolor="#F0FFF0">7-12 meses </td>
              <td bgcolor="#F0FFF0">
                <?php
                echo "1";
                ?>
              </td>
              <td bgcolor="#F0FFF0">
                <?php
                echo "14";
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
                echo "18";
                ?>
              </td>
            </tr>
            <tr>
              <td bgcolor="#98FB98">13-24 meses </td>
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
              <td bgcolor="#F0FFF0">
                <?php
                echo "0";
                ?>
              </td>
            </tr>


            <tr>
              <td colspan="6" height="40" bgcolor="#FFFFFF"><b> </b></td>
            </tr>

            <tr>
              <td width="706" colspan="6" bgcolor="#1874CD"><b>Número de Beneficiários DREAMS que começaram um serviço DREAMS mas não completaram</b> </td>
            </tr>
            <tr>
              <td width="174" bgcolor="#CAE1FF">Tempo de registo como beneficiário DREAMS </td>
              <td bgcolor="#CAE1FF">10-14</td>
              <td bgcolor="#CAE1FF">15-19</td>
              <td bgcolor="#CAE1FF">20-24</td>
              <td bgcolor="#CAE1FF">25-29</td>
              <td bgcolor="#CAE1FF">Sub total</td>
            </tr>
            <tr>
              <td bgcolor="#6495ED">0-6 meses </td>
              <td bgcolor="#6495ED">
                <?php
                echo "1273";
                ?>
              </td>
              <td bgcolor="#6495ED">
                <?php
                echo "731";
                ?>
              </td>
              <td bgcolor="#6495ED">
                <?php
                echo "53";
                ?>
              </td>
              <td bgcolor="#6495ED">
                <?php
                echo "0";
                ?>
              </td>
              <td bgcolor="#6495ED">
                <?php
                echo "2057";
                ?>
              </td>
            </tr>
            <tr>
              <td bgcolor="#CAE1FF">7-12 meses </td>
              <td bgcolor="#CAE1FF">
                <?php
                echo "263";
                ?>
              </td>
              <td bgcolor="#CAE1FF">
                <?php
                echo "159";
                ?>
              </td>
              <td bgcolor="#CAE1FF">
                <?php
                echo "53";
                ?>
              </td>
              <td bgcolor="#CAE1FF">
                <?php
                echo "2";
                ?>
              </td>
              <td bgcolor="#CAE1FF">
                <?php
                echo "477";
                ?>
              </td>
            </tr>
            <tr>
              <td bgcolor="#6495ED">13-24 meses </td>
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
              <td bgcolor="#CAE1FF">
                <?php
                echo "0";
                ?>
              </td>
            </tr>

            <tr>
              <td colspan="6" height="40" bgcolor="#FFFFFF"><b> </b></td>
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

              <td colspan="5" bgcolor="#FFFFFF"><b>Total de Adolescentes Jovens Registados: 22.850</b></td>
            </tr>
            <tr>
              <td colspan="5" bgcolor="#FFFFFF"><b>Total de adolescentes e Jovens do sexo feminino: 22.214</b></td>
            </tr>

            <tr>
              <td colspan="5" bgcolor="#FFFFFF"><b>Total de adolescentes e Jovens do sexo masculino: 636</b></td>
            </tr>

            <tr>
              <td colspan="5" bgcolor="#FFFFFF"><b>Total de Beneficiarias: 17.080</b></td>
            </tr>
          <tr>
            <td colspan="5" bgcolor="#FFFFFF"><b>Total de Beneficiarias Activas: 7.143</b></td>
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
            <!-- Inicio da Tabela !-->
            <tr>
              <td width="706" colspan="6" bgcolor="#66A5F4"><b>Número de Beneficiários DREAMS que completaram o pacote primario de serviços DREAMS, mas que não receberam nenhum outro serviço além do pacote primário
                </b> </td>
            </tr>
            <tr>
              <td width="174" bgcolor="#ffffff">Tempo de registo como beneficiário DREAMS</td>
              <td bgcolor="#ffffff">10-14</td>
              <td bgcolor="#ffffff">15-19</td>
              <td bgcolor="#ffffff">20-24</td>
              <td bgcolor="#ffffff">25-29</td>
              <td bgcolor="#ffffff">Sub-total</td>

            </tr>
            <tr>
              <td bgcolor="#CD9B9B">0-6 meses</td>
              <td bgcolor="#CD9B9B">
                <?php
                echo "44";
                ?>
              </td>
              <td bgcolor="#CD9B9B">
                <?php
                echo "121";
                ?>
              </td>
              <td bgcolor="#CD9B9B">
                <?php
                echo "4";
                ?>
              </td>
              <td bgcolor="#CD9B9B">
                <?php
                echo "0";
                ?>
              </td>
              <td bgcolor="#CD9B9B">
                <?php
                echo "169";
                ?>
              </td>
            </tr>
            <tr>
              <td bgcolor="#FFE4E1">7-12 meses </td>
              <td bgcolor="#FFE4E1">
                <?php
                echo "39";
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
              <td bgcolor="#FFE4E1">
                <?php
                echo "39";
                ?>
              </td>
            </tr>
            <tr>
              <td bgcolor="#CD9B9B">13-24 meses </td>
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
              <td bgcolor="#FFE4E1">
                <?php
                echo "0";
                ?>
              </td>
            </tr>

            <tr>
              <td colspan="6" height="40" bgcolor="#FFFFFF"><b> </b></td>
            </tr>


            <!-- Inicio da Tabela !-->
            <tr>
              <td width="706" colspan="6" bgcolor="#F4A460"><b>Número de Beneficiários DREAMS que completaram o pacote primario de serviços DREAMS e que receberam pelo menos um serviço do pacote secundário</b> </td>
            </tr>
            <tr>
              <td width="174" bgcolor="#FAEBD7">Tempo de registo como beneficiário DREAMS</td>
              <td bgcolor="#FAEBD7">10-14</td>
              <td bgcolor="#FAEBD7">15-19</td>
              <td bgcolor="#FAEBD7">20-24</td>
              <td bgcolor="#FAEBD7">25-29</td>
              <td bgcolor="#FAEBD7">Sub-total</td>
            </tr>
            <tr>
              <td bgcolor="#FFDEAD">0-6 meses </td>
              <td bgcolor="#FFDEAD">
                <?php
                echo "7";
                ?>
              </td>
              <td bgcolor="#FFDEAD">
                <?php
                echo "650";
                ?>
              </td>
              <td bgcolor="#FFDEAD">
                <?php
                echo "132";
                ?>
              </td>
              <td bgcolor="#FFDEAD">
                <?php
                echo "0";
                ?>
              </td>
              <td bgcolor="#FFDEAD">
                <?php
                echo "789";
                ?>
              </td>
            </tr>
            <tr>
              <td bgcolor="#FAEBD7">7-12 meses </td>
              <td bgcolor="#FAEBD7">
                <?php
                echo "15";
                ?>
              </td>
              <td bgcolor="#FAEBD7">
                <?php
                echo "14";
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
              <td bgcolor="#FAEBD7">
                <?php
                echo "33";
                ?>
              </td>
            </tr>
            <tr>
              <td bgcolor="#FFDEAD">13-24 meses </td>
              <td bgcolor="#FFDEAD">
                <?php
                echo "3";
                ?>
              </td>
              <td bgcolor="#FFDEAD">
                <?php
                echo "8";
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
                echo "14";
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
              <td colspan="5" bgcolor="#FFFFFF"><b>Denominador</b></td>
            </tr>

            <tr>
              <td colspan="6" height="40" bgcolor="#FFFFFF"><b> </b></td>
            </tr>

            <tr>
              <td colspan="6" bgcolor="#32CD32"><b>Número de Beneficiários DREAMS que completaram pelo menos um serviço DREAMS mais não completaram o pacote primário de serviços </b></td>
            </tr>
            <tr>
              <td width="174" bgcolor="#F0FFF0">Tempo de registo como beneficiário DREAMS </td>
              <td bgcolor="#F0FFF0">10-14</td>
              <td bgcolor="#F0FFF0">15-19</td>
              <td bgcolor="#F0FFF0">20-24</td>
              <td bgcolor="#F0FFF0">25-29</td>
              <td bgcolor="#F0FFF0">Sub Total</td>
            </tr>
            <tr>
              <td bgcolor="#98FB98">0-6 meses </td>
              <td bgcolor="#98FB98">
                <?php
                echo "13";
                ?>
              </td>
              <td bgcolor="#98FB98">
                <?php
                echo "16";
                ?>
              </td>
              <td bgcolor="#98FB98">
                <?php
                echo "88";
                ?>
              </td>
              <td bgcolor="#98FB98">
                <?php
                echo "0";
                ?>
              </td>
              <td bgcolor="#98FB98">
                <?php
                echo "117";
                ?>
              </td>
            </tr>
            <tr>
              <td bgcolor="#F0FFF0">7-12 meses </td>
              <td bgcolor="#F0FFF0">
                <?php
                echo "0";
                ?>
              </td>
              <td bgcolor="#F0FFF0">
                <?php
                echo "3";
                ?>
              </td>
              <td bgcolor="#F0FFF0">
                <?php
                echo "39";
                ?>
              </td>
              <td bgcolor="#F0FFF0">
                <?php
                echo "5";
                ?>
              </td>
              <td bgcolor="#F0FFF0">
                <?php
                echo "47";
                ?>
              </td>
            </tr>
            <tr>
              <td bgcolor="#98FB98">13-24 meses </td>
              <td bgcolor="#98FB98">
                <?php
                echo "5";
                ?>
              </td>
              <td bgcolor="#98FB98">
                <?php
                echo "4";
                ?>
              </td>
              <td bgcolor="#98FB98">
                <?php
                echo "7";
                ?>
              </td>
              <td bgcolor="#98FB98">
                <?php
                echo "0";
                ?>
              </td>
              <td bgcolor="#98FB98">
                <?php
                echo "16";
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
              <td bgcolor="#F0FFF0">
                <?php
                echo "0";
                ?>
              </td>
            </tr>


            <tr>
              <td colspan="6" height="40" bgcolor="#FFFFFF"><b> </b></td>
            </tr>

            <tr>
              <td width="706" colspan="6" bgcolor="#1874CD"><b>Número de Beneficiários DREAMS que começaram um serviço DREAMS mas não completaram</b> </td>
            </tr>
            <tr>
              <td width="174" bgcolor="#CAE1FF">Tempo de registo como beneficiário DREAMS </td>
              <td bgcolor="#CAE1FF">10-14</td>
              <td bgcolor="#CAE1FF">15-19</td>
              <td bgcolor="#CAE1FF">20-24</td>
              <td bgcolor="#CAE1FF">25-29</td>
              <td bgcolor="#CAE1FF">Sub total</td>
            </tr>
            <tr>
              <td bgcolor="#6495ED">0-6 meses </td>
              <td bgcolor="#6495ED">
                <?php
                echo "2185";
                ?>
              </td>
              <td bgcolor="#6495ED">
                <?php
                echo "2500";
                ?>
              </td>
              <td bgcolor="#6495ED">
                <?php
                echo "897";
                ?>
              </td>
              <td bgcolor="#6495ED">
                <?php
                echo "8";
                ?>
              </td>
              <td bgcolor="#6495ED">
                <?php
                echo "5590";
                ?>
              </td>
            </tr>
            <tr>
              <td bgcolor="#CAE1FF">7-12 meses </td>
              <td bgcolor="#CAE1FF">
                <?php
                echo "101";
                ?>
              </td>
              <td bgcolor="#CAE1FF">
                <?php
                echo "128";
                ?>
              </td>
              <td bgcolor="#CAE1FF">
                <?php
                echo "33";
                ?>
              </td>
              <td bgcolor="#CAE1FF">
                <?php
                echo "3";
                ?>
              </td>
              <td bgcolor="#CAE1FF">
                <?php
                echo "265";
                ?>
              </td>
            </tr>
            <tr>
              <td bgcolor="#6495ED">13-24 meses </td>
              <td bgcolor="#6495ED">
                <?php
                echo "18";
                ?>
              </td>
              <td bgcolor="#6495ED">
                <?php
                echo "21";
                ?>
              </td>
              <td bgcolor="#6495ED">
                <?php
                echo "19";
                ?>
              </td>
              <td bgcolor="#6495ED">
                <?php
                echo "2";
                ?>
              </td>
              <td bgcolor="#6495ED">
                <?php
                echo "60";
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
              <td bgcolor="#CAE1FF">
                <?php
                echo "0";
                ?>
              </td>
            </tr>

            <tr>
              <td colspan="6" height="40" bgcolor="#FFFFFF"><b> </b></td>
            </tr>

            <!-- FIM !-->

            <tr>
              <td colspan="5" bgcolor="#FFFFFF"><b>Limpopo</b></td>
            </tr>

            <tr>
              <td colspan="5" bgcolor="#FFFFFF"><b>RESUMO Distrital</b></td>
            </tr>
            <tr>

              <td colspan="5" bgcolor="#FFFFFF"><b>Total de Adolescentes Jovens Registados: 13.617</b></td>
            </tr>
            <tr>
              <td colspan="5" bgcolor="#FFFFFF"><b>Total de adolescentes e Jovens do sexo feminino: 13.425</b></td>
            </tr>

            <tr>
              <td colspan="5" bgcolor="#FFFFFF"><b>Total de adolescentes e Jovens do sexo masculino: 192</b></td>
            </tr>

            <tr>
              <td colspan="5" bgcolor="#FFFFFF"><b>Total de Beneficiarias: 9.845</b></td>
            </tr>
          <tr>
            <td colspan="5" bgcolor="#FFFFFF"><b>Total de Beneficiarias Activas: 5.232</b></td>
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
            <!-- Inicio da Tabela !-->
            <tr>
              <td width="706" colspan="6" bgcolor="#66A5F4"><b>Número de Beneficiários DREAMS que completaram o pacote primario de serviços DREAMS, mas que não receberam nenhum outro serviço além do pacote primário
                </b> </td>
            </tr>
            <tr>
              <td width="174" bgcolor="#ffffff">Tempo de registo como beneficiário DREAMS</td>
              <td bgcolor="#ffffff">10-14</td>
              <td bgcolor="#ffffff">15-19</td>
              <td bgcolor="#ffffff">20-24</td>
              <td bgcolor="#ffffff">25-29</td>
              <td bgcolor="#ffffff">Sub-total</td>

            </tr>
            <tr>
              <td bgcolor="#CD9B9B">0-6 meses</td>
              <td bgcolor="#CD9B9B">
                <?php
                echo "57";
                ?>
              </td>
              <td bgcolor="#CD9B9B">
                <?php
                echo "22";
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
                echo "79";
                ?>
              </td>
            </tr>
            <tr>
              <td bgcolor="#FFE4E1">7-12 meses </td>
              <td bgcolor="#FFE4E1">
                <?php
                echo "9";
                ?>
              </td>
              <td bgcolor="#FFE4E1">
                <?php
                echo "8";
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
                echo "17";
                ?>
              </td>
            </tr>
            <tr>
              <td bgcolor="#CD9B9B">13-24 meses </td>
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
              <td bgcolor="#FFE4E1">
                <?php
                echo "0";
                ?>
              </td>
            </tr>

            <tr>
              <td colspan="6" height="40" bgcolor="#FFFFFF"><b> </b></td>
            </tr>


            <!-- Inicio da Tabela !-->
            <tr>
              <td width="706" colspan="6" bgcolor="#F4A460"><b>Número de Beneficiários DREAMS que completaram o pacote primario de serviços DREAMS e que receberam pelo menos um serviço do pacote secundário</b> </td>
            </tr>
            <tr>
              <td width="174" bgcolor="#FAEBD7">Tempo de registo como beneficiário DREAMS</td>
              <td bgcolor="#FAEBD7">10-14</td>
              <td bgcolor="#FAEBD7">15-19</td>
              <td bgcolor="#FAEBD7">20-24</td>
              <td bgcolor="#FAEBD7">25-29</td>
              <td bgcolor="#FAEBD7">Sub-total</td>
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
                echo "44";
                ?>
              </td>
              <td bgcolor="#FFDEAD">
                <?php
                echo "57";
                ?>
              </td>
              <td bgcolor="#FFDEAD">
                <?php
                echo "0";
                ?>
              </td>
              <td bgcolor="#FFDEAD">
                <?php
                echo "105";
                ?>
              </td>
            </tr>
            <tr>
              <td bgcolor="#FAEBD7">7-12 meses </td>
              <td bgcolor="#FAEBD7">
                <?php
                echo "5";
                ?>
              </td>
              <td bgcolor="#FAEBD7">
                <?php
                echo "68";
                ?>
              </td>
              <td bgcolor="#FAEBD7">
                <?php
                echo "38";
                ?>
              </td>
              <td bgcolor="#FAEBD7">
                <?php
                echo "0";
                ?>
              </td>
              <td bgcolor="#FAEBD7">
                <?php
                echo "111";
                ?>
              </td>
            </tr>
            <tr>
              <td bgcolor="#FFDEAD">13-24 meses </td>
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
              <td bgcolor="#FFDEAD">
                <?php
                echo "1";
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
              <td colspan="5" bgcolor="#FFFFFF"><b>Denominador</b></td>
            </tr>

            <tr>
              <td colspan="6" height="40" bgcolor="#FFFFFF"><b> </b></td>
            </tr>

            <tr>
              <td colspan="6" bgcolor="#32CD32"><b>Número de Beneficiários DREAMS que completaram pelo menos um serviço DREAMS mais não completaram o pacote primário de serviços </b></td>
            </tr>
            <tr>
              <td width="174" bgcolor="#F0FFF0">Tempo de registo como beneficiário DREAMS </td>
              <td bgcolor="#F0FFF0">10-14</td>
              <td bgcolor="#F0FFF0">15-19</td>
              <td bgcolor="#F0FFF0">20-24</td>
              <td bgcolor="#F0FFF0">25-29</td>
              <td bgcolor="#F0FFF0">Sub Total</td>
            </tr>
            <tr>
              <td bgcolor="#98FB98">0-6 meses </td>
              <td bgcolor="#98FB98">
                <?php
                echo "21";
                ?>
              </td>
              <td bgcolor="#98FB98">
                <?php
                echo "26";
                ?>
              </td>
              <td bgcolor="#98FB98">
                <?php
                echo "81";
                ?>
              </td>
              <td bgcolor="#98FB98">
                <?php
                echo "1";
                ?>
              </td>
              <td bgcolor="#98FB98">
                <?php
                echo "129";
                ?>
              </td>
            </tr>
            <tr>
              <td bgcolor="#F0FFF0">7-12 meses </td>
              <td bgcolor="#F0FFF0">
                <?php
                echo "0";
                ?>
              </td>
              <td bgcolor="#F0FFF0">
                <?php
                echo "3";
                ?>
              </td>
              <td bgcolor="#F0FFF0">
                <?php
                echo "23";
                ?>
              </td>
              <td bgcolor="#F0FFF0">
                <?php
                echo "1";
                ?>
              </td>
              <td bgcolor="#F0FFF0">
                <?php
                echo "27";
                ?>
              </td>
            </tr>
            <tr>
              <td bgcolor="#98FB98">13-24 meses </td>
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
              <td bgcolor="#F0FFF0">
                <?php
                echo "0";
                ?>
              </td>
            </tr>


            <tr>
              <td colspan="6" height="40" bgcolor="#FFFFFF"><b> </b></td>
            </tr>

            <tr>
              <td width="706" colspan="6" bgcolor="#1874CD"><b>Número de Beneficiários DREAMS que começaram um serviço DREAMS mas não completaram</b> </td>
            </tr>
            <tr>
              <td width="174" bgcolor="#CAE1FF">Tempo de registo como beneficiário DREAMS </td>
              <td bgcolor="#CAE1FF">10-14</td>
              <td bgcolor="#CAE1FF">15-19</td>
              <td bgcolor="#CAE1FF">20-24</td>
              <td bgcolor="#CAE1FF">25-29</td>
              <td bgcolor="#CAE1FF">Sub total</td>
            </tr>
            <tr>
              <td bgcolor="#6495ED">0-6 meses </td>
              <td bgcolor="#6495ED">
                <?php
                echo "1121";
                ?>
              </td>
              <td bgcolor="#6495ED">
                <?php
                echo "1930";
                ?>
              </td>
              <td bgcolor="#6495ED">
                <?php
                echo "1177";
                ?>
              </td>
              <td bgcolor="#6495ED">
                <?php
                echo "62";
                ?>
              </td>
              <td bgcolor="#6495ED">
                <?php
                echo "4290";
                ?>
              </td>
            </tr>
            <tr>
              <td bgcolor="#CAE1FF">7-12 meses </td>
              <td bgcolor="#CAE1FF">
                <?php
                echo "101";
                ?>
              </td>
              <td bgcolor="#CAE1FF">
                <?php
                echo "251";
                ?>
              </td>
              <td bgcolor="#CAE1FF">
                <?php
                echo "98";
                ?>
              </td>
              <td bgcolor="#CAE1FF">
                <?php
                echo "17";
                ?>
              </td>
              <td bgcolor="#CAE1FF">
                <?php
                echo "467";
                ?>
              </td>
            </tr>
            <tr>
              <td bgcolor="#6495ED">13-24 meses </td>
              <td bgcolor="#6495ED">
                <?php
                echo "2";
                ?>
              </td>
              <td bgcolor="#6495ED">
                <?php
                echo "3";
                ?>
              </td>
              <td bgcolor="#6495ED">
                <?php
                echo "1";
                ?>
              </td>
              <td bgcolor="#6495ED">
                <?php
                echo "0";
                ?>
              </td>
              <td bgcolor="#6495ED">
                <?php
                echo "6";
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
              <td bgcolor="#CAE1FF">
                <?php
                echo "0";
                ?>
              </td>
            </tr>

            <tr>
              <td colspan="6" height="40" bgcolor="#FFFFFF"><b> </b></td>
            </tr>

            <!-- FIM !-->

            <tr>
              <td colspan="5" bgcolor="#FFFFFF"><b>Chongoene</b></td>
            </tr>

            <tr>
              <td colspan="5" bgcolor="#FFFFFF"><b>RESUMO Distrital</b></td>
            </tr>
            <tr>

              <td colspan="5" bgcolor="#FFFFFF"><b>Total de Adolescentes Jovens Registados: 6.824</b></td>
            </tr>
            <tr>
              <td colspan="5" bgcolor="#FFFFFF"><b>Total de adolescentes e Jovens do sexo feminino: 6.688</b></td>
            </tr>

            <tr>
              <td colspan="5" bgcolor="#FFFFFF"><b>Total de adolescentes e Jovens do sexo masculino: 136</b></td>
            </tr>

            <tr>
              <td colspan="5" bgcolor="#FFFFFF"><b>Total de Beneficiarias: 2.990</b></td>
            </tr>
          <tr>
            <td colspan="5" bgcolor="#FFFFFF"><b>Total de Beneficiarias Activas: 889</b></td>
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
            <!-- Inicio da Tabela !-->
            <tr>
              <td width="706" colspan="6" bgcolor="#66A5F4"><b>Número de Beneficiários DREAMS que completaram o pacote primario de serviços DREAMS, mas que não receberam nenhum outro serviço além do pacote primário
                </b> </td>
            </tr>
            <tr>
              <td width="174" bgcolor="#ffffff">Tempo de registo como beneficiário DREAMS</td>
              <td bgcolor="#ffffff">10-14</td>
              <td bgcolor="#ffffff">15-19</td>
              <td bgcolor="#ffffff">20-24</td>
              <td bgcolor="#ffffff">25-29</td>
              <td bgcolor="#ffffff">Sub-total</td>

            </tr>
            <tr>
              <td bgcolor="#CD9B9B">0-6 meses</td>
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
            </tr>
            <tr>
              <td bgcolor="#FFE4E1">7-12 meses </td>
              <td bgcolor="#FFE4E1">
                <?php
                echo "2";
                ?>
              </td>
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
                echo "27";
                ?>
              </td>
            </tr>
            <tr>
              <td bgcolor="#CD9B9B">13-24 meses </td>
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
              <td bgcolor="#FFE4E1">
                <?php
                echo "0";
                ?>
              </td>
            </tr>

            <tr>
              <td colspan="6" height="40" bgcolor="#FFFFFF"><b> </b></td>
            </tr>


            <!-- Inicio da Tabela !-->
            <tr>
              <td width="706" colspan="6" bgcolor="#F4A460"><b>Número de Beneficiários DREAMS que completaram o pacote primario de serviços DREAMS e que receberam pelo menos um serviço do pacote secundário</b> </td>
            </tr>
            <tr>
              <td width="174" bgcolor="#FAEBD7">Tempo de registo como beneficiário DREAMS</td>
              <td bgcolor="#FAEBD7">10-14</td>
              <td bgcolor="#FAEBD7">15-19</td>
              <td bgcolor="#FAEBD7">20-24</td>
              <td bgcolor="#FAEBD7">25-29</td>
              <td bgcolor="#FAEBD7">Sub-total</td>
            </tr>
            <tr>
              <td bgcolor="#FFDEAD">0-6 meses </td>
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
                echo "2";
                ?>
              </td>
            </tr>
            <tr>
              <td bgcolor="#FAEBD7">7-12 meses </td>
              <td bgcolor="#FAEBD7">
                <?php
                echo "3";
                ?>
              </td>
              <td bgcolor="#FAEBD7">
                <?php
                echo "24";
                ?>
              </td>
              <td bgcolor="#FAEBD7">
                <?php
                echo "3";
                ?>
              </td>
              <td bgcolor="#FAEBD7">
                <?php
                echo "0";
                ?>
              </td>
              <td bgcolor="#FAEBD7">
                <?php
                echo "30";
                ?>
              </td>
            </tr>
            <tr>
              <td bgcolor="#FFDEAD">13-24 meses </td>
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
              <td colspan="5" bgcolor="#FFFFFF"><b>Denominador</b></td>
            </tr>

            <tr>
              <td colspan="6" height="40" bgcolor="#FFFFFF"><b> </b></td>
            </tr>

            <tr>
              <td colspan="6" bgcolor="#32CD32"><b>Número de Beneficiários DREAMS que completaram pelo menos um serviço DREAMS mais não completaram o pacote primário de serviços </b></td>
            </tr>
            <tr>
              <td width="174" bgcolor="#F0FFF0">Tempo de registo como beneficiário DREAMS </td>
              <td bgcolor="#F0FFF0">10-14</td>
              <td bgcolor="#F0FFF0">15-19</td>
              <td bgcolor="#F0FFF0">20-24</td>
              <td bgcolor="#F0FFF0">25-29</td>
              <td bgcolor="#F0FFF0">Sub Total</td>
            </tr>
            <tr>
              <td bgcolor="#98FB98">0-6 meses </td>
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
                echo "24";
                ?>
              </td>
              <td bgcolor="#98FB98">
                <?php
                echo "1";
                ?>
              </td>
              <td bgcolor="#98FB98">
                <?php
                echo "25";
                ?>
              </td>
            </tr>
            <tr>
              <td bgcolor="#F0FFF0">7-12 meses </td>
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
                echo "20";
                ?>
              </td>
              <td bgcolor="#F0FFF0">
                <?php
                echo "1";
                ?>
              </td>
              <td bgcolor="#F0FFF0">
                <?php
                echo "21";
                ?>
              </td>
            </tr>
            <tr>
              <td bgcolor="#98FB98">13-24 meses </td>
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
                echo "2";
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
              <td bgcolor="#F0FFF0">
                <?php
                echo "0";
                ?>
              </td>
            </tr>


            <tr>
              <td colspan="6" height="40" bgcolor="#FFFFFF"><b> </b></td>
            </tr>

            <tr>
              <td width="706" colspan="6" bgcolor="#1874CD"><b>Número de Beneficiários DREAMS que começaram um serviço DREAMS mas não completaram</b> </td>
            </tr>
            <tr>
              <td width="174" bgcolor="#CAE1FF">Tempo de registo como beneficiário DREAMS </td>
              <td bgcolor="#CAE1FF">10-14</td>
              <td bgcolor="#CAE1FF">15-19</td>
              <td bgcolor="#CAE1FF">20-24</td>
              <td bgcolor="#CAE1FF">25-29</td>
              <td bgcolor="#CAE1FF">Sub total</td>
            </tr>
            <tr>
              <td bgcolor="#6495ED">0-6 meses </td>
              <td bgcolor="#6495ED">
                <?php
                echo "225";
                ?>
              </td>
              <td bgcolor="#6495ED">
                <?php
                echo "162";
                ?>
              </td>
              <td bgcolor="#6495ED">
                <?php
                echo "45";
                ?>
              </td>
              <td bgcolor="#6495ED">
                <?php
                echo "1";
                ?>
              </td>
              <td bgcolor="#6495ED">
                <?php
                echo "433";
                ?>
              </td>
            </tr>
            <tr>
              <td bgcolor="#CAE1FF">7-12 meses </td>
              <td bgcolor="#CAE1FF">
                <?php
                echo "59";
                ?>
              </td>
              <td bgcolor="#CAE1FF">
                <?php
                echo "153";
                ?>
              </td>
              <td bgcolor="#CAE1FF">
                <?php
                echo "83";
                ?>
              </td>
              <td bgcolor="#CAE1FF">
                <?php
                echo "13";
                ?>
              </td>
              <td bgcolor="#CAE1FF">
                <?php
                echo "308";
                ?>
              </td>
            </tr>
            <tr>
              <td bgcolor="#6495ED">13-24 meses </td>
              <td bgcolor="#6495ED">
                <?php
                echo "12";
                ?>
              </td>
              <td bgcolor="#6495ED">
                <?php
                echo "25";
                ?>
              </td>
              <td bgcolor="#6495ED">
                <?php
                echo "2";
                ?>
              </td>
              <td bgcolor="#6495ED">
                <?php
                echo "0";
                ?>
              </td>
              <td bgcolor="#6495ED">
                <?php
                echo "39";
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
              <td bgcolor="#CAE1FF">
                <?php
                echo "0";
                ?>
              </td>
            </tr>

            <tr>
              <td colspan="6" height="40" bgcolor="#FFFFFF"><b> </b></td>
            </tr>

            <!-- FIM !-->

            <tr>
              <td colspan="5" bgcolor="#FFFFFF"><b>Chokwe</b></td>
            </tr>
            <tr>

            <tr>
              <td colspan="5" bgcolor="#FFFFFF"><b>RESUMO Distrital</b></td>
            </tr>
            <tr>

              <td colspan="5" bgcolor="#FFFFFF"><b>Total de Adolescentes Jovens Registados: 12.023</b></td>
            </tr>
            <tr>
              <td colspan="5" bgcolor="#FFFFFF"><b>Total de adolescentes e Jovens do sexo feminino: 11.751</b></td>
            </tr>

            <tr>
              <td colspan="5" bgcolor="#FFFFFF"><b>Total de adolescentes e Jovens do sexo masculino: 272</b></td>
            </tr>

            <tr>
              <td colspan="5" bgcolor="#FFFFFF"><b>Total de Beneficiarias: 6.134</b></td>
            </tr>
          <tr>
            <td colspan="5" bgcolor="#FFFFFF"><b>Total de Beneficiarias Activas: 2.405</b></td>
          </tr>


            <tr>
              <td colspan="5" height="40" bgcolor="#FFFFFF"><b> </b></td>
            </tr>
            <!-- Inicio da Tabela !-->
            <tr>
              <td width="706" colspan="6" bgcolor="#66A5F4"><b>Número de Beneficiários DREAMS que completaram o pacote primario de serviços DREAMS, mas que não receberam nenhum outro serviço além do pacote primário
                </b> </td>
            </tr>
            <tr>
              <td width="174" bgcolor="#ffffff">Tempo de registo como beneficiário DREAMS</td>
              <td bgcolor="#ffffff">10-14</td>
              <td bgcolor="#ffffff">15-19</td>
              <td bgcolor="#ffffff">20-24</td>
              <td bgcolor="#ffffff">25-29</td>
              <td bgcolor="#ffffff">Sub-total</td>

            </tr>
            <tr>
              <td bgcolor="#CD9B9B">0-6 meses</td>
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
              <td bgcolor="#CD9B9B">
                <?php
                echo "0";
                ?>
              </td>
            </tr>
            <tr>
              <td bgcolor="#FFE4E1">7-12 meses </td>
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
              <td bgcolor="#FFE4E1">
                <?php
                echo "0";
                ?>
              </td>
            </tr>
            <tr>
              <td bgcolor="#CD9B9B">13-24 meses </td>
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
              <td bgcolor="#FFE4E1">
                <?php
                echo "0";
                ?>
              </td>
            </tr>

            <tr>
              <td colspan="6" height="40" bgcolor="#FFFFFF"><b> </b></td>
            </tr>


            <!-- Inicio da Tabela !-->
            <tr>
              <td width="706" colspan="6" bgcolor="#F4A460"><b>Número de Beneficiários DREAMS que completaram o pacote primario de serviços DREAMS e que receberam pelo menos um serviço do pacote secundário</b> </td>
            </tr>
            <tr>
              <td width="174" bgcolor="#FAEBD7">Tempo de registo como beneficiário DREAMS</td>
              <td bgcolor="#FAEBD7">10-14</td>
              <td bgcolor="#FAEBD7">15-19</td>
              <td bgcolor="#FAEBD7">20-24</td>
              <td bgcolor="#FAEBD7">25-29</td>
              <td bgcolor="#FAEBD7">Sub-total</td>
            </tr>
            <tr>
              <td bgcolor="#FFDEAD">0-6 meses </td>
              <td bgcolor="#FFDEAD">
                <?php
                echo "20";
                ?>
              </td>
              <td bgcolor="#FFDEAD">
                <?php
                echo "11";
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
              <td bgcolor="#FFDEAD">
                <?php
                echo "44";
                ?>
              </td>
            </tr>
            <tr>
              <td bgcolor="#FAEBD7">7-12 meses </td>
              <td bgcolor="#FAEBD7">
                <?php
                echo "1";
                ?>
              </td>
              <td bgcolor="#FAEBD7">
                <?php
                echo "3";
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
                echo "4";
                ?>
              </td>
            </tr>
            <tr>
              <td bgcolor="#FFDEAD">13-24 meses </td>
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
              <td colspan="5" bgcolor="#FFFFFF"><b>Denominador</b></td>
            </tr>

            <tr>
              <td colspan="6" height="40" bgcolor="#FFFFFF"><b> </b></td>
            </tr>

            <tr>
              <td colspan="6" bgcolor="#32CD32"><b>Número de Beneficiários DREAMS que completaram pelo menos um serviço DREAMS mais não completaram o pacote primário de serviços </b></td>
            </tr>
            <tr>
              <td width="174" bgcolor="#F0FFF0">Tempo de registo como beneficiário DREAMS </td>
              <td bgcolor="#F0FFF0">10-14</td>
              <td bgcolor="#F0FFF0">15-19</td>
              <td bgcolor="#F0FFF0">20-24</td>
              <td bgcolor="#F0FFF0">25-29</td>
              <td bgcolor="#F0FFF0">Sub Total</td>
            </tr>
            <tr>
              <td bgcolor="#98FB98">0-6 meses </td>
              <td bgcolor="#98FB98">
                <?php
                echo "6";
                ?>
              </td>
              <td bgcolor="#98FB98">
                <?php
                echo "42";
                ?>
              </td>
              <td bgcolor="#98FB98">
                <?php
                echo "37";
                ?>
              </td>
              <td bgcolor="#98FB98">
                <?php
                echo "2";
                ?>
              </td>
              <td bgcolor="#98FB98">
                <?php
                echo "87";
                ?>
              </td>
            </tr>
            <tr>
              <td bgcolor="#F0FFF0">7-12 meses </td>
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
                echo "1";
                ?>
              </td>
            </tr>
            <tr>
              <td bgcolor="#98FB98">13-24 meses </td>
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
              <td bgcolor="#F0FFF0">
                <?php
                echo "0";
                ?>
              </td>
            </tr>


            <tr>
              <td colspan="6" height="40" bgcolor="#FFFFFF"><b> </b></td>
            </tr>

            <tr>
              <td width="706" colspan="6" bgcolor="#1874CD"><b>Número de Beneficiários DREAMS que começaram um serviço DREAMS mas não completaram</b> </td>
            </tr>
            <tr>
              <td width="174" bgcolor="#CAE1FF">Tempo de registo como beneficiário DREAMS </td>
              <td bgcolor="#CAE1FF">10-14</td>
              <td bgcolor="#CAE1FF">15-19</td>
              <td bgcolor="#CAE1FF">20-24</td>
              <td bgcolor="#CAE1FF">25-29</td>
              <td bgcolor="#CAE1FF">Sub total</td>
            </tr>
            <tr>
              <td bgcolor="#6495ED">0-6 meses </td>
              <td bgcolor="#6495ED">
                <?php
                echo "620";
                ?>
              </td>
              <td bgcolor="#6495ED">
                <?php
                echo "1135";
                ?>
              </td>
              <td bgcolor="#6495ED">
                <?php
                echo "495";
                ?>
              </td>
              <td bgcolor="#6495ED">
                <?php
                echo "7";
                ?>
              </td>
              <td bgcolor="#6495ED">
                <?php
                echo "2257";
                ?>
              </td>
            </tr>
            <tr>
              <td bgcolor="#CAE1FF">7-12 meses </td>
              <td bgcolor="#CAE1FF">
                <?php
                echo "1";
                ?>
              </td>
              <td bgcolor="#CAE1FF">
                <?php
                echo "1";
                ?>
              </td>
              <td bgcolor="#CAE1FF">
                <?php
                echo "6";
                ?>
              </td>
              <td bgcolor="#CAE1FF">
                <?php
                echo "2";
                ?>
              </td>
              <td bgcolor="#CAE1FF">
                <?php
                echo "10";
                ?>
              </td>
            </tr>
            <tr>
              <td bgcolor="#6495ED">13-24 meses </td>
              <td bgcolor="#6495ED">
                <?php
                echo "1";
                ?>
              </td>
              <td bgcolor="#6495ED">
                <?php
                echo "1";
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
                echo "2";
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
              <td bgcolor="#CAE1FF">
                <?php
                echo "0";
                ?>
              </td>
            </tr>

            <tr>
              <td colspan="6" height="40" bgcolor="#FFFFFF"><b> </b></td>
            </tr>

            <!-- FIM !-->
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

              <td colspan="5" bgcolor="#FFFFFF"><b>Total de Adolescentes Jovens Registados: 30.709 </b></td>
            </tr>
            <tr>
              <td colspan="5" bgcolor="#FFFFFF"><b>Total de adolescentes e Jovens do sexo feminino: 23.978</b></td>
            </tr>

            <tr>
              <td colspan="5" bgcolor="#FFFFFF"><b>Total de adolescentes e Jovens do sexo masculino: 6.731</b></td>
            </tr>

            <tr>
              <td colspan="5" bgcolor="#FFFFFF"><b>Total de Beneficiarias: 14.224</b></td>
            </tr>
          <tr>
            <td colspan="5" bgcolor="#FFFFFF"><b>Total de Beneficiarias Activas: 4.851</b></td>
          </tr>


            <tr>
              <td colspan="5" height="40" bgcolor="#FFFFFF"><b> </b></td>
            </tr>

            <tr>
              <td colspan="6" bgcolor="#FFFFFF"><b>Numerador</b></td>
            </tr>

            <tr>
              <td colspan="6" height="40" bgcolor="#FFFFFF"><b> </b></td>
            </tr>

            <tr>
              <td width="706" colspan="6" bgcolor="#66A5F4"><b>Número de Beneficiários DREAMS que completaram o pacote primario de serviços DREAMS, mas que não receberam nenhum outro serviço além do pacote primário
                </b> </td>
            </tr>
            <tr>
              <td width="174" bgcolor="#ffffff">Tempo de registo como beneficiário DREAMS</td>
              <td bgcolor="#ffffff">10-14</td>
              <td bgcolor="#ffffff">15-19</td>
              <td bgcolor="#ffffff">20-24</td>
              <td bgcolor="#ffffff">25-29</td>
              <td bgcolor="#ffffff">Sub-total</td>

            </tr>
            <tr>
              <td bgcolor="#CD9B9B">0-6 meses</td>
              <td bgcolor="#CD9B9B">
                <?php
                echo "20";
                ?>
              </td>
              <td bgcolor="#CD9B9B">
                <?php
                echo "4";
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
                echo "24";
                ?>
              </td>
            </tr>
            <tr>
              <td bgcolor="#FFE4E1">7-12 meses </td>
              <td bgcolor="#FFE4E1">
                <?php
                echo "15";
                ?>
              </td>
              <td bgcolor="#FFE4E1">
                <?php
                echo "6";
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
                echo "21";
                ?>
              </td>
            </tr>
            <tr>
              <td bgcolor="#CD9B9B">13-24 meses </td>
              <td bgcolor="#CD9B9B">
                <?php
                echo "6";
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
              <td bgcolor="#CD9B9B">
                <?php
                echo "0";
                ?>
              </td>
              <td bgcolor="#CD9B9B">
                <?php
                echo "11";
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
                echo "2";
                ?>
              </td>
            </tr>

            <tr>
              <td colspan="6" height="40" bgcolor="#FFFFFF"><b> </b></td>
            </tr>


            <tr>
              <td width="706" colspan="6" bgcolor="#F4A460"><b>Número de Beneficiários DREAMS que completaram o pacote primario de serviços DREAMS e que receberam pelo menos um serviço do pacote secundário</b> </td>
            </tr>
            <tr>
              <td width="174" bgcolor="#FAEBD7">Tempo de registo como beneficiário DREAMS</td>
              <td bgcolor="#FAEBD7">10-14</td>
              <td bgcolor="#FAEBD7">15-19</td>
              <td bgcolor="#FAEBD7">20-24</td>
              <td bgcolor="#FAEBD7">25-29</td>
              <td bgcolor="#FAEBD7">Sub-total</td>
            </tr>
            <tr>
              <td bgcolor="#FFDEAD">0-6 meses </td>
              <td bgcolor="#FFDEAD">
                <?php
                echo "1";
                ?>
              </td>
              <td bgcolor="#FFDEAD">
                <?php
                echo "2";
                ?>
              </td>
              <td bgcolor="#FFDEAD">
                <?php
                echo "15";
                ?>
              </td>
              <td bgcolor="#FFDEAD">
                <?php
                echo "0";
                ?>
              </td>
              <td bgcolor="#FFDEAD">
                <?php
                echo "18";
                ?>
              </td>
            </tr>
            <tr>
              <td bgcolor="#FAEBD7">7-12 meses </td>
              <td bgcolor="#FAEBD7">
                <?php
                echo "7";
                ?>
              </td>
              <td bgcolor="#FAEBD7">
                <?php
                echo "27";
                ?>
              </td>
              <td bgcolor="#FAEBD7">
                <?php
                echo "11";
                ?>
              </td>
              <td bgcolor="#FAEBD7">
                <?php
                echo "0";
                ?>
              </td>
              <td bgcolor="#FAEBD7">
                <?php
                echo "45";
                ?>
              </td>
            </tr>
            <tr>
              <td bgcolor="#FFDEAD">13-24 meses </td>
              <td bgcolor="#FFDEAD">
                <?php
                echo "9";
                ?>
              </td>
              <td bgcolor="#FFDEAD">
                <?php
                echo "18";
                ?>
              </td>
              <td bgcolor="#FFDEAD">
                <?php
                echo "21";
                ?>
              </td>
              <td bgcolor="#FFDEAD">
                <?php
                echo "0";
                ?>
              </td>
              <td bgcolor="#FFDEAD">
                <?php
                echo "48";
                ?>
              </td>
            </tr>
            <tr>
              <td bgcolor="#FAEBD7">25 meses ou +</td>
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
              <td bgcolor="#FAEBD7">
                <?php
                echo "0";
                ?>
              </td>
              <td bgcolor="#FAEBD7">
                <?php
                echo "2";
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
              <td colspan="6" height="40" bgcolor="#FFFFFF"><b> </b></td>
            </tr>

            <tr>
              <td colspan="6" bgcolor="#32CD32"><b>Número de Beneficiários DREAMS que completaram pelo menos um serviço DREAMS mais não completaram o pacote primário de serviços </b></td>
            </tr>
            <tr>
              <td width="174" bgcolor="#F0FFF0">Tempo de registo como beneficiário DREAMS </td>
              <td bgcolor="#F0FFF0">10-14</td>
              <td bgcolor="#F0FFF0">15-19</td>
              <td bgcolor="#F0FFF0">20-24</td>
              <td bgcolor="#F0FFF0">25-29</td>
              <td bgcolor="#F0FFF0">Sub Total</td>
            </tr>
            <tr>
              <td bgcolor="#98FB98">0-6 meses </td>
              <td bgcolor="#98FB98">
                <?php
                echo "20";
                ?>
              </td>
              <td bgcolor="#98FB98">
                <?php
                echo "133";
                ?>
              </td>
              <td bgcolor="#98FB98">
                <?php
                echo "99";
                ?>
              </td>
              <td bgcolor="#98FB98">
                <?php
                echo "4";
                ?>
              </td>
              <td bgcolor="#98FB98">
                <?php
                echo "256";
                ?>
              </td>
            </tr>
            <tr>
              <td bgcolor="#F0FFF0">7-12 meses </td>
              <td bgcolor="#F0FFF0">
                <?php
                echo "0";
                ?>
              </td>
              <td bgcolor="#F0FFF0">
                <?php
                echo "4";
                ?>
              </td>
              <td bgcolor="#F0FFF0">
                <?php
                echo "4";
                ?>
              </td>
              <td bgcolor="#F0FFF0">
                <?php
                echo "0";
                ?>
              </td>
              <td bgcolor="#F0FFF0">
                <?php
                echo "8";
                ?>
              </td>
            </tr>
            <tr>
              <td bgcolor="#98FB98">13-24 meses </td>
              <td bgcolor="#98FB98">
                <?php
                echo "1";
                ?>
              </td>
              <td bgcolor="#98FB98">
                <?php
                echo "2";
                ?>
              </td>
              <td bgcolor="#98FB98">
                <?php
                echo "5";
                ?>
              </td>
              <td bgcolor="#98FB98">
                <?php
                echo "1";
                ?>
              </td>
              <td bgcolor="#98FB98">
                <?php
                echo "9";
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
              <td bgcolor="#F0FFF0">
                <?php
                echo "0";
                ?>
              </td>
            </tr>


            <tr>
              <td colspan="6" height="40" bgcolor="#FFFFFF"><b> </b></td>
            </tr>

            <tr>
              <td width="706" colspan="6" bgcolor="#1874CD"><b>Número de Beneficiários DREAMS que começaram um serviço DREAMS mas não completaram</b> </td>
            </tr>
            <tr>
              <td width="174" bgcolor="#CAE1FF">Tempo de registo como beneficiário DREAMS </td>
              <td bgcolor="#CAE1FF">10-14</td>
              <td bgcolor="#CAE1FF">15-19</td>
              <td bgcolor="#CAE1FF">20-24</td>
              <td bgcolor="#CAE1FF">25-29</td>
              <td bgcolor="#CAE1FF">Sub total</td>
            </tr>
            <tr>
              <td bgcolor="#6495ED">0-6 meses </td>
              <td bgcolor="#6495ED">
                <?php
                echo "552";
                ?>
              </td>
              <td bgcolor="#6495ED">
                <?php
                echo "1922";
                ?>
              </td>
              <td bgcolor="#6495ED">
                <?php
                echo "1597";
                ?>
              </td>
              <td bgcolor="#6495ED">
                <?php
                echo "25";
                ?>
              </td>
              <td bgcolor="#6495ED">
                <?php
                echo "4096";
                ?>
              </td>
            </tr>
            <tr>
              <td bgcolor="#CAE1FF">7-12 meses </td>
              <td bgcolor="#CAE1FF">
                <?php
                echo "40";
                ?>
              </td>
              <td bgcolor="#CAE1FF">
                <?php
                echo "57";
                ?>
              </td>
              <td bgcolor="#CAE1FF">
                <?php
                echo "24";
                ?>
              </td>
              <td bgcolor="#CAE1FF">
                <?php
                echo "2";
                ?>
              </td>
              <td bgcolor="#CAE1FF">
                <?php
                echo "123";
                ?>
              </td>
            </tr>
            <tr>
              <td bgcolor="#6495ED">13-24 meses </td>
              <td bgcolor="#6495ED">
                <?php
                echo "16";
                ?>
              </td>
              <td bgcolor="#6495ED">
                <?php
                echo "87";
                ?>
              </td>
              <td bgcolor="#6495ED">
                <?php
                echo "62";
                ?>
              </td>
              <td bgcolor="#6495ED">
                <?php
                echo "16";
                ?>
              </td>
              <td bgcolor="#6495ED">
                <?php
                echo "181";
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
                echo "5";
                ?>
              </td>
              <td bgcolor="#CAE1FF">
                <?php
                echo "2";
                ?>
              </td>
              <td bgcolor="#CAE1FF">
                <?php
                echo "0";
                ?>
              </td>
              <td bgcolor="#CAE1FF">
                <?php
                echo "7";
                ?>
              </td>
            </tr>

            <tr>
              <td colspan="6" height="40" bgcolor="#FFFFFF"><b> </b></td>
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
              <td colspan="5" bgcolor="#FFFFFF"><b>Cidade de Quelimane</b></td>
            </tr>

            <tr>
              <td colspan="5" bgcolor="#FFFFFF"><b>RESUMO Distrital</b></td>
            </tr>
            <tr>

              <td colspan="5" bgcolor="#FFFFFF"><b>Total de Adolescentes Jovens Registados: 33.959</b></td>
            </tr>
            <tr>
              <td colspan="5" bgcolor="#FFFFFF"><b>Total de adolescentes e Jovens do sexo feminino: 22.645</b></td>
            </tr>

            <tr>
              <td colspan="5" bgcolor="#FFFFFF"><b>Total de adolescentes e Jovens do sexo masculino: 11.314</b></td>
            </tr>

            <tr>
              <td colspan="5" bgcolor="#FFFFFF"><b>Total de Beneficiarias: 15.414</b></td>
            </tr>
          <tr>
            <td colspan="5" bgcolor="#FFFFFF"><b>Total de Beneficiarias Activas: 4.712</b></td>
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
            <!-- Inicio da Tabela !-->
            <tr>
              <td width="706" colspan="6" bgcolor="#66A5F4"><b>Número de Beneficiários DREAMS que completaram o pacote primario de serviços DREAMS, mas que não receberam nenhum outro serviço além do pacote primário
                </b> </td>
            </tr>
            <tr>
              <td width="174" bgcolor="#ffffff">Tempo de registo como beneficiário DREAMS</td>
              <td bgcolor="#ffffff">10-14</td>
              <td bgcolor="#ffffff">15-19</td>
              <td bgcolor="#ffffff">20-24</td>
              <td bgcolor="#ffffff">25-29</td>
              <td bgcolor="#ffffff">Sub-total</td>

            </tr>
            <tr>
              <td bgcolor="#CD9B9B">0-6 meses</td>
              <td bgcolor="#CD9B9B">
                <?php
                echo "165";
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
              <td bgcolor="#CD9B9B">
                <?php
                echo "0";
                ?>
              </td>
              <td bgcolor="#CD9B9B">
                <?php
                echo "194";
                ?>
              </td>
            </tr>
            <tr>
              <td bgcolor="#FFE4E1">7-12 meses </td>
              <td bgcolor="#FFE4E1">
                <?php
                echo "96";
                ?>
              </td>
              <td bgcolor="#FFE4E1">
                <?php
                echo "28";
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
                echo "124";
                ?>
              </td>
            </tr>
            <tr>
              <td bgcolor="#CD9B9B">13-24 meses </td>
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
              <td bgcolor="#FFE4E1">
                <?php
                echo "1";
                ?>
              </td>
            </tr>

            <tr>
              <td colspan="6" height="40" bgcolor="#FFFFFF"><b> </b></td>
            </tr>


            <!-- Inicio da Tabela !-->
            <tr>
              <td width="706" colspan="6" bgcolor="#F4A460"><b>Número de Beneficiários DREAMS que completaram o pacote primario de serviços DREAMS e que receberam pelo menos um serviço do pacote secundário</b> </td>
            </tr>
            <tr>
              <td width="174" bgcolor="#FAEBD7">Tempo de registo como beneficiário DREAMS</td>
              <td bgcolor="#FAEBD7">10-14</td>
              <td bgcolor="#FAEBD7">15-19</td>
              <td bgcolor="#FAEBD7">20-24</td>
              <td bgcolor="#FAEBD7">25-29</td>
              <td bgcolor="#FAEBD7">Sub-total</td>
            </tr>
            <tr>
              <td bgcolor="#FFDEAD">0-6 meses </td>
              <td bgcolor="#FFDEAD">
                <?php
                echo "50";
                ?>
              </td>
              <td bgcolor="#FFDEAD">
                <?php
                echo "302";
                ?>
              </td>
              <td bgcolor="#FFDEAD">
                <?php
                echo "339";
                ?>
              </td>
              <td bgcolor="#FFDEAD">
                <?php
                echo "0";
                ?>
              </td>
              <td bgcolor="#FFDEAD">
                <?php
                echo "691";
                ?>
              </td>
            </tr>
            <tr>
              <td bgcolor="#FAEBD7">7-12 meses </td>
              <td bgcolor="#FAEBD7">
                <?php
                echo "35";
                ?>
              </td>
              <td bgcolor="#FAEBD7">
                <?php
                echo "274";
                ?>
              </td>
              <td bgcolor="#FAEBD7">
                <?php
                echo "220";
                ?>
              </td>
              <td bgcolor="#FAEBD7">
                <?php
                echo "0";
                ?>
              </td>
              <td bgcolor="#FAEBD7">
                <?php
                echo "529";
                ?>
              </td>
            </tr>
            <tr>
              <td bgcolor="#FFDEAD">13-24 meses </td>
              <td bgcolor="#FFDEAD">
                <?php
                echo "1";
                ?>
              </td>
              <td bgcolor="#FFDEAD">
                <?php
                echo "24";
                ?>
              </td>
              <td bgcolor="#FFDEAD">
                <?php
                echo "26";
                ?>
              </td>
              <td bgcolor="#FFDEAD">
                <?php
                echo "0";
                ?>
              </td>
              <td bgcolor="#FFDEAD">
                <?php
                echo "51";
                ?>
              </td>
            </tr>
            <tr>
              <td bgcolor="#FAEBD7">25 meses ou +</td>
              <td bgcolor="#FAEBD7">
                <?php
                echo "3";
                ?>
              </td>
              <td bgcolor="#FAEBD7">
                <?php
                echo "15";
                ?>
              </td>
              <td bgcolor="#FAEBD7">
                <?php
                echo "34";
                ?>
              </td>
              <td bgcolor="#FAEBD7">
                <?php
                echo "0";
                ?>
              </td>
              <td bgcolor="#FAEBD7">
                <?php
                echo "52";
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
              <td colspan="6" height="40" bgcolor="#FFFFFF"><b> </b></td>
            </tr>

            <tr>
              <td colspan="6" bgcolor="#32CD32"><b>Número de Beneficiários DREAMS que completaram pelo menos um serviço DREAMS mais não completaram o pacote primário de serviços </b></td>
            </tr>
            <tr>
              <td width="174" bgcolor="#F0FFF0">Tempo de registo como beneficiário DREAMS </td>
              <td bgcolor="#F0FFF0">10-14</td>
              <td bgcolor="#F0FFF0">15-19</td>
              <td bgcolor="#F0FFF0">20-24</td>
              <td bgcolor="#F0FFF0">25-29</td>
              <td bgcolor="#F0FFF0">Sub Total</td>
            </tr>
            <tr>
              <td bgcolor="#98FB98">0-6 meses </td>
              <td bgcolor="#98FB98">
                <?php
                echo "4";
                ?>
              </td>
              <td bgcolor="#98FB98">
                <?php
                echo "16";
                ?>
              </td>
              <td bgcolor="#98FB98">
                <?php
                echo "18";
                ?>
              </td>
              <td bgcolor="#98FB98">
                <?php
                echo "0";
                ?>
              </td>
              <td bgcolor="#98FB98">
                <?php
                echo "38";
                ?>
              </td>
            </tr>
            <tr>
              <td bgcolor="#F0FFF0">7-12 meses </td>
              <td bgcolor="#F0FFF0">
                <?php
                echo "25";
                ?>
              </td>
              <td bgcolor="#F0FFF0">
                <?php
                echo "56";
                ?>
              </td>
              <td bgcolor="#F0FFF0">
                <?php
                echo "65";
                ?>
              </td>
              <td bgcolor="#F0FFF0">
                <?php
                echo "12";
                ?>
              </td>
              <td bgcolor="#F0FFF0">
                <?php
                echo "158";
                ?>
              </td>
            </tr>
            <tr>
              <td bgcolor="#98FB98">13-24 meses </td>
              <td bgcolor="#98FB98">
                <?php
                echo "1";
                ?>
              </td>
              <td bgcolor="#98FB98">
                <?php
                echo "16";
                ?>
              </td>
              <td bgcolor="#98FB98">
                <?php
                echo "11";
                ?>
              </td>
              <td bgcolor="#98FB98">
                <?php
                echo "1";
                ?>
              </td>
              <td bgcolor="#98FB98">
                <?php
                echo "29";
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
                echo "2";
                ?>
              </td>
              <td bgcolor="#F0FFF0">
                <?php
                echo "7";
                ?>
              </td>
              <td bgcolor="#F0FFF0">
                <?php
                echo "4";
                ?>
              </td>
              <td bgcolor="#F0FFF0">
                <?php
                echo "13";
                ?>
              </td>
            </tr>


            <tr>
              <td colspan="6" height="40" bgcolor="#FFFFFF"><b> </b></td>
            </tr>

            <tr>
              <td width="706" colspan="6" bgcolor="#1874CD"><b>Número de Beneficiários DREAMS que começaram um serviço DREAMS mas não completaram</b> </td>
            </tr>
            <tr>
              <td width="174" bgcolor="#CAE1FF">Tempo de registo como beneficiário DREAMS </td>
              <td bgcolor="#CAE1FF">10-14</td>
              <td bgcolor="#CAE1FF">15-19</td>
              <td bgcolor="#CAE1FF">20-24</td>
              <td bgcolor="#CAE1FF">25-29</td>
              <td bgcolor="#CAE1FF">Sub total</td>
            </tr>
            <tr>
              <td bgcolor="#6495ED">0-6 meses </td>
              <td bgcolor="#6495ED">
                <?php
                echo "379";
                ?>
              </td>
              <td bgcolor="#6495ED">
                <?php
                echo "1475";
                ?>
              </td>
              <td bgcolor="#6495ED">
                <?php
                echo "325";
                ?>
              </td>
              <td bgcolor="#6495ED">
                <?php
                echo "36";
                ?>
              </td>
              <td bgcolor="#6495ED">
                <?php
                echo "2215";
                ?>
              </td>
            </tr>
            <tr>
              <td bgcolor="#CAE1FF">7-12 meses </td>
              <td bgcolor="#CAE1FF">
                <?php
                echo "47";
                ?>
              </td>
              <td bgcolor="#CAE1FF">
                <?php
                echo "278";
                ?>
              </td>
              <td bgcolor="#CAE1FF">
                <?php
                echo "111";
                ?>
              </td>
              <td bgcolor="#CAE1FF">
                <?php
                echo "50";
                ?>
              </td>
              <td bgcolor="#CAE1FF">
                <?php
                echo "486";
                ?>
              </td>
            </tr>
            <tr>
              <td bgcolor="#6495ED">13-24 meses </td>
              <td bgcolor="#6495ED">
                <?php
                echo "4";
                ?>
              </td>
              <td bgcolor="#6495ED">
                <?php
                echo "70";
                ?>
              </td>
              <td bgcolor="#6495ED">
                <?php
                echo "21";
                ?>
              </td>
              <td bgcolor="#6495ED">
                <?php
                echo "7";
                ?>
              </td>
              <td bgcolor="#6495ED">
                <?php
                echo "102";
                ?>
              </td>
            </tr>
            <tr>
              <td bgcolor="#CAE1FF">25 meses ou +</td>
              <td bgcolor="#CAE1FF">
                <?php
                echo "4";
                ?>
              </td>
              <td bgcolor="#CAE1FF">
                <?php
                echo "7";
                ?>
              </td>
              <td bgcolor="#CAE1FF">
                <?php
                echo "2";
                ?>
              </td>
              <td bgcolor="#CAE1FF">
                <?php
                echo "15";
                ?>
              </td>
              <td bgcolor="#CAE1FF">
                <?php
                echo "28";
                ?>
              </td>
            </tr>

            <tr>
              <td colspan="6" height="40" bgcolor="#FFFFFF"><b> </b></td>
            </tr>

            <!-- FIM !-->

            <tr>
              <td colspan="5" bgcolor="#FFFFFF"><b>Nicoadala</b></td>
            </tr>

            <tr>
              <td colspan="5" bgcolor="#FFFFFF"><b>RESUMO Distrital</b></td>
            </tr>
            <tr>

              <td colspan="5" bgcolor="#FFFFFF"><b>Total de Adolescentes Jovens Registados: 19.090</b></td>
            </tr>
            <tr>
              <td colspan="5" bgcolor="#FFFFFF"><b>Total de adolescentes e Jovens do sexo feminino: 14.472</b></td>
            </tr>

            <tr>
              <td colspan="5" bgcolor="#FFFFFF"><b>Total de adolescentes e Jovens do sexo masculino: 4.618</b></td>
            </tr>

            <tr>
              <td colspan="5" bgcolor="#FFFFFF"><b>Total de Beneficiarias: 10.704</b></td>
            </tr>
          <tr>
            <td colspan="5" bgcolor="#FFFFFF"><b>Total de Beneficiarias Activas: 3.598</b></td>
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
            <!-- Inicio da Tabela !-->
            <tr>
              <td width="706" colspan="6" bgcolor="#66A5F4"><b>Número de Beneficiários DREAMS que completaram o pacote primario de serviços DREAMS, mas que não receberam nenhum outro serviço além do pacote primário
                </b> </td>
            </tr>
            <tr>
              <td width="174" bgcolor="#ffffff">Tempo de registo como beneficiário DREAMS</td>
              <td bgcolor="#ffffff">10-14</td>
              <td bgcolor="#ffffff">15-19</td>
              <td bgcolor="#ffffff">20-24</td>
              <td bgcolor="#ffffff">25-29</td>
              <td bgcolor="#ffffff">Sub-total</td>

            </tr>
            <tr>
              <td bgcolor="#CD9B9B">0-6 meses</td>
              <td bgcolor="#CD9B9B">
                <?php
                echo "7";
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
              <td bgcolor="#CD9B9B">
                <?php
                echo "7";
                ?>
              </td>
            </tr>
            <tr>
              <td bgcolor="#FFE4E1">7-12 meses </td>
              <td bgcolor="#FFE4E1">
                <?php
                echo "65";
                ?>
              </td>
              <td bgcolor="#FFE4E1">
                <?php
                echo "4";
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
                echo "69";
                ?>
              </td>
            </tr>
            <tr>
              <td bgcolor="#CD9B9B">13-24 meses </td>
              <td bgcolor="#CD9B9B">
                <?php
                echo "0";
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
              <td bgcolor="#CD9B9B">
                <?php
                echo "0";
                ?>
              </td>
              <td bgcolor="#CD9B9B">
                <?php
                echo "2";
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
              <td bgcolor="#FFE4E1">
                <?php
                echo "0";
                ?>
              </td>
            </tr>

            <tr>
              <td colspan="6" height="40" bgcolor="#FFFFFF"><b> </b></td>
            </tr>


            <!-- Inicio da Tabela !-->
            <tr>
              <td width="706" colspan="6" bgcolor="#F4A460"><b>Número de Beneficiários DREAMS que completaram o pacote primario de serviços DREAMS e que receberam pelo menos um serviço do pacote secundário</b> </td>
            </tr>
            <tr>
              <td width="174" bgcolor="#FAEBD7">Tempo de registo como beneficiário DREAMS</td>
              <td bgcolor="#FAEBD7">10-14</td>
              <td bgcolor="#FAEBD7">15-19</td>
              <td bgcolor="#FAEBD7">20-24</td>
              <td bgcolor="#FAEBD7">25-29</td>
              <td bgcolor="#FAEBD7">Sub-total</td>
            </tr>
            <tr>
              <td bgcolor="#FFDEAD">0-6 meses </td>
              <td bgcolor="#FFDEAD">
                <?php
                echo "37";
                ?>
              </td>
              <td bgcolor="#FFDEAD">
                <?php
                echo "123";
                ?>
              </td>
              <td bgcolor="#FFDEAD">
                <?php
                echo "185";
                ?>
              </td>
              <td bgcolor="#FFDEAD">
                <?php
                echo "0";
                ?>
              </td>
              <td bgcolor="#FFDEAD">
                <?php
                echo "345";
                ?>
              </td>
            </tr>
            <tr>
              <td bgcolor="#FAEBD7">7-12 meses </td>
              <td bgcolor="#FAEBD7">
                <?php
                echo "168";
                ?>
              </td>
              <td bgcolor="#FAEBD7">
                <?php
                echo "526";
                ?>
              </td>
              <td bgcolor="#FAEBD7">
                <?php
                echo "563";
                ?>
              </td>
              <td bgcolor="#FAEBD7">
                <?php
                echo "0";
                ?>
              </td>
              <td bgcolor="#FAEBD7">
                <?php
                echo "1257";
                ?>
              </td>
            </tr>
            <tr>
              <td bgcolor="#FFDEAD">13-24 meses </td>
              <td bgcolor="#FFDEAD">
                <?php
                echo "37";
                ?>
              </td>
              <td bgcolor="#FFDEAD">
                <?php
                echo "123";
                ?>
              </td>
              <td bgcolor="#FFDEAD">
                <?php
                echo "185";
                ?>
              </td>
              <td bgcolor="#FFDEAD">
                <?php
                echo "0";
                ?>
              </td>
              <td bgcolor="#FFDEAD">
                <?php
                echo "345";
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
              <td colspan="5" bgcolor="#FFFFFF"><b>Denominador</b></td>
            </tr>

            <tr>
              <td colspan="6" height="40" bgcolor="#FFFFFF"><b> </b></td>
            </tr>

            <tr>
              <td colspan="6" bgcolor="#32CD32"><b>Número de Beneficiários DREAMS que completaram pelo menos um serviço DREAMS mais não completaram o pacote primário de serviços </b></td>
            </tr>
            <tr>
              <td width="174" bgcolor="#F0FFF0">Tempo de registo como beneficiário DREAMS </td>
              <td bgcolor="#F0FFF0">10-14</td>
              <td bgcolor="#F0FFF0">15-19</td>
              <td bgcolor="#F0FFF0">20-24</td>
              <td bgcolor="#F0FFF0">25-29</td>
              <td bgcolor="#F0FFF0">Sub Total</td>
            </tr>
            <tr>
              <td bgcolor="#98FB98">0-6 meses </td>
              <td bgcolor="#98FB98">
                <?php
                echo "4";
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
              <td bgcolor="#98FB98">
                <?php
                echo "4";
                ?>
              </td>
            </tr>
            <tr>
              <td bgcolor="#F0FFF0">7-12 meses </td>
              <td bgcolor="#F0FFF0">
                <?php
                echo "36";
                ?>
              </td>
              <td bgcolor="#F0FFF0">
                <?php
                echo "64";
                ?>
              </td>
              <td bgcolor="#F0FFF0">
                <?php
                echo "83";
                ?>
              </td>
              <td bgcolor="#F0FFF0">
                <?php
                echo "53";
                ?>
              </td>
              <td bgcolor="#F0FFF0">
                <?php
                echo "236";
                ?>
              </td>
            </tr>
            <tr>
              <td bgcolor="#98FB98">13-24 meses </td>
              <td bgcolor="#98FB98">
                <?php
                echo "0";
                ?>
              </td>
              <td bgcolor="#98FB98">
                <?php
                echo "24";
                ?>
              </td>
              <td bgcolor="#98FB98">
                <?php
                echo "8";
                ?>
              </td>
              <td bgcolor="#98FB98">
                <?php
                echo "3";
                ?>
              </td>
              <td bgcolor="#98FB98">
                <?php
                echo "35";
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
              <td bgcolor="#F0FFF0">
                <?php
                echo "0";
                ?>
              </td>
            </tr>


            <tr>
              <td colspan="6" height="40" bgcolor="#FFFFFF"><b> </b></td>
            </tr>

            <tr>
              <td width="706" colspan="6" bgcolor="#1874CD"><b>Número de Beneficiários DREAMS que começaram um serviço DREAMS mas não completaram</b> </td>
            </tr>
            <tr>
              <td width="174" bgcolor="#CAE1FF">Tempo de registo como beneficiário DREAMS </td>
              <td bgcolor="#CAE1FF">10-14</td>
              <td bgcolor="#CAE1FF">15-19</td>
              <td bgcolor="#CAE1FF">20-24</td>
              <td bgcolor="#CAE1FF">25-29</td>
              <td bgcolor="#CAE1FF">Sub total</td>
            </tr>
            <tr>
              <td bgcolor="#6495ED">0-6 meses </td>
              <td bgcolor="#6495ED">
                <?php
                echo "157";
                ?>
              </td>
              <td bgcolor="#6495ED">
                <?php
                echo "414";
                ?>
              </td>
              <td bgcolor="#6495ED">
                <?php
                echo "63";
                ?>
              </td>
              <td bgcolor="#6495ED">
                <?php
                echo "18";
                ?>
              </td>
              <td bgcolor="#6495ED">
                <?php
                echo "652";
                ?>
              </td>
            </tr>
            <tr>
              <td bgcolor="#CAE1FF">7-12 meses </td>
              <td bgcolor="#CAE1FF">
                <?php
                echo "78";
                ?>
              </td>
              <td bgcolor="#CAE1FF">
                <?php
                echo "307";
                ?>
              </td>
              <td bgcolor="#CAE1FF">
                <?php
                echo "169";
                ?>
              </td>
              <td bgcolor="#CAE1FF">
                <?php
                echo "157";
                ?>
              </td>
              <td bgcolor="#CAE1FF">
                <?php
                echo "711";
                ?>
              </td>
            </tr>
            <tr>
              <td bgcolor="#6495ED">13-24 meses </td>
              <td bgcolor="#6495ED">
                <?php
                echo "5";
                ?>
              </td>
              <td bgcolor="#6495ED">
                <?php
                echo "106";
                ?>
              </td>
              <td bgcolor="#6495ED">
                <?php
                echo "53";
                ?>
              </td>
              <td bgcolor="#6495ED">
                <?php
                echo "17";
                ?>
              </td>
              <td bgcolor="#6495ED">
                <?php
                echo "181";
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
                echo "1";
                ?>
              </td>
            </tr>

            <tr>
              <td colspan="6" height="40" bgcolor="#FFFFFF"><b> </b></td>
            </tr>

            <!-- FIM !-->


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
                echo "12";
                ?>
              </td>
              <td bgcolor="#CD9B9B">
                <?php
                echo "";
                ?>
              </td>
              <td bgcolor="#CD9B9B">
                <?php
                echo "751";
                ?>
              </td>
            </tr>
            <tr>
              <td bgcolor="#FFE4E1">Chonguene </td>
              <td bgcolor="#FFE4E1">
                <?php
                echo "1";
                ?>
              </td>
              <td bgcolor="#FFE4E1">
                <?php
                echo "";
                ?>
              </td>
              <td bgcolor="#FFE4E1">
                <?php
                echo "132";
                ?>
              </td>

            </tr>
            <tr>
              <td bgcolor="#CD9B9B">Beira </td>
              <td bgcolor="#CD9B9B">
                <?php
                echo "3";
                ?>
              </td>
              <td bgcolor="#CD9B9B">
                <?php
                echo "";
                ?>
              </td>
              <td bgcolor="#CD9B9B">
                <?php
                echo "135";
                ?>
              </td>

            </tr>
            <tr>
              <td bgcolor="#FFE4E1">Xai Xai</td>
              <td bgcolor="#FFE4E1">
                <?php
                echo "32";
                ?>
              </td>
              <td bgcolor="#FFE4E1">
                <?php
                echo "";
                ?>
              </td>
              <td bgcolor="#FFE4E1">
                <?php
                echo "2753";
                ?>
              </td>

            </tr>
            <tr>
              <td bgcolor="#CD9B9B">Limpopo </td>
              <td bgcolor="#CD9B9B">
                <?php
                echo "8";
                ?>
              </td>
              <td bgcolor="#CD9B9B">
                <?php
                echo "";
                ?>
              </td>
              <td bgcolor="#CD9B9B">
                <?php
                echo "2916";
                ?>
              </td>

            </tr>

            <tr>
              <td bgcolor="#FFE4E1">Matutuine</td>
              <td bgcolor="#FFE4E1">
                <?php
                echo "0";
                ?>
              </td>
              <td bgcolor="#FFE4E1">
                <?php
                echo "";
                ?>
              </td>
              <td bgcolor="#FFE4E1">
                <?php
                echo "679";
                ?>
              </td>

            </tr>

            <tr>
              <td bgcolor="#CD9B9B">Namaacha</td>
              <td bgcolor="#CD9B9B">
                <?php
                echo "8";
                ?>
              </td>
              <td bgcolor="#CD9B9B">
                <?php
                echo "";
                ?>
              </td>
              <td bgcolor="#CD9B9B">
                <?php
                echo "52";
                ?>
              </td>

            </tr>

            <tr>
              <td bgcolor="#FFE4E1">Nicoadala</td>
              <td bgcolor="#FFE4E1">
                <?php
                echo "12";
                ?>
              </td>
              <td bgcolor="#FFE4E1">
                <?php
                echo "";
                ?>
              </td>
              <td bgcolor="#FFE4E1">
                <?php
                echo "524";
                ?>
              </td>

            </tr>

            <tr>
              <td bgcolor="#CD9B9B">Quelimane</td>
              <td bgcolor="#CD9B9B">
                <?php
                echo "118";
                ?>
              </td>
              <td bgcolor="#CD9B9B">
                <?php
                echo "";
                ?>
              </td>
              <td bgcolor="#CD9B9B">
                <?php
                echo "1636";
                ?>
              </td>

            </tr>

            <tr>
              <td bgcolor="#FFE4E1">Total</td>
              <td bgcolor="#FFE4E1">
                <?php
                echo "194";
                ?>
              </td>
              <td bgcolor="#FFE4E1">
                <?php
                echo "";
                ?>
              </td>
              <td bgcolor="#FFE4E1">
                <?php
                echo "9578";
                ?>
              </td>

            </tr>

          </table>
        </div>


      </div>

    </div>
  </div>

</div>
