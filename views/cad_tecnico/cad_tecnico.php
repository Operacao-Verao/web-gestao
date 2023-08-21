<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<script src="https://unpkg.com/@phosphor-icons/web"></script>
	<link rel="stylesheet" href="./styles.css" />
	<title>Defesa Civil - Cadastrar Técnico</title>
</head>

<body>
    <section class="area-cad">
        <div class="cad">

          <h1>Cadastrar Técnico</h1>

          <form method="post" action="../../actions/cad_tecnico.php">
                Nome
                <input type="text" id="email" name="edtnome" autofocus><br>
                Email
                <input type="text" id="email" name="edtemail"><br>
                Senha
                <input type="password" id="senha" name="edtsenha"><br>
                Confirmar Senha
                <input type="password" id="senha" name="edtsenhaconfirm">

           <button type="submit">Cadastrar</button>
          </form>
        </div>
      </section>

</body>