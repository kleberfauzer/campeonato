<?php
	include("cabecalho.php");
	include("conexao.php");
?>

<body>

	<table border = "1">
	
		<thead>
		
			<th colspan = '6'>Confrontos</th>
		
		</thead>
		
		<tbody>
		
			<?php
				$id = $_POST['id_campeonato'];
				$sql_consulta = "select * from jogo where id_campeonato =
				$id";
				$resultado = mysqli_query($conexao, $sql_consulta);
				
				$linhas = mysqli_num_rows($resultado);
				
				for($i=0; $i<$linhas; $i++){
					
					$jogo = mysqli_fetch_assoc($resultado);
					
					?>
				
					<form action = "cadastra_placar.php" method = "post">
					
						<?="<td>" . $jogo['nome_time_casa'] . "</td>";?>
						
						<input type = 'hidden' name = 'time_casa' value ="<?= $jogo['nome_time_casa'];?>"/>	
							
						<?="<td><input type = 'number' name = 'gols_casa' placeholder = '".$jogo['gols_casa']."'/></td>";
						
						echo "<th>X</th>";?>
						<input type = 'hidden' name = 'time_visitante' value ="<?= $jogo['nome_time_visitante'];?>"/>
						<?="<td><input type = 'number' name = 'gols_visitante' placeholder = '".$jogo['gols_visitante']."'/></td>";?>
						<?php echo "<td>" . $jogo['nome_time_visitante'] . "</td>";?>
						<input type = "hidden" name = "id_campeonato" value = "<?=$_POST['id_campeonato'];?>"/>
						<input type = "hidden" name = "id_jogo" value = "<?=$jogo['id'];?>"/>
						<?= "<td><input type = 'submit' name = 'ok' value = 'cadastrar' /></td>";?>
				
					</form>								
				</tbody>	
			<?php }
			
			?>

	
	</table>
	
	<br />
	<br />
	<br />
	<br />
	<br />

</body>