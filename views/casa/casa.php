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
            <input type="search" oninput="pageIndex = 0; searchCasas(this.value)" id="search_casa" placeholder="Procurar Casas..." />
            <i class="ph ph-magnifying-glass"></i>
          </div>
        </section>
        <section class="activity-data">
          <div class="status">
            <button class="btnStatus" id="abaNaoInterditado" onclick="trocarAba(0)">Não Interditados</button>
            <button class="btnStatus" id="abaParcialInterditado" onclick="trocarAba(1)">Parcialmente Interditados</button>
            <button class="btnStatus" id="abaTotalInterditado" onclick="trocarAba(2)">Totalmente Interditados</button>
          </div>
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
      <div class="pagination" id="pagination_footer"></div>
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
<script src="../../assets/js/pagination.js"></script>
  <script>
    pageIndex = 0;
    pageCount = 1;
    pageEntries = 10;
    createPaginationFooter(pagination_footer);
    let aba_status_interdicao = 0; // Seleciona entre status de interdicao
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
          for (let i = 0; i < json.entries.length; i++) {
            let casa = json.entries[i];
            cep_content += '<span class="data-list">' + casa.cep + '</span>';
            numero_content += '<span class="data-list">' + casa.numero + '</span>';
            complemento_content += '<span class="data-list">' + (casa.complemento.trim()==''?'<br/>':casa.complemento) + '</span>';
            view_content += '<button class="data-list" onclick=\'openModal("viewCivil", ' + casa.id + ')\'><i class="ph-bold ph-eye"></i></button>';
          }
          list_ceps.innerHTML = cep_content;
          list_numeros.innerHTML = numero_content;
          list_complementos.innerHTML = complemento_content;
          list_views.innerHTML = view_content;
          
          pageCount = Math.ceil(json.limit/pageEntries)||1;
          changePage(pageIndex);
        });
      }, function () { }, { "text": text, "offset": pageIndex*pageEntries, "entries": pageEntries, "interdicao": aba_status_interdicao }, "PUT");
    }

    function trocarAba(status_interdicao){
      pageIndex = 0;
      let stAba = abaNaoInterditado, ustAba1 = abaParcialInterditado, ustAba2 = abaTotalInterditado;
      if (status_interdicao != 0){
        if (status_interdicao==1){
          stAba = abaParcialInterditado;
          ustAba1 = abaNaoInterditado;
        }
        else {
          stAba = abaTotalInterditado;
          ustAba2 = abaNaoInterditado;
        }
      }
      stAba.style.backgroundColor = '#023b7e';
      stAba.style.color = '#fff';
      ustAba1.style.backgroundColor = '#FFF';
      ustAba1.style.color = '#000';
      ustAba2.style.backgroundColor = '#FFF';
      ustAba2.style.color = '#000';
      aba_status_interdicao = status_interdicao;
      searchCasas(search_casa.value);
    }
    trocarAba(0);
    
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
          
          let status = '';
          switch (alter_aprovado.value){
            case '0': status = 'não'; break;
            case '1': status = 'parcial'; break;
            case '2': status = 'sim'; break;
          }
          
          if (r=='success'){
            alert("Status de interdição de casa foi alterado para '"+status+"' com SUCESSO!");
          }
          else {
            alert("FALHA em alterar status de interdição de casa para  '"+status+"'!");
          }
        });
      }, function () { }, { "idCasa": casa_atual, "interdicao": interdicao }, "POST");
    }
    
    pageChangeCallback = function(page){
      searchCasas(search_casa.value);
    }
    
  </script>
</body>

</html>