<?php 
include ("cabecalho.php");
include ("conexao.php");
include ("funcoes.php");
?>
	<table border="1">
		<tr>
			<th>Nome Time</th>
		</tr>
		
		<tr>
			 <td>
			 <?php
				mostra_time();
			 ?>
			 </td>
		<tr>
	</table>

	<br>
	<a href="meu_usuario.php">Voltar!</a>