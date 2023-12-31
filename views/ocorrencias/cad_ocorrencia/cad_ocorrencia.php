<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles.css">
  <title>Criar Ocorrência</title>
</head>

<?php
  require '../../../actions/conn.php';
  require '../../../actions/session_auth.php';
  
  require '../../../models/Civil.php';
  require '../../../daos/DAOCivil.php';
  require '../../../models/Residencial.php';
  require '../../../daos/DAOResidencial.php';

  authenticateSession(TIPO_USUARIO::GUEST);
  
  $daoCivil = new DAOCivil($pdo);
  $daoResidencial = new DAOResidencial($pdo);
  
  $civil = null;
  if (array_key_exists('selected_id', $_POST)){
    $civil = $daoCivil->findById($_POST['selected_id']);
  }
?>

<body>
  <main>
  <div class="topRow">
    <?php
      try {
        if($_SESSION["usuario_tipo"] == TIPO_USUARIO::GESTOR) {
          require '../../../partials/svgs/svg_gestao.php';
        } else {
          require '../../../partials/svgs/svg_civil.php';
        }
      } catch (\Throwable $th) {
        echo $th;
      }
    ?>
      <h1>Criar Ocorrência</h1>
  </div>
    <form method="post" action="../../../actions/cad_ocorrencia.php">
      <div class="inputArea">
        <label for="inputName">Nome*</label>
        <?php
          if ($civil){
            echo '<input type="text" name="inputName" id="inputName" placeholder="Ex.: Samantha" value="'.$civil->getNome().'" readonly required>';
          }
          else{
            echo '<input type="text" name="inputName" id="inputName" placeholder="Ex.: Samantha" required>';
          }
        ?>
      </div>
      <div class="inputArea">
        <label for="inputEmail">Email</label>
        <?php
          if ($civil){
            echo '<input type="email" name="inputEmail" id="inputEmail" placeholder="Ex.: samanthazduniak@gmail.com" value="'.$civil->getEmail().'" readonly>';
          }
          else{
            echo '<input type="email" name="inputEmail" id="inputEmail" placeholder="Ex.: samanthazduniak@gmail.com">';
          }
        ?>
      </div>
      <div class="inputArea">
        <label for="inputCpf">CPF*</label>
        <?php
          if ($civil){
            echo '<input type="text" name="inputCpf" id="inputCpf" placeholder="Ex.: 53903904920" value="'.$civil->getCpf().'" readonly required>';
          }
          else{
            echo '<input type="text" name="inputCpf" id="inputCpf" placeholder="Ex.: 53903904920" required>';
          }
        ?>
      </div>
      <div class="inputAreaRow">
        <div class="inputArea">
          <label for="inputCelular">Celular</label>
          <?php
            if ($civil){
              echo '<input type="tel" name="inputCelular" id="inputCelular" placeholder="Ex.: 11974764830" value="'.$civil->getCelular().'" readonly>';
            }
            else{
              echo '<input type="tel" name="inputCelular" id="inputCelular" placeholder="Ex.: 11974764830">';
            }
          ?>
        </div>
        <div class="inputArea">
          <label for="inputTelefone">Telefone</label>
          <?php
            if ($civil){
              echo '<input type="tel" name="inputTelefone" id="inputTelefone" placeholder="Ex.: 1140028922" value="'.$civil->getCelular().'" readonly>';
            }
            else{
              echo '<input type="tel" name="inputTelefone" id="inputTelefone" placeholder="Ex.: 1140028922">';
            }
          ?>
        </div>
      </div>
      <?php
        if ($_SESSION["usuario_tipo"] == TIPO_USUARIO::GESTOR){
          echo '
            <div class="inputAreaRow">
              <div class="inputArea">
                <label for="inputAcionamento">Acionamento*</label>
                <select name="inputAcionamento" required>
                  <option value="web">Formulário do Site</option>
                  <option value="telefone" selected>Telefone</option>
                  <option value="presencial">Presencial</option>
                </select>
              </div>
              <div class="inputArea">
                <label for="inputNumCasas">Casas Envolvidas*</label>
                <input type="number" name="inputNumCasas" placeholder="Ex.: 3" required>
              </div>
            </div>';
        }
        else {
          echo '
            <div class="inputArea">
              <label for="inputNumCasas">Casas Envolvidas*</label>
              <input type="number" name="inputNumCasas" placeholder="Ex.: 3" required>
            </div>';
        }
      ?>
      
      <div class="inputArea">
        <label for="inputRelato">Assunto*</label>
        <textarea name="inputRelato" rows="5"></textarea>
      </div>
      <div class="inputAreaRow">
        <div class="inputArea">
          <label for="inputCep">CEP*</label>
          <input type="text" name="inputCep" id="inputCep" placeholder="Ex.: 07584030" min="8" max="8" required>
        </div>
        <div class="inputArea">
          <label for="inputRua">Rua*</label>
          <input type="text" name="inputRua" id="inputRua" placeholder="Ex.: Av. dos Expedicionários" required>
        </div>
      </div>
      <div class="inputAreaRow">
        <div class="inputArea">
          <label for="inputBairro">Bairro*</label>
          <input type="text" name="inputBairro" id="inputBairro" placeholder="Ex.: Centro" required>
        </div>
        <div class="inputArea">
          <label for="inputCidade">Cidade*</label>
          <select name="inputCidade" id="inputCidade" required>
            <option value="Franco da Rocha" selected>Franco da Rocha</option>
            <option value="Caieiras">Caieiras</option>
            <option value="Francisco Morato">Francisco Morato</option>
            <option value="São Paulo">São Paulo</option>
          </select>
        </div>
      </div>
      <div class="inputAreaRow">
        <div class="inputArea">
          <label for="inputNumero">Número*</label>
          <input type="text" name="inputNumero" id="inputNumero" placeholder="Ex.: 25b" required>
        </div>
        <div class="inputArea">
          <label for="inputComplemento">Complemento</label>
          <input type="text" name="inputComplemento" id="inputComplemento" placeholder="Ex.: Fundos">
        </div>
      </div>

      <button class="btnCadastrar" id="btnCadastrar">Criar</button>
    </form>
  </main>
</body>

<?php
  echoError();
?>
<script src="../../../assets/js/common.js"></script>
<script>
  let valid_cep = false;
  let validating_cep = false;
  
  function goToAction(action, values={}){
    let form = document.createElement('form');
    form.method = 'post';
    form.action = action;
    let submit = document.createElement('input');
    submit.type = 'submit';
    form.appendChild(submit);
    
    for (let name in values){
      let value = document.createElement('input');
      value.name = name;
      value.type = values[name].type || 'text';
      value.value = values[name].value;
      form.appendChild(value);
    }
    
    document.body.appendChild(form);
    submit.click();
    form.remove();
  }
  
  function requestFromAction(action, onSuccess=function(r){}, onError=function(r){}, data={}, method="PUT"){
    fetch(action, {
      "method": method,
      "headers": {"Content-Type": "application/json"},
      "body": method=="GET"?undefined:JSON.stringify(data)
    }).then(
      onSuccess, onError
    );
  }
  
  function tryRequestAndValidateCep(cep){
    validating_cep = true;
    requestFromAction("../../../actions/fetch/get_endereco.php?cep="+cep, function(r){
      r.json().then(function(json){
        //console.log(json);
        if (!json.error){
          valid_cep = true;
        }
        inputRua.value = json.rua||"-";
        inputBairro.value = json.bairro||"-";
        inputCidade.value = json.cidade||"-";
        validating_cep = false;
      });
    }, function(){
      validating_cep = false;
    }, {}, "GET");
  }
  
  inputName.oninput = function(){
    inputName.value = inputName.value.replace(exp_nome, '').substr(0, 100);
  }
  
  inputEmail.oninput = function(){
    inputEmail.value = inputEmail.value.substr(0, 70);
  }
  
  <?php
    if ($_SESSION["usuario_tipo"] == TIPO_USUARIO::GESTOR){
      echo '
        function getCivil(cpf){
          requestFromAction("../../../actions/fetch/get_civil.php", function(r){
            r.json().then(function(json){
              //console.log(json);
              
              if (typeof json.id !== "undefined"){
                inputName.value = json.nome;
                inputEmail.value = json.email;
                inputCelular.value = json.celular;
                inputTelefone.value = json.telefone;
                inputCep.value = json.cep;
                inputCep.oninput();
                inputNumero.value = json.numero;
              }
            })
          }, function(){}, {"cpf": cpf});
        }
        
        inputCpf.oninput = function(){
          inputCpf.value = inputCpf.value.replace(/[^0-9]/g, "").substr(0, 11);
          if (inputCpf.value.length==11){
            getCivil(inputCpf.value);
          }
        }
      ';
    }
    else {
      echo '
        inputCpf.oninput = function(){
          inputCpf.value = inputCpf.value.replace(/[^0-9]/g, "").substr(0, 11);
        }
      ';
    }
  ?>
  
  inputCelular.oninput = function(){
    inputCelular.value = inputCelular.value.replace(/[^0-9]/g, '').substr(0, 11);
  }
  
  inputTelefone.oninput = function(){
    inputTelefone.value = inputTelefone.value.replace(/[^0-9]/g, '').substr(0, 10);
  }
  
  inputCep.oninput = function(){
    inputRua.value = "";
    inputBairro.value = "";
    inputCidade.value = "";
    inputCep.value = inputCep.value.replace(/[^0-9]/g, '').substr(0, 8);
    valid_cep = false;
    if (inputCep.value.length == 8){
      inputRua.value = "...";
      inputBairro.value = "...";
      inputCidade.value = "...";
      tryRequestAndValidateCep(inputCep.value);
    }
  }
  
  inputNumero.oninput = function(){
    inputNumero.value = inputNumero.value.substr(0, 10);
  }
  
  inputComplemento.oninput = function(){
    inputComplemento.value = inputComplemento.value.substr(0, 50);
  }
  
  btnCadastrar.onclick = function(){
    if (inputCpf.value.length!=11 || !validarCpf(inputCpf.value)){
      alert("Informe um CPF válido!");
      return false;
    }
    if (validating_cep){
      alert("Aguarde o CEP ser avaliado pelo servidor");
      return false;
    }
    else if (!valid_cep){
      alert("Informe um CEP válido!");
      return false;
    }
  }
  
  <?php
    if ($civil){
      $residencial = $civil->getIdResidencial()!=null? $daoResidencial->findById($civil->getIdResidencial()): null;
      if ($residencial){
        echo 'inputCep.value = "'.$residencial->getCep().'";';
        echo 'inputCep.oninput();';
        echo 'inputNumero.value = "'.$residencial->getNumero().'";';
      }
    }
  ?>
</script>

</html>