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
			$cont=0;
			$campeao = "";
			foreach($pt as $i => $v){
				
				if($cont == 0){
					$campeao = $i;
				}			
				
?>
				
				<tr>
					<th><?=$i;?></th>
					<th><?=$v;?></th>
					<th><?=$gp[$i];?></th>
					<th><?=$gc[$i];?></th>
					<th><?=$saldo_gols[$i];?></th>
				</tr>
			
<?php
			$cont++;
			}
			
			$sql = "select max(pontuacao) from classificacao where id_campeonato = '$id_campeonato'";
			$resultado = mysqli_query($conexao, $sql);
			$vetor = mysqli_fetch_array($resultado);
			
			$sql = "Select c.nome_time FROM classificacao c where c.id_campeonato = '$id_campeonato' and c.pontuacao = '$vetor[0]'";
			$resultado = mysqli_query($conexao, $sql);
			
			while( ($vetor = mysqli_fetch_array($resultado))!= NULL ){
				if($vetor[0] != $campeao){
					if($campeao != ""){
						$campeao .= ", $vetor[0]";
					}else{
						$campeao .= "$vetor[0]";
					}
				}
			}
			
			
			echo '<tr>
					<td colspan = "3">Campeão(ões) Atual(is)</td>
					<td colspan = "2">'.$campeao.'</td>
				</tr>';
?>
			</table>
<?php
			$sql = "SELECT cp.num_times FROM campeonato cp";
			$resultado = mysqli_query($conexao, $sql);
			$vetor = mysqli_fetch_array($resultado);
			
			$sql2 = "SELECT * FROM jogo j WHERE id_campeonato = '$id_campeonato'";
			$resultado2 = mysqli_query($conexao, $sql2);
			$linhas = mysqli_num_rows($resultado2);
			
		}else{
			echo "Não há times no campeonato!<br />";
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
			arsort($saldo_gols);
?>	
	
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
			$cont=0;
			foreach($pt as $i => $v){
				
				if($cont == 0){
					$campeao = $i;
				}			
				
?>
				
				<tr>
					<th><?=$i;?></th>
					<th><?=$v;?></th>
					<th><?=$gp[$i];?></th>
					<th><?=$gc[$i];?></th>
					<th><?=$saldo_gols[$i];?></th>
				</tr>
			
<?php
			$cont++;
			}
			
			$sql = "select max(pontuacao) from classificacao where id_campeonato = '$id_campeonato'";
			$resultado = mysqli_query($conexao, $sql);
			$vetor = mysqli_fetch_array($resultado);
			
			$sql = "Select c.nome_time FROM classificacao c where c.id_campeonato = '$id_campeonato' and c.pontuacao = '$vetor[0]'";
			$resultado = mysqli_query($conexao, $sql);
			
			while( ($vetor = mysqli_fetch_array($resultado))!= NULL ){
				if($vetor[0] != $campeao){
					if($campeao != ""){
						$campeao .= ", $vetor[0]";
					}else{
						$campeao .= "$vetor[0]";
					}
				}
			}
			
			
			echo '<tr>
					<td colspan = "3">Campeão(ões) Atual(is)</td>
					<td colspan = "2">'.$campeao.'</td>
				</tr>';
?>
			</table>
<?php
			$sql = "SELECT cp.num_times FROM campeonato cp WHERE id = '$id_campeonato'";
			$resultado = mysqli_query($conexao, $sql);
			$vetor = mysqli_fetch_array($resultado);
			$sql2 = "SELECT * FROM classificacao c WHERE c.id_campeonato = '$id_campeonato'";
			$resultado2 = mysqli_query($conexao, $sql2);
			$linhas = mysqli_num_rows($resultado2);
			
			$sql3 = "SELECT * FROM jogo where id_campeonato = '$id_campeonato'";
			$resultado = mysqli_query($conexao, $sql3);
			$registros = mysqli_num_rows($resultado);
			
			if($linhas == $vetor[0] && $registros == 0){
?>
				<form action = "jogo.php" method = "post">
					<input type = "hidden" name = "comecar" value = "<?=$id_campeonato;?>" />
					<input type = "submit" value = "Começar!" />
				</form>
<?php
			}echo "<form action = 'form_cadastra_placar.php' method = 'post'>
					<input type = 'hidden' name = 'id_campeonato' value = '$id_campeonato' />
					<input type = 'submit' value = 'Atualizar placar!' />
				</form>";
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