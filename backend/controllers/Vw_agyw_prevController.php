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
                        'actions' => ['index','view','activa'],

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


}

