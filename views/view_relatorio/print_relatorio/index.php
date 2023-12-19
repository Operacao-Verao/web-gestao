<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <title>Imprimir Relatório</title>
</head>

<?php
    require '../../../actions/conn.php';
    require '../../../actions/session_auth.php';
    authenticateSession(TIPO_USUARIO::GESTOR, '', '../../login/login.php');

    require '../../../models/Relatorio.php';
    require '../../../daos/DAORelatorio.php';
    require '../../../models/Ocorrencia.php';
    require '../../../daos/DAOOcorrencia.php';
    require '../../../models/Civil.php';
    require '../../../daos/DAOCivil.php';
    require '../../../models/Residencial.php';
    require '../../../daos/DAOResidencial.php';
    require '../../../models/Casa.php';
    require '../../../daos/DAOCasa.php';
    require '../../../models/Endereco.php';
    require '../../../daos/DAOEndereco.php';
    require '../../../models/Tecnico.php';
    require '../../../daos/DAOTecnico.php';
    require '../../../models/Funcionario.php';
    require '../../../daos/DAOFuncionario.php';
    require '../../../models/Foto.php';
    require '../../../daos/DAOFoto.php';
    require '../../../models/DadosDaVistoria.php';
    require '../../../daos/DAODadosDaVistoria.php';
    require '../../../models/Afetados.php';
    require '../../../daos/DAOAfetados.php';
    require '../../../models/Animal.php';
    require '../../../daos/DAOAnimal.php';
    require '../../../models/Memo.php';
    require '../../../daos/DAOMemo.php';

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
    if ($relatorio == null) {
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
    $atendente = $ocorrencia->getIdAtendente() ? $daoFuncionario->findById($ocorrencia->getIdAtendente()) : null;

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

<body>
    <div class="wrapper">
        <header>
            <img src="../../../assets/images/logo.jpg" alt="">
            <span>
                <p>SECRETARIA EXECUTIVA DO GABINETE DO PREFEITO
                </p>
                <p>NÚCLEO DE PROTEÇÃO E DEFESA CIVIL</p>
            </span>
            <img src="../../../assets/images/defesacivil.jpg" alt="">
        </header>
        <main>
            <section>
                <p class="section-title">Solicitação de Vistoria Nº
                    <?php echo ' ' . $ocorrencia->getId() . ' - ' . formatWeekDay($ocorrencia->getDataOcorrencia()) . ', ' . formatDate($ocorrencia->getDataOcorrencia()); ?>
                </p>
                <article>
                    <div class="item-row">
                        <p class="item-title">Nome: </p>
                        <p>
                            <?php echo $civil->getNome(); ?>
                        </p>
                    </div>
                    <div class="item-row">
                        <div class="item-row">
                            <p class="item-title">Logradouro: </p>
                            <p>
                                <?php echo $endereco->getRua(); ?>
                            </p>
                        </div>
                        <div class="item-row">
                            <p class="item-title">Nº: </p>
                            <p>
                                <?php echo $residencial->getNumero(); ?>
                            </p>
                        </div>
                    </div>
                    <div class="item-row-2">
                        <div class="item-row">
                            <p class="item-title">Tel.: </p>
                            <p>
                                <?php echo $civil->getTelefone(); ?>
                            </p>
                        </div>
                        <div class="item-row">
                            <p class="item-title">Celular.: </p>
                            <p>
                                <?php echo $civil->getCelular(); ?>
                            </p>
                        </div>
                    </div>
                    <div class="item-row-2">
                        <div class="item-row">
                            <p class="item-title">CPF: </p>
                            <p>
                                <?php echo $civil->getCpf(); ?>
                            </p>
                        </div>
                        <div class="item-row">
                            <p class="item-title">Email: </p>
                            <p>
                                <?php echo $civil->getEmail(); ?>
                            </p>
                        </div>
                    </div>
                    <div class="item-row">
                        <p class="item-title">CEP: </p>
                        <p>
                            <?php echo $endereco->getCep(); ?>
                        </p>
                    </div>
                    <div class="item-row">
                        <p class="item-title">Cidade: </p>
                        <p>
                            <?php echo $endereco->getCidade(); ?>/SP
                        </p>
                    </div>
                    <div class="item-row-2">
                        <div class="item-row">
                            <p class="item-title">Acionamento: </p>
                            <p>
                                <?php echo $ocorrencia->getAcionamento(); ?>
                            </p>
                        </div>
                        <div class="item-row">
                            <p class="item-title">Atendente: </p>
                            <p>
                                <?php echo $atendente ? $atendente->getNome() : ''; ?>
                            </p>
                        </div>
                    </div>
                    <div class="item-row">
                        <p class="item-title">Relatos: </p>
                        <p>
                            <?php echo $relatorio->getRelatorio(); ?>
                        </p>
                    </div>
                </article>
                <article>
                    <div class="item-row">
                        <p class="item-title">Descrição/Orientações: </p>
                        <p class="item-description">
                            <?php echo $ocorrencia->getRelatoCivil(); ?>
                        </p>
                    </div>
                </article>
                <div class="assinatura">
                    <div>
                        <p><br /><br /></p>
                        <p class="item-title">Assinatura (Gestor): </p>
                    </div>
                    <div>
                        <p><br /><br /></p>
                        <p class="item-title">Assinatura (Técnico): </p>
                    </div>
                </div>
                <div class="data-horario">
                    <?php
                    $current_time = getCurrentDatetime();
                    ?>
                    <div>
                        <p class="item-title">Data: </p>
                        <p>
                            <?php echo formatDate($current_time); ?>
                        </p>
                    </div>
                    <div>
                        <p class="item-title">Horário: </p>
                        <p>
                            <?php echo formatTime($current_time); ?>
                        </p>
                    </div>
                    <div>
                        <p class="item-title">Agente: </p>
                        <p>
                            <?php echo $funcionario->getNome(); ?>
                        </p>
                    </div>
                </div>
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
                <div class="pagebreak"></div>
                <article>
                    <div class="item-row">
                        <p class="item-title">Dados da Vistoria: </p>
                    </div>
                    <div class="item-dadosVistoria">
                        <p>(
                            <?php echo $dadosDaVistoria != null && $dadosDaVistoria->getDesmoronamento() ? 'X' : ''; ?>)
                            Desmoronamento
                        </p>
                        <p>(
                            <?php echo $dadosDaVistoria != null && $dadosDaVistoria->getDeslizamento() ? 'X' : ''; ?>)
                            Escorregamento
                        </p>
                        <p>(
                            <?php echo $dadosDaVistoria != null && $dadosDaVistoria->getEsgotoEscoamento() ? 'X' : ''; ?>)
                            Esgoto/Escoamentos
                        </p>
                        <p>(
                            <?php echo $dadosDaVistoria != null && $dadosDaVistoria->getErosao() ? 'X' : ''; ?>) Erosão
                        </p>
                        <p>(
                            <?php echo $dadosDaVistoria != null && $dadosDaVistoria->getInundacao() ? 'X' : ''; ?>) Inundação
                        </p>
                        <p>(
                            <?php echo $dadosDaVistoria != null && $dadosDaVistoria->getIncendio() ? 'X' : ''; ?>) Incêndio
                        </p>
                        <p>(
                            <?php echo $dadosDaVistoria != null && $dadosDaVistoria->getArvores() ? 'X' : ''; ?>) Árvores
                        </p>
                        <p>(
                            <?php echo $dadosDaVistoria != null && $dadosDaVistoria->getInfiltracaoTrinca() ? 'X' : ''; ?>)
                            Infiltrações/Trincas
                        </p>
                        <p>(
                            <?php echo $dadosDaVistoria != null && $dadosDaVistoria->getJudicial() ? 'X' : ''; ?>) Judicial
                        </p>
                        <p>(
                            <?php echo $dadosDaVistoria != null && $dadosDaVistoria->getMonitoramento() ? 'X' : ''; ?>)
                            Monitoramento
                        </p>
                        <p>(
                            <?php echo $dadosDaVistoria != null && $dadosDaVistoria->getTransito() ? 'X' : ''; ?>) Trânsito
                        </p>
                        <p>(
                            <?php echo $dadosDaVistoria != null && $dadosDaVistoria->getOutros() ? 'X' : ''; ?>) Outros
                        </p>
                    </div>
                    <div class="item-row">
                        <p class="item-title">Gravidade: </p>
                        <?php echo $relatorio->getGravidade() == GRAVIDADE::RISCO ? '
        <p>(X) Risco</p>
        <p>() Desastre</p>' : (
                            $relatorio->getGravidade() == GRAVIDADE::DESASTRE ? '
        <p>() Risco</p>
        <p>(X) Desastre</p>' : '
        <p>() Risco</p>
        <p>() Desastre</p>'); ?>
                    </div>
                    <div class="item-row">
                        <p class="item-title">Afetados: </p>
                        <?php
                        if ($afetados) {
                            echo '
                        <p>Adultos: ' . $afetados->getAdultos() . '</p>
                        <p>Crianças: ' . $afetados->getCriancas() . '</p>
                        <p>Idosos: ' . $afetados->getIdosos() . '</p>
                        <p>Deficientes: ' . $afetados->getEspeciais() . '</p>
                        <p>Total: ' . ($afetados->getAdultos() + $afetados->getCriancas() + $afetados->getIdosos() + $afetados->getEspeciais()) . '</p>&nbsp;|&nbsp;
                        <p>Feridos: ' . $afetados->getFeridos() . '</p>
                        <p>Mortos: ' . $afetados->getMortos() . '</p>';
                        } else {
                            echo '
                        <p>Adultos: 0</p>
                        <p>Crianças: 0</p>
                        <p>Idosos: 0</p>
                        <p>Deficientes: 0</p>
                        <p>Total: 0</p>&nbsp;|&nbsp;
                        <p>Feridos: 0</p>
                        <p>Mortos: 0</p>';
                        }
                        ?>
                    </div>
                    <div class="item-row">
                        <p class="item-title">Animais: </p>
                        <div class="item-grid5">
                            <?php
                            if ($animal) {
                                echo '
                            <p>Cães: ' . $animal->getCaes() . '</p>
                            <p>Gatos: ' . $animal->getGatos() . '</p>
                            <p>Aves: ' . $animal->getAves() . '</p>
                            <p>Equinos: ' . $animal->getEquinos() . '</p>
                            <p>Total: ' . ($animal->getCaes() + $animal->getGatos() + $animal->getAves() + $animal->getEquinos()) . '</p>';
                            } else {
                                echo '
                            <p>Cães: 0</p>
                            <p>Gatos: 0</p>
                            <p>Aves: 0</p>
                            <p>Equinos: 0</p>
                            <p>Total: 0</p>';
                            }
                            ?>
                        </div>
                    </div>
                    <div class="item-grid4">
                        <div class="item-column">
                            <p class="item-title">Área Afetada</p>
                            <?php
                            switch ($relatorio->getAreaAfetada()) {
                                case AREA_AFETADA::INESPECIFICADO: {
                                        echo '<p>(X) Não especificado</p>
                              <p>() Pública</p>
                              <p>() Particular</p>';
                                    }
                                    break;
                                case AREA_AFETADA::PUBLICA: {
                                        echo '<p>() Não especificado</p>
                              <p>(X) Pública</p>
                              <p>() Particular</p>';
                                    }
                                    break;
                                case AREA_AFETADA::PARTICULAR: {
                                        echo '<p>() Não especificado</p>
                              <p>() Pública</p>
                              <p>(X) Particular</p>';
                                    }
                                    break;
                                default: {
                                        echo '<p>() Não especificado</p>
                              <p>() Pública</p>
                              <p>() Particular</p>';
                                    }
                            }
                            ?>
                        </div>
                        <div class="item-column">
                            <p class="item-title">Tipo de Construção</p>
                            <?php
                            switch ($relatorio->getTipoConstrucao()) {
                                case TIPO_CONSTRUCAO::INESPECIFICADO: {
                                        echo '<p>(X) Não especificado</p>
                              <p>() Alvenaria</p>
                              <p>() Madeira</p>
                              <p>() Mista</p>';
                                    }
                                    break;
                                case TIPO_CONSTRUCAO::ALVENARIA: {
                                        echo '<p>() Não especificado</p>
                              <p>(X) Alvenaria</p>
                              <p>() Madeira</p>
                              <p>() Mista</p>';
                                    }
                                    break;
                                case TIPO_CONSTRUCAO::MADEIRA: {
                                        echo '<p>() Não especificado</p>
                              <p>() Alvenaria</p>
                              <p>(X) Madeira</p>
                              <p>() Mista</p>';
                                    }
                                    break;
                                case TIPO_CONSTRUCAO::MISTA: {
                                        echo '<p>() Não especificado</p>
                              <p>() Alvenaria</p>
                              <p>() Madeira</p>
                              <p>(X) Mista</p>';
                                    }
                                    break;
                                default: {
                                        echo '<p>() Não especificado</p>
                              <p>() Alvenaria</p>
                              <p>() Madeira</p>
                              <p>() Mista</p>';
                                    }
                            }
                            ?>
                        </div>
                        <div class="item-column">
                            <p class="item-title">Tipo do Talude</p>
                            <?php
                            switch ($relatorio->getTipoTalude()) {
                                case TIPO_TALUDE::INESPECIFICADO: {
                                        echo '<p>(X) Não especificado</p>
                              <p>() Natural</p>
                              <p>() De Corte</p>
                              <p>() Aterro</p>';
                                    }
                                    break;
                                case TIPO_TALUDE::NATURAL: {
                                        echo '<p>() Não especificado</p>
                              <p>(X) Natural</p>
                              <p>() De Corte</p>
                              <p>() Aterro</p>';
                                    }
                                    break;
                                case TIPO_TALUDE::DE_CORTE: {
                                        echo '<p>() Não especificado</p>
                              <p>() Natural</p>
                              <p>(X) De Corte</p>
                              <p>() Aterro</p>';
                                    }
                                    break;
                                case TIPO_TALUDE::ATERRO: {
                                        echo '<p>() Não especificado</p>
                              <p>() Natural</p>
                              <p>() De Corte</p>
                              <p>(X) Aterro</p>';
                                    }
                                    break;
                                default: {
                                        echo '<p>() Não especificado</p>
                              <p>() Natural</p>
                              <p>() De Corte</p>
                              <p>() Aterro</p>';
                                    }
                            }
                            ?>
                        </div>
                        <div class="item-column">
                            <p class="item-title">Vegetação</p>
                            <?php
                            switch ($relatorio->getVegetacao()) {
                                case VEGETACAO::NENHUMA: {
                                        echo '<p>(X) NÃO</p>
                              <p>() Rasteira</p>
                              <p>() Árvores</p>';
                                    }
                                    break;
                                case VEGETACAO::RASTEIRA: {
                                        echo '<p>() NÃO</p>
                              <p>(X) Rasteira</p>
                              <p>() Árvores</p>';
                                    }
                                    break;
                                case VEGETACAO::ARVORES: {
                                        echo '<p>() NÃO</p>
                              <p>() Rasteira</p>
                              <p>(X) Árvores</p>';
                                    }
                                    break;
                                default: {
                                        echo '<p>() NÃO</p>
                              <p>() Rasteira</p>
                              <p>() Árvores</p>';
                                    }
                            }
                            ?>
                        </div>
                    </div>
                    <div class="item-row-2">
                        <div class="item-row">
                            <p class="item-title">Situação</p>
                            <?php
                            switch ($relatorio->getSituacaoVitimas()) {
                                case SITUACAO_VITIMAS::DESABRIGADOS: {
                                        echo '<p>(X) Desabrigados</p>
                            <p>() Desalojados</p>';
                                    }
                                    break;
                                case SITUACAO_VITIMAS::DESALOJADOS: {
                                        echo '<p>() Desabrigados</p>
                            <p>(X) Desalojados</p>';
                                    }
                                    break;
                                default: {
                                        echo '<p>() Desabrigados</p>
                            <p>() Desalojados</p>';
                                    }
                            }
                            ?>
                        </div>
                        <!--
                        <div class="item-row">
                            <p class="item-title">Observação:</p>
                            <p>¯\_(ツ)_/¯<?php /*echo $relatorio->getObservacoes();*/?></p>
                        </div>
                        -->
                    </div>
                    <div class="item-row-2">
                        <div class="item-row">
                            <p class="item-title">Interdição</p>
                            <?php
                            switch ($relatorio->getInterdicao()) {
                                case INTERDICAO::NAO: {
                                        echo '<p>(X) NÃO</p>
                            <p>() SIM</p>
                            <p>() Parcial</p>';
                                    }
                                    break;
                                case INTERDICAO::PARCIAL: {
                                        echo '<p>() NÃO</p>
                            <p>() SIM</p>
                            <p>(X) Parcial</p>';
                                    }
                                    break;
                                case INTERDICAO::TOTAL: {
                                        echo '<p>() NÃO</p>
                            <p>(X) SIM</p>
                            <p>() Parcial</p>';
                                    }
                                    break;
                                default: {
                                        echo '<p>() NÃO</p>
                            <p>() SIM</p>
                            <p>() Parcial</p>';
                                    }
                            }
                            ?>
                        </div>
                        <div class="item-row">
                            <p class="item-title">Danos Materiais</p>
                            <?php echo $relatorio->getDanosMateriais() ? '
                                  <p>() Parcial</p>
                                  <p>(X) Total</p>' :
                                '<p>(X) Parcial</p>
                                  <p>() Total</p>'; ?>
                        </div>
                    </div>
                    <div class="item-row">
                        <p class="item-title">Encaminhamentos: </p>
                        <p>
                            <?php echo $relatorio->getEncaminhamento(); ?>
                        </p>
                    </div>
                    <div class="item-grid3">
                        <div class="item-row">
                            <p class="item-title">Memorando: </p>
                            <p>
                                <?php if ($memo)
                                    echo $memo->getMemorando(); ?>
                            </p>
                        </div>
                        <div class="item-row">
                            <p class="item-title">Ofício: </p>
                            <p>
                                <?php if ($memo)
                                    echo $memo->getOficio(); ?>
                            </p>
                        </div>
                        <div class="item-row">
                            <p class="item-title">Processo: </p>
                            <p>
                                <?php if ($memo)
                                    echo $memo->getProcesso(); ?>
                            </p>
                        </div>
                    </div>
                    <div class="item-row-2">
                        <div class="item-row">
                            <p class="item-title">
                                Setor:
                            </p>
                            <p>
                                <?php if ($memo)
                                    echo $memo->getSetor(); ?>
                            </p>
                        </div>
                        <div class="item-row">
                            <p class="item-title">Data: </p>
                            <p>
                                <?php
                                if ($memo) {
                                    $data = $memo->getDataMemo();
                                    echo formatDate($data);
                                }
                                ?>
                            </p>
                        </div>
                    </div>
                    <div class="item-row">
                        <p class="item-title">Assunto: </p>
                        <p>
                            <?php echo $relatorio->getAssunto(); ?>
                        </p>
                    </div>
                    <div class="item-row">
                        <p class="item-title">Observações: </p>
                        <p>
                            <?php echo $relatorio->getObservacoes(); ?>
                        </p>
                    </div>
                </article>
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
            </section>
        </main>
    </div>
</body>

<script type="text/javascript">

    window.onload = function () {
        print();
    }

</script>

</html>