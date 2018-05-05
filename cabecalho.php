<!DOCTYPE HTML>
<html lang="BR">
	<head>
		<title>Bem vindo</title>
		<meta charset = "UTF-8" />
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/signin.css" rel="stylesheet">
	</head>
<?php 
	if(isset($_SESSION["usuario"])){
		echo 
		"<a href = 'meu_time.php'>Meu time</a>  || 
		<a href = 'campeonato.php'>Campeonato(s)</a>  || 
		<a href = 'sair.php'>Sair</a>";
	}else{
		
	}
?>