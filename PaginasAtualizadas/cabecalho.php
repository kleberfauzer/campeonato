<!DOCTYPE HTML>
<html lang="BR">
  <head>
    <meta charset="utf-8">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/pricing.css" rel="stylesheet">
    <link href="css/center_css.css" rel="stylesheet">
  </head>

	<?php 
	//include("modonoturno.html");
	//if(isset($_SESSION["usuario"])){
	?>
	
	<body id="muda">
    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom box-shadow">
      <h5 class="my-0 mr-md-auto font-weight-normal">Painel de navegação</h5>
      <nav class="my-2 my-md-0 mr-md-3">
		<a class="p-2 text-dark" href="meu_time.php">Meu time</a>
		<a class="p-2 text-dark" href = "criar_campeonato.php">Criar Campeonato</a> 
		<a class="p-2 text-dark" href="campeonatos.php">Campeonato</a>
		<a class="p-2 text-dark" href="tabela_campeonatos.php"> Ver meus campeonatos</a>
		<a class="p-2 text-dark" href="exibe_jogos.php">Jogos </a>
		
      </nav>
      <a class="btn btn-outline-primary" href="sair.php">Sair</a>
    </div>
	<?php
	//}
    ?>
	</body>
</html>