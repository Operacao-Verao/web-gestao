<?php
    $input = json_decode(file_get_contents('php://input'), true);

  	require '../conn.php';
    require '../../models/Local.php';
    require '../../daos/DAOLocal.php';
    require '../../models/Casa.php';
    require '../../daos/DAOCasa.php';
    require '../../models/Relatorio.php';
    require '../../daos/DAORelatorio.php';

    try {
      $daoLocal = new DAOLocal($pdo);
      $daoCasa = new DAOCasa($pdo);
      $daoRelatorio = new DAORelatorio($pdo);

      $casa = $daoCasa->findById($input['id']);

      if ($casa == null){
        echo '{}';
        exit();
      }

      $local = $daoLocal->findById($casa->getIdLocal());
      $relatorios = $daoRelatorio->findByCasa($casa);

      echo '{
        "cep": "'.$local->getCep().'",
        "numero": "'.$local->getNumero().'",
        "complemento": "'.$casa->getComplemento().'",
        "interdicao": "'.addslashes($casa->getInterdicao()).'",
        "relatorios": [
      ';

      $first = true;

      foreach ($relatorios as $relatorio){
          if ($first){
            $first = false;
          }
          else {
            echo ',';
          }
          echo '{}';
      }
      echo ']}';
    } catch (\Throwable $th) {
      echo $th;
    }
    
?>