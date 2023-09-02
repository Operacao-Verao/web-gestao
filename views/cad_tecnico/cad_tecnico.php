<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<script src="https://unpkg.com/@phosphor-icons/web"></script>
	<link rel="stylesheet" href="./styles.css" />
	<title>Defesa Civil - Cadastrar Técnico</title>
</head>
<?php
require '../../actions/conn.php';
require '../../models/Tecnico.php';
require '../../daos/DAOTecnico.php';
require '../../models/Funcionario.php';
require '../../daos/DAOFuncionario.php';

session_start();

if(empty($_SESSION['usuario_id']) || empty($_SESSION['usuario_id']) || empty($_SESSION['usuario_id'])) {
	session_destroy();
	header("Location: ../login/login.php");
};

if(array_key_exists('tecnico_id', $_GET)) {
  $daoFuncionario = new DAOFuncionario($pdo);
  $daoTecnico = new DAOTecnico($pdo);

  $tecnico = $daoTecnico->findById($_GET['tecnico_id']);

  if($tecnico != null) $tecnico_funcionario = $daoFuncionario->findById($tecnico->getIdFuncionario());
  else $tecnico_funcionario = null;
}
?>

<body>
    <section class="area-cad">
        <div class="cad">

          <h1>
            <?php
              if(array_key_exists('tecnico_id', $_GET) && $tecnico_funcionario != null) echo 'Editar';
              else echo 'Cadastrar';
            ?>
            Técnico
          </h1>

          <form method="post" action=<?php if (array_key_exists('tecnico_id', $_GET) && $tecnico_funcionario != null) {echo '../../actions/alt_tecnico.php';} else {echo '../../actions/cad_tecnico.php';} ?>>
                <?php
                  if (array_key_exists('tecnico_id', $_GET) && $tecnico_funcionario != null) {
                    echo '<input type="number" name="tecnico_id" id="tecnico_id" value="'.$_GET['tecnico_id'].'" hidden>';
                    if(!empty($_SESSION['erro'])) {
                      echo '<span class="error">'.$_SESSION['erro'].'</span><br>';
                      $_SESSION['erro'] = ''; 
                    }
                  }
                ?>

                Nome
                <?php
                  if (array_key_exists('tecnico_id', $_GET) && $tecnico_funcionario != null) {
                    echo '<input type="text" id="edtnome" name="edtnome" value="'.$tecnico_funcionario->getNome().'" autofocus required><br>';
                  } else {
                    echo '<input type="text" id="edtnome" name="edtnome" autofocus><br>';
                  }
                ?>
                Email
                <?php
                  if (array_key_exists('tecnico_id', $_GET) && $tecnico_funcionario != null) {
                    echo '<input type="text" id="email" name="edtemail" value="'.$tecnico_funcionario->getEmail().'"><br>';
                  } else {
                    echo '<input type="text" id="email" name="edtemail" autofocus><br>';
                  }
                ?>

                <?php
                  if (array_key_exists('tecnico_id', $_GET) && $tecnico_funcionario != null) {
                    echo 'Nova senha';
                  } else {
                    echo 'Senha';
                  }
                ?>
                <input type="password" id="senha" name="edtsenha" required><br>
                <?php
                  if (array_key_exists('tecnico_id', $_GET)) {
                    echo 'Confirmar nova senha';
                  } else {
                    echo 'Confirmar senha';
                  }
                ?>
                <input type="password" id="confirmarSenha" name="edtsenhaconfirm" required>

           <button type="submit">
            <?php
              if (array_key_exists('tecnico_id', $_GET) && $tecnico_funcionario != null) {
                echo 'Atualizar Técnico';
              } else {
                echo 'Cadastrar';
              }
            ?>
           </button>
          </form>
        </div>
      </section>

</body>