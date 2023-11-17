<?php
    require 'conn.php';
    require 'session_auth.php';
    authenticateSession(TIPO_USUARIO::GESTOR, '', '../views/login/login.php');
    
    include_once("../models/Memo.php");
    include_once("../daos/DAOMemo.php");
    
    require '../models/Funcionario.php';
    require '../daos/DAOFuncionario.php';
    require '../models/Registro.php';
    require '../daos/DAORegistro.php';
    
    try {
        $dataMemo = $_POST['data_memo'];
        $statusMemo = $_POST['status_memo'];
        $processo = $_POST['processo'];
        
        $daoMemo = new DAOMemo($pdo);
        
        $memo = $daoMemo->insert($relatorio, $secretaria, $dataMemo, $statusMemo, $processo);
        
        regLog(REG_ACAO::GEN_MEMO, 'Status: '.$memo->getStatusMemo().'; Setor: '.$memo->getSetor().'; Processo: '.$memo->getProcesso().'; Id: '.$memo->getId());
        
        echo 'Memo generated successfully.';
    }
    catch (Throwable $error){
        echo 'Failed to generate Memo.';
        regError($error);
    }
?>