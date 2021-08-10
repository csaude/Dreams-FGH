<?php

namespace app\models;

use Yii;
use yii\base\Model;

class AgywPrev extends Model {
    public $province_code;
    public $district_code;
    public $start_date;
    public $end_date;
    private $completudeness;

    public function rules()
    {
        return [
            [['province_code','district_code', 'start_date', 'end_date'], 'required'],
            [['province_code','district_code'], 'string', 'max' => 100],
        ];
    }

    public function attributeLabels()
    {
        return [
            'province_code' => 'Provincia',
            'start_date' => 'Data Inicial',
            'end_date' => 'Data Final',
            'district_code' => 'Distrito',
        ];
    }

    public function search($params, $beneficiaries){

    }

    /**
     * Return results for desagregation Bellow
     * Number of active DREAMS beneficiaries that have fully completed the DREAMS primary package of services/interventions 
     *  but no additional services/interventions. (Numerator, Denominator)
     */
    public function getFirstDesagregationResults(){
        
        $indicator = $this->desagregationCompletedOnlyFirstPackage();
        
        return $indicator['results'];
    }

    /**
     * Return beneficiaries for desagregation Bellow
     * Number of active DREAMS beneficiaries that have fully completed the DREAMS primary package of services/interventions 
     *  but no additional services/interventions. (Numerator, Denominator)
     */
    public function getFirstDesagregationBeneficiaries(){
        $indicator = $this->desagregationCompletedOnlyFirstPackage();

        return $indicator['beneficiaries'];
    }

    /**
     * Return results for desagregation Bellow
     * Number of active DREAMS beneficiaries that have fully completed the primary package of services/interventions AND
     *   at least one secondary service/intervention. (Numerator, Denominator)
     */
    public function getSecondDesagregationResults(){
        $indicator = $this->desagregationCompletedFirstPackageAndSecondaryService();
        
        return $indicator['results'];
    }

    /**
     * Return beneficiaries for desagregation Bellow
     * Number of active DREAMS beneficiaries that have fully completed the primary package of services/interventions AND
     *   at least one secondary service/intervention. (Numerator, Denominator)
     */
    public function getSecondDesagregationBeneficiaries(){
        $indicator = $this->desagregationCompletedFirstPackageAndSecondaryService();

        return $indicator['beneficiaries'];
    }

    /**
     * Return results for desagregation Bellow
     * Number of active DREAMS beneficiaries that have completed at least one DREAMS service/intervention but 
     *  not the full primary package. (Denominator)
     */
    public function getThirdDesagregationResults(){
        $indicator = $this->desagregationCompletedOnlyServiceNotPackage();
        
        return $indicator['results'];
    }

    /**
     * Return beneficiaries for desagregation Bellow
     * Number of active DREAMS beneficiaries that have completed at least one DREAMS service/intervention but 
     *  not the full primary package. (Denominator)
     */
    public function getThirdDesagregationBeneficiaries(){
        $indicator = $this->desagregationCompletedOnlyServiceNotPackage();

        return $indicator['beneficiaries'];
    }

    /**
     * Return results for desagregation Bellow
     * Number of active DREAMS beneficiaries that have completed at least one DREAMS service/intervention but 
     *  not the full primary package. (Denominator)
     */
    public function getFourthDesagregationResults(){
        $indicator = $this->desagregationStartedServiceNotFinished();
        
        return $indicator['results'];
    }

    /**
     * Return beneficiaries for desagregation Bellow
     * Number of active DREAMS beneficiaries that have completed at least one DREAMS service/intervention but 
     *  not the full primary package. (Denominator)
     */
    public function getFourthDesagregationBeneficiaries(){
        $indicator = $this->desagregationStartedServiceNotFinished();

        return $indicator['beneficiaries'];
    }

    /**
     * Return results for desagregation Bellow
     * Violence Prevention: Number of AGYW enrolled in DREAMS that completed an evidence-based intervention focused 
     *  on preventing violence within the reporting period.
     */
    public function getFifthDesagregationResults(){
        $indicator = $this->desagregationCompletedViolenceService();
        
        return $indicator['results'];
    }

    /**
     * Return beneficiaries for desagregation Bellow
     * Violence Prevention: Number of AGYW enrolled in DREAMS that completed an evidence-based intervention focused 
     *  on preventing violence within the reporting period.
     */
    public function getFifthDesagregationBeneficiaries(){
        $indicator = $this->desagregationCompletedViolenceService();

        return $indicator['beneficiaries'];
    }

    /**
     * Return results for desagregation Bellow
     * Education Support: Number of AGYW enrolled in DREAMS that received educational support to remain in, advance, 
     *  and/or rematriculate in school within the reporting period.
     */
    public function getSixthDesagregationResults(){
        $indicator = $this->desagregationSubsidioEscolar();
        
        return $indicator['results'];
    }

    /**
     * Return beneficiaries for desagregation Bellow
     * Education Support: Number of AGYW enrolled in DREAMS that received educational support to remain in, 
     *  advance, and/or rematriculate in school within the reporting period.
     */
    public function getSixthDesagregationBeneficiaries(){
        $indicator = $this->desagregationSubsidioEscolar();

        return $indicator['beneficiaries'];
    }
    

    private function s_datediff( $str_interval, $dt_menor, $dt_maior, $relative=false){

        if( is_string( $dt_menor)) $dt_menor = date_create( $dt_menor);
        if( is_string( $dt_maior)) $dt_maior = date_create( $dt_maior);
 
        $diff = date_diff( $dt_menor, $dt_maior, ! $relative);
       
        switch( $str_interval){
            case "y":
                $total = $diff->y + $diff->m / 12 + $diff->d / 365.25; break;
            case "m":
                $total= $diff->y * 12 + $diff->m + $diff->d/30 + $diff->h / 24;
                break;
            case "d":
                $total = $diff->y * 365.25 + $diff->m * 30 + $diff->d + $diff->h/24 + $diff->i / 60;
                break;
            case "h":
                $total = ($diff->y * 365.25 + $diff->m * 30 + $diff->d) * 24 + $diff->h + $diff->i/60;
                break;
            case "i":
                $total = (($diff->y * 365.25 + $diff->m * 30 + $diff->d) * 24 + $diff->h) * 60 + $diff->i + $diff->s/60;
                break;
            case "s":
                $total = ((($diff->y * 365.25 + $diff->m * 30 + $diff->d) * 24 + $diff->h) * 60 + $diff->i)*60 + $diff->s;
                break;
           }
        $total = floor($total);
        if( $diff->invert)
                return -1 * $total;
        else    return $total;
    }

    private function generateDesagregationMatrix(){
        $results1014 = array(
                    'completaram_pacote_primario' => array(),
                    'completaram_servico_primario' => array(),
                    'completaram_servico_violencia' => array(),
                    'iniciaram_servico' => array(),
                    'completaram_servico_secundario' => array(),
                    'tiveram_intervencao_subsidio_escolar' => array(),
                );
        $results1519 = array(
                    'completaram_pacote_primario' => array(),
                    'completaram_servico_primario' => array(),
                    'completaram_servico_violencia' => array(),
                    'iniciaram_servico' => array(),
                    'completaram_servico_secundario' => array(),
                    'tiveram_intervencao_subsidio_escolar' => array(),
                );
        $results2024 = array(
                    'completaram_pacote_primario' => array(),
                    'completaram_servico_primario' => array(),
                    'completaram_servico_violencia' => array(),
                    'iniciaram_servico' => array(),
                    'completaram_servico_secundario' => array(),
                    'tiveram_intervencao_subsidio_escolar' => array(),
                );
        $results2529 = array(
                    'completaram_pacote_primario' => array(),
                    'completaram_servico_primario' => array(),
                    'completaram_servico_violencia' => array(),
                    'iniciaram_servico' => array(),
                    'completaram_servico_secundario' => array(),
                    'tiveram_intervencao_subsidio_escolar' => array(),
                );

        return array(
            '9-14' => array(
                '0_6' => $results1014,
                '7_12' => $results1014,
                '13_24' => $results1014,
                '25+' => $results1014,
            ),
            '15-19' => array(
                '0_6' => $results1519,
                '7_12' => $results1519,
                '13_24' => $results1519,
                '25+' => $results1519,
            ),
            '20-24' => array(
                '0_6' => $results2024,
                '7_12' => $results2024,
                '13_24' => $results2024,
                '25+' => $results2024,
            ),
            '25-29' => array(
                '0_6' => $results2529,
                '7_12' => $results2529,
                '13_24' => $results2529,
                '25+' => $results2529,
            )
        ); 
    }
    
    private function generateTotalDesagregationMatrix(){
    
        return array(
            '9-14' => array(
                '0_6' => 0,
                '7_12' => 0,
                '13_24' => 0,
                '25+' => 0,
            ),
            '15-19' => array(
                '0_6' => 0,
                '7_12' => 0,
                '13_24' => 0,
                '25+' => 0,
            ),
            '20-24' => array(
                '0_6' => 0,
                '7_12' => 0,
                '13_24' => 0,
                '25+' => 0,
            ),
            '25-29' => array(
                '0_6' => 0,
                '7_12' => 0,
                '13_24' => 0,
                '25+' => 0,
            )
        ); 
    }

    private function beneficiaryIdsMatrix(){
        return array(
            '9-14' => array(
                '0_6' => array(),
                '7_12' => array(),
                '13_24' => array(),
                '25+' => array(),
            ),
            '15-19' => array(
                '0_6' => array(),
                '7_12' => array(),
                '13_24' => array(),
                '25+' => array(),
            ),
            '20-24' => array(
                '0_6' => array(),
                '7_12' => array(),
                '13_24' => array(),
                '25+' => array(),
            ),
            '25-29' => array(
                '0_6' => array(),
                '7_12' => array(),
                '13_24' => array(),
                '25+' => array(),
            )
        ); 
    }
    private function getEnrollmentTimeInMonths($enrollmentdate, $dataFim){
        return $this->s_datediff("m", $enrollmentdate, $dataFim);
    }

    private function addCompletude(&$matrix, $enrollmentTime, $value, $index1, $index3){
        
        if($enrollmentTime <= 6){
            array_push($matrix[$index1]['0_6'][$index3], $value);

        } else if ($enrollmentTime <= 12){
            array_push($matrix[$index1]['7_12'][$index3], $value);

        }else if ($enrollmentTime <= 24){
            array_push($matrix[$index1]['13_24'][$index3], $value);

        }else {
            array_push($matrix[$index1]['25+'][$index3], $value);
        }
    }

    private function completude($dataInicio,$dataFim, $province, $district){
       
        $desagregationMap = $this->generateDesagregationMatrix();

        $query = "select beneficiario_id, vai_escola, sexualmente_activa, data_registo, 
                    if(idade_actual = 15  and datediff(min(data_servico),coalesce(STR_TO_DATE(dataNascimento,'%d/%m/%Y'),STR_TO_DATE(dataNascimento,'%m/%d/%Y')))/30 between 120 and 177,'9-14',if(idade_actual = 20  and datediff(min(data_servico),coalesce(STR_TO_DATE(dataNascimento,'%d/%m/%Y'),STR_TO_DATE(dataNascimento,'%m/%d/%Y')))/30 between 180 and 237,'15-19',faixa_actual)) faixa_actual,
                    if(idade_actual < 20 and sustenta_casa=1,1,0) +
                    if(idade_actual < 18 and vai_escola=0,1,0) +
                    if(tem_deficiencia=1,1,0) +
                    if(idade_actual < 20 and foi_casada=1,1,0) + -- rever a restrićão de idade
                    if(idade_actual < 20 and esteve_gravida=1,1,0) +
                    if(idade_actual < 20 and tem_filhos=1,1,0) +
                    if(idade_actual < 20 and gravida_amamentar=1,1,0) +
                    if(teste_hiv < 2,1,0) +
                    if(idade_actual < 18 and vitima_exploracao_sexual=1,1,0) +
                    if(idade_actual < 20 and migrante=1,1,0) +
                    if(idade_actual < 20 and vitima_trafico=1,1,0) +
                    if(idade_actual < 18 and sexualmente_activa=1,1,0) +
                    if(relacoes_multiplas_cocorrentes=1,1,0) +
                    if(vitima_vbg=1,1,0) +
                    if(idade_actual > 17 and trabalhadora_sexo=1,1,0) +
                    if(abuso_alcool_drogas=1,1,0) +
                    if(historico_its=1,1,0) vulnerabilidades, 
                    sum(case
                    when (vai_escola=1 and sub_servico_id in (169,170,184,185,186,187,188,189,190,191,192,193,194,207,208)
                        or vai_escola=0 and sub_servico_id in (179,180,181,182,196,197,198,199)) then 1
                    else 0
                    end) recursos_sociais_mandatorios,
                    sum(case
                        when (vai_escola=1 and sub_servico_id in (165,166,167,168,171,172,173,174,175)
                            or vai_escola=0 and sub_servico_id in (157,158,159,160,161,162,163)) then 1
                        else 0
                    end) outros_recursos_sociais,
                    sum(case
                        when sub_servico_id in (130,131,132,133,134,135,136,137,138,139,140,141,142,143,144) then 1
                        else 0
                    end) recursos_sociais_antigo,
                    sum(case
                        when (vai_escola=1 and sub_servico_id in (176,195,209)
                            or vai_escola=0 and sub_servico_id in (164,183,200)) then 1
                        else 0
                    end) modulos_ogaac,
                    sum(case
                        when sub_servico_id in (77,88,89,90,91) then 1
                        else 0
                    end) sessoes_educativas_saaj,
                    sum(case
                        when sub_servico_id in (26,67,68) then 1
                        else 0
                    end) testagem_hiv,
                    sum(case
                        when sub_servico_id = 215 then 1
                        else 0
                    end) literacia_financeira,
                    sum(case
                        when sub_servico_id in (2,52,107,108) then 1
                        else 0
                    end) preservativos,
                    sum(case
                        when sub_servico_id in (201,202,203,204,205,206,210,211,212) then 1
                        else 0
                    end) sessoes_hiv_vbg,
                    sum(case
                        when sub_servico_id in (112,114,115,116,117,118,119,120,121,122,123,124,125,126) then 1
                        else 0
                    end) sessoes_hiv,
                    sum(case
                        when sub_servico_id in (113) then 1
                        else 0
                    end) sessoes_vbg,
                    sum(case
                        when sub_servico_id in (35,36,37) then 1
                        else 0
                    end) subsidio_escolar,
                    sum(case
                        when sub_servico_id in (9) then 1
                        else 0
                    end) cuidados_pos_violencia_us,
                    sum(case
                        when sub_servico_id in (127) then 1
                        else 0
                    end) cuidados_pos_violencia_comunidade,
                    sum(case
                        when sub_servico_id in (69,70,71,72,73,74,75,92,93,95,109,110,111,151) then 1
                        else 0
                    end) outros_servicos_saaj,
                    sum(case
                        when sub_servico_id in (177,178) then 1
                        else 0
                    end) recursos_sociais_15_mais,
                    sum(case
                        when sub_servico_id in (40,82,83,84,85,86,87,214) then 1
                        else 0
                    end) abordagens_socio_economicas,
                    sum(case
                        when sub_servico_id = 156 then 1
                        else 0
                    end) prep,
                    sum(case
                        when sub_servico_id in (196,197,198,199,200) then 1
                        else 0
                    end) prevencao_violencia_rapariga,
                    sum(case
                        when sub_servico_id in (207,208,209) then 1
                        else 0
                    end) prevencao_violencia_estudante,
                    sum(case
                        when sub_servico_id in (210,211,212) then 1
                        else 0
                    end) prevencao_violencia_15_mais,
                    min(data_servico) data_servico 
                from app_dream_vw_agyw_prev
                where   provincia_id = :province and
                        distrito_id = :district and
                        vulneravel = 1 and
                        faixa_actual <> '' and
                        faixa_actual <> 'NA' and
                        nui <> '' and
                        data_servico is not null and
                        data_servico <> '' and
                        (data_servico between :start and :end)
                group by beneficiario_id, faixa_actual, vai_escola, sexualmente_activa, data_registo";

        $preparedQuery = Yii::$app->db->createCommand($query);
        $preparedQuery->bindParam(":province", $province);
        $preparedQuery->bindParam(":district", $district);
        $preparedQuery->bindParam(":start", $dataInicio);
        $preparedQuery->bindParam(":end", $dataFim);
        $result = $preparedQuery->queryAll();

        foreach ($result as $row){
            
            $beneficiary_id = $row['beneficiario_id'];
            $faixa_etaria = $row['faixa_actual'];
            $vai_escola = $row['vai_escola'];
            $sexualmente_activa = $row['sexualmente_activa'];
            $recursos_mandatorios = $row['recursos_sociais_mandatorios'];
            $outros_recursos = $row['outros_recursos_sociais'];
            $recursos_antigo = $row['recursos_sociais_antigo'];
            $modulos_ogaac = $row['modulos_ogaac'];
            $sessoes_saaj = $row['sessoes_educativas_saaj'];
            $testagem_hiv = $row['testagem_hiv'];
            $literacia_financeira = $row['literacia_financeira'];
            $preservativos = $row['preservativos'];
            $sessoes_hiv_vbg = $row['sessoes_hiv_vbg'];
            $sessoes_hiv = $row['sessoes_hiv'];
            $sessoes_vbg = $row['sessoes_vbg'];
            $subsidio_escolar = $row['subsidio_escolar'];
            $cuidados_pos_violencia_us = $row['cuidados_pos_violencia_us'];
            $cuidados_pos_violencia_comunidade = $row['cuidados_pos_violencia_comunidade'];
            $outros_servicos_saaj = $row['outros_servicos_saaj'];
            $recursos_sociais_15_mais = $row['recursos_sociais_15_mais'];
            $abordagens_socio_economicas = $row['abordagens_socio_economicas'];
            $prep = $row['prep'];
            $prevencao_violencia_rapariga = $row['prevencao_violencia_rapariga'];
            $prevencao_violencia_estudante = $row['prevencao_violencia_estudante'];
            $prevencao_violencia_15_mais = $row['prevencao_violencia_15_mais'];
            $data_servico = $row['data_servico'];
            $enrollmentTime = $this->getEnrollmentTimeInMonths($data_servico, $dataFim);

            if($faixa_etaria == '9-14'){
                if($vai_escola == 1){    //Na escola
                    if($recursos_mandatorios == 15 && $outros_recursos > 6 && $modulos_ogaac == 3 && $sessoes_saaj == 5 && $literacia_financeira == 1 && ($sexualmente_activa == 1 && $testagem_hiv > 0)){
                        $this->addCompletude($desagregationMap, $enrollmentTime, $beneficiary_id, $faixa_etaria, 'completaram_pacote_primario');
                        
                    }
                    if($recursos_mandatorios == 15 || $outros_recursos > 6 || $modulos_ogaac == 3 || $sessoes_saaj == 5 || $literacia_financeira == 1 || ($sexualmente_activa == 1 || $testagem_hiv > 0)){
                        $this->addCompletude($desagregationMap, $enrollmentTime, $beneficiary_id, $faixa_etaria, 'completaram_servico_primario');
                    }
                    if($prevencao_violencia_estudante == 3){
                        $this->addCompletude($desagregationMap, $enrollmentTime, $beneficiary_id, $faixa_etaria, 'completaram_servico_violencia');
                    }
                    if($recursos_mandatorios > 0 || $outros_recursos > 0 || $modulos_ogaac > 0 && $sessoes_saaj > 0 || $prevencao_violencia_estudante > 3){
                        $this->addCompletude($desagregationMap, $enrollmentTime, $beneficiary_id, $faixa_etaria, 'iniciaram_servico');
                    }
                }
                else{   // Fora da escola
                    if($recursos_mandatorios == 8 && $outros_recursos > 4 && $modulos_ogaac == 3 && $sessoes_saaj == 5 && $literacia_financeira == 1 && ($sexualmente_activa == 1 && $testagem_hiv > 0)){
                        $this->addCompletude($desagregationMap, $enrollmentTime, $beneficiary_id, $faixa_etaria, 'completaram_pacote_primario');
                    }
                    if($recursos_mandatorios == 8 || $outros_recursos > 4 || $modulos_ogaac == 3 && $sessoes_saaj == 5 || $literacia_financeira == 1 || ($sexualmente_activa == 1 || $testagem_hiv > 0)){
                        $this->addCompletude($desagregationMap, $enrollmentTime, $beneficiary_id, $faixa_etaria, 'completaram_servico_primario');
                    }
                    if($prevencao_violencia_rapariga == 5){
                        $this->addCompletude($desagregationMap, $enrollmentTime, $beneficiary_id, $faixa_etaria, 'completaram_servico_violencia');
                    }
                    if($recursos_mandatorios > 0 || $outros_recursos > 0 || $modulos_ogaac > 0 && $sessoes_saaj > 0 || $prevencao_violencia_rapariga > 3){
                        $this->addCompletude($desagregationMap, $enrollmentTime, $beneficiary_id, $faixa_etaria, 'iniciaram_servico');
                    }
                }
                if($subsidio_escolar > 0 || $preservativos > 0 || ($sexualmente_activa == 0 && $testagem_hiv > 0) || $cuidados_pos_violencia_us > 0 || $cuidados_pos_violencia_comunidade > 0 || $outros_servicos_saaj > 0){
                    $this->addCompletude($desagregationMap, $enrollmentTime, $beneficiary_id, $faixa_etaria, 'completaram_servico_secundario');
                }
                // Antigo curriculo
                if($recursos_antigo > 9 && $sessoes_saaj == 5 && ($sexualmente_activa == 1 && $preservativos > 0 && $testagem_hiv > 0)){
                    $this->addCompletude($desagregationMap, $enrollmentTime, $beneficiary_id, $faixa_etaria, 'completaram_pacote_primario');
                }
                if($recursos_antigo > 9 || $sessoes_saaj == 5 || ($sexualmente_activa == 1 || $preservativos > 0 || $testagem_hiv > 0)){
                    $this->addCompletude($desagregationMap, $enrollmentTime, $beneficiary_id, $faixa_etaria, 'completaram_servico_primario');
                }
                if($subsidio_escolar > 0 || ($sexualmente_activa == 0 && ($testagem_hiv > 0 || $preservativos > 0)) || $cuidados_pos_violencia_us >0 || $cuidados_pos_violencia_comunidade > 0 || $outros_servicos_saaj > 0){
                    $this->addCompletude($desagregationMap, $enrollmentTime, $beneficiary_id, $faixa_etaria, 'completaram_servico_secundario');
                }
                if($recursos_antigo > 0){
                    $this->addCompletude($desagregationMap, $enrollmentTime, $beneficiary_id, $faixa_etaria, 'iniciaram_servico');
                }
            }else{  // 15-24 Anos
                if($preservativos > 0 && $sessoes_hiv_vbg > 7 && $testagem_hiv > 0 && $literacia_financeira == 1){
                    $this->addCompletude($desagregationMap, $enrollmentTime, $beneficiary_id, $faixa_etaria, 'completaram_pacote_primario');
                }
                if($preservativos > 0 || $sessoes_hiv_vbg > 7 || $testagem_hiv > 0 || $literacia_financeira == 1){
                    $this->addCompletude($desagregationMap, $enrollmentTime, $beneficiary_id, $faixa_etaria, 'completaram_servico_primario');
                }
                if($recursos_sociais_15_mais > 0 || $subsidio_escolar > 0 || $cuidados_pos_violencia_us >0 || $cuidados_pos_violencia_comunidade > 0 || $abordagens_socio_economicas > 0 || $outros_servicos_saaj > 0 || $prep > 0){
                    $this->addCompletude($desagregationMap, $enrollmentTime, $beneficiary_id, $faixa_etaria, 'completaram_servico_secundario');
                }
                if($prevencao_violencia_15_mais == 3){
                    $this->addCompletude($desagregationMap, $enrollmentTime, $beneficiary_id, $faixa_etaria, 'completaram_servico_violencia');
                }
                if($sessoes_hiv_vbg > 0 || $prevencao_violencia_15_mais > 0){
                    $this->addCompletude($desagregationMap, $enrollmentTime, $beneficiary_id, $faixa_etaria, 'iniciaram_servico');
                }
                // Antigo curriculo
                if($preservativos > 0 && $testagem_hiv > 0 && $sessoes_hiv > 0 && $sessoes_vbg > 0){
                    $this->addCompletude($desagregationMap, $enrollmentTime, $beneficiary_id, $faixa_etaria, 'completaram_pacote_primario');
                }
                if($faixa_etaria = '15-19'){
                    if($recursos_antigo > 9 || $subsidio_escolar > 0 || $cuidados_pos_violencia_us >0 || $cuidados_pos_violencia_comunidade > 0 || $abordagens_socio_economicas > 0 || $outros_servicos_saaj > 0){
                        $this->addCompletude($desagregationMap, $enrollmentTime, $beneficiary_id, $faixa_etaria, 'completaram_servico_secundario');
                    }
                    if($recursos_antigo > 0){
                        $this->addCompletude($desagregationMap, $enrollmentTime, $beneficiary_id, $faixa_etaria, 'iniciaram_servico');
                    }
                }else{ //20-24
                    if($cuidados_pos_violencia_us > 0 || $cuidados_pos_violencia_comunidade > 0 || $abordagens_socio_economicas > 0 || $outros_servicos_saaj > 0){
                        $this->addCompletude($desagregationMap, $enrollmentTime, $beneficiary_id, $faixa_etaria, 'completaram_servico_secundario');
                    }
                }
            }
            if($subsidio_escolar > 0){
                $this->addCompletude($desagregationMap, $enrollmentTime, $beneficiary_id, $faixa_etaria, 'tiveram_intervencao_subsidio_escolar');
            }
        }

        return $desagregationMap;
    }

    /**
     * Executes the completude operation
     */
    public function execute(){
        
        if($this->start_date && $this->end_date && $this->province_code && $this->district_code){
            $this->completudeness = $this->completude($this->start_date, $this->end_date, $this->province_code, $this->district_code);
        }
    }

    /**
     * 
     * Number of active DREAMS beneficiaries that have fully completed the DREAMS primary package of services/interventions 
     *  but no additional services/interventions. (Numerator, Denominator)
     */
    private function desagregationCompletedOnlyFirstPackage(){
        $ageBands = ['9-14','15-19','20-24','25-29'];
        $enrollmentTimes = ['0_6','7_12','13_24','25+'];
        $results = $this->generateTotalDesagregationMatrix();
        $completudes = $this->completudeness;
        //store the IDs for further consultation
        $beneficiaries = $this->beneficiaryIdsMatrix();

        foreach($ageBands as $index1){
            foreach($enrollmentTimes as $index2){
                $completaramApenasPacotePrimario = array_diff($completudes[$index1][$index2]['completaram_pacote_primario'], $completudes[$index1][$index2]['completaram_servico_secundario']);
                $beneficiaries[$index1][$index2] = $completaramApenasPacotePrimario;
                $results[$index1][$index2] = count($completaramApenasPacotePrimario);
            }
        }

        $result = [
            'results' => $results,
            'beneficiaries' =>  $beneficiaries
        ];
        
        return $result;
    } 

    /**
     * Number of active DREAMS beneficiaries that have fully completed the primary package of services/interventions AND
     *   at least one secondary service/intervention. (Numerator, Denominator)
     */
    private function desagregationCompletedFirstPackageAndSecondaryService(){
        $ageBands = ['9-14','15-19','20-24','25-29'];
        $enrollmentTimes = ['0_6','7_12','13_24','25+'];

        $results = $this->generateTotalDesagregationMatrix();
        $completudes = $this->completudeness;
        //store the IDs for further consultation
        $beneficiaries = $this->beneficiaryIdsMatrix();

        foreach($ageBands as $index1){
            foreach($enrollmentTimes as $index2){
                $completaramPPeServico = array_intersect($completudes[$index1][$index2]['completaram_pacote_primario'], $completudes[$index1][$index2]['completaram_servico_secundario']);
                $beneficiaries[$index1][$index2] = $completaramPPeServico;
                $results[$index1][$index2] = count($completaramPPeServico);
            }
        }

        $result = [
            'results' => $results,
            'beneficiaries' =>  $beneficiaries
        ];

        return $result;
    }

     /**
     * Number of active DREAMS beneficiaries that have completed at least one DREAMS service/intervention but 
     *  not the full primary package. (Denominator)
     */
    private function desagregationCompletedOnlyServiceNotPackage(){
        $ageBands = ['9-14','15-19','20-24','25-29'];
        $enrollmentTimes = ['0_6','7_12','13_24','25+'];
        
        $results = $this->generateTotalDesagregationMatrix();
        $completudes = $this->completudeness;
        //store the IDs for further consultation
        $beneficiaries = $this->beneficiaryIdsMatrix();

        foreach($ageBands as $index1){
            foreach($enrollmentTimes as $index2){
                $completaramServiconPP =  array_diff(array_merge($completudes[$index1][$index2]['completaram_servico_primario'], $completudes[$index1][$index2]['completaram_servico_secundario']), $completudes[$index1][$index2]['completaram_pacote_primario']);
                $beneficiaries[$index1][$index2] = $completaramServiconPP;
                $results[$index1][$index2] = count($completaramServiconPP);
            }
        }

        $result = [
            'results' => $results,
            'beneficiaries' =>  $beneficiaries
        ];

        return $result;
    }

     /**
     * Number of active DREAMS beneficiaries that have started a DREAMS service/intervention but 
     *  have not yet completed it. (Denominator)
     */
    private function desagregationStartedServiceNotFinished(){
        $ageBands = ['9-14','15-19','20-24','25-29'];
        $enrollmentTimes = ['0_6','7_12','13_24','25+'];
        
        $results = $this->generateTotalDesagregationMatrix();
        $completudes = $this->completudeness;
        //store the IDs for further consultation
        $beneficiaries = $this->beneficiaryIdsMatrix();

        foreach($ageBands as $index1){
            foreach($enrollmentTimes as $index2){
                $completaramApenasPacotePrimario = array_diff($completudes[$index1][$index2]['completaram_pacote_primario'], $completudes[$index1][$index2]['completaram_servico_secundario']);
                $completaramPPeServico = array_intersect($completudes[$index1][$index2]['completaram_pacote_primario'], $completudes[$index1][$index2]['completaram_servico_secundario']);
                $completaramServiconPP =  array_diff(array_merge($completudes[$index1][$index2]['completaram_servico_primario'], $completudes[$index1][$index2]['completaram_servico_secundario']), $completudes[$index1][$index2]['completaram_pacote_primario']);
                
                $iniciaraServicoNaoCompletaram =  array_diff($completudes[$index1][$index2]['iniciaram_servico'], $completudes[$index1][$index2]['completaram_pacote_primario'], $completaramApenasPacotePrimario, $completaramPPeServico, $completaramServiconPP);
                $beneficiaries[$index1][$index2] = $iniciaraServicoNaoCompletaram;
                $results[$index1][$index2] = count($iniciaraServicoNaoCompletaram);
            }
        }

        $result = [
            'results' => $results,
            'beneficiaries' =>  $beneficiaries
        ];

        return $result;
    }

    /**
     * Violence Prevention: Number of AGYW enrolled in DREAMS that completed an evidence-based intervention 
     *  focused on preventing violence within the reporting period.
     */
    private function desagregationCompletedViolenceService(){
        $ageBands = ['9-14','15-19','20-24','25-29'];
        $enrollmentTimes = ['0_6','7_12','13_24','25+'];
        
        $results = $this->generateTotalDesagregationMatrix();
        $completudes = $this->completudeness;
        //store the IDs for further consultation
        $beneficiaries = $this->beneficiaryIdsMatrix();

        foreach($ageBands as $index1){
            foreach($enrollmentTimes as $index2){
                $completaramServicoViolencia =  $completudes[$index1][$index2]['completaram_servico_violencia'];
                $beneficiaries[$index1][$index2] = $completaramServicoViolencia;
                $results[$index1][$index2] = count($completaramServicoViolencia);
            }
        }

        $result = [
            'results' => $results,
            'beneficiaries' =>  $beneficiaries
        ];

        return $result;
    }

    /**
     * Violence Prevention: Number of AGYW enrolled in DREAMS that completed an evidence-based intervention 
     *  focused on preventing violence within the reporting period.
     */
    private function desagregationSubsidioEscolar(){
        $ageBands = ['9-14','15-19','20-24','25-29'];
        $enrollmentTimes = ['0_6','7_12','13_24','25+'];
        
        $results = $this->generateTotalDesagregationMatrix();
        $completudes = $this->completudeness;
        //store the IDs for further consultation
        $beneficiaries = $this->beneficiaryIdsMatrix();

        foreach($ageBands as $index1){
            foreach($enrollmentTimes as $index2){
                $completaramServicoEscolar =  $completudes[$index1][$index2]['tiveram_intervencao_subsidio_escolar'];
                $beneficiaries[$index1][$index2] = $completaramServicoEscolar;
                $results[$index1][$index2] = count($completaramServicoEscolar);
            }
        }

        $result = [
            'results' => $results,
            'beneficiaries' =>  $beneficiaries
        ];

        return $result;
    }

    public function report(){
        $output = "";

        $output . ' <table style="width:100%">
                        <tr>
                            <th rowspan="5">Reporting_Period</th>
                            <th rowspan="5">Province</th>
                            <th rowspan="5">District</th>
                            <th colspan="80">AGYW_PREV (Denominator) : Number of active DREAMS beneficiaries that have started or completed any DREAMS service/intervention</th>
                        </tr>
                        <tr>
                            <td rowspan="4">Total</td>
                            <td colspan="20">Beneficiaries that have fully completed the DREAMS primary package of services/interventions but no additional services/interventions</td>
                        </tr>
                        <tr>
                     
                            <td colspan="20">Enrollment Time / Age</td>
                        </tr>
                        <tr>
                            <td colspan="5">0-6</td>
                            <td colspan="5">7-12</td>
                            <td colspan="5">13-24</td>
                            <td colspan="5">25+ months</td>
                        </tr>
                        <tr>
                            <td>9-14</td>
                            <td>15-19</td>
                            <td>20-24</td>
                            <td>25-29</td>
                            <td>SubTotal</td>
                            <td>9-14</td>
                            <td>15-19</td>
                            <td>20-24</td>
                            <td>25-29</td>
                            <td>SubTotal</td>
                        </tr>
                    </table>
                    ';

        return $output;
    }


}