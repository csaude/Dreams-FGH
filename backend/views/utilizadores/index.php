<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;


use yii\helpers\ArrayHelper;
use app\models\Us;
use app\models\Provincias;
use app\models\Distritos;
use app\models\ComiteLocalidades;
use app\models\Organizacoes;
/* @var $this yii\web\View */
/* @var $searchModel app\models\UtilizadoresSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Utilizadores');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="utilizadores-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php Html::a(Yii::t('app', 'Create Utilizadores'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'id',
//'role',
[
                'attribute'=>'role',
             'format' => 'raw',
                 'filter'=>array(
                   "20"=>"Admin",
                   "15"=>"Gestor de Caso",
                   "17"=>"Coordenador",
                   "18"=>"Supervisor",
                   "7"=>"Activista",
                   "8"=>"Educador de Par",
                   "9"=>"Digitador",
                   "11"=>"Mentor",
                   "12"=>"Enfermeira",
                   "13"=>"Monitoria e Avaliação",
                   "14"=>"Doador",
                   "10"=>"Outros",
                 ),
                 'value' => function ($model) {
          //    return $model->role;

if($model->role==10) {return "Outros";}
elseif($model->role==20){return "Administrador";}
elseif($model->role==15){return "Gestor de Caso";}
elseif($model->role==17){return "Coordenador";}
elseif($model->role==18){return "Supervisor";}
elseif($model->role==14){return "Doador";}
elseif($model->role==13){return "Monitoria e Avaliação";}
elseif($model->role==12){return "Enfermeira";}
elseif($model->role==11){return "Mentor";}
elseif($model->role==9){return "Digitador";}
elseif($model->role==8){return "Educador de Par";}
elseif($model->role==7){return "Activista";}


             },
             ],
//'status',
  [
               'attribute'=>'status',
            'format' => 'raw',
                'filter'=>array("10"=>"ACTIVO","0"=>"INACTIVO"),
                'value' => function ($model) {
            if($model->status==0) {return "INACTIVO";} elseif($model->status==10){return "ACTIVO";}
            },
            ],
 
'username',
            //'email:email',
            //'name',
[
                'attribute'=>'name',
                'value'=>'nome.name',
              ],
[
                'attribute'=>'provin_code',
                'value'=>'provincia.province_name',
                'filter'=> ArrayHelper::map(Provincias::find()->where(['status'=>1])->orderBy('province_name ASC')->asArray()->all(), 'id', 'province_name')
              ],
            [
                'attribute'=>'district_code',
                'value'=>'distrito.district_name',
                'filter'=> ArrayHelper::map(Distritos::find()->orderBy('district_name ASC')->asArray()->all(), 'district_code', 'district_name')
              ],
              [
                  'attribute'=>'localidade_id',
                  'value'=>'localidade.name',
                  'filter'=> ArrayHelper::map(ComiteLocalidades::find()->orderBy('name ASC')->asArray()->all(), 'id', 'name')
                ],
                  [
                     'attribute'=>'entry_point',
                 'format' => 'raw',
                      'filter'=>array("1"=>"US","2"=>"CM","3"=>"ES"),
                      'value' => function ($model) {
                          if($model->entry_point==1) {return "US";} elseif($model->entry_point==2){return "CM";} else {return "ES";}

               },
                  ],

                [
                    'attribute'=>'us_id',
                    'value'=>'us.name',
                    'filter'=> ArrayHelper::map(Us::find()->orderBy('name ASC')->asArray()->all(), 'id', 'name')
                  ],
                  [
                      'attribute'=>'parceiro_id',
                      'value'=>'parceiro.name',
                      'filter'=> ArrayHelper::map(Organizacoes::find()->orderBy('name ASC')->asArray()->all(), 'id', 'name')
                    ],
             [
                'attribute'=>'ccord_id',
            'format' => 'raw',
                 'filter'=>array("0"=>"NÃO","1"=>"SIM"),
                 'value' => function ($model) {
if($model->ccord_id==0) {return "NÃO";} elseif($model->ccord_id==1){return "SIM";}
          },
             ],
'email:email',
'phone_number',
            // 'status', 
            // 'created_at',
            // 'updated_at',
            // 'confirmed_at',
            // 'blocked_at',
            // 'confirmation_token',
            // 'confirmation_sent_at',
            // 'unconfirmed_email:email',
            // 'recovery_token',
            // 'recovery_sent_at',
            // 'registered_from',
            // 'logged_in_from',
            // 'logged_in_at',
            // 'registration_ip',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
