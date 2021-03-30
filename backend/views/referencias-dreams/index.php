<?php

use yii\helpers\Html;
use yii\grid\GridView;


use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
use app\models\Utilizadores;
use app\models\ReferenciasDreams;

//05 11 2018 Actualizado em Pemba
use app\models\ReferenciasServicosReferidos;
use app\models\ServicosBeneficiados;
use app\models\Organizacoes;
//use app\models\Provincias;
use app\models\Distritos;
//use app\models\Beneficiarios;





use common\models\User;
use dektrium\user\models\Profile;
use kartik\widgets\DepDrop;

use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ReferenciasDreamsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


//seleciona todos os utilizadores da sua provincia


if (isset(Yii::$app->user->identity->provin_code)&&Yii::$app->user->identity->provin_code>0)
{
$provs=User::find()->where(['provin_code'=>(int)Yii::$app->user->identity->provin_code])->asArray()->all();
$prov = ArrayHelper::getColumn($provs, 'id');

$dists=Distritos::find()->where(['province_code'=>(int)Yii::$app->user->identity->provin_code])->asArray()->all();
$dist=ArrayHelper::getColumn($dists, 'district_code');




$users=ReferenciasDreams::find()->where(['IN','criado_por',$prov])->andWhere(['=', 'status', 1])->asArray()->all();
$users2=ReferenciasDreams::find()->where(['IN','notificar_ao',$prov])->andWhere(['=', 'status', 1])->asArray()->all();
//added on 05 11 2018
$orgs=Organizacoes::find()->where(['IN','distrito_id',$dist])->where(['=', 'status', 1])->orderBy('parceria_id ASC')->asArray()->all();

} else {
$users=ReferenciasDreams::find()->asArray()->where(['=', 'status', 1])->all();
$users2=ReferenciasDreams::find()->asArray()->where(['=', 'status', 1])->all();
$orgs=Organizacoes::find()->where(['=', 'status', 1])->orderBy('parceria_id ASC')->asArray()->all();
}


$orgs=Organizacoes::find()->where(['=', 'status', 1])->orderBy('parceria_id ASC')->asArray()->all();
$org=ArrayHelper::getColumn($orgs, 'id');


$ids = ArrayHelper::getColumn($users, 'criado_por');
$notify_to = ArrayHelper::getColumn($users2, 'notificar_ao');


$this->title = Yii::t('app', 'Referências e Contra-Referências');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="referencias-dreams-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>




    <table width="100%"   class="table table-bordered  table-condensed">
      <tr>
        <td   bgcolor="#261657" bgcolor="" align="center"><font color="#fff" size="+1"><b>

          <span class="fa fa-exchange" aria-hidden="true"></span> Lista de Referências e Contra-Referências
            </b></font></td>
        </tr>
      <tr>
        <td   bgcolor="#808080" align="center">
          <font color="#fff" size="+1"><b>
          </b></font>    </td>
        </tr>
      </table>





    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

         //   'criado_em',
	['attribute'=> 'criado_em',
'format' => 'html',
 'value' => function ($model) {
	
return date($model->criado_em);
},
],		
			
			
            'nota_referencia',
        /*    [
'attribute' => 'beneficiario_id',
'format'=>'raw',
'value' => $model->beneficiario->distrito['cod_distrito'].'/'.$model->beneficiario['member_id'],
],*/

['attribute'=> 'beneficiario_id',
'format' => 'html',
'label'=>'Código do Beneficiário',
 'value' => function ($model) {
if(isset($model->beneficiario->distrito['cod_distrito'])&&$model->beneficiario->distrito['cod_distrito']>0) {
return  $model->beneficiario_id>0 ?  '<font color="#cd2660">'.$model->beneficiario->distrito['cod_distrito'].'/'.$model->beneficiario['member_id'].'</font>': '-';
}//end if else 
{return '-'.'/'.$model->beneficiario['member_id'];}
},
],

          //  'name',
          //  'projecto',
			 [
            'attribute'=>'referido_por',
            'format' => 'html',
            'value' => function ($model) {
           return  $model->beneficiario_id>0 ?  '<font color="#cd2660"><b>'.$model->nreferente['name'].'</b></font>': "-";
           },
            'filter'=>ArrayHelper::map(
              Profile::find()
            ->where(['IN','user_id',$ids])
            ->andWhere(['<>','name',''])
            ->orderBy('name ASC')
            ->all(), 'user_id', 'name'
        ),
            ],

[
          //  'attribute'=>'referido_por',
            'format' => 'html',
		'label'=>'Contacto',
            'value' => function ($model) {
           return  $model->beneficiario_id>0 ?  '<font color="#cd2660"><b>'.$model->referente['phone_number'].'</b></font>': "-";
           },
            ],

[
                 'attribute'=>'notificar_ao',
                 'format' => 'html',
                 'value' => function ($model) {
$utils=Profile::find()->where(['=','id',$model->notificar_ao])->all();
                  foreach ($utils as $util) {
                    return  $model->beneficiario_id>0 ?  '<font color="#cd2660"><b>'.$util->name.'</b></font>': "-";
                  }   

            // return  $model->beneficiario_id>0 ?  '<font color="#cd2660"><b>'.$model->notificar_ao.'</b></font>': "-";
                },
                 'filter'=>ArrayHelper::map(
                   Profile::find()
                 ->where(['IN','user_id',$ids])
                 ->andWhere(['<>','name',''])
                 ->orderBy('name ASC')
                 ->all(), 'id', 'name'
             ),
                 ],

[
          'attribute'=>'refer_to',
          'label'=>'Ref. Para',
          'format' => 'html',
          'value' => function ($model) {
         return  $model->refer_to;
       },
         'filter'=>array("US"=>"US","CM"=>"CM","ES"=>"ES"),

       ],
 [
                 'attribute'=>'projecto',
                 'format' => 'html',
                 'value' => function ($model) {
                return  $model->organizacao['name'];
                },
                 'filter'=>ArrayHelper::map(
                   Organizacoes::find()
                 ->where(['IN','id',$org])
                 ->andWhere(['<>','status','0'])
                 ->orderBy('distrito_id ASC')
                 ->all(), 'id', 'name'
             ),],

  ['attribute'=> 'status_ref',
                    'format' => 'html',
                     'value' => function ($model) {
        $query = ReferenciasServicosReferidos::find()
                                                      ->where(['=','referencia_id',$model->id])
                                                      ->orderBy('id ASC')
                                                      ->all();
                                      $servs=ArrayHelper::getColumn($query,'servico_id');
                                      $conta= ServicosBeneficiados::find()
                                                          ->where(['=','beneficiario_id',$model->beneficiario_id])
                                                          ->andWhere(['status' => 1])
                                                          ->andWhere(['IN','servico_id', $servs])
                                                          ->exists();
                                    if($conta>0) {

                                      // UPDATE
                                      $connection = Yii::$app->db;
                                      $connection->createCommand()
                                      ->update('app_dream_referencias', ['status_ref' => 1],['id'=>$model->id])
                                      ->execute();

                                      return '<font color="green"><b>Atendido</b></font>'; } else

                                      {return '<font color="red">Pendente</font>';}
       },
       'filter'=>array("1"=>"Atendido","0"=>"Pendente"),
                    ],

           //  'description',
/*			['attribute'=> 'status',
             'format' => 'html',
          //   'label'=>'Estado',
              'value' => function ($model) {
             //return  $model->status==1 ?  '<font color="green"><b>Referido</b></font>': '<font color="red">Pendente</font>';

 $query = ReferenciasServicosReferidos::find()
                                               ->where(['=','referencia_id',$model->id])
                                               ->orderBy('id ASC')
                                               ->all();
                               $servs=ArrayHelper::getColumn($query,'servico_id');
                               $conta= ServicosBeneficiados::find()
                                                   ->where(['=','beneficiario_id',$model->beneficiario_id])
                                                   ->andWhere(['status' => 1])
                                                   ->andWhere(['IN','servico_id', $servs])
                                                   ->exists();
                             if($conta>0) {return '<font color="green"><b>Atendido</b></font>'; } else

                               {return '<font color="red">Pendente</font>';}


},
'filter'=>array("1"=>"Atendido","0"=>"Pendente"),
             ], */



            // 'criado_por',
            // 'actualizado_por',
            // 'criado_em',
            // 'actualizado_em',
            // 'user_location',
            // 'user_location2',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <p>
        <?php Html::a(Yii::t('app', 'Create Referencias Dreams'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
</div>
