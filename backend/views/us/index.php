<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\UsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Unidades Sanitárias';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="us-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'cod_us',
            'name',
			'nivel.name',
            'provincia.province_name',
			'distrito.district_name',            
            'localidade.name',
             
            // 'description',
            // 'criado_por',
            // 'actualizado_por',
            // 'criado_em',
            // 'actualizado_em',
            // 'user_location',
            // 'user_location2',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?>    
<p>
        <?= Html::a('Nova Unidades Sanitárias', ['create'], ['class' => 'btn btn-success']) ?>
    </p></div>
