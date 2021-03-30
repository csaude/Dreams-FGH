<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

use app\models\Bairros;
use yii\helpers\ArrayHelper;
use app\models\Distritos;
/* @var $this yii\web\View */
/* @var $searchModel app\models\EscolasDreamsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Escolas Dreams');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="escolas-dreams-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'id',
            'name',
            [
            'attribute'=>'distrito_id',
            'value'=>'distritos.district_name',
            'filter'=> ArrayHelper::map(Distritos::find()->orderBy('district_name ASC')->asArray()->all(), 'district_code', 'district_name')
          ],
          [
            'attribute'=>'bairro_id',
            'value'=>'bairros.name',
            'filter'=> ArrayHelper::map(Bairros::find()->orderBy('name ASC')->asArray()->all(), 'id', 'name')
          ],
            'lat',
            'lng',
             
             //'description',
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
     <?= Html::a('<i class="glyphicon glyphicon-home"></i>', ['site/index'], ['class' => 'btn btn-danger']) ?>    
        <?= Html::a('<i class="fa fa-plus"></i> Nova Escola', ['create'], ['class' => 'btn btn-success']) ?>
    </p> 
<?php Pjax::end(); ?></div>
