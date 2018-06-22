<?php
	session_start();
	include("cabecalho.php");
	include("conexao.php");	
	
		if(isset($_SESSION["usuario"])){
?>
			<form action = "entra_campeonato.php" method = "POST">
				<label>
				Coloque o código de convite para entrar em um campeonato:<br />
				<input type = "text" name = "convite">
				</label><br />
				<input type = "submit" value = "Entrar!">
			</form>
		<?php
			$usuario = $_SESSION["usuario"];
		
			$sql_meus_campeonatos = "SELECT cp.nome, cp.id
									 FROM campeonato cp
									 INNER JOIN usuario_campeonato uc
									 ON cp.id = uc.id_campeonato
									 WHERE uc.usuario = '$usuario'";
			$resultado = mysqli_query($conexao, $sql_meus_campeonatos);
?>			
			<table border = "1">
				
				<tr>
					<th colspan = "2">Meu (s) Campeonato(s)</th>
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
						<input type = "submit" value = "Ver Mais" />	
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
		<table border = "1">
			
			<tr>
				<th colspan = "3">Campeonato(s)</th>
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
					<input type = "submit" value  = "Ver Mais" />
				</td>
			</tr>
				</form>
<?php
			}
		}
?>
			
		</table>