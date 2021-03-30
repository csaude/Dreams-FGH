<?php

use yii\helpers\Html;
use yii\grid\GridView;

use yii\helpers\ArrayHelper;
use app\models\Employee;
use yii\widgets\Pjax;
use app\models\TiposDocumentos;
/* @var $this yii\web\View */
/* @var $searchModel app\models\DocumentosFotosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Documentos Fotos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="documentos-fotos-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

          //  'id',
            [
            'attribute'=>'tipos_documentos_id',
            'value'=>'tiposDocumentos.abrev',
            'filter'=>ArrayHelper::map(TiposDocumentos::find()->asArray()->all(), 'id', 'abrev'),
            ],
            'emp_number',
            'anexo',
           // 'criado_por',
            // 'actualizado_por',
            // 'criado_em',
            // 'actualizado_em',
            // 'user_location',
             'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
  <p>
        <?= Html::a('<i class="glyphicon glyphicon-plus-sign"></i> Adicionar Foto', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
</div>
