<?php
/* @var $this Dreams\web\View */
use yii\helpers\Html;
use  app\models\Beneficiarios;
use common\models\User;


use  app\models\ServicosDream;
use  app\models\ServicosBeneficiados;

if (isset(Yii::$app->user->identity->role)&&(Yii::$app->user->identity->role>0)) {
if(isset(Yii::$app->user->identity->provin_code)&&(Yii::$app->user->identity->provin_code>0)) {
$prov=(int)Yii::$app->user->identity->provin_code;
$beneficiarios= Beneficiarios::find()
->where(['>', 'district_code', 0])
->andWhere(['emp_status'=>1])
->andWhere(['provin_code'=>$prov])->all();
} elseif(Yii::$app->user->identity->role==20) {

$beneficiarios= Beneficiarios::find()->where(['>', 'district_code', 0])
->andWhere(['emp_status'=>1])->all();

}

} else {
$beneficiarios= Beneficiarios::find()
->where(['>', 'district_code', 0])
->andWhere(['emp_status'=>1])
->andWhere(['provin_code'=>5])->all();
}



$cliServices=0;

//Total Core e Non-Core Services
  $tcservicos = ServicosDream::find()
  ->where(['core_service'=>1])
  ->andWhere(['=', 'status', 1])
  ->orderBy(['servico_id'=>SORT_ASC])
  ->count();

  $tservicos = ServicosDream::find()
  ->where(['core_service'=>0])
  ->andWhere(['=', 'status', 1])
  ->orderBy(['servico_id'=>SORT_ASC])->count();

//Busca todos Core e Non-Core Services



function color($i) {
  if($i<45) { return "danger";}
  elseif($i<75) { return "warning"; }
  else {return "success";}

 }


$cores= ServicosDream::find()
->where(['=','core_service',1])
->andWhere(['=', 'status', 1])
->orderBy(['servico_id'=>SORT_ASC,'name'=>SORT_ASC])
->all();


  $cbeneficiarios= Beneficiarios::find()->where(['>', 'district_code', 0])
  ->andWhere(['emp_status'=>1])->count();

?>


<div class="col-lg-12">

    <div class="panel panel-info">
  <div class="panel-heading">
<button data-toggle="collapse" data-target="#statisticsDREAMS">
  <i class="ion ion-pie-graph ion-success"></i> PRINCIPAIS INDICADORES
  </div>

     <div class="panel-body">
<div id="statisticsDREAMS" class="collapse">
	
<script  src="https://app.dreams.co.mz/backend/web/js/Chart.js"></script>

	<h3 align="center"> Servi&ccedil;os DREAMS oferecidos</h3>
<canvas id="CoreService" width="600" height="400"></canvas>
	
	
	
  <table class="table table-hover"  data-spy="scroll">
  <thead>
    <tr style="text-align: center; vertical-align: middle;">
    <th>Serviços</th>
    <th>Progresso (%)</th>
    <th>Total</th>
   
  </tr>
  </thead>

  <tbody>
    <tr>
      <td align="right" style="width: 35%">Total de Beneficiários Registados</td>
      <td  align="right" style="width: 40%">
        <div class="progress">
          <?php
  $totalB=round($cbeneficiarios/6000*100,0);
           ?>
    <div class="progress-bar progress-bar-<?= color($totalB); ?>" role="progressbar" aria-valuenow="<?= $totalB ?>"
    aria-valuemin="0" aria-valuemax="100" style="width:<?= $totalB ?>%">
      <?= $totalB ?>%
    </div>
  </div>  </td>

      <td>  <span class="label label-<?= color($totalB); ?>"><?= $cbeneficiarios; ?></span>
      </td>

    </tr>


<?php foreach ($cores as $core) {
   $conta=ServicosBeneficiados::find()
     ->where(['=', 'servico_id', $core->id])
     ->andWhere(['=', 'status', 1])
     ->select('beneficiario_id')->distinct()
     ->count();
 ?>


  <tr>
    <td align="right" style="width: 35%"><?php echo $core->name ?> </td>
    <td  align="right" style="width: 40%">
      <div class="progress">
        <?php

       $perc= round($conta/$cbeneficiarios*100,0);

         ?>
  <div class="progress-bar progress-bar-<?= color($perc); ?>" role="progressbar" aria-valuenow="<?= $perc; ?>"
  aria-valuemin="0" aria-valuemax="100" style="width:<?= $perc; ?>% ">
   <?= $perc; ?>%
  </div>
</div>  </td>
    <td>
     <span class="label label-<?= color($perc); ?>">
      <?= $conta;   ?>
  </span>
    </td>
    

  
  </tr>

  <?php } ?>

</tbody>
</table>
</div>
		    </div>


</div>
</div>
	
	
	<script>
var ctx = document.getElementById("CoreService").getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: [
//'Total Beneficiários',
<?php foreach ($cores as $core) { echo "'".$core->name."',";} ?>


        ],
        datasets: [{
            label: 'Número de Beneficiarios',
            data: [


              <?php
			  echo $cbeneficiarios.',';
              foreach ($cores as $core) {
              echo   $conta=ServicosBeneficiados::find()
                   ->where(['=', 'servico_id', $core->id])
                   ->andWhere(['=', 'status', 1])
                   ->select('beneficiario_id')->distinct()
                   ->count().",";
              } ?>

            ],
            backgroundColor: '#cc0000',
        },
        {
            label: 'Taxa de Cobertura (%)',
            data: [
			
              <?php // echo $totalB.',';
foreach ($cores as $core) {
                 $conta=ServicosBeneficiados::find()
                   ->where(['=', 'servico_id', $core->id])
                   ->andWhere(['=', 'status', 1])
                   ->select('beneficiario_id')->distinct()
                   ->count();
                echo   $perc= round($conta/$cbeneficiarios*100,0).",";
              } ?>



            ],
            backgroundColor: '#009999',
        }



      ]
    },
    options: {
		
		  animation: {
      duration: 5,
      onComplete: function () {
          // render the value of the chart above the bar
          var ctx = this.chart.ctx;
          ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontSize, 'normal', Chart.defaults.global.defaultFontFamily);
          ctx.fillStyle = this.chart.config.options.defaultFontColor;
          ctx.textAlign = 'center';
          ctx.textBaseline = 'bottom';
          this.data.datasets.forEach(function (dataset) {
              for (var i = 0; i < dataset.data.length; i++) {
                  var model = dataset._meta[Object.keys(dataset._meta)[0]].data[i]._model;
                  ctx.fillText(dataset.data[i], model.x, model.y - 5);
              }
          });
      }},
		
		
		
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true,
                }
            }],
  xAxes: [{
        gridLines: {
          display: true
        },
        ticks: {
          beginAtZero: true,
          stepSize: 1,
            min: 0,
            autoSkip: false

        }
      }]
        }
    }
});
</script>
