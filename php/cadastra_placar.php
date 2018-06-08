<?php


	function cadastra_placar($id_jogo, $time_casa, $time_visitante, $gols_casa, $gols_visitante){
	
		$sql_atualiza_jogo = "UPDATE jogos 
								Set gols_casa = $gols_casa,
								gols_visitante = $gols_visitante
							where id = $id_jogo";
		
		$resultado1 = mysqli_query($sql_atualiza_jogo, $conexao);
		
	
	}


?>