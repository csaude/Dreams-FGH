<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use app\models\Provincias;
use app\models\Distritos;

$this->title = "INDICADORES DREAMS";
$this->params['breadcrumbs'][] = ['label' => 'Beneficiários', 'url' => ['view']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?php if($model->province_code == 1) { ?>
<div class="alert alert-success">
    Report Created Successfully!
</div>
<?php } else { ?>
    Model r
<?php } ?>


<div class="membros-view">

	<div class="col-lg-12">

	    <div class="panel panel-primary">
            <div class="panel-heading">
                <i class="fa fa-dashboard  text-primary"></i> <strong> Indicador AGYW_Prev Desagregado por Tempo de Registo e Idade  </strong>
            </div>
            <div class="panel-body">
                <div class="row"> </div>

                <button class="btn btn-primary btn-block  mb1 black bg-darken-1" data-toggle="collapse" data-target="#first"><b> <?php echo $province ?> </b></button>

                <div id="first" class="collapse">
                    <table width="100%" class="table table-dashed">

                        <tr>
                            <td colspan="5" bgcolor="#FFFFFF"><b> <?php echo $province ?> </b></td>
                        </tr>	
                    </table>
                    <button class="btn btn-primary btn-block  mb1 black bg-orange" data-toggle="collapse" data-target="#second"><b> <?php echo $district ?> </b></button>
                    <div id="second" class="collapse">
                        <table width="100%" class="table table-dashed">

                            <tr>
                                <td colspan="5" bgcolor="#FFFFFF"><b> <?php echo $district ?> </b></td>
                            </tr>	
                        </table>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
