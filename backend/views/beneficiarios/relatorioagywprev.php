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
$i=0;
?>


<div class="membros-view">

	<div class="col-lg-12">

	    <div class="panel panel-primary">
            <div class="panel-heading">
                <i class="fa fa-dashboard  text-primary"></i> <strong> PEPFAR MER 2.6 Indicador Semi-Annual AGYW_PREV  </strong>
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

                <?php foreach($provinces as $province){
                        $i++;
                        $divId = 'tag'.$i;
                        $tag = '#tag'.$i;
                    ?>

                    <button class="btn btn-primary btn-block  mb1 black bg-darken-1" data-toggle="collapse" data-target=<?= $tag ?>  ><b> <?php echo $province->province_name ?> </b></button>

                    <div id=<?= $divId  ?> class="collapse">
                        <table width="100%" class="table table-dashed">

                            <tr>
                                <td colspan="5" bgcolor="#FFFFFF"><b> <?php echo $province->province_name ?> </b></td>
                            </tr>	
                        </table>
                        <?php foreach($districts as $district){
                                $i++;
                                $subdivId = 'subtag'.$i;
                                $subtag = '#subtag'.$i;
                                if( $district->province_code == $province->id){
                                    $firstdesagregationResults = $firstdesagregation[$district->district_code]['results'];
                                    $seconddesagregationResults = $seconddesagregation[$district->district_code]['results'];
                                    $thirddesagregationResults = $thirddesagregation[$district->district_code]['results'];
                                    $fourthdesagregationResults = $fourthdesagregation[$district->district_code]['results'];
                                    $fifthdesagregationResults = $fifthdesagregation[$district->district_code]['results'];
                                    $sixthdesagregationResults = $sixthdesagregation[$district->district_code]['results'];
                                    $seventhdesagregationResults = $seventhdesagregation[$district->district_code]['results'];

                            ?>
                                <button class="btn btn-primary btn-block  mb1 black bg-orange" data-toggle="collapse" data-target=<?= $subtag ?> ><b> <?php echo $district->district_name ?> </b></button>
                                <div id=<?= $subdivId  ?> class="collapse">
                                    <table width="100%" class="table table-dashed">
                                        <tr>
                                            <td colspan="6" bgcolor="#FFFFFF"><b> Distrito: <?php echo $district->district_name ?> </b></td>
                                        </tr>
                                        <tr>
                                            <td colspan="6" bgcolor="#FFFFFF"><b>RESUMO DISTRITAL</b></td>
                                        </tr>	
                                        <tr>
                                            <td colspan="6" bgcolor="#FFFFFF"> <b>Total de Adolescentes e Jovens Registados: <b>  <?php echo $totals[$district->district_code]['total_registos'] ?> </b></td>
                                        </tr> 
                                        <tr>
                                            <td colspan="6" bgcolor="#FFFFFF"><b>Total de Adolescentes e Jovens do Sexo Feminino: <?php echo $totals[$district->district_code]['total_femininos'] ?></b></td>
                                        </tr> 
                                        
                                        <tr>
                                            <td colspan="6" bgcolor="#FFFFFF"><b>Total de Adolescentes e Jovens do Sexo Masculino: <?php echo $totals[$district->district_code]['total_masculinos'] ?></b></td>
                                        </tr> 
                                        <tr>
                                            <td colspan="6" bgcolor="#FFFFFF"><b> Total de Beneficiárias no Indicador AGYW_PREV: <?= Html::a('<span style="color:#0549a3;"> '.($totalsAgyw[$district->district_code]).'</span>', ['relatorioagywprev', 
                                                                                                                                                        'aBand' => 'Todos',
                                                                                                                                                        'eTime' => 'Todos',
                                                                                                                                                        'pcode' => $district->province_code,
                                                                                                                                                        'dcode' => $district->district_code,
                                                                                                                                                        'sdate' => $model->start_date,
                                                                                                                                                        'edate' => $model->end_date,
                                                                                                                                                        'iID' => 0], []) ?></b></td>
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
                                                            
                                                            <?php if( $firstdesagregationResults[$index1][$index2] > 0 ){ ?>
                                                                <?= Html::a('<span style="color:#0549a3;"> '.$firstdesagregationResults[$index1][$index2].'</span>', ['relatorioagywprev', 
                                                                                                                                                                    'aBand' => $index1,
                                                                                                                                                                    'eTime' => $index2,
                                                                                                                                                                    'pcode' => $district->province_code,
                                                                                                                                                                    'dcode' => $district->district_code,
                                                                                                                                                                    'sdate' => $model->start_date,
                                                                                                                                                                    'edate' => $model->end_date,
                                                                                                                                                                    'iID' => 1], []) ?>
                                                            <?php  } else { ?>
                                                                <span style="color:#0549a3;"> <?= $firstdesagregationResults[$index1][$index2]?> </span>
                                                            <?php  } ?>
                                                        
                                                        </td>
                                                    <?php  } ?>
                                                        <td bgcolor="#FAEBD7"><b>
                                                            <?= Html::a('<span style="color:#0549a3;"> '.($firstdesagregationResults['9-14'][$index2] + $firstdesagregationResults['15-19'][$index2] + $firstdesagregationResults['20-24'][$index2] + $firstdesagregationResults['25-29'][$index2]).'</span>', ['relatorioagywprev', 
                                                                                                                                                                    'eTime' => $index2,
                                                                                                                                                                    'pcode' => $district->province_code,
                                                                                                                                                                    'dcode' => $district->district_code,
                                                                                                                                                                    'sdate' => $model->start_date,
                                                                                                                                                                    'edate' => $model->end_date,
                                                                                                                                                                    'iID' => 1], []) ?>
                                                    </b></td>
                                                    <!-- <td bgcolor="#FAEBD7"><b><?php echo $firstdesagregationResults['9-14'][$index2] + $firstdesagregationResults['15-19'][$index2] + $firstdesagregationResults['20-24'][$index2] + $firstdesagregationResults['25-29'][$index2] ?></b></td> -->
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
                                                            
                                                            <?php if( $seconddesagregationResults[$index1][$index2] > 0 ){ ?>
                                                                <?= Html::a('<span style="color:#0549a3;">'.$seconddesagregationResults[$index1][$index2].'</span>', ['relatorioagywprev', 
                                                                                                                                                                    'aBand' => $index1,
                                                                                                                                                                    'eTime' => $index2,
                                                                                                                                                                    'pcode' => $district->province_code,
                                                                                                                                                                    'dcode' => $district->district_code,
                                                                                                                                                                    'sdate' => $model->start_date,
                                                                                                                                                                    'edate' => $model->end_date,
                                                                                                                                                                    'iID' => 2], []) ?>
                                                            <?php  } else { ?>
                                                                <span style="color:#0549a3;"> <?= $seconddesagregationResults[$index1][$index2]?> </span>
                                                            <?php  } ?>
                                                        
                                                        </td>
                                                    <?php  } ?>
                                                        <td bgcolor="#FAEBD7"><b>
                                                            <?= Html::a('<span style="color:#0549a3;"> '.($seconddesagregationResults['9-14'][$index2] + $seconddesagregationResults['15-19'][$index2] + $seconddesagregationResults['20-24'][$index2] + $seconddesagregationResults['25-29'][$index2]).'</span>', ['relatorioagywprev', 
                                                                                                                                                                    'eTime' => $index2,
                                                                                                                                                                    'pcode' => $district->province_code,
                                                                                                                                                                    'dcode' => $district->district_code,
                                                                                                                                                                    'sdate' => $model->start_date,
                                                                                                                                                                    'edate' => $model->end_date,
                                                                                                                                                                    'iID' => 2], []) ?>
                                                        </b></td>
                                                    <!-- <td bgcolor="#FAEBD7"><b><?php echo $seconddesagregationResults['9-14'][$index2] + $seconddesagregationResults['15-19'][$index2] + $seconddesagregationResults['20-24'][$index2] + $seconddesagregationResults['25-29'][$index2] ?></b></td> -->
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
                                                            
                                                            <?php if( $thirddesagregationResults[$index1][$index2] > 0 ){ ?>
                                                                <?= Html::a('<span style="color:#0549a3;">'.$thirddesagregationResults[$index1][$index2].'</span>', ['relatorioagywprev','aBand' => $index1,
                                                                                                                                                                    'eTime' => $index2,
                                                                                                                                                                    'pcode' => $district->province_code,
                                                                                                                                                                    'dcode' => $district->district_code,
                                                                                                                                                                    'sdate' => $model->start_date,
                                                                                                                                                                    'edate' => $model->end_date,
                                                                                                                                                                    'iID' => 3], []) ?>
                                                            <?php  } else { ?>
                                                                <span style="color:#0549a3;"> <?= $thirddesagregationResults[$index1][$index2]?> </span>
                                                            <?php  } ?>
                                                                
                                                        </td>
                                                    <?php  } ?>
                                                        <td bgcolor="#FAEBD7"><b>
                                                            <?= Html::a('<span style="color:#0549a3;"> '.($thirddesagregationResults['9-14'][$index2] + $thirddesagregationResults['15-19'][$index2] + $thirddesagregationResults['20-24'][$index2] + $thirddesagregationResults['25-29'][$index2]).'</span>', ['relatorioagywprev', 
                                                                                                                                                                    'eTime' => $index2,
                                                                                                                                                                    'pcode' => $district->province_code,
                                                                                                                                                                    'dcode' => $district->district_code,
                                                                                                                                                                    'sdate' => $model->start_date,
                                                                                                                                                                    'edate' => $model->end_date,
                                                                                                                                                                    'iID' => 3], []) ?>
                                                        </b></td>
                                                    <!-- <td bgcolor="#FAEBD7"><b><?php echo $thirddesagregationResults['9-14'][$index2] + $thirddesagregationResults['15-19'][$index2] + $thirddesagregationResults['20-24'][$index2] + $thirddesagregationResults['25-29'][$index2] ?></b></td> -->
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
                                                                <?= Html::a('<span style="color:#0549a3;">'.$fourthdesagregationResults[$index1][$index2].'</span>', ['relatorioagywprev','aBand' => $index1,
                                                                                                                                                                    'eTime' => $index2,
                                                                                                                                                                    'pcode' => $district->province_code,
                                                                                                                                                                    'dcode' => $district->district_code,
                                                                                                                                                                    'sdate' => $model->start_date,
                                                                                                                                                                    'edate' => $model->end_date,
                                                                                                                                                                    'iID' => 4], []) ?>
                                                            <?php  } else { ?>
                                                                <span style="color:#0549a3;"> <?= $fourthdesagregationResults[$index1][$index2]?> </span>
                                                            <?php  } ?>
                                                        
                                                        </td>
                                                    <?php  } ?>
                                                        <td bgcolor="#FAEBD7"><b>
                                                            <?= Html::a('<span style="color:#0549a3;"> '.($fourthdesagregationResults['9-14'][$index2] + $fourthdesagregationResults['15-19'][$index2] + $fourthdesagregationResults['20-24'][$index2] + $fourthdesagregationResults['25-29'][$index2]).'</span>', ['relatorioagywprev', 
                                                                                                                                                                    'eTime' => $index2,
                                                                                                                                                                    'pcode' => $district->province_code,
                                                                                                                                                                    'dcode' => $district->district_code,
                                                                                                                                                                    'sdate' => $model->start_date,
                                                                                                                                                                    'edate' => $model->end_date,
                                                                                                                                                                    'iID' => 4], []) ?>
                                                        </b></td>
                                                    <!-- <td bgcolor="#FAEBD7"><b><?php echo $fourthdesagregationResults['9-14'][$index2] + $fourthdesagregationResults['15-19'][$index2] + $fourthdesagregationResults['20-24'][$index2] + $fourthdesagregationResults['25-29'][$index2] ?></b></td> -->
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
                                                                <?= Html::a('<span style="color:#0549a3;">'.$fifthdesagregationResults[$index1][$index2].'</span>', ['relatorioagywprev','aBand' => $index1,
                                                                                                                                                                    'eTime' => $index2,
                                                                                                                                                                    'pcode' => $district->province_code,
                                                                                                                                                                    'dcode' => $district->district_code,
                                                                                                                                                                    'sdate' => $model->start_date,
                                                                                                                                                                    'edate' => $model->end_date,
                                                                                                                                                                    'iID' => 5], []) ?>
                                                            <?php  } else { ?>
                                                                <span style="color:#0549a3;"> <?= $fifthdesagregationResults[$index1][$index2]?> </span>
                                                            <?php  } ?>
                                                        
                                                        </td>
                                                    <?php  } ?>
                                                        <td bgcolor="#FAEBD7"><b>
                                                            <?= Html::a('<span style="color:#0549a3;"> '.($fifthdesagregationResults['9-14'][$index2] + $fifthdesagregationResults['15-19'][$index2] + $fifthdesagregationResults['20-24'][$index2] + $fifthdesagregationResults['25-29'][$index2]).'</span>', ['relatorioagywprev', 
                                                                                                                                                                    'eTime' => $index2,
                                                                                                                                                                    'pcode' => $district->province_code,
                                                                                                                                                                    'dcode' => $district->district_code,
                                                                                                                                                                    'sdate' => $model->start_date,
                                                                                                                                                                    'edate' => $model->end_date,
                                                                                                                                                                    'iID' => 5], []) ?>
                                                        </b></td>
                                                    <!-- <td bgcolor="#FAEBD7"><b><?php echo $fifthdesagregationResults['9-14'][$index2] + $fifthdesagregationResults['15-19'][$index2] + $fifthdesagregationResults['20-24'][$index2] + $fifthdesagregationResults['25-29'][$index2] ?></b></td> -->
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
                                                            
                                                                <?= Html::a('<span style="color:#0549a3;">'.$sixthdesagregationResults[$index1][$index2].'</span>', ['relatorioagywprev','aBand' => $index1,
                                                                                                                                                                    'eTime' => $index2,
                                                                                                                                                                    'pcode' => $district->province_code,
                                                                                                                                                                    'dcode' => $district->district_code,
                                                                                                                                                                    'sdate' => $model->start_date,
                                                                                                                                                                    'edate' => $model->end_date,
                                                                                                                                                                    'iID' => 6], []) ?>

                                                            <?php  } else { ?>
                                                                <span style="color:#0549a3;"> <?= $sixthdesagregationResults[$index1][$index2]?> </span>
                                                            <?php  } ?>
                                                        </td>
                                                    <?php  } ?>
                                                        <td bgcolor="#FAEBD7"><b>
                                                            <?= Html::a('<span style="color:#0549a3;"> '.($sixthdesagregationResults['9-14'][$index2] + $sixthdesagregationResults['15-19'][$index2] + $sixthdesagregationResults['20-24'][$index2] + $sixthdesagregationResults['25-29'][$index2]).'</span>', ['relatorioagywprev', 
                                                                                                                                                                    'eTime' => $index2,
                                                                                                                                                                    'pcode' => $district->province_code,
                                                                                                                                                                    'dcode' => $district->district_code,
                                                                                                                                                                    'sdate' => $model->start_date,
                                                                                                                                                                    'edate' => $model->end_date,
                                                                                                                                                                    'iID' => 6], []) ?>
                                                        </b></td>
                                                    <!-- <td bgcolor="#FAEBD7"><b><?php echo $sixthdesagregationResults['9-14'][$index2] + $sixthdesagregationResults['15-19'][$index2] + $sixthdesagregationResults['20-24'][$index2] + $sixthdesagregationResults['25-29'][$index2] ?></b></td> -->
                                                </tr>
                                        <?php  } ?>
                                        <tr>
                                            <td colspan="5" height="40" bgcolor="#FFFFFF"><b> </b></td>
                                        </tr>
                                        <tr>
                                            <td width="706" colspan="6" bgcolor="#F4A460"><b>Number of AGYW ages 15-24 years enrolled in DREAMS that completed a comprehensive economic strengthening intervention within the reporting period</b> </td>
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
                                                            <?php if( $seventhdesagregationResults[$index1][$index2] > 0 ){ ?>
                                                            
                                                                <?= Html::a('<span style="color:#0549a3;">'.$seventhdesagregationResults[$index1][$index2].'</span>', ['relatorioagywprev','aBand' => $index1,
                                                                                                                                                                    'eTime' => $index2,
                                                                                                                                                                    'pcode' => $district->province_code,
                                                                                                                                                                    'dcode' => $district->district_code,
                                                                                                                                                                    'sdate' => $model->start_date,
                                                                                                                                                                    'edate' => $model->end_date,
                                                                                                                                                                    'iID' => 7], []) ?>

                                                            <?php  } else { ?>
                                                                <span style="color:#0549a3;"> <?= $seventhdesagregationResults[$index1][$index2]?> </span>
                                                            <?php  } ?>
                                                        </td>
                                                    <?php  } ?>
                                                        <td bgcolor="#FAEBD7"><b>
                                                            <?= Html::a('<span style="color:#0549a3;"> '.($seventhdesagregationResults['9-14'][$index2] + $seventhdesagregationResults['15-19'][$index2] + $seventhdesagregationResults['20-24'][$index2] + $seventhdesagregationResults['25-29'][$index2]).'</span>', ['relatorioagywprev', 
                                                                                                                                                                    'eTime' => $index2,
                                                                                                                                                                    'pcode' => $district->province_code,
                                                                                                                                                                    'dcode' => $district->district_code,
                                                                                                                                                                    'sdate' => $model->start_date,
                                                                                                                                                                    'edate' => $model->end_date,
                                                                                                                                                                    'iID' => 7], []) ?>
                                                        </b></td>
                                                    <!-- <td bgcolor="#FAEBD7"><b><?php echo $seventhdesagregationResults['9-14'][$index2] + $seventhdesagregationResults['15-19'][$index2] + $seventhdesagregationResults['20-24'][$index2] + $seventhdesagregationResults['25-29'][$index2] ?></b></td> -->
                                                </tr>
                                        <?php  } ?>
                                        <tr>
                                            <td colspan="5" height="40" bgcolor="#FFFFFF"><b> </b></td>
                                        </tr>

                                    </table>
                                </div>
                                
                            <?php  } ?> 
                        <?php  } ?> 
                    </div>
                <?php  } ?> 
                <br />
                <div class="form-group" align="center">
                    <?= Html::a('<i class="glyphicon glyphicon-export"></i> Exportar Todos', ['exportallbeneficiarieslist'], [
                                                        'data'=>[
                                                            'method' => 'post',
                                                            'params'=>[
                                                                    'province_code' => $model->province_code,
                                                                    'district_code' => $model->district_code,
                                                                    'start_date' => $model->start_date,
                                                                    'end_date' => $model->end_date,
                                                                    'provinces' => implode(',', ArrayHelper::getColumn($provinces, 'province_code')),
                                                                    'districts' => implode(',', ArrayHelper::getColumn($districts, 'district_code'))
                                                                ],
                                                            'confirm' => 'The EXCEL export file will be generated for download!'
                                                        ],
                                                        'class'=>'btn btn-default'        
                                                    ]) ?>
                </div>                                     
            </div>
        </div>
    </div>
</div>