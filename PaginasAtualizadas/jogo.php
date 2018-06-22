<?php
	include("conexao.php");
	if(isset($_POST["comecar"])){
		$id_campeonato = $_POST["comecar"];
		$sql = "SELECT c.nome_time 
				FROM classificacao c
				WHERE c.id_campeonato = '$id_campeonato'";
		$resultado = mysqli_query($conexao, $sql);
		
		$id_campeonato = $_POST["comecar"];
		$sql = "SELECT c.nome_time 
				FROM classificacao c
				WHERE c.id_campeonato = '$id_campeonato'";
		$resultado2 = mysqli_query($conexao, $sql);
		
		while( ($vetor = mysqli_fetch_array($resultado)) != NULL ){
			
			while( ($vetor2 = mysqli_fetch_array($resultado2)) != NULL ){
				if($vetor[0] != $vetor2[0]){
					$sql = "SELECT * FROM jogo j
							WHERE j.nome_time_casa = '$vetor[0]'
							AND j.nome_time_visitante = '$vetor2[0]'
							AND j.id_campeonato = '$id_campeonato'
							ORDER BY RAND()";
					$resultado = mysqli_query($conexao, $sql);
					$linhas = mysqli_num_rows($resultado);
					
					if($linhas == 0){
						$sql = "SELECT * FROM jogo j
							WHERE j.nome_time_casa = '$vetor2[0]'
							AND j.nome_time_visitante = '$vetor[0]'
							AND j.id_campeonato = '$id_campeonato'";
						$resultado = mysqli_query($conexao, $sql);
						$linhas = mysqli_num_rows($resultado);
					
						if($linhas == 0){
							$id_jogo = mt_rand();
							$sql = "INSERT INTO jogo
									VALUES('$id_jogo','$id_campeonato','$vetor[0]','0','0','$vetor2[0]');";
							$resultado = mysqli_query($conexao, $sql);
							
							$sql = "INSERT INTO jogo_classificacao
									VALUES('$id_campeonato','$id_jogo')";
							$resultado = mysqli_query($conexao, $sql);
							$sql = "INSERT INTO time_jogo
									VALUES('$vetor[0]','$id_jogo')";
							$resultado = mysqli_query($conexao, $sql);
							
							$sql = "INSERT INTO time_jogo
									VALUES('$vetor2[0]','$id_jogo')";
							$resultado = mysqli_query($conexao, $sql);
						}
					}
				}
			}
		}
		
	}
	
	header("location: exibe_jogos.php");
?>