<?php
    $input = json_decode(file_get_contents('php://input'), true);

  	require '../conn.php';
    require '../../models/Residencial.php';
    require '../../daos/DAOResidencial.php';
    require '../../models/Casa.php';
    require '../../daos/DAOCasa.php';
    require '../../models/Relatorio.php';
    require '../../daos/DAORelatorio.php';

    try {
      $daoResidencial = new DAOResidencial($pdo);
      $daoCasa = new DAOCasa($pdo);
      $daoRelatorio = new DAORelatorio($pdo);

      $casa = $daoCasa->findById($input['id']);

      if ($casa == null){
        echo '{}';
        exit();
      }

      $residencial = $daoResidencial->findById($casa->getIdResidencial());
      $relatorios = $daoRelatorio->findByCasa($casa);

      echo '{
        "cep": "'.$residencial->getCep().'",
        "numero": "'.$residencial->getNumero().'",
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