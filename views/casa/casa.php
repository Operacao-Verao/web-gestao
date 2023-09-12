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

  session_start();
  if(empty($_SESSION['usuario_id']) || empty($_SESSION['usuario_id']) || empty($_SESSION['usuario_id'])) {
    session_destroy();
    header("Location: ../login/login.php");
  };
  
  $daoCasa = new DAOCasa($pdo);
  $civis = $daoCasa->listAll();
?>
<div id="body">
  <div class="wrapper-main">
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

  <!--MODAL VISUALIZAR CIVIL-->
  <section id="viewCivil" class="viewCivil">
    <div class="topRow">
      <h2>Visualizar Casa</h1>
        <button onclick="closeModal()"><i class="ph-bold ph-x"></i></button>
    </div>
    <div class="civil-content">
      <div class="civil-item">
        <p class="item-title">CEP</p>
        <p class="item-content" id="view_cep">Samantha Zduniak</p>
      </div>
      <div class="civil-item">
        <p class="item-title">Número</p>
        <p class="item-content" id="view_numero">07851-120</p>
      </div>
      <div class="civil-item">
        <p class="item-title">Complemento</p>
        <p class="item-content" id="view_complemento">Não Cadastrado</p>
      </div>
    </div>
    <div class="ocorrencias-content">
        <div class="ocorrencias">
          <div class="ocorrencias-items" id="lista_ocorrencias">
          <select name="inputAprovar" class="inputAprovar" id="alter_aprovado" onchange="selectFunction()">
                    <option  value = "0" selected disabled hidden>Não</option>
                    <option value="0">Não</option>
                    <option value="1">Parcial</option>
                    <option value="2">Sim</option>
                  </select>
          </div>
        </div>
    </div>
    
  </section>
</div>
<!--MODAL VISUALIZAR CIVIL-->
</main>
<script>
  let casa_atual = null;
  
  function requestFromAction(action, onSuccess=function(r){}, onError=function(r){}, data={}, method){
    fetch(action, {
      "method": method,
      "headers": {"Content-Type": "application/json"},
      "body": JSON.stringify(data)
    }).then(
      onSuccess, onError
    );
  }
  
  function openModal(id, casa_id) {
    casa_atual = casa_id;
    // Data Filling
    requestFromAction("../../actions/fetch/get_casa.php", function(r){
      r.json().then(function(json){
        console.log(json);
        document.getElementById(id).classList.add('open');

        view_numero.textContent = json.numero;
        view_cep.textContent = json.cep;
        view_complemento.textContent = json.complemento;

        let relatorios_conteudo = '';

        for (let i=0; i<json.relatorios.length; i++){
          let relatorio = json.relatorios[i];
          let status;
          switch(relatorio.interdicao) {
            case '0':
              status = 'Não'
              break;
            case '1':
              status = 'Parcial'
              break;
            case '2':
              status = 'Sim';
              break;
          }
          relatorios_conteudo += ``;
        }
        if(json.relatorios.length === 0) {
          relatorios_conteudo += `
            <div class="ocorrencia-item">
              <div class="ocorrencia-info">
                <div class="ocorrencia-title">
                  <p>Sem relatórios para essa residência</p>
                </div>
            </div>
          </div>
          `
        }
        lista_ocorrencias.innerHTML = `<div class="ocorrencia-item">
                  <div class="ocorrencia-info">
                      <div class="ocorrencia-title">
                        <p>Interdição</p>
                      </div>
                      <div class="ocorrencia-subtitle">
                        <p>`+status+`</p>
                      </div>
                  </div><select name="inputAprovar" class="inputAprovar" id="alter_aprovado" onchange="selectFunction()">
                    <option value = "`+json.interdicao+`" selected disabled hidden>Não</option>
                    <option value="0">Não</option>
                    <option value="1">Parcial</option>
                    <option value="2">Sim</option>
                  </select>
          </div>`+relatorios_conteudo;
      });
    }, function(){}, {"id":casa_id}, "POST");
    
  }
  
  // Procura por casas
  function searchCasas(text){
    requestFromAction("../../actions/fetch/search_casa.php", function(r){
      r.json().then(function(json){
        //console.log(json);
        
        let cep_content = '<span class="data-title">CEP</span>';
        let numero_content = '<span class="data-title">Número</span>';
        let complemento_content = '<span class="data-title">Complemento</span>';
        let view_content = '<span class="data-title">Ver</span>';
        
        // Gerando lista de elementos 
        for (let i=0; i<json.length; i++){
          let casa = json[i];
          cep_content += '<span class="data-list">'+casa.cep+'</span>';
          numero_content += '<span class="data-list">'+casa.numero+'</span>';
          complemento_content += '<span class="data-list">'+casa.complemento+'</span>';
          view_content += '<button class="data-list" onclick=\'openModal("viewCivil", '+casa.id+')\'><i class="ph-bold ph-eye"></i></button>';
        }
        list_ceps.innerHTML = cep_content;
        list_numeros.innerHTML = numero_content;
        list_complementos.innerHTML = complemento_content;
        list_views.innerHTML = view_content;
      });
    }, function(){}, {"text": text}, "PUT");
  }
  searchCasas('');

  function closeModal() {
    document.querySelector('.viewCivil.open').classList.remove('open');
  }

  function selectFunction() {
    let interdicao;
    
    if(alter_aprovado.value=="0") interdicao = 0;
    else if(alter_aprovado.value=="1") interdicao = 1;
    else if(alter_aprovado.value=="2") interdicao = 2;

		requestFromAction("../../actions/fetch/alter_casa.php", function(r){
	      r.text().then(function(r){
	      	console.log(r);
	      });
	    }, function(){}, {"idCasa":casa_atual, "interdicao":interdicao}, "POST");
	}
</script>
</body>
</html>