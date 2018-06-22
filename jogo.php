<?php
	include("conexao.php");
	if(isset($_POST["comecar"])){
		$id_campeonato = $_POST["comecar"];
		$sql = "SELECT c.nome_time 
				FROM classificacao c
				WHERE c.id_campeonato = '$id_campeonato'";
		$resultado = mysqli_query($conexao, $sql);
		$resultado2 = mysqli_query($conexao, $sql);
		
		while( ($vetor = mysqli_fetch_array($resultado)) != NULL ){
			
				$sql = "SELECT c.nome_time 
				FROM classificacao c
				WHERE c.id_campeonato = '$id_campeonato'";
				$resultado2 = mysqli_query($conexao, $sql);
			while( ($vetor2 = mysqli_fetch_array($resultado2)) != NULL ){	
				if($vetor[0] != $vetor2[0]){
					
					$sql3 = "SELECT * 
							FROM jogo 
							WHERE nome_time_casa = '$vetor[0]'
							AND nome_time_visitante = '$vetor2[0]'";
					$resultado3 = mysqli_query($conexao, $sql3);
					
					$registros3 = mysqli_num_rows($resultado3);
					
					if($registros3 == 0){
						$sql4 = "SELECT * 
							FROM jogo 
							WHERE nome_time_casa = '$vetor2[0]'
							AND nome_time_visitante = '$vetor[0]'
							AND id_campeonato = '$id_campeonato'";
						$resultado4 = mysqli_query($conexao, $sql4);
						$registros4 = mysqli_num_rows($resultado4);
						
						if($registros4 == 0){
							
							$id_jogo = mt_rand();
							//CADASTRA JOGO
							$sql5 = "INSERT INTO jogo 
							        VALUES('$id_jogo','$id_campeonato','$vetor[0]',0,0,'$vetor2[0]')";
									
							$resultado5 = mysqli_query($conexao, $sql5);
							
							//CADASTRA tabela jogo_classificacao
							$sql6 = "INSERT INTO jogo_classificacao
									VALUES('$id_campeonato','$id_jogo')";
							$resultado6 = mysqli_query($conexao, $sql6);
							
							//CADASTRA tabela time_jogo o 'nome_time_casa'
							$sql7 = "INSERT INTO time_jogo
									VALUES('$vetor[0]','$id_jogo')";
							$resultado7 = mysqli_query($conexao, $sql7);
							
							//CADASTRA tabela time_jogo o 'nome_time_visitante'
							$sql8 = "INSERT INTO time_jogo
									VALUES('$vetor2[0]','$id_jogo')";
							$resultado8 = mysqli_query($conexao, $sql8);
						}
					}
				}
			}	
		}
		
	}
	
	header("location: exibe_jogos.php");
	
	
?>