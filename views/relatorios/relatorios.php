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
          <input type="search" oninput="searchRelatorios(this.value)" id="search_relatorio"
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
  </section>
</div>
</main>

<?php
echoError();
?>
<script>
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

        for (let i = 0; i < json.length; i++) {
          let re = json[i]; // Entrada de Relatório
          content_enderecos += '<span class="data-list">' + re.rua + ' - ' + re.numero + ' (' + re.bairro + ')</span>';
          content_tecnicos += '<span class="data-list">' + (re.tecnico == null ? "-não atribuído (ISTO É UM BUG)-" : re.tecnico) + '</span>';
          content_datas += '<span class="data-list">' + re.data + '</span>';
          content_vers += '<span class="data-list" onclick="location = \'../view_relatorio/view_relatorio.php?id=\'+' + re.id + ';"><i class="ph-bold ph-eye"></i></span>';
        }

        relatorios_list.innerHTML = content_enderecos + "</div>" + content_tecnicos + "</div>" + content_datas + "</div>" + content_vers + "</div>";
      });
    }, function () { }, { "text": text });
  }
  searchRelatorios("");

</script>

</html>