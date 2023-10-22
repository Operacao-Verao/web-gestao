<!DOCTYPE html>

<head>
	<link rel="stylesheet" href="./styles.css" />
	<title>Defesa Civil - Níveis</title>
</head>

<?php
	require '../../partials/header/header.php';
	require '../../actions/conn.php';
	
	require '../../actions/session_auth.php';
	authenticateSession(TIPO_USUARIO::GESTOR, '', '../login/login.php');
?>
<div class="wrapper-main">
	<section class="search-space">
		<div class="search-div">
			<input type="search" oninput="searchOcorrencias(this.value)" id="search_ocorrencia" placeholder="Procurar Registros..." />
			<i class="ph ph-magnifying-glass"></i>
		</div>
	</section>
	<section class="wrapper">
		<div class="status">
			<button class="btnStatus" onclick="trocarAba(false)">Pluviômetro</button>
			<button class="btnStatus" onclick="trocarAba(true)">Fluviômetro</button>
		</div>
		<div class="ocorrencias" id="lista_ocorrencias">
			<?php
				require '../../models/Ocorrencia.php';
				require '../../daos/DAOOcorrencia.php';
				require '../../models/Relatorio.php';
				require '../../daos/DAORelatorio.php';
				require '../../models/Casa.php';
				require '../../daos/DAOCasa.php';
				require '../../models/Endereco.php';
				require '../../daos/DAOEndereco.php';
			?>
		</div>
	</section>
	<!--MODAL VISUALIZAR OCORRÊNCIA-->
	
</div>
</main>

<?php
  echoError();
?>
<script>
	let aba_pluv_fluv = false; // Seleciona entre fluviômetro e pluviômetro
	let ocorrencia_atual = null;
	
	function requestFromAction(action, onSuccess=function(r){}, onError=function(r){}, data={}){
		fetch(action, {
			"method": "PUT",
			"headers": {"Content-Type": "application/json"},
			"body": JSON.stringify(data)
		}).then(
			onSuccess, onError
		);
	}
	
	// Procura por ocorrencias
	function searchOcorrencias(text) {
		requestFromAction("../../actions/fetch/search_niveis.php", function(r){
	      r.json().then(function(json){
			let medida;
			if(aba_pluv_fluv) medida = "%"
			else medida = "mm";
			console.log(medida);
	      	let content = "";
	      	
	      	for (let i=0; i<json.length; i++){
	      		let oe = json[i]; // Entrada de ocorrência
	      		content += `
              <div class="ocorrencia-item">
                <div class="ocorrencia-date">
                  <p>`+oe.data+`</p>
                  <p>`+oe.hora+`</p>
                </div>
                <div class="ocorrencia-info">
                  <div class="ocorrencia-title">
                    <p>`+oe.cidade+` - `+oe.bairro+` (`+oe.rua+`)</p>
                  </div>
                  <div class="ocorrencia-subtitle">
                    <p>`+oe.nivel+medida+`</p>
                  </div>
                </div>
              </div>
            `
	      	}
			
					lista_ocorrencias.innerHTML = content;
	      });
	    }, function(){}, {"text": text, "nivel": aba_pluv_fluv});
	}
	searchOcorrencias("");
	
	function trocarAba(pluv_fluv=aba_pluv_fluv){
		aba_pluv_fluv = pluv_fluv;
		searchOcorrencias(search_ocorrencia.value);
	}
</script>

</html>