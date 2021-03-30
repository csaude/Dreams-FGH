<div class="row">
<div class="col-lg-4">
  <div id="core" style="height: 200px; width: 100%;"></div>
</div>

<div class="col-lg-8">
<table class="table table-bordered" width="90%">
<tbody>
<tr>

<td></td>
<td colspan="7" align="center">N&uacute;mero de Servi&ccedil;os beneficiados</td>
</tr>
<tr>

<td align="center"><b>Idade</b></td>
<td align="center"  bgcolor="#f7786b"><b>0</b></td>
<td align="center"  bgcolor="#eea29a"><b>1</b></td>
<td align="center"  bgcolor="#f7cac9"><b>2</b></td>
<td align="center"  bgcolor="#b5e7a0"><b>3</b></td>
<td align="center"  bgcolor="#82b74b"><b>4</b></td>
<td align="center"  bgcolor="#3fcb40"><b>4+</b></td>
<td align="center"><b>Total</b></td>
</tr>
<tr>
<td align="center"  bgcolor="#ccc">[10-14]</td>
<td align="center"  bgcolor="#ccc"> <?=  $a1=a1(0,5,0);  ?> </td>
<td align="center"  bgcolor="#ccc"> <?=  $a2=a1(1,5,1);  ?></td>
<td align="center"  bgcolor="#ccc"> <?=  $a3=a1(2,5,2);  ?></td>
<td align="center"  bgcolor="#ccc"> <?=  $a4=a1(3,5,3);  ?></td>
<td align="center"  bgcolor="#ccc"> <?=  $a5=a1(4,5,4);  ?></td>
<td align="center"  bgcolor="#ccc"> <?=  $a6=a1(5,5,5);  ?></td>
<td align="center"  bgcolor="#ccc">
  <b><?php
echo $tot1=$a1+$a2+$a3+$a4+$a5+$a6;
  ?></b></td>
</tr>
<tr>
<td align="center" bgcolor="#ccc">[15-19]</td>
<td align="center" bgcolor="#ccc"> <?=  $b1=b1(0,5,0);  ?> </td>
<td align="center" bgcolor="#ccc"> <?=  $b2=b1(1,5,1);  ?></td>
<td align="center" bgcolor="#ccc"> <?=  $b3=b1(2,5,2);  ?></td>
<td align="center" bgcolor="#ccc"> <?=  $b4=b1(3,5,3);  ?></td>
<td align="center" bgcolor="#ccc"> <?=  $b5=b1(4,5,4);  ?></td>
<td align="center" bgcolor="#ccc"> <?=  $b6=b1(5,5,5);  ?></td>
<td align="center" bgcolor="#ccc"> <b>
	<?php
echo $tot2=$b1+$b2+$b3+$b4+$b5+$b6;
  ?></b></td>
</tr>
<tr>
<td align="center" bgcolor="#ccc">[20-24]</td>
<td align="center" bgcolor="#ccc"> <?=  $c1=c1(0,5,0);  ?> </td>
<td align="center" bgcolor="#ccc"> <?=  $c2=c1(1,5,1);  ?></td>
<td align="center" bgcolor="#ccc"> <?=  $c3=c1(2,5,2);  ?></td>
<td align="center" bgcolor="#ccc"> <?=  $c4=c1(3,5,3);  ?></td>
<td align="center" bgcolor="#ccc"> <?=  $c5=c1(4,5,4);  ?></td>
<td align="center" bgcolor="#ccc"> <?=  $c6=c1(5,5,5);  ?></td>
<td align="center" bgcolor="#ccc"> <b> 
	<?php
echo $tot3=$c1+$c2+$c3+$c4+$c5+$c6;
  ?></b></td>
</tr>
<tr>
<td align="center"><b>Total</b></td>
<td align="center" bgcolor="#f7786b"><b><?php echo  $a1+$b1+$c1;?></b></td>
<td align="center" bgcolor="#eea29a"><b><?php echo  $a2+$b2+$c2;?></b></td>
<td align="center" bgcolor="#f7cac9"><b><?php echo  $a3+$b3+$c3;?></b></td>
<td align="center" bgcolor="#b5e7a0"><b><?php echo  $a4+$b4+$c4;?></b></td>
<td align="center" bgcolor="#82b74b"><b><?php echo  $a5+$b5+$c5;?></b></td>
<td align="center" bgcolor="#3fcb40"><b><?php echo  $a6+$b6+$c6;?></b></td>
<td align="center"><b><?= $tot1+$tot2+$tot3;  ?> </b></td>
</tr>
</tbody>
</table>
  </div>
</div> 

<!--
<div class="row">
<div class="col-lg-4">
  <div id="core8" style="height: 200px; width: 100%;"></div>
</div>

<div class="col-lg-8">
<table class="table table-bordered" width="90%">
<tbody>
<tr>

<td></td>
<td colspan="7" align="center">N&uacute;mero de Servi&ccedil;os beneficiados</td>
</tr>
<tr>

<td align="center"><b>Idade</b></td>
<td align="center"  bgcolor="#f7786b"><b>0</b></td>
<td align="center"  bgcolor="#eea29a"><b>1</b></td>
<td align="center"  bgcolor="#f7cac9"><b>2</b></td>
<td align="center"  bgcolor="#b5e7a0"><b>3</b></td>
<td align="center"  bgcolor="#82b74b"><b>4</b></td>
<td align="center"  bgcolor="#3fcb40"><b>4+</b></td>
<td align="center"><b>Total</b></td>
</tr>
<tr>
<td align="center"  bgcolor="#ccc">[10-14]</td>
<td align="center"  bgcolor="#ccc"> <?=  $a1=a1(0,8,0);  ?> </td>
<td align="center"  bgcolor="#ccc"> <?=  $a2=a1(1,8,1);  ?></td>
<td align="center"  bgcolor="#ccc"> <?=  $a3=a1(2,8,2);  ?></td>
<td align="center"  bgcolor="#ccc"> <?=  $a4=a1(3,8,3);  ?></td>
<td align="center"  bgcolor="#ccc"> <?=  $a5=a1(4,8,4);  ?></td>
<td align="center"  bgcolor="#ccc"> <?=  $a6=a1(5,8,5);  ?></td>
<td align="center"  bgcolor="#ccc">
  <b><?php
echo $tot18=$a1+$a2+$a3+$a4+$a5+$a6;
  ?></b></td>
</tr>
<tr>
<td align="center" bgcolor="#ccc">[15-19]</td>
<td align="center" bgcolor="#ccc"> <?=  $b1=b1(0,8,0);  ?> </td>
<td align="center" bgcolor="#ccc"> <?=  $b2=b1(1,8,1);  ?></td>
<td align="center" bgcolor="#ccc"> <?=  $b3=b1(2,8,2);  ?></td>
<td align="center" bgcolor="#ccc"> <?=  $b4=b1(3,8,3);  ?></td>
<td align="center" bgcolor="#ccc"> <?=  $b5=b1(4,8,4);  ?></td>
<td align="center" bgcolor="#ccc"> <?=  $b6=b1(5,8,5);  ?></td>
<td align="center" bgcolor="#ccc"> <b>
	<?php
echo $tot28=$b1+$b2+$b3+$b4+$b5+$b6;
  ?></b></td>
</tr>
<tr>
<td align="center" bgcolor="#ccc">[20-24]</td>
<td align="center" bgcolor="#ccc"> <?=  $c1=c1(0,8,0);  ?> </td>
<td align="center" bgcolor="#ccc"> <?=  $c2=c1(1,8,1);  ?></td>
<td align="center" bgcolor="#ccc"> <?=  $c3=c1(2,8,2);  ?></td>
<td align="center" bgcolor="#ccc"> <?=  $c4=c1(3,8,3);  ?></td>
<td align="center" bgcolor="#ccc"> <?=  $c5=c1(4,8,4);  ?></td>
<td align="center" bgcolor="#ccc"> <?=  $c6=c1(5,8,5);  ?></td>
<td align="center" bgcolor="#ccc"> <b> 
	<?php
echo $tot38=$c1+$c2+$c3+$c4+$c5+$c6;
  ?></b></td>
</tr>
<tr>
<td align="center"><b>Total</b></td>
<td align="center" bgcolor="#f7786b"><b><?php echo  $a1+$b1+$c1;?></b></td>
<td align="center" bgcolor="#eea29a"><b><?php echo  $a2+$b2+$c2;?></b></td>
<td align="center" bgcolor="#f7cac9"><b><?php echo  $a3+$b3+$c3;?></b></td>
<td align="center" bgcolor="#b5e7a0"><b><?php echo  $a4+$b4+$c4;?></b></td>
<td align="center" bgcolor="#82b74b"><b><?php echo  $a5+$b5+$c5;?></b></td>
<td align="center" bgcolor="#3fcb40"><b><?php echo  $a6+$b6+$c6;?></b></td>
<td align="center"><b><?= $tot18+$tot28+$tot38;  ?> </b></td>
</tr>
</tbody>
</table>
  </div>
</div>



<div class="row">
<div class="col-lg-4">
  <div id="core3" style="height: 200px; width: 100%;"></div>
</div>

<div class="col-lg-8">
<table class="table table-bordered" width="90%">
<tbody>
<tr>

<td></td>
<td colspan="7" align="center">N&uacute;mero de Servi&ccedil;os beneficiados</td>
</tr>
<tr>

<td align="center"><b>Idade</b></td>
<td align="center"  bgcolor="#f7786b"><b>0</b></td>
<td align="center"  bgcolor="#eea29a"><b>1</b></td>
<td align="center"  bgcolor="#f7cac9"><b>2</b></td>
<td align="center"  bgcolor="#b5e7a0"><b>3</b></td>
<td align="center"  bgcolor="#82b74b"><b>4</b></td>
<td align="center"  bgcolor="#3fcb40"><b>4+</b></td>
<td align="center"><b>Total</b></td>
</tr>
<tr>
<td align="center"  bgcolor="#ccc">[10-14]</td>
<td align="center"  bgcolor="#ccc"> <?=  $a1=a1(0,3,0);  ?> </td>
<td align="center"  bgcolor="#ccc"> <?=  $a2=a1(1,3,1);  ?></td>
<td align="center"  bgcolor="#ccc"> <?=  $a3=a1(2,3,2);  ?></td>
<td align="center"  bgcolor="#ccc"> <?=  $a4=a1(3,3,3);  ?></td>
<td align="center"  bgcolor="#ccc"> <?=  $a5=a1(4,3,4);  ?></td>
<td align="center"  bgcolor="#ccc"> <?=  $a6=a1(5,3,5);  ?></td>
<td align="center"  bgcolor="#ccc">
  <b><?php
echo $tot13=$a1+$a2+$a3+$a4+$a5+$a6;
  ?></b></td>
</tr>
<tr>
<td align="center" bgcolor="#ccc">[15-19]</td>
<td align="center" bgcolor="#ccc"> <?=  $b1=b1(0,3,0);  ?> </td>
<td align="center" bgcolor="#ccc"> <?=  $b2=b1(1,3,1);  ?></td>
<td align="center" bgcolor="#ccc"> <?=  $b3=b1(2,3,2);  ?></td>
<td align="center" bgcolor="#ccc"> <?=  $b4=b1(3,3,3);  ?></td>
<td align="center" bgcolor="#ccc"> <?=  $b5=b1(4,3,4);  ?></td>
<td align="center" bgcolor="#ccc"> <?=  $b6=b1(5,3,5);  ?></td>
<td align="center" bgcolor="#ccc"> <b>
	<?php
echo $tot23=$b1+$b2+$b3+$b4+$b5+$b6;
  ?></b></td>
</tr>
<tr>
<td align="center" bgcolor="#ccc">[20-24]</td>
<td align="center" bgcolor="#ccc"> <?=  $c1=c1(0,3,0);  ?> </td>
<td align="center" bgcolor="#ccc"> <?=  $c2=c1(1,3,1);  ?></td>
<td align="center" bgcolor="#ccc"> <?=  $c3=c1(2,3,2);  ?></td>
<td align="center" bgcolor="#ccc"> <?=  $c4=c1(3,3,3);  ?></td>
<td align="center" bgcolor="#ccc"> <?=  $c5=c1(4,3,4);  ?></td>
<td align="center" bgcolor="#ccc"> <?=  $c6=c1(5,3,5);  ?></td>
<td align="center" bgcolor="#ccc"> <b> 
	<?php
echo $tot33=$c1+$c2+$c3+$c4+$c5+$c6;
  ?></b></td>
</tr>
<tr>
<td align="center"><b>Total</b></td>
<td align="center" bgcolor="#f7786b"><b><?php echo  $a1+$b1+$c1;?></b></td>
<td align="center" bgcolor="#eea29a"><b><?php echo  $a2+$b2+$c2;?></b></td>
<td align="center" bgcolor="#f7cac9"><b><?php echo  $a3+$b3+$c3;?></b></td>
<td align="center" bgcolor="#b5e7a0"><b><?php echo  $a4+$b4+$c4;?></b></td>
<td align="center" bgcolor="#82b74b"><b><?php echo  $a5+$b5+$c5;?></b></td>
<td align="center" bgcolor="#3fcb40"><b><?php echo  $a6+$b6+$c6;?></b></td>
<td align="center"><b><?= $tot13+$tot23+$tot33;  ?> </b></td>
</tr>
</tbody>
</table>
  </div>
</div> 
-->