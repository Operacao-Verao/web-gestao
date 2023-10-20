<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles.css">
  <title>Cadastrar Civil</title>
</head>

<?php
  require '../../../actions/conn.php';
  require '../../../actions/session_auth.php';
  authenticateSession(TIPO_USUARIO::GESTOR, '', '../../login/login.php');
?>

<body>
  <main>
  <div class="topRow">
    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="#000000" viewBox="0 0 256 256" onclick="history.back()"><path d="M224,128a8,8,0,0,1-8,8H59.31l58.35,58.34a8,8,0,0,1-11.32,11.32l-72-72a8,8,0,0,1,0-11.32l72-72a8,8,0,0,1,11.32,11.32L59.31,120H216A8,8,0,0,1,224,128Z"></path></svg>
      <h1>Cadastrar Civil</h1>
  </div>
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