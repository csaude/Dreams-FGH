<?php

namespace backend\controllers;

use Yii;
use app\models\ReferenciasDreams;
use app\models\ReferenciasDreamsSearch;
use app\models\ReferenciasDreamsPendentesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


use yii\filters\AccessControl;
use common\models\User;
use common\components\AccessRule;
use yii\helpers\ArrayHelper;
use app\models\ReferenciasPontosDreams;
use app\models\Organizacoes;
use app\models\Distritos;

use app\models\ServicosDream;  //para seleccao de intervensoes
use app\models\Utilizadores;
use app\models\Profile;

/**
 * ReferenciasDreamsController implements the CRUD actions for ReferenciasDreams model.
 */
class ReferenciasDreamsController extends Controller
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
                        'actions' => ['index','create','projecto','view','notificar', 'local'],
                        'allow' => true,
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
                        'actions' => ['update'],
                        'allow' => true,
                        //  'roles' => ['@'],

                        'roles' => [
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
                        'actions' => ['pendentes', 'confirmationmodal'],
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
                        return User::isUserAdmin(Yii::$app->user->identity->username);}
                    ],
                ]
            ]
        ];
    }

    /**
     * Lists all ReferenciasDreams models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ReferenciasDreamsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ReferenciasDreams model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

	public function actionCreate()
    {
        $model = new ReferenciasDreams();
        $pontos = new ReferenciasPontosDreams();
        if ($model->load(Yii::$app->request->post()) && $pontos->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'pontos'=>$pontos,
            ]);
        }
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $status =  $model->status;
            $cancelReason = $model->cancel_reason;
            $otherReason =  $model->other_reason;

            if ($status == '0' && ($cancelReason == '' || $cancelReason == 5 && $otherReason == '')){
                return $this->render('update', [
                    $model->cancel_reason = '',
                    $model->other_reason = '',
                    'model' => $model,
                ]);
            }

            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
           
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing ReferenciasDreams model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
	
	
    public function actionProjecto($id)
    {

        //Seleciona todos os distritos da Provincia onde pertence o Activista			
        $distritos=Distritos::find()
        ->where(['=','province_code',Yii::$app->user->identity->provin_code])
        ->asArray()->all();
        $dists = ArrayHelper::getColumn($distritos, 'district_code');

        //Contabiliza todos os parceiros daquela provincia
        $countProjectos = Organizacoes::find()
                        ->where(['parceria_id'=>$id])
                        ->andWhere(['>','distrito_id',0])
                        ->andWhere(['IN','distrito_id',$dists])
                        ->count();
        //Lista todos os parceiros daquela provincia			
        $Projectos  = Organizacoes::find()
                        ->where(['parceria_id'=>$id])
                        ->andWhere(['>','distrito_id',0])
                        ->andWhere(['IN','distrito_id',$dists])
                        ->all();

        if($countProjectos>0) {
        echo "<option>-</option>";
            foreach($Projectos as $projecto)
                { echo "<option value='".$projecto->id."'>".$projecto->name."</option>";}
                            }else
                            { echo "<option>-</option>";}
    }

    public function actionNotificar($id)
    {
        $countUsers=Utilizadores::find()
            ->where(['=','parceiro_id',$id])
            ->count();
        
        if($countUsers>0) {
            $countUser=Utilizadores::find()
                ->where(['=','parceiro_id',$id])
                ->asArray()->all();
            $ids=ArrayHelper::getColumn($countUser,'id');

            $profiles=Profile::find()
                ->where(['IN','user_id',$ids])
                ->andWhere(['<>','name',''])
                ->orderBy('name ASC')
                ->all();
            echo "<option>-</option>";
            foreach($profiles as $nomes)
            { 
                echo "<option value='".$nomes->id."'>".$nomes->name."</option>";
            }
        } else { 
            echo "<option>-</option>";
        }
    }

    public function actionLocal($id)
    {
        $countUsers=Utilizadores::find()
            ->where(['=','us_id',$id])
            ->count();

        if($countUsers>0) {
            $countUser=Utilizadores::find()
                ->where(['=','us_id',$id])
                ->asArray()->all();
            $ids=ArrayHelper::getColumn($countUser,'id');

            $profiles=Profile::find()
                ->where(['IN','user_id',$ids])
                ->andWhere(['<>','name',''])
                ->orderBy('name ASC')
                ->all();
            echo "<option>-</option>";
            foreach($profiles as $nomes)
            { 
                echo "<option value='".$nomes->id."'>".$nomes->name."</option>";
            }
        }else { 
            echo "<option>-</option>";
        }
    }

    /**
     * Finds the ReferenciasDreams model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ReferenciasDreams the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ReferenciasDreams::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


    /**
     * Lists all Referencias Dreams Pendentes.
     * @return mixed
     */
    public function actionPendentes()
    {

        $searchModel = new ReferenciasDreamsPendentesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andFilterWhere(['status_ref'=>0]); 

        $model = new ReferenciasDreams();

        /// update - Cancelamento em massa.

        if ($model->load(Yii::$app->request->post()) && $_POST['selection']){

            $myIds = $_POST['selection'];
            $dataProvider = $searchModel->searchPendentes($myIds);
            return $this->renderAjax('confirmationmodal', [
                    'dataProvider' => $dataProvider,
                    'model' => $model,
            ]);
    
        }
        
        return $this->render('pendentes', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
            'cancel_reason'=>'',
        ]);

    }

    public function actionConfirmationmodal(){
        

        $model = new ReferenciasDreams();
        if (isset($_POST['model']) && isset($_POST['dataProvider'])){

            $model->load(Yii::$app->request->post('model'));
            $dataProvider = unserialize(Yii::$app->request->post('dataProvider'));

            $cancelReason = $model->cancel_reason;
            $otherReason = $model->other_reason;
            $provider = $dataProvider->query->all();

            foreach($provider as $reference){
                $reference->status = 0;
                $reference->cancel_reason = $cancelReason;
                $reference->other_reason = $otherReason;
                $reference->save();
            }
        }
        
        $searchModel = new ReferenciasDreamsPendentesSearch();
        $dataProvider = $searchModel->search([Yii::$app->request->queryParams]);
        $dataProvider->query->andFilterWhere(['status_ref'=>0]); 
        $model = new ReferenciasDreams();
        
        return $this->redirect(['pendentes']);
    
        
    }
}
