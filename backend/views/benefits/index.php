<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use app\models\Us;
use app\models\ServicosBeneficiados;
use yii\widgets\Pjax;

use kartik\grid\EditableColumn;
use app\models\ServicosDream;
use app\models\Utilizadores;
use app\models\ReferenciasDreams;
use app\models\Distritos;
use app\models\Bairros;
/* @var $this yii\web\View */
/* @var $searchModel app\models\BenefsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'LISTA DE BENEFICIÁRIOS DREAMS');
$this->params['breadcrumbs'][] = $this->title;





function core($k){

$cors = ServicosDream::find()->where(['=','core_service',1])->distinct()->all();
$coreServicos=0;
foreach($cors as $cor) {
  $coreServicos = $coreServicos+ServicosBeneficiados::find()
   ->where(['=','beneficiario_id',intval($k)])
   ->andWhere(['=', 'servico_id', intval($cor->id)])
   ->andWhere(['=', 'status', 1])
   ->select('servico_id')->distinct()
   ->count();
}
return $coreServicos;
}


?>
<div class="benefs-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php // Html::a(Yii::t('app', 'Create Benefs'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

          [
                 'attribute'=>'district_code',
              'format'=>'raw',
              'value' => function ($model) {
            return  $model->district_code==NULL ? '-': $model->distrito['district_name'];
            },
                 'filter'=> ArrayHelper::map(Distritos::find()->where(['>','province_code','0'])->orderBy('province_code,district_name ASC')->all(), 'district_code', 'district_name'),

               ],

            [
              'attribute'=>'bairro_id',
              'format' => 'raw',
               'value' => function ($model) {
            return  $model->bairro_id==NULL ? '-': $model->bairros['name'];
            },
            'filter'=> ArrayHelper::map(Bairros::find()->where(['>','distrito_id','0'])->orderBy('distrito_id,distrito_id ASC')->all(), 'id', 'name'),
            ],
          
            [
   'attribute'=> 'member_id',
'format' => 'html',
   'label'=>'Código do Beneficiário',
    'value' => function ($model) {
return  $model->member_id>0 ?  '<font color="#cd2660"><b>'.$model->distrito['cod_distrito'].'/'.$model->member_id.'</b></font>': "-";
},
],

['attribute' => 'emp_firstname',
'label'=>'Nome do Beneficiário',
'format' => 'raw',
'value' => function ($model) {
return  Yii::$app->user->identity->role==20 ?  $model->emp_firstname.' '.$model->emp_middle_name.' '.$model->emp_lastname: "<font color=#261657><b>DREAMS</b></font><span class='label label-success'><font size=+1>".intval($model->member_id)."</font></span>";
},
],
 [
   'attribute'=>'emp_gender',
'format' => 'raw',
    'filter'=>array("1"=>"M","2"=>"F"),
    'value' => function ($model) {
return  $model->emp_gender==1 ? '<i class="fa fa-male"></i>': '<i class="fa fa-female"></i>';
},
],

[
   'attribute'=>'ponto_entrada',
'format' => 'raw',
'label'=>'PE',
    'filter'=>array("1"=>"US","2"=>"CM","3"=>"ES"),
    'value' => function ($model) {
//	return $model->ponto_entrada;
  if($model->ponto_entrada==1) {return "US";} elseif($model->ponto_entrada==2){return "CM";} else {return "ES";}
},
],

[
'attribute'=> 'criado_em',
'format' => 'html',
'label'=>'Data Criação',
'value' => function ($model) {
return  substr($model->criado_em,0,10);
},
],

[
  'label'=>'#Interv',
  'format' => 'html',
  'filter'=>array("0"=>"0","5"=>"5"),
  'value' => function ($model) {
  $conta = ServicosBeneficiados::find()->where(['beneficiario_id' => $model->id])->andWhere(['=', 'status', 1])->distinct()->count();
if($conta==0){return  '<span class="label label-danger"> <i class="fa fa-medkit"></i>&nbsp;['.$conta.']</span>';}
  elseif ($conta<5) {return  '<span class="label label-warning"> <i class="fa fa-medkit"></i>&nbsp;['.$conta.']</span>';}
  elseif ($conta<10) {return  '<span class="label label-info"> <i class="fa fa-medkit"></i>&nbsp;['.$conta.']</span>';}
  else {
    return  '<span class="label label-success"> <i class="fa fa-medkit"></i>&nbsp;['.$conta.']</span>';}
  },
 'headerOptions' => ['style' => 'text-align:center;color:#337ab7'],
],

[
  'label'=>'CLI',
  'format' => 'html',
  'filter'=>array("0"=>"0","5"=>"5"),
  'value' => function ($model) {
  $clinicos= ArrayHelper::toArray(ServicosDream::find('id')->where(['servico_id' => 1])->andWhere(['status'=>1])->asArray()->all());
  $conta = ServicosBeneficiados::find()->where(['beneficiario_id' => $model->id])
  ->andWhere(['IN','servico_id', $clinicos])
  ->andWhere(['=', 'status', 1])->count();
if($conta==0){return  '<span class="label label-danger"> <i class="fa fa-medkit"></i>&nbsp;['.$conta.']</span>';}
  elseif ($conta<5) {return  '<span class="label label-warning"> <i class="fa fa-medkit"></i>&nbsp;['.$conta.']</span>';}
  elseif ($conta<10) {return  '<span class="label label-info"> <i class="fa fa-medkit"></i>&nbsp;['.$conta.']</span>';}
  else {
    return  '<span class="label label-success"> <i class="fa fa-medkit"></i>&nbsp;['.$conta.']</span>';}
  },
 'headerOptions' => ['style' => 'text-align:center;color:#337ab7'],
],
[
  'label'=>'CM',
  'format' => 'html',
  'filter'=>array("0"=>"0","5"=>"5"),
  'value' => function ($model) {
$com= ArrayHelper::toArray(ServicosDream::find('id')->where(['servico_id' => 2])->andWhere(['status'=>1])->distinct('id')->asArray()->all());

  $conta = ServicosBeneficiados::find()->where(['beneficiario_id' => $model->id])
  ->andWhere(['IN','servico_id',$com])
  ->andWhere(['=', 'status', 1])->distinct()->count();
if($conta==0){return  '<span class="label label-danger"> <i class="fa fa-medkit"></i>&nbsp;['.$conta.']</span>';}
  elseif ($conta<5) {return  '<span class="label label-warning"> <i class="fa fa-medkit"></i>&nbsp;['.$conta.']</span>';}
  elseif ($conta<10) {return  '<span class="label label-info"> <i class="fa fa-medkit"></i>&nbsp;['.$conta.']</span>';}
  else {
    return  '<span class="label label-success"> <i class="fa fa-medkit"></i>&nbsp;['.$conta.']</span>';}
  },
 'headerOptions' => ['style' => 'text-align:center;color:#337ab7'],
],

[
     'attribute'=>'criado_por',
  'format'=>'raw',
     'value'=> function ($model) { return Yii::$app->user->identity->role==20 ? '<small>'.$model->user['username'].'</small>':'<small>'.$model->user['username'].'</small>'; },
     'filter'=> ArrayHelper::map(Utilizadores::find()->where(['>','provin_code',0])->distinct()->orderBy('username ASC')->asArray()->all(), 'id', 'username'),

   ],


            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
