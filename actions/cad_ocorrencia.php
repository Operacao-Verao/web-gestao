<?php
	require 'conn.php';
	
	require '../models/Ocorrencia.php';
	require '../daos/DAOOcorrencia.php';
	require '../models/Endereco.php';
	require '../daos/DAOEndereco.php';
	require '../models/Casa.php';
	require '../daos/DAOCasa.php';
	require '../models/Civil.php';
	require '../daos/DAOCivil.php';
	
	$daoOcorrencia = new DAOOcorrencia($pdo);
	$daoEndereco = new DAOEndereco($pdo);
	$daoCasa = new DAOCasa($pdo);
	$daoCivil = new DAOCivil($pdo);
	
	$civil_email = $_POST['inputEmail'];
	$acionamento = $_POST['inputAcionamento'];
	$relato = $_POST['inputRelato'];
	$numCasas = $_POST['inputNumCasas'];
	$cep = $_POST['inputCep'];
	$rua = $_POST['inputRua'];
	$bairro = $_POST['inputBairro'];
	$cidade = $_POST['inputCidade'];
	$numero = $_POST['inputNumero'];
	$complemento = $_POST['inputComplemento'];
	
	$endereco = $daoEndereco->findByCep($cep);
	if ($endereco == null){
		$endereco = $daoEndereco->insert($cep, $rua, $bairro, $cidade);
		if ($endereco == null){
            header("Location: ../views/ocorrencias/cad_ocorrencia/cad_ocorrencia.php?error=cadastrofalhou");
            exit();
		}
	}
	
	$casa = $daoCasa->findByCepNumero($cep, $numero);
	if ($casa == null){
		$casa = $daoCasa->insert($cep, $numero, $complemento);
		if ($casa == null){
            header("Location: ../views/ocorrencias/cad_ocorrencia/cad_ocorrencia.php?error=cadastrofalhou");
            exit();
		}
	}
	
	$civil = null;
	if ($civil_email == null){
		/*$nome = $_POST["inputName"];
        $email = $_POST["inputEmail"];
        $senha = $_POST["inputPassword"];
        $cpf = $_POST["inputCpf"];
        $celular = $_POST["inputCelular"];
        $telefone = $_POST["inputTelefone"];
        
        $civil = $this->daoCivil->insert($casa, $nome, $email, $senha, $cpf, $celular, $telefone);

        if ($civil == null) {
            header("Location: ../views/ocorrencias/cad_ocorrencias/cad_ocorrencias.php?error=cadastrofalhou");
            exit();
        }*/
	    header("Location: ../views/ocorrencias/cad_ocorrencia/cad_ocorrencia.php?error=cadastrofalhou");
	    exit();
	}
	else{
		$civil = $daoCivil->findByEmail($civil_email);
		
		if ($civil == null){
			header("Location: ../views/ocorrencias/cad_ocorrencia/cad_ocorrencia.php?error=cadastrofalhou");
	    	exit();
		}
		$civil->setCasa($casa);
		$daoCivil->update($civil);
	}
	
	var_dump($casa); echo '<br/><br/>';
	$ocorrencia = $daoOcorrencia->insert(null, $civil, $casa, $acionamento, $relato, $numCasas, false, false, getCurrentDate());
	if ($ocorrencia == null){
		header("Location: ../views/ocorrencias/cad_ocorrencia/cad_ocorrencia.php?error=cadastrofalhou");
        exit();
	}
	
    header("Location: ../views/ocorrencias/ocorrencias.php");
    exit();
?>