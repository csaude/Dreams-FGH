<?php 

use  app\models\ServicosDream;
use  app\models\ServicosBeneficiados;



foreach ($beneficiarios as $ben) { ?>
 <tr style="text-align: center; vertical-align: middle;">
   <td><?= $ben->provincia['province_code']; ?></td>
   <td><?= $ben->distrito['cod_distrito']; ?></td>



   <td><?= $ben->us['id']; ?></td>
   <td>
     <?= $ben->emp_gender==1 ?
     '<span style="color:blue">M</span>':
     '<span style="color:green; font-weight: bold;">F</span>'; ?>
 </td>
   <td>
<?php
if(!$ben->emp_birthday==NULL) {
    $newDate = substr(date($ben->emp_birthday, strtotime($ben->emp_birthday)),-4);

   echo  date("Y")-$newDate;} else {
  echo  $ben->idade_anos;
}
 ?>
   </td>
<td><?= $ben->distrito['cod_distrito']; ?>/<?= $ben->member_id; ?></td>
   <?php
   //core Services
      $tc= ServicosDream::find()->where(['core_service'=>1])->andWhere(['=', 'status', 1])->orderBy(['servico_id'=>SORT_ASC])->count();
      $cs= ServicosDream::find()->where(['core_service'=>1])->andWhere(['=', 'status', 1])->orderBy(['servico_id'=>SORT_ASC])->all();
      $cliServices=0;
      foreach ($cs as $core) {?>

      <td> <?php $cliServices=ServicosBeneficiados::find()
      ->where(['=','beneficiario_id',$ben->member_id])
       ->andWhere(['=', 'servico_id', $core->id])
       ->andWhere(['=', 'status', 1])
       ->select('servico_id')->distinct()
       ->count();
  echo $cliServices>0?$cliServices:'-';
       ?> </td>
      <?php }?>

      <?php
      //core Services
         $tc= ServicosDream::find()->where(['core_service'=>0])->andWhere(['=', 'status', 1])->orderBy(['servico_id'=>SORT_ASC])->count();
         $cs= ServicosDream::find()->where(['core_service'=>0])->andWhere(['=', 'status', 1])->orderBy(['servico_id'=>SORT_ASC])->all();
         $cliServices=0;
         foreach ($cs as $core) {?>

         <td> <?php $cliServices=ServicosBeneficiados::find()
         ->where(['=','beneficiario_id',$ben->member_id])
          ->andWhere(['=', 'servico_id', $core->id])
          ->andWhere(['=', 'status', 1])
          ->select('servico_id')->distinct()
          ->count();
     echo $cliServices>0?$cliServices:'-';
          ?> </td>
         <?php }?>




       <td><?php
     $cs= ServicosDream::find()->where(['core_service'=>1])->andWhere(['=', 'status', 1])->orderBy(['servico_id'=>SORT_ASC])->all();
     $cr=0;
     foreach ($cs as $core) {
        $cr=$cr+ServicosBeneficiados::find()->select('servico_id')->where(['=','beneficiario_id',$ben->member_id])->andWhere(['=', 'servico_id', $core->id])->andWhere(['=', 'status', 1])->count('DISTINCT(beneficiario_id)'); }
     echo $cr;
        ?> </td>
         <td>
           <?php
     $cs= ServicosDream::find()->where(['core_service'=>0])->andWhere(['=', 'status', 1])->orderBy(['servico_id'=>SORT_ASC])->all();
     $cr=0;
     foreach ($cs as $core) {
       $cr=$cr+ServicosBeneficiados::find()->select('servico_id')->where(['=','beneficiario_id',$ben->member_id])->andWhere(['=', 'servico_id', $core->id])->andWhere(['=', 'status', 1])->count('DISTINCT(beneficiario_id)'); }
     echo $cr;
          ?>
         </td>


	 
	 
 </tr>
<?php } ?>
