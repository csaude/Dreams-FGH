<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use app\models\ComiteZonal;
use app\models\ComiteDistrital;
use kartik\select2\Select2;
use app\models\ComiteLocalidades;
use app\models\ComiteCirculos;
use app\models\ComiteCelulas;
use app\models\Us;
use app\models\ServicosBeneficiados;
use yii\widgets\Pjax;

use kartik\grid\EditableColumn;
use app\models\ServicosDream;
use app\models\ReferenciasDreams;
use app\models\Distritos;
use app\models\Bairros;


$this->title = 'Beneficiários DREAMS';
$this->params['breadcrumbs'][] = $this->title;

?>
<?php $this->registerJsFile('/app/dreams.co.mz/backend/web/css/bootstrap/js/popover.js', [yii\web\JqueryAsset::className()]); ?>
<div class="beneficiarios-filtros">
    <?php Html::encode($this->title) ?>


    </h2>


<?php Pjax::begin(['enablePushState'=>false]); ?>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        [
'attribute'=> 'member_id',
'format' => 'html',
'label'=>'Código do Beneficiário',
'value' => function ($model) {
return  $model->member_id>0 ?  '<font color="#cd2660"><b>'.$model->distrito['cod_distrito'].'/'.$model->member_id.'</b></font>': "-";
},
],

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
          'attribute'=>'emp_gender',
          'format' => 'raw',
           'filter'=>array("1"=>"M","2"=>"F"),
           'value' => function ($model) {
       return  $model->emp_gender==1 ? '<i class="fa fa-male"></i><span style="display:none !important">M</span>': '<i class="fa fa-female"></i><span style="display:none !important">F</span>';
     },
       ],
       [
      'attribute'=>'ponto_entrada',
  'format' => 'raw',
  'label'=>'PE',
       'filter'=>array("1"=>"US","2"=>"CM","3"=>"ES"),
       'value' => function ($model) {
     if($model->ponto_entrada==1) {return "US";} elseif($model->ponto_entrada==2){return "CM";} else {return "ES";}
  },
   ],

  /*     [
         'attribute'=>'emp_birthday',
         'label'=>'Idade Min',
          'value' => function ($model) {
  if(!$model->emp_birthday==NULL) {
      $newDate = substr(date($model->emp_birthday, strtotime($model->emp_birthday)),-4);

     return  date("Y")-$newDate;} else {
  return  $model->idade_anos;
  }
    },
  ],*/

      [
        'attribute'=>'emp_birthday',
        'label'=>'Idade Max',
         'value' => function ($model) {
 if(!$model->emp_birthday==NULL) {
     $newDate = substr(date($model->emp_birthday, strtotime($model->emp_birthday)),-4);

    return  date("Y")-$newDate;} else {
 return  $model->idade_anos;
 }
   },
     ],


       [
         'attribute'=>'criado_em',
         'label'=>'Mês',
'value' => function ($model) {
  return  date("m", strtotime($model->criado_em));
},
      ],
       [
         'attribute'=>'criado_em',
         'label'=>'Ano',
          'value' => function ($model) {
return  date("Y", strtotime($model->criado_em));
    },
      ],
      [
      'attribute'=>'estudante',
      'format' => 'raw',
      'label'=>'Estudante',
      'filter'=>array("1"=>"SIM","0"=>"NÃO"),
      'value' => function ($model) {
      if($model->estudante==1) {return "SIM";} else {return "NÃO";}
      },
      ],
      [
      'attribute'=>'deficiencia',
      'format' => 'raw',
      'filter'=>array("1"=>"SIM","0"=>"NÃO"),
      'value' => function ($model) {
      if($model->deficiencia==1) {return "SIM";} else {return "NÃO";}
      },
      ],
      [
      'attribute'=>'gravida',
      'format' => 'raw',
      'filter'=>array("1"=>"SIM","0"=>"NÃO"),
      'value' => function ($model) {
      if($model->gravida==1) {return "SIM";} else {return "NÃO";}
      },
      ],
      [
      'attribute'=>'filhos',
      'format' => 'raw',
      'filter'=>array("1"=>"SIM","0"=>"NÃO"),
      'value' => function ($model) {
      if($model->filhos==1) {return "SIM";} else {return "NÃO";}
      },
      ],
      [
      'attribute'=>'parceiro_id',
      'format' => 'raw',
	  'label'=>'Tem Parceiro',
      'filter'=>array("1"=>"SIM",NULL=>"NÃO"),
      'value' => function ($model) {
      if($model->parceiro_id==NULL) {return "NÃO";} else {return "SIM";}


      },
      ],
[
  'label'=>'INTCLI',
  'format' => 'raw',
  'value' => function ($model) {
  $conta = ServicosBeneficiados::find()->where(['beneficiario_id' => $model->id])->andWhere(['IN','servico_id', [1,2,3,4,5,6,7,8,9,10,28,29,30]])
->distinct()->count();
if($conta==0){return  '<span class="label label-danger"> <i class="fa fa-medkit"></i>&nbsp;['.$conta.']</span>';}
  elseif ($conta<5) {return  '<span class="label label-warning"> <i class="fa fa-medkit"></i>&nbsp;['.$conta.']</span>';}
  elseif ($conta<10) {return  '<span class="label label-info"> <i class="fa fa-medkit"></i>&nbsp;['.$conta.']</span>';}
  else {
    return  '<span class="label label-success"> <i class="fa fa-medkit"></i>&nbsp;['.$conta.']</span>';}
  },
'filter'=>array("0"=>"0","5"=>"5"),
 'headerOptions' => ['style' => 'text-align:center;color:#337ab7'],
],
[
  'label'=>'INTCOM',
  'format' => 'raw',
  'value' => function ($model) {
  $conta = ServicosBeneficiados::find()->where(['beneficiario_id' => $model->id])
->andWhere(['NOT IN','servico_id', [1,2,3,4,5,6,7,8,9,10,28,29,30]])
->distinct()->count();
if($conta==0){return  '<span class="label label-danger"> <i class="fa fa-medkit"></i>&nbsp;['.$conta.']</span>';}
  elseif ($conta<5) {return  '<span class="label label-warning"> <i class="fa fa-medkit"></i>&nbsp;['.$conta.']</span>';}
  elseif ($conta<10) {return  '<span class="label label-info"> <i class="fa fa-medkit"></i>&nbsp;['.$conta.']</span>';}
  else {
    return  '<span class="label label-success"> <i class="fa fa-medkit"></i>&nbsp;['.$conta.']</span>';}
  },
'filter'=>array("0"=>"0","5"=>"5"),
 'headerOptions' => ['style' => 'text-align:center;color:#337ab7'],
],
[
  'label'=>'TRef',
  'format' => 'raw',
  'value' => function ($model) {
  $conta = ReferenciasDreams::find()->where(['beneficiario_id' => $model->id])->distinct()->count();
if($conta==0){return  '<span class="label label-danger"> <i class="fa fa-medkit"></i>&nbsp;['.$conta.']</span>';}
  elseif ($conta<5) {return  '<span class="label label-warning"> <i class="fa fa-medkit"></i>&nbsp;['.$conta.']</span>';}
  elseif ($conta<10) {return  '<span class="label label-info"> <i class="fa fa-medkit"></i>&nbsp;['.$conta.']</span>';}
  else {
    return  '<span class="label label-success"> <i class="fa fa-medkit"></i>&nbsp;['.$conta.']</span>';}
  },
'filter'=>array("0"=>"0","5"=>"5"),
 'headerOptions' => ['style' => 'text-align:center;color:#337ab7'],
],
		
[
  'label'=>'TCRef',
  'format' => 'raw',
   'value' => function ($model) { return '-'; },
 /* 'value' => function ($model) {
  $conta = ReferenciasDreams::find()->where(['beneficiario_id' => $model->id])->distinct()->count();
if($conta==0){return  '<span class="label label-danger"> <i class="fa fa-medkit"></i>&nbsp;['.$conta.']</span>';}
  elseif ($conta<5) {return  '<span class="label label-warning"> <i class="fa fa-medkit"></i>&nbsp;['.$conta.']</span>';}
  elseif ($conta<10) {return  '<span class="label label-info"> <i class="fa fa-medkit"></i>&nbsp;['.$conta.']</span>';}
  else {
    return  '<span class="label label-success"> <i class="fa fa-medkit"></i>&nbsp;['.$conta.']</span>';}
  },*/
'filter'=>array("0"=>"0","5"=>"5"),
 'headerOptions' => ['style' => 'text-align:center;color:#337ab7'],
],
       ['class' => 'yii\grid\ActionColumn','template'=>'{view} {update}',
                        'buttons'=>[
                          'create' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-plus"></span>', $url, [
                                    'title' => Yii::t('yii', 'Create'),
                            ]);

                          }
                      ]/**/],
    ],
]); ?>




<?php Pjax::end(); ?>



   <p>
     <?= Html::a('<i class="glyphicon glyphicon-home"></i>', ['site/index'], ['class' => 'btn btn-danger']) ?>
    </p>


</div>
</div>

</div>
