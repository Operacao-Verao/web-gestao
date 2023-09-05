<!DOCTYPE html>
<html lang="pt-br">

<head>
  <link rel="stylesheet" href="./styles.css" />
  <title>Defesa Civil - Relatórios</title>
</head>

<?php
require '../../partials/header/header.php';

session_start();
if (empty($_SESSION['usuario_id']) || empty($_SESSION['usuario_id']) || empty($_SESSION['usuario_id'])) {
  session_destroy();
  header("Location: ../login/login.php");
}
;
?>

<div class="dash-content">
  <section class="activity">
    <div class="search-space">
      <div class="search-div">
        <input type="search" oninput="searchOcorrencias(this.value)" id="search_ocorrencia"
          placeholder="Procurar Ocorrencias..." />
        <i class="ph ph-magnifying-glass"></i>
      </div>
    </div>
    <div class="activity-data">
      <div class="data address">
        <span class="data-title">Endereço</span>
        <span class="data-list">Rua Paulistana - 300 (Centro)</span>
        <span class="data-list">Rua Paulistana - 300 (Centro)</span>
        <span class="data-list">Rua Paulistana - 300 (Centro)</span>
      </div>
      <div class="data names">
        <span class="data-title">Técnico</span>
        <span class="data-list">Malcolm Mello</span>
        <span class="data-list">Malcolm Mello</span>
        <span class="data-list">Malcolm Mello</span>
      </div>
      <div class="data request">
        <span class="data-title">Data</span>
        <span class="data-list">20/05/2023</span>
        <span class="data-list">20/05/2023</span>
        <span class="data-list">20/05/2023</span>
      </div>
      <div class="data ver">
        <span class="data-title">Ver</span>
        <span class="data-list"><i class="ph-bold ph-eye"></i></span>
        <span class="data-list"><i class="ph-bold ph-eye"></i></span>
        <span class="data-list"><i class="ph-bold ph-eye"></i></span>
      </div>
    </div>
  </section>

</div>
</main>

</html>