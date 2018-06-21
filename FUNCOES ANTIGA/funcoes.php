<?php
	session_start();
	function autenticacao($post){
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
		mysqli_close($conexao);
	}
?>

<?php 
	function cadastrar($post){
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
			die('Usuário já existente');
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
				$sql_insercao = "INSERT INTO campeonato (id, nome, num_times, tipo)
					VALUES ('$id','$nome_campeonato','$num_times', '$tipo')";
				$resultado = mysqli_query($conexao, $sql_insercao);
				$sql_insercao_ucp = "INSERT INTO usuario_campeonato (usuario, id_campeonato)
					VALUES ('$usuario','$id')";				
				$resultado2 = mysqli_query($conexao, $sql_insercao_ucp);
				die("<br />Campeonato cadastrado com sucesso! <br /> 
				Código para convite: $id");
			}		
			else{
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
			die("<br />Time cadastrado com sucesso!");
		}else{
				die('<br />Já existe um time com esse nome!
				<a href = "meu_time.php">Tente Novamente</a>');
		}
		mysqli_close($conexao);
	}
?>	

<?php 
	function entra_campeonato($post, $session){
		include("conexao.php");
		$convite = $post["convite"];
		$usuario = $session["usuario"];
		$consulta_time = 
		"SELECT nome 
		 FROM time
		 WHERE dono = '$usuario'";
		$res_consulta_time = mysqli_query($conexao, $consulta_time);
		$con_time = mysqli_fetch_assoc($res_consulta_time);
		$sql_consulta = 
		"SELECT tc.nome_time 
		FROM time_campeonato as tc
		WHERE id_campeonato = '$convite'
		and nome_time = '".$con_time['nome']."'";
		$sql_consulta2 = 
		"SELECT t.nome
		 FROM time t
		 INNER JOIN usuario u
		 ON u.nome = t.dono
		 WHERE t.dono = '$usuario'";
		 $sql_consulta3 = 
		"SELECT tipo
		 FROM campeonato
		 WHERE id = '$convite'";
		 $resultado2 = mysqli_query($conexao, $sql_consulta2);
		 $resultado3 = mysqli_query($conexao, $sql_consulta3);
		 $tp = mysqli_fetch_assoc($resultado3);
		 $time = mysqli_fetch_assoc($resultado2);
		$resultado_c = mysqli_query($conexao, $sql_consulta);
		$linhas = mysqli_num_rows($resultado_c);
		if($linhas==0){
			if($tp["tipo"]=="mm"){
				$sql_insercao = 
				 "INSERT INTO time_campeonato(nome_time, id_campeonato, tipo)
				  VALUES('".$con_time['nome']."','$convite','mm')";
				$resultado3 = mysqli_query($conexao, $sql_insercao);
			}else{
				$sql_insercao = 
				 "INSERT INTO time_campeonato(nome_time, id_campeonato, tipo)
				  VALUES('".$con_time['nome']."','$convite','pc')";
				$resultado3 = mysqli_query($conexao, $sql_insercao);
			}
		}else{
			echo "Você já esta cadastrado nesse campeonato";
		}
		echo "<a href = 'meu_usuario.php>Volte para aba usuário</a>'";
		$consulta_time = 
		"SELECT nome 
		 FROM time
		 WHERE dono = '$usuario'
		";
		$res_consulta_time = mysqli_query($conexao, $consulta_time);
		$assoc_time = mysqli_fetch_assoc($res_consulta_time);
		$consulta_tipo = 
		"SELECT *
		 FROM time_campeonato
		 WHERE nome_time = '".$assoc_time["nome"]."'
		";
		$res_consulta_tipo = mysqli_query($conexao, $consulta_tipo);
		$linhas2 = mysqli_num_rows($res_consulta_tipo);
		for($i=0;$i<$linhas2;$i++){
			$vt_ct_assoc = mysqli_fetch_assoc($res_consulta_tipo);
			if($vt_ct_assoc["tipo"]=="mm"){
				$insercao_mm = "INSERT INTO mata_mata(id_campeonato, nome_time, gols_pro, gols_contra, classificado)
				VALUES('".$vt_ct_assoc['id_campeonato']."','".$vt_ct_assoc['nome_time']."','0','0','0')";
				$res_ins_mm = mysqli_query($conexao, $insercao_mm);
			}else{
				$insercao_pc = "INSERT INTO classificacao(id_campeonato, nome_time, gols_pro, gols_contra, saldo_gols, pontuacao)
				VALUES('".$vt_ct_assoc['id_campeonato']."','".$vt_ct_assoc['nome_time']."','0','0','0','0')";
				$res_ins_pc = mysqli_query($conexao, $insercao_pc);
			}
		}
		mysqli_close($conexao);
	}
	
	
?>

