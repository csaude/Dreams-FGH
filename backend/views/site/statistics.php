<?php

use  app\models\Beneficiarios;
use  app\models\ServicosDream;
use  app\models\ServicosBeneficiados;
$total=0;

if (isset(Yii::$app->user->identity->role)&&(Yii::$app->user->identity->role>0)) {
if(isset(Yii::$app->user->identity->provin_code)&&(Yii::$app->user->identity->provin_code>0)) {
$prov=(int)Yii::$app->user->identity->provin_code;

 $total = Beneficiarios::find()->where(['provin_code'=>$prov])->andWhere(['emp_status'=>1])->count();

} elseif(Yii::$app->user->identity->role==20) {

 $total = Beneficiarios::find()->where(['emp_status'=>1])->count();

}

} else {
 $total = Beneficiarios::find()->where(['provin_code'=>0])->andWhere(['emp_status'=>1])->count();
}

?>
<div class="col-lg-12">

    <div class="panel panel-info">
  <div class="panel-heading">

<button data-toggle="collapse" data-target="#statisticsDREAMS">
  <i class="ion ion-pie-graph ion-success"></i> PRINCIPAIS INDICADORES

  </div>

     <div class="panel-body">

      <div id="statisticsDREAMS" class="collapse">
<div class="col-lg-6">

  <div class="container">
    <h3>Core Services</h3>
    <canvas id="myChart" width="350px" height="200"></canvas>
  </div>

</div>
<div class="col-lg-6">
<table class="table condensed">
  <thead>
    <td>
      COD
    </td>
    <td>
      Nome do Servi&ccedil;o
    </td>
    <td>
      #Total
    </td>
	  <td>
      10-14
    </td>
	  <td>
      15-19
    </td>
	  <td>
      20-24
    </td>
  </thead>
  <tbody>

  <?php
  $tcliservicos= ServicosDream::find()->where(['core_service'=>1])->andWhere(['=', 'status', 1])->count();
  $cliservicos= ServicosDream::find()->where(['core_service'=>1])->andWhere(['=', 'status', 1])->all();
  $cliServices=0;
  foreach ($cliservicos as $core) {
echo  '<tr><td align=center>';
echo ($core->servico_id==1) ? 'A' : 'B';
echo ((int)$core->id<10) ? '0<b>'.(int)$core->id : '<b>'.(int)$core->id;
echo '</b></td><td>'.$core->name.'</td><td><b>';
    $cliServices = $cliServices+ServicosBeneficiados::find()
  //   ->where(['=','beneficiario_id',$model->member_id])
     ->andWhere(['=', 'servico_id', $core->id])
     ->andWhere(['=', 'status', 1])
     ->select('servico_id')->distinct()
     ->count();
  echo ((int)$cliServices<10) ? '0'.(int)$cliServices : (int)$cliServices;
     '</b></td>
	 <td align=center>%</td>
	 <td align=center>%</td>
     <td align=center>%</td>
   	 </tr>';
}
  ?>

<tr>
  <td colspan="4">
    <span class="label label-primary"> A00 - Servi&ccedil;o Clinico </span>
    <span class="label label-info">  B00 - Servi&ccedil;o  Communitario</span>
  </td>
</tr>
</tbody>
</table>

</div>

      </div>
    </div>


</div>
</div>
