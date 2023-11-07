<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<script src="https://unpkg.com/@phosphor-icons/web"></script>
	<link rel="stylesheet" href="./styles.css" />
	<title>Defesa Civil - Login</title>
</head>
<?php
  session_start()
?>
<body>
    
    <section class="area-login">
        <div class="login">
          
          <h1>Login</h1>

          <form method="post" action="../../actions/login.php">
                <?php
                  if(!empty($_GET['error'])) {
                    $message = 'Erro interno do servidor, contacte os desenvolvedores!';
                    switch ($_GET['error']){
                      case 'wrong_login': {
                        $message = 'O E-mail e/ou a senha estão incorretos!';
                      }
                      break;
                      case 'gestor_only': {
                        $message = 'Apenas o gestor pode ter acesso!';
                      }
                      break;
                    }
                    echo '<span class="error">'.$message.'</span><br>';
                    $_GET['error'] = '';  
                    session_destroy();
                  }
                ?>
                Email
                <input type="text" id="email" name="edtemail" autofocus><br>
                Senha
                <input type="password" id="senha" name="edtsenha">
                
           <button type="submit">Logar</button>
          </form>
        </div>
      </section>

</body>