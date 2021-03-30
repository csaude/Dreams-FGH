<?php

use yii\helpers\Html;
use yii\grid\GridView;

use yii\helpers\ArrayHelper;
use app\models\TipoServicos;
use app\models\SubServicosDreams;
use app\models\ServicosDream;

use app\models\FaixaEtaria;
use app\models\FaixaEtariaServico;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ServicosDreamSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Serviços DREAMS';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="servicos-dream-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<div class="row">


<?php

function faixa_etaria($s_id) {

  $fs=FaixaEtariaServico::find()->where(['servico_id'=>$s_id])->andWhere(['status'=>1])->count();
  $faixas=FaixaEtariaServico::find()->where(['servico_id'=>$s_id])->andWhere(['status'=>1])->orderBy('servico_id')->all();

if ($fs>0) {
$faixa="";
foreach ($faixas as $data) {
$faixa=$faixa.'<small class="badge bg-yellow">'.$data->faixaEtaria['faixa_etaria'].'</small> - '.$data->faixaEtaria->nivelIntervensao['name'].' ';
}
  return $faixa;
}
  }


$s=ServicosDream::find()->where(['status'=>1])->count();
$servicos=ServicosDream::find()->where(['status'=>1])->orderBy('servico_id')->all();

if ($s>0) {

foreach($servicos as $servico) {


 ?>
  <div class="col-lg-6">
<div class="panel panel-<?php if ($servico->tipoServico['name']=="Serviços  Clinicos") {echo 'info';} else { echo 'success';} ?>">
  <div class="panel-heading"> 
  <b><i class="<?php if ($servico->tipoServico['name']=="Serviços  Clinicos") {echo 'fa fa-medkit';} else { echo 'fa fa-globe';} ?>"  ></i> 
  <?= mb_strtoupper($servico->name, 'UTF-8'); ?> <?= Yii::$app->user->identity->role==20 ?  Html::a('<i class="fa fa-edit"></i>', ['update','id'=>$servico->id], ['class' => 'label label-success']):'' ?></b>

  </div>
  <div class="panel-body">

<?php $sub_servicos=SubServicosDreams::find()->where(['status'=>1])->andWhere(['servico_id'=>$servico->id])->orderBy('servico_id')->all(); 

foreach($sub_servicos as $opcao) { ?>

<div class="checkbox">
   <label>
     <input  type="checkbox" <?= $opcao->status==1 ? 'checked':''; ?> disabled > <?=  $opcao->name; ?> <small> <?=  $opcao->description!=NULL? '('.$opcao->description.')':''; ?></small>
   </label>
 </div>


<?php } ?>
<?= faixa_etaria($servico->id); ?>
</div>
</div>
</div>
<?php } 
        }?>

</div>



<!--
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'name',
           // 'tipoServico.name',
             [
            'attribute'=>'servico_id',
            'value'=>'tipoServico.name',
            'filter'=> ArrayHelper::map(ServicosDream::find()->orderBy('name ASC')->asArray()->all(), 'id', 'name')
          ],
            'description',
            'status',

           /*    [
            'attribute'=>'servico_id',
            'value' => $this->status == 1 ? 'Activo' : 'Inactivo',
          ],*/
            // 'criado_por',
            // 'actualizado_por',
            // 'criado_em',
            // 'actualizado_em',
            // 'user_location',
            // 'user_location2',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    -->
    <p>
        <?= Html::a('<i class="fa fa-plus"></i> Novo Serviço Dreams', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    </div>
