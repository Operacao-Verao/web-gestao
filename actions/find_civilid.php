<?php
require 'models/Casa.php';
require 'models/Civil.php';
require 'daos/DAOCivil.php';

$dbHost = 'localhost';
$dbName = 'bancodefesa';
$dbUser = 'root';
$dbPass = 'gugu';

try {
    $pdo = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro ao conectar ao banco de dados: " . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];

    $civilDAO = new DAOCivil($pdo);
    $civil = $civilDAO->findById($id);

    if ($civil) {
        echo "Civil encontrado: " . $civil->getNome();
    } else {
        echo "Civil não encontrado para o ID fornecido.";
    }
}
?>
