<?php

namespace backend\controllers;

use Yii;
use app\models\Beneficiarios;
use app\models\BeneficiariosSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


use yii\filters\AccessControl;
use common\models\User;
use common\components\AccessRule;
use app\models\Distritos;
use app\models\ComiteLocalidades;
use app\models\SubServicosDreams;
use app\models\ServicosDream;
use app\models\Bairros;
use app\models\Provincias;
use app\models\AgywPrev;
use PHPExcel;
use PHPExcel_IOFactory;
use yii\helpers\Json;
use yii\helpers\VarDumper;

/**
 * BeneficiariosController implements the CRUD actions for Beneficiarios model.
 */
class BeneficiariosController extends Controller
{
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
                        'actions' => ['index', 'view', 'create', 'lists', 'listas', 'servicos', 'localidades', 'bairros', 'todos', 'filtros', 'relatorio', 'relatoriofy19', 'relatoriofy20q1', 'relatoriofy20q2'],

                        'allow' => true,
                        'roles' => [
                            User::ROLE_USER,
                            User::ROLE_MA,
                            User::ROLE_ADMIN,
                            User::ROLE_GESTOR,
                            User::ROLE_DIGITADOR,
                            User::ROLE_EDUCADOR_DE_PAR,
                            User::ROLE_MENTOR,
                            User::ROLE_ENFERMEIRA,
                            User::ROLE_CORDENADOR
                        ],
                    ],

                    [
                        'actions' => ['update', 'referidos'],
                        'allow' => true,
                        //  'roles' => ['@'],
                        'roles' => [
                            User::ROLE_USER,
                            User::ROLE_ADMIN,
                            User::ROLE_GESTOR,
                            User::ROLE_DIGITADOR,
                            User::ROLE_EDUCADOR_DE_PAR,
                            User::ROLE_MENTOR,
                            User::ROLE_ENFERMEIRA,
                            User::ROLE_CORDENADOR
                        ],
                    ],

                    [
                        'actions' => ['relatorioagyw', 'relatorioagywprev', 'exportlist', 'exportreport'],
                        'allow' => true,
                        'roles' => [
                            User::ROLE_ADMIN
                        ],
                    ],

                    [
                        'actions' => ['delete'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return User::isUserAdmin(Yii::$app->user->identity->username);
                        }
                    ],
                ]
            ]
        ];
    }

    
    public function actionExportreport(){
      
        $model = new AgywPrev();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $province = Provincias::find()
                    ->where(['id' => $model->province_code])->one();

            $district = Distritos::find()
                    ->where(['district_code' => $model->district_code])->one();
           
            $model->execute();
            $firstdesagregationResults = $model->getFirstDesagregationResults();
            $seconddesagregationResults = $model->getSecondDesagregationResults();
            $thirddesagregationResults = $model->getThirdDesagregationResults();
            $fourthdesagregationResults = $model->getFourthDesagregationResults();
            $fifthdesagregationResults = $model->getFifthDesagregationResults();
            $sixthdesagregationResults = $model->getSixthDesagregationResults();
            $totals = $model->getTotais();

            // load report template
            $tmpfname = 'template_agywprev.xls';
            $excelReader = PHPExcel_IOFactory::createReaderForFile($tmpfname);
            $excelObj = $excelReader->load($tmpfname);
            $excelObj->setActiveSheetIndex(0);
            $total = 0;

            /* fill the report */
            // report identification
            $excelObj->getActiveSheet()
                        ->setCellValue('A9', $model->start_date.' - '.$model->end_date)
                        ->setCellValue('B9', $province->province_name)
                        ->setCellValue('C9', $district->district_name);

            // report first desagregation
            $excelObj->getActiveSheet()
                        ->setCellValue('E9', $firstdesagregationResults['9-14']['0_6'])
                        ->setCellValue('F9', $firstdesagregationResults['15-19']['0_6'])
                        ->setCellValue('G9', $firstdesagregationResults['20-24']['0_6'])
                        ->setCellValue('H9', $firstdesagregationResults['25-29']['0_6'])
                        ->setCellValue('I9', $firstdesagregationResults['9-14']['0_6'] + $firstdesagregationResults['15-19']['0_6'] + $firstdesagregationResults['20-24']['0_6']+$firstdesagregationResults['25-29']['0_6'])
                        ->setCellValue('J9', $firstdesagregationResults['9-14']['7_12'])
                        ->setCellValue('K9', $firstdesagregationResults['15-19']['7_12'])
                        ->setCellValue('L9', $firstdesagregationResults['20-24']['7_12'])
                        ->setCellValue('M9', $firstdesagregationResults['25-29']['7_12'])
                        ->setCellValue('N9', $firstdesagregationResults['9-14']['7_12'] + $firstdesagregationResults['15-19']['7_12'] + $firstdesagregationResults['20-24']['7_12']+$firstdesagregationResults['25-29']['7_12'])
                        ->setCellValue('O9', $firstdesagregationResults['9-14']['13_24'])
                        ->setCellValue('P9', $firstdesagregationResults['15-19']['13_24'])
                        ->setCellValue('Q9', $firstdesagregationResults['20-24']['13_24'])
                        ->setCellValue('R9', $firstdesagregationResults['25-29']['13_24'])
                        ->setCellValue('S9', $firstdesagregationResults['9-14']['13_24'] + $firstdesagregationResults['15-19']['13_24'] + $firstdesagregationResults['20-24']['13_24']+$firstdesagregationResults['25-29']['13_24'])
                        ->setCellValue('T9', $firstdesagregationResults['9-14']['25+'])
                        ->setCellValue('U9', $firstdesagregationResults['15-19']['25+'])
                        ->setCellValue('V9', $firstdesagregationResults['20-24']['25+'])
                        ->setCellValue('W9', $firstdesagregationResults['25-29']['25+'])
                        ->setCellValue('X9', $firstdesagregationResults['9-14']['25+'] + $firstdesagregationResults['15-19']['25+'] + $firstdesagregationResults['20-24']['25+']+$firstdesagregationResults['25-29']['25+']);

            // report second desagregation
            $excelObj->getActiveSheet()
                        ->setCellValue('Y9', $seconddesagregationResults['9-14']['0_6'])
                        ->setCellValue('Z9', $seconddesagregationResults['15-19']['0_6'])
                        ->setCellValue('AA9', $seconddesagregationResults['20-24']['0_6'])
                        ->setCellValue('AB9', $seconddesagregationResults['25-29']['0_6'])
                        ->setCellValue('AC9', $seconddesagregationResults['9-14']['0_6'] + $seconddesagregationResults['15-19']['0_6'] + $seconddesagregationResults['20-24']['0_6']+$seconddesagregationResults['25-29']['0_6'])
                        ->setCellValue('AD9', $seconddesagregationResults['9-14']['7_12'])
                        ->setCellValue('AE9', $seconddesagregationResults['15-19']['7_12'])
                        ->setCellValue('AF9', $seconddesagregationResults['20-24']['7_12'])
                        ->setCellValue('AG9', $seconddesagregationResults['25-29']['7_12'])
                        ->setCellValue('AH9', $seconddesagregationResults['9-14']['7_12'] + $seconddesagregationResults['15-19']['7_12'] + $seconddesagregationResults['20-24']['7_12']+$seconddesagregationResults['25-29']['7_12'])
                        ->setCellValue('AI9', $seconddesagregationResults['9-14']['13_24'])
                        ->setCellValue('AJ9', $seconddesagregationResults['15-19']['13_24'])
                        ->setCellValue('AK9', $seconddesagregationResults['20-24']['13_24'])
                        ->setCellValue('AL9', $seconddesagregationResults['25-29']['13_24'])
                        ->setCellValue('AM9', $seconddesagregationResults['9-14']['13_24'] + $seconddesagregationResults['15-19']['13_24'] + $seconddesagregationResults['20-24']['13_24']+$seconddesagregationResults['25-29']['13_24'])
                        ->setCellValue('AN9', $seconddesagregationResults['9-14']['25+'])
                        ->setCellValue('AO9', $seconddesagregationResults['15-19']['25+'])
                        ->setCellValue('AP9', $seconddesagregationResults['20-24']['25+'])
                        ->setCellValue('AQ9', $seconddesagregationResults['25-29']['25+'])
                        ->setCellValue('AR9', $seconddesagregationResults['9-14']['25+'] + $seconddesagregationResults['15-19']['25+'] + $seconddesagregationResults['20-24']['25+']+$seconddesagregationResults['25-29']['25+']);

            // report third desagregation
            $excelObj->getActiveSheet()
                        ->setCellValue('AS9', $thirddesagregationResults['9-14']['0_6'])
                        ->setCellValue('AT9', $thirddesagregationResults['15-19']['0_6'])
                        ->setCellValue('AU9', $thirddesagregationResults['20-24']['0_6'])
                        ->setCellValue('AV9', $thirddesagregationResults['25-29']['0_6'])
                        ->setCellValue('AW9', $thirddesagregationResults['9-14']['0_6'] + $thirddesagregationResults['15-19']['0_6'] + $thirddesagregationResults['20-24']['0_6']+$thirddesagregationResults['25-29']['0_6'])
                        ->setCellValue('AX9', $thirddesagregationResults['9-14']['7_12'])
                        ->setCellValue('AY9', $thirddesagregationResults['15-19']['7_12'])
                        ->setCellValue('AZ9', $thirddesagregationResults['20-24']['7_12'])
                        ->setCellValue('BA9', $thirddesagregationResults['25-29']['7_12'])
                        ->setCellValue('BB9', $thirddesagregationResults['9-14']['7_12'] + $thirddesagregationResults['15-19']['7_12'] + $thirddesagregationResults['20-24']['7_12']+$thirddesagregationResults['25-29']['7_12'])
                        ->setCellValue('BC9', $thirddesagregationResults['9-14']['13_24'])
                        ->setCellValue('BD9', $thirddesagregationResults['15-19']['13_24'])
                        ->setCellValue('BE9', $thirddesagregationResults['20-24']['13_24'])
                        ->setCellValue('BF9', $thirddesagregationResults['25-29']['13_24'])
                        ->setCellValue('BG9', $thirddesagregationResults['9-14']['13_24'] + $thirddesagregationResults['15-19']['13_24'] + $thirddesagregationResults['20-24']['13_24']+$thirddesagregationResults['25-29']['13_24'])
                        ->setCellValue('BH9', $thirddesagregationResults['9-14']['25+'])
                        ->setCellValue('BI9', $thirddesagregationResults['15-19']['25+'])
                        ->setCellValue('BJ9', $thirddesagregationResults['20-24']['25+'])
                        ->setCellValue('BK9', $thirddesagregationResults['25-29']['25+'])
                        ->setCellValue('BL9', $thirddesagregationResults['9-14']['25+'] + $thirddesagregationResults['15-19']['25+'] + $thirddesagregationResults['20-24']['25+']+$thirddesagregationResults['25-29']['25+']);
            
            // report fourth desagregation
            $excelObj->getActiveSheet()
                        ->setCellValue('BM9', $fourthdesagregationResults['9-14']['0_6'])
                        ->setCellValue('BN9', $fourthdesagregationResults['15-19']['0_6'])
                        ->setCellValue('BO9', $fourthdesagregationResults['20-24']['0_6'])
                        ->setCellValue('BP9', $fourthdesagregationResults['25-29']['0_6'])
                        ->setCellValue('BQ9', $fourthdesagregationResults['9-14']['0_6'] + $fourthdesagregationResults['15-19']['0_6'] + $fourthdesagregationResults['20-24']['0_6']+$fourthdesagregationResults['25-29']['0_6'])
                        ->setCellValue('BR9', $fourthdesagregationResults['9-14']['7_12'])
                        ->setCellValue('BS9', $fourthdesagregationResults['15-19']['7_12'])
                        ->setCellValue('BT9', $fourthdesagregationResults['20-24']['7_12'])
                        ->setCellValue('BU9', $fourthdesagregationResults['25-29']['7_12'])
                        ->setCellValue('BV9', $fourthdesagregationResults['9-14']['7_12'] + $fourthdesagregationResults['15-19']['7_12'] + $fourthdesagregationResults['20-24']['7_12']+$fourthdesagregationResults['25-29']['7_12'])
                        ->setCellValue('BW9', $fourthdesagregationResults['9-14']['13_24'])
                        ->setCellValue('BX9', $fourthdesagregationResults['15-19']['13_24'])
                        ->setCellValue('BY9', $fourthdesagregationResults['20-24']['13_24'])
                        ->setCellValue('BZ9', $fourthdesagregationResults['25-29']['13_24'])
                        ->setCellValue('CA9', $fourthdesagregationResults['9-14']['13_24'] + $fourthdesagregationResults['15-19']['13_24'] + $fourthdesagregationResults['20-24']['13_24']+$fourthdesagregationResults['25-29']['13_24'])
                        ->setCellValue('CB9', $fourthdesagregationResults['9-14']['25+'])
                        ->setCellValue('CC9', $fourthdesagregationResults['15-19']['25+'])
                        ->setCellValue('CD9', $fourthdesagregationResults['20-24']['25+'])
                        ->setCellValue('CE9', $fourthdesagregationResults['25-29']['25+'])
                        ->setCellValue('CF9', $fourthdesagregationResults['9-14']['25+'] + $fourthdesagregationResults['15-19']['25+'] + $fourthdesagregationResults['20-24']['25+']+$fourthdesagregationResults['25-29']['25+']);
            
            $excelObj->getActiveSheet()
                        ->setCellValue('D9', $totals['total_agyw_prev']);

            // report fifth desagregation
            $violencePreventionCount = 0;
            foreach(['0_6','7_12', '13_24', '25+'] as $index2){
                foreach(['9-14','15-19', '20-24', '25-29'] as $index1){  
                    $violencePreventionCount += $fifthdesagregationResults[$index1][$index2];
                }
            };
            $excelObj->getActiveSheet()
                        ->setCellValue('CG9', $violencePreventionCount);

            // report sixth desagregation
            $educationSupportCount = 0;
            foreach(['0_6','7_12', '13_24', '25+'] as $index2){
                foreach(['9-14','15-19', '20-24', '25-29'] as $index1){  
                    $educationSupportCount += $sixthdesagregationResults[$index1][$index2];
                }
            };
            $excelObj->getActiveSheet()
                        ->setCellValue('CH9', $educationSupportCount);


            /* generate report */
            $objWriter = PHPExcel_IOFactory::createWriter($excelObj, 'Excel2007');
            $filename = 'PEPFAR_MER_2.5_AGYW_PREV_Semi-Annual_Indicator_' .  date('Ymd_his') . '.xls';
            $objWriter->save($filename);   
           
            ob_end_clean();  
            header('Content-type: application/xlsx');
            header('Content-Disposition: attachment; ');
            header("Pragma: no-cache");
            header("Expires: 0");

            return Yii::$app->response->sendFile($filename)->on(\yii\web\Response::EVENT_AFTER_SEND, function($event) {
                unlink($event->data);
            }, $filename);
          
        }
        
        return $this->render('relatorioagyw', [
            'model' => $model,
        ]);
    }

    public function actionExportlist(){
        $beneficiaries = isset($_POST['beneficiaries'])? $_POST['beneficiaries'] : null;
        
        $searchModel = new BeneficiariosSearch();
        $dataProvider = $searchModel->fetchAGYW($beneficiaries);

        $tmpfname = 'template_benefitiaries.xls';
        $excelReader = PHPExcel_IOFactory::createReaderForFile($tmpfname);
        $excelObj = $excelReader->load($tmpfname);
        $excelObj->setActiveSheetIndex(0);
        $worksheet = $excelObj->getActiveSheet();

        $row = 1;

        foreach($dataProvider as $data){
            $row++;
                
            $worksheet->setCellValue('A'.$row, $data['provincia']);
            $worksheet->setCellValue('B'.$row, $data['distrito']);
            $worksheet->setCellValue('C'.$row, $data['bairro']);
            $worksheet->setCellValue('D'.$row, $data['ponto_entrada']);
            $worksheet->setCellValue('E'.$row, $data['organizacao']);
            $worksheet->setCellValue('F'.$row, $data['data_registo']);
            $worksheet->setCellValue('G'.$row, $data['nui']);
            $worksheet->setCellValue('H'.$row, $data['idade_registo']);
            $worksheet->setCellValue('I'.$row, $data['idade_actual']);
            $worksheet->setCellValue('J'.$row, $data['faixa_registo']);
            $worksheet->setCellValue('K'.$row, $data['faixa_actual']);
            $worksheet->setCellValue('L'.$row, $data['vulnerabilidades']);
            $worksheet->setCellValue('M'.$row, $data['tipo_servico']);
            $worksheet->setCellValue('N'.$row, $data['servico']);
            $worksheet->setCellValue('O'.$row, $data['subservico']);
            $worksheet->setCellValue('P'.$row, $data['pacote']);
            $worksheet->setCellValue('Q'.$row, $data['ponto_entrada_servico']);
            $worksheet->setCellValue('R'.$row, $data['localizacao']);

        }

        // generate report 
        $objWriter = PHPExcel_IOFactory::createWriter($excelObj, 'Excel2007');
        $filename = 'PEPFAR_MER_2.5_AGYW_PREV_Beneficiaries_' .  date('Ymd_his') . '.xls';
        $objWriter->save($filename);   

        ob_end_clean();  
        header('Content-type: application/xlsx');
        header('Content-Disposition: attachment; ');
        header("Pragma: no-cache");
        header("Expires: 0");

        return Yii::$app->response->sendFile($filename)->on(\yii\web\Response::EVENT_AFTER_SEND, function($event) {
            unlink($event->data);
        }, $filename);

    }

    /**
     * Lists all Beneficiarios models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BeneficiariosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        /** updated by: jordao.cololo@gmail.com on 13th July 2018
        *   O digitadores so visualizam 5 Beneficiarios por lista
        */
        Yii::$app->user->identity->role < 18 ? $dataProvider->pagination->pageSize = 5 : $dataProvider->pagination->pageSize = 10;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionReferidos($id)
    {
        return $this->render('referidos', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionRelatorioagywprev(){

        $params = Yii::$app->request->queryParams;
        $enrollmentTime = isset($params['eTime'])? $params['eTime'] : null;
        $ageBand = isset($params['aBand'])? $params['aBand'] : null;
        $province_code = isset($params['pcode'])? $params['pcode'] : null;
        $district_code = isset($params['dcode'])? $params['dcode'] : null;
        $start_date = isset($params['sdate'])? $params['sdate'] : null;
        $end_date = isset($params['edate'])? $params['edate'] : null;
        $indicatorID = isset($params['iID'])? $params['iID'] : null;

        $model = new AgywPrev();
        $model->province_code = $province_code;
        $model->district_code = $district_code;
        $model->start_date = $start_date;
        $model->end_date = $end_date;

        $model->execute();

        $desagregationResults = null;
        $beneficiaries = null;

        switch($indicatorID){
            case 1: 
                    $desagregationResults = $model->getFirstDesagregationBeneficiaries();
                    $beneficiaries = $desagregationResults[$ageBand][$enrollmentTime];
                    break;
            case 2: 
                    $desagregationResults = $model->getSecondDesagregationBeneficiaries();
                    $beneficiaries = $desagregationResults[$ageBand][$enrollmentTime];
                    break;
            case 3: 
                    $desagregationResults = $model->getThirdDesagregationBeneficiaries();
                    $beneficiaries = $desagregationResults[$ageBand][$enrollmentTime];
                    break;
            case 4: 
                    $desagregationResults = $model->getFourthDesagregationBeneficiaries();
                    $beneficiaries = $desagregationResults[$ageBand][$enrollmentTime];
                    break;
            case 5: 
                    $desagregationResults = $model->getFifthDesagregationBeneficiaries();
                    $beneficiaries = $desagregationResults[$ageBand][$enrollmentTime];
                    break;
            case 6: 
                    $desagregationResults = $model->getSixthDesagregationBeneficiaries();
                    $beneficiaries = $desagregationResults[$ageBand][$enrollmentTime];
                    break;        
        };
        
        // use session storage
        $session = Yii::$app->session;
        if (!$session->isActive) 
            $session->open();

        if($beneficiaries != null){
            $session->set('beneficiaries', gzcompress(implode(',',$beneficiaries),9));
        } else {
            
            $beneficiaries = $session->has('beneficiaries') ? explode(',', gzuncompress($session->get('beneficiaries'))) : [];
        };  
        
        $searchModel = new BeneficiariosSearch();
        $dataProvider = $searchModel->searchList(Yii::$app->request->queryParams, $beneficiaries);
        $dataProvider->pagination->pageSize = 10;

        return $this->render('agywlist', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'beneficiaries' => implode(',',$beneficiaries)
        ]);
        
        
    }

    public function actionRelatorioagyw()
    {
        
        $model = new AgywPrev();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $province = Provincias::find()
                    ->where(['id' => $model->province_code])->one();

            $district = Distritos::find()
                    ->where(['district_code' => $model->district_code])->one();

            $model->execute();
            
            $firstdesagregationResults = $model->getFirstDesagregationResults();
            $seconddesagregationResults = $model->getSecondDesagregationResults();
            $thirddesagregationResults = $model->getThirdDesagregationResults();
            $fourthdesagregationResults = $model->getFourthDesagregationResults();
            $fifthdesagregationResults = $model->getFifthDesagregationResults();
            $sixthdesagregationResults = $model->getSixthDesagregationResults();
            $totaisresults = $model->getTotais();

            // reset session storage
            $session = Yii::$app->session;
            if (!$session->isActive){
                $session->open();
            } 
            $session->remove('beneficiaries');

            return $this->render('relatorioagywprev', [
                'model' => $model,
                'province' => $province->province_name,
                'district' => $district->district_name,
                'firstDesagregation' => $firstdesagregationResults,
                'secondDesagregation' => $seconddesagregationResults,
                'thirdDesagregation' => $thirddesagregationResults,
                'fourthdesagregationResults' => $fourthdesagregationResults,
                'fifthdesagregationResults' => $fifthdesagregationResults,
                'sixthdesagregationResults' => $sixthdesagregationResults,
                'totals' => $totaisresults
            ]);
            
        }
        
        return $this->render('relatorioagyw', [
            'model' => $model,
        ]);
    }





    /**
     * Displays a single Beneficiarios model.
     * @param integer $id
     * @return mixed
     */
    public function actionRelatoriofy19()
    {
        $model = new Beneficiarios();

        return $this->render('relatorioFY19', [
            'model' => $model,

        ]);
    }



    /**
     * Displays a single Beneficiarios model.
     * @param integer $id
     * @return mixed
     */
    public function actionRelatoriofy20q1()
    {
        $model = new Beneficiarios();

        return $this->render('relatorioFY20Q1', [
            'model' => $model,

        ]);
    }

    /**
     * Displays a single Beneficiarios model.
     * @param integer $id
     * @return mixed
     */
    public function actionRelatoriofy20q2()
    {
        $model = new Beneficiarios();

        return $this->render('relatorioFY20Q2', [
            'model' => $model,

        ]);
    }


    /**
     * Displays a single Beneficiarios model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Beneficiarios model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Beneficiarios();


        /*		$ben=Beneficiarios::find()
    ->where(['id' => Beneficiarios::find()->max('id')])
    ->one();
     $emp_number = $ben->id+1;
     $model->emp_number=$emp_number;
	*/

        $model->emp_gender = 2;
        $model->estudante = 1;
        $model->gravida = 0;
        $model->filhos = 0;
        $model->emp_status = 1;
        $model->deficiencia = 0;
        $model->ponto_entrada = 1;


        /*$model->parceiro_id  = 0;*/

        /*$model->provin_code = 5;
		$model->district_code = 1;
		$model->bairro_id = 1;
        $model->us_id = 1;
		$model->membro_localidade_id = 2;*/

        if ($model->load(Yii::$app->request->post())) {

            if (!empty($_POST['Beneficiarios']['encarregado_educacao'])) {
                $model->encarregado_educacao = implode(", ", $_POST['Beneficiarios']['encarregado_educacao']);
            } else {
            }
            //Table write lock
            yii::$app->db->createcommand("lock tables hs_hr_employee write")->execute();
            if ($model->save()) {
                Yii::$app->db->close();
                Yii::$app->db->open();
                //Table unlocked
                yii::$app->db->createcommand("unlock tables")->execute();
                return $this->redirect(['update', 'id' => $model->id]);
            }
            yii::$app->db->createcommand("unlock tables")->execute();
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Beneficiarios model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->encarregado_educacao = explode(',', $model->encarregado_educacao);

        if ($model->load(Yii::$app->request->post())) {
            if (!empty($_POST['Beneficiarios']['encarregado_educacao'])) {
                $model->encarregado_educacao = implode(", ", $_POST['Beneficiarios']['encarregado_educacao']);
            } else {
            }

            if ($model->save()) {
                Yii::$app->db->close();
                Yii::$app->db->open();
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Beneficiarios model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Beneficiarios model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Beneficiarios the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Beneficiarios::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


    public function actionLists($id)
    {
        $countDistritos = Distritos::find()
            ->where(['province_code' => $id])
            ->count();
        $Distritos  = Distritos::find()
            ->where(['province_code' => $id])
            ->all();
        echo "<option>-</option>";
        if ($countDistritos > 0) {
            foreach ($Distritos as $distrito) {
                echo "<option value='" . $distrito->district_code . "'>" . $distrito->district_name . "</option>";
            }
        } else {
            echo "<option>-</option>";
        }
    }

    public function actionTodos($id)
    {

        $countBenes = Beneficiarios::find()
            ->where(['district_code' => $id])
            ->count();
        $Benes  = Beneficiarios::find()
            ->where(['district_code' => $id])
            ->all();

        if ($countBenes > 0) {
            echo "<option>-</option>";
            foreach ($Benes as $bene) {
                echo "<option value='" . $bene->emp_firstname . "'>" . $bene->emp_firstname . " " . $bene->emp_lastname . " | " . $bene->us['name'] . "</option>";
            }
        } else {
            echo "<option> -- </option>";
        }
    }


    public function actionServicos($id)
    {
        $countServicos = ServicosDream::find()
            ->where(['servico_id' => $id])
            ->count();
        $Servicos  = ServicosDream::find()
            ->where(['servico_id' => $id])
            ->all();

        if ($countServicos > 0) {
            echo "<option value='NULL'>--SELECIONE O SERVI&Ccedil;O--</option>";
            foreach ($Servicos as $servico) {
                echo "<option value='" . $servico->id . "'>" . $servico->name . "</option>";
            }
        } else {
        }
    }

    public function actionListas($id)
    {
        $countSubservicos = SubServicosDreams::find()
            ->where(['servico_id' => $id])
            ->count();
        $Subservicos  = SubServicosDreams::find()
            ->where(['servico_id' => $id])
            ->all();

        if ($countSubservicos > 0) {
            echo "<option value='NULL'>--SELECIONE--</option>";
            foreach ($Subservicos as $subservico) {
                echo "<option value='" . $subservico->id . "'>" . $subservico->name . "</option>";
            }
        } else {
            echo "<option value='NULL'>--SEM SUB-SERVICOS--</option>";
        }
    }

    public function actionLocalidades($id)
    {
        $countLocalidades = ComiteLocalidades::find()
            ->where(['c_distrito_id' => $id])
            ->count();
        $Localidades  = ComiteLocalidades::find()
            ->where(['c_distrito_id' => $id])
            ->all();
        echo "<option>-</option>";
        if ($countLocalidades > 0) {
            foreach ($Localidades as $localidade) {
                echo "<option value='" . $localidade->id . "'>" . $localidade->name . "</option>";
            }
        } else {
        }
    }


    public function actionBairros($id)
    {
        $countBairros = Bairros::find()
            ->where(['post_admin_id' => $id])
            ->count();
        $Bairros  = Bairros::find()
            ->where(['post_admin_id' => $id])
            ->all();
        echo "<option>-</option>";
        if ($countBairros > 0) {
            foreach ($Bairros as $bairros) {
                echo "<option value='" . $bairros->id . "'>" . $bairros->name . "</option>";
            }
        } else { /*echo "<option>-</option>";*/
        }
    }
    //added on 01.12.2017 by cololo
    public function actionFiltros()
    {
        $searchModel = new BeneficiariosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('filtros', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }



    //added on 26.02.2019 relatorioQ1
    public function actionRelatorio($id)
    {
        return $this->render('relatorio', [
            'model' => $this->findModel($id),
        ]);
    }



    //added on 11.02.2020 by Gerzelio Saide relatorioQ1
    public function actionRelatorioQ1($id)
    {
        return $this->render('relatorioQ1', [
            'model' => $this->findModel($id),
        ]);
    }
}
