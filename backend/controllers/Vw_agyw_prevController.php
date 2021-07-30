<?php

namespace backend\controllers;

use Yii;
use app\models\Vw_agyw_prev;
use app\models\Vw_agyw_prevSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use yii\filters\AccessControl;
use common\models\User;
use common\components\AccessRule;

use yii\helpers\Json;
use yii\web\Response;

use yii\helpers\ArrayHelper;
use app\models\ReferenciasPontosDreams;
use app\models\Organizacoes;
use app\models\Distritos;

use app\models\ServicosDream;  //para seleccao de intervensoes
use app\models\Utilizadores;
use app\models\Profile;


/**
 * Vw_agyw_prevController implements the CRUD actions for Vw_agyw_prev model.
 */
class Vw_agyw_prevController extends Controller
{
    var $completaram_pacote_primario = array();
    var $completaram_servico_primario = array();
    var $completaram_servico_secundario = array();
    var $completaram_servico_violencia = array();
    var $tiveram_intervencao_subsidio_escolar = array();
    var $iniciaram_servico = array();
    
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],

                        'access' => [
                'class' => AccessControl::className(),
                'ruleConfig' => [
        'class' => AccessRule::className(),
    ],
                'rules' => [
                    [
                        'actions' => ['index','view','activa','completude','indicadores'],

                        'allow' => true,
                        'roles' => [
                User::ROLE_USER,
                User::ROLE_ADMIN,
                User::ROLE_GESTOR,
                User::ROLE_CORDENADOR
                ],
                    ],

                     [
                        'actions' => ['update'],
                        'allow' => true,
                      //  'roles' => ['@'],
                        
                        'roles' => [
                User::ROLE_ADMIN,
                User::ROLE_GESTOR,
                User::ROLE_CORDENADOR
            ],
                    ],

                    [
                        'actions' => ['delete'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                       return User::isUserAdmin(Yii::$app->user->identity->username);}
                    ],
                ]
            ]
        ];
    }
     
public function actionIndex()
{
    Yii::$app->response->format = Response::FORMAT_JSON;
    return Json::encode([
        'message' => 'success'
    ]);
    
}


    public function actionActiva($id,$di,$df)  // id = id do distrito; di = data inicio; df = data fim do report
    {
        $Agyw=Vw_agyw_prev::find()
        ->where(['=','vulneravel',1])                    // Verifica si possui vulnerabilidade;
        ->andWhere(['<>','nui',''])                      // Exclui beneficiarios sem NUI;
        ->andWhere(['not',['data_servico' =>null]])      // Verifica si possui a data de servico e define possuir intervesao;
        ->andWhere(['=','distrito_id',$id])              // Para um distrito em especifico;
        ->andWhere(['between','data_servico',$di,$df])   // Intervalo do periodo do report;
        ->limit(10000)                                   // **** Limite apenas em teste ****
        ->all();

        $countAGYWs = count($Agyw);                         // Conta o total de beneficiarias retornadas.

        if($countAGYWs>0) {

            $array=ArrayHelper::getValue($Agyw,'nui');
            Yii::$app->response->format = Response::FORMAT_JSON;
            return $this->asJson($Agyw);

        }else
        { Yii::$app->response->format = Response::FORMAT_JSON;
            return Json::encode([
                'message' => 'Sem AGYW`s'
            ]);
        }

    }

    public function actionCompletude()
    {
        // $completaram_pacote_primario = array();
        // $completaram_servico_primario = array();
        // $completaram_servico_secundario = array();
        // $completaram_servico_violencia = array();
        // $tiveram_intervencao_subsidio_escolar = array();
        $i = 0;
        $query = "select *,
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
                    end) prevencao_violencia_15_mais
                from app_dream_vw_agyw_prev
                where vulneravel = 1
                and data_servico between '2010-09-21' and '2021-06-30'
                group by beneficiario_id";

        $result = Yii::$app->db->createCommand($query)->queryAll();

        foreach ($result as $row){
            
            $beneficiary_id = $row['beneficiario_id'];
            $nui = $row['nui'];
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
            

            if($faixa_etaria == '9-14'){
                if($vai_escola == 1){    //Na escola
                    if($recursos_mandatorios == 15 && $outros_recursos > 6 && $modulos_ogaac == 3 && $sessoes_saaj == 5 && $literacia_financeira == 1 && ($sexualmente_activa == 1 && $testagem_hiv > 0)){
                        $completaram_pacote_primario[$i++] = $beneficiary_id;
                    }
                    if($recursos_mandatorios == 15 || $outros_recursos > 6 || $modulos_ogaac == 3 || $sessoes_saaj == 5 || $literacia_financeira == 1 || ($sexualmente_activa == 1 || $testagem_hiv > 0)){
                        $completaram_servico_primario[$i++] = $beneficiary_id;
                    }
                    if($prevencao_violencia_estudante == 3){
                        $completaram_servico_violencia[$i++] = $beneficiary_id;
                    }
                    if($recursos_mandatorios > 0 || $outros_recursos > 0 || $modulos_ogaac > 0 && $sessoes_saaj > 0 || $prevencao_violencia_estudante > 3){
                        $iniciaram_servico[$i++] = $beneficiary_id;
                    }
                }
                else{   // Fora da escola
                    if($recursos_mandatorios == 8 && $outros_recursos > 4 && $modulos_ogaac == 3 && $sessoes_saaj == 5 && $literacia_financeira == 1 && ($sexualmente_activa == 1 && $testagem_hiv > 0)){
                        $completaram_pacote_primario[$i++] = $beneficiary_id;
                    }
                    if($recursos_mandatorios == 8 || $outros_recursos > 4 || $modulos_ogaac == 3 && $sessoes_saaj == 5 || $literacia_financeira == 1 || ($sexualmente_activa == 1 || $testagem_hiv > 0)){
                        $completaram_servico_primario[$i++] = $beneficiary_id;
                    }
                    if($prevencao_violencia_rapariga == 5){
                        $completaram_servico_violencia[$i++] = $beneficiary_id;
                    }
                    if($recursos_mandatorios > 0 || $outros_recursos > 0 || $modulos_ogaac > 0 && $sessoes_saaj > 0 || $prevencao_violencia_rapariga > 3){
                        $iniciaram_servico[$i++] = $beneficiary_id;
                    }
                }
                if($subsidio_escolar > 0 || $preservativos > 0 || ($sexualmente_activa == 0 && $testagem_hiv > 0) || $cuidados_pos_violencia_us > 0 || $cuidados_pos_violencia_comunidade > 0 || $outros_servicos_saaj > 0){
                    $completaram_servico_secundario[$i++] = $beneficiary_id;
                }
                // Antigo curriculo
                if($recursos_antigo > 9 && $sessoes_saaj == 5 && ($sexualmente_activa == 1 && $preservativos > 0 && $testagem_hiv > 0)){
                    $completaram_pacote_primario[$i++] = $beneficiary_id;
                }
                if($recursos_antigo > 9 || $sessoes_saaj == 5 || ($sexualmente_activa == 1 || $preservativos > 0 || $testagem_hiv > 0)){
                    $completaram_servico_primario[$i++] = $beneficiary_id;
                }
                if($subsidio_escolar > 0 || ($sexualmente_activa == 0 && ($testagem_hiv > 0 || $preservativos > 0)) || $cuidados_pos_violencia_us >0 || $cuidados_pos_violencia_comunidade > 0 || $outros_servicos_saaj > 0){
                    $completaram_servico_secundario[$i++] = $beneficiary_id;
                }
                if($recursos_antigo > 0){
                    $iniciaram_servico[$i++] = $beneficiary_id;
                }
            }else{  // 15-24 Anos
                if($preservativos > 0 && $sessoes_hiv_vbg > 7 && $testagem_hiv > 0 && $literacia_financeira == 1){
                    $completaram_pacote_primario[$i++] = $beneficiary_id;
                }
                if($preservativos > 0 || $sessoes_hiv_vbg > 7 || $testagem_hiv > 0 || $literacia_financeira == 1){
                    $completaram_servico_primario[$i++] = $beneficiary_id;
                }
                if($recursos_sociais_15_mais > 0 || $subsidio_escolar > 0 || $cuidados_pos_violencia_us >0 || $cuidados_pos_violencia_comunidade > 0 || $abordagens_socio_economicas > 0 || $outros_servicos_saaj > 0 || $prep > 0){
                    $completaram_servico_secundario[$i++] = $beneficiary_id;
                }
                if($prevencao_violencia_15_mais == 3){
                    $completaram_servico_violencia[$i++] = $beneficiary_id;
                }
                if($sessoes_hiv_vbg > 0 || $prevencao_violencia_15_mais > 0){
                    $iniciaram_servico[$i++] = $beneficiary_id;
                }
                // Antigo curriculo
                if($preservativos > 0 && $testagem_hiv > 0 && $sessoes_hiv > 0 && $sessoes_vbg > 0){
                    $completaram_pacote_primario[$i++] = $beneficiary_id;
                }
                if($faixa_etaria = '15-19'){
                    if($recursos_antigo > 9 || $subsidio_escolar > 0 || $cuidados_pos_violencia_us >0 || $cuidados_pos_violencia_comunidade > 0 || $abordagens_socio_economicas > 0 || $outros_servicos_saaj > 0){
                        $completaram_servico_secundario[$i++] = $beneficiary_id;
                    }
                    if($recursos_antigo > 0){
                        $iniciaram_servico[$i++] = $beneficiary_id;
                    }
                }else{ //20-24
                    if($cuidados_pos_violencia_us > 0 || $cuidados_pos_violencia_comunidade > 0 || $abordagens_socio_economicas > 0 || $outros_servicos_saaj > 0){
                        $completaram_servico_secundario[$i++] = $beneficiary_id;
                    }
                }
            }
            if($subsidio_escolar > 0){
                $tiveram_intervencao_subsidio_escolar[$i++] = $beneficiary_id;
            }
        }

        $completaramApenasPacotePrimario = array_diff($completaram_pacote_primario, $completaram_servico_secundario);
        $completaramPacotePrimarioMaisSevicoSecudario = array_intersect($completaram_pacote_primario, $completaram_servico_secundario);
        $completaramServicoNaoPacotePrimario = array_diff(array_merge($completaram_servico_primario, $completaram_servico_secundario), $completaram_pacote_primario);
        $iniciaraServicoNaoCompletaram = array_diff($iniciaram_servico, $completaram_pacote_primario, $completaramApenasPacotePrimario, $completaramPacotePrimarioMaisSevicoSecudario, $completaramServicoNaoPacotePrimario);

        if(count($iniciaraServicoNaoCompletaram)>0) {

            $array=ArrayHelper::getValue($iniciaraServicoNaoCompletaram,'nui');
            Yii::$app->response->format = Response::FORMAT_JSON;
            return $this->asJson($iniciaraServicoNaoCompletaram);

        }else
        { Yii::$app->response->format = Response::FORMAT_JSON;
            return Json::encode([
                'message' => 'Sem AGYW`s'
            ]);
        }
    }

    public function actionIndicadores($dataInicial,$dataFinal)
    {
        $this->completude();
        // $completaramApenasPacotePrimario = array_diff($completaram_pacote_primario, $completaram_servico_secundario);
        // $completaramPacotePrimarioMaisSevicoSecudario = array_intersect($completaram_pacote_primario, $completaram_servico_secundario);
        // $completaramServicoNaoPacotePrimario = array_diff(array_merge($completaram_servico_primario, $completaram_servico_secundario), $completaram_pacote_primario);
        // $iniciaraServicoNaoCompletaram = array_diff(array_merge($completaram_servico_primario, $completaram_servico_secundario), $completaram_pacote_primario, 
        //     $completaramApenasPacotePrimario, $completaramPacotePrimarioMaisSevicoSecudario, $completaramServicoNaoPacotePrimario);

        if(count($iniciaraServicoNaoCompletaram)>0) {

            $array=ArrayHelper::getValue($iniciaraServicoNaoCompletaram,'beneficiario_id');
            Yii::$app->response->format = Response::FORMAT_JSON;
            return $this->asJson($iniciaraServicoNaoCompletaram);

        }else
        { Yii::$app->response->format = Response::FORMAT_JSON;
            return Json::encode([
                'message' => 'Sem AGYW`s'
            ]);
        }
    }

}

