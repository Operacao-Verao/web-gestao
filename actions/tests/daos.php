<?php
	include_once("../conn.php");
	
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
	
	// Instancing all DAOS for test operations
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
	
	//
	//	FUNCIONARIO
	//
	echo '<h1>Funcionario</h1>';
	
	// Inserting
	$funcionario1 = $daoFuncionario->insert("Marcelo da Silva", "marcelo@gmail.com", "1234", TIPO_USUARIO::GESTOR);
	$funcionario2 = $daoFuncionario->insert("Andressa de Souza", "andressa@gmail.com", "1234", TIPO_USUARIO::GESTOR);
	$funcionario4 = $daoFuncionario->insert("Caique Luís", "caique@gmail.com", "1234", TIPO_USUARIO::GESTOR);
	
	// Updating
	$funcionario2->setEmail("dessa@gmail.com");
	$daoFuncionario->update($funcionario2);
	
	// Finding by id
	echo '<b>findById</b><br/>';
	$funcionario3 = $daoFuncionario->findById(2);
	if ($funcionario2 == $funcionario3){
		echo '<b>NO CHANGES in Entry (SUCCESS).</b><br/>';
	}
	else {
		echo '<b>CHANGES detecteds in Entry (ERROR).</b><br/>';
	}
	var_dump($funcionario2); echo ' - <b>COMPARATION OBJECT</b><br/>';
	var_dump($funcionario3); echo ' - <b>GAVE CORRECT OBJECT</b><br/>';
	
	// Finding with login
	echo '<b>findWithLogin</b><br/>';
	var_dump($daoFuncionario->findWithLogin('dessa@gmail.com', '12345')); echo ' - <b>NOT GAVE CORRECT PARAMETERS</b><br/>';
	var_dump($daoFuncionario->findWithLogin('dessa@gmail.com', '1234')); echo ' - <b>GAVE CORRECT PARAMETERS</b><br/>';
	
	// Finding by email
	echo '<b>findByEmail</b><br/>';
	var_dump($daoFuncionario->findByEmail('caico@gmail.com')); echo ' - <b>NOT GAVE CORRECT PARAMETERS</b><br/>';
	var_dump($daoFuncionario->findByEmail('dessa@gmail.com')); echo ' - <b>GAVE CORRECT PARAMETERS</b><br/>';
	
	// Listing
	echo '<b>listAll</b><br/>';
	var_dump($daoFuncionario->listAll()); echo '- <b>LIST OF ENTRIES</b><br/>';
	
	// Removing
	echo '<b>Removing entry, status: '.$daoFuncionario->remove($funcionario2).'</b><br/>';
	
	
	//
	//	REGISTRO
	//
	echo '<h1>Registro</h1>';
	
	// Inserting
	$registro1 = $daoRegistro->insert($funcionario1, 2, "primeiro reg", getCurrentDatetime());
	$registro2 = $daoRegistro->insert($funcionario1, 3, "segundo reg", getCurrentDatetime());
	
	// Finding by id
	echo '<b>findById</b><br/>';
	$registro3 = $daoRegistro->findById(2);
	if ($registro2 == $registro3){
		echo '<b>NO CHANGES in Entry (SUCCESS).</b><br/>';
	}
	else {
		echo '<b>CHANGES detecteds in Entry (ERROR).</b><br/>';
	}
	var_dump($registro2); echo ' - <b>COMPARATION OBJECT</b><br/>';
	var_dump($registro3); echo ' - <b>GAVE CORRECT OBJECT</b><br/>';
	
	// Listing
	echo '<b>listAll</b><br/>';
	var_dump($daoRegistro->listAll()); echo '- <b>LIST OF ENTRIES</b><br/>';
	
	// Removing
	echo '<b>Removing entry, status: '.$daoRegistro->remove($registro2).'</b><br/>';
	
	
	//
	//	GESTOR
	//
	echo '<h1>Gestor</h1>';
	
	// Inserting
	$gestor1 = $daoGestor->insert($funcionario1);
	$gestor2 = $daoGestor->insert($funcionario4);
	
	// Updating
	$gestor2->setFuncionario($funcionario4);
	$daoGestor->update($gestor2);
	
	// Finding by id
	echo '<b>findById</b><br/>';
	$gestor3 = $daoGestor->findById(2);
	if ($gestor2 == $gestor3){
		echo '<b>NO CHANGES in Entry (SUCCESS).</b><br/>';
	}
	else {
		echo '<b>CHANGES detecteds in Entry (ERROR).</b><br/>';
	}
	var_dump($gestor2); echo ' - <b>COMPARATION OBJECT</b><br/>';
	var_dump($gestor3); echo ' - <b>GAVE CORRECT OBJECT</b><br/>';
	
	// Finding by funcionario
	echo '<b>findByFuncionario</b><br/>';
	var_dump($daoGestor->findByFuncionario($funcionario1)); echo ' - <b>GAVE CORRECT PARAMETERS</b><br/>';
	
	// Listing
	echo '<b>listAll</b><br/>';
	var_dump($daoGestor->listAll()); echo '- <b>LIST OF ENTRIES</b><br/>';
	
	// Removing
	echo '<b>Removing entry, status: '.$daoGestor->remove($gestor2).'</b><br/>';
	
	
	//
	//	TECNICO
	//
	echo '<h1>Tecnico</h1>';
	
	// Inserting
	$tecnico1 = $daoTecnico->insert($funcionario1, true);
	$tecnico2 = $daoTecnico->insert($funcionario4, true);
	
	// Updating
	$tecnico2->setAtivo(false);
	$daoTecnico->update($tecnico2);
	
	// Finding by id
	echo '<b>findById</b><br/>';
	$tecnico3 = $daoTecnico->findById(2);
	if ($tecnico2 == $tecnico3){
		echo '<b>NO CHANGES in Entry (SUCCESS).</b><br/>';
	}
	else {
		echo '<b>CHANGES detecteds in Entry (ERROR).</b><br/>';
	}
	var_dump($tecnico2); echo ' - <b>COMPARATION OBJECT</b><br/>';
	var_dump($tecnico3); echo ' - <b>GAVE CORRECT OBJECT</b><br/>';
	
	// Finding by funcionario
	echo '<b>findByFuncionario</b><br/>';
	var_dump($daoTecnico->findByFuncionario($funcionario1)); echo ' - <b>GAVE CORRECT PARAMETERS</b><br/>';
	
	// Listing
	echo '<b>listAll</b><br/>';
	var_dump($daoTecnico->listAll()); echo '- <b>LIST OF ENTRIES</b><br/>';
	
	// Removing
	echo '<b>Removing entry, status: '.$daoTecnico->remove($tecnico2).'</b><br/>';
	
	
	//
	//	COMUNICADO
	//
	echo '<h1>Comunicado</h1>';
	
	// Inserting
	$comunicado1 = $daoComunicado->insert($gestor1, "primeiro comunicado");
	$comunicado2 = $daoComunicado->insert($gestor1, "segundo comunicado");
	
	// Updating
	$comunicado2->setConteudo("novo comunicado");
	$daoComunicado->update($comunicado2);
	
	// Finding by id
	echo '<b>findById</b><br/>';
	$comunicado3 = $daoComunicado->findById(2);
	if ($comunicado2 == $comunicado3){
		echo '<b>NO CHANGES in Entry (SUCCESS).</b><br/>';
	}
	else {
		echo '<b>CHANGES detecteds in Entry (ERROR).</b><br/>';
	}
	var_dump($comunicado2); echo ' - <b>COMPARATION OBJECT</b><br/>';
	var_dump($comunicado3); echo ' - <b>GAVE CORRECT OBJECT</b><br/>';
	
	// Listing
	echo '<b>listAll</b><br/>';
	var_dump($daoComunicado->listAll()); echo '- <b>LIST OF ENTRIES</b><br/>';
	
	// Removing
	echo '<b>Removing entry, status: '.$daoComunicado->remove($comunicado2).'</b><br/>';
	
	
	//
	//	ENDERECO
	//
	echo '<h1>Endereco</h1>';
	
	// Inserting
	$endereco1 = $daoEndereco->insert('10000111', 'Rua via 1', 'Bairro Limoeiro', 'Stópolis');
	$endereco2 = $daoEndereco->insert('20000222', 'Rua via 2', 'Bairro Limaeiro', 'Metrópolis');
	
	// Updating
	$endereco2->setRua("rua nova");
	$daoEndereco->update($endereco2);
	
	// Finding by cep
	echo '<b>findByCep</b><br/>';
	$endereco3 = $daoEndereco->findByCep('20000222');
	if ($endereco2 == $endereco3){
		echo '<b>NO CHANGES in Entry (SUCCESS).</b><br/>';
	}
	else {
		echo '<b>CHANGES detecteds in Entry (ERROR).</b><br/>';
	}
	var_dump($endereco2); echo ' - <b>COMPARATION OBJECT</b><br/>';
	var_dump($endereco3); echo ' - <b>GAVE CORRECT OBJECT</b><br/>';
	var_dump($daoEndereco->findByCep('10000222')); echo ' - <b>NOT GAVE CORRECT PARAMETERS</b><br/>';
	
	// Listing
	echo '<b>listAll</b><br/>';
	var_dump($daoEndereco->listAll()); echo '- <b>LIST OF ENTRIES</b><br/>';
	
	// Removing
	echo '<b>Removing entry, status: '.$daoEndereco->remove($endereco2).'</b><br/>';
	
	
	//
	//	RESIDENCIAL
	//
	echo '<h1>Residencial</h1>';
	
	// Inserting
	$residencial1 = $daoResidencial->insert('10000111', '150b');
	$residencial2 = $daoResidencial->insert('10000111', '75a');
	
	// Updating
	$residencial2->setNumero('80c');
	$daoResidencial->update($residencial2);
	
	// Finding by id
	echo '<b>findById</b><br/>';
	$residencial3 = $daoResidencial->findById(2);
	if ($residencial2 == $residencial3){
		echo '<b>NO CHANGES in Entry (SUCCESS).</b><br/>';
	}
	else {
		echo '<b>CHANGES detecteds in Entry (ERROR).</b><br/>';
	}
	var_dump($residencial2); echo ' - <b>COMPARATION OBJECT</b><br/>';
	var_dump($residencial3); echo ' - <b>GAVE CORRECT OBJECT</b><br/>';
	
	// Finding by cep and numero
	echo '<b>findByCepNumero</b><br/>';
	var_dump($daoResidencial->findByCepNumero('10000111', '80c')); echo ' - <b>GAVE CORRECT PARAMETERS</b><br/>';
	var_dump($daoResidencial->findByCepNumero('10000111', '80d')); echo ' - <b>NOT GAVE CORRECT PARAMETERS</b><br/>';
	
	// Listing
	echo '<b>listAll</b><br/>';
	var_dump($daoResidencial->listAll()); echo '- <b>LIST OF ENTRIES</b><br/>';
	
	// Removing
	echo '<b>Removing entry, status: '.$daoResidencial->remove($residencial2).'</b><br/>';
	
	
	//
	//	CIVIL
	//
	echo '<h1>Civil</h1>';
	
	// Inserting
	$civil1 = $daoCivil->insert($residencial1, 'José da Silva', 'jose@gmail.com', '', '92547385946', '11910001000', '1110005000');
	$civil2 = $daoCivil->insert($residencial1, 'Ana Lúcia', 'aninha@gmail.com', '', '83594264732', '11920002000', '1120006000');
	
	// Updating
	$civil2->setTelefone("1144448888");
	$daoCivil->update($civil2);
	
	// Finding by id
	echo '<b>findById</b><br/>';
	$civil3 = $daoCivil->findById(2);
	if ($civil2 == $civil3){
		echo '<b>NO CHANGES in Entry (SUCCESS).</b><br/>';
	}
	else {
		echo '<b>CHANGES detecteds in Entry (ERROR).</b><br/>';
	}
	var_dump($civil2); echo ' - <b>COMPARATION OBJECT</b><br/>';
	var_dump($civil3); echo ' - <b>GAVE CORRECT PARAMETERS</b><br/>';
	var_dump($daoCivil->findById(99)); echo ' - <b>NOT GAVE CORRECT PARAMETERS</b><br/>';
	
	// Finding by cpf
	echo '<b>findByCpf</b><br/>';
	var_dump($daoCivil->findByCpf('92547385946')); echo ' - <b>GAVE CORRECT PARAMETERS</b><br/>';
	var_dump($daoCivil->findByCpf('92547375946')); echo ' - <b>NOT GAVE CORRECT PARAMETERS</b><br/>';
	
	// Finding by email
	echo '<b>findByEmail</b><br/>';
	var_dump($daoCivil->findByEmail('aninha@gmail.com')); echo ' - <b>GAVE CORRECT PARAMETERS</b><br/>';
	var_dump($daoCivil->findByEmail('josias@gmail.com')); echo ' - <b>NOT GAVE CORRECT PARAMETERS</b><br/>';
	
	// Listing
	echo '<b>listAll</b><br/>';
	var_dump($daoCivil->listAll()); echo '- <b>LIST OF ENTRIES</b><br/>';
	
	// Listing
	echo '<b>searchByText</b><br/>';
	var_dump($daoCivil->searchByText('j')); echo '- <b>LIST OF ENTRIES</b><br/>';
	
	// Removing
	echo '<b>Removing entry, status: '.$daoCivil->remove($civil2).'</b><br/>';
	
	
	//
	//	CASA
	//
	echo '<h1>Casa</h1>';
	
	// Inserting
	$casa1 = $daoCasa->insert($residencial1, INTERDICAO::NAO, "Fundos");
	$casa2 = $daoCasa->insert($residencial1, INTERDICAO::PARCIAL, "Frente");
	$casa4 = $daoCasa->insert($residencial1, INTERDICAO::PARCIAL, "Corredor");
	
	// Updating
	$casa2->setInterdicao(INTERDICAO::TOTAL);
	$daoCasa->update($casa2);
	
	// Finding by id
	echo '<b>findById</b><br/>';
	$casa3 = $daoCasa->findById(2);
	if ($casa2 == $casa3){
		echo '<b>NO CHANGES in Entry (SUCCESS).</b><br/>';
	}
	else {
		echo '<b>CHANGES detecteds in Entry (ERROR).</b><br/>';
	}
	var_dump($casa2); echo ' - <b>COMPARATION OBJECT</b><br/>';
	var_dump($casa3); echo ' - <b>GAVE CORRECT PARAMETERS</b><br/>';
	var_dump($daoCasa->findById(99)); echo ' - <b>NOT GAVE CORRECT PARAMETERS</b><br/>';
	
	// Listing
	echo '<b>listAll</b><br/>';
	var_dump($daoCasa->listAll()); echo '- <b>LIST OF ENTRIES</b><br/>';
	
	// Searching by text
	echo '<b>searchByText</b><br/>';
	var_dump($daoCasa->searchByText('1')); echo '- <b>LIST OF ENTRIES</b><br/>';
	
	// Searching by cep and numero
	echo '<b>searchByCepNumero</b><br/>';
	var_dump($daoCasa->searchByCepNumero('10000111', '150b')); echo '- <b>LIST OF ENTRIES</b><br/>';
	
	// Removing
	echo '<b>Removing entry, status: '.$daoCasa->remove($casa2).'</b><br/>';
	
	
	//
	//	OCORRENCIA
	//
	echo '<h1>Ocorrencia</h1>';
	
	// Inserting
	$ocorrencia1 = $daoOcorrencia->insert(null, $civil1, $residencial1, "telefone", 'É tenso', 1, 0, 0, getCurrentDatetime());
	$ocorrencia2 = $daoOcorrencia->insert(null, $civil1, $residencial1, "telefone", 'Tá difícil', 1, 0, 0, getCurrentDatetime());
	$ocorrencia4 = $daoOcorrencia->insert(null, $civil1, $residencial1, "telefone", 'Ajuda aí faz favor', 1, 0, 0, getCurrentDatetime());
	
	// Updating
	$ocorrencia1->setTecnico($tecnico1);
	$daoOcorrencia->update($ocorrencia1);
	
	// Finding by id
	echo '<b>findById</b><br/>';
	$ocorrencia3 = $daoCasa->findById(2);
	if ($ocorrencia2 == $ocorrencia3){
		echo '<b>NO CHANGES in Entry (SUCCESS).</b><br/>';
	}
	else {
		echo '<b>CHANGES detecteds in Entry (ERROR).</b><br/>';
	}
	var_dump($ocorrencia2); echo ' - <b>COMPARATION OBJECT</b><br/>';
	var_dump($ocorrencia3); echo ' - <b>GAVE CORRECT PARAMETERS</b><br/>';
	var_dump($daoOcorrencia->findById(99)); echo ' - <b>NOT GAVE CORRECT PARAMETERS</b><br/>';
	
	// Listing
	echo '<b>listAll</b><br/>';
	var_dump($daoOcorrencia->listAll()); echo '- <b>LIST OF ENTRIES</b><br/>';
	
	// Searching by residencial
	echo '<b>searchByResidencial</b><br/>';
	var_dump($daoOcorrencia->searchByResidencial($residencial1)); echo '- <b>LIST OF ENTRIES</b><br/>';
	
	// Searching by text
	echo '<b>searchByText</b><br/>';
	var_dump($daoOcorrencia->searchByText('dif', false)); echo '- <b>LIST OF ENTRIES</b><br/>';
	
	// Removing
	echo '<b>Removing entry, status: '.$daoOcorrencia->remove($ocorrencia2).'</b><br/>';
	
	
	//
	//	RELATORIO
	//
	echo '<h1>Relatorio</h1>';
	
	// Inserting
	$relatorio1 = $daoRelatorio->insert($ocorrencia1, $casa1, 2, "Primeiro relatório", "Sem encaminhamento", "Primeiro memo", "Primeiro ofício", "Primeiro processo", "Primeiro assunto", "Primeiras observações", AREA_AFETADA::PARTICULAR, TIPO_CONSTRUCAO::MADEIRA, TIPO_TALUDE::NATURAL, VEGETACAO::NENHUMA, 0, SITUACAO_VITIMAS::DESABRIGADOS, false, getCurrentDatetime(), getCurrentDatetime());
	$relatorio2 = $daoRelatorio->insert($ocorrencia4, $casa4, 2, "Segundo relatório", "Sem encaminhamento", "Segundo memo", "Segundo ofício", "Segundo processo", "Segundo assunto", "Segundas observações", AREA_AFETADA::PARTICULAR, TIPO_CONSTRUCAO::MADEIRA, TIPO_TALUDE::NATURAL, VEGETACAO::NENHUMA, 0, SITUACAO_VITIMAS::DESABRIGADOS, false, getCurrentDatetime(), getCurrentDatetime());
	
	// Updating
	$relatorio1->setEncaminhamento("Reencaminhado");
	$daoRelatorio->update($relatorio1);
	
	// Finding by id
	echo '<b>findById</b><br/>';
	$relatorio3 = $daoRelatorio->findById(2);
	if ($relatorio2 == $relatorio3){
		echo '<b>NO CHANGES in Entry (SUCCESS).</b><br/>';
	}
	else {
		echo '<b>CHANGES detecteds in Entry (ERROR).</b><br/>';
	}
	var_dump($relatorio2); echo ' - <b>COMPARATION OBJECT</b><br/>';
	var_dump($relatorio3); echo ' - <b>GAVE CORRECT PARAMETERS</b><br/>';
	var_dump($daoRelatorio->findById(99)); echo ' - <b>NOT GAVE CORRECT PARAMETERS</b><br/>';
	
	// Finding by ocorrencia
	echo '<b>findByOcorrencia</b><br/>';
	var_dump($daoRelatorio->findByOcorrencia($ocorrencia1)); echo ' - <b>GAVE CORRECT OBJECT</b><br/>';
	
	// Listing
	echo '<b>listAll</b><br/>';
	var_dump($daoRelatorio->listAll()); echo '- <b>LIST OF ENTRIES</b><br/>';
	
	// Searching by casa
	echo '<b>searchByCasa</b><br/>';
	var_dump($daoRelatorio->searchByCasa($casa1)); echo '- <b>LIST OF ENTRIES</b><br/>';
	
	// Searching by text
	echo '<b>searchByText</b><br/>';
	var_dump($daoRelatorio->searchByText('undo')); echo '- <b>LIST OF ENTRIES</b><br/>';
	
	// Removing
	echo '<b>Removing entry, status: '.$daoRelatorio->remove($relatorio2).'</b><br/>';
	$relatorio4 = $daoRelatorio->insert($ocorrencia4, $casa4, 2, "Segundo relatório", "Sem encaminhamento", "Segundo memo", "Segundo ofício", "Segundo processo", "Segundo assunto", "Segundas observações", AREA_AFETADA::PARTICULAR, TIPO_CONSTRUCAO::MADEIRA, TIPO_TALUDE::NATURAL, VEGETACAO::NENHUMA, 0, SITUACAO_VITIMAS::DESABRIGADOS, false, getCurrentDatetime(), getCurrentDatetime());
	
	
	//
	//	AFETADOS
	//
	echo '<h1>Afetados</h1>';
	
	// Inserting
	$afetados1 = $daoAfetados->insert($relatorio1, 7, 6, 5, 4, 3, 2, 1);
	$afetados2 = $daoAfetados->insert($relatorio4, 1, 2, 3, 4, 5, 6, 7);
	
	// Updating
	$afetados2->setMortos(0);
	$daoAfetados->update($afetados2);
	
	// Finding by id
	echo '<b>findById</b><br/>';
	$afetados3 = $daoAfetados->findById(2);
	if ($afetados2 == $afetados3){
		echo '<b>NO CHANGES in Entry (SUCCESS).</b><br/>';
	}
	else {
		echo '<b>CHANGES detecteds in Entry (ERROR).</b><br/>';
	}
	var_dump($afetados2); echo ' - <b>COMPARATION OBJECT</b><br/>';
	var_dump($afetados3); echo ' - <b>GAVE CORRECT PARAMETERS</b><br/>';
	var_dump($daoAfetados->findById(99)); echo ' - <b>NOT GAVE CORRECT PARAMETERS</b><br/>';
	
	// Finding by relatorio
	echo '<b>findByRelatorio</b><br/>';
	var_dump($daoAfetados->findByRelatorio($relatorio1)); echo ' - <b>GAVE CORRECT OBJECT</b><br/>';
	
	// Listing
	echo '<b>listAll</b><br/>';
	var_dump($daoAfetados->listAll()); echo '- <b>LIST OF ENTRIES</b><br/>';
	
	// Removing
	echo '<b>Removing entry, status: '.$daoAfetados->remove($afetados2).'</b><br/>';
	
	
	//
	//	ANIMAL
	//
	echo '<h1>Animal</h1>';
	
	// Inserting
	$animal1 = $daoAnimal->insert($relatorio1, 1, 2, 3, 4);
	$animal2 = $daoAnimal->insert($relatorio4, 4, 3, 2, 1);
	
	// Updating
	$animal1->setCaes(4);
	$daoAnimal->update($animal1);
	
	// Finding by id
	echo '<b>findById</b><br/>';
	$animal3 = $daoAnimal->findById(2);
	if ($animal2 == $animal3){
		echo '<b>NO CHANGES in Entry (SUCCESS).</b><br/>';
	}
	else {
		echo '<b>CHANGES detecteds in Entry (ERROR).</b><br/>';
	}
	var_dump($animal2); echo ' - <b>COMPARATION OBJECT</b><br/>';
	var_dump($animal3); echo ' - <b>GAVE CORRECT PARAMETERS</b><br/>';
	var_dump($daoAnimal->findById(99)); echo ' - <b>NOT GAVE CORRECT PARAMETERS</b><br/>';
	
	// Finding by relatorio
	echo '<b>findByRelatorio</b><br/>';
	var_dump($daoAnimal->findByRelatorio($relatorio1)); echo ' - <b>GAVE CORRECT OBJECT</b><br/>';
	
	// Listing
	echo '<b>listAll</b><br/>';
	var_dump($daoAnimal->listAll()); echo '- <b>LIST OF ENTRIES</b><br/>';
	
	// Removing
	echo '<b>Removing entry, status: '.$daoAnimal->remove($animal2).'</b><br/>';
	
	
	//
	//	FOTO
	//
	echo '<h1>Foto</h1>';
	
	// Inserting
	$foto1 = $daoFoto->insert($relatorio1, 'base64:img1');
	$foto2 = $daoFoto->insert($relatorio4, 'base64:img2');
	
	// Updating
	$foto2->setCodificado('base64:img3');
	$daoFoto->update($foto2);
	
	// Finding by id
	echo '<b>findById</b><br/>';
	$foto3 = $daoFoto->findById(2);
	if ($foto2 == $foto3){
		echo '<b>NO CHANGES in Entry (SUCCESS).</b><br/>';
	}
	else {
		echo '<b>CHANGES detecteds in Entry (ERROR).</b><br/>';
	}
	var_dump($foto2); echo ' - <b>COMPARATION OBJECT</b><br/>';
	var_dump($foto3); echo ' - <b>GAVE CORRECT PARAMETERS</b><br/>';
	var_dump($daoFoto->findById(99)); echo ' - <b>NOT GAVE CORRECT PARAMETERS</b><br/>';
	
	// Searching by relatorio
	echo '<b>findByRelatorio</b><br/>';
	var_dump($daoFoto->searchByRelatorio($relatorio1)); echo ' - <b>LIST OF ENTRIES</b><br/>';
	
	// Listing
	echo '<b>listAll</b><br/>';
	var_dump($daoFoto->listAll()); echo '- <b>LIST OF ENTRIES</b><br/>';
	
	// Removing
	echo '<b>Removing entry, status: '.$daoFoto->remove($foto2).'</b><br/>';
	
	
	//
	//	DADOS DA VISTORIA
	//
	echo '<h1>DadosDaVistoria</h1>';
	
	// Inserting
	$dadosDaVistoria1 = $daoDadosDaVistoria->insert($relatorio1, true, false, true, false, true, false, true, false, true, false, true, 'Outros 1');
	$dadosDaVistoria2 = $daoDadosDaVistoria->insert($relatorio4, true, false, true, false, true, false, true, false, true, false, true, 'Outros 2');
	
	// Updating
	$dadosDaVistoria2->setOutros('Outros novo');
	$daoDadosDaVistoria->update($dadosDaVistoria2);
	
	// Finding by id
	echo '<b>findById</b><br/>';
	$dadosDaVistoria3 = $daoDadosDaVistoria->findById(2);
	if ($dadosDaVistoria2 == $dadosDaVistoria3){
		echo '<b>NO CHANGES in Entry (SUCCESS).</b><br/>';
	}
	else {
		echo '<b>CHANGES detecteds in Entry (ERROR).</b><br/>';
	}
	var_dump($dadosDaVistoria2); echo ' - <b>COMPARATION OBJECT</b><br/>';
	var_dump($dadosDaVistoria3); echo ' - <b>GAVE CORRECT PARAMETERS</b><br/>';
	var_dump($daoDadosDaVistoria->findById(99)); echo ' - <b>NOT GAVE CORRECT PARAMETERS</b><br/>';
	
	// Finding by relatorio
	echo '<b>findByRelatorio</b><br/>';
	var_dump($daoDadosDaVistoria->findByRelatorio($relatorio1)); echo ' - <b>GAVE CORRECT OBJECT</b><br/>';
	
	// Listing
	echo '<b>listAll</b><br/>';
	var_dump($daoDadosDaVistoria->listAll()); echo '- <b>LIST OF ENTRIES</b><br/>';
	
	// Removing
	echo '<b>Removing entry, status: '.$daoDadosDaVistoria->remove($dadosDaVistoria2).'</b><br/>';
	
	
	//
	//	CARGO
	//
	echo '<h1>Cargo</h1>';
	
	// Inserting
	$cargo1 = $daoCargo->insert('Cargo primário');
	$cargo2 = $daoCargo->insert('Cargo secundário');
	
	// Updating
	$cargo2->setNomeCargo('Cargo relevante');
	$daoCargo->update($cargo2);
	
	// Finding by id
	echo '<b>findById</b><br/>';
	$cargo3 = $daoCargo->findById(2);
	if ($cargo2 == $cargo3){
		echo '<b>NO CHANGES in Entry (SUCCESS).</b><br/>';
	}
	else {
		echo '<b>CHANGES detecteds in Entry (ERROR).</b><br/>';
	}
	var_dump($cargo2); echo ' - <b>COMPARATION OBJECT</b><br/>';
	var_dump($cargo3); echo ' - <b>GAVE CORRECT PARAMETERS</b><br/>';
	var_dump($daoCargo->findById(99)); echo ' - <b>NOT GAVE CORRECT PARAMETERS</b><br/>';
	
	// Listing
	echo '<b>listAll</b><br/>';
	var_dump($daoCargo->listAll()); echo '- <b>LIST OF ENTRIES</b><br/>';
	
	// Removing
	echo '<b>Removing entry, status: '.$daoCargo->remove($cargo2).'</b><br/>';
	
	
	//
	//	SECRETARIA
	//
	echo '<h1>Secretaria</h1>';
	
	// Inserting
	$secretaria1 = $daoSecretaria->insert('Primeira secretaria');
	$secretaria2 = $daoSecretaria->insert('Segunda secretaria');
	
	// Updating
	$secretaria2->setNomeSecretaria('Super secretaria');
	$daoSecretaria->update($secretaria2);
	
	// Finding by id
	echo '<b>findById</b><br/>';
	$secretaria3 = $daoSecretaria->findById(2);
	if ($secretaria2 == $secretaria3){
		echo '<b>NO CHANGES in Entry (SUCCESS).</b><br/>';
	}
	else {
		echo '<b>CHANGES detecteds in Entry (ERROR).</b><br/>';
	}
	var_dump($secretaria2); echo ' - <b>COMPARATION OBJECT</b><br/>';
	var_dump($secretaria3); echo ' - <b>GAVE CORRECT PARAMETERS</b><br/>';
	var_dump($daoSecretaria->findById(99)); echo ' - <b>NOT GAVE CORRECT PARAMETERS</b><br/>';
	
	// Listing
	echo '<b>listAll</b><br/>';
	var_dump($daoSecretaria->listAll()); echo '- <b>LIST OF ENTRIES</b><br/>';
	
	// Removing
	echo '<b>Removing entry, status: '.$daoSecretaria->remove($secretaria2).'</b><br/>';
	
	
	//
	//	SECRETARIO
	//
	echo '<h1>Secretario</h1>';
	
	// Inserting
	$secretario1 = $daoSecretario->insert($secretaria1, $cargo1, 'Alice Souza');
	$secretario2 = $daoSecretario->insert($secretaria1, $cargo1, 'Danilo Gonçalves');
	
	// Updating
	$secretario2->setNomeSecretario('Super secretaria');
	$daoSecretario->update($secretario2);
	
	// Finding by id
	echo '<b>findById</b><br/>';
	$secretario3 = $daoSecretario->findById(2);
	if ($secretario2 == $secretario3){
		echo '<b>NO CHANGES in Entry (SUCCESS).</b><br/>';
	}
	else {
		echo '<b>CHANGES detecteds in Entry (ERROR).</b><br/>';
	}
	var_dump($secretario2); echo ' - <b>COMPARATION OBJECT</b><br/>';
	var_dump($secretario3); echo ' - <b>GAVE CORRECT PARAMETERS</b><br/>';
	var_dump($daoSecretario->findById(99)); echo ' - <b>NOT GAVE CORRECT PARAMETERS</b><br/>';
	
	// Listing
	echo '<b>listAll</b><br/>';
	var_dump($daoSecretario->listAll()); echo '- <b>LIST OF ENTRIES</b><br/>';
	
	// Removing
	echo '<b>Removing entry, status: '.$daoSecretario->remove($secretario2).'</b><br/>';
	
	
	//
	//	MEMO
	//
	echo '<h1>Memo</h1>';
	
	// Inserting
	$memo1 = $daoMemo->insert($relatorio1, $secretaria1, getCurrentDatetime(), 'Status 1', 'Processo primário');
	$memo2 = $daoMemo->insert($relatorio4, $secretaria1, getCurrentDatetime(), 'Status 2', 'Processo Secundário');
	
	// Updating
	$memo2->setStatusMemo('Status 3');
	$daoMemo->update($memo2);
	
	// Finding by id
	echo '<b>findById</b><br/>';
	$memo3 = $daoMemo->findById(2);
	if ($memo2 == $memo3){
		echo '<b>NO CHANGES in Entry (SUCCESS).</b><br/>';
	}
	else {
		echo '<b>CHANGES detecteds in Entry (ERROR).</b><br/>';
	}
	var_dump($memo2); echo ' - <b>COMPARATION OBJECT</b><br/>';
	var_dump($memo3); echo ' - <b>GAVE CORRECT PARAMETERS</b><br/>';
	var_dump($daoMemo->findById(99)); echo ' - <b>NOT GAVE CORRECT PARAMETERS</b><br/>';
	
	// Finding by relatorio
	echo '<b>findByRelatorio</b><br/>';
	var_dump($daoMemo->findByRelatorio($relatorio1)); echo ' - <b>GAVE CORRECT OBJECT</b><br/>';
	
	// Listing
	echo '<b>listAll</b><br/>';
	var_dump($daoMemo->listAll()); echo '- <b>LIST OF ENTRIES</b><br/>';
	
	// Removing
	echo '<b>Removing entry, status: '.$daoMemo->remove($memo2).'</b><br/>';
	
	
	//
	//	LOCAL AJUDA
	//
	echo '<h1>LocalAjuda</h1>';
	
	// Inserting
	$localAjuda1 = $daoLocalAjuda->insert('10000111', 'CRAS', 'Centro');
	$localAjuda2 = $daoLocalAjuda->insert('10000111', 'CRAS', 'Centro2');
	
	// Updating
	$localAjuda2->setConteudo('Extensão do CRAS');
	$daoLocalAjuda->update($localAjuda2);
	
	// Finding by id
	echo '<b>findById</b><br/>';
	$localAjuda3 = $daoLocalAjuda->findById(2);
	if ($localAjuda2 == $localAjuda3){
		echo '<b>NO CHANGES in Entry (SUCCESS).</b><br/>';
	}
	else {
		echo '<b>CHANGES detecteds in Entry (ERROR).</b><br/>';
	}
	var_dump($localAjuda2); echo ' - <b>COMPARATION OBJECT</b><br/>';
	var_dump($localAjuda3); echo ' - <b>GAVE CORRECT PARAMETERS</b><br/>';
	var_dump($daoLocalAjuda->findById(99)); echo ' - <b>NOT GAVE CORRECT PARAMETERS</b><br/>';
	
	// Listing
	echo '<b>listAll</b><br/>';
	var_dump($daoLocalAjuda->listAll()); echo '- <b>LIST OF ENTRIES</b><br/>';
	
	// Removing
	echo '<b>Removing entry, status: '.$daoLocalAjuda->remove($localAjuda2).'</b><br/>';
	
	
	//
	//	PLUVIOMETRO
	//
	echo '<h1>Pluviometro</h1>';
	
	// Inserting
	$pluviometro1 = $daoPluviometro->insert('10000111', 25.10, 22.25);
	$pluviometro2 = $daoPluviometro->insert('10000111', 50.10, 74.25);
	
	// Updating
	$pluviometro2->setLongitude(5);
	$daoPluviometro->update($pluviometro2);
	
	// Finding by id
	echo '<b>findById</b><br/>';
	$pluviometro3 = $daoPluviometro->findById(2);
	if ($pluviometro2 == $pluviometro3){
		echo '<b>NO CHANGES in Entry (SUCCESS).</b><br/>';
	}
	else {
		echo '<b>CHANGES detecteds in Entry (ERROR).</b><br/>';
	}
	var_dump($pluviometro2); echo ' - <b>COMPARATION OBJECT</b><br/>';
	var_dump($pluviometro3); echo ' - <b>GAVE CORRECT PARAMETERS</b><br/>';
	var_dump($daoPluviometro->findById(99)); echo ' - <b>NOT GAVE CORRECT PARAMETERS</b><br/>';
	
	// Listing
	echo '<b>listAll</b><br/>';
	var_dump($daoPluviometro->listAll()); echo '- <b>LIST OF ENTRIES</b><br/>';
	
	// Removing
	echo '<b>Removing entry, status: '.$daoPluviometro->remove($pluviometro2).'</b><br/>';
	
	
	//
	//	FLUVIOMETRO
	//
	echo '<h1>Fluviometro</h1>';
	
	// Inserting
	$fluviometro1 = $daoFluviometro->insert('10000111', 25.10, 22.25);
	$fluviometro2 = $daoFluviometro->insert('10000111', 50.10, 74.25);
	
	// Updating
	$fluviometro2->setLongitude(5);
	$daoFluviometro->update($fluviometro2);
	
	// Finding by id
	echo '<b>findById</b><br/>';
	$fluviometro3 = $daoFluviometro->findById(2);
	if ($fluviometro2 == $fluviometro3){
		echo '<b>NO CHANGES in Entry (SUCCESS).</b><br/>';
	}
	else {
		echo '<b>CHANGES detecteds in Entry (ERROR).</b><br/>';
	}
	var_dump($fluviometro2); echo ' - <b>COMPARATION OBJECT</b><br/>';
	var_dump($fluviometro3); echo ' - <b>GAVE CORRECT PARAMETERS</b><br/>';
	var_dump($daoFluviometro->findById(99)); echo ' - <b>NOT GAVE CORRECT PARAMETERS</b><br/>';
	
	// Listing
	echo '<b>listAll</b><br/>';
	var_dump($daoFluviometro->listAll()); echo '- <b>LIST OF ENTRIES</b><br/>';
	
	// Removing
	echo '<b>Removing entry, status: '.$daoFluviometro->remove($fluviometro2).'</b><br/>';
	
	
	//
	//	NIVEL CHUVA
	//
	echo '<h1>NivelChuva</h1>';
	
	// Inserting
	$nivelChuva1 = $daoNivelChuva->insert($pluviometro1, 10.50, getCurrentDatetime());
	$nivelChuva2 = $daoNivelChuva->insert($pluviometro1, 20.50, getCurrentDatetime());
	
	// Updating
	$nivelChuva2->setChuvaEmMm(100.50);
	$daoNivelChuva->update($nivelChuva2);
	
	// Finding by id
	echo '<b>findById</b><br/>';
	$nivelChuva3 = $daoNivelChuva->findById(2);
	if ($nivelChuva2 == $nivelChuva3){
		echo '<b>NO CHANGES in Entry (SUCCESS).</b><br/>';
	}
	else {
		echo '<b>CHANGES detecteds in Entry (ERROR).</b><br/>';
	}
	var_dump($nivelChuva2); echo ' - <b>COMPARATION OBJECT</b><br/>';
	var_dump($nivelChuva3); echo ' - <b>GAVE CORRECT PARAMETERS</b><br/>';
	var_dump($daoNivelChuva->findById(99)); echo ' - <b>NOT GAVE CORRECT PARAMETERS</b><br/>';
	
	// Listing
	echo '<b>listAll</b><br/>';
	var_dump($daoNivelChuva->listAll()); echo '- <b>LIST OF ENTRIES</b><br/>';
	
	// Search by text
	echo '<b>searchByText</b><br/>';
	var_dump($daoNivelChuva->searchByText('polis')); echo '- <b>LIST OF ENTRIES</b><br/>';
	
	// Removing
	echo '<b>Removing entry, status: '.$daoNivelChuva->remove($nivelChuva2).'</b><br/>';
	
	
	//
	//	NIVEL RIO
	//
	echo '<h1>NivelRio</h1>';
	
	// Inserting
	$nivelRio1 = $daoNivelRio->insert($fluviometro1, 400, getCurrentDatetime());
	$nivelRio2 = $daoNivelRio->insert($fluviometro1, 200, getCurrentDatetime());
	
	// Updating
	$nivelRio1->setNivelRio(100);
	$daoNivelRio->update($nivelRio1);
	
	// Finding by id
	echo '<b>findById</b><br/>';
	$nivelRio3 = $daoNivelRio->findById(2);
	if ($nivelRio2 == $nivelRio3){
		echo '<b>NO CHANGES in Entry (SUCCESS).</b><br/>';
	}
	else {
		echo '<b>CHANGES detecteds in Entry (ERROR).</b><br/>';
	}
	var_dump($nivelRio2); echo ' - <b>COMPARATION OBJECT</b><br/>';
	var_dump($nivelRio3); echo ' - <b>GAVE CORRECT PARAMETERS</b><br/>';
	var_dump($daoNivelRio->findById(99)); echo ' - <b>NOT GAVE CORRECT PARAMETERS</b><br/>';
	
	// Listing
	echo '<b>listAll</b><br/>';
	var_dump($daoNivelRio->listAll()); echo '- <b>LIST OF ENTRIES</b><br/>';
	
	// Search by text
	echo '<b>searchByText</b><br/>';
	var_dump($daoNivelRio->searchByText('polis')); echo '- <b>LIST OF ENTRIES</b><br/>';
	
	// Removing
	echo '<b>Removing entry, status: '.$daoNivelRio->remove($nivelRio2).'</b><br/>';
	
	
	//
	//	ALERTA CHUVA
	//
	echo '<h1>AlertaChuva</h1>';
	
	// Inserting
	$alertaChuva1 = $daoAlertaChuva->insert($pluviometro1, 'chuvendo', getCurrentDatetime());
	$alertaChuva2 = $daoAlertaChuva->insert($pluviometro1, 'chuvendo pouco', getCurrentDatetime());
	
	// Updating
	$alertaChuva1->setStatusChuva('chuvendo muito');
	$daoAlertaChuva->update($alertaChuva1);
	
	// Finding by id
	echo '<b>findById</b><br/>';
	$alertaChuva3 = $daoAlertaChuva->findById(2);
	if ($alertaChuva2 == $alertaChuva3){
		echo '<b>NO CHANGES in Entry (SUCCESS).</b><br/>';
	}
	else {
		echo '<b>CHANGES detecteds in Entry (ERROR).</b><br/>';
	}
	var_dump($alertaChuva2); echo ' - <b>COMPARATION OBJECT</b><br/>';
	var_dump($alertaChuva3); echo ' - <b>GAVE CORRECT PARAMETERS</b><br/>';
	var_dump($daoAlertaChuva->findById(99)); echo ' - <b>NOT GAVE CORRECT PARAMETERS</b><br/>';
	
	// Listing
	echo '<b>listAll</b><br/>';
	var_dump($daoAlertaChuva->listAll()); echo '- <b>LIST OF ENTRIES</b><br/>';
	
	// Removing
	echo '<b>Removing entry, status: '.$daoAlertaChuva->remove($alertaChuva2).'</b><br/>';
	
	
	//
	//	ALERTA RIO
	//
	echo '<h1>AlertaRio</h1>';
	
	// Inserting
	$alertaRio1 = $daoAlertaRio->insert($fluviometro1, 'alto', getCurrentDatetime());
	$alertaRio2 = $daoAlertaRio->insert($fluviometro1, 'baixinho', getCurrentDatetime());
	
	// Updating
	$alertaRio1->setStatusRio('bastante alto');
	$daoAlertaRio->update($alertaRio1);
	
	// Finding by id
	echo '<b>findById</b><br/>';
	$alertaRio3 = $daoAlertaRio->findById(2);
	if ($alertaRio2 == $alertaRio3){
		echo '<b>NO CHANGES in Entry (SUCCESS).</b><br/>';
	}
	else {
		echo '<b>CHANGES detecteds in Entry (ERROR).</b><br/>';
	}
	var_dump($alertaRio2); echo ' - <b>COMPARATION OBJECT</b><br/>';
	var_dump($alertaRio3); echo ' - <b>GAVE CORRECT PARAMETERS</b><br/>';
	var_dump($daoAlertaRio->findById(99)); echo ' - <b>NOT GAVE CORRECT PARAMETERS</b><br/>';
	
	// Listing
	echo '<b>listAll</b><br/>';
	var_dump($daoAlertaRio->listAll()); echo '- <b>LIST OF ENTRIES</b><br/>';
	
	// Removing
	echo '<b>Removing entry, status: '.$daoAlertaRio->remove($alertaRio2).'</b><br/>';
	
	
	//
	//	SERVICE WORKER
	//
	echo '<h1>ServiceWorker</h1>';
	
	// Inserting
	$serviceWorker1 = $daoServiceWorker->insert('point1', 'auth_main', '29DC819EA91C914259DC819EA91C9147', $gestor1);
	$serviceWorker2 = $daoServiceWorker->insert('point2', 'auth_new', '29DC838EA4C5A14259DC312EA91B9147', $gestor1);
	
	// Updating
	$serviceWorker1->setSwEndpoint('pointM');
	$daoServiceWorker->update($serviceWorker1);
	
	// Listing
	echo '<b>listAll</b><br/>';
	var_dump($daoServiceWorker->listAll()); echo '- <b>LIST OF ENTRIES</b><br/>';
	
	// Removing
	echo '<b>Removing entry, status: '.$daoServiceWorker->remove($serviceWorker2).'</b><br/>';
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	echo '<br/><br/><h1>NO ANY error throwed in any Test!</h1>';
?>