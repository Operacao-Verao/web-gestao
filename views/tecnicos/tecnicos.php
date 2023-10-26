<!DOCTYPE html>
<html lang="pt-br">

<head>
	<link rel="stylesheet" href="./styles.css" />
	<title>Defesa Civil - Técnicos</title>
</head>

<?php
	require '../../partials/header/header.php';
	require '../../actions/conn.php';

	require '../../actions/session_auth.php';
	authenticateSession(TIPO_USUARIO::GESTOR, '', '../login/login.php');
?>

<div class="dash-content">
	<div class="activity-data">

		<div class="wrapper">
			<div class="data names" id="list_nomes"></div>
			<div class="data names" id="list_emails"></div>
			<div class="data status" id="list_status"></div>
			<div class="data ver" id="list_views"></div>
		</div>
		<div class="pagination-button">
			<div class="pagination" id="pagination_footer"></div>
			<a href="cad_tecnico/cad_tecnico.php">
				<button>Cadastrar Técnico</button>
			</a>
		</div>
	</div>
</div>
</main>

<?php
	echoError();
?>
<script src="../../assets/js/pagination.js"></script>
<script type="text/javascript">
		// Setup pagination
		pageCount = 1;
    pageEntries = 15;
    createPaginationFooter(pagination_footer);
	
    function requestFromAction(action, onSuccess = function (r) { }, onError = function (r) { }, data = {}, method) {
      fetch(action, {
        "method": method,
        "headers": { "Content-Type": "application/json" },
        "body": JSON.stringify(data)
      }).then(
        onSuccess, onError
      );
    }
    
    function listTecnicos(page) {
    	requestFromAction("../../actions/fetch/search_tecnico.php", function (r) {
			r.json().then(function (json) {
				//console.log(json);
				let nome_content = '<span class="data-title">Nome</span>';
				let email_content = '<span class="data-title">Email</span>';
				let status_content = '<span class="data-title">Status</span>';
				let editar_content = '<span class="data-title">Editar</span>';
				
				// Gerando lista de elementos 
				for (let i = 0; i < json.entries.length; i++) {
					let toe = json.entries[i];
					nome_content += '<span class="data-list">' + toe.nome + '</span>';
					email_content += '<span class="data-list">' + toe.email + '</span>';
					status_content += '<span class="data-list ' + (toe.status ? 'ativo' : 'inativo') + '">' + (toe.status ? 'Ativo' : 'Inativo') + '</span>';
					editar_content += '<span class="data-list"><a href="cad_tecnico/cad_tecnico.php?tecnico_id=' + toe.id + '"><i class="ph-bold ph-pencil"></i></a></span>';
				}
				list_nomes.innerHTML = nome_content;
				list_emails.innerHTML = email_content;
				list_status.innerHTML = status_content;
				list_views.innerHTML = editar_content;
				
				pageCount = Math.ceil(json.limit/pageEntries);
        changePage(page);
			});
		}, function () { }, { "offset": page*pageEntries, "entries": pageEntries }, "PUT");
    }
    
    pageChangeCallback = function(page){
    	listTecnicos(page);
    }
    
    window.addEventListener('load', function(){
        changePage(0);
        listTecnicos(0);
    });
</script>

</html>