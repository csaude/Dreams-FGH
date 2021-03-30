<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use dektrium\user\models\Profile;
/* @var $this yii\web\View */
/* @var $model app\models\Utilizadores */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Utilizadores'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="utilizadores-view">

    <h1><?= Html::encode($this->title) ?></h1>

   <?php

 if($model->role == 10) { $role='ACTIVISTA'; } elseif($model->role == 15) { $role='GESTOR DE CASO'; } else { $role='ADMIN';}
 $utils=Profile::find()->asArray()->where(['user_id'=>$model->id])->all();
foreach ($utils as $util) {
   $nomeu=$util['name'];
}
?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            'username',
            'email:email',
             [
             'attribute' => 'name',
             'format'=>'raw',
             'value' => $nomeu,
        ],
            'provincia.province_name',
            'distrito.district_name',// 'city_code',
             'localidade.name',
             'us.name',
             'parceiro.name',
            // 'user_location2',
            // 'password_hash',
            // 'auth_key',
            // 'password_reset_token',
           
			 [
             'attribute' => 'ccord_id',
             'format'=>'raw',
             'value' => $model->ccord_id == 1 ? 'SIM' : 'NÂO',
        ],
			
			 [
             'attribute' => 'role',
             'format'=>'raw',
             'value' => $role,
        ],
         //    'role',
            // 'status', 
            // 'created_at',
            // 'updated_at',
            // 'confirmed_at',
            // 'blocked_at',
            // 'confirmation_token',
            // 'confirmation_sent_at',
            // 'unconfirmed_email:email',
            // 'recovery_token',
            // 'recovery_sent_at',
            // 'registered_from',
            // 'logged_in_from',
            // 'logged_in_at',
            // 'registration_ip',
        ],
    ]) ?>
 <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>
</div>
