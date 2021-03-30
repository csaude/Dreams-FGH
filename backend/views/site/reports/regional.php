<?php

use  app\models\Beneficiarios;
use  app\models\ServicosDream;
use  app\models\ServicosBeneficiados;

use  app\models\Provincias;
use  app\models\Distritos;

$total=0;
$status=(int)1;
$todosben = Beneficiarios::find()->where(['emp_status'=>1])->count();

if (isset(Yii::$app->user->identity->role)&&(Yii::$app->user->identity->role>0)) {
if(isset(Yii::$app->user->identity->provin_code)&&(Yii::$app->user->identity->provin_code>0)) {
$prov=(int)Yii::$app->user->identity->provin_code;

 $total = Beneficiarios::find()->where(['provin_code'=>$prov])->andWhere(['emp_status'=>1])->count();

} elseif(Yii::$app->user->identity->role==20) {

 $total = Beneficiarios::find()->where(['emp_status'=>1])->count();


}

} else {
 $total = Beneficiarios::find()->where(['provin_code'=>0])->andWhere(['emp_status'=>1])->count();
}

$todosben = Beneficiarios::find()->where(['emp_status'=>1])->count();
?>

<!-- inicia Tabela Provincias-->
<br>

       <div class="row">
		    <div class="col-lg-6">
				<canvas id="cololoGraph" width="75"></canvas>
			 </div>
         <div class="col-lg-6">
         <div class="panel panel-success">
           <div class="panel-heading"> <strong align="center"><i class="icon ion-ios-star"></i> Provincias</strong></div>
           <div class="panel-body"  style="max-height: 600px;  overflow-y: scroll;">
       <table class="table table-condensed">
         <thead>
           <th>Província
           </th>
           <th>Distrito
           </th>
           <th  align="center"> Total
           </th>
           <th align="center"> 10-14
           </th>
           <th align="center"> 15-19
           </th>
           <th align="center"> 20-24
           </th>
         </thead>
         <tbody>
           <thead>
             <th>
             </th>
             <th>
             </th>
             <th  align="center"> <?= $total; ?>
             </th>
             <th align="center">

               <?php

               $firsts=Beneficiarios::find()
              ->where(['=','emp_status',1])
->limit($todosben)
->all();
              $ano=0;
               foreach ($firsts as $first) {
               if(!$first->emp_birthday==NULL) {
                 $newDate = substr(date($first->emp_birthday, strtotime($first->emp_birthday)),-4);
                  if ((date("Y")-$newDate)<15) { $ano++; }
                   }
                   else {
                 if($first->idade_anos<15) { $ano++; }
               }
              }
              echo $ano;
if($total==0) { $cat1=0;} else {
			  $cat1=round($ano/$total*100,1);}
               ?>

             </th>
             <th align="center">
               <?php
               $firsts=Beneficiarios::find()
              ->where(['=','emp_status',1])
->limit($todosben)
 ->all();
              $ano=0;
               foreach ($firsts as $first) {

               if(!$first->emp_birthday==NULL) {
                 $newDate = substr(date($first->emp_birthday, strtotime($first->emp_birthday)),-4);

                  if ((date("Y")-$newDate)>14&&(date("Y")-$newDate)<20) { $ano++; }

                   }

                   else {
                 if($first->idade_anos>14&&$first->idade_anos<20) { $ano++; }
               }

              }
              echo $ano;
if($total==0) { $cat2=0;} else {
			$cat2=round($ano/$total*100,1);}
               ?>

             </th>
             <th align="center">

               <?php
               $firsts=Beneficiarios::find()
              ->where(['=','emp_status',1])
->limit($todosben)
->all();

$ano=0;
               foreach ($firsts as $first) {
               if(!$first->emp_birthday==NULL) {
                $newDate = substr(date($first->emp_birthday, strtotime($first->emp_birthday)),-4);
                  if ((date("Y")-$newDate)>19) { $ano++; }
                   }
                   else {
                 if($first->idade_anos>19) { $ano++; }
               }
              }
              echo $ano;
if($total==0) { $cat3=0;} else {
			  $cat3=round($ano/$total*100,1);}
               ?>
             </th>
           </thead>
             <?php
             //core Services
                $ps= Provincias::find()->where(['=', 'status', 1])->orderBy(['province_code'=>SORT_ASC])->all();

                foreach ($ps as $prov) {?>
         <tr>
           <td>
         <i class="icon ion-ios-gear"></i>
         <span class="badge"><?= $prov->province_code; ?></span>
           <?= $prov->province_name; ?>
           <?php $pro=(int)$prov->id; ?>
         </td>

         <?php
         $ds= Distritos::find()->where(['province_code'=>$pro])
         ->orderBy(['district_name'=>SORT_ASC])->all(); ?>

           <td>
       <?php foreach ($ds as $dist) {?>
       <div class="row"> <i class="icon ion-ios-gear"></i>
        <span class="badge"><?= $dist->cod_distrito; ?></span> - <?= $dist->district_name; ?>
        </div>
        <?php } ?>
        </td>

        <td align="center"> <?php foreach ($ds as $dist) {
$id_dist=(int)$dist->district_code;

          ?>
        <div class="row">
         <span>

           <?=
          Beneficiarios::find()
      //   ->where('emp_status=:emp_status', [':emp_status' => $status])
         ->where(['provin_code'=>$pro])
         ->andWhere(['district_code'=>$id_dist])
	    ->andWhere('emp_status=:emp_status', [':emp_status' => $status])
         ->count();
         ?>
       </span>
         </div>
         <?php } ?> </td>
         <td align="center"> <?php foreach ($ds as $dist) {?>
         <div class="row">

          <span>

            <?php
            $id_dist=(int)$dist->district_code;
            $firsts=Beneficiarios::find()
			// ->where('emp_status=:emp_status', [':emp_status' => $status])
          // where(['=','emp_status',1])
           ->where(['provin_code'=>$pro])
            ->andWhere(['district_code'=>$id_dist])
			->andWhere('emp_status=:emp_status', [':emp_status' => $status])
            ->all();
            $ano=0;
            foreach ($firsts as $first) {
            if(!$first->emp_birthday==NULL) {
             $newDate = substr(date($first->emp_birthday, strtotime($first->emp_birthday)),-4);
               if ((date("Y")-$newDate)<15) { $ano++; }
                }
                else {
              if($first->idade_anos<15) { $ano++; }
            }
            }
            echo $ano;
            ?>
        </span>
          </div>
          <?php } ?> </td>
          <td align="center"> <?php foreach ($ds as $dist) {?>
          <div class="row"> <i class="icon ion-ios-gear"></i>
           <span>
             <?php
             $id_dist=(int)$dist->district_code;
             $firsts=Beneficiarios::find()
             ->where(['provin_code'=>$pro])
            ->andWhere(['district_code'=>$id_dist])
			->andWhere('emp_status=:emp_status', [':emp_status' => $status]) ->all();
            $ano=0;
             foreach ($firsts as $first) {

             if(!$first->emp_birthday==NULL) {
               $newDate = substr(date($first->emp_birthday, strtotime($first->emp_birthday)),-4);

                if ((date("Y")-$newDate)>14&&(date("Y")-$newDate)<20) { $ano++; }

                 }
                 else {
               if($first->idade_anos>14&&$first->idade_anos<20) { $ano++; }
             }
            }
            echo $ano;
             ?>

             </span>
           </div>
           <?php } ?> </td>


           <td align="center"> <?php foreach ($ds as $dist) {?>
           <div class="row">
            <span>

              <?php
              $id_dist=(int)$dist->district_code;
              $firsts=Beneficiarios::find()
              ->where(['provin_code'=>$pro])
            ->andWhere(['district_code'=>$id_dist])
			->andWhere('emp_status=:emp_status', [':emp_status' => $status])->all();
             $ano=0;
              foreach ($firsts as $first) {
              if(!$first->emp_birthday==NULL) {
               $newDate = substr(date($first->emp_birthday, strtotime($first->emp_birthday)),-4);
                 if ((date("Y")-$newDate)>19) { $ano++; }
                  }
                  else {
                if($first->idade_anos>19) { $ano++; }
              }
             }
             echo $ano;
              ?>
</span>
            </div>
            <?php } ?> </td>

       </tr>
                <?php }?>
       </tbody>
       </table>
           </div>
         </div>
			
			
			 
			 
       </div>
		  
		   
       </div>
<!-- termina tabela Provincias -->

<script  src="https://app.dreams.co.mz/backend/web/js/Chart.js"></script>
<script>
  var ctx = document.getElementById('cololoGraph').getContext('2d');
  var chart = new Chart(ctx, {
      // O tipo de Grafico
      type: 'doughnut',

      // Os dados a disponibilizar
      data: {
          labels: ["[10-14]", "[15-19]", "[20-24]"],
          datasets: [{
              
              backgroundColor: [
             '#ff6384',
             '#36a2eb',
             '#cc65fe',
         ],
            
              data: [<?php
echo $cat1.','.$cat2.','.$cat3
               ?>],
          }]
      },

      // Configuration options go here
      options: {
		  
	   title: {
            display: true,
            text: "Distribuição por faixa etária",
		   fontSize: 16,
        },
		/*  rotation: -Math.PI,
 cutoutPercentage: 30,
 circumference: Math.PI,
		  legend: {
   position: 'top'
 },*/
	  
	  }
  });
  </script>



<?php
//Beneficiarios de 10 a 14 anos com 1,2,3 ou mais servicos servico

function a1($id,$prov,$num) //Beneficiarios com 0 Servicos e de 10 a 14 anos
{
$total = Beneficiarios::find()
->where(['provin_code'=>$prov])
->andWhere(['emp_status'=>1])->count();

$firsts = Beneficiarios::find()
->where(['provin_code'=>$prov])
->andWhere(['emp_status'=>1])->limit($todosben)->all();

$ano=0;

 foreach ($firsts as $first) {
 if(!$first->emp_birthday==NULL) {
   $newDate = substr(date($first->emp_birthday, strtotime($first->emp_birthday)),-4);
    if ((date("Y")-$newDate)<15) {

$sers=ServicosBeneficiados::find()
->where(['beneficiario_id'=>$first->id])
->andWhere(['status'=>1])->count();
if($sers==$num) { $ano++; }
    }
     }
     else {
   if($first->idade_anos<15) {

     $sers=ServicosBeneficiados::find()
     ->where(['beneficiario_id'=>$first->id])
     ->andWhere(['status'=>1])->count();
     if($sers==$num) { $ano++; }
    }
 }
}
// echo $ano;
if($total==0) {$cat1=0;} else {
$cat1=$ano/$total*100;}
   return $ano;
}

//Beneficiarios de 15 a 19 anos com 1,2,3 ou mais servicos servico
function b1($id,$prov,$num) //Beneficiarios com 0 Servicos e de 10 a 14 anos
{
$total = Beneficiarios::find()
->where(['provin_code'=>$prov])
->andWhere(['emp_status'=>1])->count();

$firsts = Beneficiarios::find()
->where(['provin_code'=>$prov])
->andWhere(['emp_status'=>1])->all();

$ano=0;

 foreach ($firsts as $first) {
 if(!$first->emp_birthday==NULL) {
   $newDate = substr(date($first->emp_birthday, strtotime($first->emp_birthday)),-4);
    if ((date("Y")-$newDate)>14&&(date("Y")-$newDate)<20) {

$sers=ServicosBeneficiados::find()
->where(['beneficiario_id'=>$first->id])
->andWhere(['status'=>1])->count();
if($sers==$num) { $ano++; }
    }
     }
     else {
   if($first->idade_anos>14&&$first->idade_anos<20) {

     $sers=ServicosBeneficiados::find()
     ->where(['beneficiario_id'=>$first->id])
     ->andWhere(['status'=>1])->count();
     if($sers==$num) { $ano++; }
    }
 }
}

if($total==0) {$cat1=0;} else {
$cat1=$ano/$total*100;}
   return $ano;
}


//Beneficiarios de 15 a 19 anos com 1,2,3 ou mais servicos servico
function c1($id,$prov,$num) //Beneficiarios com 0 Servicos e de 10 a 14 anos
{
$total = Beneficiarios::find()
->where(['provin_code'=>$prov])
->andWhere(['emp_status'=>1])->count();

$firsts = Beneficiarios::find()
->where(['provin_code'=>$prov])
->andWhere(['emp_status'=>1])->all();

$ano=0;

 foreach ($firsts as $first) {
 if(!$first->emp_birthday==NULL) {
   $newDate = substr(date($first->emp_birthday, strtotime($first->emp_birthday)),-4);
    if ((date("Y")-$newDate)>=20) {

$sers=ServicosBeneficiados::find()
->where(['beneficiario_id'=>$first->id])
->andWhere(['status'=>1])->count();
if($sers==$num) { $ano++; }
    }
     }
     else {
   if($first->idade_anos>=20) {

     $sers=ServicosBeneficiados::find()
     ->where(['beneficiario_id'=>$first->id])
     ->andWhere(['status'=>1])->count();
     if($sers==$num) { $ano++; }
    }
 }
}

if($total==0) {$cat1=0;} else {
$cat1=$ano/$total*100;}
   return $ano;
}

?>

