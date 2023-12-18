<!DOCTYPE html>

<head>
  <link rel="stylesheet" href="./styles.css" />
  <title>Defesa Civil - Memorandos</title>
</head>

<?php
require '../../partials/header/header.php';
authenticateSession(TIPO_USUARIO::GESTOR, '', '../login/login.php');
?>
<div class="dash-content">
  <section class="activity">
    <div>
      <div class="search-space">
        <div class="search-div">
          <input type="search" id="search_memorando" placeholder="Procurar Memorando..." />
          <i class="ph ph-magnifying-glass"></i>
        </div>
      </div>
      <div class="activity-data" id="memorandos_list">
        <div class="data address">
          <span class="data-title">Endereço</span>
          <span class="data-list">Rua Braz Cubas - 256 (Vila Santista)</span>
          <span class="data-list">Rua Braz Cubas - 256 (Vila Santista)</span>
          <span class="data-list">Rua Braz Cubas - 256 (Vila Santista)</span>
        </div>
        <div class="data memorando">
          <span class="data-title">Memorando</span>
          <span class="data-list">Nº 819/2023</span>
          <span class="data-list">Nº 819/2023</span>
          <span class="data-list">Nº 819/2023</span>
        </div>
        <div class="data date">
          <span class="data-title">Data</span>
          <span class="data-list">28/11/2023</span>
          <span class="data-list">28/11/2023</span>
          <span class="data-list">28/11/2023</span>
        </div>
        <div class="data ver">
          <span class="data-title">Ver</span>
          <span class="data-list"><a href="../view_memorandos/view_memorandos.php"><i
                class="ph-bold ph-eye"></i></a></span>
          <span class="data-list"><a href="../view_memorandos/view_memorandos.php"><i
                class="ph-bold ph-eye"></i></a></span>
          <span class="data-list"><a href="../view_memorandos/view_memorandos.php"><i
                class="ph-bold ph-eye"></i></a></span>
        </div>
      </div>
    </div>
    <div class="pagination" id="pagination_footer"></div>
  </section>
</div>
</main>

</html>