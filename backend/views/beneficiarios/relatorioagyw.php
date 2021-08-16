<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use app\models\Provincias;
use app\models\Distritos;
use kartik\widgets\DatePicker;
use kartik\form\ActiveForm;
use kartik\daterange\DateRangePicker;


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

            <br>Indicador AGYW 
        </h2>

        <div class="panel panel-success">
            <div class="panel-heading"> 
                <b><span class="glyphicon glyphicon-check" aria-hidden="true"></span> Parametros do Indicador AGYW_prev</b>
            </div>
            <div class="panel-body">

                <?= $form->field($model, 'province_code')->dropDownList(ArrayHelper::map(Provincias::find()->where(['status'=>1])->all(), 'id', 'province_name'),
                    ['class' => 'form-control',
                    'prompt'=>'--Província--',
                    'onchange'=>'$.post("lists.dreams?id='.'"+$(this).val(), function(data) {
                        $("select#form-district_code").html(data);
                    });',
                ]); ?>


                <?= $form->field($model, 'district_code')->dropDownList(ArrayHelper::map(Distritos::find()->all(), 'district_code', 'district_name'),
                    ['id'=>'form-district_code','class' => 'form-control','prompt'=>'--Distrito--',
                ]);  ?> 

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