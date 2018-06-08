<?php


	function cadastra_placar($id_jogo, $time_casa, $time_visitante, $gols_casa, $gols_visitante){
	
		$sql_atualiza_jogo = "UPDATE jogos 
								Set gols_casa = $gols_casa,
								gols_visitante = $gols_visitante
							where id = $id_jogo";
		
		$resultado1 = mysqli_query($sql_atualiza_jogo, $conexao);
	
	}
	
	function pontuação_corrida(){
		
		$sql_casa_vence = "select nome_time_casa
								jogos
								where gols_casa > gols_visitante
								";

		$resultado1 = mysqli_query($sql_casa_vence, $conexao);
		
		$sql_visitante_vence = "select nome_time_visitante
								jogos
								where gols_casa < gols_visitante
								";

		$resultado2 = mysqli_query($sql_visitante_vence, $conexao);
		
		$sql_empate = "select nome_time_visitante, nome_time_casa
								jogos
								where gols_casa = gols_visitante
								";

		$resultado3 = mysqli_query($sql_empate, $conexao);
		
		$linhas1 = mysqli_affected_rows($resultado1);
		
		for($i = 0; $i < $linhas1; $i++){
			
			$vetor = mysqli_fetch_assoc($resultado1);
			if(!isset($pontuacao[$vetor]){
				$pontuacao[$vetor['nome_time_casa']] = 0;
			}else{
				$pontuacao[$vetor]+=3;
			}
			
		}
		
		$linhas2 = mysqli_affected_rows($resultado2);
		
		for($i = 0; $i < $linhas2; $i++){
			
			$vetor = mysqli_fetch_assoc($resultado2);
			if(!isset($pontuacao[$vetor]){
				$pontuacao[$vetor['nome_time_casa']] = 0;
			}else{
				$pontuacao[$vetor]+=3;
			}
			
		}
		
		$linhas3 = mysqli_affected_rows($resultado3);
		
		for($i = 0; $i < $linhas3; $i++){
			
			$vetor = mysqli_fetch_assoc($resultado3);
			if(!isset($pontuacao[$vetor['nome_time_casa']]){
				
				$pontuacao[$vetor['nome_time_casa']] = 0;
				
			}else{
				$pontuacao[$vetor['nome_time_casa']]+=1;
			}
			if(!isset($pontuacao[$vetor['nome_time_visitante']]){
				
				$pontuacao[$vetor['nome_time_visitante']] = 0;
				
			}else{
				$pontuacao[$vetor['nome_time_visitante']]+=1;
			}
			
		}
		
		foreach ($pontuacao[$vetor] as $i => $v){
			
			$sql_pontuacao = "Update classificacao
						set pontuacao = $v
						where nome_time = $i"; 
						
			$resultado4 = mysqli_query($sql_pontuacao, conexao);
		
		}


?>