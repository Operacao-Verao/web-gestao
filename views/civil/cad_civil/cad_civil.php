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
    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="#000000" viewBox="0 0 256 256" onclick="location = '../civil.php';"><path d="M224,128a8,8,0,0,1-8,8H59.31l58.35,58.34a8,8,0,0,1-11.32,11.32l-72-72a8,8,0,0,1,0-11.32l72-72a8,8,0,0,1,11.32,11.32L59.31,120H216A8,8,0,0,1,224,128Z"></path></svg>
      <h1>Cadastrar Civil</h1>
  </div>
    <form method="post" action="../../../actions/cad_civil.php">
      <div class="inputArea">
        <label for="inputName">Nome*</label>
        <input type="text" name="inputName" id="inputName" placeholder="Ex.: malcolm" required>
      </div>
      <div class="inputArea">
        <label for="inputEmail">Email</label>
        <input type="email" name="inputEmail" id="inputEmail" placeholder="Ex.: samanthazduniak@gmail.com">
      </div>
      <div class="inputArea">
        <label for="inputPassword">Senha</label>
        <input type="password" name="inputPassword" id="inputPassword" placeholder="Ex.: ●●●●●●●●">
      </div>
      <div class="inputArea">
        <label for="inputCpf">CPF*</label>
        <input type="text" name="inputCpf" id="inputCpf" placeholder="Ex.: 53903904920" required>
      </div>
      <div class="inputAreaRow">
        <div class="inputArea">
          <label for="inputCelular">Celular</label>
          <input type="tel" name="inputCelular" id="inputCelular" placeholder="Ex.: 11974764830">
        </div>
        <div class="inputArea">
          <label for="inputTelefone">Telefone</label>
          <input type="tel" name="inputTelefone" id="inputTelefone" placeholder="Ex.: 1140028922">
        </div>
      </div>
      <button class="btnCadastrar">Cadastrar</button>
    </form>
  </main>
</body>

<?php
  echoError();
?>
<script type="text/javascript">
  let exp_nome = /[^a-zA-ZáàÁÀéèÉÈíìÍÌóòÓÒúùÚÙãçÃÇâÂêÊõÕôÔûÛ\s]/g;
  
  function validarCpf(cpf) {
    let acu_v1 = 0;
    for (let i=0; i<9; i++){
      let digit = Number(cpf.charAt(i))||0;
      acu_v1 += digit*(10-i);
    }
    let ver1 = (11 - (acu_v1%11));
    ver1 = ver1>=10? 0: ver1;
    
    let acu_v2 = 0;
    for (let i=0; i<10; i++){
      let digit = Number(cpf.charAt(i))||0;
      acu_v2 += digit*(11-i);
    }
    let ver2 = (11 - (acu_v2%11));
    ver2 = ver2>=10? 0: ver2;
    
    return cpf.charAt(9)==ver1 && cpf.charAt(10)==ver2;
  }
  
  inputName.oninput = function(){
    inputName.value = inputName.value.replace(exp_nome, '').substr(0, 100);
  }
  
  inputEmail.oninput = function(){
    inputEmail.value = inputEmail.value.substr(0, 70);
  }
  
  inputPassword.oninput = function(){
    inputPassword.value = inputPassword.value.substr(0, 70);
  }
  
  inputCpf.oninput = function(){
    inputCpf.value = inputCpf.value.replace(/[^0-9]/g, '').substr(0, 11);
    if (inputCpf.value.length==11){
      if (validarCpf(inputCpf.value)){
        console.log("Cpf válido!");
      }
      else {
        console.log("Cpf inválido!");
      }
    }
  }
  
  inputCelular.oninput = function(){
    inputCelular.value = inputCelular.value.replace(/[^0-9]/g, '').substr(0, 11);
  }
  
  inputTelefone.oninput = function(){
    inputTelefone.value = inputTelefone.value.replace(/[^0-9]/g, '').substr(0, 10);
  }
</script>

</html>