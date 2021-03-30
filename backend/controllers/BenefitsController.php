<?php

namespace backend\controllers;

use Yii;
use app\models\Benefs;
use app\models\BenefsSearch;
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
 * BenefitsController implements the CRUD actions for Benefs model.
 */
class BenefitsController extends Controller
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
                        'actions' => ['index','view','create'],

                        'allow' => true,
                        'roles' => [
                User::ROLE_USER,
                User::ROLE_ADMIN,
                User::ROLE_GESTOR,
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
     * Lists all Benefs models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BenefsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Benefs model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('/beneficiarios/view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Benefs model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Benefs();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['/beneficiarios/view', 'id' => $model->id]);
        } else {
            return $this->render('/beneficiarios/create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Benefs model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['/beneficiarios/view', 'id' => $model->id]);
        } else {
            return $this->render('/beneficiarios/update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Benefs model.
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
     * Finds the Benefs model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Benefs the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Benefs::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
