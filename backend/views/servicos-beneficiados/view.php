<?php

use yii\helpers\Html;
use yii\widgets\DetailView;


use kartik\form\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ServicosBeneficiados */

if (isset(Yii::$app->user->identity->role)&&Yii::$app->user->identity->role==20) {
       $this->title = $model->beneficiario['emp_firstname'].' '.$model->beneficiario['emp_lastname'];
        } else {  

        $this->title = $model->beneficiario['district_code'].'/'.$model->beneficiario['member_id'];
        }
$this->params['breadcrumbs'][] = ['label' => 'Servicos Beneficiados', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="servicos-beneficiados-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'servicos.name',
            'beneficiario.member_id',
            'us.name',
          //  'activista_id',
            'data_beneficio',
            'description',
            'status',
            /*   'criado_por',
            'actualizado_por',
            'criado_em',
            'actualizado_em',
            'user_location',
            'user_location2',*/
        ],
    ]) ?>

</div>
  <p>
        <?= Html::a('<i class="fa fa-pensil"></i> Actualizar', ['servicos-beneficiados/update.dreams?m='.$model->beneficiario_id.'&id='.$model->id], ['class' => 'btn btn-primary']) ?>
  <?php Html::a('<i class="fa fa-pensil"></i> Actualizar', ['servicos-beneficiados/update.dreams?m='.$model->beneficiario_id.'&id='.$model->id], ['data-toggle'=>'modal', 'data-target'=>'#myModal', 'class' => 'btn btn-primary']) ?>


        <?= Html::a('Apagar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>

    </p>

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

<?= Html::img('@web/img/logo3.png', ['height'=>'75px','alt' => 'Layering DREAMS']) ?>
<?php ActiveForm::end(); ?>

         

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
      </div>
    </div>

  </div>
</div>