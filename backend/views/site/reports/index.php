<?php
/* @var $this Frelimo\web\View */
use yii\helpers\Html;
use  app\models\Beneficiarios;
use common\models\User;

use  app\models\ServicosDream;
use  app\models\ServicosBeneficiados;

$this->title = 'DREAMS - SISTEMA INTEGRADO DE CADASTRO DE BENEFICIARIOS DREAMS';

?>
<div class="site-index">



      <?php  //include ("statistics.php"); ?>
<div class="col-lg-12">
<div class="panel panel-success">
  <div class="panel-heading"> <strong align="center"><i class="ion ion-pie-graph info"></i> LAYERING DREAMS</strong></div>
  <div class="panel-body"  style="max-height: 600px;  overflow-y: scroll;">

  <ul class="nav nav-tabs">

      <li class="active"><a data-toggle="tab" href="#home">
        <i class="fa fa-dashboard"></i> VISÃO GLOBAL</a>
      </li>
        <li><a data-toggle="tab" href="#scenario_1">
          <i class="icon ion-stats-bars"></i> SERVIÇOS OFERECIDOS</a>
        </li>
        <li><a data-toggle="tab" href="#scenario_2"><i class = "icon ion-stats-bars"></i> OUTROS INDICADORES </a></li>
        <li><a data-toggle="tab" href="#scenario_3"><i class="fa fa-cog"></i> VARIÁVEIS</a></li>
      </ul>

    <div class="tab-content">
      <div id="home" class="tab-pane fade in active">
		  <?php include ("core_service.php"); ?> 
		   <?php //include_once 'regional.php'; ?>
     
      </div>

        <div id="scenario_1" class="tab-pane fade in">
<?php  include ("scenario_1.php"); ?>
      </div>

      <div id="scenario_2" class="tab-pane fade in">
<?php  //include ("scenario_1.php"); ?>
    </div>

    <div id="scenario_3" class="tab-pane fade in">
<?php  include ("variables.php"); ?>
  </div>

    </div>





<?php





 $sofala = Beneficiarios::find()->where(['provin_code'=>5])->andWhere(['emp_status'=>1])->count()-1;
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





</div>
