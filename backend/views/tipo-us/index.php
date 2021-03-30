<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\TipoUsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tipo uses';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipo-us-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'id',
            'nivel',
            'name',
            'tipo',
           // 'status',
             'description',
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
        <?= Html::a('Create Tipo Us', ['create'], ['class' => 'btn btn-success']) ?>
</p>
    </div>
