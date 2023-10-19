<?php
	function authenticateSession($require_level, $error_echo_back='', $error_redirect_back=null) {
		session_start();
		if(empty($_SESSION['usuario_id']) || $_SESSION["usuario_tipo"] != $require_level) {
			session_destroy();
			if ($error_redirect_back != null){
				header('Location: '.$error_redirect_back);
			}
			else {
				echo $error_echo_back;
				die();
			}
		};
	}
?>