<?php
    $input = json_decode(file_get_contents('php://input'), true);

  	require '../conn.php';
    require '../../models/Casa.php';
    require '../../daos/DAOCasa.php';
    require '../../models/Relatorio.php';
    require '../../daos/DAORelatorio.php';

    try {
      $daoCasa = new DAOCasa($pdo);
      $daoRelatorio = new DAORelatorio($pdo);

      $casa = $daoCasa->findById($input['id']);

      if ($casa == null){
        echo '{}';
        exit();
      }

      $relatorios = $daoRelatorio->findByCasa($casa->getId());

      echo '{
        "cep": "'.$casa->getCep().'",
        "numero": "'.$casa->getNumero().'",
        "complemento": "'.$casa->getComplemento().'",
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
          echo '{
            "interdicao": "'.addslashes($relatorio->getInterdicao()).'"
          }';
      }
      echo ']}';
    } catch (\Throwable $th) {
      echo $th;
    }
    
?>