<?php

use yii\helpers\Html;
use yii\grid\GridView;

use yii\helpers\ArrayHelper;

use app\models\ServicosDream;
use app\models\Curriculum;


$this->title = Yii::t('app', 'Curriculum Servicos');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="curriculum-servico-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //  'id',
            [
                'attribute' => 'curriculum_id',
                'value' => 'curriculum.name',
                'filter' => ArrayHelper::map(Curriculum::find()->where(['=', 'status', '1'])->orderBy('name ASC')->asArray()->all(), 'id', 'name')
            ],
            [
                'attribute' => 'servico_id',
                'value' => 'servico.name',
                'filter' => ArrayHelper::map(ServicosDream::find()->where(['=', 'status', '1'])->orderBy('name ASC')->asArray()->all(), 'id', 'name'),
                'contentOptions' => ['style' => 'width: 25%;', 'class' => 'text-left'],
            ],

            'description',
            [
                'attribute' => 'status',
                'format' => 'raw',
                'filter' => array("1" => "Activo", "0" => "Inactivo"),
                'value' => function ($model) {
                    return  $model->status == 1 ? '<i class="fa fa-success fa-check-circle"></i>' : '<i class="fa fa-female"></i>';
                },
            ],
      

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <p>
        <?= Html::a(Yii::t('app', 'Novo'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
</div>