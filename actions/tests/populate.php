<?php
	include_once('../conn.php');
    
    // Only allowed in DEV version
    if (DEV_LEVEL != DEV_LEVEL::DEV_MODE){
        header("Location: ../../views/login/login.php");
    }
    
	include_once("../../models/Funcionario.php");
	include_once("../../models/Registro.php");
	include_once("../../models/Gestor.php");
	include_once("../../models/Tecnico.php");
	include_once("../../models/Comunicado.php");
	include_once("../../models/Endereco.php");
	include_once("../../models/Civil.php");
	include_once("../../models/Residencial.php");
	include_once("../../models/Casa.php");
	include_once("../../models/Ocorrencia.php");
	include_once("../../models/Relatorio.php");
	include_once("../../models/Afetados.php");
	include_once("../../models/Animal.php");
	include_once("../../models/Foto.php");
	include_once("../../models/DadosDaVistoria.php");
	include_once("../../models/Cargo.php");
	include_once("../../models/Secretaria.php");
	include_once("../../models/Secretario.php");
	include_once("../../models/Memo.php");
	include_once("../../models/LocalAjuda.php");
	include_once("../../models/Pluviometro.php");
	include_once("../../models/Fluviometro.php");
	include_once("../../models/NivelChuva.php");
	include_once("../../models/NivelRio.php");
	include_once("../../models/AlertaChuva.php");
	include_once("../../models/AlertaRio.php");
	include_once("../../models/ServiceWorker.php");
	
	include_once("../../daos/DAOFuncionario.php");
	include_once("../../daos/DAORegistro.php");
	include_once("../../daos/DAOGestor.php");
	include_once("../../daos/DAOTecnico.php");
	include_once("../../daos/DAOComunicado.php");
	include_once("../../daos/DAOEndereco.php");
	include_once("../../daos/DAOCivil.php");
	include_once("../../daos/DAOResidencial.php");
	include_once("../../daos/DAOCasa.php");
	include_once("../../daos/DAOOcorrencia.php");
	include_once("../../daos/DAORelatorio.php");
	include_once("../../daos/DAOAfetados.php");
	include_once("../../daos/DAOAnimal.php");
	include_once("../../daos/DAOFoto.php");
	include_once("../../daos/DAODadosDaVistoria.php");
	include_once("../../daos/DAOCargo.php");
	include_once("../../daos/DAOSecretaria.php");
	include_once("../../daos/DAOSecretario.php");
	include_once("../../daos/DAOMemo.php");
	include_once("../../daos/DAOLocalAjuda.php");
	include_once("../../daos/DAOPluviometro.php");
	include_once("../../daos/DAOFluviometro.php");
	include_once("../../daos/DAONivelChuva.php");
	include_once("../../daos/DAONivelRio.php");
	include_once("../../daos/DAOAlertaChuva.php");
	include_once("../../daos/DAOAlertaRio.php");
	include_once("../../daos/DAOServiceWorker.php");
	
	$daoFuncionario = new DAOFuncionario($pdo);
	$daoRegistro = new DAORegistro($pdo);
	$daoGestor = new DAOGestor($pdo);
	$daoTecnico = new DAOTecnico($pdo);
	$daoComunicado = new DAOComunicado($pdo);
	$daoEndereco = new DAOEndereco($pdo);
	$daoResidencial = new DAOResidencial($pdo);
	$daoCivil = new DAOCivil($pdo);
	$daoCasa = new DAOCasa($pdo);
	$daoOcorrencia = new DAOOcorrencia($pdo);
	$daoRelatorio = new DAORelatorio($pdo);
	$daoAfetados = new DAOAfetados($pdo);
	$daoAnimal = new DAOAnimal($pdo);
	$daoFoto = new DAOFoto($pdo);
	$daoDadosDaVistoria = new DAODadosDaVistoria($pdo);
	$daoCargo = new DAOCargo($pdo);
	$daoSecretaria = new DAOSecretaria($pdo);
	$daoSecretario = new DAOSecretario($pdo);
	$daoMemo = new DAOMemo($pdo);
	$daoLocalAjuda = new DAOLocalAjuda($pdo);
	$daoPluviometro = new DAOPluviometro($pdo);
	$daoFluviometro = new DAOFluviometro($pdo);
	$daoNivelChuva = new DAONivelChuva($pdo);
	$daoNivelRio = new DAONivelRio($pdo);
	$daoAlertaChuva = new DAOAlertaChuva($pdo);
	$daoAlertaRio = new DAOAlertaRio($pdo);
	$daoServiceWorker = new DAOServiceWorker($pdo);
	
	// Deloading the entire database
	$daoServiceWorker->clearEntire();
	$daoAlertaRio->clearEntire();
	$daoAlertaChuva->clearEntire();
	$daoNivelRio->clearEntire();
	$daoNivelChuva->clearEntire();
	$daoFluviometro->clearEntire();
	$daoPluviometro->clearEntire();
	$daoLocalAjuda->clearEntire();
	$daoMemo->clearEntire();
	$daoSecretario->clearEntire();
	$daoSecretaria->clearEntire();
	$daoCargo->clearEntire();
	$daoDadosDaVistoria->clearEntire();
	$daoFoto->clearEntire();
	$daoAnimal->clearEntire();
	$daoAfetados->clearEntire();
	$daoRelatorio->clearEntire();
	$daoOcorrencia->clearEntire();
	$daoCivil->clearEntire();
	$daoCasa->clearEntire();
	$daoResidencial->clearEntire();
	$daoEndereco->clearEntire();
	$daoComunicado->clearEntire();
	$daoTecnico->clearEntire();
	$daoGestor->clearEntire();
	$daoRegistro->clearEntire();
	$daoFuncionario->clearEntire();
	
	$limit = isset($_GET['base'])? $_GET['base']: 100;
	try {
		echo 'Started!<br/><br/>';
	
	$firstName = ["Ana", "Adriana", "Alice", "Andressa", "Alessando", "Alex", "Angela", "Beto",
		"Bernado", "Bianca", "Bruno", "Bruna", "Carlos", "César", "Cassandra", "Camila", "Caio",
		"Cinthia", "Cristina", "Daniel", "Daniela", "Davi", "Dênis", "Douglas", "Daiane", "Dafine", "Eduardo",
		"Erick", "Emily", "Eliane", "Eva", "Fábio", "Fernando", "Fernanda", "Fuji", "Gabriel", "Gustavo",
		"Hélio", "Hugo", "Ígor", "Ivone", "Ícaro", "Janaína", "Jaque", "Jack", "João", "Júlio", "Júlia", "Jane",
		"Jorel", "Juliano", "Karen", "Kátia", "Lucas", "Luís", "Luana", "Letícia", "Ludmila", "Marcelo", "Murilo", "Mirela", "Marciele", "Malcolm", "Mario", "Maria", "Mariana", "Marcos", "Noberto", "Nataniel", "Natan", "Otávio", "Olávio", "Oucirdes", "Pablo", "Pedro", "Pâmela", "Patrícia",
		"Priscila", "Ricardo", "Roberto", "Roberta", "Ronaldo", "Ryan", "Raiane", "Riana", "Raquel", "Rogério", "Rogéria", "Sabrina", "Samantha", "Talita", "Tadeu", "Tiago", "Tomé", "Tina", "Tauane", "Teresa", "Ualace", "Vanessa", "Vladmir", "Viviane", "Valdo", "Wallace", "Willian",
		"Xavier", "Yan", "Yago", "Yvan", "Zaine", "Zilda",
		"Gilberto", "Regina", "Diana", "Gizele", "Miriã", "Kauã", "Kauane", "Raquel", "Renan",
		"Francisco", "Chico", "Kelly", "Mariane", "Mariele", "Marina", "Vanda", "Maurício", "Débora",
		"Edvaldo", "Edilma", "Vitório", "Vitória", "Viviane", "Denise", "Alberto", "Rafael", "Rafaela",
		"Antônio", "Mateus", "Dalva", "Felipe", "Wellington", "Laura", "Larissa", "Lia", "Raíssa",
		"Caique", "Felipe", "Rosângela", "Everaldo", "Carol", "Caroline", "Cedrick", "Jean", "Isabela",
		"Isadora", "Isaque", "Joel", "Jonas", "Juliana", "Camily", "Querolyne", "Johnny", "Rodrigo",
		"Danilo", "Leonardo", "Márcia", "Márcio", "Marceline", "Diogo", "Diego", "Cristiana", "Sofia",
		"Richard", "Fabrício", "Osvaldo"
	];
	$lastName = [
		"Souza", "de Souza", "Oliveira", "de Oliveira", "Salles", "Sartre", "Russeau", "Gonçalves", "da Silva", "Silva", "Santos",
		"Pereira", "Ferreira", "Augusto", "Filho", "Pinto", "Santos", "dos Santos", "Jaime", "Luís",
		"Cruz", "Putin", "Cassandra", "Alves", "Roberto", "Picasso", "Daniel", "Nilda", "Freitas",
		"Ledo", "Lirussi", "Noberto", "Bueno", "Pires", "Souzones", "Pedro", "Felipe", "Buarque",
		"Porto", "de Holanda", "Vitor", "Bergman", "Bergantins", "Soares", "Mello", "Lima", "Rodrigues",
		"Brito", "Alencar", "de Alencar", "Nogueira", "Lenha Verde", "da Penha", "Gentile", "Lins",
		"Lusiano", "Lusitano", "Osvaldo", "Araújo", "Ferraz"
	];
	$mail = [
		"email", "gmail", "hotmail", "yahoo", "outlook"
	];
	
	$_rli = 0;
	function randomItem($arr, $use_latest=false) {
		global $_rli;
		$_rli = $use_latest? $_rli: rand(0, count($arr)-1);
		return $_rli>=count($arr)? $arr[count($arr)-1]:$arr[$_rli];
	}
	
	function genRandomPersonName() {
		global $firstName, $lastName;
		$nome = randomItem($firstName).' '.randomItem($lastName);
		if (rand(0, 100)>=30){
			$nome .= ' '.randomItem($lastName);
		}
		if (rand(0, 100)>=90){
			$nome .= ' '.randomItem($lastName);
		}
		return $nome;
	}
	function genRandomEmail($name) {
		global $mail;
		return strtolower(preg_replace('/[^a-zA-Z0-9]/i', '', $name)).(rand(0, 255)).'@'.randomItem($mail).'.com';
	}
	function genRandomDate($far_days=30) {
		return date_sub(date_create(getCurrentDate()), date_interval_create_from_date_string(rand(0, $far_days).' days'));
	}
	
	$bairros = [
		'Florida', 'Várzea', 'Campo Capinado', 'Vila Sésamo', 'Constelação', 
		'Vila linda', 'Cândida', 'Paralelepípedo', 'Avenida Luísa', 'Detergente'
	];
	
	$relatos = [
	    "Uma enchente devastadora atingiu nossa casa! A água está subindo rapidamente, temos medo de que tudo seja perdido. Por favor, estamos desesperados! Podem nos ajudar?",
		"Um terremoto acaba de sacudir nossa cidade! Tudo está em ruínas, não sabemos o que fazer. Parece que o telhado vai cair, vem nos ajudar por favor!",
		"Nossa casa foi soterrada por um deslizamento de terra! Estamos encurralados e precisamos de resgate imediato. Por favor, venham nos salvar!",
		"Um incêndio florestal está se aproximando rapidamente! O fogo está ficando incontrolável, estamos em perigo. Pode nos ajudar?!",
		"Um tornado feroz está passando pela nossa região! Nossa casa está prestes a ser arrancada. Por favor, estamos desesperados! Venham nos socorrer!",
		"Um furacão arrasou nossa propriedade! Estamos em estado de choque e não sabemos por onde começar. Precisamos de ajuda, por favor!",
		"Uma tempestade devastou nossa comunidade! As casas estão destruídas, e as pessoas estão feridas. Pode nos ajudar? Estamos em uma situação crítica!",
		"Uma enchente repentina inundou nossa casa! Estamos presos no andar de cima, e a água está subindo rapidamente. Por favor, estamos desesperados! Venham nos resgatar!",
		"Fomos evacuados devido a uma erupção vulcânica! Nossas casas foram cobertas por cinzas, e não podemos voltar. Precisamos de assistência imediatamente. Pode nos ajudar?",
		"Nossa garagem foi destruída por um deslizamento de terra! Tudo o que tínhamos está enterrado. Parece que o telhado vai cair, por favor, venham nos ajudar!",
		"Um ciclone devastou nossa comunidade! Estamos sem eletricidade e com escassez de recursos. Estamos desesperados, podem nos ajudar?",
		"Uma queda de neve bloqueou nossa estrada! Estamos isolados e sem comida. Estamos com muito medo, venham nos ajudar por favor!",
		"Nossa casa foi inundada durante o temporal! Estamos no teto esperando ajuda. Por favor, estamos desesperados, venham nos resgatar!",
		"Nossa cidade foi devastada por um tornado! Não sabemos o que fazer, estamos em estado de choque. Precisamos de ajuda imediatamente. Por favor, venham nos socorrer!",
		"Depois de um tsunami, estamos presos em nosso telhado. As águas continuam subindo, e estamos com medo. Podem nos ajudar, por favor?",
		"Estamos presos após um terremoto. Parece que o prédio vai desabar a qualquer momento. Por favor, venham nos resgatar!",
		"Nossos carros foram destruídos por uma tempestade de granizo! Estamos sem abrigo e com medo. Precisamos de ajuda imediatamente. Por favor, venham nos socorrer!",
		"Incêndios florestais próximos forçaram nossa evacuação! Não temos para onde ir, e o fogo se aproxima. Por favor, estamos desesperados! Venham nos resgatar!",
		"Nossa área foi atingida por um maremoto! A água está subindo rapidamente, e estamos em perigo. Por favor, venham nos ajudar!",
		"Uma inundação repentina atingiu nossa empresa! Estamos encurralados e precisamos de ajuda imediatamente. Por favor, venham nos socorrer!",
		"Estamos presos em nossa casa após um deslizamento de terra. A situação está ficando crítica. Por favor, venham nos resgatar!",
		"Nossas plantações foram destruídas por uma onda de calor! Estamos sem comida e em apuros. Por favor, venham nos ajudar!",
		"Um incêndio está se aproximando da nossa casa! Estamos em perigo iminente. Por favor, venham nos resgatar!",
		"Uma avalanche bloqueou nossa estrada! Estamos isolados e com pouco suprimento. Por favor, venham nos socorrer!",
		"Ventos fortes danificaram gravemente nosso telhado! Estamos desabrigados e com medo. Por favor, venham nos ajudar imediatamente!"
	];
	
	echo '<h2>Funcionarios</h2>';
	$funcionarios = array();
	for ($i=0; $i<$limit; $i++){
		$nome = genRandomPersonName();
		$funcionarios[] = $daoFuncionario->insert($nome, genRandomEmail($nome), encryptPassword("1234"), TIPO_USUARIO::GESTOR);
	}
	
	echo '<h2>Gestores</h2>';
	$gestores = array();
	for ($i=0; $i<$limit/2; $i++){
		$gestores[] = $daoGestor->insert($funcionarios[$limit/2 + $i]);
	}
	
	echo '<h2>Técnicos</h2>';
	$tecnicos = array();
	for ($i=0; $i<$limit/2; $i++){
		$tecnicos[] = $daoTecnico->insert($funcionarios[$i], ($i&1) == 0);
	}
	
	echo '<h2>Comunicados</h2>';
	$comunicados = array();
	for ($i=0; $i<$limit; $i++){
		$comunicados[] = $daoComunicado->insert($gestores[0], "Comunicado Nº".$i);
	}
	
	echo '<h2>Enderecos</h2>';
	$enderecos = array();
	for ($i=0; $i<$limit; $i++){
		$enderecos[] = $daoEndereco->insert(str_pad($i.'9', 8, '0'), 'Rua '.genRandomPersonName(), $bairros[$i%count($bairros)], 'Franco da Rocha');
	}
	
	echo '<h2>Residenciais</h2>';
	$residenciais = array();
	for ($i=0; $i<$limit; $i++){
		$fixed_i = $i>>3;
		$cep = str_pad($fixed_i.'9', 8, '0');
		$residenciais[] = $daoResidencial->insert($cep, (($i>>1) + 1).($i&1? 'a': 'b'));
	}
	
	echo '<h2>Casas</h2>';
	$casas = array();
	for ($i=0; $i<$limit; $i++){
		$casas[] = $daoCasa->insert($residenciais[$i], INTERDICAO::NAO, (($i&0x3)==0? "Frente": (($i&0x3)==1? "Corredor": (($i&0x3)==2? "Fundos": ''))));
	}
	
	echo '<h2>Civis</h2>';
	$civis = array();
	$civis_casa = array();
	for ($i=0; $i<$limit; $i++){
		$nome = genRandomPersonName();
		$civis_casa[] = randomItem($casas);
	}
		$civis[] = $daoCivil->insert(randomItem($residenciais, true), $nome, genRandomEmail($nome), '', substr(hexdec(hash('sha256', 'cpf:'.$i)).'', 2, 11), '119'.substr(hexdec(hash('sha256', 'celular:'.$i)).'', 2, 8), '11'.substr(hexdec(hash('sha256', 'telefone:'.$i)).'', 2, 8));
	
	echo '<h2>Ocorrencias</h2>';
	$ocorrencias = array();
	$ocorrencias_casas = array();
	for ($i=0; $i<$limit; $i++){
		$data = genRandomDate();
		$aprovado = ($i%3)==0? 1: 0;
		$desaprovado = $i&1;
		$ocorrencias_casas[] = randomItem($civis_casa);
		$ocorrencias[] = $daoOcorrencia->insert($aprovado? $tecnicos[$i>>1]: null, randomItem($civis, true), new Residencial(randomItem($civis_casa, true)->getIdResidencial(), '', ''), (($i&1) == 0? "telefone": "presencial"), $relatos[$i%count($relatos)].' #'.$i, 1, $aprovado? 1: 0, $aprovado? 1: ($desaprovado), $data->format('Y-m-d H:i:s'));
	}
	
	echo '<h2>Relatorios</h2>';
	$relatorios = array();
	for ($i=0; $i<($limit/3); $i++){
		$data1 = genRandomDate();
		$data2 = genRandomDate();
		// casa_id must be non repetible
		$relatorios[] = $daoRelatorio->insert($ocorrencias[floor($i/3)], $ocorrencias_casas[floor($i/3)], $i%3, "Relatório".$i, "Encaminhamento".$i, "Memo".$i, "Ofício".$i, "Processo".$i, "Assunto".$i, "Observações".$i, AREA_AFETADA::PARTICULAR, TIPO_CONSTRUCAO::MADEIRA, TIPO_TALUDE::NATURAL, VEGETACAO::NENHUMA, rand(0, 100)<20? INTERDICAO::NAO: (rand(0, 75)? INTERDICAO::PARCIAL: INTERDICAO::TOTAL), SITUACAO_VITIMAS::DESABRIGADOS, ($i&1) != 0, $data1->format('Y-m-d H:i:s'), $data2->format('Y-m-d H:i:s'));
	}
	
	echo '<h2>Afetados</h2>';
	$afetados = array();
	for ($i=0; $i<($limit>>3); $i++){
		$afetados[] = $daoAfetados->insert($relatorios[$i], rand(0, 20), rand(0, 20), rand(0, 20), rand(0, 20), rand(0, 20), rand(0, 20), rand(0, 20));
	}
	
	echo '<h2>Animais</h2>';
	$animais = array();
	for ($i=0; $i<($limit>>3); $i++){
		$animais[] = $daoAnimal->insert($relatorios[$i], rand(0, 20), rand(0, 20), rand(0, 20), rand(0, 20));
	}
	
	echo '<h2>Fotos</h2>';
	$fotos = array();
	for ($i=0; $i<($limit>>3); $i++){
		$fotos[] = $daoFoto->insert($relatorios[$i>>1], 'base64:data='.$i.';source='.($i&1));
	}
	
	echo '<h2>DadosDaVistoria</h2>';
	$dadosDaVistoria = array();
	for ($i=0; $i<($limit>>3); $i++){
		$dadosDaVistoria[] = $daoDadosDaVistoria->insert($relatorios[$i], (rand(0, 20)&1)!=0, (rand(0, 20)&1)!=0, (rand(0, 20)&1)!=0, (rand(0, 20)&1)!=0, (rand(0, 20)&1)!=0, (rand(0, 20)&1)!=0, (rand(0, 20)&1)!=0, (rand(0, 20)&1)!=0, (rand(0, 20)&1)!=0, (rand(0, 20)&1)!=0, (rand(0, 20)&1)!=0, (rand(0, 20)&1? '': 'outros'.$i));
	}
	
	echo '<h2>Cargos</h2>';
	$cargos = array();
	for ($i=0; $i<$limit; $i++){
		$cargos[] = $daoCargo->insert('Cargo'.$i);
	}
	
	echo '<h2>Secretarias</h2>';
	$secretarias = array();
	for ($i=0; $i<$limit; $i++){
		$secretarias[] = $daoSecretaria->insert('Secretaria'.$i);
	}
	
	echo '<h2>Secretarios</h2>';
	$secretarios = array();
	for ($i=0; $i<$limit; $i++){
		$secretarios[] = $daoSecretario->insert($secretarias[$i], $cargos[$i], genRandomPersonName());
	}
	
	echo '<h2>Memos</h2>';
	$memos = array();
	for ($i=0; $i<($limit>>3); $i++){
		$data = genRandomDate();
		$memos[] = $daoMemo->insert($relatorios[$i], $secretarias[$i], $data->format('Y-m-d H:i:s'), 'Status'.$i, 'setor'.$i, 'processo'.$i);
	}
	
	echo '<h2>LocalAjuda</h2>';
	$localAjuda = array();
	for ($i=0; $i<($limit>>5); $i++){
		$fixed_i = $i<<2;
		$cep = str_pad($fixed_i.'9', 8, '0');
		$localAjuda[] = $daoLocalAjuda->insert($cep, 'TIPO'.$i, 'conteudo'.$i);
	}
	
	echo '<h2>Pluviometros</h2>';
	$pluviometros = array();
	for ($i=0; $i<(($limit>>4)+1); $i++){
		$fixed_i = $i>>3;
		$cep = str_pad($fixed_i.'9', 8, '0');
		$pluviometros[] = $daoPluviometro->insert($cep, 0.5*$i, 1.5*$i);
	}
	
	echo '<h2>Fluviometros</h2>';
	$fluviometros = array();
	for ($i=0; $i<(($limit>>4)+1); $i++){
		$fixed_i = $i>>3;
		$cep = str_pad($fixed_i.'9', 8, '0');
		$fluviometros[] = $daoFluviometro->insert($cep, 0.75*$i, 1.75*$i);
	}
	
	echo '<h2>NivelChuva</h2>';
	$nivelChuva = array();
	for ($i=0; $i<$limit; $i++){
		$data = genRandomDate();
		$nivelChuva[] = $daoNivelChuva->insert($pluviometros[$i>>4], rand(0, 9900)/10, $data->format('Y-m-d H:i:s'));
	}
	
	echo '<h2>NivelRio</h2>';
	$nivelRio = array();
	for ($i=0; $i<$limit; $i++){
		$data = genRandomDate();
		$nivelRio[] = $daoNivelRio->insert($fluviometros[$i>>4], rand(0, 9900)/10, $data->format('Y-m-d H:i:s'));
	}
	
	echo '<h2>AlertaChuva</h2>';
	$alertaChuva = array();
	for ($i=0; $i<$limit; $i++){
		$data = genRandomDate();
		$alertaChuva[] = $daoAlertaChuva->insert($pluviometros[$i>>4], 'status'.$i, $data->format('Y-m-d H:i:s'));
	}
	
	echo '<h2>AlertaRio</h2>';
	$alertaRio = array();
	for ($i=0; $i<$limit; $i++){
		$data = genRandomDate();
		$alertaRio[] = $daoAlertaRio->insert($fluviometros[$i>>4], 'nivel'.$i, $data->format('Y-m-d H:i:s'));
	}
	
	
	
	echo '<br/><br/><h1>DB populated with data!</h1>';
	} catch (\Throwable $th) {
		echo $th;
	}
	
?>