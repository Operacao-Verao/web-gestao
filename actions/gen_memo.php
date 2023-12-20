<?php
    require 'conn.php';
    require 'session_auth.php';
    authenticateSession(TIPO_USUARIO::GESTOR, '', '../views/login/login.php');
    
    include_once("../models/Relatorio.php");
    include_once("../daos/DAORelatorio.php");
    include_once("../models/Memo.php");
    include_once("../daos/DAOMemo.php");
    include_once("../models/Secretaria.php");
    include_once("../daos/DAOSecretaria.php");
    
    require '../models/Funcionario.php';
    require '../daos/DAOFuncionario.php';
    require '../models/Registro.php';
    require '../daos/DAORegistro.php';
    
    try {
        $daoRelatorio = new DAORelatorio($pdo);
        $daoMemo = new DAOMemo($pdo);
        $daoSecretaria = new DAOSecretaria($pdo);
        
        $dataMemo = getCurrentDatetime();
        $nomeMemo = 'nº: '.($daoMemo->countAll()+1).'/'.formatYear($dataMemo);
        $statusMemo = '';
        $oficio = '';
        $processo = addslashes($_POST['edtprocesso']);
        $setor = addslashes($_POST['edtsetor']);
        $relatorio = $daoRelatorio->findById($_POST['relatorioid']);
        $secretaria = $daoSecretaria->findById($_POST['selectSecretaria']);
        
        $memo = $daoMemo->insert($relatorio, $secretaria, $dataMemo, $statusMemo, $setor, $nomeMemo, $oficio, $processo);
        
        regLog(REG_ACAO::GEN_MEMO, 'Status: '.$memo->getStatusMemo().'; Setor: '.$memo->getSetor().'; Processo: '.$memo->getProcesso().'; Id: '.$memo->getId());
        
        header("Location: ../views/memorandos/memorandos.php");
    }
    catch (Throwable $error){
        regError($error);
        header("Location: ../views/view_relatorio/gen_memorando/gen_memorando.php?relatorio_id=".$_POST['relatorioid']."&error=500");
    }
?>