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
	
	// Fix the max server can run
	set_time_limit(5000);
	
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
		"Richard", "Fabrício", "Osvaldo", "Charles", "Rohniere", "Yasmin", "Luide", "Rovilson", "Neymar",
		"Henrique", "Cláudio", "Ebert", "Michel", "Michele", "Clara", "Leandro", "Cássio", "Arthur"
	];
	$lastName = [
		"Souza", "de Souza", "Oliveira", "de Oliveira", "Salles", "Sartre", "Russeau", "Gonçalves", "da Silva", "Silva", "Santos", "Diaz", "Richards", "Manragon", "Pinho", "Brown",
		"Pereira", "Ferreira", "Augusto", "Filho", "Pinto", "Santos", "dos Santos", "Jaime", "Luís",
		"Cruz", "Putin", "Cassandra", "Alves", "Roberto", "Picasso", "Daniel", "Nilda", "Freitas",
		"Ledo", "Lirussi", "Noberto", "Bueno", "Pires", "Souzones", "Pedro", "Felipe", "Buarque",
		"Porto", "de Holanda", "Vitor", "Bergman", "Bergantins", "Soares", "Mello", "Lima", "Rodrigues",
		"Brito", "Alencar", "de Alencar", "Nogueira", "Lenha Verde", "da Penha", "Gentile", "Lins",
		"Lusiano", "Lusitano", "Osvaldo", "Araújo", "Ferraz", "Veríssimo", "Ramos", "Júnior", "Fagundes"
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
		$tecnicos[] = $daoTecnico->insert($funcionarios[$i], ($i&1) == 0, null);
	}
	
	echo '<h2>Comunicados</h2>';
	$comunicados = array();
	for ($i=0; $i<$limit; $i++){
		$comunicados[] = $daoComunicado->insert($gestores[0], "Comunicado Nº".$i);
	}
	
	echo '<h2>Enderecos</h2>';
	$enderecos = array(
		'07810560' => $daoEndereco->insert('07810560', 'Estrada Municipal', 'Aldeia Ivoturucaia', 'Franco da Rocha'),
		'07810570' => $daoEndereco->insert('07810570', 'Rua Alencar Martins', 'Aldeia Ivoturucaia', 'Franco da Rocha'),
		'07810580' => $daoEndereco->insert('07810580', 'Rua Carlos Aparecido da Costa', 'Aldeia Ivoturucaia', 'Franco da Rocha'),
		'07810590' => $daoEndereco->insert('07810590', 'Rua Jorge Boldrin', 'Aldeia Ivoturucaia', 'Franco da Rocha'),
		'07810600' => $daoEndereco->insert('07810600', 'Rua Júlio Renteiro', 'Aldeia Ivoturucaia', 'Franco da Rocha'),
		'07810610' => $daoEndereco->insert('07810610', 'Rua Padre Tadeu Sikorski', 'Aldeia Ivoturucaia', 'Franco da Rocha'),
		'07810620' => $daoEndereco->insert('07810620', 'Rua Ramiro Candido Nascimento Filho', 'Aldeia Ivoturucaia', 'Franco da Rocha'),
		'07899899' => $daoEndereco->insert('07899899', 'Área Rural', 'Área Rural de Franco da Rocha', 'Franco da Rocha'),
		'07870310' => $daoEndereco->insert('07870310', 'Rua do Picadão', 'Bairro da Vargem Grande', 'Franco da Rocha'),
		'07870010' => $daoEndereco->insert('07870010', 'Rua da Torre', 'Bairro dos Penhas', 'Franco da Rocha'),
		'07870020' => $daoEndereco->insert('07870020', 'Rua Servidão', 'Bairro dos Penhas', 'Franco da Rocha'),
		'07856410' => $daoEndereco->insert('07856410', 'Estrada Municipal do Itaim', 'Campos de São Benedito', 'Franco da Rocha'),
		'07856420' => $daoEndereco->insert('07856420', 'Estrada Municipal Vargem Grande-Itaim', 'Campos de São Benedito', 'Franco da Rocha'),
		'07856430' => $daoEndereco->insert('07856430', 'Rua Augusta Inocêncio da Conceição', 'Campos de São Benedito', 'Franco da Rocha'),
		'07856440' => $daoEndereco->insert('07856440', 'Rua Francisca Cândida de Brito', 'Campos de São Benedito', 'Franco da Rocha'),
		'07856450' => $daoEndereco->insert('07856450', 'Rua José Joaquim dos Santos', 'Campos de São Benedito', 'Franco da Rocha'),
		'07856460' => $daoEndereco->insert('07856460', 'Rua Josefina Cafacce Viola', 'Campos de São Benedito', 'Franco da Rocha'),
		'07856470' => $daoEndereco->insert('07856470', 'Rua Marcela Massa Celeguim', 'Campos de São Benedito', 'Franco da Rocha'),
		'07856480' => $daoEndereco->insert('07856480', 'Rua Oscar de Almeida Nunes', 'Campos de São Benedito', 'Franco da Rocha'),
		'07856490' => $daoEndereco->insert('07856490', 'Travessa José Bueno de Moares', 'Campos de São Benedito', 'Franco da Rocha'),
		'07801000' => $daoEndereco->insert('07801000', 'Rua Doutor Hamilton Prado', 'Centro', 'Franco da Rocha'),
		'07801010' => $daoEndereco->insert('07801010', 'Rua Benedito Fagundes Marques', 'Centro', 'Franco da Rocha'),
		'07801015' => $daoEndereco->insert('07801015', 'Praça Sueli Gonçalves Ferraresi', 'Centro', 'Franco da Rocha'),
		'07801020' => $daoEndereco->insert('07801020', 'Rua Abelardo Alves de Andrade', 'Centro', 'Franco da Rocha'),
		'07801030' => $daoEndereco->insert('07801030', 'Rua Faliero del Débio', 'Centro', 'Franco da Rocha'),
		'07801040' => $daoEndereco->insert('07801040', 'Rua José Augusto Moreira', 'Centro', 'Franco da Rocha'),
		'07801045' => $daoEndereco->insert('07801045', 'Praça José Rodrigues', 'Centro', 'Franco da Rocha'),
		'07801050' => $daoEndereco->insert('07801050', 'Rua Raul Bressani Malta', 'Centro', 'Franco da Rocha'),
		'07801060' => $daoEndereco->insert('07801060', 'Rua Vereador João de Almeida', 'Centro', 'Franco da Rocha'),
		'07801070' => $daoEndereco->insert('07801070', 'Viela Trinta e Nove', 'Centro', 'Franco da Rocha'),
		'07801080' => $daoEndereco->insert('07801080', 'Viela Quarenta', 'Centro', 'Franco da Rocha'),
		'07850010' => $daoEndereco->insert('07850010', 'Rua Dona Ingard Drager', 'Centro', 'Franco da Rocha'),
		'07850011' => $daoEndereco->insert('07850011', 'Rua João Francisco G. Garcia', 'Centro', 'Franco da Rocha'),
		'07850012' => $daoEndereco->insert('07850012', 'Rua Antônio Muzzi Sobrinho', 'Centro', 'Franco da Rocha'),
		'07850320' => $daoEndereco->insert('07850320', 'Avenida dos Coqueiros', 'Centro', 'Franco da Rocha'),
		'07850321' => $daoEndereco->insert('07850321', 'Rua Marechal Gaspar Dutra', 'Centro', 'Franco da Rocha'),
		'07850322' => $daoEndereco->insert('07850322', 'Travessa Mário Cruz', 'Centro', 'Franco da Rocha'),
		'07850323' => $daoEndereco->insert('07850323', 'Rua José Alves Ferreira Filho', 'Centro', 'Franco da Rocha'),
		'07850324' => $daoEndereco->insert('07850324', 'Rua Servidão', 'Centro', 'Franco da Rocha'),
		'07850325' => $daoEndereco->insert('07850325', 'Avenida Liberdade', 'Centro', 'Franco da Rocha'),
		'07850328' => $daoEndereco->insert('07850328', 'Travessa João Rodrigues de Moraes', 'Centro', 'Franco da Rocha'),
		'07850330' => $daoEndereco->insert('07850330', 'Rua José Patrocínio', 'Centro', 'Franco da Rocha'),
		'07850331' => $daoEndereco->insert('07850331', 'Rua Nelson Rodrigues', 'Centro', 'Franco da Rocha'),
		'07850335' => $daoEndereco->insert('07850335', 'Rua Doutora Apparecida Leopoldo da Silva', 'Centro', 'Franco da Rocha'),
		'07850340' => $daoEndereco->insert('07850340', 'Rua Gentil Rocha', 'Centro', 'Franco da Rocha'),
		'07850350' => $daoEndereco->insert('07850350', 'Estrada do Governo', 'Centro', 'Franco da Rocha'),
		'07850510' => $daoEndereco->insert('07850510', 'Alameda Paulo Fraletti', 'Centro', 'Franco da Rocha'),
		'07850900' => $daoEndereco->insert('07850900', 'Estrada do Governo, 373', 'Centro', 'Franco da Rocha'),
		'07850901' => $daoEndereco->insert('07850901', 'Avenida dos Coqueiros, 300', 'Centro', 'Franco da Rocha'),
		'07850902' => $daoEndereco->insert('07850902', 'Avenida Liberdade, 250', 'Centro', 'Franco da Rocha'),
		'07850903' => $daoEndereco->insert('07850903', 'Avenida Liberdade, s/n', 'Centro', 'Franco da Rocha'),
		'07850904' => $daoEndereco->insert('07850904', 'Alameda Paulo Fraletti, 75 Bloco A', 'Centro', 'Franco da Rocha'),
		'07850905' => $daoEndereco->insert('07850905', 'Alameda Paulo Fraletti, 95 Bloco B', 'Centro', 'Franco da Rocha'),
		'07851002' => $daoEndereco->insert('07851002', 'Rua Coronel Fagundes', 'Centro', 'Franco da Rocha'),
		'07851003' => $daoEndereco->insert('07851003', 'Rua Otávio Almeida Nunes', 'Centro', 'Franco da Rocha'),
		'07851010' => $daoEndereco->insert('07851010', 'Rua Azevedo Soares', 'Centro', 'Franco da Rocha'),
		'07851011' => $daoEndereco->insert('07851011', 'Rua Clóvis Beviláqua', 'Centro', 'Franco da Rocha'),
		'07851070' => $daoEndereco->insert('07851070', 'Rua Orlando Amoroso', 'Centro', 'Franco da Rocha'),
		'07851071' => $daoEndereco->insert('07851071', 'Rua Zanela e Alves', 'Centro', 'Franco da Rocha'),
		'07851080' => $daoEndereco->insert('07851080', 'Rua Dezenove de Novembro', 'Centro', 'Franco da Rocha'),
		'07865000' => $daoEndereco->insert('07865000', 'Avenida Tonico Lenci', 'Chácara São Luiz', 'Franco da Rocha'),
		'07865010' => $daoEndereco->insert('07865010', 'Avenida Tonico Lenci', 'Chácara São Luiz', 'Franco da Rocha'),
		'07865020' => $daoEndereco->insert('07865020', 'Avenida Tonico Lenci', 'Chácara São Luiz', 'Franco da Rocha'),
		'07865026' => $daoEndereco->insert('07865026', 'Rua Jamelão', 'Chácara São Luiz', 'Franco da Rocha'),
		'07865028' => $daoEndereco->insert('07865028', 'Rua João Nogueira', 'Chácara São Luiz', 'Franco da Rocha'),
		'07865030' => $daoEndereco->insert('07865030', 'Rua Seis', 'Chácara São Luiz', 'Franco da Rocha'),
		'07865032' => $daoEndereco->insert('07865032', 'Rua Alexandre Magno Abrão', 'Chácara São Luiz', 'Franco da Rocha'),
		'07865034' => $daoEndereco->insert('07865034', 'Rua Luiz Gonzaga', 'Chácara São Luiz', 'Franco da Rocha'),
		'07865036' => $daoEndereco->insert('07865036', 'Rua Cartola', 'Chácara São Luiz', 'Franco da Rocha'),
		'07865038' => $daoEndereco->insert('07865038', 'Rua Dez', 'Chácara São Luiz', 'Franco da Rocha'),
		'07865040' => $daoEndereco->insert('07865040', 'Rua Leandro', 'Chácara São Luiz', 'Franco da Rocha'),
		'07865042' => $daoEndereco->insert('07865042', 'Rua Doze', 'Chácara São Luiz', 'Franco da Rocha'),
		'07865044' => $daoEndereco->insert('07865044', 'Rua Cristiano Araújo', 'Chácara São Luiz', 'Franco da Rocha'),
		'07865046' => $daoEndereco->insert('07865046', 'Rua Noel Rosa', 'Chácara São Luiz', 'Franco da Rocha'),
		'07865048' => $daoEndereco->insert('07865048', 'Rua João Paulo', 'Chácara São Luiz', 'Franco da Rocha'),
		'07865050' => $daoEndereco->insert('07865050', 'Rua Mamonas Assassinas', 'Chácara São Luiz', 'Franco da Rocha'),
		'07865052' => $daoEndereco->insert('07865052', 'Rua Robert Nesta Marley', 'Chácara São Luiz', 'Franco da Rocha'),
		'07865054' => $daoEndereco->insert('07865054', 'Rua Elis Regina', 'Chácara São Luiz', 'Franco da Rocha'),
		'07865056' => $daoEndereco->insert('07865056', 'Rua Bezerra da Silva', 'Chácara São Luiz', 'Franco da Rocha'),
		'07865060' => $daoEndereco->insert('07865060', 'Estrada do Lago', 'Chácara São Luiz', 'Franco da Rocha'),
		'07865070' => $daoEndereco->insert('07865070', 'Estrada do Mangueirão', 'Chácara São Luiz', 'Franco da Rocha'),
		'07865080' => $daoEndereco->insert('07865080', 'Estrada da Biquinha', 'Chácara São Luiz', 'Franco da Rocha'),
		'07865090' => $daoEndereco->insert('07865090', 'Estrada do Vale', 'Chácara São Luiz', 'Franco da Rocha'),
		'07865115' => $daoEndereco->insert('07865115', 'Estrada da Paradinha', 'Chácara São Luiz', 'Franco da Rocha'),
		'07865120' => $daoEndereco->insert('07865120', 'Estrada Professor Laudelino Alves Ferreira', 'Chácara São Luiz', 'Franco da Rocha'),
		'07865125' => $daoEndereco->insert('07865125', 'Estrada do Jardim', 'Chácara São Luiz', 'Franco da Rocha'),
		'07810500' => $daoEndereco->insert('07810500', 'Estrada do Bom Tempo', 'Chácaras Bom Tempo', 'Franco da Rocha'),
		'07810510' => $daoEndereco->insert('07810510', 'Rua Céu', 'Chácaras Bom Tempo', 'Franco da Rocha'),
		'07810520' => $daoEndereco->insert('07810520', 'Rua Lua', 'Chácaras Bom Tempo', 'Franco da Rocha'),
		'07810530' => $daoEndereco->insert('07810530', 'Rua Natureza', 'Chácaras Bom Tempo', 'Franco da Rocha'),
		'07810540' => $daoEndereco->insert('07810540', 'Rua Sol', 'Chácaras Bom Tempo', 'Franco da Rocha'),
		'07810550' => $daoEndereco->insert('07810550', 'Rua Vilage Arco Iris', 'Chácaras Bom Tempo', 'Franco da Rocha'),
		'07811010' => $daoEndereco->insert('07811010', 'Estrada das Colinas', 'Chácaras das Colinas', 'Franco da Rocha'),
		'07811020' => $daoEndereco->insert('07811020', 'Estrada Marcelo A. de J. Pinto', 'Chácaras das Colinas', 'Franco da Rocha'),
		'07811030' => $daoEndereco->insert('07811030', 'Estrada para Parnaíba', 'Chácaras das Colinas', 'Franco da Rocha'),
		'07810650' => $daoEndereco->insert('07810650', 'Estrada Marcelo A. de J. Pinto', 'Chácaras do Rosário', 'Franco da Rocha'),
		'07810670' => $daoEndereco->insert('07810670', 'Rua Avinhado', 'Chácaras do Rosário', 'Franco da Rocha'),
		'07810680' => $daoEndereco->insert('07810680', 'Rua Beija-flor', 'Chácaras do Rosário', 'Franco da Rocha'),
		'07810690' => $daoEndereco->insert('07810690', 'Rua Bem-Te-Vi', 'Chácaras do Rosário', 'Franco da Rocha'),
		'07810700' => $daoEndereco->insert('07810700', 'Rua Canário', 'Chácaras do Rosário', 'Franco da Rocha'),
		'07810710' => $daoEndereco->insert('07810710', 'Rua Flamingo', 'Chácaras do Rosário', 'Franco da Rocha'),
		'07810720' => $daoEndereco->insert('07810720', 'Rua Gralha', 'Chácaras do Rosário', 'Franco da Rocha'),
		'07810730' => $daoEndereco->insert('07810730', 'Rua Pardal', 'Chácaras do Rosário', 'Franco da Rocha'),
		'07810740' => $daoEndereco->insert('07810740', 'Rua Pitassilgo', 'Chácaras do Rosário', 'Franco da Rocha'),
		'07810750' => $daoEndereco->insert('07810750', 'Rua Sabiá', 'Chácaras do Rosário', 'Franco da Rocha'),
		'07810760' => $daoEndereco->insert('07810760', 'Rua Tucano', 'Chácaras do Rosário', 'Franco da Rocha'),
		'07810770' => $daoEndereco->insert('07810770', 'Viela D', 'Chácaras do Rosário', 'Franco da Rocha'),
		'07810780' => $daoEndereco->insert('07810780', 'Viela E', 'Chácaras do Rosário', 'Franco da Rocha'),
		'07830350' => $daoEndereco->insert('07830350', 'Avenida Sinato', 'Chácaras Maristela', 'Franco da Rocha'),
		'07830360' => $daoEndereco->insert('07830360', 'Estrada da Fábrica', 'Chácaras Maristela', 'Franco da Rocha'),
		'07830370' => $daoEndereco->insert('07830370', 'Estrada da Ilha', 'Chácaras Maristela', 'Franco da Rocha'),
		'07830380' => $daoEndereco->insert('07830380', 'Estrada do Contorno', 'Chácaras Maristela', 'Franco da Rocha'),
		'07830390' => $daoEndereco->insert('07830390', 'Estrada Maristela', 'Chácaras Maristela', 'Franco da Rocha'),
		'07832430' => $daoEndereco->insert('07832430', 'Rodovia Tancredo de Almeida Neves', 'Chácaras Maristela', 'Franco da Rocha'),
		'07811180' => $daoEndereco->insert('07811180', 'Estrada para Parnaíba', 'Chácaras Rutina Strauss', 'Franco da Rocha'),
		'07811190' => $daoEndereco->insert('07811190', 'Rua Firenza', 'Chácaras Rutina Strauss', 'Franco da Rocha'),
		'07811200' => $daoEndereco->insert('07811200', 'Rua Napólis', 'Chácaras Rutina Strauss', 'Franco da Rocha'),
		'07811210' => $daoEndereco->insert('07811210', 'Rua Roma', 'Chácaras Rutina Strauss', 'Franco da Rocha'),
		'07863260' => $daoEndereco->insert('07863260', 'Estrada da Divisa', 'Chácaras São José', 'Franco da Rocha'),
		'07863270' => $daoEndereco->insert('07863270', 'Estrada da Encosta', 'Chácaras São José', 'Franco da Rocha'),
		'07863280' => $daoEndereco->insert('07863280', 'Estrada da Olaria', 'Chácaras São José', 'Franco da Rocha'),
		'07863290' => $daoEndereco->insert('07863290', 'Estrada do Alto', 'Chácaras São José', 'Franco da Rocha'),
		'07863300' => $daoEndereco->insert('07863300', 'Estrada das Palmeiras', 'Chácaras São José', 'Franco da Rocha'),
		'07863305' => $daoEndereco->insert('07863305', 'Travessa Mariana Balbina Aranha', 'Chácaras São José', 'Franco da Rocha'),
		'07863310' => $daoEndereco->insert('07863310', 'Estrada São José', 'Chácaras São José', 'Franco da Rocha'),
		'07863420' => $daoEndereco->insert('07863420', 'Avenida Miguel João Ortiz', 'Chácaras São José', 'Franco da Rocha'),
		'07801090' => $daoEndereco->insert('07801090', 'Rua Ademar Martins da Silva', 'Companhia Fazenda Belém', 'Franco da Rocha'),
		'07801100' => $daoEndereco->insert('07801100', 'Rua Viela', 'Companhia Fazenda Belém', 'Franco da Rocha'),
		'07801110' => $daoEndereco->insert('07801110', 'Rua Juvenal Gomes do Monte', 'Companhia Fazenda Belém', 'Franco da Rocha'),
		'07801115' => $daoEndereco->insert('07801115', 'Rua Gumercindo Rodrigues de Oliveira', 'Companhia Fazenda Belém', 'Franco da Rocha'),
		'07801125' => $daoEndereco->insert('07801125', 'Rua Lourival Beltrane', 'Companhia Fazenda Belém', 'Franco da Rocha'),
		'07801130' => $daoEndereco->insert('07801130', 'Viela Quarenta e Dois', 'Companhia Fazenda Belém', 'Franco da Rocha'),
		'07801140' => $daoEndereco->insert('07801140', 'Rua Doutor Osório Cezar', 'Companhia Fazenda Belém', 'Franco da Rocha'),
		'07801160' => $daoEndereco->insert('07801160', 'Viela Trinta e Um', 'Companhia Fazenda Belém', 'Franco da Rocha'),
		'07801170' => $daoEndereco->insert('07801170', 'Rua Barão de Mauá', 'Companhia Fazenda Belém', 'Franco da Rocha'),
		'07801180' => $daoEndereco->insert('07801180', 'Viela Trinta', 'Companhia Fazenda Belém', 'Franco da Rocha'),
		'07801200' => $daoEndereco->insert('07801200', 'Rua Doutor Adolpho Loretti Pujol', 'Companhia Fazenda Belém', 'Franco da Rocha'),
		'07801210' => $daoEndereco->insert('07801210', 'Viela Joaquim Bento da Silva', 'Companhia Fazenda Belém', 'Franco da Rocha'),
		'07801230' => $daoEndereco->insert('07801230', 'Travessa Bernardo Domene', 'Companhia Fazenda Belém', 'Franco da Rocha'),
		'07802000' => $daoEndereco->insert('07802000', 'Rua Salesópolis', 'Companhia Fazenda Belém', 'Franco da Rocha'),
		'07802010' => $daoEndereco->insert('07802010', 'Travessa Atibaia', 'Companhia Fazenda Belém', 'Franco da Rocha'),
		'07802020' => $daoEndereco->insert('07802020', 'Rua Antônio Figueiredo Ramos', 'Companhia Fazenda Belém', 'Franco da Rocha'),
		'07802030' => $daoEndereco->insert('07802030', 'Rua João Rais', 'Companhia Fazenda Belém', 'Franco da Rocha'),
		'07802040' => $daoEndereco->insert('07802040', 'Rua São Roque', 'Companhia Fazenda Belém', 'Franco da Rocha'),
		'07802050' => $daoEndereco->insert('07802050', 'Viela Vinte e Sete', 'Companhia Fazenda Belém', 'Franco da Rocha'),
		'07802060' => $daoEndereco->insert('07802060', 'Viela Vinte e Três', 'Companhia Fazenda Belém', 'Franco da Rocha'),
		'07802070' => $daoEndereco->insert('07802070', 'Viela Vinte e Seis', 'Companhia Fazenda Belém', 'Franco da Rocha'),
		'07802080' => $daoEndereco->insert('07802080', 'Rua Antônio Cardoso Moreira', 'Companhia Fazenda Belém', 'Franco da Rocha'),
		'07802100' => $daoEndereco->insert('07802100', 'Rua João Oliva', 'Companhia Fazenda Belém', 'Franco da Rocha'),
		'07802110' => $daoEndereco->insert('07802110', 'Rua Guadalajara', 'Companhia Fazenda Belém', 'Franco da Rocha'),
		'07802120' => $daoEndereco->insert('07802120', 'Rua Odilon Beltrame', 'Companhia Fazenda Belém', 'Franco da Rocha'),
		'07802140' => $daoEndereco->insert('07802140', 'Rua Joaquim Cunha', 'Companhia Fazenda Belém', 'Franco da Rocha'),
		'07802150' => $daoEndereco->insert('07802150', 'Rua Antônio Ignácio Bicudo', 'Companhia Fazenda Belém', 'Franco da Rocha'),
		'07802160' => $daoEndereco->insert('07802160', 'Rua Presidente Castelo Branco', 'Companhia Fazenda Belém', 'Franco da Rocha'),
		'07802190' => $daoEndereco->insert('07802190', 'Rua Basílio Fazzi', 'Companhia Fazenda Belém', 'Franco da Rocha'),
		'07802195' => $daoEndereco->insert('07802195', 'Praça Cristo Redentor', 'Companhia Fazenda Belém', 'Franco da Rocha'),
		'07802200' => $daoEndereco->insert('07802200', 'Rua Giacomo Celeguim', 'Companhia Fazenda Belém', 'Franco da Rocha'),
		'07802210' => $daoEndereco->insert('07802210', 'Praça Alexandre Botinelli', 'Companhia Fazenda Belém', 'Franco da Rocha'),
		'07802240' => $daoEndereco->insert('07802240', 'Rua Estênio Machado Loureiro', 'Companhia Fazenda Belém', 'Franco da Rocha'),
		'07802250' => $daoEndereco->insert('07802250', 'Rua Corypheu Azevedo Marques', 'Companhia Fazenda Belém', 'Franco da Rocha'),
		'07802260' => $daoEndereco->insert('07802260', 'Rua Dona Amália Sestini', 'Companhia Fazenda Belém', 'Franco da Rocha'),
		'07803000' => $daoEndereco->insert('07803000', 'Avenida Prefeito Ângelo Celeguim', 'Companhia Fazenda Belém', 'Franco da Rocha'),
		'07803010' => $daoEndereco->insert('07803010', 'Avenida dos Expedicionários', 'Companhia Fazenda Belém', 'Franco da Rocha'),
		'07803040' => $daoEndereco->insert('07803040', 'Rua Nelson Garcia', 'Companhia Fazenda Belém', 'Franco da Rocha'),
		'07803080' => $daoEndereco->insert('07803080', 'Rua Antônio Cândido de Almeida', 'Companhia Fazenda Belém', 'Franco da Rocha'),
		'07803090' => $daoEndereco->insert('07803090', 'Rua José Roberto Rosa', 'Companhia Fazenda Belém', 'Franco da Rocha'),
		'07803100' => $daoEndereco->insert('07803100', 'Rua Professor Carvalho Pinto', 'Companhia Fazenda Belém', 'Franco da Rocha'),
		'07803110' => $daoEndereco->insert('07803110', 'Viela Dois', 'Companhia Fazenda Belém', 'Franco da Rocha'),
		'07803120' => $daoEndereco->insert('07803120', 'Rua Geraldo Aparecido Franco de Oliveira', 'Companhia Fazenda Belém', 'Franco da Rocha'),
		'07803130' => $daoEndereco->insert('07803130', 'Rua Luiz Vital Trevisan', 'Companhia Fazenda Belém', 'Franco da Rocha'),
		'07803140' => $daoEndereco->insert('07803140', 'Viela Oito A', 'Companhia Fazenda Belém', 'Franco da Rocha'),
		'07803172' => $daoEndereco->insert('07803172', 'Viela Oito B', 'Companhia Fazenda Belém', 'Franco da Rocha'),
		'07803173' => $daoEndereco->insert('07803173', 'Viela Sete', 'Companhia Fazenda Belém', 'Franco da Rocha'),
		'07803190' => $daoEndereco->insert('07803190', 'Rua João Pinto Machado', 'Companhia Fazenda Belém', 'Franco da Rocha'),
		'07803200' => $daoEndereco->insert('07803200', 'Rua Odilon Jorge Ramos', 'Companhia Fazenda Belém', 'Franco da Rocha'),
		'07803205' => $daoEndereco->insert('07803205', 'Rua Birigui', 'Companhia Fazenda Belém', 'Franco da Rocha'),
		'07803210' => $daoEndereco->insert('07803210', 'Viela Quatro', 'Companhia Fazenda Belém', 'Franco da Rocha'),
		'07803230' => $daoEndereco->insert('07803230', 'Rua Marília', 'Companhia Fazenda Belém', 'Franco da Rocha'),
		'07803235' => $daoEndereco->insert('07803235', 'Rua Enoch Garborin', 'Companhia Fazenda Belém', 'Franco da Rocha'),
		'07803250' => $daoEndereco->insert('07803250', 'Rua Franca', 'Companhia Fazenda Belém', 'Franco da Rocha'),
		'07803255' => $daoEndereco->insert('07803255', 'Travessa Franca', 'Companhia Fazenda Belém', 'Franco da Rocha'),
		'07803270' => $daoEndereco->insert('07803270', 'Viela Seis', 'Companhia Fazenda Belém', 'Franco da Rocha'),
		'07803280' => $daoEndereco->insert('07803280', 'Viela Cinquenta e Quatro', 'Companhia Fazenda Belém', 'Franco da Rocha'),
		'07803970' => $daoEndereco->insert('07803970', 'Avenida dos Expedicionários, 170', 'Companhia Fazenda Belém', 'Franco da Rocha'),
		'07807000' => $daoEndereco->insert('07807000', 'Rua Taubaté', 'Companhia Fazenda Belém', 'Franco da Rocha'),
		'07807010' => $daoEndereco->insert('07807010', 'Viela D', 'Companhia Fazenda Belém', 'Franco da Rocha'),
		'07830410' => $daoEndereco->insert('07830410', 'Rua das Ametistas', 'Cristal Parque', 'Franco da Rocha'),
		'07830420' => $daoEndereco->insert('07830420', 'Rua das Esmeraldas', 'Cristal Parque', 'Franco da Rocha'),
		'07830430' => $daoEndereco->insert('07830430', 'Rua das Safiras', 'Cristal Parque', 'Franco da Rocha'),
		'07830440' => $daoEndereco->insert('07830440', 'Rua dos Diamantes', 'Cristal Parque', 'Franco da Rocha'),
		'07863130' => $daoEndereco->insert('07863130', 'Rua Ailton Federzoni', 'Estância Green Valley', 'Franco da Rocha'),
		'07863140' => $daoEndereco->insert('07863140', 'Rua Antonio Vieira Barradas', 'Estância Green Valley', 'Franco da Rocha'),
		'07863150' => $daoEndereco->insert('07863150', 'Rua Armando Misson', 'Estância Green Valley', 'Franco da Rocha'),
		'07863160' => $daoEndereco->insert('07863160', 'Rua Carlos Domingos Celeguim', 'Estância Green Valley', 'Franco da Rocha'),
		'07863170' => $daoEndereco->insert('07863170', 'Rua João Cenachi', 'Estância Green Valley', 'Franco da Rocha'),
		'07863180' => $daoEndereco->insert('07863180', 'Rua João Fornazari', 'Estância Green Valley', 'Franco da Rocha'),
		'07863190' => $daoEndereco->insert('07863190', 'Rua Josefa Francisca da Conceição', 'Estância Green Valley', 'Franco da Rocha'),
		'07863200' => $daoEndereco->insert('07863200', 'Rua Luiz Alberto Federzoni', 'Estância Green Valley', 'Franco da Rocha'),
		'07863210' => $daoEndereco->insert('07863210', 'Rua Luiza Basso Celeguim', 'Estância Green Valley', 'Franco da Rocha'),
		'07863220' => $daoEndereco->insert('07863220', 'Rua Mari Mieris de Almeida', 'Estância Green Valley', 'Franco da Rocha'),
		'07863230' => $daoEndereco->insert('07863230', 'Rua Presidente Tancredo de Almeida Neves', 'Estância Green Valley', 'Franco da Rocha'),
		'07863240' => $daoEndereco->insert('07863240', 'Rua Sebastiana Maria de Jesus', 'Estância Green Valley', 'Franco da Rocha'),
		'07863250' => $daoEndereco->insert('07863250', 'Rua Sebastião Alves Cardoso', 'Estância Green Valley', 'Franco da Rocha'),
		'07866000' => $daoEndereco->insert('07866000', 'Avenida Tonico Lenci', 'Estância Lago Azul', 'Franco da Rocha'),
		'07866010' => $daoEndereco->insert('07866010', 'Viela Onze', 'Estância Lago Azul', 'Franco da Rocha'),
		'07866030' => $daoEndereco->insert('07866030', 'Rua Tibagi', 'Estância Lago Azul', 'Franco da Rocha'),
		'07866040' => $daoEndereco->insert('07866040', 'Rua Dinamarca', 'Estância Lago Azul', 'Franco da Rocha'),
		'07866060' => $daoEndereco->insert('07866060', 'Rua Aricas', 'Estância Lago Azul', 'Franco da Rocha'),
		'07866070' => $daoEndereco->insert('07866070', 'Praça Ibirá', 'Estância Lago Azul', 'Franco da Rocha'),
		'07866080' => $daoEndereco->insert('07866080', 'Viela Nove', 'Estância Lago Azul', 'Franco da Rocha'),
		'07866100' => $daoEndereco->insert('07866100', 'Rua Mirim', 'Estância Lago Azul', 'Franco da Rocha'),
		'07866120' => $daoEndereco->insert('07866120', 'Rua José Donola', 'Estância Lago Azul', 'Franco da Rocha'),
		'07866130' => $daoEndereco->insert('07866130', 'Rua Oroxo', 'Estância Lago Azul', 'Franco da Rocha'),
		'07866140' => $daoEndereco->insert('07866140', 'Viela Sete', 'Estância Lago Azul', 'Franco da Rocha'),
		'07866150' => $daoEndereco->insert('07866150', 'Rua Inajá', 'Estância Lago Azul', 'Franco da Rocha'),
		'07866160' => $daoEndereco->insert('07866160', 'Rua Tangará', 'Estância Lago Azul', 'Franco da Rocha'),
		'07866200' => $daoEndereco->insert('07866200', 'Rua Diadema', 'Estância Lago Azul', 'Franco da Rocha'),
		'07866210' => $daoEndereco->insert('07866210', 'Viela Um', 'Estância Lago Azul', 'Franco da Rocha'),
		'07866220' => $daoEndereco->insert('07866220', 'Rua Flora', 'Estância Lago Azul', 'Franco da Rocha'),
		'07866250' => $daoEndereco->insert('07866250', 'Viela Oito', 'Estância Lago Azul', 'Franco da Rocha'),
		'07866260' => $daoEndereco->insert('07866260', 'Rua Peri', 'Estância Lago Azul', 'Franco da Rocha'),
		'07866270' => $daoEndereco->insert('07866270', 'Viela Seis', 'Estância Lago Azul', 'Franco da Rocha'),
		'07866280' => $daoEndereco->insert('07866280', 'Praça Ubatuba', 'Estância Lago Azul', 'Franco da Rocha'),
		'07866300' => $daoEndereco->insert('07866300', 'Rua Guarará', 'Estância Lago Azul', 'Franco da Rocha'),
		'07866310' => $daoEndereco->insert('07866310', 'Viela Quatro', 'Estância Lago Azul', 'Franco da Rocha'),
		'07866320' => $daoEndereco->insert('07866320', 'Viela Cinco', 'Estância Lago Azul', 'Franco da Rocha'),
		'07866360' => $daoEndereco->insert('07866360', 'Viela Três', 'Estância Lago Azul', 'Franco da Rocha'),
		'07866370' => $daoEndereco->insert('07866370', 'Rua Guarujá', 'Estância Lago Azul', 'Franco da Rocha'),
		'07866390' => $daoEndereco->insert('07866390', 'Rua Montes', 'Estância Lago Azul', 'Franco da Rocha'),
		'07866400' => $daoEndereco->insert('07866400', 'Praça Itanhanga', 'Estância Lago Azul', 'Franco da Rocha'),
		'07866410' => $daoEndereco->insert('07866410', 'Viela Dez', 'Estância Lago Azul', 'Franco da Rocha'),
		'07866500' => $daoEndereco->insert('07866500', 'Avenida Arco Íris', 'Estância Lago Azul', 'Franco da Rocha'),
		'07866510' => $daoEndereco->insert('07866510', 'Rua Esperança', 'Estância Lago Azul', 'Franco da Rocha'),
		'07834000' => $daoEndereco->insert('07834000', 'Rodovia Edgar Máximo Zamboto', 'Glebas', 'Franco da Rocha'),
		'07834040' => $daoEndereco->insert('07834040', 'Rua da Boiada', 'Glebas', 'Franco da Rocha'),
		'07834900' => $daoEndereco->insert('07834900', 'Rodovia Edgar Máximo Zamboto, Km 44,5', 'Glebas', 'Franco da Rocha'),
		'07834950' => $daoEndereco->insert('07834950', 'Rodovia Edgar Máximo Zamboto, Km 44,5', 'Glebas', 'Franco da Rocha'),
		'07808060' => $daoEndereco->insert('07808060', 'Rua Péricles Fernandes', 'Jardim Alice', 'Franco da Rocha'),
		'07808080' => $daoEndereco->insert('07808080', 'Rua Lídia dos Santos', 'Jardim Alice', 'Franco da Rocha'),
		'07808090' => $daoEndereco->insert('07808090', 'Rua Santo André', 'Jardim Alice', 'Franco da Rocha'),
		'07808095' => $daoEndereco->insert('07808095', 'Rua das Oliveiras', 'Jardim Alice', 'Franco da Rocha'),
		'07808110' => $daoEndereco->insert('07808110', 'Rua Elvira Vicente Gaborim', 'Jardim Alice', 'Franco da Rocha'),
		'07808120' => $daoEndereco->insert('07808120', 'Rua Benedita da Silva Andrade', 'Jardim Alice', 'Franco da Rocha'),
		'07808130' => $daoEndereco->insert('07808130', 'Rua Antônio Pádua de Oliveira', 'Jardim Alice', 'Franco da Rocha'),
		'07808140' => $daoEndereco->insert('07808140', 'Rua Maria Regina Ortiz de Camargo', 'Jardim Alice', 'Franco da Rocha'),
		'07808150' => $daoEndereco->insert('07808150', 'Rua Paris Guassieri', 'Jardim Alice', 'Franco da Rocha'),
		'07808160' => $daoEndereco->insert('07808160', 'Rua Miguel de Barros', 'Jardim Alice', 'Franco da Rocha'),
		'07808180' => $daoEndereco->insert('07808180', 'Rua Aparício dos Santos', 'Jardim Alice', 'Franco da Rocha'),
		'07808190' => $daoEndereco->insert('07808190', 'Rua Milton José Mourão', 'Jardim Alice', 'Franco da Rocha'),
		'07808200' => $daoEndereco->insert('07808200', 'Rua Oscar Sérgio Scolfaro', 'Jardim Alice', 'Franco da Rocha'),
		'07808210' => $daoEndereco->insert('07808210', 'Rua João Ortiz de Camargo', 'Jardim Alice', 'Franco da Rocha'),
		'07808220' => $daoEndereco->insert('07808220', 'Rua Antônio Viola Sobrinho', 'Jardim Alice', 'Franco da Rocha'),
		'07808230' => $daoEndereco->insert('07808230', 'Rua José Toledo', 'Jardim Alice', 'Franco da Rocha'),
		'07808240' => $daoEndereco->insert('07808240', 'Rua Maria Rosa Lirussi', 'Jardim Alice', 'Franco da Rocha'),
		'07808250' => $daoEndereco->insert('07808250', 'Rua José Luiz de Andrade', 'Jardim Alice', 'Franco da Rocha'),
		'07836015' => $daoEndereco->insert('07836015', 'Rua Mário Godói', 'Jardim Alpino', 'Franco da Rocha'),
		'07836030' => $daoEndereco->insert('07836030', 'Rua Narciso Vieira', 'Jardim Alpino', 'Franco da Rocha'),
		'07836040' => $daoEndereco->insert('07836040', 'Rua Maria Sampaio do Nascimento Alves', 'Jardim Alpino', 'Franco da Rocha'),
		'07836050' => $daoEndereco->insert('07836050', 'Rua Georgina Pereira da Silva', 'Jardim Alpino', 'Franco da Rocha'),
		'07836060' => $daoEndereco->insert('07836060', 'Rua Deusdete Andrade de Matos', 'Jardim Alpino', 'Franco da Rocha'),
		'07836070' => $daoEndereco->insert('07836070', 'Rua Benedito Antônio da Silva', 'Jardim Alpino', 'Franco da Rocha'),
		'07836080' => $daoEndereco->insert('07836080', 'Rua Euclides Oliveira Leite', 'Jardim Alpino', 'Franco da Rocha'),
		'07836090' => $daoEndereco->insert('07836090', 'Rua Geraldo Mandelli', 'Jardim Alpino', 'Franco da Rocha'),
		'07851050' => $daoEndereco->insert('07851050', 'Rua Alberto Federzoni', 'Jardim Benintendi', 'Franco da Rocha'),
		'07851060' => $daoEndereco->insert('07851060', 'Rua Vinte e Cinco de Dezembro', 'Jardim Benintendi', 'Franco da Rocha'),
		'07851085' => $daoEndereco->insert('07851085', 'Rua Vereador Sidney Simionato', 'Jardim Benintendi', 'Franco da Rocha'),
		'07851090' => $daoEndereco->insert('07851090', 'Rua Vinte e Cinco de Agosto', 'Jardim Benintendi', 'Franco da Rocha'),
		'07852110' => $daoEndereco->insert('07852110', 'Rua Doutor Wislon Solene Gonçalves', 'Jardim Benintendi', 'Franco da Rocha'),
		'07852120' => $daoEndereco->insert('07852120', 'Rua Leopoldo Machado', 'Jardim Benintendi', 'Franco da Rocha'),
		'07852125' => $daoEndereco->insert('07852125', 'Praça Ademar da Rocha', 'Jardim Benintendi', 'Franco da Rocha'),
		'07852130' => $daoEndereco->insert('07852130', 'Rua Treze de Maio', 'Jardim Benintendi', 'Franco da Rocha'),
		'07849150' => $daoEndereco->insert('07849150', 'Rua Martin Afonso de Souza', 'Jardim Cedro do Líbano', 'Franco da Rocha'),
		'07849160' => $daoEndereco->insert('07849160', 'Rua Duarte da Costa', 'Jardim Cedro do Líbano', 'Franco da Rocha'),
		'07849170' => $daoEndereco->insert('07849170', 'Rua João Ramalho', 'Jardim Cedro do Líbano', 'Franco da Rocha'),
		'07849180' => $daoEndereco->insert('07849180', 'Rua Estácio de Sá', 'Jardim Cedro do Líbano', 'Franco da Rocha'),
		'07849185' => $daoEndereco->insert('07849185', 'Rua Mem de Sá', 'Jardim Cedro do Líbano', 'Franco da Rocha'),
		'07849186' => $daoEndereco->insert('07849186', 'Rua Nóbrega', 'Jardim Cedro do Líbano', 'Franco da Rocha'),
		'07804000' => $daoEndereco->insert('07804000', 'Rua Lázaro Roque', 'Jardim Cruzeiro', 'Franco da Rocha'),
		'07804010' => $daoEndereco->insert('07804010', 'Viela Onze', 'Jardim Cruzeiro', 'Franco da Rocha'),
		'07804030' => $daoEndereco->insert('07804030', 'Viela Nove', 'Jardim Cruzeiro', 'Franco da Rocha'),
		'07804040' => $daoEndereco->insert('07804040', 'Viela Oito', 'Jardim Cruzeiro', 'Franco da Rocha'),
		'07804050' => $daoEndereco->insert('07804050', 'Viela Sete', 'Jardim Cruzeiro', 'Franco da Rocha'),
		'07804060' => $daoEndereco->insert('07804060', 'Viela Dois', 'Jardim Cruzeiro', 'Franco da Rocha'),
		'07804070' => $daoEndereco->insert('07804070', 'Rua José Fernandes da Costa Torres', 'Jardim Cruzeiro', 'Franco da Rocha'),
		'07804080' => $daoEndereco->insert('07804080', 'Rua Hipólito Trigo Santiago', 'Jardim Cruzeiro', 'Franco da Rocha'),
		'07804090' => $daoEndereco->insert('07804090', 'Rua Conde Sarzedas', 'Jardim Cruzeiro', 'Franco da Rocha'),
		'07804110' => $daoEndereco->insert('07804110', 'Viela Seis', 'Jardim Cruzeiro', 'Franco da Rocha'),
		'07804120' => $daoEndereco->insert('07804120', 'Rua Bernardino Passos', 'Jardim Cruzeiro', 'Franco da Rocha'),
		'07804130' => $daoEndereco->insert('07804130', 'Rua das Figueiras', 'Jardim Cruzeiro', 'Franco da Rocha'),
		'07804140' => $daoEndereco->insert('07804140', 'Rua Heitor Rodrigues Santos', 'Jardim Cruzeiro', 'Franco da Rocha'),
		'07804150' => $daoEndereco->insert('07804150', 'Viela Três', 'Jardim Cruzeiro', 'Franco da Rocha'),
		'07804160' => $daoEndereco->insert('07804160', 'Rua Barão de Itapetininga', 'Jardim Cruzeiro', 'Franco da Rocha'),
		'07804170' => $daoEndereco->insert('07804170', 'Rua Fernando Gomes Sá', 'Jardim Cruzeiro', 'Franco da Rocha'),
		'07807180' => $daoEndereco->insert('07807180', 'Rua Ernesto Bueno de Moraes', 'Jardim Cruzeiro', 'Franco da Rocha'),
		'07807190' => $daoEndereco->insert('07807190', 'Rua Carlos de Campos', 'Jardim Cruzeiro', 'Franco da Rocha'),
		'07807200' => $daoEndereco->insert('07807200', 'Rua Delphihea Mendes Faria', 'Jardim Cruzeiro', 'Franco da Rocha'),
		'07851009' => $daoEndereco->insert('07851009', 'Rua Regente Feijó', 'Jardim Cruzeiro', 'Franco da Rocha'),
		'07857222' => $daoEndereco->insert('07857222', 'Rua Barão de Mauá', 'Jardim Cruzeiro', 'Franco da Rocha'),
		'07857230' => $daoEndereco->insert('07857230', 'Rua Trinta e Um de Março', 'Jardim Cruzeiro', 'Franco da Rocha'),
		'07811050' => $daoEndereco->insert('07811050', 'Avenida Primavera', 'Jardim das Colinas', 'Franco da Rocha'),
		'07811060' => $daoEndereco->insert('07811060', 'Estrada para Parnaíba', 'Jardim das Colinas', 'Franco da Rocha'),
		'07811070' => $daoEndereco->insert('07811070', 'Rua da Montanha', 'Jardim das Colinas', 'Franco da Rocha'),
		'07811080' => $daoEndereco->insert('07811080', 'Rua da Serra', 'Jardim das Colinas', 'Franco da Rocha'),
		'07811090' => $daoEndereco->insert('07811090', 'Rua das Àrvores', 'Jardim das Colinas', 'Franco da Rocha'),
		'07811100' => $daoEndereco->insert('07811100', 'Rua do Outono', 'Jardim das Colinas', 'Franco da Rocha'),
		'07811110' => $daoEndereco->insert('07811110', 'Rua do Topo', 'Jardim das Colinas', 'Franco da Rocha'),
		'07811120' => $daoEndereco->insert('07811120', 'Rua dos Picos', 'Jardim das Colinas', 'Franco da Rocha'),
		'07811130' => $daoEndereco->insert('07811130', 'Rua Ilha', 'Jardim das Colinas', 'Franco da Rocha'),
		'07811140' => $daoEndereco->insert('07811140', 'Rua Inverno', 'Jardim das Colinas', 'Franco da Rocha'),
		'07811150' => $daoEndereco->insert('07811150', 'Rua Verão', 'Jardim das Colinas', 'Franco da Rocha'),
		'07811160' => $daoEndereco->insert('07811160', 'Viela D', 'Jardim das Colinas', 'Franco da Rocha'),
		'07811170' => $daoEndereco->insert('07811170', 'Viela G', 'Jardim das Colinas', 'Franco da Rocha'),
		'07804180' => $daoEndereco->insert('07804180', 'Avenida das Pitangueiras', 'Jardim das Jabuticabeiras', 'Franco da Rocha'),
		'07804190' => $daoEndereco->insert('07804190', 'Rua dos Pessegueiros', 'Jardim das Jabuticabeiras', 'Franco da Rocha'),
		'07804200' => $daoEndereco->insert('07804200', 'Rua Saul Cardoso', 'Jardim das Jabuticabeiras', 'Franco da Rocha'),
		'07804205' => $daoEndereco->insert('07804205', 'Rua Luiz Gonzaga do Nascimento Junior', 'Jardim das Jabuticabeiras', 'Franco da Rocha'),
		'07804210' => $daoEndereco->insert('07804210', 'Rua Iracema Domingos Parada', 'Jardim das Jabuticabeiras', 'Franco da Rocha'),
		'07830050' => $daoEndereco->insert('07830050', 'Rua Venceslau Brás', 'Jardim dos Bandeirantes', 'Franco da Rocha'),
		'07830060' => $daoEndereco->insert('07830060', 'Rua Sezefredo Fagundes', 'Jardim dos Bandeirantes', 'Franco da Rocha'),
		'07830070' => $daoEndereco->insert('07830070', 'Rua José da Costa Cyrne', 'Jardim dos Bandeirantes', 'Franco da Rocha'),
		'07830080' => $daoEndereco->insert('07830080', 'Rua Petrônio Portela', 'Jardim dos Bandeirantes', 'Franco da Rocha'),
		'07830090' => $daoEndereco->insert('07830090', 'Rua Pedro Correa', 'Jardim dos Bandeirantes', 'Franco da Rocha'),
		'07830100' => $daoEndereco->insert('07830100', 'Rua Fanny Russiano', 'Jardim dos Bandeirantes', 'Franco da Rocha'),
		'07830110' => $daoEndereco->insert('07830110', 'Rua Auguste Conte', 'Jardim dos Bandeirantes', 'Franco da Rocha'),
		'07830120' => $daoEndereco->insert('07830120', 'Rua Arcângelo Russiano', 'Jardim dos Bandeirantes', 'Franco da Rocha'),
		'07830140' => $daoEndereco->insert('07830140', 'Rua Carlos Chagas', 'Jardim dos Bandeirantes', 'Franco da Rocha'),
		'07830150' => $daoEndereco->insert('07830150', 'Rua Maria Magalhães Rodrigues', 'Jardim dos Bandeirantes', 'Franco da Rocha'),
		'07830170' => $daoEndereco->insert('07830170', 'Rua Job Correa', 'Jardim dos Bandeirantes', 'Franco da Rocha'),
		'07830180' => $daoEndereco->insert('07830180', 'Rua Ângelo Misson', 'Jardim dos Bandeirantes', 'Franco da Rocha'),
		'07830190' => $daoEndereco->insert('07830190', 'Rua Ângelo Del Débbio', 'Jardim dos Bandeirantes', 'Franco da Rocha'),
		'07830200' => $daoEndereco->insert('07830200', 'Rua Onofre Rais', 'Jardim dos Bandeirantes', 'Franco da Rocha'),
		'07830210' => $daoEndereco->insert('07830210', 'Viela Cinco', 'Jardim dos Bandeirantes', 'Franco da Rocha'),
		'07830220' => $daoEndereco->insert('07830220', 'Rua Pedro Álvares Cabral', 'Jardim dos Bandeirantes', 'Franco da Rocha'),
		'07830230' => $daoEndereco->insert('07830230', 'Viela Quatro', 'Jardim dos Bandeirantes', 'Franco da Rocha'),
		'07830240' => $daoEndereco->insert('07830240', 'Rua Horácio Guassiari', 'Jardim dos Bandeirantes', 'Franco da Rocha'),
		'07830250' => $daoEndereco->insert('07830250', 'Viela Três', 'Jardim dos Bandeirantes', 'Franco da Rocha'),
		'07830270' => $daoEndereco->insert('07830270', 'Rua João Reis', 'Jardim dos Bandeirantes', 'Franco da Rocha'),
		'07830280' => $daoEndereco->insert('07830280', 'Rua Emílio Carlos', 'Jardim dos Bandeirantes', 'Franco da Rocha'),
		'07830290' => $daoEndereco->insert('07830290', 'Viela Dois', 'Jardim dos Bandeirantes', 'Franco da Rocha'),
		'07830300' => $daoEndereco->insert('07830300', 'Rua Domingos de Toledo', 'Jardim dos Bandeirantes', 'Franco da Rocha'),
		'07830310' => $daoEndereco->insert('07830310', 'Estrada Municipal de Porretes', 'Jardim dos Bandeirantes', 'Franco da Rocha'),
		'07830320' => $daoEndereco->insert('07830320', 'Rua Benedito Alonso', 'Jardim dos Bandeirantes', 'Franco da Rocha'),
		'07830500' => $daoEndereco->insert('07830500', 'Estrada Marcelo A. de J. Pinto', 'Jardim dos Lagos', 'Franco da Rocha'),
		'07830520' => $daoEndereco->insert('07830520', 'Rua das Acácias', 'Jardim dos Lagos', 'Franco da Rocha'),
		'07830521' => $daoEndereco->insert('07830521', 'Rua das Alamandas', 'Jardim dos Lagos', 'Franco da Rocha'),
		'07830522' => $daoEndereco->insert('07830522', 'Rua das Azaléas', 'Jardim dos Lagos', 'Franco da Rocha'),
		'07830523' => $daoEndereco->insert('07830523', 'Rua das Campanulas', 'Jardim dos Lagos', 'Franco da Rocha'),
		'07830524' => $daoEndereco->insert('07830524', 'Rua das Cravinas', 'Jardim dos Lagos', 'Franco da Rocha'),
		'07830525' => $daoEndereco->insert('07830525', 'Rua das Gencianas', 'Jardim dos Lagos', 'Franco da Rocha'),
		'07830526' => $daoEndereco->insert('07830526', 'Rua das Mimosas', 'Jardim dos Lagos', 'Franco da Rocha'),
		'07830527' => $daoEndereco->insert('07830527', 'Rua das Rosas', 'Jardim dos Lagos', 'Franco da Rocha'),
		'07830528' => $daoEndereco->insert('07830528', 'Rua das Taboas', 'Jardim dos Lagos', 'Franco da Rocha'),
		'07830529' => $daoEndereco->insert('07830529', 'Rua dos Aguapés', 'Jardim dos Lagos', 'Franco da Rocha'),
		'07830530' => $daoEndereco->insert('07830530', 'Rua dos Cravos', 'Jardim dos Lagos', 'Franco da Rocha'),
		'07830531' => $daoEndereco->insert('07830531', 'Rua dos Gerânios', 'Jardim dos Lagos', 'Franco da Rocha'),
		'07830532' => $daoEndereco->insert('07830532', 'Rua dos Gladiolos', 'Jardim dos Lagos', 'Franco da Rocha'),
		'07830533' => $daoEndereco->insert('07830533', 'Rua dos Goivos', 'Jardim dos Lagos', 'Franco da Rocha'),
		'07830534' => $daoEndereco->insert('07830534', 'Rua dos Ibiscos', 'Jardim dos Lagos', 'Franco da Rocha'),
		'07830535' => $daoEndereco->insert('07830535', 'Rua dos Ipês', 'Jardim dos Lagos', 'Franco da Rocha'),
		'07830536' => $daoEndereco->insert('07830536', 'Rua dos Jasmins', 'Jardim dos Lagos', 'Franco da Rocha'),
		'07830537' => $daoEndereco->insert('07830537', 'Rua dos Lírios', 'Jardim dos Lagos', 'Franco da Rocha'),
		'07830538' => $daoEndereco->insert('07830538', 'Rua dos Miosotis', 'Jardim dos Lagos', 'Franco da Rocha'),
		'07830539' => $daoEndereco->insert('07830539', 'Rua dos Narcisos', 'Jardim dos Lagos', 'Franco da Rocha'),
		'07830540' => $daoEndereco->insert('07830540', 'Rua Doutor Mário Toledo de Moraes', 'Jardim dos Lagos', 'Franco da Rocha'),
		'07844350' => $daoEndereco->insert('07844350', 'Rua Barretos', 'Jardim dos Reis', 'Franco da Rocha'),
		'07845000' => $daoEndereco->insert('07845000', 'Avenida São Paulo', 'Jardim dos Reis', 'Franco da Rocha'),
		'07845010' => $daoEndereco->insert('07845010', 'Rua Dário', 'Jardim dos Reis', 'Franco da Rocha'),
		'07845020' => $daoEndereco->insert('07845020', 'Rua Péricles', 'Jardim dos Reis', 'Franco da Rocha'),
		'07845030' => $daoEndereco->insert('07845030', 'Praça Ticiano', 'Jardim dos Reis', 'Franco da Rocha'),
		'07845040' => $daoEndereco->insert('07845040', 'Rua Luiz XIV', 'Jardim dos Reis', 'Franco da Rocha'),
		'07845050' => $daoEndereco->insert('07845050', 'Rua Elizabeth II', 'Jardim dos Reis', 'Franco da Rocha'),
		'07845060' => $daoEndereco->insert('07845060', 'Rua Carlos Magno', 'Jardim dos Reis', 'Franco da Rocha'),
		'07845070' => $daoEndereco->insert('07845070', 'Rua Felipe II', 'Jardim dos Reis', 'Franco da Rocha'),
		'07845080' => $daoEndereco->insert('07845080', 'Rua Henrique VIII', 'Jardim dos Reis', 'Franco da Rocha'),
		'07845085' => $daoEndereco->insert('07845085', 'Rua Dom Sebastião', 'Jardim dos Reis', 'Franco da Rocha'),
		'07845090' => $daoEndereco->insert('07845090', 'Rua Alexandre Magno', 'Jardim dos Reis', 'Franco da Rocha'),
		'07845100' => $daoEndereco->insert('07845100', 'Rua Francisco José', 'Jardim dos Reis', 'Franco da Rocha'),
		'07845110' => $daoEndereco->insert('07845110', 'Rua Napoleão Bonaparte', 'Jardim dos Reis', 'Franco da Rocha'),
		'07845120' => $daoEndereco->insert('07845120', 'Rua Maria Antonieta', 'Jardim dos Reis', 'Franco da Rocha'),
		'07845130' => $daoEndereco->insert('07845130', 'Rua Tibério', 'Jardim dos Reis', 'Franco da Rocha'),
		'07845140' => $daoEndereco->insert('07845140', 'Rua Bartolomeu Bueno da Silva', 'Jardim dos Reis', 'Franco da Rocha'),
		'07810130' => $daoEndereco->insert('07810130', 'Rua Beatriz Savazoni', 'Jardim Luciana', 'Franco da Rocha'),
		'07810140' => $daoEndereco->insert('07810140', 'Rua Carolina Zanela', 'Jardim Luciana', 'Franco da Rocha'),
		'07810150' => $daoEndereco->insert('07810150', 'Rua Domingos Antonio Lopes', 'Jardim Luciana', 'Franco da Rocha'),
		'07810160' => $daoEndereco->insert('07810160', 'Rua Edgard Máximo Zamboto', 'Jardim Luciana', 'Franco da Rocha'),
		'07810170' => $daoEndereco->insert('07810170', 'Rua Horácio Antônio Silveira', 'Jardim Luciana', 'Franco da Rocha'),
		'07810180' => $daoEndereco->insert('07810180', 'Rua Lázaro Vaz de Coes', 'Jardim Luciana', 'Franco da Rocha'),
		'07810200' => $daoEndereco->insert('07810200', 'Rua Municipal dos Abreus', 'Jardim Luciana', 'Franco da Rocha'),
		'07810220' => $daoEndereco->insert('07810220', 'Rua dos Limoeiros', 'Jardim Luciana', 'Franco da Rocha'),
		'07810230' => $daoEndereco->insert('07810230', 'Rua João de Oliveira Couto', 'Jardim Luciana', 'Franco da Rocha'),
		'07810260' => $daoEndereco->insert('07810260', 'Rua Joaquim Cerca', 'Jardim Luciana', 'Franco da Rocha'),
		'07810280' => $daoEndereco->insert('07810280', 'Rua Aparecida Incau', 'Jardim Luciana', 'Franco da Rocha'),
		'07810290' => $daoEndereco->insert('07810290', 'Rua José Barbosa', 'Jardim Luciana', 'Franco da Rocha'),
		'07810310' => $daoEndereco->insert('07810310', 'Rua Konrad Adenauer', 'Jardim Luciana', 'Franco da Rocha'),
		'07810320' => $daoEndereco->insert('07810320', 'Rua Luiz Maggi', 'Jardim Luciana', 'Franco da Rocha'),
		'07810340' => $daoEndereco->insert('07810340', 'Rua Luiz Rocha', 'Jardim Luciana', 'Franco da Rocha'),
		'07810350' => $daoEndereco->insert('07810350', 'Rua Marcílio de Oliveira Couto', 'Jardim Luciana', 'Franco da Rocha'),
		'07810360' => $daoEndereco->insert('07810360', 'Rua Narciso Grandi', 'Jardim Luciana', 'Franco da Rocha'),
		'07810370' => $daoEndereco->insert('07810370', 'Rua Olindo Dartora', 'Jardim Luciana', 'Franco da Rocha'),
		'07810410' => $daoEndereco->insert('07810410', 'Rua Júlio Prestes', 'Jardim Luciana', 'Franco da Rocha'),
		'07810420' => $daoEndereco->insert('07810420', 'Rua José de Barros', 'Jardim Luciana', 'Franco da Rocha'),
		'07865210' => $daoEndereco->insert('07865210', 'Avenida Alfredo de Paula', 'Jardim Luiza', 'Franco da Rocha'),
		'07865215' => $daoEndereco->insert('07865215', 'Rua Amauri Lázaro de Almeida', 'Jardim Luiza', 'Franco da Rocha'),
		'07865220' => $daoEndereco->insert('07865220', 'Rua Benedito Fontana', 'Jardim Luiza', 'Franco da Rocha'),
		'07865230' => $daoEndereco->insert('07865230', 'Rua Sebastião Cruz', 'Jardim Luiza', 'Franco da Rocha'),
		'07865240' => $daoEndereco->insert('07865240', 'Rua Antônio Cavalheiro', 'Jardim Luiza', 'Franco da Rocha'),
		'07865250' => $daoEndereco->insert('07865250', 'Rua Ataíde Rocha Prado', 'Jardim Luiza', 'Franco da Rocha'),
		'07865260' => $daoEndereco->insert('07865260', 'Rua Antonio Benedito dos Santos Silva', 'Jardim Luiza', 'Franco da Rocha'),
		'07865270' => $daoEndereco->insert('07865270', 'Rua Pedro da Silva', 'Jardim Luiza', 'Franco da Rocha'),
		'07852070' => $daoEndereco->insert('07852070', 'Rua Stefan Zweig', 'Jardim Progresso', 'Franco da Rocha'),
		'07852080' => $daoEndereco->insert('07852080', 'Rua Boccaccio', 'Jardim Progresso', 'Franco da Rocha'),
		'07852090' => $daoEndereco->insert('07852090', 'Rua Doze de Outubro', 'Jardim Progresso', 'Franco da Rocha'),
		'07852150' => $daoEndereco->insert('07852150', 'Rua Virgílio', 'Jardim Progresso', 'Franco da Rocha'),
		'07852160' => $daoEndereco->insert('07852160', 'Rua Cervantes', 'Jardim Progresso', 'Franco da Rocha'),
		'07852163' => $daoEndereco->insert('07852163', 'Rua José Oliveira dos Santos', 'Jardim Progresso', 'Franco da Rocha'),
		'07852170' => $daoEndereco->insert('07852170', 'Avenida Washington Luiz', 'Jardim Progresso', 'Franco da Rocha'),
		'07852175' => $daoEndereco->insert('07852175', 'Rua Manoel Pereira Santana', 'Jardim Progresso', 'Franco da Rocha'),
		'07852180' => $daoEndereco->insert('07852180', 'Rua Ariosto', 'Jardim Progresso', 'Franco da Rocha'),
		'07852220' => $daoEndereco->insert('07852220', 'Rua Doutor Octávio Martins e Toledo', 'Jardim Progresso', 'Franco da Rocha'),
		'07852230' => $daoEndereco->insert('07852230', 'Rua Charles Dickens', 'Jardim Progresso', 'Franco da Rocha'),
		'07853000' => $daoEndereco->insert('07853000', 'Rua Homero', 'Jardim Progresso', 'Franco da Rocha'),
		'07853010' => $daoEndereco->insert('07853010', 'Rua José César de Azevedo Soares', 'Jardim Progresso', 'Franco da Rocha'),
		'07853030' => $daoEndereco->insert('07853030', 'Avenida da Saudade', 'Jardim Progresso', 'Franco da Rocha'),
		'07853040' => $daoEndereco->insert('07853040', 'Rua Isaac Newton', 'Jardim Progresso', 'Franco da Rocha'),
		'07853050' => $daoEndereco->insert('07853050', 'Rua Rousseau', 'Jardim Progresso', 'Franco da Rocha'),
		'07853055' => $daoEndereco->insert('07853055', 'Rua Albert Einstein', 'Jardim Progresso', 'Franco da Rocha'),
		'07853060' => $daoEndereco->insert('07853060', 'Rua Alexandre Dumas', 'Jardim Progresso', 'Franco da Rocha'),
		'07853070' => $daoEndereco->insert('07853070', 'Rua Salomão', 'Jardim Progresso', 'Franco da Rocha'),
		'07853080' => $daoEndereco->insert('07853080', 'Rua David', 'Jardim Progresso', 'Franco da Rocha'),
		'07853090' => $daoEndereco->insert('07853090', 'Rua Aloísio de Azevedo', 'Jardim Progresso', 'Franco da Rocha'),
		'07853100' => $daoEndereco->insert('07853100', 'Rua Gabriela Mistral', 'Jardim Progresso', 'Franco da Rocha'),
		'07853101' => $daoEndereco->insert('07853101', 'Rua René Descartes', 'Jardim Progresso', 'Franco da Rocha'),
		'07853105' => $daoEndereco->insert('07853105', 'Travessa Rui Barbosa', 'Jardim Progresso', 'Franco da Rocha'),
		'07853109' => $daoEndereco->insert('07853109', 'Rua Machado de Assis', 'Jardim Progresso', 'Franco da Rocha'),
		'07853120' => $daoEndereco->insert('07853120', 'Rua Platão', 'Jardim Progresso', 'Franco da Rocha'),
		'07853140' => $daoEndereco->insert('07853140', 'Rua Atílio', 'Jardim Progresso', 'Franco da Rocha'),
		'07853170' => $daoEndereco->insert('07853170', 'Rua Alcones', 'Jardim Progresso', 'Franco da Rocha'),
		'07853180' => $daoEndereco->insert('07853180', 'Rua Adolfo Bloch', 'Jardim Progresso', 'Franco da Rocha'),
		'07860000' => $daoEndereco->insert('07860000', 'Avenida Sete de Setembro', 'Jardim Progresso', 'Franco da Rocha'),
		'07860010' => $daoEndereco->insert('07860010', 'Rua Terra Roxa', 'Jardim Progresso', 'Franco da Rocha'),
		'07860020' => $daoEndereco->insert('07860020', 'Rua Ícaro', 'Jardim Progresso', 'Franco da Rocha'),
		'07860050' => $daoEndereco->insert('07860050', 'Rua Humberto de Campos', 'Jardim Progresso', 'Franco da Rocha'),
		'07860060' => $daoEndereco->insert('07860060', 'Rua Monteiro Lobato', 'Jardim Progresso', 'Franco da Rocha'),
		'07860065' => $daoEndereco->insert('07860065', 'Rua Augusto dos Anjos', 'Jardim Progresso', 'Franco da Rocha'),
		'07860070' => $daoEndereco->insert('07860070', 'Viela Um A', 'Jardim Progresso', 'Franco da Rocha'),
		'07860080' => $daoEndereco->insert('07860080', 'Rua Eça de Queiroz', 'Jardim Progresso', 'Franco da Rocha'),
		'07860090' => $daoEndereco->insert('07860090', 'Rua Afonso de Carvalho', 'Jardim Progresso', 'Franco da Rocha'),
		'07860100' => $daoEndereco->insert('07860100', 'Rua Visconde de Taunay', 'Jardim Progresso', 'Franco da Rocha'),
		'07860110' => $daoEndereco->insert('07860110', 'Rua Camilo Castelo Branco', 'Jardim Progresso', 'Franco da Rocha'),
		'07860111' => $daoEndereco->insert('07860111', 'Passagem Particular', 'Jardim Progresso', 'Franco da Rocha'),
		'07860120' => $daoEndereco->insert('07860120', 'Rua Voltaire', 'Jardim Progresso', 'Franco da Rocha'),
		'07860130' => $daoEndereco->insert('07860130', 'Rua Maquiavel', 'Jardim Progresso', 'Franco da Rocha'),
		'07860140' => $daoEndereco->insert('07860140', 'Rua Vítor Hugo', 'Jardim Progresso', 'Franco da Rocha'),
		'07860145' => $daoEndereco->insert('07860145', 'Viela José Aparecido da Cunha', 'Jardim Progresso', 'Franco da Rocha'),
		'07860150' => $daoEndereco->insert('07860150', 'Viela B', 'Jardim Progresso', 'Franco da Rocha'),
		'07860160' => $daoEndereco->insert('07860160', 'Rua Guimarães Rosa', 'Jardim Progresso', 'Franco da Rocha'),
		'07860170' => $daoEndereco->insert('07860170', 'Rua Honore de Balzac', 'Jardim Progresso', 'Franco da Rocha'),
		'07860220' => $daoEndereco->insert('07860220', 'Rua Máximo Gorki', 'Jardim Progresso', 'Franco da Rocha'),
		'07860230' => $daoEndereco->insert('07860230', 'Rua Luiz Delfino', 'Jardim Progresso', 'Franco da Rocha'),
		'07860240' => $daoEndereco->insert('07860240', 'Rua Edgard Alan Poe', 'Jardim Progresso', 'Franco da Rocha'),
		'07860250' => $daoEndereco->insert('07860250', 'Rua Servidão', 'Jardim Progresso', 'Franco da Rocha'),
		'07860260' => $daoEndereco->insert('07860260', 'Rua Osvald de Andrade', 'Jardim Progresso', 'Franco da Rocha'),
		'07860270' => $daoEndereco->insert('07860270', 'Viela Um', 'Jardim Progresso', 'Franco da Rocha'),
		'07860300' => $daoEndereco->insert('07860300', 'Rua Júlio Verne', 'Jardim Progresso', 'Franco da Rocha'),
		'07860310' => $daoEndereco->insert('07860310', 'Rua Tolstoi', 'Jardim Progresso', 'Franco da Rocha'),
		'07860410' => $daoEndereco->insert('07860410', 'Rua Belmont', 'Jardim Progresso', 'Franco da Rocha'),
		'07840170' => $daoEndereco->insert('07840170', 'Rua Cotia', 'Jardim Santa Filomena', 'Franco da Rocha'),
		'07840180' => $daoEndereco->insert('07840180', 'Rua Carapicuíba', 'Jardim Santa Filomena', 'Franco da Rocha'),
		'07840190' => $daoEndereco->insert('07840190', 'Rua Érica', 'Jardim Santa Filomena', 'Franco da Rocha'),
		'07840220' => $daoEndereco->insert('07840220', 'Avenida Jaci', 'Jardim Santa Filomena', 'Franco da Rocha'),
		'07840225' => $daoEndereco->insert('07840225', 'Viela Silva', 'Jardim Santa Filomena', 'Franco da Rocha'),
		'07840230' => $daoEndereco->insert('07840230', 'Rua Ribeirão Pires', 'Jardim Santa Filomena', 'Franco da Rocha'),
		'07840240' => $daoEndereco->insert('07840240', 'Rua Poá', 'Jardim Santa Filomena', 'Franco da Rocha'),
		'07863430' => $daoEndereco->insert('07863430', 'Rua Alberto Dias de Carvalho', 'Jardim Sinki', 'Franco da Rocha'),
		'07863440' => $daoEndereco->insert('07863440', 'Rua Amélia Lirussi', 'Jardim Sinki', 'Franco da Rocha'),
		'07863450' => $daoEndereco->insert('07863450', 'Rua Brasília Vieira', 'Jardim Sinki', 'Franco da Rocha'),
		'07863460' => $daoEndereco->insert('07863460', 'Rua Egídia Maria de Jesus', 'Jardim Sinki', 'Franco da Rocha'),
		'07863470' => $daoEndereco->insert('07863470', 'Rua Félix Vieira', 'Jardim Sinki', 'Franco da Rocha'),
		'07863480' => $daoEndereco->insert('07863480', 'Rua Godofredo dos santos', 'Jardim Sinki', 'Franco da Rocha'),
		'07863490' => $daoEndereco->insert('07863490', 'Rua José Faria', 'Jardim Sinki', 'Franco da Rocha'),
		'07863495' => $daoEndereco->insert('07863495', 'Estrada Caciricay', 'Jardim Sinki', 'Franco da Rocha'),
		'07863500' => $daoEndereco->insert('07863500', 'Rua Rafael Capacce', 'Jardim Sinki', 'Franco da Rocha'),
		'07840010' => $daoEndereco->insert('07840010', 'Rua Gilda', 'Jardim União', 'Franco da Rocha'),
		'07840120' => $daoEndereco->insert('07840120', 'Rua Acácia', 'Jardim União', 'Franco da Rocha'),
		'07840125' => $daoEndereco->insert('07840125', 'Avenida Ceci', 'Jardim União', 'Franco da Rocha'),
		'07840130' => $daoEndereco->insert('07840130', 'Rua Corina', 'Jardim União', 'Franco da Rocha'),
		'07840135' => $daoEndereco->insert('07840135', 'Avenida Diadema', 'Jardim União', 'Franco da Rocha'),
		'07840140' => $daoEndereco->insert('07840140', 'Rua Brasília', 'Jardim União', 'Franco da Rocha'),
		'07840145' => $daoEndereco->insert('07840145', 'Avenida José Alves Cerqueira César', 'Jardim União', 'Franco da Rocha'),
		'07840150' => $daoEndereco->insert('07840150', 'Rua Aurora', 'Jardim União', 'Franco da Rocha'),
		'07840155' => $daoEndereco->insert('07840155', 'Rua Noemi', 'Jardim União', 'Franco da Rocha'),
		'07840156' => $daoEndereco->insert('07840156', 'Rua Plácida', 'Jardim União', 'Franco da Rocha'),
		'07840160' => $daoEndereco->insert('07840160', 'Rua Diana', 'Jardim União', 'Franco da Rocha'),
		'07840250' => $daoEndereco->insert('07840250', 'Rua Mônica', 'Jardim União', 'Franco da Rocha'),
		'07840260' => $daoEndereco->insert('07840260', 'Rua Letícia', 'Jardim União', 'Franco da Rocha'),
		'07840270' => $daoEndereco->insert('07840270', 'Viela O', 'Jardim União', 'Franco da Rocha'),
		'07840280' => $daoEndereco->insert('07840280', 'Avenida Aparecida Rodrigues Silva', 'Jardim União', 'Franco da Rocha'),
		'07842210' => $daoEndereco->insert('07842210', 'Viela M', 'Jardim União', 'Franco da Rocha'),
		'07842240' => $daoEndereco->insert('07842240', 'Viela T', 'Jardim União', 'Franco da Rocha'),
		'07842260' => $daoEndereco->insert('07842260', 'Viela V', 'Jardim União', 'Franco da Rocha'),
		'07867000' => $daoEndereco->insert('07867000', 'Avenida Antonio Amaro Ortiz', 'Lago Azul Ortiz', 'Franco da Rocha'),
		'07867010' => $daoEndereco->insert('07867010', 'Rua da Divisa', 'Lago Azul Ortiz', 'Franco da Rocha'),
		'07867020' => $daoEndereco->insert('07867020', 'Rua Benedita Amorim Tavares', 'Lago Azul Ortiz', 'Franco da Rocha'),
		'07867030' => $daoEndereco->insert('07867030', 'Rua Aparecida Maria da Conceição', 'Lago Azul Ortiz', 'Franco da Rocha'),
		'07867035' => $daoEndereco->insert('07867035', 'Rua Nova Esperança', 'Lago Azul Ortiz', 'Franco da Rocha'),
		'07867040' => $daoEndereco->insert('07867040', 'Rua da Olaria', 'Lago Azul Ortiz', 'Franco da Rocha'),
		'07867050' => $daoEndereco->insert('07867050', 'Viela Adão Nogueira', 'Lago Azul Ortiz', 'Franco da Rocha'),
		'07867060' => $daoEndereco->insert('07867060', 'Rua Joaquim Cardoso de Oliveira', 'Lago Azul Ortiz', 'Franco da Rocha'),
		'07867065' => $daoEndereco->insert('07867065', 'Viela Ortiz', 'Lago Azul Ortiz', 'Franco da Rocha'),
		'07867070' => $daoEndereco->insert('07867070', 'Rua Isabel Ortiz', 'Lago Azul Ortiz', 'Franco da Rocha'),
		'07867080' => $daoEndereco->insert('07867080', 'Rua Clemente Tavares', 'Lago Azul Ortiz', 'Franco da Rocha'),
		'07867090' => $daoEndereco->insert('07867090', 'Avenida Primavera', 'Lago Azul Ortiz', 'Franco da Rocha'),
		'07832000' => $daoEndereco->insert('07832000', 'Estrada de Belém', 'Parque dos Eucaliptos', 'Franco da Rocha'),
		'07832010' => $daoEndereco->insert('07832010', 'Rua Marcondes Salgado', 'Parque dos Eucaliptos', 'Franco da Rocha'),
		'07832020' => $daoEndereco->insert('07832020', 'Rua Arnaldo Guassieri', 'Parque dos Eucaliptos', 'Franco da Rocha'),
		'07832030' => $daoEndereco->insert('07832030', 'Rua Luiz Maganini', 'Parque dos Eucaliptos', 'Franco da Rocha'),
		'07832040' => $daoEndereco->insert('07832040', 'Rua Orázio Stanco', 'Parque dos Eucaliptos', 'Franco da Rocha'),
		'07832050' => $daoEndereco->insert('07832050', 'Rua Jordão Alves Gouveia', 'Parque dos Eucaliptos', 'Franco da Rocha'),
		'07832060' => $daoEndereco->insert('07832060', 'Rua Antonio de Oliveira Cunha', 'Parque dos Eucaliptos', 'Franco da Rocha'),
		'07832070' => $daoEndereco->insert('07832070', 'Rua Olídio Viola', 'Parque dos Eucaliptos', 'Franco da Rocha'),
		'07859341' => $daoEndereco->insert('07859341', 'Rua José Fabrelli', 'Parque Industrial', 'Franco da Rocha'),
		'07859350' => $daoEndereco->insert('07859350', 'Rua Augusto Rosa', 'Parque Industrial', 'Franco da Rocha'),
		'07859360' => $daoEndereco->insert('07859360', 'Rua Gonçalo Luiz de Oliveira', 'Parque Industrial', 'Franco da Rocha'),
		'07859370' => $daoEndereco->insert('07859370', 'Rua Jorge Rodrigues de Oliveira', 'Parque Industrial', 'Franco da Rocha'),
		'07859380' => $daoEndereco->insert('07859380', 'Rua Marcus Vinícius Donadel Góes', 'Parque Industrial', 'Franco da Rocha'),
		'07859390' => $daoEndereco->insert('07859390', 'Rua Miguel Segundo Lerussi', 'Parque Industrial', 'Franco da Rocha'),
		'07859400' => $daoEndereco->insert('07859400', 'Rua Yolanda da Silva Azevedo', 'Parque Industrial', 'Franco da Rocha'),
		'07859903' => $daoEndereco->insert('07859903', 'Rua Marcus Vinícius Donadel Góes, s/n', 'Parque Industrial', 'Franco da Rocha'),
		'07859904' => $daoEndereco->insert('07859904', 'Rua Marcus Vinícius Donadel Góes, s/n', 'Parque Industrial', 'Franco da Rocha'),
		'07860180' => $daoEndereco->insert('07860180', 'Avenida Lanel', 'Parque Lanel', 'Franco da Rocha'),
		'07860190' => $daoEndereco->insert('07860190', 'Viela F', 'Parque Lanel', 'Franco da Rocha'),
		'07860195' => $daoEndereco->insert('07860195', 'Rua Henrique Delfino', 'Parque Lanel', 'Franco da Rocha'),
		'07860200' => $daoEndereco->insert('07860200', 'Rua Alexandre Herculano', 'Parque Lanel', 'Franco da Rocha'),
		'07860205' => $daoEndereco->insert('07860205', 'Rua Moisés', 'Parque Lanel', 'Franco da Rocha'),
		'07860206' => $daoEndereco->insert('07860206', 'Rua Naun', 'Parque Lanel', 'Franco da Rocha'),
		'07860210' => $daoEndereco->insert('07860210', 'Rua Henrique', 'Parque Lanel', 'Franco da Rocha'),
		'07860340' => $daoEndereco->insert('07860340', 'Rua Kacilda', 'Parque Lanel', 'Franco da Rocha'),
		'07860345' => $daoEndereco->insert('07860345', 'Rua Isaac', 'Parque Lanel', 'Franco da Rocha'),
		'07860350' => $daoEndereco->insert('07860350', 'Rua Bernardo', 'Parque Lanel', 'Franco da Rocha'),
		'07860360' => $daoEndereco->insert('07860360', 'Rua Leon', 'Parque Lanel', 'Franco da Rocha'),
		'07860400' => $daoEndereco->insert('07860400', 'Rua José de Alencar', 'Parque Lanel', 'Franco da Rocha'),
		'07862000' => $daoEndereco->insert('07862000', 'Rua Ana Sierra Diniz', 'Parque Monte Verde', 'Franco da Rocha'),
		'07862010' => $daoEndereco->insert('07862010', 'Rua Benedita Martins Cardoso', 'Parque Monte Verde', 'Franco da Rocha'),
		'07862020' => $daoEndereco->insert('07862020', 'Rua Emile Zola', 'Parque Monte Verde', 'Franco da Rocha'),
		'07862030' => $daoEndereco->insert('07862030', 'Viela Três', 'Parque Monte Verde', 'Franco da Rocha'),
		'07862040' => $daoEndereco->insert('07862040', 'Viela Dois', 'Parque Monte Verde', 'Franco da Rocha'),
		'07862050' => $daoEndereco->insert('07862050', 'Rua Willian Harvey', 'Parque Monte Verde', 'Franco da Rocha'),
		'07862060' => $daoEndereco->insert('07862060', 'Rua Hebert George Wells', 'Parque Monte Verde', 'Franco da Rocha'),
		'07862070' => $daoEndereco->insert('07862070', 'Rua Fernando Luiz da Silva', 'Parque Monte Verde', 'Franco da Rocha'),
		'07862080' => $daoEndereco->insert('07862080', 'Rua Amália Taramelli Corsi', 'Parque Monte Verde', 'Franco da Rocha'),
		'07862090' => $daoEndereco->insert('07862090', 'Rua Francisca Félix da Silva', 'Parque Monte Verde', 'Franco da Rocha'),
		'07862100' => $daoEndereco->insert('07862100', 'Rua Pedro Vaz Nunes', 'Parque Monte Verde', 'Franco da Rocha'),
		'07862110' => $daoEndereco->insert('07862110', 'Rua Américo Misson', 'Parque Monte Verde', 'Franco da Rocha'),
		'07862160' => $daoEndereco->insert('07862160', 'Rua Alberto Misson', 'Parque Monte Verde', 'Franco da Rocha'),
		'07862170' => $daoEndereco->insert('07862170', 'Rua Manoel Pereira Sobrinho', 'Parque Monte Verde', 'Franco da Rocha'),
		'07862180' => $daoEndereco->insert('07862180', 'Rua Aparício Bueno', 'Parque Monte Verde', 'Franco da Rocha'),
		'07862190' => $daoEndereco->insert('07862190', 'Rua Pedro Ortiz de Camargo', 'Parque Monte Verde', 'Franco da Rocha'),
		'07862200' => $daoEndereco->insert('07862200', 'Rua João Tinelo', 'Parque Monte Verde', 'Franco da Rocha'),
		'07862210' => $daoEndereco->insert('07862210', 'Rua Armando Faria', 'Parque Monte Verde', 'Franco da Rocha'),
		'07862220' => $daoEndereco->insert('07862220', 'Rua Maria José Misson', 'Parque Monte Verde', 'Franco da Rocha'),
		'07862230' => $daoEndereco->insert('07862230', 'Rua Alberto Zonaro', 'Parque Monte Verde', 'Franco da Rocha'),
		'07863750' => $daoEndereco->insert('07863750', 'Rua Pedro Rais', 'Parque Monte Verde Novo', 'Franco da Rocha'),
		'07863760' => $daoEndereco->insert('07863760', 'Rua Affonso Carlos Prado', 'Parque Monte Verde Novo', 'Franco da Rocha'),
		'07863770' => $daoEndereco->insert('07863770', 'Rua Doutor Wanderley Aparecido', 'Parque Monte Verde Novo', 'Franco da Rocha'),
		'07835000' => $daoEndereco->insert('07835000', 'Rua Canadá', 'Parque Montreal', 'Franco da Rocha'),
		'07835005' => $daoEndereco->insert('07835005', 'Rua Um', 'Parque Montreal', 'Franco da Rocha'),
		'07835010' => $daoEndereco->insert('07835010', 'Rua Terra Nova', 'Parque Montreal', 'Franco da Rocha'),
		'07835015' => $daoEndereco->insert('07835015', 'Rua Nossa Senhora dos Prazeres', 'Parque Montreal', 'Franco da Rocha'),
		'07835020' => $daoEndereco->insert('07835020', 'Rua Toronto', 'Parque Montreal', 'Franco da Rocha'),
		'07835025' => $daoEndereco->insert('07835025', 'Rua Conquista', 'Parque Montreal', 'Franco da Rocha'),
		'07835030' => $daoEndereco->insert('07835030', 'Rua Quebec', 'Parque Montreal', 'Franco da Rocha'),
		'07835035' => $daoEndereco->insert('07835035', 'Rua Campina Grande', 'Parque Montreal', 'Franco da Rocha'),
		'07835040' => $daoEndereco->insert('07835040', 'Rua Ottawa', 'Parque Montreal', 'Franco da Rocha'),
		'07835050' => $daoEndereco->insert('07835050', 'Avenida Montreal', 'Parque Montreal', 'Franco da Rocha'),
		'07835060' => $daoEndereco->insert('07835060', 'Avenida Colúmbia', 'Parque Montreal', 'Franco da Rocha'),
		'07835070' => $daoEndereco->insert('07835070', 'Rua São Lourenço', 'Parque Montreal', 'Franco da Rocha'),
		'07835080' => $daoEndereco->insert('07835080', 'Rua Hudson', 'Parque Montreal', 'Franco da Rocha'),
		'07835090' => $daoEndereco->insert('07835090', 'Rua Manitoba', 'Parque Montreal', 'Franco da Rocha'),
		'07835100' => $daoEndereco->insert('07835100', 'Rua Windsor', 'Parque Montreal', 'Franco da Rocha'),
		'07835110' => $daoEndereco->insert('07835110', 'Rua Vitória', 'Parque Montreal', 'Franco da Rocha'),
		'07835120' => $daoEndereco->insert('07835120', 'Rua Alberta', 'Parque Montreal', 'Franco da Rocha'),
		'07835130' => $daoEndereco->insert('07835130', 'Estrada Municipal', 'Parque Montreal', 'Franco da Rocha'),
		'07835140' => $daoEndereco->insert('07835140', 'Estrada Regina', 'Parque Montreal', 'Franco da Rocha'),
		'07835155' => $daoEndereco->insert('07835155', 'Viela Dois', 'Parque Montreal', 'Franco da Rocha'),
		'07835160' => $daoEndereco->insert('07835160', 'Viela Três', 'Parque Montreal', 'Franco da Rocha'),
		'07835165' => $daoEndereco->insert('07835165', 'Viela Quatro', 'Parque Montreal', 'Franco da Rocha'),
		'07835170' => $daoEndereco->insert('07835170', 'Viela Cinco', 'Parque Montreal', 'Franco da Rocha'),
		'07835175' => $daoEndereco->insert('07835175', 'Viela Seis', 'Parque Montreal', 'Franco da Rocha'),
		'07835180' => $daoEndereco->insert('07835180', 'Viela Sete', 'Parque Montreal', 'Franco da Rocha'),
		'07835185' => $daoEndereco->insert('07835185', 'Viela Quatorze', 'Parque Montreal', 'Franco da Rocha'),
		'07835190' => $daoEndereco->insert('07835190', 'Viela Nove', 'Parque Montreal', 'Franco da Rocha'),
		'07858000' => $daoEndereco->insert('07858000', 'Rua Maria Bonilha Munhoz', 'Parque Munhos', 'Franco da Rocha'),
		'07858010' => $daoEndereco->insert('07858010', 'Rua Miguel Russo', 'Parque Munhos', 'Franco da Rocha'),
		'07858020' => $daoEndereco->insert('07858020', 'Rua José Primo Lerussi', 'Parque Munhos', 'Franco da Rocha'),
		'07858025' => $daoEndereco->insert('07858025', 'Avenida Governador Mário Covas', 'Parque Munhos', 'Franco da Rocha'),
		'07858050' => $daoEndereco->insert('07858050', 'Rua José Vicente Bonilha', 'Parque Munhos', 'Franco da Rocha'),
		'07858060' => $daoEndereco->insert('07858060', 'Viela Dez', 'Parque Munhos', 'Franco da Rocha'),
		'07858070' => $daoEndereco->insert('07858070', 'Rua Doutor Julião Vaqueiro Rodrigues', 'Parque Munhos', 'Franco da Rocha'),
		'07858080' => $daoEndereco->insert('07858080', 'Rua Francisco Munhoz Cegarra', 'Parque Munhos', 'Franco da Rocha'),
		'07858090' => $daoEndereco->insert('07858090', 'Viela Sete', 'Parque Munhos', 'Franco da Rocha'),
		'07858100' => $daoEndereco->insert('07858100', 'Rua José Munhoz', 'Parque Munhos', 'Franco da Rocha'),
		'07858120' => $daoEndereco->insert('07858120', 'Viela Três', 'Parque Munhos', 'Franco da Rocha'),
		'07858140' => $daoEndereco->insert('07858140', 'Viela Onze', 'Parque Munhos', 'Franco da Rocha'),
		'07858150' => $daoEndereco->insert('07858150', 'Rua Doutor Eugênio Vaqueiro Rodrigues', 'Parque Munhos', 'Franco da Rocha'),
		'07858160' => $daoEndereco->insert('07858160', 'Rua Nicola Bonilha', 'Parque Munhos', 'Franco da Rocha'),
		'07858170' => $daoEndereco->insert('07858170', 'Rua Maria Munhoz Vaqueiro', 'Parque Munhos', 'Franco da Rocha'),
		'07858190' => $daoEndereco->insert('07858190', 'Estrada do Cemitério', 'Parque Munhos', 'Franco da Rocha'),
		'07858210' => $daoEndereco->insert('07858210', 'Rua Francisco Cigarra', 'Parque Munhos', 'Franco da Rocha'),
		'07858600' => $daoEndereco->insert('07858600', 'Estrada do Governo', 'Parque Munhos', 'Franco da Rocha'),
		'07844000' => $daoEndereco->insert('07844000', 'Avenida Itararé', 'Parque Paulista', 'Franco da Rocha'),
		'07844005' => $daoEndereco->insert('07844005', 'Rua Chico Mendes', 'Parque Paulista', 'Franco da Rocha'),
		'07844010' => $daoEndereco->insert('07844010', 'Avenida do Trevo', 'Parque Paulista', 'Franco da Rocha'),
		'07844015' => $daoEndereco->insert('07844015', 'Rua Anastácio', 'Parque Paulista', 'Franco da Rocha'),
		'07844040' => $daoEndereco->insert('07844040', 'Rua Viradouro', 'Parque Paulista', 'Franco da Rocha'),
		'07844050' => $daoEndereco->insert('07844050', 'Rua Tupã', 'Parque Paulista', 'Franco da Rocha'),
		'07844060' => $daoEndereco->insert('07844060', 'Viela Quatro', 'Parque Paulista', 'Franco da Rocha'),
		'07844070' => $daoEndereco->insert('07844070', 'Viela Cinco', 'Parque Paulista', 'Franco da Rocha'),
		'07844090' => $daoEndereco->insert('07844090', 'Rua Jardinópolis', 'Parque Paulista', 'Franco da Rocha'),
		'07844095' => $daoEndereco->insert('07844095', 'Viela Antônio Torrejon', 'Parque Paulista', 'Franco da Rocha'),
		'07844100' => $daoEndereco->insert('07844100', 'Avenida Itanave', 'Parque Paulista', 'Franco da Rocha'),
		'07844120' => $daoEndereco->insert('07844120', 'Rua Ribeiro Preto', 'Parque Paulista', 'Franco da Rocha'),
		'07844130' => $daoEndereco->insert('07844130', 'Rua Embú', 'Parque Paulista', 'Franco da Rocha'),
		'07844140' => $daoEndereco->insert('07844140', 'Rua Ourinhos', 'Parque Paulista', 'Franco da Rocha'),
		'07844150' => $daoEndereco->insert('07844150', 'Rua Saturnino Gomes de Sá', 'Parque Paulista', 'Franco da Rocha'),
		'07844160' => $daoEndereco->insert('07844160', 'Rua Itapetininga', 'Parque Paulista', 'Franco da Rocha'),
		'07844170' => $daoEndereco->insert('07844170', 'Rua Garça', 'Parque Paulista', 'Franco da Rocha'),
		'07844175' => $daoEndereco->insert('07844175', 'Viela Lázaro Vicente de Paula', 'Parque Paulista', 'Franco da Rocha'),
		'07844190' => $daoEndereco->insert('07844190', 'Viela Dois', 'Parque Paulista', 'Franco da Rocha'),
		'07844200' => $daoEndereco->insert('07844200', 'Avenida São Paulo', 'Parque Paulista', 'Franco da Rocha'),
		'07844210' => $daoEndereco->insert('07844210', 'Rua Dom Manoel', 'Parque Paulista', 'Franco da Rocha'),
		'07844220' => $daoEndereco->insert('07844220', 'Rua Amparo', 'Parque Paulista', 'Franco da Rocha'),
		'07844230' => $daoEndereco->insert('07844230', 'Viela T', 'Parque Paulista', 'Franco da Rocha'),
		'07844240' => $daoEndereco->insert('07844240', 'Viela Três', 'Parque Paulista', 'Franco da Rocha'),
		'07844250' => $daoEndereco->insert('07844250', 'Avenida Serrana', 'Parque Paulista', 'Franco da Rocha'),
		'07844270' => $daoEndereco->insert('07844270', 'Rua São Carlos', 'Parque Paulista', 'Franco da Rocha'),
		'07844310' => $daoEndereco->insert('07844310', 'Viela Joaquim Dias Filho', 'Parque Paulista', 'Franco da Rocha'),
		'07844320' => $daoEndereco->insert('07844320', 'Viela Doze', 'Parque Paulista', 'Franco da Rocha'),
		'07844330' => $daoEndereco->insert('07844330', 'Viela Treze', 'Parque Paulista', 'Franco da Rocha'),
		'07844340' => $daoEndereco->insert('07844340', 'Avenida Adamantina', 'Parque Paulista', 'Franco da Rocha'),
		'07856300' => $daoEndereco->insert('07856300', 'Avenida da Saudade', 'Parque Pretoria', 'Franco da Rocha'),
		'07856310' => $daoEndereco->insert('07856310', 'Rua da Colina', 'Parque Pretoria', 'Franco da Rocha'),
		'07856320' => $daoEndereco->insert('07856320', 'Rua Jaqueline', 'Parque Pretoria', 'Franco da Rocha'),
		'07856330' => $daoEndereco->insert('07856330', 'Rua da Graça', 'Parque Pretoria', 'Franco da Rocha'),
		'07856340' => $daoEndereco->insert('07856340', 'Rua Bom Pastor', 'Parque Pretoria', 'Franco da Rocha'),
		'07856350' => $daoEndereco->insert('07856350', 'Rua Maranhão', 'Parque Pretoria', 'Franco da Rocha'),
		'07856360' => $daoEndereco->insert('07856360', 'Rua Piauí', 'Parque Pretoria', 'Franco da Rocha'),
		'07856370' => $daoEndereco->insert('07856370', 'Rua dos Eucaliptos', 'Parque Pretoria', 'Franco da Rocha'),
		'07856380' => $daoEndereco->insert('07856380', 'Rua Santa Luzia', 'Parque Pretoria', 'Franco da Rocha'),
		'07856390' => $daoEndereco->insert('07856390', 'Avenida Cachoeira', 'Parque Pretoria', 'Franco da Rocha'),
		'07856400' => $daoEndereco->insert('07856400', 'Rua Pinheiros', 'Parque Pretoria', 'Franco da Rocha'),
		'07864000' => $daoEndereco->insert('07864000', 'Rua Pintassilgo', 'Parque Pretoria', 'Franco da Rocha'),
		'07864005' => $daoEndereco->insert('07864005', 'Viela Um da Rua Pintassilgo', 'Parque Pretoria', 'Franco da Rocha'),
		'07864010' => $daoEndereco->insert('07864010', 'Rua Beija-Flor', 'Parque Pretoria', 'Franco da Rocha'),
		'07864015' => $daoEndereco->insert('07864015', 'Viela Beija-Flor', 'Parque Pretoria', 'Franco da Rocha'),
		'07864020' => $daoEndereco->insert('07864020', 'Rua Gavião', 'Parque Pretoria', 'Franco da Rocha'),
		'07864030' => $daoEndereco->insert('07864030', 'Viela Dois da Rua Beija-flor', 'Parque Pretoria', 'Franco da Rocha'),
		'07864040' => $daoEndereco->insert('07864040', 'Rua Sabiá Laranjeiras', 'Parque Pretoria', 'Franco da Rocha'),
		'07864050' => $daoEndereco->insert('07864050', 'Rua Coleirinha', 'Parque Pretoria', 'Franco da Rocha'),
		'07864060' => $daoEndereco->insert('07864060', 'Rua Perdiz', 'Parque Pretoria', 'Franco da Rocha'),
		'07864070' => $daoEndereco->insert('07864070', 'Rua Patativa', 'Parque Pretoria', 'Franco da Rocha'),
		'07864080' => $daoEndereco->insert('07864080', 'Rua Azulão', 'Parque Pretoria', 'Franco da Rocha'),
		'07864090' => $daoEndereco->insert('07864090', 'Rua Andorinha', 'Parque Pretoria', 'Franco da Rocha'),
		'07864100' => $daoEndereco->insert('07864100', 'Rua Juriti', 'Parque Pretoria', 'Franco da Rocha'),
		'07864110' => $daoEndereco->insert('07864110', 'Rua Araponga', 'Parque Pretoria', 'Franco da Rocha'),
		'07864120' => $daoEndereco->insert('07864120', 'Rua Ibis Dourado', 'Parque Pretoria', 'Franco da Rocha'),
		'07864130' => $daoEndereco->insert('07864130', 'Rua João de Barro', 'Parque Pretoria', 'Franco da Rocha'),
		'07864140' => $daoEndereco->insert('07864140', 'Rua Curió', 'Parque Pretoria', 'Franco da Rocha'),
		'07864145' => $daoEndereco->insert('07864145', 'Viela Curió', 'Parque Pretoria', 'Franco da Rocha'),
		'07864150' => $daoEndereco->insert('07864150', 'Viela Sabiá Laranjeiras', 'Parque Pretoria', 'Franco da Rocha'),
		'07864160' => $daoEndereco->insert('07864160', 'Rua Papa Capim', 'Parque Pretoria', 'Franco da Rocha'),
		'07864170' => $daoEndereco->insert('07864170', 'Rua Gaivota', 'Parque Pretoria', 'Franco da Rocha'),
		'07864180' => $daoEndereco->insert('07864180', 'Rua Bem-te-vi', 'Parque Pretoria', 'Franco da Rocha'),
		'07864190' => $daoEndereco->insert('07864190', 'Rua Pica-pau', 'Parque Pretoria', 'Franco da Rocha'),
		'07864200' => $daoEndereco->insert('07864200', 'Rua Rouxinol', 'Parque Pretoria', 'Franco da Rocha'),
		'07864210' => $daoEndereco->insert('07864210', 'Viela Pintassilgo', 'Parque Pretoria', 'Franco da Rocha'),
		'07864220' => $daoEndereco->insert('07864220', 'Rua Cardeal', 'Parque Pretoria', 'Franco da Rocha'),
		'07864230' => $daoEndereco->insert('07864230', 'Rua Graúna', 'Parque Pretoria', 'Franco da Rocha'),
		'07864240' => $daoEndereco->insert('07864240', 'Rua Canário', 'Parque Pretoria', 'Franco da Rocha'),
		'07864250' => $daoEndereco->insert('07864250', 'Rua Tiziu', 'Parque Pretoria', 'Franco da Rocha'),
		'07864260' => $daoEndereco->insert('07864260', 'Rua Pardal', 'Parque Pretoria', 'Franco da Rocha'),
		'07864265' => $daoEndereco->insert('07864265', 'Viela Pardal', 'Parque Pretoria', 'Franco da Rocha'),
		'07864270' => $daoEndereco->insert('07864270', 'Rua Jandaia', 'Parque Pretoria', 'Franco da Rocha'),
		'07864280' => $daoEndereco->insert('07864280', 'Rua Seriema', 'Parque Pretoria', 'Franco da Rocha'),
		'07864290' => $daoEndereco->insert('07864290', 'Rua Picharro', 'Parque Pretoria', 'Franco da Rocha'),
		'07864300' => $daoEndereco->insert('07864300', 'Rua Uirapuru', 'Parque Pretoria', 'Franco da Rocha'),
		'07864310' => $daoEndereco->insert('07864310', 'Rua Bigodinho', 'Parque Pretoria', 'Franco da Rocha'),
		'07864320' => $daoEndereco->insert('07864320', 'Rua Guriatá', 'Parque Pretoria', 'Franco da Rocha'),
		'07864330' => $daoEndereco->insert('07864330', 'Viela Cardeal', 'Parque Pretoria', 'Franco da Rocha'),
		'07864340' => $daoEndereco->insert('07864340', 'Rua Tangará da Serra', 'Parque Pretoria', 'Franco da Rocha'),
		'07864350' => $daoEndereco->insert('07864350', 'Rua Papagaio', 'Parque Pretoria', 'Franco da Rocha'),
		'07864360' => $daoEndereco->insert('07864360', 'Rua Chupim', 'Parque Pretoria', 'Franco da Rocha'),
		'07864370' => $daoEndereco->insert('07864370', 'Rua Flamingo', 'Parque Pretoria', 'Franco da Rocha'),
		'07864380' => $daoEndereco->insert('07864380', 'Rua Pássaro Preto', 'Parque Pretoria', 'Franco da Rocha'),
		'07864390' => $daoEndereco->insert('07864390', 'Rua TicoTico', 'Parque Pretoria', 'Franco da Rocha'),
		'07864400' => $daoEndereco->insert('07864400', 'Rua Das Graças', 'Parque Pretoria', 'Franco da Rocha'),
		'07864410' => $daoEndereco->insert('07864410', 'Viela Dois da Bem-Te-Vi', 'Parque Pretoria', 'Franco da Rocha'),
		'07864415' => $daoEndereco->insert('07864415', 'Rua Maritaca', 'Parque Pretoria', 'Franco da Rocha'),
		'07864420' => $daoEndereco->insert('07864420', 'Viela Três da Bem-Te-Vi', 'Parque Pretoria', 'Franco da Rocha'),
		'07864425' => $daoEndereco->insert('07864425', 'Viela Quatro da Bem-Te-Vi', 'Parque Pretoria', 'Franco da Rocha'),
		'07864430' => $daoEndereco->insert('07864430', 'Viela Cinco da Bem-Te-Vi', 'Parque Pretoria', 'Franco da Rocha'),
		'07864435' => $daoEndereco->insert('07864435', 'Viela Seis da Bem-Te-Vi', 'Parque Pretoria', 'Franco da Rocha'),
		'07864440' => $daoEndereco->insert('07864440', 'Viela Sete da Bem-Te-Vi', 'Parque Pretoria', 'Franco da Rocha'),
		'07864445' => $daoEndereco->insert('07864445', 'Viela Oito da Bem-Te-Vi', 'Parque Pretoria', 'Franco da Rocha'),
		'07809100' => $daoEndereco->insert('07809100', 'Rua Vitória Régia', 'Parque Santa Delfa', 'Franco da Rocha'),
		'07809105' => $daoEndereco->insert('07809105', 'Rodovia Tancredo de Almeida Neves', 'Parque Santa Delfa', 'Franco da Rocha'),
		'07809120' => $daoEndereco->insert('07809120', 'Rua José de Souza', 'Parque Santa Delfa', 'Franco da Rocha'),
		'07809130' => $daoEndereco->insert('07809130', 'Rua Nelson Bino', 'Parque Santa Delfa', 'Franco da Rocha'),
		'07809160' => $daoEndereco->insert('07809160', 'Viela Dois', 'Parque Santa Delfa', 'Franco da Rocha'),
		'07809170' => $daoEndereco->insert('07809170', 'Rua Enéas Rodrigues Moreira', 'Parque Santa Delfa', 'Franco da Rocha'),
		'07809180' => $daoEndereco->insert('07809180', 'Rua das Tulipas', 'Parque Santa Delfa', 'Franco da Rocha'),
		'07809190' => $daoEndereco->insert('07809190', 'Rua das Violetas', 'Parque Santa Delfa', 'Franco da Rocha'),
		'07809200' => $daoEndereco->insert('07809200', 'Rua das Carmélias', 'Parque Santa Delfa', 'Franco da Rocha'),
		'07809210' => $daoEndereco->insert('07809210', 'Rua das Orquídeas', 'Parque Santa Delfa', 'Franco da Rocha'),
		'07809220' => $daoEndereco->insert('07809220', 'Rua das Rosas', 'Parque Santa Delfa', 'Franco da Rocha'),
		'07809230' => $daoEndereco->insert('07809230', 'Rua das Margaridas', 'Parque Santa Delfa', 'Franco da Rocha'),
		'07853220' => $daoEndereco->insert('07853220', 'Rua Madagascar', 'Parque Vitória', 'Franco da Rocha'),
		'07854000' => $daoEndereco->insert('07854000', 'Rua Paris', 'Parque Vitória', 'Franco da Rocha'),
		'07854010' => $daoEndereco->insert('07854010', 'Viela Dez', 'Parque Vitória', 'Franco da Rocha'),
		'07854030' => $daoEndereco->insert('07854030', 'Rua Estocolmo', 'Parque Vitória', 'Franco da Rocha'),
		'07854050' => $daoEndereco->insert('07854050', 'Rua Lisboa', 'Parque Vitória', 'Franco da Rocha'),
		'07854053' => $daoEndereco->insert('07854053', 'Viela Francisco Cesar Batista Junior', 'Parque Vitória', 'Franco da Rocha'),
		'07854060' => $daoEndereco->insert('07854060', 'Rua Madri', 'Parque Vitória', 'Franco da Rocha'),
		'07854070' => $daoEndereco->insert('07854070', 'Viela B', 'Parque Vitória', 'Franco da Rocha'),
		'07854080' => $daoEndereco->insert('07854080', 'Rua Amsterdam', 'Parque Vitória', 'Franco da Rocha'),
		'07854090' => $daoEndereco->insert('07854090', 'Rua Viena', 'Parque Vitória', 'Franco da Rocha'),
		'07854110' => $daoEndereco->insert('07854110', 'Viela Treze', 'Parque Vitória', 'Franco da Rocha'),
		'07854120' => $daoEndereco->insert('07854120', 'Avenida Giovani Rinaldi', 'Parque Vitória', 'Franco da Rocha'),
		'07854130' => $daoEndereco->insert('07854130', 'Rua Elis Regina', 'Parque Vitória', 'Franco da Rocha'),
		'07854140' => $daoEndereco->insert('07854140', 'Rua Antônia Hernandez Greco', 'Parque Vitória', 'Franco da Rocha'),
		'07854150' => $daoEndereco->insert('07854150', 'Rua Bruxelas', 'Parque Vitória', 'Franco da Rocha'),
		'07854160' => $daoEndereco->insert('07854160', 'Viela Geraldo Henrique da Silva', 'Parque Vitória', 'Franco da Rocha'),
		'07854180' => $daoEndereco->insert('07854180', 'Viela Quatro', 'Parque Vitória', 'Franco da Rocha'),
		'07854190' => $daoEndereco->insert('07854190', 'Viela Três', 'Parque Vitória', 'Franco da Rocha'),
		'07854200' => $daoEndereco->insert('07854200', 'Rua Sofia', 'Parque Vitória', 'Franco da Rocha'),
		'07854210' => $daoEndereco->insert('07854210', 'Rua Atenas', 'Parque Vitória', 'Franco da Rocha'),
		'07855010' => $daoEndereco->insert('07855010', 'Viela Dezessete', 'Parque Vitória', 'Franco da Rocha'),
		'07855020' => $daoEndereco->insert('07855020', 'Rua Indalécio Pereira da Silva', 'Parque Vitória', 'Franco da Rocha'),
		'07855030' => $daoEndereco->insert('07855030', 'Rua Leonilda Baldim', 'Parque Vitória', 'Franco da Rocha'),
		'07855040' => $daoEndereco->insert('07855040', 'Rua Tunis', 'Parque Vitória', 'Franco da Rocha'),
		'07855050' => $daoEndereco->insert('07855050', 'Rua Santiago', 'Parque Vitória', 'Franco da Rocha'),
		'07855060' => $daoEndereco->insert('07855060', 'Rua José Quintanilha', 'Parque Vitória', 'Franco da Rocha'),
		'07855070' => $daoEndereco->insert('07855070', 'Viela Quarenta e Três', 'Parque Vitória', 'Franco da Rocha'),
		'07855080' => $daoEndereco->insert('07855080', 'Rua Damasco', 'Parque Vitória', 'Franco da Rocha'),
		'07855090' => $daoEndereco->insert('07855090', 'Viela Trinta e Seis', 'Parque Vitória', 'Franco da Rocha'),
		'07855100' => $daoEndereco->insert('07855100', 'Viela Trinta e Sete', 'Parque Vitória', 'Franco da Rocha'),
		'07855110' => $daoEndereco->insert('07855110', 'Rua Belfast', 'Parque Vitória', 'Franco da Rocha'),
		'07855120' => $daoEndereco->insert('07855120', 'Rua Francisco Casamassa', 'Parque Vitória', 'Franco da Rocha'),
		'07855130' => $daoEndereco->insert('07855130', 'Viela Trinta e Nove', 'Parque Vitória', 'Franco da Rocha'),
		'07855140' => $daoEndereco->insert('07855140', 'Viela Quarenta', 'Parque Vitória', 'Franco da Rocha'),
		'07855150' => $daoEndereco->insert('07855150', 'Rua Assembléia de Deus', 'Parque Vitória', 'Franco da Rocha'),
		'07855160' => $daoEndereco->insert('07855160', 'Rua Luiz Coutinho de Abreu', 'Parque Vitória', 'Franco da Rocha'),
		'07855170' => $daoEndereco->insert('07855170', 'Viela Quarenta e Um', 'Parque Vitória', 'Franco da Rocha'),
		'07855180' => $daoEndereco->insert('07855180', 'Rua Caiena', 'Parque Vitória', 'Franco da Rocha'),
		'07855190' => $daoEndereco->insert('07855190', 'Rua Péricles Fernandes Pereira', 'Parque Vitória', 'Franco da Rocha'),
		'07855200' => $daoEndereco->insert('07855200', 'Rua Ancara', 'Parque Vitória', 'Franco da Rocha'),
		'07855210' => $daoEndereco->insert('07855210', 'Viela Vinte e Um', 'Parque Vitória', 'Franco da Rocha'),
		'07855220' => $daoEndereco->insert('07855220', 'Viela Dezenove', 'Parque Vitória', 'Franco da Rocha'),
		'07855230' => $daoEndereco->insert('07855230', 'Viela Dezoito', 'Parque Vitória', 'Franco da Rocha'),
		'07855240' => $daoEndereco->insert('07855240', 'Viela Vinte', 'Parque Vitória', 'Franco da Rocha'),
		'07855250' => $daoEndereco->insert('07855250', 'Rua Bogotá', 'Parque Vitória', 'Franco da Rocha'),
		'07855260' => $daoEndereco->insert('07855260', 'Rua Montevidéo', 'Parque Vitória', 'Franco da Rocha'),
		'07855270' => $daoEndereco->insert('07855270', 'Rua Zebedeu Marcolino', 'Parque Vitória', 'Franco da Rocha'),
		'07855280' => $daoEndereco->insert('07855280', 'Viela Quinze', 'Parque Vitória', 'Franco da Rocha'),
		'07855290' => $daoEndereco->insert('07855290', 'Viela Dezesseis', 'Parque Vitória', 'Franco da Rocha'),
		'07855300' => $daoEndereco->insert('07855300', 'Rua Lima', 'Parque Vitória', 'Franco da Rocha'),
		'07855320' => $daoEndereco->insert('07855320', 'Rua Quito', 'Parque Vitória', 'Franco da Rocha'),
		'07855340' => $daoEndereco->insert('07855340', 'Rua Oslo', 'Parque Vitória', 'Franco da Rocha'),
		'07855350' => $daoEndereco->insert('07855350', 'Rua Manágua', 'Parque Vitória', 'Franco da Rocha'),
		'07855360' => $daoEndereco->insert('07855360', 'Rua Antonio Beltrame', 'Parque Vitória', 'Franco da Rocha'),
		'07855370' => $daoEndereco->insert('07855370', 'Rua Teerã', 'Parque Vitória', 'Franco da Rocha'),
		'07856000' => $daoEndereco->insert('07856000', 'Rua Silas dos Santos', 'Parque Vitória', 'Franco da Rocha'),
		'07856010' => $daoEndereco->insert('07856010', 'Viela Vinte e Cinco', 'Parque Vitória', 'Franco da Rocha'),
		'07856020' => $daoEndereco->insert('07856020', 'Viela Vinte e Seis', 'Parque Vitória', 'Franco da Rocha'),
		'07856040' => $daoEndereco->insert('07856040', 'Viela Vinte e Sete', 'Parque Vitória', 'Franco da Rocha'),
		'07856050' => $daoEndereco->insert('07856050', 'Rua Copenhagen', 'Parque Vitória', 'Franco da Rocha'),
		'07856060' => $daoEndereco->insert('07856060', 'Viela Vinte e Dois', 'Parque Vitória', 'Franco da Rocha'),
		'07856070' => $daoEndereco->insert('07856070', 'Rua José Maria Lira', 'Parque Vitória', 'Franco da Rocha'),
		'07856080' => $daoEndereco->insert('07856080', 'Viela Vinte e Nove', 'Parque Vitória', 'Franco da Rocha'),
		'07856090' => $daoEndereco->insert('07856090', 'Viela Trinta', 'Parque Vitória', 'Franco da Rocha'),
		'07856100' => $daoEndereco->insert('07856100', 'Rua Nairobi', 'Parque Vitória', 'Franco da Rocha'),
		'07856110' => $daoEndereco->insert('07856110', 'Rua Lourenço Marques', 'Parque Vitória', 'Franco da Rocha'),
		'07856120' => $daoEndereco->insert('07856120', 'Viela Quarenta e Cinco', 'Parque Vitória', 'Franco da Rocha'),
		'07856130' => $daoEndereco->insert('07856130', 'Viela Quarenta e Seis', 'Parque Vitória', 'Franco da Rocha'),
		'07856140' => $daoEndereco->insert('07856140', 'Rua Lucas Vieiras', 'Parque Vitória', 'Franco da Rocha'),
		'07856150' => $daoEndereco->insert('07856150', 'Viela Quarenta e Sete', 'Parque Vitória', 'Franco da Rocha'),
		'07856160' => $daoEndereco->insert('07856160', 'Rua Glascow', 'Parque Vitória', 'Franco da Rocha'),
		'07856170' => $daoEndereco->insert('07856170', 'Viela Trinta e Um', 'Parque Vitória', 'Franco da Rocha'),
		'07856180' => $daoEndereco->insert('07856180', 'Rua Belgrado', 'Parque Vitória', 'Franco da Rocha'),
		'07856190' => $daoEndereco->insert('07856190', 'Viela Trinta e Dois', 'Parque Vitória', 'Franco da Rocha'),
		'07856200' => $daoEndereco->insert('07856200', 'Rua do Porto', 'Parque Vitória', 'Franco da Rocha'),
		'07856210' => $daoEndereco->insert('07856210', 'Rua Varsóvia', 'Parque Vitória', 'Franco da Rocha'),
		'07856220' => $daoEndereco->insert('07856220', 'Viela Trinta e Três', 'Parque Vitória', 'Franco da Rocha'),
		'07856230' => $daoEndereco->insert('07856230', 'Viela Trinta e Quatro', 'Parque Vitória', 'Franco da Rocha'),
		'07856240' => $daoEndereco->insert('07856240', 'Rua Cidade do México', 'Parque Vitória', 'Franco da Rocha'),
		'07856250' => $daoEndereco->insert('07856250', 'Viela Vinte e Quatro', 'Parque Vitória', 'Franco da Rocha'),
		'07856260' => $daoEndereco->insert('07856260', 'Rua Antônio Nascimento', 'Parque Vitória', 'Franco da Rocha'),
		'07856270' => $daoEndereco->insert('07856270', 'Rua Trípoli', 'Parque Vitória', 'Franco da Rocha'),
		'07856280' => $daoEndereco->insert('07856280', 'Viela Vinte e Três', 'Parque Vitória', 'Franco da Rocha'),
		'07832410' => $daoEndereco->insert('07832410', 'Avenida Cibam', 'Pólo Industrial', 'Franco da Rocha'),
		'07832415' => $daoEndereco->insert('07832415', 'Estrada de Belém', 'Pólo Industrial', 'Franco da Rocha'),
		'07832420' => $daoEndereco->insert('07832420', 'Estrada Municipal', 'Pólo Industrial', 'Franco da Rocha'),
		'07832440' => $daoEndereco->insert('07832440', 'Rua Cinco', 'Pólo Industrial', 'Franco da Rocha'),
		'07832450' => $daoEndereco->insert('07832450', 'Rua Pedro Aparecido de Lima', 'Pólo Industrial', 'Franco da Rocha'),
		'07832460' => $daoEndereco->insert('07832460', 'Rua João Marcos Pimenta Rocha', 'Pólo Industrial', 'Franco da Rocha'),
		'07832470' => $daoEndereco->insert('07832470', 'Rua Irma do Carmo Lima', 'Pólo Industrial', 'Franco da Rocha'),
		'07832480' => $daoEndereco->insert('07832480', 'Rua Antonio Neidenbach', 'Pólo Industrial', 'Franco da Rocha'),
		'07832490' => $daoEndereco->insert('07832490', 'Rua Manoel Antonio Cardoso', 'Pólo Industrial', 'Franco da Rocha'),
		'07832500' => $daoEndereco->insert('07832500', 'Rua Ana Covões Cardoso', 'Pólo Industrial', 'Franco da Rocha'),
		'07868010' => $daoEndereco->insert('07868010', 'Rua Um', 'Portal da Estação', 'Franco da Rocha'),
		'07868020' => $daoEndereco->insert('07868020', 'Rua Viviane Lopes Matias', 'Portal da Estação', 'Franco da Rocha'),
		'07868030' => $daoEndereco->insert('07868030', 'Rua Cazuza', 'Portal da Estação', 'Franco da Rocha'),
		'07868040' => $daoEndereco->insert('07868040', 'Rua Quatro', 'Portal da Estação', 'Franco da Rocha'),
		'07868050' => $daoEndereco->insert('07868050', 'Rua Tim Maia', 'Portal da Estação', 'Franco da Rocha'),
		'07868060' => $daoEndereco->insert('07868060', 'Rua Raul Seixas', 'Portal da Estação', 'Franco da Rocha'),
		'07868070' => $daoEndereco->insert('07868070', 'Rua Cassia Eller', 'Portal da Estação', 'Franco da Rocha'),
		'07812000' => $daoEndereco->insert('07812000', 'Alameda das Araucárias', 'Portal das Alamedas', 'Franco da Rocha'),
		'07812010' => $daoEndereco->insert('07812010', 'Alameda das Aroeiras', 'Portal das Alamedas', 'Franco da Rocha'),
		'07812020' => $daoEndereco->insert('07812020', 'Alameda das Paineiras', 'Portal das Alamedas', 'Franco da Rocha'),
		'07812030' => $daoEndereco->insert('07812030', 'Alameda das Quaresmeiras', 'Portal das Alamedas', 'Franco da Rocha'),
		'07812040' => $daoEndereco->insert('07812040', 'Alameda dos Jacarandás', 'Portal das Alamedas', 'Franco da Rocha'),
		'07812050' => $daoEndereco->insert('07812050', 'Alameda dos Mognos', 'Portal das Alamedas', 'Franco da Rocha'),
		'07812060' => $daoEndereco->insert('07812060', 'Alameda das Araçás', 'Portal das Alamedas', 'Franco da Rocha'),
		'07812070' => $daoEndereco->insert('07812070', 'Alameda das Louveiras', 'Portal das Alamedas', 'Franco da Rocha'),
		'07812080' => $daoEndereco->insert('07812080', 'Alameda dos Jequitibás', 'Portal das Alamedas', 'Franco da Rocha'),
		'07812090' => $daoEndereco->insert('07812090', 'Alameda dos Timburis', 'Portal das Alamedas', 'Franco da Rocha'),
		'07812100' => $daoEndereco->insert('07812100', 'Alameda das Seringueiras', 'Portal das Alamedas', 'Franco da Rocha'),
		'07812110' => $daoEndereco->insert('07812110', 'Alameda dos Manacás', 'Portal das Alamedas', 'Franco da Rocha'),
		'07812120' => $daoEndereco->insert('07812120', 'Alameda dos Carvalhos', 'Portal das Alamedas', 'Franco da Rocha'),
		'07812130' => $daoEndereco->insert('07812130', 'Alameda dos Salgueiros', 'Portal das Alamedas', 'Franco da Rocha'),
		'07812140' => $daoEndereco->insert('07812140', 'Alameda das Oliveiras', 'Portal das Alamedas', 'Franco da Rocha'),
		'07812150' => $daoEndereco->insert('07812150', 'Alameda dos Álamos', 'Portal das Alamedas', 'Franco da Rocha'),
		'07812160' => $daoEndereco->insert('07812160', 'Alameda dos Pinheiros', 'Portal das Alamedas', 'Franco da Rocha'),
		'07812170' => $daoEndereco->insert('07812170', 'Alameda das Grevíleas', 'Portal das Alamedas', 'Franco da Rocha'),
		'07812180' => $daoEndereco->insert('07812180', 'Alameda dos Ciprestes', 'Portal das Alamedas', 'Franco da Rocha'),
		'07858270' => $daoEndereco->insert('07858270', 'Rua Pérola', 'Pouso Alegre', 'Franco da Rocha'),
		'07859000' => $daoEndereco->insert('07859000', 'Rua Nove de Julho', 'Pouso Alegre', 'Franco da Rocha'),
		'07859005' => $daoEndereco->insert('07859005', 'Viela Geraldo Viola', 'Pouso Alegre', 'Franco da Rocha'),
		'07859010' => $daoEndereco->insert('07859010', 'Viela Um', 'Pouso Alegre', 'Franco da Rocha'),
		'07859020' => $daoEndereco->insert('07859020', 'Rua Ibitinga', 'Pouso Alegre', 'Franco da Rocha'),
		'07859029' => $daoEndereco->insert('07859029', 'Praça João XXIII', 'Pouso Alegre', 'Franco da Rocha'),
		'07859030' => $daoEndereco->insert('07859030', 'Rua Jair Antônio Beraldes', 'Pouso Alegre', 'Franco da Rocha'),
		'07859040' => $daoEndereco->insert('07859040', 'Rua Nilo Peçanha', 'Pouso Alegre', 'Franco da Rocha'),
		'07859100' => $daoEndereco->insert('07859100', 'Rua Francisco Borges Dias de Miranda', 'Pouso Alegre', 'Franco da Rocha'),
		'07859230' => $daoEndereco->insert('07859230', 'Rua Peixoto Gomide', 'Pouso Alegre', 'Franco da Rocha'),
		'07859235' => $daoEndereco->insert('07859235', 'Avenida José Francisco Teixeira', 'Pouso Alegre', 'Franco da Rocha'),
		'07859240' => $daoEndereco->insert('07859240', 'Rua Gabriel Monteiro', 'Pouso Alegre', 'Franco da Rocha'),
		'07859250' => $daoEndereco->insert('07859250', 'Rua David Cavalheiro', 'Pouso Alegre', 'Franco da Rocha'),
		'07859260' => $daoEndereco->insert('07859260', 'Rua Primeiro de Maio', 'Pouso Alegre', 'Franco da Rocha'),
		'07859270' => $daoEndereco->insert('07859270', 'Rua Santa Cruz', 'Pouso Alegre', 'Franco da Rocha'),
		'07859280' => $daoEndereco->insert('07859280', 'Rua São João', 'Pouso Alegre', 'Franco da Rocha'),
		'07859290' => $daoEndereco->insert('07859290', 'Rua Dona Irmgard Draeger', 'Pouso Alegre', 'Franco da Rocha'),
		'07859320' => $daoEndereco->insert('07859320', 'Rua Bandeirantes', 'Pouso Alegre', 'Franco da Rocha'),
		'07859330' => $daoEndereco->insert('07859330', 'Rua Pedro de Toledo', 'Pouso Alegre', 'Franco da Rocha'),
		'07859340' => $daoEndereco->insert('07859340', 'Estrada do Governo', 'Pouso Alegre', 'Franco da Rocha'),
		'07859900' => $daoEndereco->insert('07859900', 'Estrada do Governo, km 41', 'Pouso Alegre', 'Franco da Rocha'),
		'07859901' => $daoEndereco->insert('07859901', 'Estrada do Governo, km 43', 'Pouso Alegre', 'Franco da Rocha'),
		'07859970' => $daoEndereco->insert('07859970', 'Estrada do Governo, 843', 'Pouso Alegre', 'Franco da Rocha'),
		'07810010' => $daoEndereco->insert('07810010', 'Estrada da Borda da Mata', 'Recanto da Lapa', 'Franco da Rocha'),
		'07810020' => $daoEndereco->insert('07810020', 'Estrada do Bom Tempo', 'Recanto da Lapa', 'Franco da Rocha'),
		'07810030' => $daoEndereco->insert('07810030', 'Estrada do Relevo', 'Recanto da Lapa', 'Franco da Rocha'),
		'07810040' => $daoEndereco->insert('07810040', 'Estrada dos Eucaliptos', 'Recanto da Lapa', 'Franco da Rocha'),
		'07810050' => $daoEndereco->insert('07810050', 'Estrada Município do Taboão', 'Recanto da Lapa', 'Franco da Rocha'),
		'07810000' => $daoEndereco->insert('07810000', 'Avenida Pacaembu', 'Sitio Borda da Mata', 'Franco da Rocha'),
		'07810090' => $daoEndereco->insert('07810090', 'Estrada Flor de Liz', 'Sitio Borda da Mata', 'Franco da Rocha'),
		'07810095' => $daoEndereco->insert('07810095', 'Rua Iracema Couto', 'Sitio Borda da Mata', 'Franco da Rocha'),
		'07810100' => $daoEndereco->insert('07810100', 'Estrada dos Ciclames', 'Sitio Borda da Mata', 'Franco da Rocha'),
		'07810105' => $daoEndereco->insert('07810105', 'Rua Projetada', 'Sitio Borda da Mata', 'Franco da Rocha'),
		'07810110' => $daoEndereco->insert('07810110', 'Estrada dos Crisântemos', 'Sitio Borda da Mata', 'Franco da Rocha'),
		'07810115' => $daoEndereco->insert('07810115', 'Estrada das Papoulas', 'Sitio Borda da Mata', 'Franco da Rocha'),
		'07810120' => $daoEndereco->insert('07810120', 'Estrada das Petúnias', 'Sitio Borda da Mata', 'Franco da Rocha'),
		'07808360' => $daoEndereco->insert('07808360', 'Rua das Chácaras', 'Sitio Marilene', 'Franco da Rocha'),
		'07808370' => $daoEndereco->insert('07808370', 'Rua das Flores', 'Sitio Marilene', 'Franco da Rocha'),
		'07808380' => $daoEndereco->insert('07808380', 'Rua da Fonte', 'Sitio Marilene', 'Franco da Rocha'),
		'07808420' => $daoEndereco->insert('07808420', 'Rua São Bernardo', 'Sitio Marilene', 'Franco da Rocha'),
		'07851110' => $daoEndereco->insert('07851110', 'Rua Arthur Sestini', 'Vila Alves', 'Franco da Rocha'),
		'07850160' => $daoEndereco->insert('07850160', 'Rua Silvério Del Débbio', 'Vila Amália', 'Franco da Rocha'),
		'07850165' => $daoEndereco->insert('07850165', 'Rua Sud Menucci', 'Vila Amália', 'Franco da Rocha'),
		'07850170' => $daoEndereco->insert('07850170', 'Rua Oscar de Almeida Nunes', 'Vila Amália', 'Franco da Rocha'),
		'07850180' => $daoEndereco->insert('07850180', 'Praça Carlos Gomes', 'Vila Amália', 'Franco da Rocha'),
		'07850190' => $daoEndereco->insert('07850190', 'Rua Filoteo Beneducci', 'Vila Amália', 'Franco da Rocha'),
		'07850200' => $daoEndereco->insert('07850200', 'Praça do Cruzeiro', 'Vila Amália', 'Franco da Rocha'),
		'07850310' => $daoEndereco->insert('07850310', 'Rua Cavalheiro Ângelo Sestini', 'Vila Artur Sestini', 'Franco da Rocha'),
		'07851120' => $daoEndereco->insert('07851120', 'Avenida Sete de Setembro', 'Vila Artur Sestini', 'Franco da Rocha'),
		'07851970' => $daoEndereco->insert('07851970', 'Avenida Sete de Setembro, 548', 'Vila Artur Sestini', 'Franco da Rocha'),
		'07807020' => $daoEndereco->insert('07807020', 'Rua Joaquim Duarte Machado', 'Vila Bazu', 'Franco da Rocha'),
		'07807030' => $daoEndereco->insert('07807030', 'Rua Justino Anzelotti', 'Vila Bazu', 'Franco da Rocha'),
		'07807040' => $daoEndereco->insert('07807040', 'Viela A', 'Vila Bazu', 'Franco da Rocha'),
		'07808000' => $daoEndereco->insert('07808000', 'Rua Prudente de Moraes', 'Vila Bazu', 'Franco da Rocha'),
		'07840000' => $daoEndereco->insert('07840000', 'Rua Dom João VI', 'Vila Bazu', 'Franco da Rocha'),
		'07840020' => $daoEndereco->insert('07840020', 'Viela Basej', 'Vila Bazu', 'Franco da Rocha'),
		'07840030' => $daoEndereco->insert('07840030', 'Rua Padre Vieira', 'Vila Bazu', 'Franco da Rocha'),
		'07840040' => $daoEndereco->insert('07840040', 'Rua Tomaz Antônio Gonzaga', 'Vila Bazu', 'Franco da Rocha'),
		'07840045' => $daoEndereco->insert('07840045', 'Rua João Mendes', 'Vila Bazu', 'Franco da Rocha'),
		'07840050' => $daoEndereco->insert('07840050', 'Rua Francisco Mathias', 'Vila Bazu', 'Franco da Rocha'),
		'07840070' => $daoEndereco->insert('07840070', 'Rua Albuquerque Lins', 'Vila Bazu', 'Franco da Rocha'),
		'07840080' => $daoEndereco->insert('07840080', 'Rua Marquesa de Santos', 'Vila Bazu', 'Franco da Rocha'),
		'07840090' => $daoEndereco->insert('07840090', 'Rua Júlio Mesquita', 'Vila Bazu', 'Franco da Rocha'),
		'07840100' => $daoEndereco->insert('07840100', 'Rua Cristóvão Colombo', 'Vila Bazu', 'Franco da Rocha'),
		'07840110' => $daoEndereco->insert('07840110', 'Rua Santos Dumont', 'Vila Bazu', 'Franco da Rocha'),
		'07849000' => $daoEndereco->insert('07849000', 'Rua Alvarenga Peixoto', 'Vila Bazu', 'Franco da Rocha'),
		'07849010' => $daoEndereco->insert('07849010', 'Rua Pero Vaz de Caminha', 'Vila Bazu', 'Franco da Rocha'),
		'07849020' => $daoEndereco->insert('07849020', 'Rua Alcino Francisco do Prado', 'Vila Bazu', 'Franco da Rocha'),
		'07849025' => $daoEndereco->insert('07849025', 'Rua Francisco Grecco', 'Vila Bazu', 'Franco da Rocha'),
		'07849030' => $daoEndereco->insert('07849030', 'Rua Tiradentes', 'Vila Bazu', 'Franco da Rocha'),
		'07842000' => $daoEndereco->insert('07842000', 'Estrada Municipal de Franco da Rocha/Francisco Morato', 'Vila Bela', 'Franco da Rocha'),
		'07842020' => $daoEndereco->insert('07842020', 'Rua Vereador Orlando de Castro e Silva', 'Vila Bela', 'Franco da Rocha'),
		'07842030' => $daoEndereco->insert('07842030', 'Rua Espanha', 'Vila Bela', 'Franco da Rocha'),
		'07842050' => $daoEndereco->insert('07842050', 'Rua Áustria', 'Vila Bela', 'Franco da Rocha'),
		'07842070' => $daoEndereco->insert('07842070', 'Avenida Valdir Marcos Rinaldi', 'Vila Bela', 'Franco da Rocha'),
		'07842080' => $daoEndereco->insert('07842080', 'Rua Inglaterra', 'Vila Bela', 'Franco da Rocha'),
		'07842090' => $daoEndereco->insert('07842090', 'Avenida Irlanda', 'Vila Bela', 'Franco da Rocha'),
		'07842110' => $daoEndereco->insert('07842110', 'Viela Nove C', 'Vila Bela', 'Franco da Rocha'),
		'07842120' => $daoEndereco->insert('07842120', 'Avenida Vaticano', 'Vila Bela', 'Franco da Rocha'),
		'07842130' => $daoEndereco->insert('07842130', 'Rua Franca', 'Vila Bela', 'Franco da Rocha'),
		'07842140' => $daoEndereco->insert('07842140', 'Viela Seis', 'Vila Bela', 'Franco da Rocha'),
		'07846000' => $daoEndereco->insert('07846000', 'Avenida São Paulo', 'Vila Bela', 'Franco da Rocha'),
		'07846010' => $daoEndereco->insert('07846010', 'Rua Turquia', 'Vila Bela', 'Franco da Rocha'),
		'07846020' => $daoEndereco->insert('07846020', 'Rua Uruguaia', 'Vila Bela', 'Franco da Rocha'),
		'07846030' => $daoEndereco->insert('07846030', 'Avenida das Bandeiras', 'Vila Bela', 'Franco da Rocha'),
		'07846040' => $daoEndereco->insert('07846040', 'Rua Noruega', 'Vila Bela', 'Franco da Rocha'),
		'07846050' => $daoEndereco->insert('07846050', 'Rua México', 'Vila Bela', 'Franco da Rocha'),
		'07846060' => $daoEndereco->insert('07846060', 'Rua Mônaco', 'Vila Bela', 'Franco da Rocha'),
		'07846070' => $daoEndereco->insert('07846070', 'Avenida Egito', 'Vila Bela', 'Franco da Rocha'),
		'07846080' => $daoEndereco->insert('07846080', 'Rua Holanda', 'Vila Bela', 'Franco da Rocha'),
		'07846090' => $daoEndereco->insert('07846090', 'Rua Tchecoslováquia', 'Vila Bela', 'Franco da Rocha'),
		'07846100' => $daoEndereco->insert('07846100', 'Rua Bulgária', 'Vila Bela', 'Franco da Rocha'),
		'07846110' => $daoEndereco->insert('07846110', 'Rua Argentina', 'Vila Bela', 'Franco da Rocha'),
		'07846120' => $daoEndereco->insert('07846120', 'Rua José Augusto Silva Lopes', 'Vila Bela', 'Franco da Rocha'),
		'07846130' => $daoEndereco->insert('07846130', 'Rua Islândia', 'Vila Bela', 'Franco da Rocha'),
		'07847000' => $daoEndereco->insert('07847000', 'Avenida Giuliano Cecchettini', 'Vila Bela', 'Franco da Rocha'),
		'07847010' => $daoEndereco->insert('07847010', 'Avenida Marrocos', 'Vila Bela', 'Franco da Rocha'),
		'07847020' => $daoEndereco->insert('07847020', 'Viela Um A', 'Vila Bela', 'Franco da Rocha'),
		'07847025' => $daoEndereco->insert('07847025', 'Viela Treze', 'Vila Bela', 'Franco da Rocha'),
		'07847030' => $daoEndereco->insert('07847030', 'Avenida Escócia', 'Vila Bela', 'Franco da Rocha'),
		'07847040' => $daoEndereco->insert('07847040', 'Rua Regente Feijó', 'Vila Bela', 'Franco da Rocha'),
		'07847050' => $daoEndereco->insert('07847050', 'Rua Alemanha', 'Vila Bela', 'Franco da Rocha'),
		'07847060' => $daoEndereco->insert('07847060', 'Rua Suécia', 'Vila Bela', 'Franco da Rocha'),
		'07847070' => $daoEndereco->insert('07847070', 'Avenida Gales', 'Vila Bela', 'Franco da Rocha'),
		'07847080' => $daoEndereco->insert('07847080', 'Rua Finlândia', 'Vila Bela', 'Franco da Rocha'),
		'07847090' => $daoEndereco->insert('07847090', 'Rua Três B', 'Vila Bela', 'Franco da Rocha'),
		'07847100' => $daoEndereco->insert('07847100', 'Rua Hungria', 'Vila Bela', 'Franco da Rocha'),
		'07847110' => $daoEndereco->insert('07847110', 'Viela Iugoslávia', 'Vila Bela', 'Franco da Rocha'),
		'07847120' => $daoEndereco->insert('07847120', 'Rua Chile', 'Vila Bela', 'Franco da Rocha'),
		'07847130' => $daoEndereco->insert('07847130', 'Rua Bélgica', 'Vila Bela', 'Franco da Rocha'),
		'07847140' => $daoEndereco->insert('07847140', 'Avenida Líbia', 'Vila Bela', 'Franco da Rocha'),
		'07847150' => $daoEndereco->insert('07847150', 'Rua Suíça', 'Vila Bela', 'Franco da Rocha'),
		'07847160' => $daoEndereco->insert('07847160', 'Rua Portugal', 'Vila Bela', 'Franco da Rocha'),
		'07847170' => $daoEndereco->insert('07847170', 'Rua Grécia', 'Vila Bela', 'Franco da Rocha'),
		'07847180' => $daoEndereco->insert('07847180', 'Praça Domingos Antonio Lopes', 'Vila Bela', 'Franco da Rocha'),
		'07847200' => $daoEndereco->insert('07847200', 'Avenida Israel', 'Vila Bela', 'Franco da Rocha'),
		'07830460' => $daoEndereco->insert('07830460', 'Estrada Sete Voltas', 'Vila Cariri', 'Franco da Rocha'),
		'07830470' => $daoEndereco->insert('07830470', 'Rua Alfa', 'Vila Cariri', 'Franco da Rocha'),
		'07830480' => $daoEndereco->insert('07830480', 'Rua Beta', 'Vila Cariri', 'Franco da Rocha'),
		'07830490' => $daoEndereco->insert('07830490', 'Rua Gama', 'Vila Cariri', 'Franco da Rocha'),
		'07858030' => $daoEndereco->insert('07858030', 'Rua Leonor Bueno Moraes', 'Vila Carmela de Túlio', 'Franco da Rocha'),
		'07858200' => $daoEndereco->insert('07858200', 'Rua Rancharia', 'Vila Carmela de Túlio', 'Franco da Rocha'),
		'07859050' => $daoEndereco->insert('07859050', 'Rua Vereador Antônio Alba Fernandes', 'Vila Carmela de Túlio', 'Franco da Rocha'),
		'07859051' => $daoEndereco->insert('07859051', 'Rua Jaboticabal', 'Vila Carmela de Túlio', 'Franco da Rocha'),
		'07859060' => $daoEndereco->insert('07859060', 'Viela Três', 'Vila Carmela de Túlio', 'Franco da Rocha'),
		'07859070' => $daoEndereco->insert('07859070', 'Viela Seis', 'Vila Carmela de Túlio', 'Franco da Rocha'),
		'07859090' => $daoEndereco->insert('07859090', 'Viela Quatro', 'Vila Carmela de Túlio', 'Franco da Rocha'),
		'07859110' => $daoEndereco->insert('07859110', 'Rua Caçapava', 'Vila Carmela de Túlio', 'Franco da Rocha'),
		'07859120' => $daoEndereco->insert('07859120', 'Rua Monte Alto', 'Vila Carmela de Túlio', 'Franco da Rocha'),
		'07859130' => $daoEndereco->insert('07859130', 'Viela Dois', 'Vila Carmela de Túlio', 'Franco da Rocha'),
		'07859140' => $daoEndereco->insert('07859140', 'Rua Bebedouro', 'Vila Carmela de Túlio', 'Franco da Rocha'),
		'07859150' => $daoEndereco->insert('07859150', 'Rua Fernandópolis', 'Vila Carmela de Túlio', 'Franco da Rocha'),
		'07859160' => $daoEndereco->insert('07859160', 'Vila Cinco', 'Vila Carmela de Túlio', 'Franco da Rocha'),
		'07859170' => $daoEndereco->insert('07859170', 'Rua Penápolis', 'Vila Carmela de Túlio', 'Franco da Rocha'),
		'07859180' => $daoEndereco->insert('07859180', 'Rua Guaratinguetá', 'Vila Carmela de Túlio', 'Franco da Rocha'),
		'07859200' => $daoEndereco->insert('07859200', 'Rua Pinhal', 'Vila Carmela de Túlio', 'Franco da Rocha'),
		'07859210' => $daoEndereco->insert('07859210', 'Rua Sete', 'Vila Carmela de Túlio', 'Franco da Rocha'),
		'07859220' => $daoEndereco->insert('07859220', 'Rua Pirassununga', 'Vila Carmela de Túlio', 'Franco da Rocha'),
		'07865130' => $daoEndereco->insert('07865130', 'Rua Gabriel Feliciano da Silva', 'Vila dos Comerciários', 'Franco da Rocha'),
		'07865140' => $daoEndereco->insert('07865140', 'Rua Conceição da Silva', 'Vila dos Comerciários', 'Franco da Rocha'),
		'07865150' => $daoEndereco->insert('07865150', 'Rua Paula Francinete da Silva', 'Vila dos Comerciários', 'Franco da Rocha'),
		'07865160' => $daoEndereco->insert('07865160', 'Rua Avelina Fabrello de Sá', 'Vila dos Comerciários', 'Franco da Rocha'),
		'07865170' => $daoEndereco->insert('07865170', 'Rua Roberto Salvador de Almeida', 'Vila dos Comerciários', 'Franco da Rocha'),
		'07865180' => $daoEndereco->insert('07865180', 'Rua Francisco Nunes Filho', 'Vila dos Comerciários', 'Franco da Rocha'),
		'07865190' => $daoEndereco->insert('07865190', 'Rua Emílio Hernandes Aguilar', 'Vila dos Comerciários', 'Franco da Rocha'),
		'07865200' => $daoEndereco->insert('07865200', 'Rua Doutor Flávio Antunes', 'Vila dos Comerciários', 'Franco da Rocha'),
		'07865400' => $daoEndereco->insert('07865400', 'Rua Adrião Exposto', 'Vila Eliza', 'Franco da Rocha'),
		'07865405' => $daoEndereco->insert('07865405', 'Rua Lourenço Rodrigues Coelho', 'Vila Eliza', 'Franco da Rocha'),
		'07865410' => $daoEndereco->insert('07865410', 'Rua Paraná', 'Vila Eliza', 'Franco da Rocha'),
		'07865420' => $daoEndereco->insert('07865420', 'Rua Bahia', 'Vila Eliza', 'Franco da Rocha'),
		'07865430' => $daoEndereco->insert('07865430', 'Rua Rio de Janeiro', 'Vila Eliza', 'Franco da Rocha'),
		'07865440' => $daoEndereco->insert('07865440', 'Rua Pernambuco', 'Vila Eliza', 'Franco da Rocha'),
		'07865450' => $daoEndereco->insert('07865450', 'Rua Pará', 'Vila Eliza', 'Franco da Rocha'),
		'07865460' => $daoEndereco->insert('07865460', 'Rua Maranhão', 'Vila Eliza', 'Franco da Rocha'),
		'07865470' => $daoEndereco->insert('07865470', 'Rua Santa Catarina', 'Vila Eliza', 'Franco da Rocha'),
		'07865480' => $daoEndereco->insert('07865480', 'Rua Rio Grande do Sul', 'Vila Eliza', 'Franco da Rocha'),
		'07865490' => $daoEndereco->insert('07865490', 'Viela Três', 'Vila Eliza', 'Franco da Rocha'),
		'07865500' => $daoEndereco->insert('07865500', 'Rua Ceará', 'Vila Eliza', 'Franco da Rocha'),
		'07865510' => $daoEndereco->insert('07865510', 'Rua Piauí', 'Vila Eliza', 'Franco da Rocha'),
		'07865520' => $daoEndereco->insert('07865520', 'Rua Minas Gerais', 'Vila Eliza', 'Franco da Rocha'),
		'07865530' => $daoEndereco->insert('07865530', 'Rua Amazonas', 'Vila Eliza', 'Franco da Rocha'),
		'07865540' => $daoEndereco->insert('07865540', 'Rua Espírito Santo', 'Vila Eliza', 'Franco da Rocha'),
		'07865550' => $daoEndereco->insert('07865550', 'Avenida União', 'Vila Eliza', 'Franco da Rocha'),
		'07850220' => $daoEndereco->insert('07850220', 'Rua Benjamin Constant', 'Vila Francisco de Tulio', 'Franco da Rocha'),
		'07850230' => $daoEndereco->insert('07850230', 'Rua Floriano Peixoto', 'Vila Francisco de Tulio', 'Franco da Rocha'),
		'07850235' => $daoEndereco->insert('07850235', 'Travessa Armando Salete', 'Vila Francisco de Tulio', 'Franco da Rocha'),
		'07850240' => $daoEndereco->insert('07850240', 'Rua Benedito Martins Prado', 'Vila Francisco de Tulio', 'Franco da Rocha'),
		'07850250' => $daoEndereco->insert('07850250', 'Rua Marechal Deodoro', 'Vila Francisco de Tulio', 'Franco da Rocha'),
		'07850260' => $daoEndereco->insert('07850260', 'Rua Alceu Anzelotti', 'Vila Francisco de Tulio', 'Franco da Rocha'),
		'07850265' => $daoEndereco->insert('07850265', 'Rua Theodora M. Francisca de Sá', 'Vila Francisco de Tulio', 'Franco da Rocha'),
		'07850270' => $daoEndereco->insert('07850270', 'Rua João de Barros', 'Vila Francisco de Tulio', 'Franco da Rocha'),
		'07850280' => $daoEndereco->insert('07850280', 'Rua Aracy Lara Cruz', 'Vila Francisco de Tulio', 'Franco da Rocha'),
		'07858220' => $daoEndereco->insert('07858220', 'Rua Tamoios', 'Vila Guarani', 'Franco da Rocha'),
		'07858230' => $daoEndereco->insert('07858230', 'Rua Tapuias', 'Vila Guarani', 'Franco da Rocha'),
		'07858240' => $daoEndereco->insert('07858240', 'Rua Tupis', 'Vila Guarani', 'Franco da Rocha'),
		'07858250' => $daoEndereco->insert('07858250', 'Rua João Faria', 'Vila Guarani', 'Franco da Rocha'),
		'07858260' => $daoEndereco->insert('07858260', 'Rua Luiz Simionato', 'Vila Guarani', 'Franco da Rocha'),
		'07807210' => $daoEndereco->insert('07807210', 'Rua Rubi', 'Vila Humbelina', 'Franco da Rocha'),
		'07807220' => $daoEndereco->insert('07807220', 'Rua Maria Alves Feitosa', 'Vila Humbelina', 'Franco da Rocha'),
		'07807240' => $daoEndereco->insert('07807240', 'Rua Witesindo Garcia de Freitas', 'Vila Humbelina', 'Franco da Rocha'),
		'07845170' => $daoEndereco->insert('07845170', 'Rua Paschoal Moreira', 'Vila Ida', 'Franco da Rocha'),
		'07845180' => $daoEndereco->insert('07845180', 'Praça Ida', 'Vila Ida', 'Franco da Rocha'),
		'07845190' => $daoEndereco->insert('07845190', 'Rua Antônio Raposo', 'Vila Ida', 'Franco da Rocha'),
		'07845200' => $daoEndereco->insert('07845200', 'Rua Domingos Jorge Velho', 'Vila Ida', 'Franco da Rocha'),
		'07845210' => $daoEndereco->insert('07845210', 'Rua Pedro Vaz de Caminha', 'Vila Ida', 'Franco da Rocha'),
		'07845220' => $daoEndereco->insert('07845220', 'Rua Borba Gato', 'Vila Ida', 'Franco da Rocha'),
		'07845230' => $daoEndereco->insert('07845230', 'Rua Fernão Dias', 'Vila Ida', 'Franco da Rocha'),
		'07849050' => $daoEndereco->insert('07849050', 'Rua Paoli', 'Vila Irma', 'Franco da Rocha'),
		'07849060' => $daoEndereco->insert('07849060', 'Rua Mercúrio', 'Vila Irma', 'Franco da Rocha'),
		'07849070' => $daoEndereco->insert('07849070', 'Rua Wilson Garbeline', 'Vila Irma', 'Franco da Rocha'),
		'07849080' => $daoEndereco->insert('07849080', 'Rua Vênus', 'Vila Irma', 'Franco da Rocha'),
		'07849085' => $daoEndereco->insert('07849085', 'Rua Marte', 'Vila Irma', 'Franco da Rocha'),
		'07849090' => $daoEndereco->insert('07849090', 'Rua David Francisco de Oliveira', 'Vila Irma', 'Franco da Rocha'),
		'07849100' => $daoEndereco->insert('07849100', 'Rua Urano', 'Vila Irma', 'Franco da Rocha'),
		'07849110' => $daoEndereco->insert('07849110', 'Rua Neturno', 'Vila Irma', 'Franco da Rocha'),
		'07849120' => $daoEndereco->insert('07849120', 'Rua Plutão', 'Vila Irma', 'Franco da Rocha'),
		'07849130' => $daoEndereco->insert('07849130', 'Rua Júpiter', 'Vila Irma', 'Franco da Rocha'),
		'07849140' => $daoEndereco->insert('07849140', 'Rua Noruega', 'Vila Irma', 'Franco da Rocha'),
		'07849145' => $daoEndereco->insert('07849145', 'Viela Irma', 'Vila Irma', 'Franco da Rocha'),
		'07849190' => $daoEndereco->insert('07849190', 'Rua Dona Ana Nunes Barbosa', 'Vila Irma', 'Franco da Rocha'),
		'07841000' => $daoEndereco->insert('07841000', 'Rua Apolo', 'Vila Josefina', 'Franco da Rocha'),
		'07841010' => $daoEndereco->insert('07841010', 'Rua Ana', 'Vila Josefina', 'Franco da Rocha'),
		'07841020' => $daoEndereco->insert('07841020', 'Avenida D', 'Vila Josefina', 'Franco da Rocha'),
		'07841030' => $daoEndereco->insert('07841030', 'Rua Prometeu', 'Vila Josefina', 'Franco da Rocha'),
		'07841040' => $daoEndereco->insert('07841040', 'Rua Tiresias', 'Vila Josefina', 'Franco da Rocha'),
		'07841050' => $daoEndereco->insert('07841050', 'Viela A', 'Vila Josefina', 'Franco da Rocha'),
		'07841060' => $daoEndereco->insert('07841060', 'Viela B', 'Vila Josefina', 'Franco da Rocha'),
		'07841080' => $daoEndereco->insert('07841080', 'Rua Alcmene', 'Vila Josefina', 'Franco da Rocha'),
		'07841100' => $daoEndereco->insert('07841100', 'Rua Hércules', 'Vila Josefina', 'Franco da Rocha'),
		'07841110' => $daoEndereco->insert('07841110', 'Viela E', 'Vila Josefina', 'Franco da Rocha'),
		'07841120' => $daoEndereco->insert('07841120', 'Rua do Parque', 'Vila Josefina', 'Franco da Rocha'),
		'07841130' => $daoEndereco->insert('07841130', 'Rua Fhidias', 'Vila Josefina', 'Franco da Rocha'),
		'07860420' => $daoEndereco->insert('07860420', 'Rua Marechal Batista Mascarenhas de Moraes', 'Vila Lanfranchi', 'Franco da Rocha'),
		'07860421' => $daoEndereco->insert('07860421', 'Rua Baptista Misson', 'Vila Lanfranchi', 'Franco da Rocha'),
		'07860430' => $daoEndereco->insert('07860430', 'Rua Porto Alegre', 'Vila Lanfranchi', 'Franco da Rocha'),
		'07861000' => $daoEndereco->insert('07861000', 'Rua Jorge Vieira de Andrade', 'Vila Lanfranchi', 'Franco da Rocha'),
		'07861060' => $daoEndereco->insert('07861060', 'Rua Elvira Maggi', 'Vila Lanfranchi', 'Franco da Rocha'),
		'07861070' => $daoEndereco->insert('07861070', 'Rua Curitiba', 'Vila Lanfranchi', 'Franco da Rocha'),
		'07861080' => $daoEndereco->insert('07861080', 'Avenida Juscelino Kubitschek de Oliveira', 'Vila Lanfranchi', 'Franco da Rocha'),
		'07861090' => $daoEndereco->insert('07861090', 'Rua João Lanfranchi', 'Vila Lanfranchi', 'Franco da Rocha'),
		'07861100' => $daoEndereco->insert('07861100', 'Rua Onofre Lanfranchi', 'Vila Lanfranchi', 'Franco da Rocha'),
		'07861110' => $daoEndereco->insert('07861110', 'Avenida Belo Horizonte', 'Vila Lanfranchi', 'Franco da Rocha'),
		'07861115' => $daoEndereco->insert('07861115', 'Avenida Porto Velho', 'Vila Lanfranchi', 'Franco da Rocha'),
		'07861120' => $daoEndereco->insert('07861120', 'Rua Cuiabá', 'Vila Lanfranchi', 'Franco da Rocha'),
		'07861125' => $daoEndereco->insert('07861125', 'Viela Projetada Quatro', 'Vila Lanfranchi', 'Franco da Rocha'),
		'07861130' => $daoEndereco->insert('07861130', 'Rua Gracina Cardoso dos Santos', 'Vila Lanfranchi', 'Franco da Rocha'),
		'07861140' => $daoEndereco->insert('07861140', 'Rua Oscar Wilde', 'Vila Lanfranchi', 'Franco da Rocha'),
		'07861150' => $daoEndereco->insert('07861150', 'Rua José Seixas Vieira', 'Vila Lanfranchi', 'Franco da Rocha'),
		'07861155' => $daoEndereco->insert('07861155', 'Rua Dinorah Grecco Molon', 'Vila Lanfranchi', 'Franco da Rocha'),
		'07861160' => $daoEndereco->insert('07861160', 'Rua Recife', 'Vila Lanfranchi', 'Franco da Rocha'),
		'07861210' => $daoEndereco->insert('07861210', 'Rua Fortaleza', 'Vila Lanfranchi', 'Franco da Rocha'),
		'07861230' => $daoEndereco->insert('07861230', 'Rua Goiana', 'Vila Lanfranchi', 'Franco da Rocha'),
		'07861260' => $daoEndereco->insert('07861260', 'Rua das Palmeiras', 'Vila Lanfranchi', 'Franco da Rocha'),
		'07861270' => $daoEndereco->insert('07861270', 'Rua das Avencas', 'Vila Lanfranchi', 'Franco da Rocha'),
		'07853190' => $daoEndereco->insert('07853190', 'Rua Madeira', 'Vila Lemar', 'Franco da Rocha'),
		'07853200' => $daoEndereco->insert('07853200', 'Rua Copérnico', 'Vila Lemar', 'Franco da Rocha'),
		'07853210' => $daoEndereco->insert('07853210', 'Rua Canárias', 'Vila Lemar', 'Franco da Rocha'),
		'07853215' => $daoEndereco->insert('07853215', 'Viela Venceslau Antônio da Silva', 'Vila Lemar', 'Franco da Rocha'),
		'07830510' => $daoEndereco->insert('07830510', 'Rodovia Tancredo de Almeida Neves', 'Vila Leopolis', 'Franco da Rocha'),
		'07832160' => $daoEndereco->insert('07832160', 'Avenida Belém', 'Vila Leopolis', 'Franco da Rocha'),
		'07832165' => $daoEndereco->insert('07832165', 'Praça Marechal Deodoro', 'Vila Leopolis', 'Franco da Rocha'),
		'07832170' => $daoEndereco->insert('07832170', 'Rua Maria Lúcia', 'Vila Leopolis', 'Franco da Rocha'),
		'07832175' => $daoEndereco->insert('07832175', 'Praça Santo Antonio', 'Vila Leopolis', 'Franco da Rocha'),
		'07832180' => $daoEndereco->insert('07832180', 'Rua Himalaia', 'Vila Leopolis', 'Franco da Rocha'),
		'07832185' => $daoEndereco->insert('07832185', 'Rua Antonio Andrade de Matos', 'Vila Leopolis', 'Franco da Rocha'),
		'07832190' => $daoEndereco->insert('07832190', 'Rua Princesa Isabel', 'Vila Leopolis', 'Franco da Rocha'),
		'07832195' => $daoEndereco->insert('07832195', 'Rua Sebastião Pinto Ferreira', 'Vila Leopolis', 'Franco da Rocha'),
		'07832200' => $daoEndereco->insert('07832200', 'Rua Urais', 'Vila Leopolis', 'Franco da Rocha'),
		'07832205' => $daoEndereco->insert('07832205', 'Rua Vesúvio', 'Vila Leopolis', 'Franco da Rocha'),
		'07832210' => $daoEndereco->insert('07832210', 'Rua Ademar de Barros', 'Vila Leopolis', 'Franco da Rocha'),
		'07832215' => $daoEndereco->insert('07832215', 'Travessa Leópolis', 'Vila Leopolis', 'Franco da Rocha'),
		'07832220' => $daoEndereco->insert('07832220', 'Rua Alpes', 'Vila Leopolis', 'Franco da Rocha'),
		'07832230' => $daoEndereco->insert('07832230', 'Rua Antonio Carlos', 'Vila Leopolis', 'Franco da Rocha'),
		'07832240' => $daoEndereco->insert('07832240', 'Praça Antonio', 'Vila Leopolis', 'Franco da Rocha'),
		'07832250' => $daoEndereco->insert('07832250', 'Rua Evereste', 'Vila Leopolis', 'Franco da Rocha'),
		'07832260' => $daoEndereco->insert('07832260', 'Rua Dois', 'Vila Leopolis', 'Franco da Rocha'),
		'07832270' => $daoEndereco->insert('07832270', 'Rua Três', 'Vila Leopolis', 'Franco da Rocha'),
		'07832280' => $daoEndereco->insert('07832280', 'Rua Quatro', 'Vila Leopolis', 'Franco da Rocha'),
		'07832290' => $daoEndereco->insert('07832290', 'Rua Cinco', 'Vila Leopolis', 'Franco da Rocha'),
		'07832295' => $daoEndereco->insert('07832295', 'Acesso Francisco Morato', 'Vila Leopolis', 'Franco da Rocha'),
		'07832300' => $daoEndereco->insert('07832300', 'Avenida Rafael Andrade de Matos', 'Vila Leopolis', 'Franco da Rocha'),
		'07832395' => $daoEndereco->insert('07832395', 'Rua Um', 'Vila Leopolis', 'Franco da Rocha'),
		'07857110' => $daoEndereco->insert('07857110', 'Rua Joaquim Nabuco', 'Vila Machado', 'Franco da Rocha'),
		'07857120' => $daoEndereco->insert('07857120', 'Rua Felipe Camarão', 'Vila Machado', 'Franco da Rocha'),
		'07857130' => $daoEndereco->insert('07857130', 'Rua Henrique Dias', 'Vila Machado', 'Franco da Rocha'),
		'07857150' => $daoEndereco->insert('07857150', 'Rua Mauá', 'Vila Machado', 'Franco da Rocha'),
		'07857160' => $daoEndereco->insert('07857160', 'Rua Matias de Albuquerque', 'Vila Machado', 'Franco da Rocha'),
		'07857170' => $daoEndereco->insert('07857170', 'Rua Brandino Bueno de Moraes', 'Vila Machado', 'Franco da Rocha'),
		'07857180' => $daoEndereco->insert('07857180', 'Rua Termorilas', 'Vila Machado', 'Franco da Rocha'),
		'07857190' => $daoEndereco->insert('07857190', 'Rua Marechal Arthur da Costa e Silva', 'Vila Machado', 'Franco da Rocha'),
		'07857200' => $daoEndereco->insert('07857200', 'Rua Guilherme de Almeida', 'Vila Machado', 'Franco da Rocha'),
		'07857210' => $daoEndereco->insert('07857210', 'Rua Júlio Mesquita Filho', 'Vila Machado', 'Franco da Rocha'),
		'07857218' => $daoEndereco->insert('07857218', 'Rua Gonçalves Ledo', 'Vila Machado', 'Franco da Rocha'),
		'07857220' => $daoEndereco->insert('07857220', 'Rua Vinte e Um de Abril', 'Vila Machado', 'Franco da Rocha'),
		'07850300' => $daoEndereco->insert('07850300', 'Rua Cinco de Maio', 'Vila Maggi', 'Franco da Rocha'),
		'07849200' => $daoEndereco->insert('07849200', 'Rua Tomé de Souza', 'Vila Margarida', 'Franco da Rocha'),
		'07849210' => $daoEndereco->insert('07849210', 'Rua General Rondon', 'Vila Margarida', 'Franco da Rocha'),
		'07852000' => $daoEndereco->insert('07852000', 'Avenida Sete de Setembro', 'Vila Martinho', 'Franco da Rocha'),
		'07852010' => $daoEndereco->insert('07852010', 'Rua Hercílio Caetano Pereira', 'Vila Martinho', 'Franco da Rocha'),
		'07852020' => $daoEndereco->insert('07852020', 'Rua Pantaleão Anzelotti', 'Vila Martinho', 'Franco da Rocha'),
		'07852030' => $daoEndereco->insert('07852030', 'Rua Marino Tardelli', 'Vila Martinho', 'Franco da Rocha'),
		'07852040' => $daoEndereco->insert('07852040', 'Rua Domingos Nogueira da Silva', 'Vila Martinho', 'Franco da Rocha'),
		'07852050' => $daoEndereco->insert('07852050', 'Rua Manoel do Valle', 'Vila Martinho', 'Franco da Rocha'),
		'07852060' => $daoEndereco->insert('07852060', 'Rua Everton Ferreira Libório', 'Vila Martinho', 'Franco da Rocha'),
		'07807250' => $daoEndereco->insert('07807250', 'Rua Campos Sales', 'Vila Olinda', 'Franco da Rocha'),
		'07807360' => $daoEndereco->insert('07807360', 'Rua Arthur Bernardes', 'Vila Olinda', 'Franco da Rocha'),
		'07807365' => $daoEndereco->insert('07807365', 'Rua Rangel Pestana', 'Vila Olinda', 'Franco da Rocha'),
		'07807370' => $daoEndereco->insert('07807370', 'Rua Bragança', 'Vila Olinda', 'Franco da Rocha'),
		'07807380' => $daoEndereco->insert('07807380', 'Rua Palmares', 'Vila Olinda', 'Franco da Rocha'),
		'07807390' => $daoEndereco->insert('07807390', 'Rua Gravatá', 'Vila Olinda', 'Franco da Rocha'),
		'07807400' => $daoEndereco->insert('07807400', 'Rua Euclides da Cunha', 'Vila Olinda', 'Franco da Rocha'),
		'07807410' => $daoEndereco->insert('07807410', 'Rua Sérgio Lopes', 'Vila Olinda', 'Franco da Rocha'),
		'07807430' => $daoEndereco->insert('07807430', 'Rua Afonso Pena', 'Vila Olinda', 'Franco da Rocha'),
		'07808010' => $daoEndereco->insert('07808010', 'Rua Bosque da Fonte de Cristal', 'Vila Olinda', 'Franco da Rocha'),
		'07808030' => $daoEndereco->insert('07808030', 'Rua Epitácio Pessoa', 'Vila Olinda', 'Franco da Rocha'),
		'07808035' => $daoEndereco->insert('07808035', 'Rua Rodrigues Alves', 'Vila Olinda', 'Franco da Rocha'),
		'07808040' => $daoEndereco->insert('07808040', 'Rua Pinheiro Machado', 'Vila Olinda', 'Franco da Rocha'),
		'07808045' => $daoEndereco->insert('07808045', 'Rua Hermes da Fonseca', 'Vila Olinda', 'Franco da Rocha'),
		'07808050' => $daoEndereco->insert('07808050', 'Rua Maria Rosa Scolfaro', 'Vila Olinda', 'Franco da Rocha'),
		'07863000' => $daoEndereco->insert('07863000', 'Estrada Municipal Ettore Palma', 'Vila Palmares', 'Franco da Rocha'),
		'07863010' => $daoEndereco->insert('07863010', 'Rua Edgar Alvarado Machado', 'Vila Palmares', 'Franco da Rocha'),
		'07863020' => $daoEndereco->insert('07863020', 'Rua Domingos Alves Barreto', 'Vila Palmares', 'Franco da Rocha'),
		'07863030' => $daoEndereco->insert('07863030', 'Rua Hortênsia', 'Vila Palmares', 'Franco da Rocha'),
		'07863040' => $daoEndereco->insert('07863040', 'Rua Doutor José Gomes Santos', 'Vila Palmares', 'Franco da Rocha'),
		'07863050' => $daoEndereco->insert('07863050', 'Rua Dália', 'Vila Palmares', 'Franco da Rocha'),
		'07863060' => $daoEndereco->insert('07863060', 'Rua Flor de Maio', 'Vila Palmares', 'Franco da Rocha'),
		'07863070' => $daoEndereco->insert('07863070', 'Rua Copo de Leite', 'Vila Palmares', 'Franco da Rocha'),
		'07863080' => $daoEndereco->insert('07863080', 'Rua das Bromélias', 'Vila Palmares', 'Franco da Rocha'),
		'07863090' => $daoEndereco->insert('07863090', 'Rua Primavera', 'Vila Palmares', 'Franco da Rocha'),
		'07863100' => $daoEndereco->insert('07863100', 'Rua do Amor Perfeito', 'Vila Palmares', 'Franco da Rocha'),
		'07857000' => $daoEndereco->insert('07857000', 'Rua Trinta de Novembro', 'Vila Ramos', 'Franco da Rocha'),
		'07857010' => $daoEndereco->insert('07857010', 'Praça Antônio Teixeira', 'Vila Ramos', 'Franco da Rocha'),
		'07857040' => $daoEndereco->insert('07857040', 'Praça Nossa Senhora de Fátima', 'Vila Ramos', 'Franco da Rocha'),
		'07857050' => $daoEndereco->insert('07857050', 'Rodovia Luiz Salomão Chama', 'Vila Ramos', 'Franco da Rocha'),
		'07857060' => $daoEndereco->insert('07857060', 'Rua Valdomiro Silva Ramos', 'Vila Ramos', 'Franco da Rocha'),
		'07857070' => $daoEndereco->insert('07857070', 'Estrada do Governo', 'Vila Ramos', 'Franco da Rocha'),
		'07857080' => $daoEndereco->insert('07857080', 'Rua Jaime Duprat', 'Vila Ramos', 'Franco da Rocha'),
		'07857900' => $daoEndereco->insert('07857900', 'Rodovia Luiz Salomão Chama, Km 45', 'Vila Ramos', 'Franco da Rocha'),
		'07858510' => $daoEndereco->insert('07858510', 'Praça Ramos', 'Vila Ramos', 'Franco da Rocha'),
		'07858520' => $daoEndereco->insert('07858520', 'Vila Particular', 'Vila Ramos', 'Franco da Rocha'),
		'07858530' => $daoEndereco->insert('07858530', 'Viela Particular Lerussi', 'Vila Ramos', 'Franco da Rocha'),
		'07858540' => $daoEndereco->insert('07858540', 'Viela Passagem Servidão', 'Vila Ramos', 'Franco da Rocha'),
		'07858550' => $daoEndereco->insert('07858550', 'Rua Josias de Souza Lima', 'Vila Ramos', 'Franco da Rocha'),
		'07858560' => $daoEndereco->insert('07858560', 'Rua Benedito Soares Capelo', 'Vila Ramos', 'Franco da Rocha'),
		'07858595' => $daoEndereco->insert('07858595', 'Rua Henrique Lirussi', 'Vila Ramos', 'Franco da Rocha'),
		'07857240' => $daoEndereco->insert('07857240', 'Rua Pitágoras', 'Vila Rodrigues', 'Franco da Rocha'),
		'07807260' => $daoEndereco->insert('07807260', 'Rua dos Reis', 'Vila Rosa', 'Franco da Rocha'),
		'07807270' => $daoEndereco->insert('07807270', 'Rua Rio Branco', 'Vila Rosa', 'Franco da Rocha'),
		'07807280' => $daoEndereco->insert('07807280', 'Rua Infante', 'Vila Rosa', 'Franco da Rocha'),
		'07807290' => $daoEndereco->insert('07807290', 'Rua Vitória', 'Vila Rosa', 'Franco da Rocha'),
		'07807300' => $daoEndereco->insert('07807300', 'Rua Eduardo Theodoro de Freitas', 'Vila Rosa', 'Franco da Rocha'),
		'07807310' => $daoEndereco->insert('07807310', 'Viela B', 'Vila Rosa', 'Franco da Rocha'),
		'07807320' => $daoEndereco->insert('07807320', 'Viela C', 'Vila Rosa', 'Franco da Rocha'),
		'07807330' => $daoEndereco->insert('07807330', 'Rua dos Príncipes', 'Vila Rosa', 'Franco da Rocha'),
		'07807340' => $daoEndereco->insert('07807340', 'Rua Imperador', 'Vila Rosa', 'Franco da Rocha'),
		'07807349' => $daoEndereco->insert('07807349', 'Rua Regente', 'Vila Rosa', 'Franco da Rocha'),
		'07807350' => $daoEndereco->insert('07807350', 'Rua Presidente', 'Vila Rosa', 'Franco da Rocha'),
		'07861030' => $daoEndereco->insert('07861030', 'Rua Atlas', 'Vila Rosa', 'Franco da Rocha'),
		'07861040' => $daoEndereco->insert('07861040', 'Rua Girassol', 'Vila Rosa', 'Franco da Rocha'),
		'07807050' => $daoEndereco->insert('07807050', 'Rua Elias Chicone', 'Vila Rosalina', 'Franco da Rocha'),
		'07807055' => $daoEndereco->insert('07807055', 'Rua Cleiton Rodrigues de Brito', 'Vila Rosalina', 'Franco da Rocha'),
		'07807060' => $daoEndereco->insert('07807060', 'Rua Padre Egídio José Porto', 'Vila Rosalina', 'Franco da Rocha'),
		'07807065' => $daoEndereco->insert('07807065', 'Viela Evilásio Ramos', 'Vila Rosalina', 'Franco da Rocha'),
		'07807070' => $daoEndereco->insert('07807070', 'Rua Nelson Grego', 'Vila Rosalina', 'Franco da Rocha'),
		'07807080' => $daoEndereco->insert('07807080', 'Avenida Joana Assenco Anzellotti', 'Vila Rosalina', 'Franco da Rocha'),
		'07807090' => $daoEndereco->insert('07807090', 'Rua José Nicodemo', 'Vila Rosalina', 'Franco da Rocha'),
		'07807110' => $daoEndereco->insert('07807110', 'Rua Padre Achiles Sylvestre', 'Vila Rosalina', 'Franco da Rocha'),
		'07807120' => $daoEndereco->insert('07807120', 'Rua Edemar Fonseca', 'Vila Rosalina', 'Franco da Rocha'),
		'07807130' => $daoEndereco->insert('07807130', 'Rua Luiz Tariza Vargas', 'Vila Rosalina', 'Franco da Rocha'),
		'07807140' => $daoEndereco->insert('07807140', 'Viela Doze', 'Vila Rosalina', 'Franco da Rocha'),
		'07807150' => $daoEndereco->insert('07807150', 'Rua Professor Domingos Cambiaghi', 'Vila Rosalina', 'Franco da Rocha'),
		'07807160' => $daoEndereco->insert('07807160', 'Rua Marcelino José da Rosa', 'Vila Rosalina', 'Franco da Rocha'),
		'07807170' => $daoEndereco->insert('07807170', 'Rua José Fontes', 'Vila Rosalina', 'Franco da Rocha'),
		'07808280' => $daoEndereco->insert('07808280', 'Rua Melânio José de Sá', 'Vila Rosemeire', 'Franco da Rocha'),
		'07808290' => $daoEndereco->insert('07808290', 'Rua Peloponeso', 'Vila Rosemeire', 'Franco da Rocha'),
		'07808300' => $daoEndereco->insert('07808300', 'Rua Tróia', 'Vila Rosemeire', 'Franco da Rocha'),
		'07808310' => $daoEndereco->insert('07808310', 'Rua Ática', 'Vila Rosemeire', 'Franco da Rocha'),
		'07809000' => $daoEndereco->insert('07809000', 'Avenida Prefeito Ângelo Celeguim', 'Vila Santista', 'Franco da Rocha'),
		'07809040' => $daoEndereco->insert('07809040', 'Rua Amador Bueno', 'Vila Santista', 'Franco da Rocha'),
		'07809050' => $daoEndereco->insert('07809050', 'Rua José Paulo da Silva', 'Vila Santista', 'Franco da Rocha'),
		'07809060' => $daoEndereco->insert('07809060', 'Rua Braz Cubas', 'Vila Santista', 'Franco da Rocha'),
		'07809070' => $daoEndereco->insert('07809070', 'Rua Nelson Bino', 'Vila Santista', 'Franco da Rocha'),
		'07809080' => $daoEndereco->insert('07809080', 'Rua Fazenda Belém', 'Vila Santista', 'Franco da Rocha'),
		'07809090' => $daoEndereco->insert('07809090', 'Rua Luiz Uvaldo Gonçalves', 'Vila Santista', 'Franco da Rocha'),
		'07803160' => $daoEndereco->insert('07803160', 'Rua Gracinda Ramos', 'Vila São Benedito', 'Franco da Rocha'),
		'07804220' => $daoEndereco->insert('07804220', 'Rua Vereador Benedito Pinto Machado', 'Vila São Benedito', 'Franco da Rocha'),
		'07804240' => $daoEndereco->insert('07804240', 'Rua Faustina Oliveira Benedito', 'Vila São Benedito', 'Franco da Rocha'),
		'07804250' => $daoEndereco->insert('07804250', 'Rua Alceu Vamosy', 'Vila São Benedito', 'Franco da Rocha'),
		'07804260' => $daoEndereco->insert('07804260', 'Rua Fagundes Varella', 'Vila São Benedito', 'Franco da Rocha'),
		'07804280' => $daoEndereco->insert('07804280', 'Rua Castro Alves', 'Vila São Benedito', 'Franco da Rocha'),
		'07804290' => $daoEndereco->insert('07804290', 'Travessa Luís Manoel da Silva', 'Vila São Benedito', 'Franco da Rocha'),
		'07804300' => $daoEndereco->insert('07804300', 'Rua Olavo Bilac', 'Vila São Benedito', 'Franco da Rocha'),
		'07803020' => $daoEndereco->insert('07803020', 'Rua Ernest Steinkopff', 'Vila Vera Cruz', 'Franco da Rocha'),
		'07803030' => $daoEndereco->insert('07803030', 'Praça Caieiras', 'Vila Vera Cruz', 'Franco da Rocha'),
		'07803045' => $daoEndereco->insert('07803045', 'Rua Engenheiro João Batista Garcez', 'Vila Vera Cruz', 'Franco da Rocha'),
		'07803050' => $daoEndereco->insert('07803050', 'Rua General Vicente de Paula Coutinho', 'Vila Vera Cruz', 'Franco da Rocha'),
		'07803060' => $daoEndereco->insert('07803060', 'Rua João Victor Júnior', 'Vila Vera Cruz', 'Franco da Rocha'),
		'07803070' => $daoEndereco->insert('07803070', 'Rua Francisco Pessolano', 'Vila Vera Cruz', 'Franco da Rocha'),
		'07850000' => $daoEndereco->insert('07850000', 'Avenida Donald Savazoni', 'Vila Zanela', 'Franco da Rocha'),
		'07850020' => $daoEndereco->insert('07850020', 'Rua Francisco Garcia', 'Vila Zanela', 'Franco da Rocha'),
		'07850040' => $daoEndereco->insert('07850040', 'Rua Ruy Barbosa', 'Vila Zanela', 'Franco da Rocha'),
		'07850050' => $daoEndereco->insert('07850050', 'Rua José Bonifácio', 'Vila Zanela', 'Franco da Rocha'),
		'07850060' => $daoEndereco->insert('07850060', 'Rua Antônio Celeguim', 'Vila Zanela', 'Franco da Rocha'),
		'07850061' => $daoEndereco->insert('07850061', 'Rua Doutor Emílio Marcondes Ribas', 'Vila Zanela', 'Franco da Rocha'),
		'07850062' => $daoEndereco->insert('07850062', 'Viela São Cristóvão', 'Vila Zanela', 'Franco da Rocha'),
		'07850063' => $daoEndereco->insert('07850063', 'Rua Porfírio dos Passos', 'Vila Zanela', 'Franco da Rocha'),
		'07850064' => $daoEndereco->insert('07850064', 'Rua Indalécio G. da Cunha', 'Vila Zanela', 'Franco da Rocha'),
		'07850070' => $daoEndereco->insert('07850070', 'Rua Vista Alegre', 'Vila Zanela', 'Franco da Rocha'),
		'07850080' => $daoEndereco->insert('07850080', 'Avenida Dom Pedro II', 'Vila Zanela', 'Franco da Rocha'),
		'07850150' => $daoEndereco->insert('07850150', 'Rua Imperatriz Leolpodina', 'Vila Zanela', 'Franco da Rocha'),
		'07850151' => $daoEndereco->insert('07850151', 'Rua Olívio Waldemarin', 'Vila Zanela', 'Franco da Rocha'),
		'07850155' => $daoEndereco->insert('07850155', 'Rua Chavantes', 'Vila Zanela', 'Franco da Rocha'),
		'07851000' => $daoEndereco->insert('07851000', 'Avenida Doutor Franco da Rocha', 'Vila Zanela', 'Franco da Rocha'),
		'07851040' => $daoEndereco->insert('07851040', 'Rua Coronel Domingos Ortiz', 'Vila Zanela', 'Franco da Rocha'),
		'07813000' => $daoEndereco->insert('07813000', 'Avenida Villa Verde', 'Villa Verde', 'Franco da Rocha'),
		'07813010' => $daoEndereco->insert('07813010', 'Rua Begônia', 'Villa Verde', 'Franco da Rocha'),
		'07813020' => $daoEndereco->insert('07813020', 'Rua Clívia', 'Villa Verde', 'Franco da Rocha'),
		'07813030' => $daoEndereco->insert('07813030', 'Rua Ninféia', 'Villa Verde', 'Franco da Rocha'),
		'07813040' => $daoEndereco->insert('07813040', 'Rua Alamanda', 'Villa Verde', 'Franco da Rocha'),
		'07813050' => $daoEndereco->insert('07813050', 'Rua Primavera', 'Villa Verde', 'Franco da Rocha'),
		'07813055' => $daoEndereco->insert('07813055', 'Rua Camélia', 'Villa Verde', 'Franco da Rocha'),
		'07813060' => $daoEndereco->insert('07813060', 'Rua Bromélia', 'Villa Verde', 'Franco da Rocha'),
		'07813070' => $daoEndereco->insert('07813070', 'Rua Dracena', 'Villa Verde', 'Franco da Rocha'),
		'07813080' => $daoEndereco->insert('07813080', 'Rua Gardênia', 'Villa Verde', 'Franco da Rocha'),
		'07813090' => $daoEndereco->insert('07813090', 'Rua Petúnia', 'Villa Verde', 'Franco da Rocha'),
		'07813100' => $daoEndereco->insert('07813100', 'Rua Hibisco', 'Villa Verde', 'Franco da Rocha'),
		'07813110' => $daoEndereco->insert('07813110', 'Rua Azaléia', 'Villa Verde', 'Franco da Rocha'),
		'07813120' => $daoEndereco->insert('07813120', 'Rua Jasmin', 'Villa Verde', 'Franco da Rocha'),
		'07813130' => $daoEndereco->insert('07813130', 'Viela Três', 'Villa Verde', 'Franco da Rocha'),
		'07813140' => $daoEndereco->insert('07813140', 'Rua Girassol', 'Villa Verde', 'Franco da Rocha'),
		'07813150' => $daoEndereco->insert('07813150', 'Rua Rosas', 'Villa Verde', 'Franco da Rocha')
	);
	$ceps = array();
	foreach ($enderecos as $endereco){
		$ceps[] = $endereco->getCep();
	}
	
	echo '<h2>Residenciais</h2>';
	$residenciais = array();
	for ($i=0; $i<$limit; $i++){
		$fixed_i = $i>>3;
		$cep = randomItem($ceps);
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
	for ($i=0; $i<$limit*2; $i++){
		$nome = genRandomPersonName();
		
		// Generating cpf
		$cpf = str_pad(''.rand(0, 999999999), 9, '0', STR_PAD_LEFT);
		$acu_v1 = 0;
		for ($s=0; $s<9; $s++){
			$digit = $cpf[$s];
			$acu_v1 += $digit*(10-$s);
		}
		$ver1 = (11 - ($acu_v1%11));
		$ver1 = $ver1>=10? 0: $ver1;
		$cpf .= $ver1;
		
		$acu_v2 = 0;
		for ($s=0; $s<10; $s++){
			$digit = $cpf[$s];
			$acu_v2 += $digit*(11-$s);
		}
		$ver2 = (11 - ($acu_v2%11));
		$ver2 = $ver2>=10? 0: $ver2;
		$cpf .= $ver2;
		
		$civis_casa[] = randomItem($casas);
		$civis[] = $daoCivil->insert(randomItem($residenciais, true), $nome, genRandomEmail($nome), '', $cpf, '119'.substr(hexdec(hash('sha256', 'celular:'.$i)).'', 2, 8), '11'.substr(hexdec(hash('sha256', 'telefone:'.$i)).'', 2, 8));
	}
	
	echo '<h2>Ocorrencias</h2>';
	$ocorrencias = array();
	$ocorrencias_casas = array();
	for ($i=0; $i<$limit; $i++){
		$data = genRandomDate();
		$aprovado = ($i%3)==0? 1: 0;
		$desaprovado = $i&1;
		$ocorrencias_casas[] = randomItem($civis_casa);
		$ocorrencias[] = $daoOcorrencia->insert(null, $aprovado? $tecnicos[$i>>1]: null, randomItem($civis, true), new Residencial(randomItem($civis_casa, true)->getIdResidencial(), '', ''), (($i&1) == 0? "telefone": "presencial"), $relatos[$i%count($relatos)].' #'.$i, 1, $aprovado? 1: 0, $aprovado? 1: ($desaprovado), $data->format('Y-m-d H:i:s'));
	}
	
	echo '<h2>Relatorios</h2>';
	$relatorios = array();
	for ($i=0; $i<($limit/3); $i++){
		$data1 = genRandomDate();
		$data2 = genRandomDate();
		// casa_id must be non repetible
		$relatorios[] = $daoRelatorio->insert($ocorrencias[floor($i/3)], $ocorrencias_casas[floor($i/3)], $i%3, "Relatório".$i, "Assunto".$i, "Observações".$i, AREA_AFETADA::PARTICULAR, TIPO_CONSTRUCAO::MADEIRA, TIPO_TALUDE::NATURAL, VEGETACAO::NENHUMA, rand(0, 100)<20? INTERDICAO::NAO: (rand(0, 75)? INTERDICAO::PARCIAL: INTERDICAO::TOTAL), SITUACAO_VITIMAS::DESABRIGADOS, ($i&1) != 0, $data1->format('Y-m-d H:i:s'), $data2->format('Y-m-d H:i:s'), '', '', '');
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
		$memos[] = $daoMemo->insert($relatorios[$i], $secretarias[$i], $data->format('Y-m-d H:i:s'), 'Status'.$i, 'setor'.$i, "nº: ".($i+1)."/2024", "Ofício".$i, 'processo'.$i);
	}
	
	echo '<h2>LocalAjuda</h2>';
	$localAjuda = array();
	for ($i=0; $i<($limit>>5); $i++){
		$fixed_i = $i<<2;
		$cep = randomItem($ceps);
		$localAjuda[] = $daoLocalAjuda->insert($cep, 'TIPO'.$i, 'conteudo'.$i);
	}
	
	echo '<h2>Pluviometros</h2>';
	$pluviometros = array();
	for ($i=0; $i<(($limit>>4)+1); $i++){
		$fixed_i = $i>>3;
		$cep = randomItem($ceps);
		$pluviometros[] = $daoPluviometro->insert($cep, '71bff9bd7d44d5b48f201d6e0129035ebbb912127bc7d6361577c13f68147ad2', '', 0.5*$i, 1.5*$i);
	}
	
	echo '<h2>Fluviometros</h2>';
	$fluviometros = array();
	for ($i=0; $i<(($limit>>4)+1); $i++){
		$fixed_i = $i>>3;
		$cep = randomItem($ceps);
		$fluviometros[] = $daoFluviometro->insert($cep, '71bff9bd7d44d5b48f201d6e0129035ebbb912127bc7d6361577c13f68147ad2', '', 0.75*$i, 1.75*$i);
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