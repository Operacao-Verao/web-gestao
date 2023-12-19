<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles.css">
  <script src="https://unpkg.com/@phosphor-icons/web"></script>
  <title>Imprimir Memorando</title>
</head>


<?php
    require '../../actions/conn.php';
    require '../../actions/session_auth.php';
    authenticateSession(TIPO_USUARIO::GESTOR, '', '../../login/login.php');

    require '../../models/Relatorio.php';
    require '../../daos/DAORelatorio.php';
    require '../../models/Ocorrencia.php';
    require '../../daos/DAOOcorrencia.php';
    require '../../models/Civil.php';
    require '../../daos/DAOCivil.php';
    require '../../models/Residencial.php';
    require '../../daos/DAOResidencial.php';
    require '../../models/Casa.php';
    require '../../daos/DAOCasa.php';
    require '../../models/Endereco.php';
    require '../../daos/DAOEndereco.php';
    require '../../models/Tecnico.php';
    require '../../daos/DAOTecnico.php';
    require '../../models/Funcionario.php';
    require '../../daos/DAOFuncionario.php';
    require '../../models/Foto.php';
    require '../../daos/DAOFoto.php';
    require '../../models/DadosDaVistoria.php';
    require '../../daos/DAODadosDaVistoria.php';
    require '../../models/Afetados.php';
    require '../../daos/DAOAfetados.php';
    require '../../models/Animal.php';
    require '../../daos/DAOAnimal.php';
    require '../../models/Memo.php';
    require '../../daos/DAOMemo.php';
    require '../../models/Secretaria.php';
    require '../../daos/DAOSecretaria.php';

    $daoRelatorio = new DAORelatorio($pdo);
    $daoOcorrencia = new DAOOcorrencia($pdo);
    $daoCivil = new DAOCivil($pdo);
    $daoResidencial = new DAOResidencial($pdo);
    $daoCasa = new DAOCasa($pdo);
    $daoEndereco = new DAOEndereco($pdo);
    $daoTecnico = new DAOTecnico($pdo);
    $daoFuncionario = new DAOFuncionario($pdo);
    $daoFoto = new DAOFoto($pdo);
    $daoDadosDaVistoria = new DAODadosDaVistoria($pdo);
    $daoAfetados = new DAOAfetados($pdo);
    $daoAnimal = new DAOAnimal($pdo);
    $daoMemo = new DAOMemo($pdo);
    $daoSecretaria = new DAOSecretaria($pdo);
    
    $memo = $daoMemo->findById($_GET['id']);
    if ($memo == null) {
        echo '{}';
        die();
    }
    
    $relatorio = $daoRelatorio->findById($memo->getIdRelatorio());
    $casa = $daoCasa->findById($relatorio->getIdCasa());
    $residencial = $daoResidencial->findById($casa->getIdResidencial());
    $endereco = $daoEndereco->findByCep($residencial->getCep());
    
    $funcionario = $daoFuncionario->findById($_SESSION["usuario_id"]);
?>

<body>
  <div class="wrapper">
    <header>
      <img src="../../assets/images/logo.jpg" alt="">
      <span>
        <p>PREFEITURA MUNICIPAL DE FRANCO DA ROCHA</p>
        <p>SECRETARIA EXECUTIVA DO GABINETE DO PREFEITO</p>
        <p>NÚCLEO DE PROTEÇÃO E DEFESA CIVIL</p>
      </span>
      <img src="../../assets/images/defesacivil.jpg" alt="">
    </header>
    <main>
      <section>
        <div class="memorando"><?php echo 'Memorando '.$memo->getMemorando(); ?></div>
        <div class="data"><?php echo formatWeekDay($memo->getDataMemo()) . ', ' . formatDate($memo->getDataMemo()).'.'; ?></div>
      </section>
      <section>
        <div class="enderecos">
          <p class="lugar"><?php echo 'Residência: '.$casa->getComplemento().(empty($casa->getComplemento())? '': ' - ').$residencial->getNumero();?></p>
          <p class="endereco"><?php echo $endereco->getRua().' - '.$endereco->getBairro().', '.$endereco->getCidade().' - SP, '.$endereco->getCep(); ?></p>
        </div>
        <p><strong>Assunto: </strong>
          <?php echo 'Solicitação de Vistoria - <strong>'.$endereco->getRua().'</strong> - '.$endereco->getBairro().', '.$endereco->getCidade().'/SP - CEP '.$endereco->getCep(); ?></p>
      </section>
      <section>
        <span class="descricao">
          <p>Considerando os apontamentos do agente de defesa civil através da Ficha nº <?php echo $relatorio->getId(); ?>, foi realizada uma vistoria
            no endereço supracitado, onde foi verificada a necessidade de apoio para resolução da ocorrência, conforme
            ficha de vistoria em anexo.</p>
          <p>
            Segue orientações no relatório técnico em anexo. Reforçamos que o mesmo foi encaminhado para<?php
              $setext = '';
              $rel_memos = $daoMemo->searchByRelatorio($relatorio);
              $nomes = [];
              
              foreach ($rel_memos as $memo){
                $secretaria = $daoSecretaria->findById($memo->getIdSecretaria());
                $nomes[] = $secretaria->getNomeSecretaria();
              }
              
              $total = count($nomes);
              for ($i=0; $i<$total; $i++){
                $setext .= ($i==0? ' a secretaria ': ($i==($total-1)? ' e para a secretaria ': ', a secretaria ')).$nomes[$i];
              }
              
              echo $setext;
            ?>.
          </p>
          <p>Fico à disposição para quaisquer dúvidas e/ou esclarecimentos.</p>
        </span>
        <p class="atenciosamente">Atenciosamente.</p>

      </section>
      <section>
        <div class="gestor">
          <p class="nome"><?php echo $funcionario->getNome(); ?></p>
          <p class="cargo">Diretor Municipal de Proteção e Defesa Civil</p>
        </div>
      </section>
      <div class="footer-wrapper">
        <div class="footer">
          <p>Núcleo de Proteção e Defesa Civil</p>
          <p>Telefone: (11) 4800-6658</p>
          <a href="www.francodarocha.sp.gov.br">www.francodarocha.sp.gov.br</a>
          <p>Av. Sete de Setembro, 38 - Centro, Franco da Rocha/SP</p>
          <div>
            <p><i class="ph ph-instagram-logo"></i>@prefeituradefranco</p>
            <p><i class="ph ph-facebook-logo"></i>/prefeituradefranco</p>
          </div>
          <p><?php echo systemVersionName(true); ?></p>
        </div>
      </div>
    </main>
  </div>
</body>

<script type="text/javascript">

    window.onload = function () {
        print();
    }

</script>

</html>