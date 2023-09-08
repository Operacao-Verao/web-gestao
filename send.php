<?php
require './actions/conn.php';
require './models/ServiceWorker.php';
require './daos/DAOServiceWorker.php';
require_once("vendor/autoload.php");
include_once("../actions/conn.php");

use Minishlink\WebPush\WebPush;
use Minishlink\WebPush\Subscription;

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Content-Type: application/json");

$method = strtolower($_SERVER['REQUEST_METHOD']);
$daoServiceWorker = new DAOServiceWorker($pdo);

if($method === 'post') {

    $data = json_decode(file_get_contents('php://input'), true);
    
    $title = $data['title'];
    $porcentagem = $data['porcentagem'];

    $auth = [
        'VAPID' => [
            'subject' => 'mailto:me@website.com', // can be a mailto: or your website address
            'publicKey' => 'BPwL7jbII3foRiJ180O05ZKwOo7AlAY7on_DLg5p_OuWMOPSDuD4716aWYtqNzIDwpDlONY0tH-hj2dJIktk_0s', // (recommended) uncompressed public key P-256 encoded in Base64-URL
            'privateKey' => '28L7I-lUhnAFJWcmJYB0PtYAsfAHJ9sLV2CKhjs475Q', // (recommended) in fact the secret multiplier of the private key encoded in Base64-URL
        ],
    ];
    
    $webPush = new WebPush($auth);

    try {
    $swToNotify = $daoServiceWorker->listAll(); 
    
    if($swToNotify != null) {
        foreach($swToNotify as $sw) {
            $sw_endpoint = $sw->getSwEndpoint();
            $sw_p256dh = $sw->getP256dh();
            $auth = $sw->getAuth();
            
            $report = $webPush->sendOneNotification(
                Subscription::create(json_decode('{"endpoint":"'.$sw_endpoint.'","expirationTime":null,"keys":{"p256dh":"'.$sw_p256dh.'","auth":"'.$auth.'"}}', true))
                , '{ "title": "Atualização do '.$title.'", "body": "O nível do fluviômetro está em '.$porcentagem.'%", "url":"web-gestao/views/home/home.php" }', ['TTL' => 5000]);
        }
    }
    } catch (\Throwable $th) {
        echo $th;
    }
} else {
    $array['error'] = 'Método não permitido (apenas POST)';
}