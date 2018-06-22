<!doctype html>
<html lang="BR">
  <head>
    <meta charset="utf-8">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/signin.css" rel= "stylesheet"/>
  </head>
	<body class="text-center" background="css/img/fundo.jpg">
<?php
		if(isset($_SESSION["usuario"])){
			header("location: meu_usuario.php");
		}else{
?>
		<form class="form-signin" method="post" action="autentica.php">
		  <h2>Login</h2>
		  <br />
		  <input type="text" name="usuario" class="form-control" placeholder="Usuário" required>
		  
		  <input type="password" name="senha" class="form-control" placeholder="Senha" required>

		  <br />
		  <button class="btn btn-lg btn-primary btn-block" type="submit">Entrar</button>
			
		  <p class="mt-5 mb-3 text-muted">Ainda não possui cadastro? <a href="cadastro_cliente.php">Cadastre-se</a></p>
		  <p class="mt-5 mb-3 text-muted">&copy; Todos os direitos reservados</p>
		</form>
<?php
		}
	include("rodape.php");
?>
