<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\models\ComiteZonal;
use app\models\ComiteDistrital;
use kartik\select2\Select2;
use app\models\ComiteLocalidades;
use app\models\ComiteCirculos;
use app\models\ComiteCelulas;
/* @var $this yii\web\View */
/* @var $searchModel app\models\MembrosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Beneficiários DREAMS';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="membros-index">

    <h2 align="center"> 
 <?= Html::img('@web/img/users/bandeira.jpg',['class' => 'img-default','width' => '75px','alt' => 'DREAMS']) ?>   

     <br>Lista de <?= Html::encode($this->title) ?>
        
<?php //if(Yii::$app->user->identity->role<20) { echo "da minha Celula"; } else {echo "do Partido";} ?>


    </h2>
    <?php   echo $this->render('_search', ['model' => $searchModel]); ?>
 


<div class="panel panel-default">
    <div class="panel-body">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,


        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //  'id',
           // 'emp_number',
                  [
            'attribute' => 'img',
            'format' => 'html',
            'label' => 'Profile',
            'value' => function ($data) {
              //   return Html::img(imgProfile($data->emp_number),
               return Html::img('@web/img/users/bandeira.jpg',
                    ['width' => '25px', 'class'=>'img-circle']);
                        },
                     ],

        /*      [
            'attribute'=>'membro_localidade_id',
            'value'=>'localidade.name',
            'filter'=> ArrayHelper::map(ComiteLocalidades::find()->orderBy('name ASC')->asArray()->all(), 'id', 'name')
          ], */
       [
            'attribute'=>'membro_zona',
            'value'=>'cZona.name',
            'filter'=> ArrayHelper::map(ComiteZonal::find()->orderBy('name ASC')->asArray()->all(), 'id', 'name')
          ],

        /*              [
            'attribute'=>'membro_circulo',
            'value'=>'cCirculo.name',
            'filter'=> ArrayHelper::map(ComiteCirculos::find()->orderBy('name ASC')->asArray()->all(), 'id', 'name')
          ],
          */         [
            'attribute'=>'membro_celula',
            'value'=>'cCelula.name',
            'filter'=> ArrayHelper::map(ComiteCelulas::find()->orderBy('name ASC')->asArray()->all(), 'id', 'name')
          ],

      
    ['attribute' => 'emp_firstname',
      'label'=>'Nome do Membro',
      'format' => 'raw',
      'value' => function ($model) {
        return  $model->emp_firstname.' '.$model->emp_middle_name.' '.$model->emp_lastname;
      },
    ],
         [
           'attribute'=>'emp_gender',
            'filter'=>array("1"=>"M","2"=>"F"),
            'value' => function ($model) {
        return  $model->emp_gender==1 ? "M": "F";
      },
        ],

                 [
           'attribute'=> 'member_id',
           'label'=>'Nº Cartão',
            'value' => function ($model) {
        return  $model->member_id>0 ? $model->member_id: "-";
      },
        ],
       


         [
           'attribute'=>'emp_birthday',
           'label'=>'idade',
            'value' => function ($model) {
        $newDate = substr(date($model->emp_birthday, strtotime($model->emp_birthday)),-4);

       return  date("Y")-$newDate." anos";
      },
        ],
           /* 'emp_firstname',

            'emp_middle_name',
            'emp_lastname',
            
            'emp_birthday',*/
      
            // 
            // 'emp_nick_name',
            // 'emp_smoker',
            // 'ethnic_race_code',
          
          

            ['class' => 'yii\grid\ActionColumn',
            'template'=>'{view} {update} {delete}',
                            'buttons'=>[
                              'create' => function ($url, $model) {     
                                return Html::a('<span class="glyphicon glyphicon-plus"></span>', $url, [
                                        'title' => Yii::t('yii', 'Create'),
                                ]);                                
            
                              }
                          ]/**/],
        ],

    ]); ?>
   <p>
     <?= Html::a('<i class="glyphicon glyphicon-home"></i>', ['site/index'], ['class' => 'btn btn-danger']) ?>    
        <?= Html::a('<i class="fa fa-plus"></i> Novo Beneficiário', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

</div>
</div>


</div>

