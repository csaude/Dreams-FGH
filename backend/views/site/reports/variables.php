<?php
/* @var $this Frelimo\web\View */
use yii\helpers\Html;
use  app\models\Beneficiarios;
use common\models\User;


use  app\models\ServicosDream;
use  app\models\ServicosBeneficiados;
use  app\models\Distritos;
use  app\models\Provincias;

if (isset(Yii::$app->user->identity->role)&&(Yii::$app->user->identity->role>0)) {
  ?>
  <div class="row"> <br></div>
<div class="row">
  <div class="col-lg-6">
  <div class="panel panel-success">
    <div class="panel-heading"> <strong align="center"><i class="icon ion-ios-star"></i> SERVIÇOS PRIMÁRIOS</strong></div>
    <div class="panel-body"  style="max-height: 600px;  overflow-y: scroll;">
<ul  class="list-group">
      <?php
      //core Services
         $cs= ServicosDream::find()->where(['core_service'=>1])->andWhere(['=', 'status', 1])->orderBy(['servico_id'=>SORT_ASC])->all();
         $cliServices=0;
         foreach ($cs as $core) {?>

  <li class="list-group-item">
  <i class="icon ion-ios-gear"></i>
  <span class="badge success"><?= ($core->servico_id==1) ? 'A' : 'B'; ?><?= $core->id; ?></span>

      <?= $core->name; ?>
   </li>
         <?php }?>
</ul>
    </div>
  </div>
</div>

<div class="col-lg-6">
<div class="panel panel-default">
  <div class="panel-heading"> <strong align="center"><i class="icon ion-ios-star-half"></i> SERVIÇOS SECUNDARIOS</strong></div>
  <div class="panel-body"  style="max-height: 600px;  overflow-y: scroll;">
    <ul  class="list-group">
          <?php
          //core Services
             $cs= ServicosDream::find()->where(['core_service'=>0])->andWhere(['=', 'status', 1])->orderBy(['servico_id'=>SORT_ASC])->all();
             $cliServices=0;
             foreach ($cs as $core) {?>

      <li class="list-group-item">
      <i class="icon ion-ios-gear"></i>
      <span class="badge success"><?= ($core->servico_id==1) ? 'A' : 'B'; ?><?= $core->id; ?></span>
          <?= $core->name; ?>
       </li>
             <?php }?>
    </ul>

  </div>
</div>
</div>
</div>

<div class="row">
  <div class="col-lg-6">
  <div class="panel panel-success">
    <div class="panel-heading"> <strong align="center"><i class="icon ion-ios-star"></i> PROVÍNCIAS E DISTRITOS</strong></div>
    <div class="panel-body"  style="max-height: 600px;  overflow-y: scroll;">
<table class="table table-condensed">
  <thead>
    <th>
    </th>
    <th>
    </th>
  </thead>
  <tbody>
      <?php
      //core Services
         $ps= Provincias::find()->where(['=', 'status', 1])->orderBy(['province_code'=>SORT_ASC])->all();

         foreach ($ps as $prov) {?>

  <tr>
    <td>
  <i class="icon ion-ios-gear"></i>
  <span class="badge"><?= $prov->province_code; ?></span>
    <?= $prov->province_name; ?>
  </td>


  <?php $ds= Distritos::find()->where(['=','province_code',$prov->id])->orderBy(['district_name'=>SORT_ASC])->all(); ?>

    <td>
<?php foreach ($ds as $dist) {?>
<div class="row"> <i class="icon ion-ios-gear"></i>
 <span class="badge"><?= $dist->cod_distrito; ?></span> <?= $dist->district_name; ?>
 </div>
 <?php } ?>
 </td>
</tr>
         <?php }?>
</tbody>
</table>
    </div>
  </div>
</div>
</div>










<?php } ?>
