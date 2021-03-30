<?php

namespace backend\controllers;

use Yii;
use app\models\Membros;
use app\models\MembrosSearch;
use app\models\ComiteCargos;
use app\models\ComiteCargosSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use yii\filters\AccessControl;
use common\models\User;
use common\components\AccessRule;
/**
 * MembrosController implements the CRUD actions for Membros model.
 */
class MembrosController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
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

    /**
     * Lists all Membros models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MembrosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
 $dataProvider->setSort([
        'attributes' => [
            'emp_lastname',
            'emp_firstname',
            'emp_middle_name',
            'membro_celula',
            'member_id',
            'emp_birthday',
            'emp_gender',
        ],
        'defaultOrder' => ['emp_firstname' => SORT_ASC]
    ]);
    
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Membros model.
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
     * Creates a new Membros model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Membros();
        $cargos = new ComiteCargos();





        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'cargos' => $cargos,
            ]);
        }
    }

    /**
     * Updates an existing Membros model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $cargos = ComiteCargos::find()->where(['subordinado_id'=>$id])->all();

        foreach($cargos as $cargos) {
echo $cargos->id;

 }
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'cargos' => $cargos,
             
            ]);
        }
    }

    /**
     * Deletes an existing Membros model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }


    public function actionChildAccount() {
    $out = [];
    if (isset($_POST['depdrop_parents'])) {
        $id = end($_POST['depdrop_parents']);
        $list = Account::find()->andWhere(['parent'=>$id])->asArray()->all();
        $selected  = null;
        if ($id != null && count($list) > 0) {
            $selected = '';
            foreach ($list as $i => $account) {
                $out[] = ['id' => $account['id'], 'name' => $account['name']];
                if ($i == 0) {
                    $selected = $account['id'];
                }
            }
            // Shows how you can preselect a value
            echo Json::encode(['output' => $out, 'selected'=>$selected]);
            return;
        }
    }
    echo Json::encode(['output' => '', 'selected'=>'']);
}

    /**
     * Finds the Membros model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Membros the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Membros::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
