<?php
	session_start();
	include("cabecalho.php");	
	include("conexao.php");	
		
?>			
	<div class="container">
      <div class="py-5">
        <h2>Insira o convite do campeonato</h2>
      </div>

      <div class="row">
        <div class="col-md-8 order-md-1"> 
			<form class="needs-validation" novalidate method = "post" action = "entra_campeonato.php">
				<div class="row">
				<div class="col-md-6 mb-3">
                <label>Convite</label>
                <input type="text" class="form-control" name = "convite"  placeholder="codigo" required>
				</div>
				</div>
            <hr class="mb-4">
            <button class="btn btn-primary btn-lg btn-block" type="submit">Inserir</button>
          </form>
        </div>
     </div>
   </div>