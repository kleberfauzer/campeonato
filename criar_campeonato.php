<?php
	include("cabecalho.php");
?>
	<div class="container">
      <div class="py-5">
        <h2>Crie seu campeonato</h2>
      </div>

      <div class="row">
        <div class="col-md-8 order-md-1"> 
			<form class="needs-validation" novalidate method = "post" action = "salva_campeonato.php">
				<div class="row">
					<div class="col-md-6 mb-3">
						<label>Nome do campeonato</label>
						<input type="text" class="form-control" name = "nome_camp"  placeholder="Nome" required>
					</div>
					<div class="col-md-6 mb-3">
						<label>Quantidade de times</label>
						<input type="number" class="form-control" name = "n_time_camp"  placeholder="1" required><br >
					</div>
				</div>
            <hr class="mb-4">
            <button class="btn btn-primary btn-lg btn-block" type="submit">Cadastrar</button>
          </form>
        </div>
     </div>
   </div>