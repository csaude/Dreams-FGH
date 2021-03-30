<?php

namespace backend\controllers;

use Yii;
use app\models\ReferenciasServicosReferidos;
use app\models\ReferenciasServicosReferidosSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


use yii\filters\AccessControl;
use common\models\User;
use common\components\AccessRule;
/**
 * ReferenciasServicosReferidosController implements the CRUD actions for ReferenciasServicosReferidos model.
 */
class ReferenciasServicosReferidosController extends Controller
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
'actions' => ['create','view'],

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
'actions' => ['delete','index'],
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
     * Lists all ReferenciasServicosReferidos models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ReferenciasServicosReferidosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ReferenciasServicosReferidos model.
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
     * Creates a new ReferenciasServicosReferidos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ReferenciasServicosReferidos();
$model->status = 1;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['referencias-dreams/view', 'id' => $model->referencia_id]);
        } else {
            return $this->renderAjax('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ReferenciasServicosReferidos model.
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
     * Deletes an existing ReferenciasServicosReferidos model.
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
     * Finds the ReferenciasServicosReferidos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ReferenciasServicosReferidos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ReferenciasServicosReferidos::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
