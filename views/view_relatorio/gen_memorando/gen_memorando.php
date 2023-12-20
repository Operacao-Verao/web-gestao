<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<script src="https://unpkg.com/@phosphor-icons/web"></script>
	<link rel="stylesheet" href="./styles.css" />
	<title>Defesa Civil - Gerar Memorando</title>
</head>

  <?php
    require '../../../actions/conn.php';
    require '../../../actions/session_auth.php';
    authenticateSession(TIPO_USUARIO::GESTOR, '', '../../login/login.php');
    
    require '../../../models/Relatorio.php';
    require '../../../daos/DAORelatorio.php';
    require '../../../models/Memo.php';
    require '../../../daos/DAOMemo.php';
    require '../../../models/Secretaria.php';
    require '../../../daos/DAOSecretaria.php';
    
    $daoRelatorio = new DAORelatorio($pdo);
    $daoMemo = new DAOMemo($pdo);
    $daoSecretaria = new DAOSecretaria($pdo);
    
    if (!isset($_GET['relatorio_id']) || ($daoRelatorio->findById($_GET['relatorio_id'])==null)){
      header("location: ../../relatorios/relatorios.php");
    }
    
  ?>

<body>
    <section class="area-cad">
        <div class="cad">

          <div class="topRow">
          <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="#000000" viewBox="0 0 256 256"
            <?php echo 'onclick="location = \'../view_relatorio.php?id='.$_GET['relatorio_id'].'\';"'; ?>
            ><path d="M224,128a8,8,0,0,1-8,8H59.31l58.35,58.34a8,8,0,0,1-11.32,11.32l-72-72a8,8,0,0,1,0-11.32l72-72a8,8,0,0,1,11.32,11.32L59.31,120H216A8,8,0,0,1,224,128Z"></path></svg>
            <h1>Gerar Memorando</h1>
          </div>

          <form method="post" action="../../../actions/gen_memo.php">
                <?php
                  echo '<input class="inputText" type="number" name="relatorioid" id="relatorioid" value="'.$_GET['relatorio_id'].'" hidden>';
                ?>

                <div class="inputArea">
                  <label for="edtnome">Memorando</label>
                  <input class="inputText" type="text" id="edtmemo" name="edtmemo" <?php echo 'value="nº: '.($daoMemo->countAll()+1).'/'.formatYear(getCurrentDate()).'"'; ?> disabled autofocus required>
                </div>
                <div class="inputArea">
                  <label for="selectSecretaria">Secretaria para encaminhar*</label>
                  <select name="selectSecretaria" id="selectSecretaria" required>
                    <?php
                      $secretarias = $daoSecretaria->listAll();
                      foreach ($secretarias as $secretaria) {
                        echo '<option value="' . $secretaria->getId() . '">' . $secretaria->getNomeSecretaria() . '</option>';
                      }
                    ?>
                  </select>
                </div>
                <div class="inputArea">
                  <label for="edtemail">Processo*</label>
                  <input class="inputText" type="text" id="edtprocesso" name="edtprocesso" required autofocus>
                </div>
                <div class="inputArea">
                  <label for="edtemail">Setor*</label>
                  <input class="inputText" type="text" id="edtsetor" name="edtsetor" required autofocus>
                </div>

           <button type="submit" id="btnCadastro">Gerar</button>
          </form>
        </div>
      </section>

      <?php
        echoError();
      ?>
      <script type="text/javascript">
        
      </script>

</body>