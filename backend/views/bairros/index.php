<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\models\Bairros;
use yii\helpers\ArrayHelper;
use app\models\Us;
use app\models\Distritos;
use app\models\ComiteLocalidades;
/* @var $this yii\web\View */
/* @var $searchModel app\models\BairrosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Bairros');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bairros-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'id',
            
			  [
            'attribute'=>'distrito_id',
            'value'=>'distritos.district_name',
            'filter'=> ArrayHelper::map(Distritos::find()->orderBy('district_name ASC')->asArray()->all(), 'district_code', 'district_name')
          ],
			
				  [
            'attribute'=>'post_admin_id',
            'value'=>'pAdmin.name',
            'filter'=> ArrayHelper::map(ComiteLocalidades::find()->orderBy('name ASC')->asArray()->all(), 'id', 'name')
          ],
            
            'name',
             [
            'attribute'=>'cod_us',
            'value'=>'us.name',
            'filter'=> ArrayHelper::map(Us::find()->orderBy('name ASC')->asArray()->all(), 'id', 'name')
          ],
             'description',
            // 'lat',
            // 'lng',
            // 'status',
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
        <?= Html::a('<i class="fa fa-plus"></i> Novo Bairro', ['create'], ['class' => 'btn btn-success']) ?>
    </p>   
<?php Pjax::end(); ?></div>
