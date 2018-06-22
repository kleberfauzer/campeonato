<!doctype html>
<html lang="BR">
  <head>
    <meta charset="utf-8">
    <title>Cadastro cliente</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/form-validation.css" rel="stylesheet">
  </head>
  <body class="bg-light">
    <div class="container">
      <br /><br />
        <h2>Cadastre-se</h2>
    
	  <br />
	  <br />
      <div class="row">
        <div class="col-md-8 order-md-1"> 
			<form class="needs-validation" novalidate method = "post" action = "salva_cliente.php">
				<div class="row">
				<div class="col-md-6 mb-3">
                <label>Nome</label>
                <input type="text" class="form-control" name = "nome_cliente"  placeholder="Nome" required>
				</div>
				</div>
				<div class="mb-3">
				  <label>Data de Nascimento</label>
				  <input type="date" class="form-control" name="data">
				</div>
				
				<div class="mb-3">
				  <label>Usuário</label>
				  <input type="text" class="form-control" name="usuario" placeholder="Usuário" required>
				</div>
			

				<div class="mb-3">
				  <label>Email</label>
				  <input type="email" class="form-control" name="email" placeholder="nome@exemplo.com">
				</div>

				<div class="mb-3">
				  <label>Senha</label>
				  <input type="password" class="form-control" name = "senha" placeholder="Senha" required>
				</div>
				
            <hr class="mb-4">
            <button class="btn btn-primary btn-lg btn-block" type="submit">Enviar</button>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>