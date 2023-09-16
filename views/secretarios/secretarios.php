<!DOCTYPE html>
<html lang="pt-br">

<head>
  <link rel="stylesheet" href="./styles.css" />
  <title>Defesa Civil - Secretários</title>
</head>

<?php
require '../../partials/header/header.php';
?>
<div id="body">
  <div class="wrapper-main">
    <section class="activity-data">
      <div class="data name" id="list_nomes">
        <span class="data-title">Nome</span>
        <span class="data-list">Luiz Fernando Rodrigues</span>
      </div>
      <div class="data cargo" id="list_cargos">
        <span class="data-title">Cargo</span>
        <span class="data-list">Secretário de Governo e Segurança Pública</span>
      </div>
      <div class="data secretaria" id="list_secretaria">
        <span class="data-title">Secretaria</span>
        <span class="data-list">Secretaria de Governo e Segurança Pública</span>
      </div>
      <div class="data editar" id="list_edits">
        <span class="data-title">Editar</span>
        <span class="data-list"><a href="#"><i class="ph-bold ph-pencil"></i></a></span>
      </div>
    </section>
    <a href="#"><button class="btnCadastrar">Cadastrar Secretário</button></a>
  </div>

  <!--MODAL CADASTRAR SECRETÁRIO-->
  <section id="viewSecretario" class="viewSecretario">
    <div class="topRow">
      <h2>Cadastrar Secretário</h1>
        <button onclick="closeModal()"><i class="ph-bold ph-x"></i></button>
    </div>
    <form class="secretario-content">
      <div>
        <div class="inputArea">
          <label for="">Nome</label>
          <input type="text">
        </div>
        <div class="inputArea">
          <label for="">Nome</label>
          <input type="text">
        </div>
        <div class="inputArea">
          <label for="">Secretaria</label>
          <select name="selectSecretaria" id="selectSecretaria">
            <option selected disabled hidden>Selecionar</option>
            <option value="1" disabled>Secretaria de Governo e Segurança Pública</option>
          </select>
        </div>
      </div>
      <button class="btnCadastrarSecretario">Cadastrar</button>
    </form>
  </section>
</div>

</main>

</html>