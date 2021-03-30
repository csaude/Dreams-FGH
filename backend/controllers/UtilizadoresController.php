<?php

namespace backend\controllers;

use Yii;
use app\models\Utilizadores;
use app\models\UtilizadoresSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


use yii\filters\AccessControl;
use common\models\User;
use common\components\AccessRule;
use app\models\Distritos;
use app\models\ComiteLocalidades;
use app\models\Us;
/**
 * UtilizadoresController implements the CRUD actions for Utilizadores model.
 */
class UtilizadoresController extends Controller
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
                
                'rules' => [
                    [
                        'actions' => ['lists','localidades','us'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],

                    [
                        'actions' => ['update','delete','index','view','create'],
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
     * Lists all Utilizadores models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UtilizadoresSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
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
                        { /*echo "<option>-</option>";*/}  

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
                        { /*echo "<option>-</option>";*/}  

    }

           public function actionUs($id)
    {
       $countLocalidades = Us::find() 
                       ->where(['post_admin_id'=>$id])
                       ->count();
        $Localidades  = Us::find() 
                       ->where(['post_admin_id'=>$id])
                       ->all();
echo "<option>-</option>";
    if($countLocalidades>0) {
        foreach($Localidades as $localidade) 
            { echo "<option value='".$localidade->id."'>".$localidade->name."</option>";}
                          }else 
                        { /*echo "<option>-</option>";*/}  

    }

    /**
     * Displays a single Utilizadores model.
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
     * Creates a new Utilizadores model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Utilizadores();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Utilizadores model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Utilizadores model.
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
     * Finds the Utilizadores model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Utilizadores the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Utilizadores::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
