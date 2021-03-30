<?php

use yii\helpers\Html;


use app\models\ServicosBeneficiados;
use app\models\ServicosDream;


use kartik\form\ActiveForm;
use dektrium\user\models\Profile;
//use kartik\widgets\DepDrop;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use common\models\User;
//use \kartik\widgets\Select2;
/* @var $this yii\web\View */
/* @var $model app\models\ReferenciasServicosReferidos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="referencias-servicos-referidos-form">


  <div class="row">
  <div class="col-lg-12">
<?php if($model->isNewRecord&&isset($_REQUEST['ts'])&&isset($_REQUEST['r'])&&isset($_REQUEST['m'])&&isset($_REQUEST['nr'])){ ?>
    <div class="panel panel-primary">
    <div class="panel-heading">



    <b>
<?php

 $ser=(int)$_REQUEST['ts'];
?>
<?php if($ser==2) { ?> <i class="fa fa-briefcase" aria-hidden="true"> <?php } else { ?>
      <i class="ion ion-medkit"  aria-hidden="true"> <?php } ?>
&nbsp; Solicitar Serviço para Referencia <?= $_REQUEST['nr'];?> :: <?= $_REQUEST['m']; ?>
    </i>
     </b>
  </div>
    <div class="panel-body">


    <?php $form = ActiveForm::begin(); ?>

    <?php
if(isset($_REQUEST['r'])&&$model->isNewRecord) {
    echo  $form->field($model, 'referencia_id')->hiddenInput(['value'=> (int)$_REQUEST['r']])->label(false);
    }

    ?>

    <?= $form->field($model, 'servico_id')
->dropDownList(ArrayHelper::map(ServicosDream::find()
->where(['servico_id'=>$ser])
->andWhere(['status' => 1])
->all(), 'id', 'name'),['prompt' => '--']); ?>

    <?php $form->field($model, 'name')->textInput(['maxlength' => true]) ?>


<?= $form->field($model, 'description')->textarea(array('rows'=>2,'cols'=>5)); ?>


<?= $form->field($model, 'status')->radio( [1 => 'Yes'])->label(false)?>

    <?php // $form->field($model, 'status')->radioList(array('1'=>'Activo','0'=>'Cancelar')); ?>

<div class="col-lg-12">
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Salvar') : Yii::t('app', 'Actualizar'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>&nbsp;
<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
</div>
    </div>
</div>
</div>
    <?php ActiveForm::end(); ?>
  </div>
  <?php } elseif (!$model->isNewRecord) { ?>
    <div class="panel panel-primary">
    <div class="panel-heading">
Actualizar <?= $model->referencia['nota_referencia']; ?>
    </div>
      <div class="panel-body">
<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'servico_id')
->dropDownList(ArrayHelper::map(ServicosDream::find()
->where(['servico_id'=>$model->referencia['servico_id']])
->andWhere(['status' => 1])
->all(), 'id', 'name'),['prompt' => '--']); ?>
        <?= $form->field($model, 'description')->textarea(array('rows'=>2,'cols'=>5)); ?>

        <?php $form->field($model, 'status')->radio( [1 => 'Yes'])->label(false)?>

            <?= $form->field($model, 'status')->radioList(array('1'=>'Activo','0'=>'Cancelar')); ?>

        <div class="col-lg-12">
            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Salvar') : Yii::t('app', 'Actualizar'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>&nbsp;
        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
        </div>
            </div>
<?php ActiveForm::end(); ?>
      </div>
    </div>

<?php  }?>
</div>
</div>
