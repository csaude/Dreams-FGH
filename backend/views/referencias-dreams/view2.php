<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ReferenciasDreams */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Referencias Dreams'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="referencias-dreams-view">

<?php  if(Yii::$app->user->identity->id==$model->criado_por||Yii::$app->user->identity->role>10) { ?>
<div class="row">
  <div class="col-lg-12">
    <div class="panel panel-info">
    <div class="panel-heading">
<b><i class="fa fa-check-circle" aria-hidden="true"></i> <?= $model->nota_referencia; ?>
 | <?php
if(isset($model->beneficiario->distrito['cod_distrito'])&&$model->beneficiario->distrito['cod_distrito']>0)
{echo  $model->beneficiario->distrito['cod_distrito'].'/'.$model->beneficiario['member_id']; } else {echo '/'.$model->beneficiario['member_id']; }
?>
<?=
Yii::$app->user->identity->role==20 ?  " | ".$model->beneficiario['emp_firstname'].' '.$model->beneficiario['emp_middle_name'].' '.$model->beneficiario['emp_lastname']: " "


  ?>
 </b>
  </div>
    <div class="panel-body">

      <table class="table table-condensed">
        <thead>
          <th>Data Registo</th>
          <th>Referente</th>
          <th>Contacto</th>
          <th>N<sup>o</sup> do Livro</th>
          <th>Organiza&ccedil;&atilde;o</th>
          <th>Cod Refer&ecirc;ncias</th>
          <th>Tipo Serviço</th>
          <th>Status</th>
        </thead>

        <tbody>

          <tr>
            <td><?= $model->criado_em; ?> </td>
            <td><?= $model->nreferente['name']; ?> </td>
            <td><?= $model->referente['phone_number']; ?></td>
            <td><?= $model->num_livro; ?></td>
            <td><?= $model->projecto; ?></td>
            <td><?= $model->ref_livro; ?></td>
            <td><?= $model->tservico['name']; ?></td>
            <td><?= $model->status==0 ?  '<font color="green"><b>Referido</b></font>': '<font color="red">Pendente</font>'; ?></td>
          </tr>
        </tbody>
      </table>

 <?php  //$model->beneficiario->distrito['cod_distrito'].'/'.$model->beneficiario['member_id']; ?>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-lg-6">
    <div class="panel panel-primary">
    <div class="panel-heading">
<b><i class="fa fa-envelope" aria-hidden="true"></i> Interven&ccedil;ões Solicitadas</b>
  </div>
    <div class="panel-body">

      <table class="table table-condensed">
        <thead>
          <th>#</th>
          <th>Interven&ccedil;&atilde;o</th>
          <th>Status</th>
          <th>Atender</th>
        </thead>

        <tbody>
          <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
        </tbody>
      </table>
      <?php //$model->beneficiario->distrito['cod_distrito'].'/'.$model->beneficiario['member_id'];
      ?>
      </div>
    </div>
  </div>
</div>

    <p>
        <?= Html::a(Yii::t('app', 'Actualizar'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php Html::a(Yii::t('app', 'Apagar'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>


<?php  } else { ?>
  <div class="row">
      <div class="alert alert-warning">
  <strong>Aten&ccedil;&atilde;o!</strong>
  A sua conta de Utilizador n&atilde;o tem acesso a esta refer&ecirc;ncia.
  <?= Html::a('<i class="glyphicon glyphicon-backward"></i> Voltar', ['referencias-dreams/index'], ['class' => 'btn btn-success']) ?>
  </div>

  </div>

<?php } ?>


    
</div>
