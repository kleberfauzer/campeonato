<?php
	include("conexao.php");
	include("cabecalho.php");
	
	if(isset($_POST["id"])){
		$id_campeonato = $_POST["id"];
		$sql = "SELECT cp.id, cp.nome, cp.num_times, c.nome_time, c.gols_pro, c.gols_contra, c.saldo_gols, c.pontuacao 
				FROM campeonato cp
				INNER JOIN classificacao c
				ON cp.id = c.id_campeonato
				WHERE cp.id = '$id_campeonato'";
		$resultado = mysqli_query($conexao, $sql);
		$linhas = mysqli_num_rows($resultado);
		
		if($linhas != 0){
		
			while( ($vetor = mysqli_fetch_array($resultado)) != NULL ){
				$campeonato = $vetor[1];
				$pt[$vetor[3]] = $vetor[7]; 
				$gp[$vetor[3]] = $vetor[4]; 
				$gc[$vetor[3]] = $vetor[5];
				$saldo_gols[$vetor[3]] = $gp[$vetor[3]] - $gc[$vetor[3]];
			}
			arsort($pt);
?>
		
		<link href="css/tabela3_css.css" rel="stylesheet">
		
		<h2>Pontuacao do campeonato</h2>
		
		<div class = "pontos1">
		<table border = "1">
				<tr>
					<th colspan = "5"><?=$campeonato;?></th>
				</tr>
				<tr>
					<th>Time</th>
					<th>Pontuacao</th>
					<th>Gols Pro</th>
					<th>Gols Contra</th>
					<th>Saldo de Gols</th>
				</tr>
	
		
<?php			
			foreach($pt as $i => $v){
?>									
				<tr>
					<td><?=$i;?></td>
					<td><?=$v;?></td>
					<td><?=$gp[$i];?></td>
					<td><?=$gc[$i];?></td>
					<td><?=$saldo_gols[$i];?></td>
				</tr>
<?php
			}
?>
			</table>
			</div>
<?php
			$sql = "SELECT cp.num_times FROM campeonato cp";
			$resultado = mysqli_query($conexao, $sql);
			$vetor = mysqli_fetch_array($resultado);
			
			$sql2 = "SELECT * FROM jogo j WHERE id_campeonato = '$id_campeonato'";
			$resultado2 = mysqli_query($conexao, $sql2);
			$linhas = mysqli_num_rows($resultado2);
			
		}else{
			echo "Não há times no campeonato!<br />";
			$sql = "SELECT * FROM classificacao c where id_campeonato = '$id_campeonato'";
			$resultado = mysqli_query($conexao, $sql);
			$linhas = mysqli_num_rows($resultado);
			$sql = "SELECT num_times FROM campeonato cp WHERE id = '$id_campeonato'";
			$resultado2 = mysqli_query($conexao, $sql);
			$vetor = mysqli_fetch_array($resultado2);
			echo "Há " . $linhas . " de " . $vetor[0] . " times";
		}
		
	}else if(isset($_POST["id_meu_campeonato"])){
		$id_campeonato = $_POST["id_meu_campeonato"];
		$sql = "SELECT cp.id, cp.nome, cp.num_times, c.nome_time, c.gols_pro, c.gols_contra, c.saldo_gols, c.pontuacao 
				FROM campeonato cp
				INNER JOIN classificacao c
				ON cp.id = c.id_campeonato
				WHERE cp.id = '$id_campeonato'";
		$resultado = mysqli_query($conexao, $sql);
		$linhas = mysqli_num_rows($resultado);
		
		if($linhas != 0){
		
			while( ($vetor = mysqli_fetch_array($resultado)) != NULL ){
				$campeonato = $vetor[1];
				$pt[$vetor[3]] = $vetor[7];
				$gp[$vetor[3]] = $vetor[4];
				$gc[$vetor[3]] = $vetor[5];
				$saldo_gols[$vetor[3]] = $gp[$vetor[3]] - $gc[$vetor[3]];
			}
			arsort($pt);
	
?>	
		<div class = "pontos2">
		<table border = "1">
				<tr>
					<th colspan = "5"><?=$campeonato;?></th>
				</tr>
				<tr>
					<th>Time</th>
					<th>Pontuacao</th>
					<th>Gols Pro</th>
					<th>Gols Contra</th>
					<th>Saldo de Gols</th>
				</tr>
<?php
			foreach($pt as $i => $v){
?>
				
				<tr>
					<td><?=$i;?></td>
					<td><?=$v;?></td>
					<td><?=$gp[$i];?></td>
					<td><?=$gc[$i];?></td>
					<td><?=$saldo_gols[$i];?></td>
				</tr>
			
<?php
			}
?>
			</table>
			</div>
<?php
			$sql = "SELECT cp.num_times FROM campeonato cp WHERE id = '$id_campeonato'";
			$resultado = mysqli_query($conexao, $sql);
			$vetor = mysqli_fetch_array($resultado);
			$sql2 = "SELECT * FROM classificacao c WHERE c.id_campeonato = '$id_campeonato'";
			$resultado2 = mysqli_query($conexao, $sql2);
			$linhas = mysqli_num_rows($resultado2);
			
			if($linhas == $vetor[0]){
?>
				<form action = "jogo.php" method = "post">
					<input type = "hidden" name = "comecar" value = "<?=$id_campeonato;?>" />
					<input type = "submit" value = "Começar!" />
				</form>
<?php
			}
		}else{
			$sql = "SELECT cp.nome FROM campeonato cp where id = '$id_campeonato'";
			$resultado = mysqli_query($conexao, $sql);
			$vetor = mysqli_fetch_array($resultado);
			echo "Campeonato: ".$vetor[0]."<br />";
			echo "Não há times no campeonato!<br />";
			$sql = "SELECT * FROM classificacao c where id_campeonato = '$id_campeonato'";
			$resultado = mysqli_query($conexao, $sql);
			$linhas = mysqli_num_rows($resultado);
			$sql = "SELECT num_times FROM campeonato cp WHERE id = '$id_campeonato'";
			$resultado2 = mysqli_query($conexao, $sql);
			$vetor = mysqli_fetch_array($resultado2);
			echo "Há " . $linhas . " de " . $vetor[0] . " times";
		}
	}else{
		header("location: index.php");
	}
?>