<?php
	include("cabecalho.php");
	include("funcoes.php");


	cadastra_placar($_POST['id_jogo'], $_POST['time_casa'], $_POST['time_visitante'], $_POST['gols_casa'], $_POST['gols_visitante']);
	pontuacao_corrida($_POST['id_campeonato']);

?>