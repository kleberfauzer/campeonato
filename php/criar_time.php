<?php
	include("cabecalho.php");
?>
	<div class="container">
      <div class="py-5">
        <h2>Crie seu time</h2>
      </div>

      <div class="row">
        <div class="col-md-8 order-md-1"> 
			<form class="needs-validation" novalidate method = "post" action = "salva_time.php">
				<div class="row">
				<div class="col-md-6 mb-3">
                <label>Nome do time</label>
                <input type="text" class="form-control" name = "n_time"  placeholder="Nome" required>
				</div>
				</div>
            <hr class="mb-4">
            <button class="btn btn-primary btn-lg btn-block" type="submit">Cadastrar</button>
          </form>
        </div>
     </div>
   </div>