<?php 
	session_start();
	include("cabecalho.php");
	include("conexao.php");
?>
	<br><h2>Bem-Vindo, <?=$_SESSION["usuario"];?></h2>
	<p>Você possuí 
	<?php
	$usuario = $_SESSION["usuario"];
	$sql_consulta = 
	"SELECT dono
	 FROM time
	 WHERE dono = '$usuario';";
	 $resultado = mysqli_query($conexao, $sql_consulta);
	 $linhas = mysqli_num_rows($resultado);
	 if($linhas==0){
		 echo "0 times, crie um em <a href = 'criar_time.php'>CRIAR TIME</a>";
	 }else{
		 echo "1 time.";
	 }
	 mysqli_close($conexao);
	 ?>
	 </p>
	 