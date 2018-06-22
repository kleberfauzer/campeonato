<?php 
	session_start();
	include("cabecalho.php");
	include("conexao.php");
?>
	<br>
	<body background="css/img/fundo5.jpg" />
	<h2 class="bemvindo">Bem-Vindo(a), <?=$_SESSION["usuario"];?></h2>
	
	<p class="texto">Você possui
	<?php
	$usuario = $_SESSION["usuario"];
	$sql_consulta = 
	"SELECT dono
	FROM time
	WHERE dono = '$usuario';";
	$resultado = mysqli_query($conexao, $sql_consulta);
	$linhas = mysqli_num_rows($resultado);
	if($linhas==0){
		echo "0 times cadastrados, deseja cadastrar um novo time? <a href = 'criar_time.php'>Clique aqui</a>";
	}else{
		echo "1 time.";
	}
	mysqli_close($conexao);
	?>
	</p>