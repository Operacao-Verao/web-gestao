<?php
    session_start();

    require '../conn.php';
    require '../../models/ServiceWorker.php';
    require '../../daos/DAOServiceWorker.php';

    $daoServiceWorker = new DAOServiceWorker($pdo);

    $input = json_decode(file_get_contents('php://input'), true);

    $sw_endpoint = $input['endpoint'];
    $auth = $input['keys']['auth'];
    $p256dh = $input['keys']['p256dh'];
    $id_gestor = $_SESSION["usuario_id"];
    
    try {
      $daoServiceWorker->insert($sw_endpoint, $auth, $p256dh, $id_gestor);  
      echo json_encode("Service Worker Succesfully created!");
    } catch (\Throwable $th) {
      echo json_encode($th->getMessage());
    }
    
?>