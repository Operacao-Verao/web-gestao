<!DOCTYPE html>

<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="styles.css">
  <title>Defesa Civil - Civil</title>
</head>
<?php
require '../../partials/header/header.php';
require '../../actions/conn.php';

require '../../actions/session_auth.php';
authenticateSession(TIPO_USUARIO::GESTOR, '', '../login/login.php');

require '../../models/Civil.php';
require '../../daos/DAOCivil.php';

require '../../models/Ocorrencia.php';
require '../../daos/DAOOcorrencia.php';
require '../../models/Relatorio.php';
require '../../daos/DAORelatorio.php';
require '../../models/Casa.php';
require '../../daos/DAOCasa.php';
require '../../models/Endereco.php';
require '../../daos/DAOEndereco.php';

$daoCivil = new DAOCivil($pdo);
$civis = $daoCivil->listAll();
?>
<div id="body">
  <div class="wrapper-main">
    <div>
      <section class="search-space">
        <div class="search-div">
          <input type="search" oninput="searchCivis(this.value)" placeholder="Procurar Civis..." />
          <i class="ph ph-magnifying-glass"></i>
        </div>
      </section>
      <section class="activity-data">
        <div class="data name" id="list_nomes">
          <span class="data-title">Nome</span>
        </div>
        <div class="data email" id="list_emails">
          <span class="data-title">Email</span>
        </div>
        <div class="data cpf" id="list_cpfs">
          <span class="data-title">CPF</span>
        </div>
        <div class="data ver" id="list_views">
          <span class="data-title">Ver</span>
        </div>
      </section>
    </div>
    <div class="pagination-button">
      <div class="pagination">
        <a href="">
          <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#023b7e" viewBox="0 0 256 256">
            <path d="M168.49,199.51a12,12,0,0,1-17,17l-80-80a12,12,0,0,1,0-17l80-80a12,12,0,0,1,17,17L97,128Z"></path>
          </svg>
        </a>
        <a href="#">1</a>
        <p>...</p>
        <a href="#">4</a>
        <a href="#">5</a>
        <a href="#" class="active">6</a>
        <a href="#">7</a>
        <a href="#">8</a>
        <p>...</p>
        <a href="#">25</a>
        <a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#023b7e" viewBox="0 0 256 256">
            <path
              d="M184.49,136.49l-80,80a12,12,0,0,1-17-17L159,128,87.51,56.49a12,12,0,1,1,17-17l80,80A12,12,0,0,1,184.49,136.49Z">
            </path>
          </svg></a>
      </div>
      <a href="./cad_civil/cad_civil.php"><button class="btnCadastrar">Cadastrar Civil</button></a>
    </div>
  </div>

  <!--MODAL VISUALIZAR CIVIL-->
  <section id="viewCivil" class="viewCivil">
    <div class="topRow">
      <h2>Visualizar Civil</h1>
        <button onclick="closeModal()"><i class="ph-bold ph-x"></i></button>
    </div>
    <div class="civil-content">
      <div class="civil-item">
        <p class="item-title">Nome</p>
        <p class="item-content" id="view_nome"></p>
      </div>
      <div class="civil-item">
        <p class="item-title">Cep</p>
        <p class="item-content" id="view_cep"></p>
      </div>
      <div class="civil-item">
        <p class="item-title">Celular</p>
        <p class="item-content" id="view_celular"></p>
      </div>
      <div class="civil-item">
        <p class="item-title">Email</p>
        <p class="item-content" id="view_email"></p>
      </div>
      <div class="civil-item">
        <p class="item-title">CPF</p>
        <p class="item-content" id="view_cpf"></p>
      </div>
      <div class="civil-item">
        <p class="item-title">Telefone</p>
        <p class="item-content" id="view_telefone"></p>
      </div>
    </div>
    <div class="ocorrencias-content">
      <h3>Ocorrências</h3>
      <div class="ocorrencias">
        <div class="ocorrencias-items" id="lista_ocorrencias">

        </div>
      </div>
      <a onclick="goToOcorrenciaCreation()"><button class="btnCriarOcorrencia">Criar Ocorrência</button></a>
    </div>
  </section>
</div>
<!--MODAL VISUALIZAR CIVIL-->
</main>

<?php
echoError();
?>
<script>
  let selected_id = null;

  function goToOcorrenciaCreation() {
    goToAction('../ocorrencias/cad_ocorrencia/cad_ocorrencia.php', {
      'selected_id': {
        'type': 'number',
        'value': selected_id
      }
    });
  }

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

  function openModal(id, civil_id) {
    // Data Filling

    requestFromAction("../../actions/fetch/get_civil.php", function (r) {
      r.json().then(function (json) {
        //console.log(json);
        document.getElementById(id).classList.add('open');

        selected_id = json.id;
        view_nome.textContent = json.nome;
        view_cep.textContent = json.cep;
        view_celular.textContent = json.celular;
        view_email.textContent = json.email;
        view_cpf.textContent = json.cpf;
        view_telefone.textContent = json.telefone;
        let ocorrencias_conteudo = '';
        for (let i = 0; i < json.ocorrencias.length; i++) {
          let ocorrencia = json.ocorrencias[i];
          ocorrencias_conteudo += `<div class="ocorrencia-item">
                  <div class="ocorrencia-date">
                    <p>`+ ocorrencia.data + `</p>
                    <p>`+ ocorrencia.hora + `</p>
                  </div>
                  <div class="ocorrencia-info">
                    <div class="ocorrencia-title">
                      <p>`+ ocorrencia.rua + ` - ` + ocorrencia.numero + ` (` + ocorrencia.bairro + `)</p>
                      <i class="ph-bold ph-eye" onclick="location = '../ocorrencias/ocorrencias.php?id=`+ ocorrencia.id + `'"></i>
                    </div>
                    <div class="ocorrencia-subtitle">
                      <p>`+ ocorrencia.observacoes + `</p>
                    </div>
                  </div>
                </div>`;
        }
        lista_ocorrencias.innerHTML = ocorrencias_conteudo;
      });
    }, function () { }, { "id": civil_id });

  }

  // Procura por civis
  function searchCivis(text) {
    requestFromAction("../../actions/fetch/search_civil.php", function (r) {
      r.json().then(function (json) {
        let nome_content = '<span class="data-title">Nome</span>';
        let email_content = '<span class="data-title">Email</span>';
        let cpf_content = '<span class="data-title">CPF</span>';
        let view_content = '<span class="data-title">Ver</span>';

        // Gerando lista de elementos 
        for (let i = 0; i < json.length; i++) {
          let civil = json[i];
          nome_content += '<span class="data-list">' + civil.nome + '</span>';
          email_content += '<span class="data-list">' + civil.email + '</span>';
          cpf_content += '<span class="data-list">' + civil.cpf + '</span>';
          view_content += '<button class="data-list" onclick=\'openModal("viewCivil", ' + civil.id + ')\'><i class="ph-bold ph-eye"></i></button>';
        }
        list_nomes.innerHTML = nome_content;
        list_emails.innerHTML = email_content;
        list_cpfs.innerHTML = cpf_content;
        list_views.innerHTML = view_content;
      });
    }, function () { }, { "text": text });
  }
  searchCivis('');

  function closeModal() {
    document.querySelector('.viewCivil.open').classList.remove('open');
  }
</script>

</html>