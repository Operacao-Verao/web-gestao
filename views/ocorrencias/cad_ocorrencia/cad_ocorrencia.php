<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles.css">
  <title>Criar Ocorrência</title>
</head>

<body>
  <main>
    <h1>Criar Ocorrência</h1>
    <form method="post" action="../../../actions/cad_ocorrencia.php">
      <div class="inputArea">
        <label for="inputEmail">Email do Civil*</label>
        <?php
          if (array_key_exists('selected_email', $_POST)){
            echo '<input list="email" type="text" name="inputEmail" placeholder="Ex.: samanthazduniak@gmail.com" value="'.$_POST['selected_email'].'" readonly required>';
          }
          else{
            echo '<input list="email" type="text" name="inputEmail" placeholder="Ex.: samanthazduniak@gmail.com" required>';
          }
        ?>
      </div>
      <div class="inputAreaRow">
        <div class="inputArea">
          <label for="inputAcionamento">Acionamento*</label>
          <select name="inputAcionamento" required>
            <option selected disabled hidden>Ver acionameno...</option>
            <option value="web">Formulário do Site</option>
            <option value="telefone">Telefone</option>
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
          <input type="number" name="inputCep" placeholder="Ex.: 07584030" required>
        </div>
        <div class="inputArea">
          <label for="inputRua">Rua*</label>
          <input type="text" name="inputRua" placeholder="Ex.: Av. dos Expedicionários" required>
        </div>
      </div>
      <div class="inputAreaRow">
        <div class="inputArea">
          <label for="inputBairro">Bairro*</label>
          <input type="text" name="inputBairro" placeholder="Ex.: Centro" required>
        </div>
        <div class="inputArea">
          <label for="inputCidade">Cidade*</label>
          <select name="inputCidade" required>
            <option selected disabled hidden>Ver cidade...</option>
            <option value="Franco da Rocha">Franco da Rocha</option>
            <option value="Caieiras">Caieiras</option>
            <option value="Francisco Morato">Francisco Morato</option>
          </select>
        </div>
      </div>
      <div class="inputAreaRow">
        <div class="inputArea">
          <label for="inputNumero">Número*</label>
          <input type="text" name="inputNumero" placeholder="Ex.: 25b" required>
        </div>
        <div class="inputArea">
          <label for="inputComplemento">Complemento*</label>
          <input type="text" name="inputComplemento" placeholder="Ex.: Fundos" required>
        </div>
      </div>

      <button class="btnCadastrar">Criar</button>
    </form>
  </main>
</body>

</html>