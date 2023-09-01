<?php
session_start();

$_SESSION['usuario_id'] = '';
$_SESSION['usuario_nome'] = '';
$_SESSION['usuario_tipo'] = '';

header("Location: ../index.php");

exit;