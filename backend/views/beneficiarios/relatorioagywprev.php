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

                <button class="btn btn-primary btn-block  mb1 black bg-darken-1" data-toggle="collapse" data-target="#first"><b> <?php echo $province ?> </b></button>

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
                                <td width="706" colspan="5" bgcolor="#CD5C5C"><b>Beneficiaries that have fully completed the DREAMS primary package of services/interventions but no additional services/interventions</b> </td>
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
                                <td width="706" colspan="5" bgcolor="#CD5C5C"><b>Beneficiaries that have fully completed the DREAMS primary package of services/interventions AND at least one secondary service/intervention</b> </td>
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
                                <td width="706" colspan="5" bgcolor="#CD5C5C"><b>Beneficiaries that have completed at least one DREAMS service/intervention but not the full primary package</b> </td>
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
                                <td width="706" colspan="5" bgcolor="#CD5C5C"><b>Beneficiaries that have started a DREAMS service/intervention but have not yet completed it</b> </td>
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
                                                                        'indicatorID' => 4
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
                                <td width="706" colspan="5" bgcolor="#CD5C5C"><b>Number of AGYW enrolled in DREAMS that completed an evidence-based intervention focused on preventing violence within the reporting period</b> </td>
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
                                                                        'indicatorID' => 5
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
                                <td width="706" colspan="5" bgcolor="#CD5C5C"><b>Number of AGYW enrolled in DREAMS that received educational support to remain in, advance, and/or rematriculate in school within the reporting period</b> </td>
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
                                                                        'indicatorID' => 6
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