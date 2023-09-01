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
                  if(!empty($_SESSION['erro'])) {
                    echo '<span class="error">'.$_SESSION['erro'].'</span><br>';
                    $_SESSION['erro'] = '';  
                    session_destroy();
                  }
                ?>
                Email
                <input type="text" id="email" name="edtemail" autofocus><br>
                Senha
                <input type="password" id="senha" name="edtsenha">
                
           <button type="submit">Logar</button>
           
           <!-- De accesso facilitado para Devs -->
           <a href="../../actions/_dev_access.php">Fica sussa meu nobre, sou dev!</a>
          </form>
        </div>
      </section>

</body>