<?php
    include_once("../actions/conn.php");
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
        echo 'Memo generated successfully.';
    }
    catch (Throwable $error){
        echo 'Failed to generate Memo.';
        regError($error);
    }
?>