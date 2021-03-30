<?php
use yii\helpers\Html;
/*use yii\bootstrap\ActiveForm;*/
use dektrium\user\widgets\Connect;
use kartik\form\ActiveForm;
/**
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = 'AUTENTICAÇÃO DE UTILIZADOR';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
       <div class="row">

    <div class="col-md-4 col-md-offset-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="glyphicon glyphicon-user"></i><b>&nbsp;<?= Html::encode($this->title) ?></b></h3>
            </div>
            <div class="panel-body">
      
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>


 <?= $form->field($model, 'username', [  'feedbackIcon' => [
        'default' => 'user',
        'success' => 'ok',
        'error' => 'exclamation-sign',
        'defaultOptions' => ['class'=>'text-primary']
    ],'inputOptions' => ['autofocus' => 'autofocus', 'class' => 'form-control', 'tabindex' => '1']]) ?>


     <?= $form->field($model, 'password', [  'feedbackIcon' => [
        'default' => 'lock',
        'success' => 'ok',
        'error' => 'exclamation-sign',
        'defaultOptions' => ['class'=>'text-primary']
    ],'inputOptions' => ['class' => 'form-control', 'tabindex' => '2']])->passwordInput()->label(Yii::t('user', 'Password') . ' (' . Html::a(Yii::t('user', 'Esqueceu a password?'), ['/user/recovery/request'], ['tabindex' => '5']) . ')') ?>
     <?php // $form->field($model, 'rememberMe')->checkbox(['tabindex' => '4']) ?>

                <?php // $form->field($model, 'password')->passwordInput() ?>
                <?= $form->field($model, 'rememberMe')->checkbox() ?>
                <div class="form-group">
                    <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
     
        </div>
			
			
			         <div class="panel-footer">
   
         <font size="3px" font-family=""> 
<span class="label label-warning">Determined</span>
<span class="label label-primary">Resilient</span>
<span class="label label-success">Empowered</span>
<span class="label label-info">AIDS-Free</span>
<span class="label label-default">Mentored</span>
<span class="label label-danger">Safe</span>
</font>
						   
         </div>
			
			
			
			
			
        </div>
</div>

    </div>
</div>

     <div class="row">

                <div class="navbar navbar-fixed-bottom">
                
<div class="col-md-6 col-md-offset-4">
            <!--    <font size="3px" font-family=""> 
<span class="label label-warning">Determined</span>
<span class="label label-primary">Resilient</span>
<span class="label label-success">Empowered</span>
<span class="label label-info">AIDS-Free</span>
<span class="label label-default">Mentored</span>
<span class="label label-danger">Safe</span>
</font>
-->
</div>
</div>
    </div> 
