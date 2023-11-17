<?php 
    require 'conn.php';
    require 'session_auth.php';
    authenticateSession(TIPO_USUARIO::GESTOR, '', '../views/login/login.php');
    
    include_once("../models/Funcionario.php");
    include_once("../daos/DAOFuncionario.php");
    include_once("../models/Tecnico.php");
    include_once("../daos/DAOTecnico.php");
    
    require '../models/Registro.php';
    require '../daos/DAORegistro.php';
    
    try {
        $daoFuncionario = new DAOFuncionario($pdo);
        $daoTecnico = new DAOTecnico($pdo);
        
        $tecnicoId = $_POST["tecnico_id"];
        $nome = $_POST["edtnome"];
        $email = $_POST["edtemail"];
        $alterSenha = isset($_POST["chksenha"])? $_POST["chksenha"]: 0;
        $senha = $_POST["edtsenha"];
        $senhaconfirm = $_POST["edtsenhaconfirm"];
        $status = $_POST['selectAtivo'];
        
        var_dump($alterSenha);
        var_dump($senha);
        var_dump($senhaconfirm);
        if (empty($nome) || empty($email) || ($alterSenha? empty($senha) || empty($senhaconfirm): 0)) {
            header("Location: ../views/tecnicos/cad_tecnico/cad_tecnico.php?tecnico_id=".$tecnicoId."&error=empty_entries");
            exit();
        }

        if ($alterSenha && $senha != $senhaconfirm){
            header("Location: ../views/tecnicos/cad_tecnico/cad_tecnico.php?tecnico_id=".$tecnicoId."&error=unmatched_password");
            exit();
        }

        // Atualizar o técnico
        $tecnico = $daoTecnico->findById($tecnicoId);
        
        if ($tecnico) {
            $funcionario = $daoFuncionario->findById($tecnico->getIdFuncionario());
            if ($funcionario) {
                // Atualizar os dados do funcionário
                $funcionario->setNome($nome);
                $funcionario->setEmail($email);
                if ($alterSenha){
                    $senha_criptografada = encryptPassword($senha);
                    $funcionario->setSenha($senha_criptografada);
                }
                // Atualizar o técnico
                $tecnico->setFuncionario($funcionario);
                $tecnico->setAtivo($status);
                
                $daoFuncionario->update($funcionario);
                $daoTecnico->update($tecnico);
                
                regLog(REG_ACAO::ALT_TECNICO, 'Nome: '.$funcionario->getNome().'; Email: '.$funcionario->getEmail().'; Status: '.($tecnico->getAtivo()? 'Ativo': 'Inativo').'; Id: '.$tecnico->getId());
                
                header("Location: ../views/tecnicos/tecnicos.php");
            }
        }
        else {
            $_SESSION['erro'] = 'Id não encontrado';
            header("Location: ../views/tecnicos/tecnicos.php");
            exit();
        }
    }
    catch (Throwable $error){
        regError($error);
        header("Location: ../views/tecnicos/tecnicos.php?error=500");
    }
?> 