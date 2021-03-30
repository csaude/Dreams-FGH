<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

$this->title = $name;
?>
<div class="site-error">

    <h1><?php Html::encode($this->title) ?></h1>

    <div class="alert alert-danger">
        <i class="fa fa-info-circle fa-3x" aria-hidden="true"></i> <?= nl2br(Html::encode($message)) ?>
    </div>
<div class="alert alert-success">
    <i class="fa fa-user fa-3x"  aria-hidden="true"></i> 
    <p>
        Nao foi possivel processar o seu pedido.
    </p>
    <p>
       Entre em contato com o pessoal tecnico, caso se trate de um erro de servidor. Obrigado.
    </p><div class="form-group">
         <?= Html::a('<i class="glyphicon glyphicon-home"></i>', ['site/index'], ['class' => 'btn btn-danger']) ?>   
    </div>
</div>

</div>
