<?php
	require 'conn.php';
	
	require '../models/Ocorrencia.php';
	require '../daos/DAOOcorrencia.php';
	require '../models/Endereco.php';
	require '../daos/DAOEndereco.php';
	require '../models/Residencial.php';
	require '../daos/DAOResidencial.php';
	require '../models/Casa.php';
	require '../daos/DAOCasa.php';
	require '../models/Civil.php';
	require '../daos/DAOCivil.php';
	
	$daoOcorrencia = new DAOOcorrencia($pdo);
	$daoEndereco = new DAOEndereco($pdo);
	$daoResidencial = new DAOResidencial($pdo);
	$daoCasa = new DAOCasa($pdo);
	$daoCivil = new DAOCivil($pdo);
	
	$cpf = $_POST['inputCpf'];
	$acionamento = $_POST['inputAcionamento'];
	$relato = $_POST['inputRelato'];
	$numCasas = $_POST['inputNumCasas'];
	$cep = $_POST['inputCep'];
	$rua = $_POST['inputRua'];
	$bairro = $_POST['inputBairro'];
	$cidade = $_POST['inputCidade'];
	$numero = $_POST['inputNumero'];
	$complemento = $_POST['inputComplemento'];
	
	try {
		$endereco = $daoEndereco->findByCep($cep);
		if ($endereco == null){
			$endereco = $daoEndereco->insert($cep, $rua, $bairro, $cidade);
			if ($endereco == null){
	            header("Location: ../views/ocorrencias/cad_ocorrencia/cad_ocorrencia.php?error=cadastrofalhou");
	            exit();
			}
		}
		
		$residencial = null;
		$casas = $daoCasa->listByCepNumero($cep, $numero);
		if (count($casas) == 0){
			$residencial = $daoResidencial->findByCepNumero($cep, $numero);
			if ($residencial == null){
				$residencial = $daoResidencial->insert($cep, $numero);
			}
			$casa = $daoCasa->insert($residencial, INTERDICAO::NAO, $complemento);
			if ($casa == null){
	            header("Location: ../views/ocorrencias/cad_ocorrencia/cad_ocorrencia.php?error=cadastrofalhou");
	            exit();
			}
		}
		else{
			$residencial = $daoResidencial->findByCepNumero($cep, $numero);
		}
		
		$civil = null;
		if ($cpf == null){
		    header("Location: ../views/ocorrencias/cad_ocorrencia/cad_ocorrencia.php?error=cadastrofalhou");
		    exit();
		}
		else{
			$civil = $daoCivil->findByCpf($cpf);
			
			if ($civil == null){
				$nome = $_POST["inputName"];
		        $email = $_POST["inputEmail"];
		        $cpf = $_POST["inputCpf"];
		        $celular = $_POST["inputCelular"];
		        $telefone = $_POST["inputTelefone"];
		        
		        $civil = $daoCivil->insert($residencial, $nome, $email, '', $cpf, $celular, $telefone);
			}
	        if ($civil == null) {
	            header("Location: ../views/ocorrencias/cad_ocorrencias/cad_ocorrencias.php?error=cadastrofalhou");
	            exit();
	        }
			$civil->setResidencial($residencial);
			$daoCivil->update($civil);
		}
		
		$ocorrencia = $daoOcorrencia->insert(null, $civil, $residencial, $acionamento, $relato, $numCasas, 0, 0, getCurrentDatetime());
		if ($ocorrencia == null){
			header("Location: ../views/ocorrencias/cad_ocorrencia/cad_ocorrencia.php?error=cadastrofalhou");
	        exit();
		}
		
	  header("Location: ../views/ocorrencias/ocorrencias.php");
	  exit();
	} catch (\Throwable $th) {
		echo $th;
	}
?>