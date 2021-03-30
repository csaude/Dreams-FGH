<?php 
//inner join para preencher a tabela de dados do utilizador
$connect1 = mysqli_connect("localhost", "root", "Maputo123#", "dreamsco_app");
?>

<?php
// para visualizar os dados inseridos 
$sql1 = "select emp_number, idade_anos, emp_birthday, criado_em
from hs_hr_employee 
where emp_gender = 2 AND idade_anos IS NULL  AND emp_status=1 AND emp_birthday<>''";
$result1 = mysqli_query($connect1, $sql1);

?>

<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Avaliacao</title>
		
		<style> 
			table {
			<!--border-collapse: collapse;-->
			width: 100%;
			font-size: 12px;
			font-style:Arial;
			text-align: center;
			
			}
			th{
			background-color: #FFFFFF;
			color: black;
			}
			
			input, placeholder{
			color: black;
			}
			
			th, td {
			border: 2px solid #ddd;
			padding: 15px; 
			text-align: left;
			}
			
			li{
				color: black;
			}
		
		</style>
	</head>
	<body>
	<form method="post" action="avaliacao_resultado.php">	

<div class="container theme-showcase" role="main">		
		

	  
		
		<div class='row'>
			

  <fieldset>
  
  
   		<table class="table table-resposive" style="width:100%">

									<tbody>
										<tr>
											
											<th> codigo</th>
											<th> idade</th>
											<th> aniversario</th>
											<th> data criacao</th>
											
										</tr>
								<?php 
									if (mysqli_num_rows($result1) > 0) {
										while ($row = mysqli_fetch_array($result1)) {



  //date in mm/dd/yyyy format
  $birthDate = $row["emp_birthday"];
  //explode the date to get month, day and year
  $birthDate = explode("/", $birthDate);
  //get age from date or birthdate
  $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")? ((date("Y") - $birthDate[2]) - 1): (date("Y") - $birthDate[2]));

$sql2 = "UPDATE hs_hr_employee SET idade_anos=".$age."  where emp_number =".$row['emp_number']." AND idade_anos IS NULL";
//$result2= mysqli_query($connect1, $sql2);




										?>	

										
										<tr>
											<td>
												<?php echo $row["emp_number"]; ?>
											</td>
										
											<td>
												<?php echo $row["idade_anos"]; ?>
											</td>

											<td>
												<?php echo $row["emp_birthday"]."----". $age; ?>
											</td>
											
											<td>
												<?php echo $row["criado_em"]; ?>
											</td>
											

																	
										</tr>
					<?php 
					}
				}
			?>
			</tbody>
		</table> 										
   <fieldset>			
			
		
		</div>
		
		
		</form>
			
	</body>
</html>
