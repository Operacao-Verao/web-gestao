<!DOCTYPE html>
<html lang="pt-br">

<head>
  <link rel="stylesheet" href="./styles.css" />
  <title>Defesa Civil - Relatórios</title>
</head>

<?php
require '../../partials/header/header.php';
require '../../actions/conn.php';

require '../../actions/session_auth.php';
authenticateSession(TIPO_USUARIO::GESTOR, '', '../login/login.php');
?>

<div class="dash-content">
  <section class="activity">
    <div>
      <div class="search-space">
        <div class="search-div">
          <input type="search" oninput="pageIndex = 0; searchRelatorios(this.value);" id="search_relatorio"
            placeholder="Procurar Relatórios..." />
          <i class="ph ph-magnifying-glass"></i>
        </div>
      </div>
      <div class="activity-data" id="relatorios_list">
        <div class="data address">
          <span class="data-title">Endereço</span>
          <span class="data-list"></span>
          <span class="data-list"></span>
          <span class="data-list"></span>
        </div>
        <div class="data names">
          <span class="data-title">Técnico</span>
          <span class="data-list"></span>
          <span class="data-list"></span>
          <span class="data-list"></span>
        </div>
        <div class="data request">
          <span class="data-title">Data</span>
          <span class="data-list"></span>
          <span class="data-list"></span>
          <span class="data-list"></span>
        </div>
        <div class="data ver">
          <span class="data-title">Ver</span>
          <span class="data-list"><i class="ph-bold ph-eye"></i></span>
          <span class="data-list"><i class="ph-bold ph-eye"></i></span>
          <span class="data-list"><i class="ph-bold ph-eye"></i></span>
        </div>
      </div>
    </div>
    <div class="pagination" id="pagination_footer"></div>
  </section>
</div>
</main>

<?php
  echoError();
?>
<script src="../../assets/js/pagination.js"></script>
<script>
  pageIndex = 0;
  pageCount = 1;
  pageEntries = 5;
  createPaginationFooter(pagination_footer);
  let relatorio_atual = null;

  function requestFromAction(action, onSuccess = function (r) { }, onError = function (r) { }, data = {}) {
    fetch(action, {
      "method": "PUT",
      "headers": { "Content-Type": "application/json" },
      "body": JSON.stringify(data)
    }).then(
      onSuccess, onError
    );
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

  // Procura por relatorios
  function searchRelatorios(text) {
    requestFromAction("../../actions/fetch/search_relatorio.php", function (r) {
      r.json().then(function (json) {
        //console.log(json);
        let content_enderecos = '<div class="data address"><span class="data-title">Endereço</span>';
        let content_tecnicos = '<div class="data names"><span class="data-title">Técnico</span>';
        let content_datas = '<div class="data request"><span class="data-title">Data</span>';
        let content_vers = '<div class="data ver"><span class="data-title">Ver</span>';

        for (let i = 0; i < json.entries.length; i++) {
          let re = json.entries[i]; // Entrada de Relatório
          content_enderecos += '<span class="data-list">' + re.rua + ' - ' + re.numero + ' (' + re.bairro + ')</span>';
          content_tecnicos += '<span class="data-list">' + (re.tecnico == null ? "-não atribuído (ISTO É UM BUG)-" : re.tecnico) + '</span>';
          content_datas += '<span class="data-list">' + re.data + '</span>';
          content_vers += '<span class="data-list" onclick="location = \'../view_relatorio/view_relatorio.php?id=\'+' + re.id + ';"><i class="ph-bold ph-eye"></i></span>';
        }
        
        pageCount = Math.ceil(json.limit/pageEntries)||1;
        
        console.log(json);
        relatorios_list.innerHTML = content_enderecos + "</div>" + content_tecnicos + "</div>" + content_datas + "</div>" + content_vers + "</div>";
        changePage(pageIndex);
      });
    }, function () { }, { "text": text, "offset": pageIndex*pageEntries, "entries": pageEntries });
  }
  searchRelatorios("");
  
  pageChangeCallback = function(page){
    searchRelatorios(search_relatorio.value);
  }
  
</script>

</html>