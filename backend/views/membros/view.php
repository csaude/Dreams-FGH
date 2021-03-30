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
use app\models\Quotas;
/* @var $this yii\web\View */
/* @var $model app\models\Membros */

$this->title = $model->emp_firstname." ".$model->emp_middle_name." ".$model->emp_lastname;
$this->params['breadcrumbs'][] = ['label' => 'Beneficiários', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="membros-view">

<div class="col-lg-12">

<div class="panel panel-success">
  <div class="panel-heading"><i class="fa fa-dashboard  text-primary"></i> <strong> Dados de Registo do Beneficiário:  <?= Html::encode($this->title) ?> </strong></div>
  <div class="panel-body">

<div class="col-lg-3"> 
     <div class="panel panel-warning">

  <div class="panel-body">

    <div class="col-xs-12">
    <hr>
 <p align="center">  
   <a  
  href="<?php echo Url::toRoute('documentos-fotos/create.frelimo?&profile='.$model->id.'&outros'); ?>"  >
 <?= Html::img('@web/img/users/bandeira.jpg', ['class' => 'img-thumbnail','width' => '100px','alt' => $model->emp_lastname]) ?> 
 </a>
 <br>
<?= $model->member_id; ?> <br>
<b><?= Html::encode($this->title) ?> </b><br>
<small><font color="green"><?= $model->cargo['name']; ?> </font></small><br>
Beneficiário desde:<br>
<b><span class="label label-success"><?= $model->membro_data_admissao; ?></span></b>

</p>
<hr>
    </div>
</div>
</div>
</div>



    <div class="col-lg-5">
       <div class="panel panel-primary">
  <div class="panel-heading"> Dados Gerais</div>
  <div class="panel-body">   
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
           // 'id',
          //  'emp_number',
          //  'member_id',
         /*   'emp_lastname',
            'emp_firstname',
            'emp_middle_name',
            'emp_nick_name',*/
             //'cProvincial.name',
            // 'cDistrital.name',           
          //   'cCidade.name',
           // 'membro_cargo_partido_id',
            'provincia.province_name',
           // 'cZona.name',
           // 'cCirculo.name',
           // 'cCelula.name',
           // 'membro_data_admissao',
          
            

                              [
             'attribute' => 'emp_military_service',
             'format'=>'raw',
             'value' => $model->emp_status == 1 ? 'Regularizado' : 'Não Regularizado',
        ],

                'emp_birthday',
            'nation_code',
            
                         [
             'attribute' => 'emp_gender',
             'format'=>'raw',
             'value' => $model->emp_status == 1 ? 'M' : 'F',
        ],

                                 [
             'attribute' => 'emp_marital_status',
             'format'=>'raw',
             'value' => $model->emp_status == 1 ? 'Casado' : 'Solteiro',
        ],
                  
          
        ],
    ]) ?>
</div>
</div>



    </div>

<div class="col-lg-4">

  <!--  <div class="panel panel-success">
  <div class="panel-heading"> Cargos no Partido</div>
  <div class="panel-body"> 
<p align="right">
<?= Html::a('<i class="fa fa-plus"></i>', ['comite-cargos/create','subordinado_id'=>$model->id], ['data-toggle'=>'modal', 'data-target'=>'#myModal','class' => 'label label-success']) ?>
<p align="right">
  </div>
  </div>
-->
      <div class="panel panel-info">
  <div class="panel-heading"> Associações</div>
  <div class="panel-body"> 
<i class="glyphicon glyphicon-user  text-info"></i> Activista BIZ

<p align="right">
<?= Html::a('<i class="fa fa-plus"></i>', ['associacoes/create','id'=>$model->id], ['data-toggle'=>'modal', 'data-target'=>'#myModal', 'class' => 'label label-success']) ?>
</p>
  </div>
  </div>

       <div class="panel panel-danger">
  <div class="panel-heading"><i class="glyphicon glyphicon-earphone"></i> Contactos</div>
  <div class="panel-body">
  <i class="glyphicon glyphicon-globe  text-danger"></i> <?= $model->coun_code; ?> <br>
<i class="glyphicon glyphicon-home  text-danger"></i> <?= $model->localidade['name']; ?>, <?= $model->emp_street1; ?> <br>
<i class="glyphicon glyphicon-phone-alt  text-danger"></i> <?= $model->emp_hm_telephone; ?> <br>
<i class="glyphicon glyphicon-phone  text-danger"></i> <?= $model->emp_mobile; ?> <br>
<i class="glyphicon glyphicon-envelope  text-danger"></i> <?= $model->emp_work_email; ?> <br>
         



  </div>
  </div>

  </div>

<div class="col-lg-12"> 

    <div class="panel panel-info">
  <div class="panel-heading"> <i class="ion ion-medkit"> </i> Lista de Interven&ccedil;&otilde;es</div>
  <div class="panel-body"> 

 <table class="table table-bordered">
  <tr> <th>Referência </th> <th>Total Pago</th> <th> #  </th> </tr>

<?php $queryC = Quotas::find()->where(['=','member_id',$model->id])->count(); 

if($queryC>0) {
$query = Quotas::find()->where(['=','member_id',$model->id])->orderBy('data_pagamento ASC')->all();
foreach($query as $query) { ?>


<tr> 

<td class='data_pagamento'><?= $query->data_pagamento ?> </td> 
<td  class='quota_id'> <?= $query->quantia; ?> </td> 

<td class='status'> 
 <a  <?php if( $query->status == 1) { ?> class="label label-success" <?php }else {?> 
   class="label label-danger"  <?php } ?> 

  href="<?php echo Url::toRoute('quotas/'.$query->id); ?>"  > <i class="glyphicon glyphicon-eye-open icon-success"></i>
           </a>

</td>
</tr>


<?php }

} else {

echo "<tr>
<td colspan='3'> <i class='glyphicon glyphicon-envelope'> <font style='color:red'><i> Membro sem quotas no sistema</i></font></td>
</tr>";

}
?>

</table>
<p align="right">
<?= Html::a('<i class="fa fa-plus"></i>', ['quotas/create.frelimo?m='.$model->id.'&t=Quota'], ['data-toggle'=>'modal', 'data-target'=>'#myModal', 'class' => 'label label-primary']) ?>

</p>

<span class="label label-success"> confirmada</span> <span class="label label-danger"> Aguarda confirmação</span>

  
  </div>
  
  </div>

</div> 



<div class="col-lg-12"> 
     <div class="panel panel-success">
  <div class="panel-heading"><i class="fa fa-info"></i> Outras informações</div>
  <div class="panel-body"> 

  <div class="col-lg-6"> 
    <div class="panel panel-info">
  <div class="panel-heading">Documentação</div>
      <?= DetailView::widget([
        'model' => $model,
        'attributes' => [        
          //  'joined_date',
            'bi',
            'bi_data_i',
            'bi_data_f',           
            'custom7',
            'membro_caratao_eleitor',
            'nuit',  
            'nuit_data_i',
            'nuit_data_f', 'custom8',
            'passaporte',
            'custom9', 'dire',

            'other_prof_info',
          
            //'custom3',
            
            
                     
        ],
    ]) ?>
</div>


</div>

<div class="col-lg-6"> 
    <div class="panel panel-info">
  <div class="panel-heading">Dados Profissionais</div>

  <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
             
                 [
             'attribute' => 'emp_status',
             'format'=>'raw',
             'value' => $model->emp_status == 1 ? 'Empregado' : 'Desempregado',
        ],
            'grau.name',
            'categoria.name',
            'titulo.job_title',
            'work_station',

             ],
    ]) ?> 
</div>

  </div>
  </div>
  </div>
</div>

</div>

    <div class="panel-footer clearfix">
        <div class="pull-right">
         <div class="form-group">

      
       <?= Html::a('<i class="glyphicon glyphicon-backward"></i>', ['index'], ['class' => 'btn btn-warning']) ?>  
        <?= Html::a('Actualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Apagar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'disabled'=>true,
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </div> 
        </div>
    </div>



</div>
</div>

</div>




<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Adicionar <?php if (isset($_REQUEST['t'])) {echo $_REQUEST['t'];} ?></h4>
      </div>
      <div class="modal-body">
  <?php $form = ActiveForm::begin(); ?>      

<?= Html::img('@web/img/logo3.png', ['height'=>'75px','alt' => 'Frente de Libertação Nacional de Moçambique']) ?>
<?php ActiveForm::end(); ?>

         





      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
      </div>
    </div>

  </div>
</div>