<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use yii\helpers\Url;
use app\models\Quotas;
use yii\bootstrap\Modal;
use kartik\widgets\DatePicker;
use kartik\form\ActiveForm;
use common\models\User;
/* @var $this yii\web\View */
/* @var $model app\models\Quotas */

$this->title = $model->membro['emp_firstname'].' '.$model->membro['emp_middle_name'].' '. $model->membro['emp_lastname'];
$this->params['breadcrumbs'][] = ['label' => 'Quotas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="quotas-view">


<div class="col-lg-5">

<div class="panel panel-success">
  <div class="panel-heading">
  <strong> Quota do Camarada:  <?= Html::encode($this->title) ?> </strong>
  </div>
  <div class="panel-body">


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
         //   'id',
            'tipoQ.name',
            'data_pagamento',
            'quantia',
            'formaP.name',
            'localP.name',
        [
             'attribute' => 'receptor',
             'format'=>'raw',
             'value' => $model->membro['emp_firstname'].' '.$model->membro['emp_middle_name'].' '.$model->membro['emp_lastname'],
        ],
            'description',
            
            [
             'attribute' => 'status',
             'format'=>'raw',
             'value' => $model->status == 1 ? '<span class="glyphicon glyphicon-ok icon-success"></span>' : '<span class="glyphicon glyphicon-remove icon-success"></span>',
        ],
          /*  'criado_por',
            'actualizado_por',
            'criado_em',
            'actualizado_em',
            'user_location',
            'user_location2',*/
        ],
    ]) ?>
    <div class="panel-footer clearfix">
        <div class="pull-right">
         <div class="form-group">

      
       <?= Html::a('<i class="glyphicon glyphicon-backward"></i>', ['index'], ['class' => 'btn btn-warning']) ?>  
        <?= Html::a('Actualizar', ['update', 'id' => $model->id], ['data-toggle'=>'modal', 'data-target'=>'#myModal','class' => 'btn btn-primary']) ?>
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


<div class="col-lg-7">

<div class="panel panel-success">
  <div class="panel-heading">
  <strong> Outros Pagamentos Recebidos </strong>
  </div>
  <div class="panel-body">

  
  <table class="table table-bordered">
  <tr> <th>Quota </th> <th>Valor </th><th>Data Operação</th> <th> Status  </th> <th> </th></tr>
<?php $queryC = Quotas::find()->where(['<>','id',$model->id])->andWhere(['=','member_id',$model->member_id])->count(); 

if($queryC>0) {
$query = Quotas::find()->where(['<>','id',$model->id])->andWhere(['=','member_id',$model->member_id])->orderBy('data_pagamento ASC')->all();
foreach($query as $query) { ?>


<tr> 
<td  class='quota_id'> <?= $query->tipoQ['name']; ?> </td> 
<td  class='quota_id'> <?= $query->quantia; ?> </td> 
<td class='data_pagamento'><?= $query->data_pagamento ?> </td> 
<td class='status'> <?= $model->status == 1 ? '<span class="glyphicon glyphicon-ok icon-success"></span>' : '<span class="glyphicon glyphicon-remove icon-success"></span>' ?> </td>
<td class='status'> 
 <a  <?php if( $model->status == 1) { ?> class="label label-success" <?php }else {?> 
   class="label label-danger"  <?php } ?> 

  href="<?php echo Url::toRoute('quotas/'.$model->id); ?>"  > <i class="glyphicon glyphicon-eye-open icon-success"></i>
           </a>

</td>
</tr>


<?php }

} else {

echo "<tr>
<td colspan='4'> <i class='glyphicon glyphicon-envelope'> <font style='color:red'><i> Membro sem mais quotas no sistema</i></font></td>
</tr>";

}
?>

</table>
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