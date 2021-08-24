<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use \kartik\widgets\Select2;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use app\models\Provincias;
use app\models\Distritos;
use kartik\widgets\DatePicker;
use kartik\form\ActiveForm;
use kartik\daterange\DateRangePicker;
use kartik\depdrop\DepDrop;


$this->title = "INDICADORES DREAMS";
$this->params['breadcrumbs'][] = ['label' => 'Beneficiários', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>


<?php $form = ActiveForm::begin(); ?>
<div class="row">
    <div class="col-lg-3"></div>
    <div class="col-lg-6">
        <h2 align="center">
            <?= Html::img('@web/img/users/bandeira.jpg',['class' => 'img-default','width' => '75px','alt' => 'DREAMS']) ?>   <br>

            <br>PEPFAR MER 2.5 Indicador Semi-Annual AGYW_PREV
        </h2><br/>

        <div class="panel panel-success">
            <div class="panel-heading"> 
                <b><span class="glyphicon glyphicon-check" aria-hidden="true"></span> Pârametros do Indicador AGYW_PREV</b>
            </div>
            <div class="panel-body">

                <?php
                    $province_id =  Yii::$app->user->identity->provin_code;
                    $clause = isset($province_id)? ['id'=>$province_id] : ['status'=>1];
                ?>

                <?= 
                 $form->field($model, 'provinces')->widget(Select2::classname(), [
                                                            'name' => 'kv-state-250',
                                                            'data' =>(ArrayHelper::map(Provincias::find()->where($clause)->all(), 'id', 'province_name')),
                                                            'options' => ['multiple'=>'multiple' ,
                                                                            'placeholder' => 'Selecione a Provincia',
                                                                            'id' => 'provinces'],
                                                            'pluginOptions' => [
                                                                            'allowClear' => true
                                                                            ],
                                                        ]);
                          
                ?>


                <?= 
                    $form->field($model, 'districts')->widget(DepDrop::classname(), [
                                                    'options' => [
                                                    'multiple'=>true,
                                                    'placeholder' => 'Select ...'],
                                                    'type' => DepDrop::TYPE_SELECT2,
                                                    'select2Options' => ['pluginOptions' => ['allowClear' => true]],
                                                    'pluginOptions' => [
                                                                    'depends' => ['provinces'],
                                                                    'url' => Url::to(['listdistricts']),
                                                                    'loadingText' => 'Loading child level 1 ...',
                                                                ]
                                                    ]);     

                ?>
                
                
                <?=
                    $form->field($model, 'start_date', [
                        'addon'=>['prepend'=>['content'=>'<i class="glyphicon glyphicon-calendar"></i>']],
                        'options'=>['class'=>'input-group drp-container']
                        ])->widget(DateRangePicker::classname(), [
                        'useWithAddon'=>true,
                        'readonly' => true,
                        'pluginOptions'=>[
                            'language'=>'pt',
                            'singleDatePicker'=>true,
                            'hideInput'=>true,
                            'showDropdowns'=>true,
                            'minYear' => 1990,
                            'autoclose'=>true,
                            'locale' => ['format' => 'YYYY-MM-DD'],
                        ]
                        ])
                ?>

                <?=
                    $form->field($model, 'end_date', [
                        'addon'=>['prepend'=>['content'=>'<i class="glyphicon glyphicon-calendar"></i>']],
                        'options'=>['class'=>'input-group drp-container']
                        ])->widget(DateRangePicker::classname(), [
                        'useWithAddon'=>true,
                        'readonly' => true,
                        'pluginOptions'=>[
                            'language'=>'pt',
                            'singleDatePicker'=>true,
                            'hideInput'=>true,
                            'showDropdowns'=>true,
                            'minYear' => 1990,
                            'autoclose'=>true,
                            'locale' => ['format' => 'YYYY-MM-DD'],
                        ]
                        ])
                ?>
                <br />
                <div class="form-group">
                    <?= Html::submitButton('Preview' , ['class' => 'btn btn-success']) ?>
                   
                    <?= Html::a('<i class="glyphicon glyphicon-export"></i> Download', ['exportreport'], [
                                                        'data'=>[
                                                            'method' => 'post',
                                                            'params'=>[
                                                                    'province_code' => $model->province_code,
                                                                    'district_code' => $model->district_code,
                                                                    'start_date' => $model->start_date,
                                                                    'end_date' => $model->end_date,
                                                                    'indicatorID' => 1
                                                                ],
                                                            'confirm' => 'The EXCEL export file will be generated for download!'
                                                        ],
                                                        'class'=>'btn btn-default'        
                                                    ]) ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3"></div>
    
</div>

<?php ActiveForm::end(); ?>



<script type="text/javascript">
  window.onload = function () {
    $('#provinces').on('krajeeselect2:selectall krajeeselect2:unselectall',function (e) {
    $('#provinces').trigger('select2:select');
    });
  } 

</script>