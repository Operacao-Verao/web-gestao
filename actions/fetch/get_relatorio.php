<?php
	
	$input = json_decode(file_get_contents('php://input'), true);
	
	require '../conn.php';
	
	require '../../models/Relatorio.php';
	require '../../daos/DAORelatorio.php';
	require '../../models/Ocorrencia.php';
	require '../../daos/DAOOcorrencia.php';
	require '../../models/Civil.php';
	require '../../daos/DAOCivil.php';
	require '../../models/Casa.php';
	require '../../daos/DAOCasa.php';
	require '../../models/Endereco.php';
	require '../../daos/DAOEndereco.php';
	require '../../models/Tecnico.php';
	require '../../daos/DAOTecnico.php';
	require '../../models/Funcionario.php';
	require '../../daos/DAOFuncionario.php';
	require '../../models/Foto.php';
	require '../../daos/DAOFoto.php';
	require '../../models/DadosDaVistoria.php';
	require '../../daos/DAODadosDaVistoria.php';
	require '../../models/Afetados.php';
	require '../../daos/DAOAfetados.php';
	require '../../models/Animal.php';
	require '../../daos/DAOAnimal.php';
	require '../../models/Memo.php';
	require '../../daos/DAOMemo.php';
	
	$daoRelatorio = new DAORelatorio($pdo);
	$daoOcorrencia = new DAOOcorrencia($pdo);
	$daoCivil = new DAOCivil($pdo);
	$daoCasa = new DAOCasa($pdo);
	$daoEndereco = new DAOEndereco($pdo);
	$daoTecnico = new DAOTecnico($pdo);
	$daoFuncionario = new DAOFuncionario($pdo);
	$daoFoto = new DAOFoto($pdo);
	$daoDadosDaVistoria = new DAODadosDaVistoria($pdo);
	$daoAfetados = new DAOAfetados($pdo);
	$daoAnimal = new DAOAnimal($pdo);
	$daoMemo = new DAOMemo($pdo);
	
	$relatorio = $daoRelatorio->findById($input['id']);
	if ($relatorio == null){
		echo '{}';
		die();
	}
	$ocorrencia = $daoOcorrencia->findById($relatorio->getIdOcorrencia());
	
	$json = [];
	$json['id'] = $input['id'];
	
	// Obtendo dados de Civil
	$civil = $daoCivil->findById($ocorrencia->getIdCivil());
	$json['civil_id'] = $civil->getId();
	$json['civil_nome'] = $civil->getNome();
	$json['civil_cpf'] = $civil->getCpf();
	$json['civil_telefone'] = $civil->getTelefone();
	$json['civil_celular'] = $civil->getCelular();
	
	// Obtendo dados de Casa
	$casa = $daoCasa->findById($ocorrencia->getIdCasa());
	$json['casa_numero'] = $casa->getNumero();
	$json['casa_complemento'] = $casa->getComplemento();
	
	// Obtendo dados de Endereco
	$endereco = $daoEndereco->findByCep($casa->getCep());
	$json['endereco_cep'] = $endereco->getCep();
	$json['endereco_rua'] = $endereco->getRua();
	$json['endereco_bairro'] = $endereco->getBairro();
	$json['endereco_cidade'] = $endereco->getCidade();
	
	// Obtendo dados de Técnico e Funcionário
	$tecnico = $daoTecnico->findById($ocorrencia->getIdTecnico());
	$funcionario = $daoFuncionario->findById($tecnico->getIdFuncionario());
	$json['tecnico'] = $funcionario->getNome();
	
	// Obtendo Fotos
	$fotos = $daoFoto->listByRelatorio($relatorio);
	$json['_fotos'] = 'Total: '.count($fotos);
	
	// Obtendo Dados da Vistoria
	$dadosDaVistoria = $daoDadosDaVistoria->findByRelatorio($relatorio);
	if ($dadosDaVistoria){
		$json['desmoronamento'] = $dadosDaVistoria->getDesmoronamento();
		$json['deslizamento'] = $dadosDaVistoria->getDeslizamento();
		$json['esgoto_escoamento'] = $dadosDaVistoria->getEsgotoEscoamento();
		$json['erosao'] = $dadosDaVistoria->getErosao();
		$json['inundacao'] = $dadosDaVistoria->getInundacao();
		$json['incendio'] = $dadosDaVistoria->getIncendio();
		$json['arvores'] = $dadosDaVistoria->getArvores();
		$json['infiltracao_trinca'] = $dadosDaVistoria->getInfiltracaoTrinca();
		$json['judicial'] = $dadosDaVistoria->getJudicial();
		$json['monitoramento'] = $dadosDaVistoria->getMonitoramento();
		$json['transito'] = $dadosDaVistoria->getTransito();
	}
	
	// Obtendo Afetados
	$afetados = $daoAfetados->findByRelatorio($relatorio);
	if ($afetados){
		$json['afetados_adultos'] = $afetados->getAdultos();
		$json['afetados_criancas'] = $afetados->getCriancas();
		$json['afetados_idosos'] = $afetados->getIdosos();
		$json['afetados_especiais'] = $afetados->getEspeciais();
		$json['afetados_mortos'] = $afetados->getMortos();
		$json['afetados_feridos'] = $afetados->getFeridos();
		$json['afetados_enfermos'] = $afetados->getEnfermos();
	}
	
	// Obtendo Animais
	$animal = $daoAnimal->findByRelatorio($relatorio);
	if ($animal){
		$json['caes'] = $animal->getCaes();
		$json['gatos'] = $animal->getGatos();
		$json['aves'] = $animal->getAves();
		$json['equinos'] = $animal->getEquinos();
	}
	
	// Obtendo Memorando
	$memo = $daoMemo->findByRelatorio($relatorio);
	if ($memo){
		// TODO: Repensar o modelo de Memorando para com Relatório
		$json['memorando'] = '¯\_(ツ)_/¯';
		$json['memo_oficio'] = '¯\_(ツ)_/¯';
		$json['memo_processo'] = '¯\_(ツ)_/¯';
		$json['memo_setor'] = '¯\_(ツ)_/¯';
		$json['memo_data'] = '¯\_(ツ)_/¯';
	}
	
	$json['_erros'] = 'Tabelas Faltosas: '.
		($dadosDaVistoria?'':'DadosDaVistoria ').
		($afetados?'':'Afetados ').
		($animal?'':'Animal ').
		($memo?'':'Memo');
	
	// Obtendo Relatório
	$json['data_geracao'] = formatDate($relatorio->getDataGeracao());
	$json['data_atendimento'] = formatDate($relatorio->getDataAtendimento());
	$json['gravidade'] = $relatorio->getGravidade();
	$json['area_afetada'] = $relatorio->getAreaAfetada();
	$json['tipo_construcao'] = $relatorio->getTipoConstrucao();
	$json['vegetacao'] = $relatorio->getVegetacao();
	$json['interdicao'] = $relatorio->getInterdicao();
	$json['danos_materiais'] = $relatorio->getDanosMateriais();
	$json['memorando'] = $relatorio->getMemorando();
	$json['oficio'] = $relatorio->getOficio();
	$json['processo'] = $relatorio->getProcesso();
	$json['setor'] = $json['_erros'];
	$json['data'] = '¯\_(ツ)_/¯';
	$json['assunto'] = $relatorio->getAssunto();
	
	echo json_encode($json);
?>