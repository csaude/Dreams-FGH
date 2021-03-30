<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Us */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Unidades Sanitárias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="us-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Apagar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
           // 'id',
			'cod_us',
            'name',
			'nivel.name',
            'provincia.province_name',
			'distrito.district_name',            
            'localidade.name',
            'description',
            'status',
          /*  'criado_por',
            'actualizado_por',
            'criado_em',
            'actualizado_em',
            'user_location',
            'user_location2',*/
        ],
    ]) ?>

</div>
