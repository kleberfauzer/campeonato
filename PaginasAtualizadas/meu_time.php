<?php
	include ("conexao.php");
	include ("cabecalho.php");
	include ("funcoes.php");
?>	
	<link href="css/tabela1_css.css" rel="stylesheet">
		
	<body background="css/img/fundo1.jpg">
		<br /><br />
		<h2>Meu time</h2>
		<table border="1">
			<tr>
				<th>Nome time</th>
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
		<p><a href="meu_usuario.php">Voltar </a></p>
	</body>