<!DOCTYPE html>

<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="styles.css">
  <title>Defesa Civil - Civil</title>
</head>
<?php
  require '../../partials/header/header.php';
  
  require '../../actions/conn.php';
  require '../../models/Civil.php';
  require '../../daos/DAOCivil.php';
  
  require '../../models/Ocorrencia.php';
  require '../../daos/DAOOcorrencia.php';
  require '../../models/Relatorio.php';
  require '../../daos/DAORelatorio.php';
  require '../../models/Casa.php';
  require '../../daos/DAOCasa.php';
  require '../../models/Endereco.php';
  require '../../daos/DAOEndereco.php';
  
  $daoCivil = new DAOCivil($pdo);
  $civis = $daoCivil->listAll();
?>
<div id="body">
  <div class="wrapper-main">
    <section class="search-space">
      <div class="search-div">
        <input type="search" placeholder="Procurar Civis..." />
        <i class="ph ph-magnifying-glass"></i>
      </div>
    </section>
    <section class="activity-data">
      <div class="data name">
        <span class="data-title">Nome</span>
        <?php
          foreach ($civis as $civil){
            echo '<span class="data-list">'.$civil->getNome().'</span>';
          }
        ?>
      </div>
      <div class="data email">
        <span class="data-title">Email</span>
        <?php
          foreach ($civis as $civil){
            echo '<span class="data-list">'.$civil->getEmail().'</span>';
          }
        ?>
      </div>
      <div class="data cpf">
        <span class="data-title">CPF</span>
        <?php
          foreach ($civis as $civil){
            echo '<span class="data-list">'.$civil->getCpf().'</span>';
          }
        ?>
      </div>
      <div class="data ver">
        <span class="data-title">Ver</span>
        <?php
          $daoOcorrencia = new DAOOcorrencia($pdo);
          $daoRelatorio = new DAORelatorio($pdo);
          $daoCasa = new DAOCasa($pdo);
          $daoEndereco = new DAOEndereco($pdo);
          
          $relatorios = $daoRelatorio->listAll();
          
          foreach ($civis as $civil){
            $casa = $civil->getIdCasa()!=null? $daoCasa->findById($civil->getIdCasa()): null;
            
            $data = array(
              'id' => $civil->getId(),
              'nome' => $civil->getNome(),
              'cep' => $casa? $casa->getCep(): '-Não Cadastrado-',
              'celular' => $civil->getCelular(),
              'email' => $civil->getEmail(),
              'cpf' => $civil->getCpf(),
              'telefone' => $civil->getTelefone(),
              'ocorrencias' => array()
            );
            
            $ocorrencias = array();
            
            foreach ($relatorios as $relatorio){
              $ocorrencia = $daoOcorrencia->findById($relatorio->getIdOcorrencia());
              $casa = $daoCasa->findById($relatorio->getIdCasa());
              $endereco = $daoEndereco->findByCep($casa->getCep());
              if ($ocorrencia->getIdCivil() == $civil->getId()){
                
                $data['ocorrencias'][] = array(
                  'data' => $ocorrencia->getDataOcorrencia(),
                  'rua' => $endereco->getRua(),
                  'numero' => $casa->getNumero(),
                  'bairro' => $endereco->getBairro(),
                  'observacoes' => $ocorrencia->getRelatoCivil()
                );
              }
            }
            
            echo '<button class="data-list" onclick=\'openModal("viewCivil", '.json_encode($data).')\'><i class="ph-bold ph-eye"></i></button>';
          }
        ?>
      </div>
    </section>
    <a href="./cad_civil/cad_civil.php"><button class="btnCadastrar">Cadastrar Civil</button></a>
  </div>

  <!--MODAL VISUALIZAR CIVIL-->
  <section id="viewCivil" class="viewCivil">
    <div class="topRow">
      <h2>Visualizar Civil</h1>
        <button onclick="closeModal()"><i class="ph-bold ph-x"></i></button>
    </div>
    <div class="civil-content">
      <div class="civil-item">
        <p class="item-title">Nome</p>
        <p class="item-content" id="view_nome">Samantha Zduniak</p>
      </div>
      <div class="civil-item">
        <p class="item-title">Cep</p>
        <p class="item-content" id="view_cep">07851-120</p>
      </div>
      <div class="civil-item">
        <p class="item-title">Celular</p>
        <p class="item-content" id="view_celular">Não Cadastrado</p>
      </div>
      <div class="civil-item">
        <p class="item-title">Email</p>
        <p class="item-content" id="view_email">samanthazduniak@gmail.com</p>
      </div>
      <div class="civil-item">
        <p class="item-title">CPF</p>
        <p class="item-content" id="view_cpf">642.024.030-10</p>
      </div>
      <div class="civil-item">
        <p class="item-title">Telefone</p>
        <p class="item-content" id="view_telefone">1140028922</p>
      </div>
    </div>
    <div class="ocorrencias-content">
      <h3>Ocorrências</h3>
        <div class="ocorrencias">
          <div class="ocorrencias-items" id="lista_ocorrencias">
            
          </div>
        </div>
        <a onclick="goToOcorrenciaCreation()"><button class="btnCriarOcorrencia">Criar Ocorrência</button></a>
    </div>
  </section>
</div>
<!--MODAL VISUALIZAR CIVIL-->
</main>
<script>
  let selected_email = null;
  
  function goToOcorrenciaCreation(){
    goToAction('../ocorrencias/cad_ocorrencia/cad_ocorrencia.php', {
      'selected_email': {
        'type': 'text',
        'value': selected_email
      }
    });
  }
  
  function goToAction(action, values={}){
    let form = document.createElement('form');
    form.method = 'post';
    form.action = action;
    let submit = document.createElement('input');
    submit.type = 'submit';
    form.appendChild(submit);
    
    for (let name in values){
      let value = document.createElement('input');
      value.name = name;
      value.type = values[name].type || 'text';
      value.value = values[name].value;
      form.appendChild(value);
    }
    
    document.body.appendChild(form);
    submit.click();
    form.remove();
  }
  
  function openModal(id, data={}) {
    document.getElementById(id).classList.add('open');
    
    // Data Filling
    selected_email = data.email;
    view_nome.textContent = data.nome;
    view_cep.textContent = data.cep;
    view_celular.textContent = data.celular;
    view_email.textContent = data.email;
    view_cpf.textContent = data.cpf;
    view_telefone.textContent = data.telefone;
    
    console.log(data.ocorrencias);
    
    let ocorrencias_conteudo = '';
    for (let i=0; i<data.ocorrencias.length; i++){
      let ocorrencia = data.ocorrencias[i];
      ocorrencias_conteudo += `<div class="ocorrencia-item">
              <div class="ocorrencia-date">
                <p>`+ocorrencia.data+`</p>
                <p>14:20</p>
              </div>
              <div class="ocorrencia-info">
                <div class="ocorrencia-title">
                  <p>`+ocorrencia.rua+` - `+ocorrencia.numero+` (`+ocorrencia.bairro+`)</p>
                  <i class="ph ph-eye"></i>
                </div>
                <div class="ocorrencia-subtitle">
                  <p>`+ocorrencia.observacoes+`</p>
                </div>
              </div>
            </div>`;
    }
    lista_ocorrencias.innerHTML = ocorrencias_conteudo;
    
    console.log("teste");
  }

  function closeModal() {
    document.querySelector('.viewCivil.open').classList.remove('open');
  }
</script>

</html>