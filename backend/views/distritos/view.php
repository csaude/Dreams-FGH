<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Distritos */

$this->title = $model->district_name;
$this->params['breadcrumbs'][] = ['label' => 'Distritos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="distritos-view">

    <h1><?= Html::encode($this->title) ?></h1>

  

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
           // 'district_code',
            'district_name',
            'provincia.province_name',
        ],
    ]) ?>


       <div class="form-group">

      
       <?= Html::a('<i class="glyphicon glyphicon-backward"></i>', ['distritos/index'], ['class' => 'btn btn-warning']) ?>  
        <?= Html::a('Actualizar', ['update', 'id' => $model->district_code], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Apagar', ['delete', 'id' => $model->district_code], [
            'class' => 'btn btn-danger',
            'disabled'=>true,
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </div> 

</div>
