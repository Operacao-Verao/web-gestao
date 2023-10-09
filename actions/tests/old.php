<?php
	include_once("../daos/DAOFuncionario.php");
	include_once("../daos/DAORegistro.php");
	include_once("../daos/DAOGestor.php");
	include_once("../daos/DAOTecnico.php");
	include_once("../daos/DAOComunicado.php");
	include_once("../daos/DAOEndereco.php");
	include_once("../daos/DAOCivil.php");
	include_once("../daos/DAOCasa.php");
	include_once("../daos/DAOOcorrencia.php");
	include_once("../daos/DAORelatorio.php");
	include_once("../daos/DAOAfetados.php");
	include_once("../daos/DAOAnimal.php");
	include_once("../daos/DAOFoto.php");
	include_once("../daos/DAODadosDaVistoria.php");
	include_once("../daos/DAOCargo.php");
	include_once("../daos/DAOSecretaria.php");
	include_once("../daos/DAOSecretario.php");
	include_once("../daos/DAOMemo.php");
	include_once("../daos/DAOLocalAjuda.php");
	include_once("../daos/DAOPluviometro.php");
	include_once("../daos/DAOFluviometro.php");
	include_once("../daos/DAONivelChuva.php");
	include_once("../daos/DAONivelRio.php");
	include_once("../daos/DAOAlertaChuva.php");
	include_once("../daos/DAOAlertaRio.php");
	
	$daoFuncionario = new DAOFuncionario($pdo);
	$daoRegistro = new DAORegistro($pdo);
	$daoGestor = new DAOGestor($pdo);
	$daoTecnico = new DAOTecnico($pdo);
	$daoComunicado = new DAOComunicado($pdo);
	$daoEndereco = new DAOEndereco($pdo);
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
	/*
	$fun = $daoFuncionario->findById(1);
	var_dump($fun); echo '<br/><br/>';
	$reg = $daoRegistro->listAll()[0];
	var_dump($reg); echo '<br/><br/>';
	$ges = $daoGestor->listAll()[0];
	var_dump($ges); echo '<br/><br/>';
	$tec = $daoTecnico->listAll()[0];
	var_dump($tec); echo '<br/><br/>';
	$com = $daoComunicado->listAll()[0];
	var_dump($com); echo '<br/><br/>';
	$en = $daoEndereco->listAll()[0];
	var_dump($en); echo '<br/><br/>';
	$civ = $daoCivil->listAll()[0];
	var_dump($civ); echo '<br/><br/>';
	$cas = $daoCasa->listAll()[0];
	var_dump($cas); echo '<br/><br/>';
	$ocor = $daoOcorrencia->listAll()[0];
	var_dump($ocor); echo '<br/><br/>';
	$rel = $daoRelatorio->listAll()[0];
	var_dump($rel); echo '<br/><br/>';
	$afe = $daoAfetados->listAll()[0];
	var_dump($afe); echo '<br/><br/>';
	$anim = $daoAnimal->listAll()[0];
	var_dump($anim); echo '<br/><br/>';
	$fot = $daoFoto->listAll()[0];
	var_dump($fot); echo '<br/><br/>';
	$vis = $daoDadosDaVistoria->listAll()[0];
	var_dump($vis); echo '<br/><br/>';
	$cargo = $daoCargo->listAll()[0];
	var_dump($cargo); echo '<br/><br/>';
	$seca = $daoSecretaria->listAll()[0];
	var_dump($seca); echo '<br/><br/>';
	$seco = $daoSecretario->listAll()[0];
	var_dump($seco); echo '<br/><br/>';
	$mem = $daoMemo->listAll()[0];
	var_dump($mem); echo '<br/><br/>';
	$loc = $daoLocalAjuda->listAll()[0];
	var_dump($loc); echo '<br/><br/>';
	$pl = $daoPluviometro->listAll()[0];
	var_dump($pl); echo '<br/><br/>';
	$fl = $daoFluviometro->listAll()[0];
	var_dump($fl); echo '<br/><br/>';
	$nc = $daoNivelChuva->listAll()[0];
	var_dump($nc); echo '<br/><br/>';
	$nr = $daoNivelRio->listAll()[0];
	var_dump($nr); echo '<br/><br/>';
	$ac = $daoAlertaChuva->listAll()[0];
	var_dump($ac); echo '<br/><br/>';
	$ar = $daoAlertaRio->listAll()[0];
	var_dump($ar); echo '<br/><br/>';
	*/
	
	$fun = $daoFuncionario->findByEmail("admin@gmail.com");
	var_dump($fun); echo '<br/><br/>';
	
	// Inserindo funcionário administrador
	//$daoFuncionario->insert("admin", "admin@gmail.com", "1234", TIPO_USUARIO::GESTOR);
	
	/*
	$dao = $daoNivelRio;
	
	
	// Testando inserção e busca
	
	echo 'Primeira inserção:<br/>';
	$mod = $dao->insert($fl, 1.5, getCurrentDate()); // Inserindo uma entrada de propriedade
	$mod = $dao->findById(1); // Buscando pelo id
	var_dump($mod); echo '<br/><br/>';
	
	
	// Testando alteração
	
	echo 'Alteração:<br/>';
	$mods = $dao->listAll();
	$mods[0]->setNivelRio(0.75); // Alterando alguma propriedade
	$dao->update($mods[0]);
	$mod = $dao->findById(1); // Buscando pelo id
	var_dump($mod); echo '<br/><br/>';
	
	
	// Segunda inserção
	
	echo 'Segunda inserção:<br/>';
	$mod = $dao->insert($fl, 1.5, getCurrentDate()); // Inserindo uma entrada de propriedade
	$mod = $dao->findById(2); // Buscando pelo id
	var_dump($mod); echo '<br/><br/>';
	
	
	// Testando remoção
	
	echo 'Remoção:<br/>';
	$mod = $dao->findById(2); // Buscando pelo id
	$dao->remove($mod); // Removendo entrada
	echo 'Removido com sucesso o Modelo de id: '.$mod->getId();
	*/
?>