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
                <i class="fa fa-dashboard  text-primary"></i> <strong> PEPFAR MER 2.5 Indicador Semi-Annual AGYW_PREV  </strong>
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
                                <td colspan="6" bgcolor="#FFFFFF"><b> Distrito: <?php echo $district ?> </b></td>
                            </tr>	
                            <tr>
                                <td colspan="6" bgcolor="#FFFFFF"><b>RESUMO DISTRITAL</b></td>
                            </tr>
                           
                            <tr>
                                
                                <td colspan="6" bgcolor="#FFFFFF"> <b>Total de Adolescentes Jovens Registados: <b>  <?php echo $totals['total_registos'] ?> </b></td>
                            </tr> 
                            <tr>
                                <td colspan="6" bgcolor="#FFFFFF"><b>Total de adolescentes e Jovens do sexo feminino: <?php echo $totals['total_femininos'] ?></b></td>
                            </tr> 
                            
                            <tr>
                                <td colspan="6" bgcolor="#FFFFFF"><b>Total de adolescentes e Jovens do sexo masculino: <?php echo $totals['total_masculinos'] ?></b></td>
                            </tr> 		
                            <tr>
                                <td colspan="6" bgcolor="#FFFFFF"><b> Total de Beneficiarias: <?php echo $totals['total_beneficiarias'] ?></b></td>
                            </tr> 
                            <tr>
                                <td colspan="6" bgcolor="#FFFFFF"><b> Total de Beneficiarias Activas: <?php echo $totals['beneficiarias_activas'] ?></b></td>
                            </tr> 
                            <tr>
                                <td colspan="6" height="40" bgcolor="#FFFFFF"><b> </b></td>
                            </tr>

                            <tr>
                                <td width="706" colspan="6" bgcolor="#F4A460"><b>Beneficiaries that have fully completed the DREAMS primary package of services/interventions but no additional services/interventions</b> </td>
                            </tr>
                            <tr>
                                <td width="174" bgcolor="#FFDEAD">Tempo de registo como beneficiário DREAMS </td>
                                <td bgcolor="#FFDEAD">10-14</td>
                                <td bgcolor="#FFDEAD">15-19</td>
                                <td bgcolor="#FFDEAD">20-24</td>
                                <td bgcolor="#FFDEAD">25-29</td>
                                <td bgcolor="#FFDEAD"><b>SUB-TOTAL</b></td>
                            </tr>
                            <?php foreach(['0_6','7_12', '13_24', '25+'] as $index2){ ?>
                                    <tr>
                                        <td bgcolor="#FAEBD7"><?php echo $index2 ?> meses </td>
                                        <?php foreach(['9-14','15-19', '20-24', '25-29'] as $index1){ ?>
                                            <td bgcolor="#FAEBD7"> 
                                                
                                                <?php if( $firstDesagregation[$index1][$index2] > 0 ){ ?>
                                                    <?= Html::a('<span style="color:#0549a3;"> '.$firstDesagregation[$index1][$index2].'</span>', ['relatorioagywprev'], [
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
                                                <?php  } else { ?>
                                                    <span style="color:#0549a3;"> <?= $firstDesagregation[$index1][$index2]?> </span>
                                                <?php  } ?>
                                               
                                            </td>
                                        <?php  } ?>
                                        <td bgcolor="#FAEBD7"><b><?php echo $firstDesagregation['9-14'][$index2] + $firstDesagregation['15-19'][$index2] + $firstDesagregation['20-24'][$index2] + $firstDesagregation['25-29'][$index2] ?></b></td>
                                    </tr>
                            <?php  } ?>
                            <tr>
                                <td colspan="6" height="40" bgcolor="#FFFFFF"><b> </b></td>
                            </tr>

                            <tr>
                                <td width="706" colspan="6" bgcolor="#F4A460"><b>Beneficiaries that have fully completed the DREAMS primary package of services/interventions AND at least one secondary service/intervention</b> </td>
                            </tr>
                            <tr>
                                <td width="174" bgcolor="#FFDEAD">Tempo de registo como beneficiário DREAMS </td>
                                <td bgcolor="#FFDEAD">10-14</td>
                                <td bgcolor="#FFDEAD">15-19</td>
                                <td bgcolor="#FFDEAD">20-24</td>
                                <td bgcolor="#FFDEAD">25-29</td>
                                <td bgcolor="#FFDEAD"><b>SUB-TOTAL</b></td>
                            </tr>
                            <?php foreach(['0_6','7_12', '13_24', '25+'] as $index2){ ?>
                                    <tr>
                                        <td bgcolor="#FAEBD7"><?php echo $index2 ?> meses </td>
                                        <?php foreach(['9-14','15-19', '20-24', '25-29'] as $index1){ ?>
                                            <td bgcolor="#FAEBD7"> 
                                                
                                                <?php if( $secondDesagregation[$index1][$index2] > 0 ){ ?>
                                                    <?= Html::a('<span style="color:#0549a3;">'.$secondDesagregation[$index1][$index2].'</span>', ['relatorioagywprev'], [
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
                                                <?php  } else { ?>
                                                    <span style="color:#0549a3;"> <?= $secondDesagregation[$index1][$index2]?> </span>
                                                <?php  } ?>
                                               
                                            </td>
                                        <?php  } ?>
                                        <td bgcolor="#FAEBD7"><b><?php echo $secondDesagregation['9-14'][$index2] + $secondDesagregation['15-19'][$index2] + $secondDesagregation['20-24'][$index2] + $secondDesagregation['25-29'][$index2] ?></b></td>
                                    </tr>
                            <?php  } ?>
                            <tr>
                                <td colspan="5" height="40" bgcolor="#FFFFFF"><b> </b></td>
                            </tr>

                            <tr>
                                <td width="706" colspan="6" bgcolor="#F4A460"><b>Beneficiaries that have completed at least one DREAMS service/intervention but not the full primary package</b> </td>
                            </tr>
                            <tr>
                                <td width="174" bgcolor="#FFDEAD">Tempo de registo como beneficiário DREAMS </td>
                                <td bgcolor="#FFDEAD">10-14</td>
                                <td bgcolor="#FFDEAD">15-19</td>
                                <td bgcolor="#FFDEAD">20-24</td>
                                <td bgcolor="#FFDEAD">25-29</td>
                                <td bgcolor="#FFDEAD"><b>SUB-TOTAL</b></td>
                            </tr>
                            <?php foreach(['0_6','7_12', '13_24', '25+'] as $index2){ ?>
                                    <tr>
                                        <td bgcolor="#FAEBD7"><?php echo $index2 ?> meses </td>
                                        <?php foreach(['9-14','15-19', '20-24', '25-29'] as $index1){ ?>
                                            <td bgcolor="#FAEBD7"> 
                                                
                                                <?php if( $thirdDesagregation[$index1][$index2] > 0 ){ ?>
                                                    <?= Html::a('<span style="color:#0549a3;">'.$thirdDesagregation[$index1][$index2].'</span>', ['relatorioagywprev'], [
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
                                                <?php  } else { ?>
                                                    <span style="color:#0549a3;"> <?= $thirdDesagregation[$index1][$index2]?> </span>
                                                <?php  } ?>
                                                    
                                            </td>
                                        <?php  } ?>
                                        <td bgcolor="#FAEBD7"><b><?php echo $thirdDesagregation['9-14'][$index2] + $thirdDesagregation['15-19'][$index2] + $thirdDesagregation['20-24'][$index2] + $thirdDesagregation['25-29'][$index2] ?></b></td>
                                    </tr>
                            <?php  } ?>
                            <tr>
                                <td colspan="5" height="40" bgcolor="#FFFFFF"><b> </b></td>
                            </tr>

                            <tr>
                                <td width="706" colspan="6" bgcolor="#F4A460"><b>Beneficiaries that have started a DREAMS service/intervention but have not yet completed it</b> </td>
                            </tr>
                            <tr>
                                <td width="174" bgcolor="#FFDEAD">Tempo de registo como beneficiário DREAMS </td>
                                <td bgcolor="#FFDEAD">10-14</td>
                                <td bgcolor="#FFDEAD">15-19</td>
                                <td bgcolor="#FFDEAD">20-24</td>
                                <td bgcolor="#FFDEAD">25-29</td>
                                <td bgcolor="#FFDEAD"><b>SUB-TOTAL</b></td>
                            </tr>
                            <?php foreach(['0_6','7_12', '13_24', '25+'] as $index2){ ?>
                                    <tr>
                                        <td bgcolor="#FAEBD7"><?php echo $index2 ?> meses </td>
                                        <?php foreach(['9-14','15-19', '20-24', '25-29'] as $index1){ ?>
                                            <td bgcolor="#FAEBD7"> 
                                                
                                                <?php if( $fourthdesagregationResults[$index1][$index2] > 0 ){ ?>
                                                    <?= Html::a('<span style="color:#0549a3;">'.$fourthdesagregationResults[$index1][$index2].'</span>', ['relatorioagywprev'], [
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
                                                <?php  } else { ?>
                                                    <span style="color:#0549a3;"> <?= $fourthdesagregationResults[$index1][$index2]?> </span>
                                                <?php  } ?>
                                               
                                            </td>
                                        <?php  } ?>
                                        <td bgcolor="#FAEBD7"><b><?php echo $fourthdesagregationResults['9-14'][$index2] + $fourthdesagregationResults['15-19'][$index2] + $fourthdesagregationResults['20-24'][$index2] + $fourthdesagregationResults['25-29'][$index2] ?></b></td>
                                    </tr>
                            <?php  } ?>
                            <tr>
                                <td colspan="5" height="40" bgcolor="#FFFFFF"><b> </b></td>
                            </tr>

                            <tr>
                                <td width="706" colspan="6" bgcolor="#F4A460"><b>Number of AGYW enrolled in DREAMS that completed an evidence-based intervention focused on preventing violence within the reporting period</b> </td>
                            </tr>
                            <tr>
                                <td width="174" bgcolor="#FFDEAD">Tempo de registo como beneficiário DREAMS </td>
                                <td bgcolor="#FFDEAD">10-14</td>
                                <td bgcolor="#FFDEAD">15-19</td>
                                <td bgcolor="#FFDEAD">20-24</td>
                                <td bgcolor="#FFDEAD">25-29</td>
                                <td bgcolor="#FFDEAD"><b>SUB-TOTAL</b></td>
                            </tr>
                            <?php foreach(['0_6','7_12', '13_24', '25+'] as $index2){ ?>
                                    <tr>
                                        <td bgcolor="#FAEBD7"><?php echo $index2 ?> meses </td>
                                        <?php foreach(['9-14','15-19', '20-24', '25-29'] as $index1){ ?>
                                            <td bgcolor="#FAEBD7"> 
                                                
                                                <?php if( $fifthdesagregationResults[$index1][$index2] > 0 ){ ?>
                                                    <?= Html::a('<span style="color:#0549a3;">'.$fifthdesagregationResults[$index1][$index2].'</span>', ['relatorioagywprev'], [
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
                                                <?php  } else { ?>
                                                    <span style="color:#0549a3;"> <?= $fifthdesagregationResults[$index1][$index2]?> </span>
                                                <?php  } ?>
                                               
                                            </td>
                                        <?php  } ?>
                                        <td bgcolor="#FAEBD7"><b><?php echo $fifthdesagregationResults['9-14'][$index2] + $fifthdesagregationResults['15-19'][$index2] + $fifthdesagregationResults['20-24'][$index2] + $fifthdesagregationResults['25-29'][$index2] ?></b></td>
                                    </tr>
                            <?php  } ?>
                            <tr>
                                <td colspan="5" height="40" bgcolor="#FFFFFF"><b> </b></td>
                            </tr>

                            <tr>
                                <td width="706" colspan="6" bgcolor="#F4A460"><b>Number of AGYW enrolled in DREAMS that received educational support to remain in, advance, and/or rematriculate in school within the reporting period</b> </td>
                            </tr>
                            <tr>
                                <td width="174" bgcolor="#FFDEAD">Tempo de registo como beneficiário DREAMS </td>
                                <td bgcolor="#FFDEAD">10-14</td>
                                <td bgcolor="#FFDEAD">15-19</td>
                                <td bgcolor="#FFDEAD">20-24</td>
                                <td bgcolor="#FFDEAD">25-29</td>
                                <td bgcolor="#FFDEAD"><b>SUB-TOTAL</b></td>
                            </tr>
                            <?php foreach(['0_6','7_12', '13_24', '25+'] as $index2){ ?>
                                    <tr>
                                        <td bgcolor="#FAEBD7"><?php echo $index2 ?> meses </td>
                                        <?php foreach(['9-14','15-19', '20-24', '25-29'] as $index1){ ?>
                                            <td bgcolor="#FAEBD7"> 
                                                <?php if( $sixthdesagregationResults[$index1][$index2] > 0 ){ ?>
                                                
                                                    <?= Html::a('<span style="color:#0549a3;">'.$sixthdesagregationResults[$index1][$index2].'</span>', ['relatorioagywprev'], [
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

                                                <?php  } else { ?>
                                                    <span style="color:#0549a3;"> <?= $sixthdesagregationResults[$index1][$index2]?> </span>
                                                <?php  } ?>
                                            </td>
                                        <?php  } ?>
                                        <td bgcolor="#FAEBD7"><b><?php echo $sixthdesagregationResults['9-14'][$index2] + $sixthdesagregationResults['15-19'][$index2] + $sixthdesagregationResults['20-24'][$index2] + $sixthdesagregationResults['25-29'][$index2] ?></b></td>
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