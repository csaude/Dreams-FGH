<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;


use yii\helpers\ArrayHelper;

use app\models\ServicosDream;
use app\models\FaixaEtaria;
use app\models\NivelIntervensao;

/* @var $this yii\web\View */
/* @var $searchModel app\models\FaixaEtariaServicoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Faixa Etaria Servicos');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="faixa-etaria-servico-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

          //  'id',
          [
            'attribute'=>'faixa_id',
            'value'=>'faixaEtaria.faixa_etaria',
            'filter'=> ArrayHelper::map(FaixaEtaria::find()->where(['=','status','1'])->orderBy('faixa_etaria ASC')->asArray()->all(), 'id', 'faixa_etaria','nivel_intervencao_id')
          ],

[
          //  'attribute'=>'faixa_id',
            'label'=>'Nivel de Intervencao',
        //    'value'=>'faixaEtaria.nivel_intervencao_id',
            'filter'=> ArrayHelper::map(NivelIntervensao::find()->where(['=','status','1'])->orderBy('id ASC')->asArray()->all(), 'id', 'name'),
    'value' => function ($model) {
          if($model->faixaEtaria['nivel_intervencao_id']==1) {return "Primario";} elseif($model->faixaEtaria['nivel_intervencao_id']==2){return "Secundario";} else {return "Contextual";}
      },
          ],

          [
            'attribute'=>'servico_id',
            'value'=>'servico.name',
            'filter'=> ArrayHelper::map(ServicosDream::find()->where(['=','status','1'])->orderBy('name ASC')->asArray()->all(), 'id', 'name'),
	    'contentOptions' => ['style' => 'width: 25%;', 'class' => 'text-left'],
          ],
            
            'description',
    [
              'attribute'=>'status',
            'format' => 'raw',
               'filter'=>array("1"=>"Activo","0"=>"Inactivo"),
               'value' => function ($model) {
            return  $model->status==1 ? '<i class="fa fa-success fa-check-circle"></i>': '<i class="fa fa-female"></i>';
            },
            ],
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
        <?= Html::a(Yii::t('app', 'Novo'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::end(); ?></div>
