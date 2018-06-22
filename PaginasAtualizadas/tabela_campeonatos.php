<?php
	session_start();
	include("cabecalho.php");	
	include("conexao.php");	
		if(isset($_SESSION["usuario"])){

			$usuario = $_SESSION["usuario"];
		
			$sql_meus_campeonatos = "SELECT cp.nome, cp.id
									 FROM campeonato cp
									 INNER JOIN usuario_campeonato uc
									 ON cp.id = uc.id_campeonato
									 WHERE uc.usuario = '$usuario'";
			$resultado = mysqli_query($conexao, $sql_meus_campeonatos);
?>			
			<link href="css/tabela2_css.css" rel="stylesheet">
			<table class ="meucampeonato" border = "1">
				<tr>
					<th colspan = "2">Meus Campeonatos</th>
				</tr>
				<tr>
					<th>Nome</th>
					<th>Ação</th>
				</tr>
<?php
			while( ($vetor = mysqli_fetch_array($resultado)) != NULL){
?>
				<form action = "ver_mais.php" method = "post">
				<tr>
					<td><?=$vetor[0];?></td>
					<td>
						<input type = "submit" value = "ver mais" />	
						<input type = "hidden" name = "id_meu_campeonato" value = "<?=$vetor[1];?>">
					</td>
						
				</tr>
				</form>
<?php
			}
?>
				
			</table>
<?php		
			$sql_campeonatos = "SELECT uc.usuario, cp.nome, cp.id 
								FROM campeonato cp 
								INNER JOIN usuario_campeonato uc
								ON cp.id = uc.id_campeonato";
			$resultado = mysqli_query($conexao, $sql_campeonatos);
?>
		<table class ="campeonato" border = "1">
			
			<tr>
				<th colspan = "3">Campeonatos</th>
			</tr>
			<tr>
				<th>Criador</th>
				<th>Nome</th>
				<th>Ação</th>
			</tr>
<?php
			while( ($vetor = mysqli_fetch_array($resultado)) != NULL){
?>
				<form action = "ver_mais.php" method = "POST">
			<tr>
				<td><?=$vetor[0];?></td>
				<td><?=$vetor[1];?></td>
				<td>
					<input type = "hidden" name = "id" value = "<?=$vetor[2];?>">
					<input type = "submit" value  = "ver mais" />
				</td>
			</tr>
				</form>
<?php
			}
		}
?>
		</table>