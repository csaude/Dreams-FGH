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

            [
              'attribute'=>'faixa_id',
              'value'=>'faixaEtaria.faixa_etaria',
              'filter'=> ArrayHelper::map(FaixaEtaria::find()->where(['=','status','1'])->orderBy('faixa_etaria ASC')->asArray()->all(), 'id', 'faixa_etaria','nivel_intervencao_id')
            ],

            [
              'label'=>'Nivel de Intervenção',
              'filter'=> ArrayHelper::map(NivelIntervensao::find()->where(['=','status','1'])->orderBy('id ASC')->asArray()->all(), 'id', 'name'),
              'value' => function ($model) {
                    return $model->faixaEtaria->nivelIntervensao['name'];
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

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <p>
        <?= Html::a(Yii::t('app', 'Novo'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::end(); ?></div>
