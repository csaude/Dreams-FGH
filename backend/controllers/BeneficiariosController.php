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

use yii\helpers\Json;
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
                        'actions' => ['index','view','create','lists','listas','servicos','localidades','bairros','todos','filtros','relatorio','relatoriofy19','relatoriofy20q1','relatoriofy20q2'],

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
                        'actions' => ['update','referidos'],
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

    /**
     * Lists all Beneficiarios models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BeneficiariosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
/** updated by: jordao.cololo@gmail.com on 13th July 2018
O digitadores so visualizam 5 Beneficiarios por lista**/
	Yii::$app->user->identity->role<18? $dataProvider->pagination->pageSize=5:$dataProvider->pagination->pageSize=10;

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
			
			 if(!empty($_POST['Beneficiarios']['encarregado_educacao'])) {
            $model->encarregado_educacao= implode(", ",$_POST['Beneficiarios']['encarregado_educacao']); } else {}

if($model->save()) {
Yii::$app->db->close();
Yii::$app->db->open();
            return $this->redirect(['update', 'id' => $model->id]);
}

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
        $model->encarregado_educacao= explode(',', $model->encarregado_educacao);  

        if ($model->load(Yii::$app->request->post()) ) {
  if(!empty($_POST['Beneficiarios']['encarregado_educacao'])) {
            $model->encarregado_educacao= implode(", ",$_POST['Beneficiarios']['encarregado_educacao']); } else {}

if($model->save()) {
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
                       ->where(['province_code'=>$id])
                       ->count();
        $Distritos  = Distritos::find() 
                       ->where(['province_code'=>$id])
                       ->all();
echo "<option>-</option>";
    if($countDistritos>0) {
        foreach($Distritos as $distrito) 
            { echo "<option value='".$distrito->district_code."'>".$distrito->district_name."</option>";}
                          }else 
                        { echo "<option>-</option>";}  

    }
	
	    public function actionTodos($id)
 {

    $countBenes = Beneficiarios::find()
                    ->where(['district_code'=>$id])
                    ->count();
     $Benes  = Beneficiarios::find()
                    ->where(['district_code'=>$id])
                    ->all();

 if($countBenes>0) {
   echo "<option>-</option>";
     foreach($Benes as $bene)
         { echo "<option value='".$bene->emp_firstname."'>".$bene->emp_firstname." ".$bene->emp_lastname." | ".$bene->us['name']."</option>";}
                       }else
                     { echo "<option> -- </option>";}
 }
	
	
	      public function actionServicos($id)
    {
        $countServicos = ServicosDream::find() 
                       ->where(['servico_id'=>$id])
                       ->count();
        $Servicos  = ServicosDream::find() 
                       ->where(['servico_id'=>$id])
                       ->all();

    if($countServicos>0) {
        echo "<option value='NULL'>--SELECIONE O SERVI&Ccedil;O--</option>";
        foreach($Servicos as $servico) 
            { echo "<option value='".$servico->id."'>".$servico->name."</option>";}
                          }else 
                        { }  

    }

 public function actionListas($id)
    {
       $countSubservicos = SubServicosDreams::find() 
                       ->where(['servico_id'=>$id])
                       ->count();
        $Subservicos  = SubServicosDreams::find() 
                       ->where(['servico_id'=>$id])
                       ->all();

    if($countSubservicos>0) {
        echo "<option value='NULL'>--SELECIONE--</option>";
        foreach($Subservicos as $subservico) 
            { echo "<option value='".$subservico->id."'>".$subservico->name."</option>";}
                          }else 
                        {  echo "<option value='NULL'>--SEM SUB-SERVICOS--</option>"; }  

    }

       public function actionLocalidades($id)
    {
       $countLocalidades = ComiteLocalidades::find() 
                       ->where(['c_distrito_id'=>$id])
                       ->count();
        $Localidades  = ComiteLocalidades::find() 
                       ->where(['c_distrito_id'=>$id])
                       ->all();
echo "<option>-</option>";
    if($countLocalidades>0) {
        foreach($Localidades as $localidade) 
            { echo "<option value='".$localidade->id."'>".$localidade->name."</option>";}
                          }else 
                        { }  

    }
	
	
	    public function actionBairros($id)
 {
    $countBairros = Bairros::find()
                    ->where(['post_admin_id'=>$id])
                    ->count();
     $Bairros  = Bairros::find()
                    ->where(['post_admin_id'=>$id])
                    ->all();
echo "<option>-</option>";
 if($countBairros>0) {
     foreach($Bairros as $bairros)
         { echo "<option value='".$bairros->id."'>".$bairros->name."</option>";}
                       }else
                     { /*echo "<option>-</option>";*/}

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
