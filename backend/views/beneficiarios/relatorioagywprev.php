<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use app\models\Provincias;
use app\models\Distritos;

$this->title = "INDICADORES DREAMS";
$this->params['breadcrumbs'][] = ['label' => 'AGYW', 'url' => ['relatorioAGYWprevView']];
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="membros-view">

	<div class="col-lg-12">

	    <div class="panel panel-primary">
            <div class="panel-heading">
                <i class="fa fa-dashboard  text-primary"></i> <strong> Indicador AGYW_Prev Desagregado por Tempo de Registo e Idade  </strong>
            </div>
            <div class="panel-body">
                <div class="row"> </div>

                <table width="100%" class="table table-dashed">
                    <col width="174">
                    <col width="117">
                    <col width="119">
                    <col width="154">
                    <col width="142">

                    <tr>
                        <td colspan="5" bgcolor="#FFFFFF"><b>Data Inicial: <?php echo $model->start_date ?></b></td>
                    </tr>
                    <tr>
                            
                        <td colspan="5" bgcolor="#FFFFFF"><b>Data final: <?php echo $model->end_date ?></b></td>
                    </tr> 
                </table>

                <button class="btn btn-primary btn-block  mb1 black bg-darken-1" data-toggle="collapse" data-target="#first"><b> Provincia: <?php echo $province ?> </b></button>

                <div id="first" class="collapse">
                    <table width="100%" class="table table-dashed">

                        <tr>
                            <td colspan="5" bgcolor="#FFFFFF"><b> <?php echo $province ?> </b></td>
                        </tr>	
                    </table>
                    <button class="btn btn-primary btn-block  mb1 black bg-orange" data-toggle="collapse" data-target="#second"><b> <?php echo $district ?> </b></button>
                    <div id="second" class="collapse">
                        <table width="100%" class="table table-dashed">

                            <tr>
                                <td colspan="5" bgcolor="#FFFFFF"><b> Distrito: <?php echo $district ?> </b></td>
                            </tr>	
                            <tr>
                                <td width="706" colspan="5" bgcolor="#CD5C5C"><b>Número de Beneficiários DREAMS que receberam TODO pacote primário de serviços e mais nenhum outro serviço</b> </td>
                            </tr>
                            <tr>
                                <td width="174" bgcolor="#FFE4E1">Tempo de registo como beneficiário DREAMS </td>
                                <td bgcolor="#FFE4E1">10-14</td>
                                <td bgcolor="#FFE4E1">15-19</td>
                                <td bgcolor="#FFE4E1">20-24</td>
                                <td bgcolor="#FFE4E1">25-29</td>
                            </tr>
                            <?php foreach(['0_6','7_12', '13_24', '25+'] as $index2){ ?>
                                    <tr>
                                        <td bgcolor="#CD9B9B"><?php echo $index2 ?> meses </td>
                                        <?php foreach(['9-14','15-19', '20-24', '25-29'] as $index1){ ?>
                                            <td bgcolor="#CD9B9B"> 
                                                
                                                
                                                <?= Html::a($firstDesagregation[$index1][$index2], ['relatorioagywprev'], [
                                                        'data'=>[
                                                            'method' => 'post',
                                                            'params'=>['ageBand' => $index1, 
                                                                        'enrollmentTime' => $index2,
                                                                        'province_code' => $model->province_code,
                                                                        'district_code' => $model->district_code,
                                                                        'start_date' => $model->start_date,
                                                                        'end_date' => $model->end_date,
                                                                        'indicatorID' => 1
                                                                    ],
                                                        ]
                                                    ]) ?>
                                               
                                            </td>
                                        <?php  } ?>
                                    </tr>
                            <?php  } ?>
                            <tr>
                                <td colspan="5" height="40" bgcolor="#FFFFFF"><b> </b></td>
                            </tr>

                            <tr>
                                <td width="706" colspan="5" bgcolor="#CD5C5C"><b>Número de Beneficiários DREAMS que receberam TODO pacote primário de serviços e pelo menos um serviço secundario</b> </td>
                            </tr>
                            <tr>
                                <td width="174" bgcolor="#FFE4E1">Tempo de registo como beneficiário DREAMS </td>
                                <td bgcolor="#FFE4E1">10-14</td>
                                <td bgcolor="#FFE4E1">15-19</td>
                                <td bgcolor="#FFE4E1">20-24</td>
                                <td bgcolor="#FFE4E1">25-29</td>
                            </tr>
                            <?php foreach(['0_6','7_12', '13_24', '25+'] as $index2){ ?>
                                    <tr>
                                        <td bgcolor="#CD9B9B"><?php echo $index2 ?> meses </td>
                                        <?php foreach(['9-14','15-19', '20-24', '25-29'] as $index1){ ?>
                                            <td bgcolor="#CD9B9B"> 
                                                
                                                
                                                <?= Html::a($secondDesagregation[$index1][$index2], ['relatorioagywprev'], [
                                                        'data'=>[
                                                            'method' => 'post',
                                                            'params'=>['ageBand' => $index1, 
                                                                        'enrollmentTime' => $index2,
                                                                        'province_code' => $model->province_code,
                                                                        'district_code' => $model->district_code,
                                                                        'start_date' => $model->start_date,
                                                                        'end_date' => $model->end_date,
                                                                        'indicatorID' => 2
                                                                    ],
                                                        ]
                                                    ]) ?>
                                               
                                            </td>
                                        <?php  } ?>
                                    </tr>
                            <?php  } ?>
                            <tr>
                                <td colspan="5" height="40" bgcolor="#FFFFFF"><b> </b></td>
                            </tr>

                            <tr>
                                <td width="706" colspan="5" bgcolor="#CD5C5C"><b>Número de Beneficiários DREAMS que completaram pelo menos um serviço DREAMS mais não completaram o pacote primário de serviços</b> </td>
                            </tr>
                            <tr>
                                <td width="174" bgcolor="#FFE4E1">Tempo de registo como beneficiário DREAMS </td>
                                <td bgcolor="#FFE4E1">10-14</td>
                                <td bgcolor="#FFE4E1">15-19</td>
                                <td bgcolor="#FFE4E1">20-24</td>
                                <td bgcolor="#FFE4E1">25-29</td>
                            </tr>
                            <?php foreach(['0_6','7_12', '13_24', '25+'] as $index2){ ?>
                                    <tr>
                                        <td bgcolor="#CD9B9B"><?php echo $index2 ?> meses </td>
                                        <?php foreach(['9-14','15-19', '20-24', '25-29'] as $index1){ ?>
                                            <td bgcolor="#CD9B9B"> 
                                                
                                                
                                                <?= Html::a($thirdDesagregation[$index1][$index2], ['relatorioagywprev'], [
                                                        'data'=>[
                                                            'method' => 'post',
                                                            'params'=>['ageBand' => $index1, 
                                                                        'enrollmentTime' => $index2,
                                                                        'province_code' => $model->province_code,
                                                                        'district_code' => $model->district_code,
                                                                        'start_date' => $model->start_date,
                                                                        'end_date' => $model->end_date,
                                                                        'indicatorID' => 3
                                                                    ],
                                                        ]
                                                    ]) ?>
                                               
                                            </td>
                                        <?php  } ?>
                                    </tr>
                            <?php  } ?>
                            <tr>
                                <td colspan="5" height="40" bgcolor="#FFFFFF"><b> </b></td>
                            </tr>

                            <tr>
                                <td width="706" colspan="5" bgcolor="#CD5C5C"><b>Número de Beneficiários DREAMS iniciaram pelo menos um serviço/intervençao mas ainda nao concluiram</b> </td>
                            </tr>
                            <tr>
                                <td width="174" bgcolor="#FFE4E1">Tempo de registo como beneficiário DREAMS </td>
                                <td bgcolor="#FFE4E1">10-14</td>
                                <td bgcolor="#FFE4E1">15-19</td>
                                <td bgcolor="#FFE4E1">20-24</td>
                                <td bgcolor="#FFE4E1">25-29</td>
                            </tr>
                            <?php foreach(['0_6','7_12', '13_24', '25+'] as $index2){ ?>
                                    <tr>
                                        <td bgcolor="#CD9B9B"><?php echo $index2 ?> meses </td>
                                        <?php foreach(['9-14','15-19', '20-24', '25-29'] as $index1){ ?>
                                            <td bgcolor="#CD9B9B"> 
                                                
                                                
                                                <?= Html::a($fourthdesagregationResults[$index1][$index2], ['relatorioagywprev'], [
                                                        'data'=>[
                                                            'method' => 'post',
                                                            'params'=>['ageBand' => $index1, 
                                                                        'enrollmentTime' => $index2,
                                                                        'province_code' => $model->province_code,
                                                                        'district_code' => $model->district_code,
                                                                        'start_date' => $model->start_date,
                                                                        'end_date' => $model->end_date,
                                                                        'indicatorID' => 3
                                                                    ],
                                                        ]
                                                    ]) ?>
                                               
                                            </td>
                                        <?php  } ?>
                                    </tr>
                            <?php  } ?>
                            <tr>
                                <td colspan="5" height="40" bgcolor="#FFFFFF"><b> </b></td>
                            </tr>

                            <tr>
                                <td width="706" colspan="5" bgcolor="#CD5C5C"><b>Número de Beneficiários DREAMS que completaram intervencao focada na prevencao de violencia</b> </td>
                            </tr>
                            <tr>
                                <td width="174" bgcolor="#FFE4E1">Tempo de registo como beneficiário DREAMS </td>
                                <td bgcolor="#FFE4E1">10-14</td>
                                <td bgcolor="#FFE4E1">15-19</td>
                                <td bgcolor="#FFE4E1">20-24</td>
                                <td bgcolor="#FFE4E1">25-29</td>
                            </tr>
                            <?php foreach(['0_6','7_12', '13_24', '25+'] as $index2){ ?>
                                    <tr>
                                        <td bgcolor="#CD9B9B"><?php echo $index2 ?> meses </td>
                                        <?php foreach(['9-14','15-19', '20-24', '25-29'] as $index1){ ?>
                                            <td bgcolor="#CD9B9B"> 
                                                
                                                
                                                <?= Html::a($fifthdesagregationResults[$index1][$index2], ['relatorioagywprev'], [
                                                        'data'=>[
                                                            'method' => 'post',
                                                            'params'=>['ageBand' => $index1, 
                                                                        'enrollmentTime' => $index2,
                                                                        'province_code' => $model->province_code,
                                                                        'district_code' => $model->district_code,
                                                                        'start_date' => $model->start_date,
                                                                        'end_date' => $model->end_date,
                                                                        'indicatorID' => 3
                                                                    ],
                                                        ]
                                                    ]) ?>
                                               
                                            </td>
                                        <?php  } ?>
                                    </tr>
                            <?php  } ?>
                            <tr>
                                <td colspan="5" height="40" bgcolor="#FFFFFF"><b> </b></td>
                            </tr>

                            <tr>
                                <td width="706" colspan="5" bgcolor="#CD5C5C"><b>Número de Beneficiários DREAMS que receberam subsidio e suporte escolar</b> </td>
                            </tr>
                            <tr>
                                <td width="174" bgcolor="#FFE4E1">Tempo de registo como beneficiário DREAMS </td>
                                <td bgcolor="#FFE4E1">10-14</td>
                                <td bgcolor="#FFE4E1">15-19</td>
                                <td bgcolor="#FFE4E1">20-24</td>
                                <td bgcolor="#FFE4E1">25-29</td>
                            </tr>
                            <?php foreach(['0_6','7_12', '13_24', '25+'] as $index2){ ?>
                                    <tr>
                                        <td bgcolor="#CD9B9B"><?php echo $index2 ?> meses </td>
                                        <?php foreach(['9-14','15-19', '20-24', '25-29'] as $index1){ ?>
                                            <td bgcolor="#CD9B9B"> 
                                                
                                                
                                                <?= Html::a($sixthdesagregationResults[$index1][$index2], ['relatorioagywprev'], [
                                                        'data'=>[
                                                            'method' => 'post',
                                                            'params'=>['ageBand' => $index1, 
                                                                        'enrollmentTime' => $index2,
                                                                        'province_code' => $model->province_code,
                                                                        'district_code' => $model->district_code,
                                                                        'start_date' => $model->start_date,
                                                                        'end_date' => $model->end_date,
                                                                        'indicatorID' => 3
                                                                    ],
                                                        ]
                                                    ]) ?>
                                               
                                            </td>
                                        <?php  } ?>
                                    </tr>
                            <?php  } ?>
                            <tr>
                                <td colspan="5" height="40" bgcolor="#FFFFFF"><b> </b></td>
                            </tr>
                        </table>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>