<?php

    include_once("../models/Memo.php");
    include_once("../daos/DAOMemo.php");

    $db_host = 'localhost';
    $db_name = 'BDDEFESACIVIL';
    $db_user = 'root';
    $db_pass = '';

    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
    

    function generateMemo() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dataMemo = $_POST['data_memo'];
            $statusMemo = $_POST['status_memo'];
            $processo = $_POST['processo'];
    
    
            $daoMemo = new DAOMemo($pdo);
    
            $memo = $daoMemo->insert($relatorio, $secretaria, $dataMemo, $statusMemo, $processo);
    
            if ($memo) {
                echo 'Memo generated successfully.';
            } else {
                echo 'Failed to generate Memo.';
            }
        }
    }
    
    generateMemo();
?>