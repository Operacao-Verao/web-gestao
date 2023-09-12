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
  <section id="viewRelatorio" class="viewRelatorio" style="position:absolute; left:4vw; top:2vh; width:68vw; height:96vh; border:2px solid black; background-color:white; overflow-y: scroll;">
      <button onclick="closeModal()">&nbsp;&nbsp;Fechar&nbsp;&nbsp;</button><br/><br/>
    
      <div class="item-column grid-civil">
        <p class="item-title">Nome:</p><p class="item-content" id="view_nome">Samantha Zduniak</p>
        <br/>
      </div>
      <div class="item-column grid-civil">
        <p class="item-title">Logradouro:</p><p class="item-content" id="view_rua">Jonas</p>
        <br/>
      </div>
      <div class="item-column grid-civil">
        <p class="item-title">Bairro:</p><p class="item-content" id="view_bairro">Jonas</p>
        <br/>
      </div>
      <div class="item-column grid-civil">
        <p class="item-title">Cidade:</p><p class="item-content" id="view_cidade">Jonas</p>
        <br/>
      </div>
      <div class="item-column grid-civil">
        <p class="item-title">CPF:</p><p class="item-content" id="view_cpf">Jonas</p>
        <br/>
      </div>
      <div class="item-column grid-civil">
        <p class="item-title">CEP:</p><p class="item-content" id="view_cep">Jonas</p>
        <br/>
      </div>
      <div class="item-column grid-civil">
        <p class="item-title">Telefone:</p><p class="item-content" id="view_telefone">Jonas</p>
        <br/>
      </div>
      <div class="item-column grid-civil">
        <p class="item-title">Celular:</p><p class="item-content" id="view_celular">Jonas</p>
        <br/>
      </div>
      <div class="item-column grid-civil">
        <p class="item-title">Data Geração:</p><p class="item-content" id="view_data_geracao">Jonas</p>
        <br/>
      </div>
      <div class="item-column grid-civil">
        <p class="item-title">Data Atendimento:</p><p class="item-content" id="view_data_atendimento">Jonas</p>
        <br/>
      </div>
      <div class="item-column grid-civil">
        <p class="item-title">Nº:</p><p class="item-content" id="view_numero">Jonas</p>
        <br/>
      </div>
      <center>
        <img src="jonas" width="50%"/>
      </center>
      <div class="item-column grid-civil">
        <p class="item-title">Técnico Responsável: </p><p class="item-content" id="view_tecnico">Jonas</p>
        <br/>
      </div>
      <strong>Dados da Vistoria</strong>
      <div class="item-column grid-civil">
        <p class="item-content" id="view_desmoronamento">(X) Desmoronamento</p>
        <p class="item-content" id="view_escorregamento">( ) Escorregamento</p>
        <p class="item-content" id="view_egoto_escoamento">( ) Esgoto/Escoamento</p>
        <p class="item-content" id="view_erosao">( ) Erosão</p>
        <p class="item-content" id="view_inundacao">( ) Inundação</p>
        <p class="item-content" id="view_incendio">( ) Incêncio</p>
        <p class="item-content" id="view_arvores">( ) Árvores</p>
        <br/>
      </div>
      <div class="item-column grid-civil">
        <p class="item-content" id="view_infiltracoes_trincas">( ) Infiltrações/Trincas</p>
        <p class="item-content" id="view_judicial">(X) Judicial</p>
        <p class="item-content" id="view_monitoramento">( ) Monitoramento</p>
        <p class="item-content" id="view_transito">( ) Trânsito</p>
        <br/>
      </div>
      <div class="item-column grid-civil">
        <p class="item-title">Gravidade:</p>
        <p class="item-content" id="view_risco">( ) Risco</p>
        <p class="item-content" id="view_desastre">( ) Desastre</p>
        <br/>
      </div>
      <div class="item-column grid-civil">
        <p class="item-title">Afetados:</p>
        <p class="item-content" id="view_adultos">Adultos: 0</p>
        <p class="item-content" id="view_criancas">Crianças: 0</p>
        <p class="item-content" id="view_idosos">Idosos: 0</p>
        <p class="item-content" id="view_deficientes">Deficientes: 0</p>
        <p class="item-content" id="view_total">Total: 0</p>
        <br/>
      </div>
      <div class="item-column grid-civil">
        <p class="item-title">Animas:</p>
        <p class="item-content" id="view_caes">Cães: 0</p>
        <p class="item-content" id="view_gatos">Gatos: 0</p>
        <p class="item-content" id="view_aves">Aves: 0</p>
        <p class="item-content" id="view_equinos">Equinos: 0</p>
        <p class="item-content" id="view_total">Total: 0</p>
        <br/>
      </div>
      <div class="item-column grid-civil">
        <p class="item-title">Área Afetada:</p>
        <p class="item-content" id="view_publica">( ) Pública</p>
        <p class="item-content" id="view_particular">( ) Particular</p>
        <br/>
      </div>
      <div class="item-column grid-civil">
        <p class="item-title">Tipo de Construção:</p>
        <p class="item-content" id="view_alvenaria">( ) Alvenaria</p>
        <p class="item-content" id="view_madeira">( ) Madeira</p>
        <p class="item-content" id="view_mista">( ) Mista</p>
        <br/>
      </div>
      <div class="item-column grid-civil">
        <p class="item-title">Tipo do Talude:</p>
        <p class="item-content" id="view_alvenaria">( ) Alvenaria</p>
        <p class="item-content" id="view_madeira">( ) Madeira</p>
        <p class="item-content" id="view_mista">( ) Mista</p>
        <br/>
      </div>
      <div class="item-column grid-civil">
        <p class="item-title">Vegetação:</p>
        <p class="item-content" id="view_nao">( ) Não</p>
        <p class="item-content" id="view_rasteira">( ) Rasteira</p>
        <p class="item-content" id="view_presenca_arvores">( ) Presença de Árvores</p>
        <br/>
      </div>
      <div class="item-column grid-civil">
        <p class="item-title">Interdição:</p>
        <p class="item-content" id="view_interdicao_nao">( ) Não</p>
        <p class="item-content" id="view_interdicao_parcial">( ) Parcial</p>
        <p class="item-content" id="view_interdicao_total">( ) Total</p>
        <br/>
      </div>
      <div class="item-column grid-civil">
        <p class="item-title">Danos Materiais:</p>
        <p class="item-content" id="view_danos_materiais_nao">( ) Não</p>
        <p class="item-content" id="view_danos_materiais_parcial">( ) Parcial</p>
        <p class="item-content" id="view_danos_materiais_total">( ) Total</p>
        <br/>
      </div>
      <div class="item-column grid-civil">
        <p class="item-title">Memorando: </p><p class="item-content" id="view_memorando">Jonas</p>
        <br/>
      </div>
      <div class="item-column grid-civil">
        <p class="item-title">Ofício: </p><p class="item-content" id="view_oficio">Jonas</p>
        <br/>
      </div>
      <div class="item-column grid-civil">
        <p class="item-title">Processo: </p><p class="item-content" id="view_processo">Jonas</p>
        <br/>
      </div>
      <div class="item-column grid-civil">
        <p class="item-title">Setor: </p><p class="item-content" id="view_setor">Jonas</p>
        <br/>
      </div>
      <div class="item-column grid-civil">
        <p class="item-title">Data: </p><p class="item-content" id="view_data">Jonas</p>
        <br/>
      </div>
      <div class="item-column grid-civil">
        <p class="item-title">Assunto: </p><p class="item-content" id="view_assunto">Jonas</p>
        <br/>
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
  // Procura por relatorios
  function searchRelatorios(text) {
    requestFromAction("../../actions/fetch/search_relatorio.php", function(r){
        r.json().then(function(json){
          //console.log(json);
          let content_enderecos = '<div class="data address"><span class="data-title">Endereço</span>';
          let content_tecnicos = '<div class="data names"><span class="data-title">Técnico</span>';
          let content_datas = '<div class="data request"><span class="data-title">Data</span>';
          let content_vers = '<div class="data ver"><span class="data-title">Ver</span>';
          
          for (let i=0; i<json.length; i++){
            let re = json[i]; // Entrada de Relatório
            content_enderecos += '<span class="data-list">'+re.rua+' - '+re.numero+' ('+re.bairro+')</span>';
            content_tecnicos += '<span class="data-list">'+(re.tecnico==null?"-não atribuído (ISTO É UM BUG)-":re.tecnico)+'</span>';
            content_datas += '<span class="data-list">'+re.data+'</span>';
            content_vers += '<span class="data-list" onclick="openModal('+re.id+')"><i class="ph-bold ph-eye"></i></span>';
          }
          
          relatorios_list.innerHTML = content_enderecos+"</div>"+content_tecnicos+"</div>"+content_datas+"</div>"+content_vers+"</div>";
        });
      }, function(){}, {"text": text});
  }
  searchRelatorios("");
  
  function openModal(relatorio_id) {
    requestFromAction("../../actions/fetch/get_relatorio.php", function(r){
        r.json().then(function(json){
          //console.log(json);
          viewRelatorio.hidden = false;
          
          view_nome.textContent = json.civil_nome;
          view_rua.textContent = json.endereco_rua;
          view_bairro.textContent = json.endereco_bairro;
          view_cidade.textContent = json.endereco_cidade;
          view_cpf.textContent = json.civil_cpf;
          view_cep.textContent = json.endereco_cep;
          view_celular.textContent = json.civil_celular;
          view_data_geracao.textContent = json.data_geracao;
          view_data_atendimento.textContent = json.data_atendimento;
          view_numero.textContent = json.casa_numero;
          
          view_tecnico.textContent = json.tecnico;
          
          view_memorando.textContent = json.memorando;
          view_oficio.textContent = json.oficio;
          view_processo.textContent = json.processo;
          view_setor.textContent = json.setor;
          view_data.textContent = json.data;
          view_assunto.textContent = json.assunto;
        });
      }, function(){}, {"id": relatorio_id});
    relatorio_atual = relatorio_id;
    //document.querySelector('.viewOcorrencia.open').classList.remove('open');
  }
  function closeModal() {
    viewRelatorio.hidden = true;
    //document.querySelector('.viewOcorrencia.open').classList.remove('open');
  }
  closeModal();
</script>

</html>