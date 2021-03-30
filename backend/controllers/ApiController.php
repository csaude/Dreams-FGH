<?php

namespace backend\controllers;

use yii\rest\ActiveController;

//use yii\web\UrlManager;


class ApiController extends ActiveController
{
    public $modelClass = 'app\models\Organizacoes';

    public function actions()
{
    $actions = parent::actions();
    unset($actions['delete'], $actions['create']);
  //  $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];
    return $actions;
}

    public function actionIndex(){
        return "index";
    }

    public function behaviors()
   {
       return [
           [
               'class' => \yii\filters\ContentNegotiator::className(),
               'only' => ['index'],
               'formats' => [
                   'application/json' => \yii\web\Response::FORMAT_JSON,
               ],
           ],
       ];
   }


}
