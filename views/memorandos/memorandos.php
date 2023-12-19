<!DOCTYPE html>

<head>
  <link rel="stylesheet" href="./styles.css" />
  <title>Defesa Civil - Memorandos</title>
</head>

<?php
  require '../../partials/header/header.php';
  authenticateSession(TIPO_USUARIO::GESTOR, '', '../login/login.php');
?>

<div class="dash-content">
  <section class="activity">
    <div>
      <div class="search-space">
        <div class="search-div">
          <input type="search" oninput="pageIndex = 0; searchMemos(this.value);" id="search_memorando" placeholder="Procurar Memorando..." />
          <i class="ph ph-magnifying-glass"></i>
        </div>
      </div>
      <div class="activity-data" id="memorandos_list">
        <div class="data address">
          <span class="data-title">Endereço</span>
          <span class="data-list">Rua Braz Cubas - 256 (Vila Santista)</span>
          <span class="data-list">Rua Braz Cubas - 256 (Vila Santista)</span>
          <span class="data-list">Rua Braz Cubas - 256 (Vila Santista)</span>
        </div>
        <div class="data memorando">
          <span class="data-title">Memorando</span>
          <span class="data-list">Nº 819/2023</span>
          <span class="data-list">Nº 819/2023</span>
          <span class="data-list">Nº 819/2023</span>
        </div>
        <div class="data date">
          <span class="data-title">Data</span>
          <span class="data-list">28/11/2023</span>
          <span class="data-list">28/11/2023</span>
          <span class="data-list">28/11/2023</span>
        </div>
        <div class="data ver">
          <span class="data-title">Ver</span>
          <span class="data-list"><a href="../view_memorandos/view_memorandos.php"><i
                class="ph-bold ph-eye"></i></a></span>
          <span class="data-list"><a href="../view_memorandos/view_memorandos.php"><i
                class="ph-bold ph-eye"></i></a></span>
          <span class="data-list"><a href="../view_memorandos/view_memorandos.php"><i
                class="ph-bold ph-eye"></i></a></span>
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
  pageEntries = 10;
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

  // Procura por memorandos
  function searchMemos(text) {
    requestFromAction("../../actions/fetch/search_memo.php", function (r) {
      r.json().then(function (json) {
        //console.log(json);
        let content_enderecos = '<div class="data address"><span class="data-title">Endereço</span>';
        let content_memos = '<div class="data memorando"><span class="data-title">Memorando</span>';
        let content_datas = '<div class="data date"><span class="data-title">Data</span>';
        let content_vers = '<div class="data ver"><span class="data-title">Ver</span>';

        for (let i = 0; i < json.entries.length; i++) {
          let re = json.entries[i]; // Entrada de Relatório
          content_enderecos += '<span class="data-list">' + re.rua + ' - ' + re.numero + ' (' + re.bairro + ')</span>';
          content_memos += '<span class="data-list">' + re.memorando + '</span>';
          content_datas += '<span class="data-list">' + re.data + '</span>';
          content_vers += '<a class="data-list" target="_Blank" href="../view_memorandos/view_memorandos.php?id=' + re.id + '"><i class="ph-bold ph-eye"></i></a>';
        }
        
        pageCount = Math.ceil(json.limit/pageEntries)||1;
        
        //console.log(json);
        memorandos_list.innerHTML = content_enderecos + "</div>" + content_memos + "</div>" + content_datas + "</div>" + content_vers + "</div>";
        changePage(pageIndex);
      });
    }, function () { }, { "text": text, "offset": pageIndex*pageEntries, "entries": pageEntries });
  }
  searchMemos("");
  
  pageChangeCallback = function(page){
    searchMemos(search_memorando.value);
  }
  
  let update = setInterval(function(){
    searchMemos(search_memorando.value);
  }, 30 * 1000);
</script>

</html>