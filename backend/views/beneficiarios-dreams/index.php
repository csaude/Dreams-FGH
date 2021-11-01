<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use app\models\Organizacoes;

use yii\helpers\ArrayHelper;
use app\models\ComiteZonal;
use app\models\ComiteDistrital;
use kartik\select2\Select2;
use app\models\ComiteLocalidades;
use app\models\ComiteCirculos;
use app\models\ComiteCelulas;
use app\models\Us;
use app\models\ServicosBeneficiados;

use kartik\grid\EditableColumn;
use app\models\ServicosDream;
use app\models\Utilizadores;
use common\models\User;

use app\models\ReferenciasDreams;
use app\models\Distritos;
use app\models\Bairros;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BeneficiariosDreamsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Lista de Raparigas DREAMS Activas');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="beneficiarios-dreams-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php Html::a(Yii::t('app', 'Create Beneficiarios Dreams'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
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
            'filter'=> ArrayHelper::map(
               Distritos::find()
              ->where(['IN','district_code',$dist])
              ->orderBy('province_code,district_name ASC')->all(),
              'district_code', 'district_name'),
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
      'attribute'=>'ponto_entrada',
  'format' => 'raw',
  'label'=>'PE',
       'filter'=>array("1"=>"US","2"=>"CM","3"=>"ES"),
       'value' => function ($model) {
     if($model->ponto_entrada==1) {return "US";} elseif($model->ponto_entrada==2){return "CM";} else {return "ES";}
  },
   ],         
 //servicos recebidos
          
  [
            'attribute'=>'criado_por',
			'label'=>'Org',
			'format'=>'html',
            'value'=> function ($model) { return Yii::$app->user->identity->role==20 ? '<small>'.$model->user->parceiro['name'].'</small>':'<small>'.$model->user->parceiro['name'].'</small>'; },
            'filter'=>ArrayHelper::map(
              Organizacoes::find()
                ->where(['IN','id',$org])
                ->orderBy('distrito_id ASC')
                ->all(), 'id', 'name'
            ),
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
                    'filter'=>array("2"=>"F"),
                    'value' => function ($model) {
                return  $model->emp_gender==1 ? '<i class="fa fa-male"></i><span style="display:none !important">M</span>': '<i class="fa fa-female"></i><span style="display:none !important">F</span>';
              },
                ],
          
     [
       'attribute'=>'emp_birthday',
       'label'=>'idade',
       'filter'=>array(
         ""=>"Todos",
         "2009"=>"10",
         "2008"=>"11",
         "2007"=>"12",
         "2006"=>"13",
         "2005"=>"14",
         "2004"=>"15",
         "2003"=>"16",
         "2002"=>"17",
         "2001"=>"18",
         "2000"=>"19",
         "1999"=>"20",
         "1998"=>"21",
         "1997"=>"22",
         "1996"=>"23",
         "1995"=>"24",
         "1994"=>"25",
         "1993"=>"26",
         "1992"=>"27",

       ),
        'value' => function ($model) {
if(!$model->emp_birthday==NULL) {
    $newDate = substr(date($model->emp_birthday, strtotime($model->emp_birthday)),-4);

   return  date("Y")-$newDate." anos";} else {
return  $model->idade_anos." anos";
}
  },
    ],
          

               /* [
                  'attribute'=>'emp_birthday',
                  'label'=>'idade',
                   'value' => function ($model) {
           if(!$model->emp_birthday==NULL) {
               $newDate = substr(date($model->emp_birthday, strtotime($model->emp_birthday)),-4);

              return  date("Y")-$newDate." anos";} else {
           return  $model->idade_anos." anos";
           }
             },
               ],*/
          
               'encarregado_educacao',
          
               [
                 'attribute'=>'encarregado_educacao',
                 'format' => 'raw',
                  'filter'=>array("Pais"=>"Pais","Parceiro"=>"Parceiro","Outros familiares"=>"Outros familiares","Avós"=>"Avós","Sozinho"=>"Sozinho"),
                  'value' => function ($model) {
              return  $model->encarregado_educacao==1 ? '<i class="fa fa-check"></i><span style="display:none !important">S</span>': '<i class="fa fa-times" color="red"></i><span style="display:none !important">N</span>';
            },
              ],          
          
               [
                 'attribute'=>'house_sustainer',
                 'format' => 'raw',
                  'filter'=>array("1"=>"SIM","0"=>"NÃO","NUL"=>"?"),
                  'value' => function ($model) {
              return  $model->house_sustainer==1 ? '<i class="fa fa-check"></i><span style="display:none !important">S</span>': '<i class="fa fa-times" color="red"></i><span style="display:none !important">N</span>';
            },
              ],
              [
                'attribute'=>'estudante',
                'format' => 'raw',
                 'filter'=>array("1"=>"SIM","0"=>"NÃO","NUL"=>"?"),
                 'value' => function ($model) {
             return  $model->estudante==1 ? '<i class="fa fa-check"></i><span style="display:none !important">S</span>': '<i class="fa fa-times" color="red"></i><span style="display:none !important">N</span>';
             },
             ],
             [
               'attribute'=>'deficiencia',
               'format' => 'raw',
                'filter'=>array("1"=>"SIM","0"=>"NÃO","NUL"=>"?"),
                'value' => function ($model) {
            return  $model->deficiencia==1 ? '<i class="fa fa-check"></i><span style="display:none !important">S</span>': '<i class="fa fa-times" color="red"></i><span style="display:none !important">N</span>';
            },
            ],
               'deficiencia_tipo',
               [
                 'attribute'=>'gravida',
                 'format' => 'raw',
                  'filter'=>array("1"=>"SIM","0"=>"NÃO","NUL"=>"?"),
                  'value' => function ($model) {
              return  $model->gravida==1 ? '<i class="fa fa-check"></i><span style="display:none !important">S</span>': '<i class="fa fa-times" color="red"></i><span style="display:none !important">N</span>';
              },
              ],
               'filhos',



                [
                  'attribute'=>'married_before',
                  'format' => 'raw',
                   'filter'=>array("1"=>"SIM","0"=>"NÃO","NUL"=>"?"),
                   'value' => function ($model) {
               return  $model->married_before==1 ? '<i class="fa fa-check"></i><span style="display:none !important">S</span>': '<i class="fa fa-times" color="red"></i><span style="display:none !important">N</span>';
             },
               ],

               [
                 'attribute'=>'pregant_or_breastfeed',
                 'format' => 'raw',
                  'filter'=>array("1"=>"SIM","0"=>"NÃO","NUL"=>"?"),
                  'value' => function ($model) {
              return  $model->pregant_or_breastfeed==1 ? '<i class="fa fa-check"></i><span style="display:none !important">S</span>': '<i class="fa fa-times" color="red"></i><span style="display:none !important">N</span>';
            },
              ],

              [
                'attribute'=>'employed',
                'format' => 'raw',
                 'filter'=>array("1"=>"SIM (Empregada Doméstica)","2"=>"SIM (Babá-Cuida das Crianças)","3"=>"SIM (Outros)","0"=>"NAO", "NULL"=>"?"),
                 'value' => function ($model) {
//		return   $model->employed==='0' ? 'NAO': $model->employed==="NULL" ? '?': 'SIM';
 return  $model->employed>0 ? '<i class="fa fa-check"></i><span style="display:none !important">S</span>': '<i class="fa fa-times" color="red"></i><span style="display:none !important">N</span>';
           },
             ],

             [
               'attribute'=>'tested_hiv',
               'format' => 'raw',
                'filter'=>array("1"=>"SIM (>3 meses)","2"=>"SIM (<3 meses)","0"=>"NÃO"),
                'value' => function ($model) {
            return  $model->tested_hiv==1 ? '<i class="fa fa-check"></i><span style="display:none !important">S</span>': '<i class="fa fa-times" color="red"></i><span style="display:none !important">N</span>';
          },
            ],

            [
              'attribute'=>'vbg_exploracao_sexual',
              'format' => 'raw',
               'filter'=>array("1"=>"SIM","0"=>"NÃO","NUL"=>"?"),
               'value' => function ($model) {
            return  $model->vbg_exploracao_sexual==1 ? '<i class="fa fa-check"></i><span style="display:none !important">S</span>': '<i class="fa fa-times" color="red"></i><span style="display:none !important">N</span>';
            },
            ],
            [
              'attribute'=>'vbg_migrante_trafico',
              'format' => 'raw',
               'filter'=>array("1"=>"SIM","0"=>"NÃO","NUL"=>"?"),
               'value' => function ($model) {
           return  $model->vbg_migrante_trafico==1 ? '<i class="fa fa-check"></i><span style="display:none !important">S</span>': '<i class="fa fa-times" color="red"></i><span style="display:none !important">N</span>';
         },
           ],
           [
             'attribute'=>'vbg_vitima_trafico',
             'format' => 'raw',
              'filter'=>array("1"=>"SIM","0"=>"NÃO","NUL"=>"?"),
              'value' => function ($model) {
          return  $model->vbg_vitima_trafico==1 ? '<i class="fa fa-check"></i><span style="display:none !important">S</span>': '<i class="fa fa-times" color="red"></i><span style="display:none !important">N</span>';
        },
          ],
           [
             'attribute'=>'vbg_sexual_activa',
             'format' => 'raw',

              'filter'=>array("1"=>"SIM","0"=>"NÃO","NUL"=>"?"),
              'value' => function ($model) {
          return  $model->vbg_sexual_activa==1 ? '<i class="fa fa-check"></i><span style="display:none !important">S</span>': '<i class="fa fa-times" color="red"></i><span style="display:none !important">N</span>';
        },
          ],
          [
            'attribute'=>'vbg_relacao_multipla',
            'format' => 'raw',
             'filter'=>array("1"=>"SIM","0"=>"NÃO","NUL"=>"?"),
             'value' => function ($model) {
         return  $model->vbg_relacao_multipla==1 ? '<i class="fa fa-check"></i><span style="display:none !important">S</span>': '<i class="fa fa-times" color="red"></i><span style="display:none !important">N</span>';
       },
         ],
         [
           'attribute'=>'vbg_vitima',
           'label'=>'Vítima de VBG?',
           'format' => 'raw',
            'filter'=>array("1"=>"SIM","0"=>"NÃO",""=>"?"),
            'value' => function ($model) {
            return  $model->vbg_vitima==1 ? '<i class="fa fa-check"></i><span style="display:none !important">S</span>': '<i class="fa fa-times" color="red"></i><span style="display:none !important">N</span>';
          }, 
        ],
        [
          'attribute'=>'alcohol_drugs_use',
          'label'=>'Uso de Álcool e Drogas?',
          'format' => 'raw',
           'filter'=>array("1"=>"SIM","0"=>"NÃO",""=>"?"),
           'value' => function ($model) {
              return  $model->alcohol_drugs_use==1 ? '<i class="fa fa-check"></i><span style="display:none !important">S</span>': '<i class="fa fa-times" color="red"></i><span style="display:none !important">N</span>';
            }, 
        ],
        [
          'attribute'=>'sti_history',
          'label'=>'Histórico de ITS?',
          'format' => 'raw',
           'filter'=>array("1"=>"SIM","0"=>"NÃO",""=>"?"),
           'value' => function ($model) {
              return  $model->sti_history==1 ? '<i class="fa fa-check"></i><span style="display:none !important">S</span>': '<i class="fa fa-times" color="red"></i><span style="display:none !important">N</span>';
            }, 
        ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?>
<?= Html::submitButton('<i class="fa fa-6 fa-female" aria-hidden="true"></i> Lista de Beneficiários DREAMS', ['class' => 'btn btn-success', 'disabled'=>true]) ?>

</div>
