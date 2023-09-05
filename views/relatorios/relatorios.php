<!DOCTYPE html>
<html lang="pt-br">

<head>
  <link rel="stylesheet" href="./styles.css" />
  <title>Defesa Civil - Relatórios</title>
</head>

<?php
require '../../partials/header/header.php';

session_start();
if (empty($_SESSION['usuario_id']) || empty($_SESSION['usuario_id']) || empty($_SESSION['usuario_id'])) {
  session_destroy();
  header("Location: ../login/login.php");
}
;
?>

<div class="dash-content">
  <section class="activity">
    <div class="search-space">
      <div class="search-div">
        <input type="search" oninput="searchRelatorios(this.value)" id="search_relatorio"
          placeholder="Procurar Relatórios..." />
        <i class="ph ph-magnifying-glass"></i>
      </div>
    </div>
    <div class="activity-data" id="relatorios_list">
      <div class="data address">
        <span class="data-title">Endereço</span>
        <span class="data-list">Rua Paulistana - 300 (Centro)</span>
        <span class="data-list">Rua Paulistana - 300 (Centro)</span>
        <span class="data-list">Rua Paulistana - 300 (Centro)</span>
      </div>
      <div class="data names">
        <span class="data-title">Técnico</span>
        <span class="data-list">Malcolm Mello</span>
        <span class="data-list">Malcolm Mello</span>
        <span class="data-list">Malcolm Mello</span>
      </div>
      <div class="data request">
        <span class="data-title">Data</span>
        <span class="data-list">20/05/2023</span>
        <span class="data-list">20/05/2023</span>
        <span class="data-list">20/05/2023</span>
      </div>
      <div class="data ver">
        <span class="data-title">Ver</span>
        <span class="data-list"><i class="ph-bold ph-eye"></i></span>
        <span class="data-list"><i class="ph-bold ph-eye"></i></span>
        <span class="data-list"><i class="ph-bold ph-eye"></i></span>
      </div>
    </div>
  </section>

</div>
</main>

<script>
  let relatorio_atual = null;
  
  function requestFromAction(action, onSuccess=function(r){}, onError=function(r){}, data={}){
    fetch(action, {
      "method": "PUT",
      "headers": {"Content-Type": "application/json"},
      "body": JSON.stringify(data)
    }).then(
      onSuccess, onError
    );
  }
/*
  function openModal(id, ocorrencia_id) {
    requestFromAction("../../actions/fetch/get_ocorrencia.php", function(r){
        r.json().then(function(json){
      document.getElementById(id).classList.add('open');
      
      view_civil.textContent = json.civil;
      view_acionamento.textContent = json.acionamento;
      view_relato.textContent = json.relato;
      view_endereco.textContent = json.rua+" - "+json.numero+" ("+json.bairro+")";
      view_casas_envolvidas.textContent = json.numCasas;
      alter_tecnico.value = json.tecnicoId;
      alter_aprovado.value = json.aprovado;
      
      if (aba_status_aprovado != json.aprovado){
        trocarAba(json.aprovado);
      }
        //console.log(ocorrencia_atual);
      //console.log(json);
        });
      }, function(){}, {"id":ocorrencia_id});
      ocorrencia_atual = ocorrencia_id;
  }
  */
  // Procura por relatorios
  function searchRelatorios(text) {
    requestFromAction("../../actions/fetch/search_relatorio.php", function(r){
        r.json().then(function(json){
          let content_enderecos = '<div class="data address"><span class="data-title">Endereço</span>';
          let content_tecnicos = '<div class="data names"><span class="data-title">Técnico</span>';
          let content_datas = '<div class="data request"><span class="data-title">Data</span>';
          let content_vers = '<div class="data ver"><span class="data-title">Ver</span>';
          
          for (let i=0; i<json.length; i++){
            let re = json[i]; // Entrada de Relatório
            content_enderecos += '<span class="data-list">'+re.rua+' - '+re.numero+' ('+re.bairro+')</span>';
            content_tecnicos += '<span class="data-list">'+(re.tecnico==null?"-não atribuído (ISTO É UM BUG)-":re.tecnico)+'</span>';
            content_datas += '<span class="data-list">'+re.data+'</span>';
            content_vers += '<span class="data-list"><i class="ph-bold ph-eye"></i></span>';
          }
          
          relatorios_list.innerHTML = content_enderecos+"</div>"+content_tecnicos+"</div>"+content_datas+"</div>"+content_vers+"</div>";
          //console.log(json);
        });
      }, function(){}, {"text": text});
  }
  searchRelatorios("");
  
  function closeModal() {
    document.querySelector('.viewOcorrencia.open').classList.remove('open');
  }
</script>

</html>