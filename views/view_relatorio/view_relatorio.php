<!DOCTYPE html>

<head>
  <link rel="stylesheet" href="./styles.css" />
  <title>Defesa Civil - Relatório</title>
</head>

<?php
  require '../../partials/header/header.php';
  require '../../actions/conn.php';
  
  require '../../actions/session_auth.php';
  authenticateSession(TIPO_USUARIO::GESTOR, '', '../login/login.php');
  
  
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

  $relatorio = $daoRelatorio->findById($_GET['id']);
  if ($relatorio == null){
    echo '{}';
    die();
  }
  $ocorrencia = $daoOcorrencia->findById($relatorio->getIdOcorrencia());

  // Obtendo dados de Civil
  $civil = $daoCivil->findById($ocorrencia->getIdCivil());

  // Obtendo dados de Casa
  $casa = $daoCasa->findById($relatorio->getIdCasa());
  $residencial = $daoResidencial->findById($casa->getIdResidencial());

  // Obtendo dados de Endereco
  $endereco = $daoEndereco->findByCep($residencial->getCep());

  // Obtendo dados de Técnico e Funcionário
  $tecnico = $daoTecnico->findById($ocorrencia->getIdTecnico());
  $funcionario = $daoFuncionario->findById($tecnico->getIdFuncionario());

  // Obtendo Fotos
  $fotos = $daoFoto->searchByRelatorio($relatorio);

  // Obtendo Dados da Vistoria
  $dadosDaVistoria = $daoDadosDaVistoria->findByRelatorio($relatorio);

  // Obtendo Afetados
  $afetados = $daoAfetados->findByRelatorio($relatorio);

  // Obtendo Animais
  $animal = $daoAnimal->findByRelatorio($relatorio);

  // Obtendo Memorando
  $memo = $daoMemo->findByRelatorio($relatorio);
?>
<section class="dash-content">
<svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="#000000" viewBox="0 0 256 256" onclick="history.back()"><path d="M224,128a8,8,0,0,1-8,8H59.31l58.35,58.34a8,8,0,0,1-11.32,11.32l-72-72a8,8,0,0,1,0-11.32l72-72a8,8,0,0,1,11.32,11.32L59.31,120H216A8,8,0,0,1,224,128Z"></path></svg>
  <article>
    <div class="topRowContent">
      <div class="item-row">
        <p class="item-row-title">Nome: </p>
        <p class="item-row-content"><?php echo $civil->getNome();?></p>
      </div>
      <div class="item-row">
        <p class="item-row-title">Cidade: </p>
        <p class="item-row-content"><?php echo $endereco->getCidade();?></p>
      </div>
      <div class="item-row">
        <p class="item-row-title">Telefone: </p>
        <p class="item-row-content"><?php echo $civil->getTelefone();?></p>
      </div>
      <div class="item-row">
        <p class="item-row-title">Data Atendimento: </p>
        <p class="item-row-content"><?php echo formatDate($relatorio->getDataAtendimento());?></p>
      </div>
      <div class="item-row">
        <p class="item-row-title">CEP: </p>
        <p class="item-row-content"><?php echo $residencial->getCep();?></p>
      </div>
      <div class="item-row">
        <p class="item-row-title">Bairro: </p>
        <p class="item-row-content"><?php echo $endereco->getBairro();?></p>
      </div>
      <div class="item-row">
        <p class="item-row-title">Celular: </p>
        <p class="item-row-content"><?php echo $civil->getCelular();?></p>
      </div>
      <div class="item-row">
        <p class="item-row-title">Data Geração: </p>
        <p class="item-row-content"><?php echo formatDate($relatorio->getDataGeracao());?></p>
      </div>
      <div class="item-row">
        <p class="item-row-title">CPF: </p>
        <p class="item-row-content"><?php echo $civil->getCpf();?></p>
      </div>
      <div class="item-row">
        <p class="item-row-title">Logradouro: </p>
        <p class="item-row-content"><?php echo $endereco->getRua();?></p>
      </div>
      <div class="item-row">
        <p class="item-row-title">Nº: </p>
        <p class="item-row-content"><?php echo $residencial->getNumero();?></p>
      </div>
    </div>

    <div class="area-images">
      <?php
        foreach ($fotos as $foto){
          $data = $foto->getCodificado();
          echo '<img src="'.$data.'" width="40%"/>';
        }
      ?>
    </div>
    <button class="btnImprimir"><a target="_Blank"
      <?php echo 'href="print_relatorio/index.php?id='.$relatorio->getId().'"'; ?>>Impressão Relatório</a></button>
  </article>
  <article>
    <div class="item-row">
      <p class="item-row-title">Técnico Responsável - </p>
      <p class="item-row-content"></p>
    </div>
    <div class="boxContent">
      <div class="dadosVistoria">
        <p class="item-column-title">Dados da Vistoria: </p>
        <div class="item-content">
          <p class="item-column-content">(<?php echo $dadosDaVistoria!=null && $dadosDaVistoria->getDesmoronamento()?'X':''; ?>) Desmoronamento</p>
          <p class="item-column-content">(<?php echo $dadosDaVistoria!=null && $dadosDaVistoria->getDeslizamento()?'X':''; ?>) Escorregamento</p>
          <p class="item-column-content">(<?php echo $dadosDaVistoria!=null && $dadosDaVistoria->getEsgotoEscoamento()?'X':''; ?>) Esgoto/Escoamentos</p>
          <p class="item-column-content">(<?php echo $dadosDaVistoria!=null && $dadosDaVistoria->getErosao()?'X':''; ?>) Erosão</p>
          <p class="item-column-content">(<?php echo $dadosDaVistoria!=null && $dadosDaVistoria->getInundacao()?'X':''; ?>) Inundação</p>
          <p class="item-column-content">(<?php echo $dadosDaVistoria!=null && $dadosDaVistoria->getIncendio()?'X':''; ?>) Incêndio</p>
          <p class="item-column-content">(<?php echo $dadosDaVistoria!=null && $dadosDaVistoria->getArvores()?'X':''; ?>) Árvores</p>
          <p class="item-column-content">(<?php echo $dadosDaVistoria!=null && $dadosDaVistoria->getInfiltracaoTrinca()?'X':''; ?>) Infiltrações/Trincas</p>
          <p class="item-column-content">(<?php echo $dadosDaVistoria!=null && $dadosDaVistoria->getJudicial()?'X':''; ?>) Judicial</p>
          <p class="item-column-content">(<?php echo $dadosDaVistoria!=null && $dadosDaVistoria->getMonitoramento()?'X':''; ?>) Monitoramento</p>
          <p class="item-column-content">(<?php echo $dadosDaVistoria!=null && $dadosDaVistoria->getTransito()?'X':''; ?>) Trânsito</p>
          <p class="item-column-content">(<?php echo $dadosDaVistoria!=null && $dadosDaVistoria->getOutros()?'X':''; ?>) Outros</p>
        </div>
      </div>
      <div class="gravidade row">
        <p class="item-row-title">Gravidade: </p>
        <?php echo $relatorio->getGravidade()==GRAVIDADE::RISCO? '
        <p class="item-row-content">(X) Risco</p>
        <p class="item-row-content">() Desastre</p>':(
        $relatorio->getGravidade()==GRAVIDADE::DESASTRE? '
        <p class="item-row-content">() Risco</p>
        <p class="item-row-content">(X) Desastre</p>': '
        <p class="item-row-content">() Risco</p>
        <p class="item-row-content">() Desastre</p>');?>
      </div>
      <div class="afetados row">
        <p class="item-row-title">Afetados: </p>
        <?php
          if ($afetados){
            echo '
        <p class="item-row-content">Adultos: '.$afetados->getAdultos().'</p>
        <p class="item-row-content">Crianças: '.$afetados->getCriancas().'</p>
        <p class="item-row-content">Idosos: '.$afetados->getIdosos().'</p>
        <p class="item-row-content">Deficientes: '.$afetados->getEspeciais().'</p>
        <p class="item-row-content">Feridos: '.$afetados->getFeridos().'</p>
        <p class="item-row-content">Mortos: '.$afetados->getMortos().'</p>
        <p class="item-row-content">Total: '.($afetados->getAdultos()+$afetados->getCriancas()+$afetados->getIdosos()+$afetados->getEspeciais()).'</p>';
          }
          else {
            echo '
        <p class="item-row-content">Adultos: 0</p>
        <p class="item-row-content">Crianças: 0</p>
        <p class="item-row-content">Idosos: 0</p>
        <p class="item-row-content">Deficientes: 0</p>
        <p class="item-row-content">Feridos: 0</p>
        <p class="item-row-content">Mortos: 0</p>
        <p class="item-row-content">Total: 0</p>';
          }
        ?>
      </div>
      <div class="animais row">
        <p class="item-row-title">Animais: </p>
        <?php
          if ($animal){
            echo '
        <p class="item-row-content">Cães: '.$animal->getCaes().'</p>
        <p class="item-row-content">Gatos: '.$animal->getGatos().'</p>
        <p class="item-row-content">Aves: '.$animal->getAves().'</p>
        <p class="item-row-content">Equinos: '.$animal->getEquinos().'</p>
        <p class="item-row-content">Total: '.($animal->getCaes()+$animal->getGatos()+$animal->getAves()+$animal->getEquinos()).'</p>';
          }
          else {
            echo '
        <p class="item-row-content">Cães: 0</p>
        <p class="item-row-content">Gatos: 0</p>
        <p class="item-row-content">Aves: 0</p>
        <p class="item-row-content">Equinos: 0</p>
        <p class="item-row-content">Total: 0</p>';
          }
        ?>
      </div>
      <div class="tipos">
        <div>
          <p class="item-column-title">Área Afetada</p>
          <?php 
            switch($relatorio->getAreaAfetada()){
              case AREA_AFETADA::INESPECIFICADO: {
                echo '<p class="item-column-content">(X) Não especificado</p>
          <p class="item-column-content">() Pública</p>
          <p class="item-column-content">() Particular</p>';
              }
              break;
              case AREA_AFETADA::PUBLICA: {
                echo '<p class="item-column-content">() Não especificado</p>
          <p class="item-column-content">(X) Pública</p>
          <p class="item-column-content">() Particular</p>';
              }
              break;
              case AREA_AFETADA::PARTICULAR: {
                echo '<p class="item-column-content">() Não especificado</p>
          <p class="item-column-content">() Pública</p>
          <p class="item-column-content">(X) Particular</p>';
              }
              break;
              default: {
                echo '<p class="item-column-content">() Não especificado</p>
          <p class="item-column-content">() Pública</p>
          <p class="item-column-content">() Particular</p>';
              }
            }
          ?>
        </div>
        <div>
          <p class="item-column-title">Tipo de Construção</p>
          <?php 
            switch($relatorio->getTipoConstrucao()){
              case TIPO_CONSTRUCAO::INESPECIFICADO: {
                echo '<p class="item-column-content">(X) Não especificado</p>
          <p class="item-column-content">() Alvenaria</p>
          <p class="item-column-content">() Madeira</p>
          <p class="item-column-content">() Mista</p>';
              }
              break;
              case TIPO_CONSTRUCAO::ALVENARIA: {
                echo '<p class="item-column-content">() Não especificado</p>
          <p class="item-column-content">(X) Alvenaria</p>
          <p class="item-column-content">() Madeira</p>
          <p class="item-column-content">() Mista</p>';
              }
              break;
              case TIPO_CONSTRUCAO::MADEIRA: {
                echo '<p class="item-column-content">() Não especificado</p>
          <p class="item-column-content">() Alvenaria</p>
          <p class="item-column-content">(X) Madeira</p>
          <p class="item-column-content">() Mista</p>';
              }
              break;
              case TIPO_CONSTRUCAO::MISTA: {
                echo '<p class="item-column-content">() Não especificado</p>
          <p class="item-column-content">() Alvenaria</p>
          <p class="item-column-content">() Madeira</p>
          <p class="item-column-content">(X) Mista</p>';
              }
              break;
              default: {
                echo '<p class="item-column-content">() Não especificado</p>
          <p class="item-column-content">() Alvenaria</p>
          <p class="item-column-content">() Madeira</p>
          <p class="item-column-content">() Mista</p>';
              }
            }
          ?>
        </div>
        <div>
          <p class="item-column-title">Tipo do Talude</p>
          <?php 
            switch($relatorio->getTipoTalude()){
              case TIPO_TALUDE::INESPECIFICADO: {
                echo '<p class="item-column-content">(X) Não especificado</p>
          <p class="item-column-content">() Natural</p>
          <p class="item-column-content">() De Corte</p>
          <p class="item-column-content">() Aterro</p>';
              }
              break;
              case TIPO_TALUDE::NATURAL: {
                echo '<p class="item-column-content">() Não especificado</p>
          <p class="item-column-content">(X) Natural</p>
          <p class="item-column-content">() De Corte</p>
          <p class="item-column-content">() Aterro</p>';
              }
              break;
              case TIPO_TALUDE::DE_CORTE: {
                echo '<p class="item-column-content">() Não especificado</p>
          <p class="item-column-content">() Natural</p>
          <p class="item-column-content">(X) De Corte</p>
          <p class="item-column-content">() Aterro</p>';
              }
              break;
              case TIPO_TALUDE::ATERRO: {
                echo '<p class="item-column-content">() Não especificado</p>
          <p class="item-column-content">() Natural</p>
          <p class="item-column-content">() De Corte</p>
          <p class="item-column-content">(X) Aterro</p>';
              }
              break;
              default: {
                echo '<p class="item-column-content">() Não especificado</p>
          <p class="item-column-content">() Natural</p>
          <p class="item-column-content">() De Corte</p>
          <p class="item-column-content">() Aterro</p>';
              }
            }
          ?>
        </div>
        <div>
          <p class="item-column-title">Vegetação</p>
          <?php 
            switch($relatorio->getVegetacao()){
              case VEGETACAO::NENHUMA: {
                echo '<p class="item-column-content">(X) NÃO</p>
          <p class="item-column-content">() Rasteira</p>
          <p class="item-column-content">() Árvores</p>';
              }
              break;
              case VEGETACAO::RASTEIRA: {
                echo '<p class="item-column-content">() NÃO</p>
          <p class="item-column-content">(X) Rasteira</p>
          <p class="item-column-content">() Árvores</p>';
              }
              break;
              case VEGETACAO::ARVORES: {
                echo '<p class="item-column-content">() NÃO</p>
          <p class="item-column-content">() Rasteira</p>
          <p class="item-column-content">(X) Árvores</p>';
              }
              break;
              default: {
                echo '<p class="item-column-content">() NÃO</p>
          <p class="item-column-content">() Rasteira</p>
          <p class="item-column-content">() Árvores</p>';
              }
            }
          ?>
        </div>
      </div>
      <div class="interdicao-danos">
        <div class="interdicao">
          <p class="item-row-title">Interdição: </p>
          <?php 
            switch($casa->getInterdicao()){
              case INTERDICAO::NAO: {
                echo '<p class="item-row-content">(X) Não</p>
          <p class="item-row-content">() Parcial</p>
          <p class="item-row-content">() Total</p>';
              }
              break;
              case INTERDICAO::PARCIAL: {
                echo '<p class="item-row-content">() Não</p>
          <p class="item-row-content">(X) Parcial</p>
          <p class="item-row-content">() Total</p>';
              }
              break;
              case INTERDICAO::TOTAL: {
                echo '<p class="item-row-content">() Não</p>
          <p class="item-row-content">() Parcial</p>
          <p class="item-row-content">(X) Total</p>';
              }
              break;
              default: {
                echo '<p class="item-row-content">() Não</p>
          <p class="item-row-content">() Parcial</p>
          <p class="item-row-content">() Total</p>';
              }
            }
          ?>
        </div>
        <div class="danos">
          <p class="item-row-title">Danos Materiais: </p>
          <?php echo $relatorio->getDanosMateriais()? '
          <p class="item-row-content">() Parcial</p>
          <p class="item-row-content">(X) Total</p>':
          '<p class="item-row-content">(X) Parcial</p>
          <p class="item-row-content">() Total</p>';?>
        </div>
      </div>
      <div class="memorando-oficio-processo">
        <div>
          <p class="item-row-title">Memorando: </p>
          <p class="item-row-content"><?php echo $relatorio->getMemorando();?></p>
        </div>
        <div>
          <p class="item-row-title">Ofício: </p>
          <p class="item-row-content"><?php echo $relatorio->getOficio();?></p>
        </div>
        <div>
          <p class="item-row-title">Processo: </p>
          <p class="item-row-content"><?php echo $relatorio->getProcesso();?></p>
        </div>
      </div>
      <div class="setor-data">
        <div>
          <p class="item-row-title">Setor: </p>
          <p class="item-row-content"><?php if($memo) echo $memo->getSetor(); ?></p>
        </div>
        <div>
          <p class="item-row-title">Data: </p>
          <p class="item-row-content"><?php
            if ($memo){
              $data = $memo->getDataMemo();
              echo formatDate($data);
            }
          ?></p>
        </div>
      </div>
      <div class="assunto">
        <p class="item-row-title">Assunto: </p>
        <p class="item-row-content"><?php echo $relatorio->getAssunto();?></p>
      </div>
    </div>
  </article>
</section>
</main>

</html>