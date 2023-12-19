<!DOCTYPE html>
<html lang="pt-br">

<head>
  <link rel="stylesheet" href="./styles.css" />
  <title>Defesa Civil - Secretários</title>
</head>

<?php
require '../../partials/header/header.php';
authenticateSession(TIPO_USUARIO::GESTOR, '', '../login/login.php');

require '../../models/Cargo.php';
require '../../daos/DAOCargo.php';
require '../../models/Secretaria.php';
require '../../daos/DAOSecretaria.php';
require '../../models/Secretario.php';
require '../../daos/DAOSecretario.php';

$daoCargo = new DAOCargo($pdo);
$daoSecretaria = new DAOSecretaria($pdo);
$daoSecretario = new DAOSecretario($pdo);

$secretarios = $daoSecretario->listAll();
?>
<div id="body">
  <div class="wrapper-main">
    <section class="activity-data">
      <div class="data secretaria" id="list_secretaria">
        <span class="data-title">Secretaria</span>
        <?php
        // Print Secretarias
        foreach ($secretarios as $secretario) {
          $secretaria = $daoSecretaria->findById($secretario->getIdSecretaria());
          echo '<span class="data-list">' . $secretaria->getNomeSecretaria() . '</span>';
        }
        ?>
      </div>
      <div class="data editar" id="list_edits">
        <span class="data-title">Editar</span>
        <?php
        // Print Secretarias
        foreach ($secretarios as $secretario) {
          $cargo = $daoCargo->findById($secretario->getIdCargo());
          echo '<span class="data-list-2"><a href="#" onclick="openModal(\'' . $secretario->getId() . '\', \'' . $secretario->getNomeSecretario() . '\', \'' . $cargo->getNomeCargo() . '\', ' . $secretario->getIdSecretaria() . ')"><i class="ph-bold ph-pencil"></i></a></span>';
        }
        ?>
      </div>
    </section>
    <div class="pagination-button">
      <div class="pagination" id="pagination_footer"></div>
      <a href="#"><button class="btnCadastrar" onclick="openModal()">Cadastrar Secretário</button></a>
    </div>
  </div>

  <!--MODAL CADASTRAR SECRETÁRIO-->
  <section id="viewSecretario" class="viewSecretario">
    <div class="topRow">
      <h2 id="cadWindowTitle">Cadastrar Secretário</h1>
        <button onclick="closeModal()"><i class="ph-bold ph-x"></i></button>
    </div>
    <form id="formCad" class="secretario-content" method="post" action="../../actions/cad_secretario.php">
      <input type="hidden" name="inputId" id="inputId">
      <div>
        <div class="inputArea">
          <label for="">Secretaria</label>
          <input type="text" name="inputNome" id="inputSecretaria" required>
        </div>
      </div>
      <button id="cadButton" class="btnCadastrarSecretario">Cadastrar</button>
    </form>
  </section>
</div>

</main>

<?php
echoError();
?>
<script src="../../assets/js/pagination.js"></script>
<script>
  // Setup pagination
  pageIndex = 0;
  pageCount = 1;
  pageEntries = 15;
  createPaginationFooter(pagination_footer);
  let exp_nome = /[^a-zA-ZáàÁÀéèÉÈíìÍÌóòÓÒúùÚÙãçÃÇâÂêÊõÕôÔûÛ\s]/g;

  function goToAction(action, values = {}) {
    let form = document.createElement('form');
    form.method = 'post';
    form.action = action;
    let submit = document.createElement('input');
    submit.type = 'submit';
    form.appendChild(submit);

    for (let name in values) {
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

  function requestFromAction(action, onSuccess = function (r) { }, onError = function (r) { }, data = {}) {
    fetch(action, {
      "method": "PUT",
      "headers": { "Content-Type": "application/json" },
      "body": JSON.stringify(data)
    }).then(
      onSuccess, onError
    );
  }

  function openModal(id_secretario = null, nome = null, cargo = null, secretaria = null) {
    document.getElementById('viewSecretario').style.display = 'block';
    if (id_secretario == null) {
      cadWindowTitle.textContent = "Cadastrar Secretário";
      cadButton.textContent = "Cadastrar";
      inputSecretaria.value = '';
      formCad.action = "../../actions/cad_secretario.php";
    }
    else {
      cadWindowTitle.textContent = "Atualizar Secretário";
      cadButton.textContent = "Atualizar";
      inputId.value = id_secretario;
      inputSecretaria.value = secretaria;
      formCad.action = "../../actions/alt_secretario.php";
    }
  }

  function closeModal() {
    document.getElementById('viewSecretario').style.display = 'none';
  }
  closeModal();

  
  function listSecretarios() {
    requestFromAction("../../actions/fetch/search_secretario.php", function (r) {
    r.json().then(function (json) {
      //console.log(json);
      let secretaria_content = '<span class="data-title">Secretaria</span>';
      let editar_content = '<span class="data-title">Editar</span>';
      
      // Gerando lista de elementos 
      for (let i = 0; i < json.entries.length; i++) {
        let soe = json.entries[i];
        secretaria_content += '<span class="data-list">' + soe.secretaria + '</span>';
        editar_content += '<span class="data-list-2"><a href="#" onclick="openModal(\'' + soe.id + '\', \'' + soe.nome + '\', \'' + soe.cargo + '\', ' + soe.id_secretaria + ')"><i class="ph-bold ph-pencil"></i></a></span>';
      }
      list_secretaria.innerHTML = secretaria_content;
      list_edits.innerHTML = editar_content;
      
      pageCount = Math.ceil(json.limit/pageEntries);
      changePage(pageIndex);
    });
  }, function () { }, { "offset": pageIndex*pageEntries, "entries": pageEntries }, "PUT");
  }
  listSecretarios(0);
  
  pageChangeCallback = function(page){
    listSecretarios();
  }
  

  inputSecretaria.oninput = function () {
    inputSecretaria.value = inputSecretaria.value.replace(exp_nome, '').substr(0, 100);
  }
  
</script>

</html>