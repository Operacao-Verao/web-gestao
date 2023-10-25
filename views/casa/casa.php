<!DOCTYPE html>
<html lang="pt-br">

<head>
  <link rel="stylesheet" href="./styles.css" />
  <title>Defesa Civil - Casa</title>
</head>

<body>

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
  
  $daoCasa = new DAOCasa($pdo);
  $civis = $daoCasa->listAll();
  ?>
  <div id="body">
    <div class="wrapper-main">
      <div>
        <section class="search-space">
          <div class="search-div">
            <input type="search" oninput="searchCasas(this.value)" placeholder="Procurar Casas..." />
            <i class="ph ph-magnifying-glass"></i>
          </div>
        </section>
        <section class="activity-data">
          <div class="data name" id="list_ceps">
            <span class="data-title">CEP</span>
          </div>
          <div class="data email" id="list_numeros">
            <span class="data-title">Número</span>
          </div>
          <div class="data cpf" id="list_complementos">
            <span class="data-title">Complemento</span>
          </div>
          <div class="data ver" id="list_views">
            <span class="data-title">Ver</span>
          </div>
        </section>
      </div>
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
    </div>

    <!--MODAL VISUALIZAR CIVIL-->
    <section id="viewCivil" class="viewCivil">
      <div class="topRow">
        <h2>Visualizar Casa</h1>
          <button onclick="closeModal()"><i class="ph-bold ph-x"></i></button>
      </div>
      <div class="civil-content">
        <div class="civil-item">
          <p class="item-title">Logradouro</p>
          <p class="item-content" id="view_rua"></p>
        </div>
        <div class="civil-item">
          <p class="item-title">Bairro</p>
          <p class="item-content" id="view_bairro"></p>
        </div>
        <div class="civil-item">
          <p class="item-title">Cidade</p>
          <p class="item-content" id="view_cidade"></p>
        </div>
        <div class="civil-item">
          <p class="item-title">CEP</p>
          <p class="item-content" id="view_cep"></p>
        </div>
        <div class="civil-item">
          <p class="item-title">Número</p>
          <p class="item-content" id="view_numero"></p>
        </div>
        <div class="civil-item">
          <p class="item-title">Complemento</p>
          <p class="item-content" id="view_complemento"></p>
        </div>
      </div>
      <div class="ocorrencias-content">
        <div class="ocorrencias">
          <div class="interdicao">
            <div class="ocorrencia-title">
                <p>Interdição</p>
              </div>
              <select name="inputAprovar" class="inputAprovar" id="alter_aprovado" onchange="selectFunction()">
                <option value="0" selected disabled hidden>Não</option>
                <option value="0">Não</option>
                <option value="1">Parcial</option>
                <option value="2">Sim</option>
              </select>
          </div>
          <div class="ocorrencias-items" id="lista_ocorrencias">
            <div class="ocorrencia-item">
              <div class="ocorrencia-date">
                <p>Data</p>
                <p>Hora</p>
              </div>
              <div class="ocorrencia-info">
                <div class="ocorrencia-subtitle">
                  <p>Relato</p>
                </div>
                <div class="ocorrencia-title">
                  <!--<p>Rua - Numero (Bairro)</p>-->
                  <button onclick=""><i class="ph-bold ph-eye"></i></button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </section>
  </div>
  <!--MODAL VISUALIZAR CIVIL-->
  </main>
  
  <?php
    echoError();
  ?>
  <script>
    let casa_atual = null;

    function requestFromAction(action, onSuccess = function (r) { }, onError = function (r) { }, data = {}, method) {
      fetch(action, {
        "method": method,
        "headers": { "Content-Type": "application/json" },
        "body": JSON.stringify(data)
      }).then(
        onSuccess, onError
      );
    }

    function openModal(id, casa_id) {
      casa_atual = casa_id;
      // Data Filling
      requestFromAction("../../actions/fetch/get_casa.php", function (r) {
        r.json().then(function (json) {
          console.log(json);
          document.getElementById(id).classList.add('open');

          view_rua.textContent = json.rua;
          view_bairro.textContent = json.bairro;
          view_cidade.textContent = json.cidade;
          view_numero.textContent = json.numero;
          view_cep.textContent = json.cep;
          view_complemento.textContent = json.complemento;
          alter_aprovado.value = json.interdicao;
          
          let ocorrencias_conteudo = '';

          for (let i = 0; i < json.ocorrencias.length; i++) {
            let ocorrencia = json.ocorrencias[i];
            ocorrencias_conteudo += `<div class="ocorrencia-item">
              <div class="ocorrencia-date">
                <p>`+ocorrencia.data+`</p>
                <p>`+ocorrencia.hora+`</p>
              </div>
              <div class="ocorrencia-info">
                <div class="ocorrencia-subtitle">
                  <p>`+ocorrencia.relato+`</p>
                </div>
                <div class="ocorrencia-title">
                  <button onclick="location = '../ocorrencias/ocorrencias.php?id=`+ocorrencia.id+`'"><i class="ph-bold ph-eye"></i></button>
                </div>
              </div>
            </div>`;
          }
          if (json.ocorrencias.length === 0) {
            ocorrencias_conteudo += `
            <div class="ocorrencia-item">
              <div class="ocorrencia-info">
                <div class="ocorrencia-title">
                  <p>Sem ocorrências para essa residência</p>
                </div>
            </div>
          </div>
          `
          }
          lista_ocorrencias.innerHTML = ocorrencias_conteudo;
        });
      }, function () { }, { "id": casa_id }, "POST");

    }

    // Procura por casas
    function searchCasas(text) {
      requestFromAction("../../actions/fetch/search_casa.php", function (r) {
        r.json().then(function (json) {
          //console.log(json);

          let cep_content = '<span class="data-title">CEP</span>';
          let numero_content = '<span class="data-title">Número</span>';
          let complemento_content = '<span class="data-title">Complemento</span>';
          let view_content = '<span class="data-title">Ver</span>';

          // Gerando lista de elementos 
          for (let i = 0; i < json.length; i++) {
            let casa = json[i];
            cep_content += '<span class="data-list">' + casa.cep + '</span>';
            numero_content += '<span class="data-list">' + casa.numero + '</span>';
            complemento_content += '<span class="data-list">' + (casa.complemento.trim()==''?'<br/>':casa.complemento) + '</span>';
            view_content += '<button class="data-list" onclick=\'openModal("viewCivil", ' + casa.id + ')\'><i class="ph-bold ph-eye"></i></button>';
          }
          list_ceps.innerHTML = cep_content;
          list_numeros.innerHTML = numero_content;
          list_complementos.innerHTML = complemento_content;
          list_views.innerHTML = view_content;
        });
      }, function () { }, { "text": text }, "PUT");
    }
    searchCasas('');

    function closeModal() {
      document.querySelector('.viewCivil.open').classList.remove('open');
    }

    function selectFunction() {
      let interdicao;

      if (alter_aprovado.value == "0") interdicao = 0;
      else if (alter_aprovado.value == "1") interdicao = 1;
      else if (alter_aprovado.value == "2") interdicao = 2;

      requestFromAction("../../actions/fetch/alter_casa.php", function (r) {
        r.text().then(function (r) {
          console.log(r);
        });
      }, function () { }, { "idCasa": casa_atual, "interdicao": interdicao }, "POST");
    }
  </script>
</body>

</html>