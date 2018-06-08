<?php

	include("cabecalho.php");
	include("conexao.php");

?>

<body>

	<table>
	
		<thead>
		
			<th colspan = '2'>Time casa</th>
			<th colspan = '2'>Time Visitante</th>
		
		</thead>
		
		<tbody>
		
			<?php
			/*
				$sql_consulta = "select * from jogos where id_campeonato =
				$_POST['id_campeonato']"

				$resultado = mysqli_query($sql_consulta,$conexao);
				
				$time = mysqli_fetch_assoc($resultado);
				
				$linhas = mysqli_num_rows($resultado);*/
				

				for($i=0; $i<$linhas; $i++){?>
				
					<form action "cadastra_placar.php" method = "post">
					
						<?="<td>$time['nome_time_casa']</td>";
							
							?><input type = 'hidden' name = 'time_casa' value ="<?= $time['nome_time_casa'];?>"/>							value = <?=$time['nome_time_casa']?> />
							
						<?="<td><input type = 'number' name = 'gols_casa'/></td>";
						
						echo"<td>$time['nome_time_visitante']</td>";
							?><input type = 'hidden' name = 'time_casa' value ="<?= $time['nome_time_visitante']?>;"/>;
						<?="<td><input type = 'number' name = 'gols_visitante'/></td>";?>
						
						<input type = "submit" name = "ok" value = "cadastrar" />
												
					</form>
					
			<?php }
			
			?>
		
		</tbody>
	
	</table>

</body>