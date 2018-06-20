<?php
	session_start();
	function autenticacao($post){
		
		if(isset($post)){
			include("conexao.php");
			$sql_consulta = 
				"SELECT usuario,
						senha
				FROM usuario
				";
			$resultado = mysqli_query($conexao, $sql_consulta);
			$linhas = mysqli_num_rows($resultado);
			for($i=0;$i<$linhas;$i++){
				$vetor = mysqli_fetch_assoc($resultado);
				if($post["usuario"] == $vetor["usuario"] && $post["senha"] == $vetor["senha"]){
					$_SESSION["usuario"] = $post["usuario"];
					header("location: meu_usuario.php");
					break;
				}else{
					echo "Usuário ou senha incorreto(s)";
				}
			}
		}
		mysqli_close($conexao);
	}
?>

<?php 
	function cadastrar($post){
		
		if(isset($post["usuario"])){
			include("conexao.php");
			$usuario = $post["usuario"];
			$nome = $post["nome_cliente"];
			$senha = $post["senha"];
			$data_nasc = $post["data"];
			$sql_consulta = 
			"SELECT * FROM usuario WHERE usuario = '$usuario'";
			$resultado = mysqli_query($conexao, $sql_consulta);
			$linhas = mysqli_num_rows($resultado);
			if($linhas==0){
				$sql_insercao = 
				"INSERT INTO usuario(nome, senha, data_nasc, usuario)
				 VALUES ('$nome', '$senha', '$data_nasc', '$usuario');";
				 $insercao = mysqli_query($conexao, $sql_insercao);
				 mysqli_close($conexao);
				 die('Usuário cadastrado com sucesso!');
			}else{
				mysqli_close($conexao);
				die("Usuário já existente! <a href = 'index.php'>Voltar</a>");
			}
			
		}
		
	}
	
	function cadastrar_campeonato($post){
		include("conexao.php");
		$id = mt_rand();
		$usuario = $_SESSION["usuario"];
		$nome_campeonato = $post["nome_camp"];
		$num_times = $post["n_time_camp"];
		$tipo = $post["tipo"];
			if($num_times % 2 == 0){
				$sql_insercao = "INSERT INTO campeonato (id, dono, nome, num_times, tipo)
					VALUES ('$id', '$usuario' ,'$nome_campeonato','$num_times', '$tipo')";
				$resultado = mysqli_query($conexao, $sql_insercao);
				die("<br />Campeonato cadastrado com sucesso! <br /> 
					Código para convite: $id   <a href = 'index.php'>Voltar</a>");
					
			}else{
				die('<br />Número de times inválido, só é permitido um número par!
				<a href = "criar_campeonato.php">Voltar</a>');
			}
			mysqli_close($conexao);
	}?> 

<?php 
	function cadastrar_time($post){
		include("conexao.php");
		$nome_time = $post["n_time"];
		$usuario_dono = $_SESSION["usuario"];
		$sql_consulta = "SELECT * FROM time WHERE nome = '$nome_time'";
		$resultado = mysqli_query($conexao, $sql_consulta);	
		$registros = mysqli_num_rows($resultado);
		if($registros == 0){				
			$sql_insercao = "INSERT INTO time (nome, dono)
					VALUES ('$nome_time', '$usuario_dono')";						
			$resultado2 = mysqli_query($conexao, $sql_insercao);
			die("<br />Time cadastrado com sucesso!<a href = 'index.php'>Voltar</a>");
			}else{
				die('<br />Já existe um time com esse nome!
				<a href = "criar_time.php">Tente Novamente</a>');
		}
		mysqli_close($conexao);
	}
?>	

<?php 
	function entra_campeonato($post, $session){
		include("conexao.php");
		$convite = $post["convite"];
		$usuario = $session["usuario"];
		$sql_consulta = "SELECT * FROM usuario_campeonato WHERE usuario = '$usuario' and 
		id_campeonato = $convite;";
		$sql_consulta2 = 
		"SELECT t.nome
		 FROM time t
		 INNER JOIN usuario u
		 ON u.nome = t.dono
		 WHERE t.dono = '$usuario'";
		 $resultado2 = mysqli_query($conexao, $sql_consulta2);
		 $time = mysqli_fetch_assoc($resultado2);
		$resultado_c = mysqli_query($conexao, $sql_consulta);
		$linhas = mysqli_num_rows($resultado_c);
		if($linhas==0){
			$sql_insercao_ucp = "INSERT INTO usuario_campeonato (usuario, id_campeonato)
							VALUES ('$usuario','$convite')";				
			$resultado = mysqli_query($conexao, $sql_insercao_ucp);
			$sql_insercao = 
			 "INSERT INTO time_campeonato(nome_time, id_campeonato)
			  VALUES('".$time['nome']."',$convite)";
			$resultado3 = mysqli_query($conexao, $sql_insercao);
		}else{
			echo "Você já esta cadastrado nesse campeonato! <a href = 'index.php'>Voltar</a>";
		}
		echo "<a href = 'meu_usuario.php>Volte para aba usuário</a>'";
		mysqli_close($conexao);
	}
?>

<?php

function cadastra_placar($id_jogo, $time_casa, $time_visitante, $gols_casa, $gols_visitante){
	
		$sql_atualiza_jogo = "UPDATE jogos 
								Set gols_casa = $gols_casa,
								gols_visitante = $gols_visitante
							where id = $id_jogo";
		
		$resultado1 = mysqli_query($sql_atualiza_jogo, $conexao);
		
		echo "Placar cadastrado com sucesso!! <a href = 'index.php'>Voltar</a>"; 
	
	}
?>

<?php	

function pontuação_corrida($id_campeonato){
		
		$sql_casa_vence = "select nome_time_casa
								from jogos
								where gols_casa > gols_visitante
								and id_campeonato = '$id_campeonato'
								";

		$resultado1 = mysqli_query($sql_casa_vence, $conexao);
		
		$sql_visitante_vence = "select nome_time_visitante
								from jogos
								where gols_casa < gols_visitante
								and id_campeonato = '$id_campeonato'
								";

		$resultado2 = mysqli_query($sql_visitante_vence, $conexao);
		
		$sql_empate = "select nome_time_visitante, nome_time_casa
								from jogos
								where gols_casa = gols_visitante
								and id_campeonato = '$id_campeonato'
								";

		$resultado3 = mysqli_query($sql_empate, $conexao);
		
		$linhas1 = mysqli_affected_rows($resultado1);
		
		for($i = 0; $i < $linhas1; $i++){
			
			$vetor = mysqli_fetch_assoc($resultado1);
			
			if(!isset($pontuacao[$vetor['nome_time_casa']])){
				$pontuacao[$vetor['nome_time_casa']] = 0;
			}
				$pontuacao[$vetor['nome_time_casa']]+=3;
			
			
		}
		
		$linhas2 = mysqli_affected_rows($resultado2);
		
		for($i = 0; $i < $linhas2; $i++){
			
			$vetor = mysqli_fetch_assoc($resultado2);
			if(!isset($pontuacao[$vetor['nome_time_visitante']])){
				$pontuacao[$vetor['nome_time_visitante']] = 0;
			}
				$pontuacao[$vetor['nome_time_visitante']]+=3;
			
			
		}
		
		$linhas3 = mysqli_affected_rows($resultado3);
		
		for($i = 0; $i < $linhas3; $i++){
			
			$vetor = mysqli_fetch_assoc($resultado3);
			if(!isset($pontuacao[$vetor['nome_time_casa']])){
				
				$pontuacao[$vetor['nome_time_casa']] = 0;
				
			}
				$pontuacao[$vetor['nome_time_casa']]+=1;
			
			if(!isset($pontuacao[$vetor['nome_time_visitante']])){
				
				$pontuacao[$vetor['nome_time_visitante']] = 0;
				
			}
				$pontuacao[$vetor['nome_time_visitante']]+=1;
			
			
		}
		
		foreach ($pontuacao as $i => $v){
			
			$sql_pontuacao = "Update classificacao
						set pontuacao = $v
						where nome_time = '$i'
						and id_campeonato = $id_campeonato"; 
						
			$resultado4 = mysqli_query($sql_pontuacao, $conexao);
		
		}
		
		echo "Campeonato encerrado! <a href = 'index.php'>Voltar</a>";
	}
	
?>

<?php
	function mostra_time(){
		include ("conexao.php");

		mysqli_select_db($conexao, "campeonatos_");
		$usuario = $_SESSION["usuario"];
		$sql="SELECT * FROM time 
		WHERE dono = '$usuario'";

		$resultado=mysqli_query($conexao,$sql);
		
		$linhas = mysqli_num_rows($resultado);
		
		if($linhas == 0){
			echo"Você ainda não possui um time!";
		}else{
			$time = mysqli_fetch_array($resultado);
			echo "".$time[0];
		}
		
		mysqli_close($conexao);

	}
?>
