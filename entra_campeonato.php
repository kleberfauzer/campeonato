<?php
	include("cabecalho.php");
	include("funcoes.php");
	
	if(isset($_SESSION["usuario"])){
		
		entra_campeonato($_POST, $_SESSION);
	}
?>