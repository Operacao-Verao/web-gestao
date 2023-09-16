<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles.css">
  <title>Cadastrar Civil</title>
</head>

<body>
  <main>
    <h1>Cadastrar Civil</h1>
    <form method="post" action="../../../actions/cad_civil.php">
      <div class="inputArea">
        <label for="inputName">Nome*</label>
        <input type="text" name="inputName" placeholder="Ex.: Samantha" required>
      </div>
      <div class="inputArea">
        <label for="inputEmail">Email*</label>
        <input type="email" name="inputEmail" placeholder="Ex.: samanthazduniak@gmail.com" required>
      </div>
      <div class="inputArea">
        <label for="inputPassword">Senha*</label>
        <input type="password" name="inputPassword" placeholder="Ex.: ********" required>
      </div>
      <div class="inputArea">
        <label for="inputCpf">CPF*</label>
        <input type="text" name="inputCpf" placeholder="Ex.: 53903904920" required>
      </div>
      <div class="inputAreaRow">
        <div class="inputArea">
          <label for="inputCelular">Celular</label>
          <input type="tel" name="inputCelular" placeholder="Ex.: 11974764830">
        </div>
        <div class="inputArea">
          <label for="inputTelefone">Telefone</label>
          <input type="tel" name="inputTelefone" placeholder="Ex.: 1140028922">
        </div>
      </div>
      <button class="btnCadastrar">Cadastrar</button>
    </form>
  </main>
</body>

</html>