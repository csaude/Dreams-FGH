<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\form\ActiveForm;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use \kartik\widgets\Select2;

use app\models\Organizacoes;
use app\models\Distritos;

use common\models\User;
use dektrium\user\models\Profile;


  
?>

<div class="referencias-dreams-confirm">
    <?php $form = ActiveForm::begin(
        [
            'options' => [
              'class' => 'referencias-pendentes-form',
              'action' => 'referencias-dreams/confirmationmodal'
          ]]
    ); ?>

    <div class="panel-body">
        
        <div class="row">
            <div class="col-lg-6" > 
                <div class="form-group">

                    <label class="control-label" >Motivo</label>
                    <?= Html::activeDropDownList($model, 'cancel_reason',['1' => 'Serviço não provido nos últimos 6 meses',
                                                                        '2' => 'Beneficiária não encontrada',
                                                                        '3' => 'Abandono',
                                                                        '4' => 'Beneficiária recusou o serviço',
                                                                        '5' => 'Outro Motivo'],
                    ['class' => 'form-control',
                    'disabled' =>true]); ?>

                    
                </div>
            </div>
            <div class="col-lg-6" > 
                <div class="form-group">
                
                <?= $form->field($model, 'other_reason')->textArea(['maxlength' => true, 'rows' => '3', 'disabled' =>true])?> 

                </div>
            </div>
        </div>      
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'toolbar'=> false,
            'columns' => [
                ['headerOptions' => ['class' => 'kartik-sheet-style']],
                ['attribute'=> 'criado_em',
                    'format' => 'html',
                    'value' => function ($model) {

                    return $model->criado_em;
                    },
                ],	

                'nota_referencia',

                ['attribute'=> 'beneficiario_id',
                    'format' => 'html',
                    'label'=>'Código do Beneficiário',
                    'value' => function ($model) {
                    if(isset($model->beneficiario->distrito['cod_distrito'])&&$model->beneficiario->distrito['cod_distrito']>0) {
                        return  $model->beneficiario_id>0 ?  '<font color="#cd2660">'.$model->beneficiario->distrito['cod_distrito'].'/'.$model->beneficiario['member_id'].'</font>': '-';
                    }
                    {return '-'.'/'.$model->beneficiario['member_id'];}
                    },
                ],

                        ['attribute'=>'referido_por',
                    'format' => 'html',
                    'value' => function ($model) {
                    return  $model->beneficiario_id>0 ?  '<font color="#cd2660"><b>'.$model->nreferente['name'].'</b></font>': "-";
                    },
                ],


                ['attribute'=>'notificar_ao',
                'format' => 'html',
                'value' => function ($model) {
                    return  $model->beneficiario_id>0 ?  '<font color="#cd2660"><b>'.$model->nreceptor['name'].'</b></font>': "-";
                    },
                ],

                ['attribute'=>'refer_to',
                    'label'=>'Ref. Para',
                    'format' => 'html',
                    'value' => function ($model) {
                    return  $model->refer_to;
                    },
                ],

                ['attribute'=>'projecto',
                'format' => 'html',
                'value' => function ($model) {
                    return  $model->organizacao['name'];
                },
                ],
            ],
            'panel'=>[
                'type'=>GridView::TYPE_PRIMARY,
            ],
            ]); 
        ?>        
        <div class="form-group pull-right">
            
        <?= Html::a(Yii::t('app', 'Confirmar & Registar'), ['confirmationmodal'], ['data'=>[  'method' => 'post',
                                                                                                    'params'=>['dataProvider' => serialize($dataProvider),
                                                                                                                'model'=>$model]],
                                                                                                    'data-pjax'=>0, 'class'=>'btn btn-success', 'title'=>'Confirmar & Registar'])  ?>  
               
        <?= Html::a('Cancelar', ['pendentes'], ['class' => 'btn btn-warning']) ?>

        </div>
    </div>



    

    <?php ActiveForm::end(); ?>
</div>

