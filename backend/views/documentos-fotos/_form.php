<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use app\models\TiposDocumentos;
use dosamigos\datepicker\DatePicker;
use dosamigos\datepicker\DateRangePicker;
use kartik\select2\Select2;
use app\models\DocumentosAnexos;
use app\models\Membros;
use kartik\file\FileInput;
/* @var $this yii\web\View */
/* @var $model app\models\DocumentosFotos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="documentos-fotos-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' =>   'multipart/form-data']]); ?>

<?php

if(!$model->isNewRecord) { ?>

<input readonly="true" value="<?= $model->emp_number; ?>" type="hidden" id="documentosfotos-emp_number" class="form-control" name="DocumentosFotos[emp_number]">

<?php } else {
	
if(isset($_GET['profile'])&&($_GET['profile']!="")) { 
 $membro=$_GET['profile'];
$countEmployee = Membros::find()->where(['>','emp_status',0])->andWhere(['=','id',$membro])->count();
   
if($countEmployee>0) {

    ?>

<input readonly="true" value="<?= $_GET['profile']; ?>" type="hidden" id="documentosfotos-emp_number" class="form-control" name="DocumentosFotos[emp_number]">
<?php } elseif(Yii::$app->user->identity->docente_id!=NULL) { ?>
<input readonly="true" value="<?= Yii::$app->user->identity->docente_id; ?>" type="hidden" id="documentosfotos-emp_number" class="form-control" name="DocumentosFotos[emp_number]">

<?php } }  elseif(Yii::$app->user->identity->role==10) {  ?>

<input readonly="true" value="<?= Yii::$app->user->identity->id; ?>" type="hidden" id="documentosfotos-emp_number" class="form-control" name="DocumentosFotos[emp_number]">


<?php } elseif(Yii::$app->user->identity->role==20) {

    echo  $form->field($model, 'emp_number')->textInput();

} else {}
}

     


?>
   

    <?= $form->field($model, 'anexo')->widget(FileInput::classname(), [
    'options' => ['accept' => 'image/*'],
]);
?>

    <?= $form->field($model, 'status')->radioList(array('1'=>'Activa','0'=>'Inactiva')); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Salvar' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
