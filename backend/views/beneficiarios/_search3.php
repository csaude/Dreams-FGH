<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use kartik\widgets\DepDrop;
use \kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use app\models\Provincias;
use app\models\Distritos;
use app\models\Beneficiarios;
?>

<div class="beneficiarios-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php // $form->field($model, 'id') ?>

    <?php // $form->field($model, 'emp_number') ?>

    <?php // $form->field($model, 'member_id') ?>

    <div class="row">
    <?php
    if(!isset(Yii::$app->user->identity->provin_code)&&(Yii::$app->user->identity->provin_code>0)&&
    !isset(Yii::$app->user->identity->district_code)&&(Yii::$app->user->identity->district_code>0))
    { ?>

      <input type="hidden" value="1" id="beneficiarios-nation_code" class="form-control" name="Beneficiarios[nation_code]">
      <input type="hidden" value="<?= Yii::$app->user->identity->provin_code; ?>" id="beneficiarios-provin_code" class="form-control" name="Beneficiarios[provin_code]">
      <input type="hidden" value="<?= Yii::$app->user->identity->district_code; ?>" id="beneficiarios-district_code" class="form-control" name="Beneficiarios[district_code]">
    <?php
    } else { ?>


        <div class="col-lg-4">
    <label class="control-label" for="beneficiarios-provin_code">Província</label>
    <?= Html::activeDropDownList($model, 'provin_code', ArrayHelper::map(Provincias::find()->where(['status'=>1])->all(), 'id', 'province_name'),
    ['class' => 'form-control','prompt'=>'--Província--',
     'onchange'=>'$.post("beneficiarios/lists.dreams?id='.'"+$(this).val(), function(data) {
        $("select#beneficiariossearch-district_code").html(data);
     });',
    ]); ?>

    </div>

        <div class="col-lg-4">

        <label class="control-label" for="beneficiarios-district_code">Distrito</label>
    <?= Html::activeDropDownList($model, 'district_code', ArrayHelper::map(Distritos::find()->all(), 'district_code', 'district_name'),
    ['class' => 'form-control','prompt'=>'--Distrito--',
    'onchange'=>'$.post("beneficiarios/todos.dreams?id='.'"+$(this).val(), function(data) {
       $("select#beneficiariossearch-emp_firstname").html(data);
    });',


  ]);  ?>

    </div>

    	<?php } ?>

      <div class="col-lg-4">
        <?php  echo  $form->field($model, 'emp_firstname')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(Beneficiarios::find()->asArray()->orderBy('emp_firstname ASC')->all(), 'emp_firstname', 'emp_firstname'),'options' => ['placeholder' => '--'],
        'pluginOptions' => [
                        'allowClear' => true
                    ],
    ]);
    ?>
      </div>


    </div>


<?php if (isset($_GET['BeneficiariosSearch']))
{  } else {} ?>



    <div class="form-group">
        <?= Html::submitButton('Pesquisar', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Cancelar', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
