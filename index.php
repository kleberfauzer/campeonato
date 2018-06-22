<?php 
	session_start();
	include("cabecalho.php");
	
	if(isset($_SESSION['usuario'])){
		header("location: meu_usuario.php");
	}else{
?>
	<body class="text-center" background="">
		<form class="form-signin" method="post" action="autentica.php">
		  <h2>Login</h2>
		  <br />
		  <input type="text" name="usuario" class="form-control" placeholder="user" required>
		  
		  <input type="password" name="senha" class="form-control" placeholder="Senha" required>

		  <button class="btn btn-lg btn-primary btn-block" type="submit">Entrar</button>

		  <p class="mt-5 mb-3 text-muted">Ainda não possui cadastro? <a href="cadastro_cliente.php">Cadastre-se</a></p>
		  <p class="mt-5 mb-3 text-muted">&copy; Todos os direitos reservados</p>
		</form>
<?php
	}
	include("rodape.php");
?>
