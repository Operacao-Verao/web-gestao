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
    require '../../../actions/conn.php';
    require '../../../actions/session_auth.php';
    authenticateSession(TIPO_USUARIO::GESTOR, '', '../../login/login.php');
    
    require '../../../models/Tecnico.php';
    require '../../../daos/DAOTecnico.php';
    require '../../../models/Funcionario.php';
    require '../../../daos/DAOFuncionario.php';
    
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

          <div class="topRow">
          <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="#000000" viewBox="0 0 256 256" onclick="location = '../tecnicos.php';"><path d="M224,128a8,8,0,0,1-8,8H59.31l58.35,58.34a8,8,0,0,1-11.32,11.32l-72-72a8,8,0,0,1,0-11.32l72-72a8,8,0,0,1,11.32,11.32L59.31,120H216A8,8,0,0,1,224,128Z"></path></svg>
            <h1>
              <?php
                if(array_key_exists('tecnico_id', $_GET) && $tecnico_funcionario != null) echo 'Editar';
                else echo 'Cadastrar';
              ?>
              Técnico
            </h1>
          </div>

          <form method="post" action=<?php if (array_key_exists('tecnico_id', $_GET) && $tecnico_funcionario != null) {echo '../../../actions/alt_tecnico.php';} else {echo '../../../actions/cad_tecnico.php';} ?>>
                <?php
                  if (array_key_exists('tecnico_id', $_GET) && $tecnico_funcionario != null) {
                    echo '<input class="inputText" type="number" name="tecnico_id" id="tecnico_id" value="'.$_GET['tecnico_id'].'" hidden>';
                    if(!empty($_SESSION['erro'])) {
                      echo '<span class="error">'.$_SESSION['erro'].'</span>';
                      $_SESSION['erro'] = ''; 
                    }
                  }
                ?>

                <div class="inputArea">
                  <label for="edtnome">Nome</label>
                  <?php
                    if (array_key_exists('tecnico_id', $_GET) && $tecnico_funcionario != null) {
                      echo '<input class="inputText" type="text" id="edtnome" name="edtnome" value="'.$tecnico_funcionario->getNome().'" autofocus required>';
                    } else {
                      echo '<input class="inputText" type="text" id="edtnome" name="edtnome" autofocus>';
                    }
                  ?>
                </div>
                <div class="inputArea">
                  <label for="edtemail">Email</label>
                  <?php
                    if (array_key_exists('tecnico_id', $_GET) && $tecnico_funcionario != null) {
                      echo '<input class="inputText" type="text" id="email" name="edtemail" value="'.$tecnico_funcionario->getEmail().'">';
                    } else {
                      echo '<input class="inputText" type="text" id="email" name="edtemail" autofocus>';
                    }
                  ?>
                </div>
                <?php
                    if (array_key_exists('tecnico_id', $_GET) && $tecnico_funcionario != null) {
                      echo '
                        <div class="inputArea">
                          <label for="edtsenha">Atualizar Senha</label>
                          <input class="inputText" type="checkbox" id="chksenha" name="chksenha">
                        </div>';
                    }
                  ?>
                <div class="inputArea">
                  <?php
                    if (array_key_exists('tecnico_id', $_GET) && $tecnico_funcionario != null) {
                      echo '<label for="edtsenha">Nova senha</label>';
                    } else {
                      echo '<label for="edtsenha">Senha</label>';
                    }
                  ?>
                  <input class="inputText" type="password" id="senha" name="edtsenha" required>
                </div>
                <div class="inputArea">
                  <?php
                    if (array_key_exists('tecnico_id', $_GET)) {
                      echo '<label for="edtsenhaconfirm">Confirmar nova senha</label>';
                    } else {
                      echo '<label for="edtsenhaconfirm">Confirmar senha</label>';
                    }
                  ?>
                  <input class="inputText" type="password" id="confirmarSenha" name="edtsenhaconfirm" required>
                </div>
                <?php
                    if (array_key_exists('tecnico_id', $_GET)) {
                      echo '
                      <div class="inputArea">
                        <label for="selectAtivo">Status do Técnico</label>
                        <select name="selectAtivo" id="">
                          <option value="0"'.(!$tecnico->getAtivo()? ' selected': '').'>Inativo</option>
                          <option value="1"'.($tecnico->getAtivo()? ' selected': '').'>Ativo</option>
                        </select>
                      </div>';
                    }
                ?>

           <button type="submit" id="btnCadastro">
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

      <?php
        echoError();
      ?>
      <script type="text/javascript">
        let exp_nome = /[^a-zA-ZáàÁÀéèÉÈíìÍÌóòÓÒúùÚÙãçÃÇâÂêÊõÕôÔûÛ\s]/g;
        
        if (typeof chksenha !== 'undefined'){
          chksenha.oninput = function(){
            senha.disabled = confirmarSenha.disabled = !chksenha.checked;
            if (chksenha.checked){
              senha.value = '';
              confirmarSenha.value = '';
            }
            else {
              senha.value = '00000000';
              confirmarSenha.value = '00000000';
            }
            chksenha.value = chksenha.checked? 1: 0;
            console.log(chksenha.checked);
          }
          chksenha.checked = false;
          chksenha.oninput();
        }
        
        edtnome.oninput = function(){
          edtnome.value = edtnome.value.replace(exp_nome, '').substr(0, 100);
        }
        
        email.oninput = function(){
          email.value = email.value.substr(0, 100);
        }
        
        btnCadastro.onclick = function(){
          if (senha.value != confirmarSenha.value){
            alert("As senhas precisam coincidir!");
            return false;
          }
          else {
            edtnome.value = edtnome.value.replace(exp_nome, '');
          }
        }
        
      </script>

</body>