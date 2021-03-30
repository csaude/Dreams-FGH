<?php 
use yii\helpers\Html;

use yii\helpers\Url;
use app\models\Beneficiarios;
use app\models\ServicosBeneficiados;

?>

   

<div class="img-circle-wrap">


    <?php 
$Personc=0;
if (isset(Yii::$app->user->identity->role)&&(Yii::$app->user->identity->role>0)) { 
if(isset(Yii::$app->user->identity->provin_code)&&(Yii::$app->user->identity->provin_code>0)) {
$prov=(int)Yii::$app->user->identity->provin_code;

$Personc = Beneficiarios::find()->where(['emp_status'=>1])->andWhere(['provin_code'=>$prov])->orderBy('id DESC')->count();
$Beneficiario = Beneficiarios::find()->orderBy('id DESC')->where(['emp_status'=>1])->andWhere(['provin_code'=>$prov])->limit(10)->all();

} elseif(Yii::$app->user->identity->role==20) {

 $Personc = Beneficiarios::find()->where(['emp_status'=>1])->orderBy('id DESC')->count();
$Beneficiario = Beneficiarios::find()->orderBy('id DESC')->where(['emp_status'=>1])->limit(10)->all();

}

} else {


$Personc = Beneficiarios::find()->where(['emp_status'=>1])->andWhere(['provin_code'=>$prov])->orderBy('id DESC')->count();
$Beneficiario = Beneficiarios::find()->orderBy('id DESC')->where(['emp_status'=>1])->andWhere(['provin_code'=>$prov])->limit(10)->all();

} 








$i=0;
if($Personc>0)  {

foreach($Beneficiario as $person) { 
 
$ts= ServicosBeneficiados::find()->where(['beneficiario_id'=>$person->id])->count();

?>
<div class="row">
<div class="col-md-12" style="margin-top: 10px; border-bottom: 1px; border-style: #ccc">
          <div class="pull-left"><img class='img-circle' height="50px" src="img/users/bandeira.jpg"> </div>
          <div class="pull-left"> 
			  <?php if (isset(Yii::$app->user->identity->role)&&Yii::$app->user->identity->role==20) { ?>
			  <i class="ion ion-ios7-person info"></i> <strong> <!--<span class="badge"> <?= ++$i;?> </span>-->&nbsp; <font size="-1"> <a href="<?php echo Url::toRoute('beneficiarios/'.$person->id); ?>"> <?= mb_strtoupper($person->emp_lastname.", ".$person->emp_firstname);?> </a></font> </strong><br>
             &nbsp; 
			  <?php }?>
			  <small><span> Nº<b> 
				  <a href="<?php echo Url::toRoute('beneficiarios/'.$person->id); ?>">
					  <?= $person->distrito['cod_distrito']; ?>/<?= $person->member_id; ?>
				  </a>
				  </b> </span> </small><?= $person->emp_gender==1 ? '<i class="fa fa-male"></i>': '<i class="fa fa-female"></i>';?><br>
             <small>
             <span class="label label-danger"><i class="fa fa-medkit"></i>&nbsp;<?= $ts; ?></span>&nbsp;
             <span class="label label-success"><i class="fa fa-stethoscope"></i>&nbsp;0</span>&nbsp;
             <span class="label label-warning"><i class="fa fa-group"></i>&nbsp;0</span>&nbsp;
             <span class="label label-default"><i class="glyphicon glyphicon-education"></i>&nbsp;0</span>&nbsp;
             <span class="label label-info"><i class="glyphicon glyphicon-hand-right"></i>&nbsp;0</span>&nbsp;

             </small>
          </div>
    </div>
</div>

<?php }
    } ?>
</div>


