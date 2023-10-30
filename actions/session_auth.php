<?php
	function authenticateSession($require_level, $error_echo_back='', $error_redirect_back=null) {
		session_start();
		if(empty($_SESSION['usuario_id']) || $_SESSION["usuario_tipo"] != $require_level) {
			session_destroy();
			if ($error_redirect_back != null){
				header('Location: '.$error_redirect_back);
				return;
			}
			else {
				echo $error_echo_back;
				die();
				return;
			}
		};
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