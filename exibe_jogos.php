<?php
	session_start();
	include("cabecalho.php");
	include("conexao.php");
	
?>
	<body>
	<h2>Escolha o campeonato para ver os jogos</h2>
	<form action = "" method = "post">
	
		<select name = "id_campeonato">
		
			<?php
			
				$sql_campeonatos = "select * from campeonato";
				
				$resultado = mysqli_query($conexao,$sql_campeonatos);
				$linhas = mysqli_num_rows($resultado);
				
				while( ($vetor = mysqli_fetch_array($resultado)) != NULL){
					echo '<option value = "'.$vetor[0].'">'.$vetor[1].'</option>';
				}
			
			?>
		
		</select>
		
		<input type = "submit" name = "ok" value = "Ver"/>
		
	</form>
	
	</body>
<?php		
		if(isset($_POST["id_campeonato"])){
			
			$id = $_POST["id_campeonato"];
				$sql_consulta = "select * from jogo where id_campeonato =
				'$id'";
				$resultado = mysqli_query($conexao, $sql_consulta);
				$registros = mysqli_num_rows($resultado);
				
				if($registros == 0){
					die ("<br />Não há jogos gerados para esse campeonato!");
				}else{
?>

<body>

	<table border = "1">
	
		<thead>
		
			<th text-align = "center" colspan = "3">Confronto</th>
		
		</thead>
		
		<tbody>
		
			<?php
					while(($jogo = mysqli_fetch_assoc($resultado))!=NULL){
					
					?>
					
						<?="<td>" . $jogo['nome_time_casa'] . "</td>";	
						echo"<td>" . $jogo['nome_time_visitante'] . "</td>";
						?>
								</tbody>
						
			<?php }
			
			?>
		

	
	</table>
	
	<?php
				$id = $_POST["id_campeonato"];
				$sql_consulta2 = "select usuario from usuario_campeonato where id_campeonato =
						$id";
						
				$resultado = mysqli_query($conexao, $sql_consulta2);
				
				$usuario = mysqli_fetch_array($resultado);
			
				if($_SESSION['usuario'] == $usuario[0]){
					echo"<form action = form_cadastra_placar.php method = 'post'>
							<input type = 'hidden' name = 'id_campeonato' value = '$id' />
							<input type = 'submit' name = 'ok' value = 'Cadastrar placar' />
						</form>";
				}
		
			}
		}
	?>

</body>