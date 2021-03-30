<?php

use yii\helpers\Html;

use kartik\widgets\DepDrop;
use \kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use app\models\Provincias;
use app\models\Distritos;
use app\models\ComiteCidades;
use app\models\ComiteNacionalidade;
use app\models\ComiteZonal;
use app\models\ComiteCirculos;
use app\models\ComiteCelulas;
use app\models\ComiteLocalidades;
use app\models\TipoCargos;
use app\models\ComiteCargos;


use yii\helpers\Url;
use yii\bootstrap\Modal;
use kartik\widgets\DatePicker;
use kartik\form\ActiveForm;
use common\models\User;
use app\models\Educacao;
use app\models\TituloProfissional;
use app\models\JobCategory;
use yii\jui\AutoComplete;
use kartik\widgets\FileInput;

use yii\widgets\MaskedInput;
use app\models\Beneficiarios;
use app\models\Bairros;
use app\models\Us;
use app\models\Organizacoes;

/* @var $this yii\web\View */
/* @var $model app\models\Utilizadores */
/* @var $form yii\widgets\ActiveForm */
 $user = \Yii::$app->user->identity;
?>

<div class="utilizadores-form">


    <?php $form = ActiveForm::begin(); ?>


    <?php $form->field($model, 'username')->textInput(['readonly' => true]) ?>

    <?php $form->field($model, 'email')->textInput(['readonly' => true]) ?>

    <?php $form->field($model, 'name')->textInput(['readonly' => false]) ?>



<div class="form-group field-utilizadores-provin_code">
<label class="control-label" for="utilizadores-provin_code">Província</label>
<?= Html::activeDropDownList($model, 'provin_code', ArrayHelper::map(Provincias::find()->all(), 'id', 'province_name'),

['class' => 'form-control',
'prompt' => '-',

 'onchange'=>'$.post("lists.dreams?id='.'"+$(this).val(), function(data) {
    $("select#utilizadores-district_code").html(data);
 });',
]); ?>
<div class="help-block"></div>
</div>

<div class="form-group field-utilizadores-district_code">
<label class="control-label" for="utilizadores-district_code">Distrito</label>
<?= Html::activeDropDownList($model, 'district_code', ArrayHelper::map(Distritos::find()->all(), 'district_code', 'district_name'),


['class' => 'form-control',
'prompt' => '-',

 'onchange'=>'$.post("localidades.dreams?id='.'"+$(this).val(), function(data) {
    $("select#utilizadores-localidade_id").html(data);
 });',
]); ?>
<div class="help-block"></div>
 </div>


 <div class="form-group field-utilizadores-localidade_id">
<label class="control-label" for="utilizadores-localidade_id">Posto Administrativo</label>
<?= Html::activeDropDownList($model, 'localidade_id', ArrayHelper::map(ComiteLocalidades::find()->all(), 'id', 'name'),


['class' => 'form-control',
'prompt' => '-',

 'onchange'=>'$.post("us.dreams?id='.'"+$(this).val(), function(data) {
    $("select#utilizadores-us_id").html(data);
 });',
]); ?>
<div class="help-block"></div>
 </div>




<?php  
/*echo  $form->field($model, 'role')->widget(Select2::classname(), [
'data' => ArrayHelper::map(
    10=>'Activista recepcionista',
    10=>'Activista de referência da US',
    10=>'Activista provedor de serviços comunitários',
    10=>'Gestores de casos' ),'options' => ['placeholder' => 'Tipo de Utilizador ...'], 
    'pluginOptions' => [
                    'allowClear' => true
                ],
]);*/
?> 
<?= $form->field($model, 'role')->dropdownList([
'7' => 'ACTIVISTA',
'11' => 'MENTOR',
'12' => 'ENFERMEIRA',
'9' => 'DIGITADOR',
'8' => 'EDUCADOR DE PAR',
'13' => 'MONITORIA E AVALIACAO',
'14' => 'DOADOR', 
'15' => 'GESTOR DE CASO',
'18'=> 'SUPERVISOR',
'20' => 'ADMIN',
], ['prompt' => '---Selecione o Tipo de Utilizador---']);
?>



<?= $form->field($model, 'entry_point')->dropdownList([
'1' => 'Unidade Sanitaria', 
'2' => 'Escola',
'3' => 'Comunidade'
], ['prompt' => '---Selecione o Ponto de entrada---']);
?>

<?php  
echo  $form->field($model, 'us_id')->widget(Select2::classname(), [
'data' => ArrayHelper::map(Us::find()->asArray()->orderBy('name ASC')->all(), 'id', 'name'),'options' => ['placeholder' => 'Localidade ...'], 
    'pluginOptions' => [
                    'allowClear' => true
                ],
]);
?> 

    <?php /* $form->field($model, 'us_id')->textInput()*/ ?>
    <?php $form->field($model, 'city_code')->textInput() ?>

	  <?= $form->field($model, 'parceiro_id')->widget(Select2::classname(), [
 'data' => ArrayHelper::map(Organizacoes::find()->asArray()->orderBy('name ASC')->all(), 'id', 'name'),'options' => ['placeholder' => 'Selecione a Organizacao ...'], 
    'pluginOptions' => [
                    'allowClear' => true
                ],
 ]);
 ?>
	<div class="row">
	
	<div class="col-lg-6"><?= $form->field($model, 'phone_number')->textInput(['readonly' => false]) ?></div>
	<div class="col-lg-6"><?= $form->field($model, 'phone_number2')->textInput(['readonly' => false]) ?></div>
	</div>
	
	 <?= $form->field($model, 'ccord_id')->radioButtonGroup([0 => ' Não', 1 => ' Sim']); ?>  
    <?= $form->field($model, 'status')->radioButtonGroup([10 => ' Activo', 0 => ' Inactivo']); ?>




    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
 
    <?php ActiveForm::end(); ?>

</div>
