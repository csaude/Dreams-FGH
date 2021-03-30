<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Membros;
/* @var $this yii\web\View */
/* @var $model app\models\DocumentosFotos */

$this->title = $model->id;
//$this->title = $model->empNumber->emp_firstname.' '.$model->empNumber->emp_lastname;
$this->params['breadcrumbs'][] = ['label' => 'Fotos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="documentos-fotos-view">

    <h1><?= Html::encode($this->title) ?></h1>


<?= Html::img('@img/profiles/'.$model->anexo, ['alt' => 'Foto do Camarada', 'width'=>'350px']) ?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            /*'id',
            'tipos_documentos_id',*/
            'empNumber.member_id',
          //  'anexo',
           /* 'criado_por',
            'actualizado_por',
            'criado_em',
            'actualizado_em',
            'user_location',*/
            'status',
        ],
    ]) ?>
	
	    <p>
        
         <?= Html::a('<i class="glyphicon glyphicon-fast-backward"></i> Voltar', ['employee/view', 'id' => $model->emp_number], ['class' => 'btn btn-success']) ?>
       <?= Html::a('<i class="glyphicon glyphicon-pencil"></i> Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        
    </p>

</div>
