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
$beneficiarios= Beneficiarios::find()->where(['>', 'district_code', 0])->andWhere(['provin_code'=>$prov])->andWhere(['emp_status'=>1])->all();
} elseif(Yii::$app->user->identity->role==20) {

$beneficiarios= Beneficiarios::find()->where(['>', 'district_code', 0])->andWhere(['emp_status'=>1])->all();

}

} else {
$beneficiarios= Beneficiarios::find()->where(['>', 'district_code', 0])->andWhere(['provin_code'=>5])->andWhere(['emp_status'=>1])->all();
}



$cliServices=0;

//Total Core e Non-Core Services
  $tcservicos = ServicosDream::find()->where(['core_service'=>1])->andWhere(['=', 'status', 1])->orderBy(['servico_id'=>SORT_ASC])->count();
  $tservicos = ServicosDream::find()->where(['core_service'=>0])->andWhere(['=', 'status', 1])->orderBy(['servico_id'=>SORT_ASC])->count();

//Busca todos Core e Non-Core Services



// Total Beneficiarios
   $sofala = Beneficiarios::find()->where(['provin_code'=>5])->andWhere(['emp_status'=>1])->count();

   $cores= ServicosDream::find()->select('id')->asArray()->all();



?>



<table class="table table-hover"  data-spy="scroll">
<thead>
  <tr style="text-align: center; vertical-align: middle;">
  <th colspan="6"></th>

  <th align="center" colspan="<?= $tcservicos; ?>" style="text-align: center;"> 
    <span class="text-success">PRIMARY SERVICE </span>
  </th>
  <th align="center" colspan="<?= $tservicos; ?>" style="text-align: center;"> 
    <span class="text-primary"> SECONDARY SERVICE </span></th>

<th colspan="2">&nbsp;</th>

</thead>
  <tbody>
 <tr style="text-align: center; vertical-align: middle;">
   <td>Prov</td>
   <td>Dist</td>



    <td>PE</td>
   <td>Sexo</td>
   <td>Idade (anos)</td>
    <td>Codigo do Beneficiario</td>
<?php
//core Services
   $tc= ServicosDream::find()->where(['core_service'=>1])->andWhere(['=', 'status', 1])->orderBy(['servico_id'=>SORT_ASC])->count();
   $cs= ServicosDream::find()->where(['core_service'=>1])->andWhere(['=', 'status', 1])->orderBy(['servico_id'=>SORT_ASC])->all();
   $cliServices=0;
   foreach ($cs as $core) {?>

   <td><b><span class="text-success"><?= ($core->servico_id==1) ? 'A' : 'B'; ?><?= $core->id; ?></span></b> </td>
   <?php }?>

   <?php
   //core Services
      $tc= ServicosDream::find()->where(['core_service'=>0])->andWhere(['=', 'status', 1])->orderBy(['servico_id'=>SORT_ASC])->count();
      $cs= ServicosDream::find()->where(['core_service'=>0])->andWhere(['=', 'status', 1])->orderBy(['servico_id'=>SORT_ASC])->all();
      $cliServices=0;
      foreach ($cs as $core) {?>

      <td><b><span class="text-primary">  <?= ($core->servico_id==1) ? 'A' : 'B'; ?><?= $core->id; ?></span> </b></td>
      <?php }?>


   <td> CS</td>
   <td>NCS</td>
 </tr>
	  
	<tr style="text-align: center; vertical-align: middle;">
   <td colspan="6" align="right">TOTAL</td>
 <?php
 //core Services
   $tc= ServicosDream::find()->where(['core_service'=>1])->andWhere(['=', 'status', 1])->orderBy(['servico_id'=>SORT_ASC])->count();
   $cs= ServicosDream::find()->where(['core_service'=>1])->andWhere(['=', 'status', 1])->orderBy(['servico_id'=>SORT_ASC])->all();
   $cliServices=0;
   foreach ($cs as $core) {?>

   <td><b><span class="text-success">

     <?=
     ServicosBeneficiados::find()
      ->andWhere(['=', 'servico_id', $core->id])
      ->andWhere(['=', 'status', 1])
      ->select('beneficiario_id')->distinct()
      ->count();
      ?>
   </span></b> </td>
   <?php }?>

   <?php
   //core Services
      $tc= ServicosDream::find()->where(['core_service'=>0])->andWhere(['=', 'status', 1])->orderBy(['servico_id'=>SORT_ASC])->count();
      $cs= ServicosDream::find()->where(['core_service'=>0])->andWhere(['=', 'status', 1])->orderBy(['servico_id'=>SORT_ASC])->all();
      $cliServices=0;

      foreach ($cs as $core) {?>

      <td><b><span class="text-primary">

        <?=
        ServicosBeneficiados::find()
         ->andWhere(['=', 'servico_id', $core->id])
         ->andWhere(['=', 'status', 1])
         ->select('beneficiario_id')->distinct()
         ->count();
         ?>
</span> </b></td>
      <?php }?>


      <td><?php
$cs= ServicosDream::find()->where(['core_service'=>1])->andWhere(['=', 'status', 1])->orderBy(['servico_id'=>SORT_ASC])->all();
$cr=0;
foreach ($cs as $core) {
     $cr=$cr+ServicosBeneficiados::find()->select('servico_id')->where(['=', 'servico_id', $core->id])->andWhere(['=', 'status', 1])->count('DISTINCT(beneficiario_id)'); }
echo $cr;
     ?> </td>
      <td>
        <?php
  $cs= ServicosDream::find()->where(['core_service'=>0])->andWhere(['=', 'status', 1])->orderBy(['servico_id'=>SORT_ASC])->all();
  $cr=0;
  foreach ($cs as $core) {
       $cr=$cr+ServicosBeneficiados::find()->select('servico_id')->where(['=', 'servico_id', $core->id])->andWhere(['=', 'status', 1])->count('DISTINCT(beneficiario_id)'); }
  echo $cr;
       ?>
      </td>
</tr>  
	  
	  
<?php //include("tabela.php"); ?>
</tbody>
</table>

