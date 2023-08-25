<!DOCTYPE html>

<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="styles.css">
  <title>Defesa Civil - Civil</title>
</head>
<?php
require '../../partials/header/header.php';
?>
<div id="body">
  <div class="wrapper-main">
    <section class="search-space">
      <div class="search-div">
        <input type="search" placeholder="Procurar Ocorrencias..." />
        <i class="ph ph-magnifying-glass"></i>
      </div>
    </section>
    <section class="activity-data">
      <div class="data name">
        <span class="data-title">Nome</span>
        <span class="data-list">Samantha Zduniak</span>
        <span class="data-list">Samantha Zduniak</span>
        <span class="data-list">Samantha Zduniak</span>
        <span class="data-list">Samantha Zduniak</span>
        <span class="data-list">Samantha Zduniak</span>
      </div>
      <div class="data email">
        <span class="data-title">Email</span>
        <span class="data-list">samanthazduniak@gmail.com</span>
        <span class="data-list">samanthazduniak@gmail.com</span>
        <span class="data-list">samanthazduniak@gmail.com</span>
        <span class="data-list">samanthazduniak@gmail.com</span>
        <span class="data-list">samanthazduniak@gmail.com</span>
      </div>
      <div class="data cpf">
        <span class="data-title">CPF</span>
        <span class="data-list">541.024.030-10</span>
        <span class="data-list">541.024.030-10</span>
        <span class="data-list">541.024.030-10</span>
        <span class="data-list">541.024.030-10</span>
        <span class="data-list">541.024.030-10</span>
      </div>
      <div class="data ver">
        <span class="data-title">Ver</span>
        <button class="data-list" onclick="openModal('viewCivil')"><i class="ph-bold ph-eye"></i></button>
        <button class="data-list" onclick="openModal('viewCivil')"><i class="ph-bold ph-eye"></i></button>
        <button class="data-list" onclick="openModal('viewCivil')"><i class="ph-bold ph-eye"></i></button>
        <button class="data-list" onclick="openModal('viewCivil')"><i class="ph-bold ph-eye"></i></button>
        <button class="data-list" onclick="openModal('viewCivil')"><i class="ph-bold ph-eye"></i></button>
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
        <p class="item-content">Samantha Zduniak</p>
      </div>
      <div class="civil-item">
        <p class="item-title">Cep</p>
        <p class="item-content">07851-120</p>
      </div>
      <div class="civil-item">
        <p class="item-title">Celular</p>
        <p class="item-content">Não Cadastrado</p>
      </div>
      <div class="civil-item">
        <p class="item-title">Email</p>
        <p class="item-content">samanthazduniak@gmail.com</p>
      </div>
      <div class="civil-item">
        <p class="item-title">CPF</p>
        <p class="item-content">642.024.030-10</p>
      </div>
      <div class="civil-item">
        <p class="item-title">Telefone</p>
        <p class="item-content">1140028922</p>
      </div>
    </div>
    <div class="ocorrencias-content">
      <h3>Ocorrências</h2>
        <div class="ocorrencias">
          <div class="ocorrencias-items">
            <div class="ocorrencia-item">
              <div class="ocorrencia-date">
                <p>20/05</p>
                <p>14:20</p>
              </div>
              <div class="ocorrencia-info">
                <div class="ocorrencia-title">
                  <p>Rua - Número da Casa (Bairro)</p>
                  <i class="ph ph-eye"></i>
                </div>
                <div class="ocorrencia-subtitle">
                  <p>Observação da ocorrência</p>
                </div>
              </div>
            </div>
            <div class="ocorrencia-item">
              <div class="ocorrencia-date">
                <p>20/05</p>
                <p>14:20</p>
              </div>
              <div class="ocorrencia-info">
                <div class="ocorrencia-title">
                  <p>Rua - Número da Casa (Bairro)</p>
                  <i class="ph ph-eye"></i>
                </div>
                <div class="ocorrencia-subtitle">
                  <p>Observação da ocorrência</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <a href="../ocorrencias/ocorrencias.php"><button class="btnCriarOcorrencia">Criar Ocorrência</button></a>
    </div>
  </section>
</div>
<!--MODAL VISUALIZAR CIVIL-->
</main>
<script src="script.js"></script>

</html>