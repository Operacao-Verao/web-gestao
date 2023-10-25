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
	
	$limit = 200;
	
	echo 'Started!<br/><br/>';
	
	echo '<h2>Funcionarios</h2>';
	$funcionarios = array();
	for ($i=0; $i<$limit; $i++){
		$funcionarios[] = $daoFuncionario->insert("João".$i, "joao".$i."@gmail.com", "1234", TIPO_USUARIO::GESTOR);
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
		$enderecos[] = $daoEndereco->insert(str_pad($i.'9', 8, '0'), 'Rua '.$i, 'Bairro '.($i%($limit/10)), 'Franco da Rocha');
	}
	
	echo '<h2>Residenciais</h2>';
	$residenciais = array();
	for ($i=0; $i<$limit; $i++){
		$fixed_i = $i>>3;
		$cep = str_pad($fixed_i.'9', 8, '0');
		$residenciais[] = $daoResidencial->insert($cep, (($i>>1) + 1).($i&1? 'a': 'b'));
	}
	
	echo '<h2>Civis</h2>';
	$civis = array();
	for ($i=0; $i<$limit; $i++){
		$civis[] = $daoCivil->insert($residenciais[$limit>>1], 'Maria'.$i, 'maria'.$i.'@gmail.com', '', substr(hexdec(hash('sha256', 'cpf:'.$i)).'', 2, 11), '119'.substr(hexdec(hash('sha256', 'celular:'.$i)).'', 2, 8), '11'.substr(hexdec(hash('sha256', 'telefone:'.$i)).'', 2, 8));
	}
	
	echo '<h2>Casas</h2>';
	$casas = array();
	for ($i=0; $i<$limit; $i++){
		$casas[] = $daoCasa->insert($residenciais[$i], INTERDICAO::NAO, (($i&0x3)==0? "Frente": (($i&0x3)==1? "Corredor": (($i&0x3)==2? "Fundos": ''))));
	}
	
	echo '<h2>Ocorrencias</h2>';
	$ocorrencias = array();
	for ($i=0; $i<$limit; $i++){
		$data = date_sub(date_create(getCurrentDate()), date_interval_create_from_date_string(floor(($limit/0.75)/($i+1)).' days'));
		$aprovado = ($i>>3)&1? 1: 0;
		$ocorrencias[] = $daoOcorrencia->insert($aprovado? $tecnicos[$i>>1]: null, $civis[$i], $residenciais[$i>>1], (($i&1) == 0? "telefone": "presencial"), 'Ajuda aí faz favor #'.$i, 1, $aprovado? 1: 0, $aprovado? 1: (0), $data->format('Y-m-d H:i:s'));
	}
	
	echo '<h2>Relatorios</h2>';
	$relatorios = array();
	for ($i=0; $i<($limit>>3); $i++){
		$data1 = date_sub(date_create(getCurrentDate()), date_interval_create_from_date_string(floor(($limit/0.75)/(($limit-$i)+1)).' days'));
		$data2 = date_sub(date_create(getCurrentDate()), date_interval_create_from_date_string(floor(($limit/0.75)/(($limit-$i)+1)).' days'));
		// casa_id must be non repetible
		$relatorios[] = $daoRelatorio->insert($ocorrencias[$i<<3], $casas[($i>>1)<<3], $i%3, "Relatório".$i, "Encaminhamento".$i, "Memo".$i, "Ofício".$i, "Processo".$i, "Assunto".$i, "Observações".$i, AREA_AFETADA::PARTICULAR, TIPO_CONSTRUCAO::MADEIRA, TIPO_TALUDE::NATURAL, VEGETACAO::NENHUMA, 0, SITUACAO_VITIMAS::DESABRIGADOS, ($i&1) != 0, $data1->format('Y-m-d H:i:s'), $data2->format('Y-m-d H:i:s'));
	}
	
	echo '<h2>Afetados</h2>';
	$afetados = array();
	for ($i=0; $i<($limit>>3); $i++){
		$afetados[] = $daoAfetados->insert($relatorios[$i], (($i*1)%10), (($i*2)%11), (($i*3)%12), (($i*4)%13), (($i*5)%14), (($i*6)%15), (($i*7)%16));
	}
	
	echo '<h2>Animais</h2>';
	$animais = array();
	for ($i=0; $i<($limit>>3); $i++){
		$animais[] = $daoAnimal->insert($relatorios[$i], (($i*1)%10), (($i*2)%11), (($i*3)%12), (($i*4)%13));
	}
	
	echo '<h2>Fotos</h2>';
	$fotos = array();
	for ($i=0; $i<($limit>>3); $i++){
		$fotos[] = $daoFoto->insert($relatorios[$i>>1], 'base64:data='.$i.';source='.($i&1));
	}
	
	echo '<h2>DadosDaVistoria</h2>';
	$dadosDaVistoria = array();
	for ($i=0; $i<($limit>>3); $i++){
		$dadosDaVistoria[] = $daoDadosDaVistoria->insert($relatorios[$i], (($i*1.1)&1)!=0, (($i*1.2)&1)!=0, (($i*1.3)&1)!=0, (($i*1.4)&1)!=0, (($i*1.5)&1)!=0, (($i*1.6)&1)!=0, (($i*1.7)&1)!=0, (($i*1.8)&1)!=0, (($i*1.9)&1)!=0, (($i*1.1)&2.0)!=0, (($i*2.1)&1)!=0, ($i&1? '': 'outros'.$i));
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
		$secretarios[] = $daoSecretario->insert($secretarias[$i], $cargos[$i], 'Pedro'.$i);
	}
	
	echo '<h2>Memos</h2>';
	$memos = array();
	for ($i=0; $i<($limit>>3); $i++){
		$data = date_sub(date_create(getCurrentDate()), date_interval_create_from_date_string(floor(($limit/0.75)/($i+1)).' days'));
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
		$data = date_sub(date_create(getCurrentDate()), date_interval_create_from_date_string(floor(($limit/0.75)/($i+1)).' days'));
		$nivelChuva[] = $daoNivelChuva->insert($pluviometros[$i>>4], 5 + ($i*0.25)%20, $data->format('Y-m-d H:i:s'));
	}
	
	echo '<h2>NivelRio</h2>';
	$nivelRio = array();
	for ($i=0; $i<$limit; $i++){
		$data = date_sub(date_create(getCurrentDate()), date_interval_create_from_date_string(floor(($limit/0.75)/($i+1)).' days'));
		$nivelRio[] = $daoNivelRio->insert($fluviometros[$i>>4], 50 + ($i*5)%200, $data->format('Y-m-d H:i:s'));
	}
	
	echo '<h2>AlertaChuva</h2>';
	$alertaChuva = array();
	for ($i=0; $i<$limit; $i++){
		$data = date_sub(date_create(getCurrentDate()), date_interval_create_from_date_string(floor(($limit/0.75)/($i+1)).' days'));
		$alertaChuva[] = $daoAlertaChuva->insert($pluviometros[$i>>4], 'status'.$i, $data->format('Y-m-d H:i:s'));
	}
	
	echo '<h2>AlertaRio</h2>';
	$alertaRio = array();
	for ($i=0; $i<$limit; $i++){
		$data = date_sub(date_create(getCurrentDate()), date_interval_create_from_date_string(floor(($limit/0.75)/($i+1)).' days'));
		$alertaRio[] = $daoAlertaRio->insert($fluviometros[$i>>4], 'nivel'.$i, $data->format('Y-m-d H:i:s'));
	}
	
	
	
	echo '<br/><br/><h1>DB populated with data!</h1>';
?>