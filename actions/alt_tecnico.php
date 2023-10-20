<?php 
    require 'conn.php';
    require 'session_auth.php';
    authenticateSession(TIPO_USUARIO::GESTOR, '', '../login/login.php');
    
    include_once("../models/Funcionario.php");
    include_once("../daos/DAOFuncionario.php");
    include_once("../models/Tecnico.php");
    include_once("../daos/DAOTecnico.php");
    
    try {
        $daoFuncionario = new DAOFuncionario($pdo);
        $daoTecnico = new DAOTecnico($pdo);
        
        $tecnicoId = $_POST["tecnico_id"];
        $nome = $_POST["edtnome"];
        $email = $_POST["edtemail"];
        $senha = $_POST["edtsenha"];
        $senhaconfirm = $_POST["edtsenhaconfirm"];
        
        $senha_criptografada = hash('sha256', $senha);

        if (empty($nome) || empty($email) || empty($senha) || empty($senha) || empty($senhaconfirm)) {
            header("Location: ../views/edit_tecnico.php?id=$tecnicoId&error=camposobrigatorios");
            exit();
        }

        if ($senha != $senhaconfirm){
            header("Location: ../views/edit_tecnico.php?id=$tecnicoId&error=senhaincorreta");
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
                $funcionario->setSenha($senha_criptografada);
                // Atualizar o técnico
                $tecnico->setFuncionario($funcionario);

                try {
                    $daoFuncionario->update($funcionario);
                    $daoTecnico->update($tecnico);
                    header("Location: ../views/tecnicos/tecnicos.php");
                } catch (PDOException $th) {
                    echo $th->getMessage();
                    header("Location: ../views/tecnicos/tecnicos.php");
                }
            }
        } else {
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