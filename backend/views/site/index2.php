<?php
/* @var $this Dreams\web\View */
use yii\helpers\Html;
use  app\models\Beneficiarios;
use common\models\User;


use  app\models\ServicosDream;
use  app\models\ServicosBeneficiados;
$this->title = 'DREAMS - SISTEMA INTEGRADO DE CADASTRO DE ADOLESCENTES E JOVENS';
?>
<div class="site-index">

   <!-- <div class="jumbotron"> -->
    <div class="body-content">
    <div class="row">
<div class="col-lg-12">

<div class="panel panel-primary">
  <div class="panel-heading"> <strong align="center">BEM VINDO AO SISTEMA DREAMS</strong></div>
  <div class="panel-body">
       
	 <div class="panel panel-info">
  <div class="panel-heading">
	  <button data-toggle="collapse" data-target="#statisticsDREAMS">
  <i class="ion ion-pie-graph ion-success"></i> PRINCIPAIS INDICADORES</button>
  </div>  
	  <div id="statisticsDREAMS" class="collapse">
	  <?php 
/*ini_set('max_execution_time', 2400); //300 seconds = 5 minutes
ini_set('memory_limit', '-1');*/
include ("reports/regional.php"); ?> 
		  
		
		
		  
		  
		  
		 </div>
		 </div>
	  
<div class="col-lg-8"> 
<div class="panel panel-success">
  <div class="panel-heading"> <strong align="center"><i class="ion ion-pie-graph info"></i> CADASTROS POR PROVINCIA</strong></div>
  <div class="panel-body">

	
	  
	 <?php

//ini_set('max_execution_time', 300); //300 seconds = 5 minutes
//ini_set('memory_limit', '-1');
//include ("reports/regional.php"); ?> 
	 
	  <?php
ini_set('max_execution_time', 300); //300 seconds = 5 minutes
ini_set('memory_limit', '-1');
require_once("tabelas.php")

?>
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	<!--  
 <div class="row"> 
<div class="col-md-6">
<div id="zambezia" style="height: 250px; width: 100%;"></div>
</div>

<div class="col-md-6">
<div id="sofala" style="height: 250px; width: 100%;"></div>
 </div>
 </div>

 <div class="row"> 
 <div class="col-md-6">
<div id="gaza" style="height: 250px; width: 100%;"></div>
 </div>

  <div class="col-md-6">
<div id="maputo" style="height: 250px; width: 100%;"></div>
 </div>
 </div>

-->

  
<?php 
 $sofala = Beneficiarios::find()->where(['provin_code'=>5])->andWhere(['emp_status'=>1])->count();
 $zambezia = Beneficiarios::find()->where(['provin_code'=>8])->andWhere(['emp_status'=>1])->count();
 $gaza = Beneficiarios::find()->where(['provin_code'=>3])->andWhere(['emp_status'=>1])->count();
 $maputo = Beneficiarios::find()->where(['provin_code'=>1])->andWhere(['emp_status'=>1])->count();
?>


</div>
    <div class="panel-footer clearfix">
        <div class="pull-right">
            <a href="#" class="btn btn-danger">Ver mais</a>
            <a href="#" class="btn btn-default">Go Back</a>
        </div>
    </div>

</div>

</div>


<div class="col-lg-4"> 
<div class="panel panel-info">
  <div class="panel-heading"> <strong align="center"> <i class="ion ion-ios7-people info"></i> 10 NOVOS BENEFICIÁRIOS</strong></div>
  <div class="panel-body"   data-spy="scroll" style="height:750px; overflow-y: scroll;">
<!-- <span onclick="this.parentElement.style.display='none'" 
    class="w3-closebtn w3-padding w3-margin-right w3-medium">x</span> -->
 <?php include("novos.php"); ?>   

</div>
</div>


</div>
  

</div> <!-- CONTEUDO DO BODY -->
</div>

</div>
</div>


    </div>
</div>

 

<?php $total=25; ?>
    <script type="text/javascript">
window.onload = function () {

	var core = new CanvasJS.Chart("core",
      {
        title:{
          text: "SOFALA"
        },

        legend: {
			verticalAlign: "bottom",
			horizontalAlign: "center"
		},
              animationEnabled: true,
        data: [
        {
          type: "pie",
          startAngle: 0,
          toolTipContent: "{y} Benefici&aacute;rios registados, com idade entre {legendText} ~ <strong>#percent% </strong>",
          showInLegend: true,
          explodeOnClick: true, //**Change it to true*/
          indexLabelPlacement: "inside",
          indexLabelFontColor: "#fff",
			    indexLabelLineColor: "darkgrey",
          indexLabelFontSize: 12,
          indexLabel: "#percent%",
          dataPoints: [
            {y: <?php echo $tot1; ?>, indexLabel: "#percent%", legendText: "[10-14]" },
            {y: <?php echo $tot2; ?>,  indexLabel: "#percent%", legendText: "[15-19]" },
            {y: <?php echo $tot3; ?>,  indexLabel: "#percent%", legendText: "[20-25]" }
          ]
        }
        ]
      });
      core.render();
	
	var core8 = new CanvasJS.Chart("core8",
      {
        title:{
          text: "ZAMBÉZIA"
        },

        legend: {
			verticalAlign: "bottom",
			horizontalAlign: "center"
		},
              animationEnabled: true,
        data: [
        {
          type: "pie",
          startAngle: 0,
          toolTipContent: "{y} Benefici&aacute;rios registados, com idade entre {legendText} ~ <strong>#percent% </strong>",
          showInLegend: true,
          explodeOnClick: true, //**Change it to true*/
          indexLabelPlacement: "inside",
          indexLabelFontColor: "#fff",
			    indexLabelLineColor: "darkgrey",
          indexLabelFontSize: 12,
          indexLabel: "#percent%",
          dataPoints: [
            {y: <?php echo $tot18; ?>, indexLabel: "#percent%", legendText: "[10-14]" },
            {y: <?php echo $tot28; ?>,  indexLabel: "#percent%", legendText: "[15-19]" },
            {y: <?php echo $tot38; ?>,  indexLabel: "#percent%", legendText: "[20-25]" }
          ]
        }
        ]
      });
      core8.render();
	
	var core3 = new CanvasJS.Chart("core3",
      {
        title:{
          text: "GAZA"
        },

        legend: {
			verticalAlign: "bottom",
			horizontalAlign: "center"
		},
              animationEnabled: true,
        data: [
        {
          type: "pie",
          startAngle: 0,
          toolTipContent: "{y} Benefici&aacute;rios registados, com idade entre {legendText} ~ <strong>#percent% </strong>",
          showInLegend: true,
          explodeOnClick: true, //**Change it to true*/
          indexLabelPlacement: "inside",
          indexLabelFontColor: "#fff",
			    indexLabelLineColor: "darkgrey",
          indexLabelFontSize: 12,
          indexLabel: "#percent%",
          dataPoints: [
            {y: <?php echo $tot13; ?>, indexLabel: "#percent%", legendText: "[10-14]" },
            {y: <?php echo $tot23; ?>,  indexLabel: "#percent%", legendText: "[15-19]" },
            {y: <?php echo $tot33; ?>,  indexLabel: "#percent%", legendText: "[20-25]" }
          ]
        }
        ]
      });
      core3.render();
	
	
	
	
	
	
	
	
var sofala = new CanvasJS.Chart("sofala",
  {
    title:{
      text: "SOFALA"
    },
                animationEnabled: true,
    data: [
    {
      type: "doughnut",
      startAngle: 0,
      toolTipContent: "{legendText}: {y} - <strong>#percent% </strong>",
      showInLegend: true,
          explodeOnClick: false, //**Change it to true*/
      dataPoints: [
        {y: <?= $sofala; ?>, indexLabel: "#percent%", legendText: "Registados" },
        {y: 2000,  indexLabel: "#percent%", legendText: "Por Registar" }
      ]
    }
    ]
  });
  sofala.render();	
	
	
  var zambezia = new CanvasJS.Chart("zambezia",
  {
    title:{
      text: "ZAMBEZIA"
    },
                animationEnabled: true,
    data: [
    {
      type: "doughnut",
      startAngle: 60,
      toolTipContent: "{legendText}: {y} - <strong>#percent% </strong>",
      showInLegend: true,
          explodeOnClick: false, //**Change it to true*/
      dataPoints: [
        {y: <?= $zambezia; ?>, indexLabel: "#percent%", legendText: "Registados" },
        {y: 2000,  indexLabel: "#percent%", legendText: "Por Registar" }
      ]
    }
    ]
  });
  zambezia.render();
  

  


 var gaza = new CanvasJS.Chart("gaza",
  {
    title:{
      text: "GAZA"
    },
                animationEnabled: true,
    data: [
    {
      type: "doughnut",
      startAngle: 0,
      toolTipContent: "{legendText}: {y} - <strong>#percent% </strong>",
      showInLegend: true,
          explodeOnClick: false, //**Change it to true*/
      dataPoints: [
        {y: <?= $gaza; ?>, indexLabel: "#percent%", legendText: "Registados" },
        {y: 2000,  indexLabel: "#percent%", legendText: "Por Registar" }
      ]
    }
    ]
  });
  gaza.render();


 var maputo = new CanvasJS.Chart("maputo",
  {
    title:{
      text: "MAPUTO"
    },
                animationEnabled: true,
    data: [
    {
      type: "doughnut",
      startAngle: 0,
      toolTipContent: "{legendText}: {y} - <strong>#percent% </strong>",
      showInLegend: true,
          explodeOnClick: false, //**Change it to true*/
      dataPoints: [
        {y: <?= $maputo; ?>, indexLabel: "#percent%", legendText: "Registados" },
        {y: 2000,  indexLabel: "#percent%", legendText: "Por Registar" }
      ]
    }
    ]
  });
  maputo.render();


	$(document).ready(function() {
    $.getScript('https://app.dreams.co.mz/backend/web/js/charts.js',function(){

        var data = {
            labels : [
              <?php
              $tcliservicos= ServicosDream::find()->where(['core_service'=>1])->andWhere(['=', 'status', 1])->count();
              $cliservicos= ServicosDream::find()->where(['core_service'=>1])->andWhere(['=', 'status', 1])->all();
              $cliServices=0;
              foreach ($cliservicos as $core) {

 $value=$core->id.',';
 echo $value;
/*if((int)$core->servico_id==1) {

if((int)$core->id<10) { echo "A0".(int)$core->id.','; } else { echo "A".(int)$core->id.','; }

} else {
if((int)$core->id<10) { echo "B0".(int)$core->id.','; } else { echo "B".(int)$core->id.','; }
  //echo 'B'.((int)$core->id<10) ? (int)$core->id.',' : (int)$core->id.',';
}*/



            //  echo sprintf('%02d', (int)$core->id);
            }
              ?>





            ],
            datasets : [
                {
                    fillColor : "#261657",
                    strokeColor : "rgba(220,220,220,1)",
                    pointColor : "rgba(220,220,220,1)",
                    pointStrokeColor : "#fff",
                    data : [

                      <?php
                      $tcliservicos= ServicosDream::find()->where(['core_service'=>1])->andWhere(['=', 'status', 1])->count();
                      $cliservicos= ServicosDream::find()->where(['core_service'=>1])->andWhere(['=', 'status', 1])->all();
                      $cliServices=0;
                      foreach ($cliservicos as $core) {

                      echo  $cliServices = $cliServices+ServicosBeneficiados::find()
                      //   ->where(['=','beneficiario_id',$model->member_id])
                         ->andWhere(['=', 'servico_id', $core->id])
                         ->andWhere(['=', 'status', 1])

                         ->select('servico_id')->distinct()
                         ->count().',';
                    }
                      ?>


                    ]
                },
              /*  {
                    fillColor : "rgba(151,187,205,0.5)",
                    strokeColor : "rgba(151,187,205,1)",
                    pointColor : "rgba(151,187,205,1)",
                    pointStrokeColor : "#fff",
                    data : [28,48,40,19,96,27,100]
                }*/
            ]
        }

        var options = {
            animation: true
        };

        //Get the context of the canvas element we want to select
        var c = $('#myChart');
        var ct = c.get(0).getContext('2d');
        var ctx = document.getElementById("myChart").getContext("2d");
        /*********************/
        new Chart(ctx).Bar(data,options);

    })
  });
	
	
}
  </script>
