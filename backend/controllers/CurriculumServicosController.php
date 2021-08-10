<?php

namespace backend\controllers;

use Yii;
use app\models\CurriculumServicos;
use app\models\CurriculumServicosSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use yii\filters\AccessControl;
use common\models\User;
use common\components\AccessRule;

/**
 * CurriculumServicosController implements the CRUD actions for CurriculumServicos model.
 */
class CurriculumServicosController extends Controller
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
                        'actions' => ['index', 'view'],
                        'allow' => true,
                        'roles' => [
                            User::ROLE_USER,
                            User::ROLE_ADMIN,
                            User::ROLE_GESTOR,
                            User::ROLE_CORDENADOR
                        ],
                    ],
                    [
                        'actions' => ['update', 'create'],
                        'allow' => true,
                        'roles' => [
                            User::ROLE_ADMIN,
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

    /**
     * Lists all CurriculumServicos models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CurriculumServicosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        //curriculum_id=1&servico_id=1
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CurriculumServicos model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($curriculum_id, $servico_id)
    {
        $models = $this->findModel($curriculum_id, $servico_id);

        return $this->render('view', [
            'model' => $models,
        ]);
    }

    /**
     * Creates a new CurriculumServicos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CurriculumServicos();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            return $this->redirect(['view', 'curriculum_id' => $model->curriculum_id, 'servico_id' => $model->servico_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing CurriculumServicos model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($curriculum_id, $servico_id)
    {
        $model = $this->findModel($curriculum_id, $servico_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'curriculum_id' => $model->curriculum_id, 'servico_id' => $model->servico_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing CurriculumServicos model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($curriculum_id, $servico_id)
    {
        $this->findModel($curriculum_id, $servico_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the CurriculumServicos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CurriculumServicos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($curriculum_id, $servico_id)
    {
        // if (($model = CurriculumServicos::findOne($curriculum_id, $servico_id)) !== null) {
        if (($model = CurriculumServicos::find()->where(['curriculum_id' => $curriculum_id, 'servico_id' => $servico_id])->one()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
