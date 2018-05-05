<?php
	session_start();
	include("cabecalho.php");
		
		if(isset($_SESSION["usuario"])){
?>
			<form action = "entra_campeonato.php" method = "POST">
				<label>
				Coloque o código de convite para entrar em um campeonato:<br />
				<input type = "text" name = "convite">
				</label><br />
				<input type = "submit" value = "Entrar!">
			</form>
		<?php }
		?>