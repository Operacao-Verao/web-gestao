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
  require '../../../models/Civil.php';
  require '../../../daos/DAOCivil.php';
  
  $daoCivil = new DAOCivil($pdo);
  
  $civil = null;
  if (array_key_exists('selected_id', $_POST)){
    $civil = $daoCivil->findById($_POST['selected_id']);
  }
?>

<body>
  <main>
  <div class="topRow">
    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="#000000" viewBox="0 0 256 256" onclick="history.back()"><path d="M224,128a8,8,0,0,1-8,8H59.31l58.35,58.34a8,8,0,0,1-11.32,11.32l-72-72a8,8,0,0,1,0-11.32l72-72a8,8,0,0,1,11.32,11.32L59.31,120H216A8,8,0,0,1,224,128Z"></path></svg>
      <h1>Criar Ocorrência</h1>
  </div>
    <form method="post" action="../../../actions/cad_ocorrencia.php">
      <div class="inputArea">
        <label for="inputName">Nome*</label>
        <?php
          if ($civil){
            echo '<input type="text" name="inputName" placeholder="Ex.: Samantha" value="'.$civil->getNome().'" readonly required>';
          }
          else{
            echo '<input type="text" name="inputName" placeholder="Ex.: Samantha" required>';
          }
        ?>
      </div>
      <div class="inputArea">
        <label for="inputEmail">Email</label>
        <?php
          if ($civil){
            echo '<input type="email" name="inputEmail" placeholder="Ex.: samanthazduniak@gmail.com" value="'.$civil->getEmail().'" readonly>';
          }
          else{
            echo '<input type="email" name="inputEmail" placeholder="Ex.: samanthazduniak@gmail.com">';
          }
        ?>
      </div>
      <div class="inputArea">
        <label for="inputCpf">CPF*</label>
        <?php
          if ($civil){
            echo '<input type="text" name="inputCpf" placeholder="Ex.: 53903904920" value="'.$civil->getCpf().'" readonly required>';
          }
          else{
            echo '<input type="text" name="inputCpf" placeholder="Ex.: 53903904920" oninput="getCivil(this.value)" required>';
          }
        ?>
      </div>
      <div class="inputAreaRow">
        <div class="inputArea">
          <label for="inputCelular">Celular</label>
          <?php
            if ($civil){
              echo '<input type="tel" name="inputCelular" placeholder="Ex.: 11974764830" value="'.$civil->getCelular().'" readonly required>';
            }
            else{
              echo '<input type="tel" name="inputCelular" placeholder="Ex.: 11974764830" required>';
            }
          ?>
        </div>
        <div class="inputArea">
          <label for="inputTelefone">Telefone</label>
          <?php
            if ($civil){
              echo '<input type="tel" name="inputTelefone" placeholder="Ex.: 1140028922" value="'.$civil->getCelular().'" readonly>';
            }
            else{
              echo '<input type="tel" name="inputTelefone" placeholder="Ex.: 1140028922">';
            }
          ?>
        </div>
      </div>
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
      </div>
      <div class="inputArea">
        <label for="inputRelato">Relato do Civil*</label>
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
          <input type="text" name="inputNumero" placeholder="Ex.: 25b" required>
        </div>
        <div class="inputArea">
          <label for="inputComplemento">Complemento</label>
          <input type="text" name="inputComplemento" placeholder="Ex.: Fundos">
        </div>
      </div>

      <button class="btnCadastrar">Criar</button>
    </form>
  </main>
</body>

<script>
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
  
  function getCivil(cpf){
    requestFromAction("../../../actions/fetch/get_civil.php", function(r){
      r.json().then(function(json){
        //console.log(json);
        
        if (Object.keys(json).length > 0){
          document.getElementsByName("inputName")[0].value = json.nome;
          document.getElementsByName("inputEmail")[0].value = json.email;
          document.getElementsByName("inputCelular")[0].value = json.celular;
          document.getElementsByName("inputTelefone")[0].value = json.telefone;
          /*
          if (json.cep[0] != '-'){
            document.getElementsByName("inputCep")[0].value = json.cep;
          }
          */
        }
      })
    }, function(){}, {'cpf': cpf});
  }
  
  inputCep.oninput = function(){
    if (inputCep.value.length == 8){
      console.log(inputCep.value); // 01001000
      requestFromAction("https://viacep.com.br/ws/"+inputCep.value+"/json/", function(r){
        r.json().then(function(json){
          console.log(json);
          inputRua.value = json.logradouro||"";
          inputBairro.value = json.bairro||"";
          inputCidade.value = json.localidade||"";
        });
      }, function(r){throw r;}, {}, "GET");
    }
  }
</script>

</html>