<?php
	$_session_started = false;
	function authenticateSession($require_level, $error_echo_back='', $error_redirect_back=null) {
		global $_session_started;
		if (!$_session_started){
			session_start();
			$_session_started = true;
		}
		// Any user in Guest mode can access the page
		// If not logged as guest, automatically log on an return to page
		if ($require_level == TIPO_USUARIO::GUEST){
			if (!isset($_SESSION['usuario_id']) || !isset($_SESSION['usuario_tipo'])){
				$_SESSION["usuario_id"] = -1;
		        $_SESSION["usuario_nome"] = 'guest';
		        $_SESSION["usuario_tipo"] = TIPO_USUARIO::GUEST;
			}
			return;
		}
		
		$access_allowed = true;
		if (!isset($_SESSION['usuario_id']) || !isset($_SESSION['usuario_tipo'])) {
			$access_allowed = false;
		}
		else {
			if(empty($_SESSION['usuario_id'])) {
				$access_allowed = false;
			};
			if ($_SESSION["usuario_tipo"] != $require_level){
				$access_allowed = false;
			}
		}
		
		if (!$access_allowed){
			session_destroy();
			if ($error_redirect_back != null){
				header('Location: '.$error_redirect_back);
				exit();
				return;
			}
			else {
				echo $error_echo_back;
				die();
				return;
			}
		}
	}
	function echoError(){
		if (isset($_GET['error'])){
			$message = '';
			switch ($_GET['error']){
				case 500: {
					$message = 'Erro interno do servidor';
				}
				break;
				case 'empty_entries': {
					$message = 'Os campos obrigatórios não podem estar vazios';
				}
				break;
				case 'unmatched_password': {
					$message = 'E senha e a confirmação não estão iguais';
				}
				break;
				case 'existing_cpf': {
					$message = 'O cpf informado já está cadastrado!';
				}
				break;
				case 'existing_email': {
					$message = 'O email informado já está cadastrado!';
				}
				break;
				case 'existing_tecnico': {
					$message = 'Já há um técnico cadastrado com o email fornecido!';
				}
				break;
				case 'wrong_login': {
					$message = "E-mail e/ou senha incorretos";
				}
				break;
				case 'gestor_only': {
					$message = "O acesso é permitido somente aos gestores";
				}
				break;
				default: {
					$message = 'Erro não catalogado';
				}
			}
			echo '<script>alert("'.$message.'");</script>';
		}
	}
?>