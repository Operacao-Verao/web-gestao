<?php
    $input = json_decode(file_get_contents('php://input'), true);

  	require '../conn.php';
    require '../../models/Residencial.php';
    require '../../daos/DAOResidencial.php';
    require '../../models/Casa.php';
    require '../../daos/DAOCasa.php';

    $daoResidencial = new DAOResidencial($pdo);
    $daoCasa = new DAOCasa($pdo);

    $casas = $daoCasa->listBySearch($input['text']);

    if($casas == null) {
      echo '{}';
		  exit();
    }

    $first = true;
    
    echo '[';
      foreach($casas as $casa) {
        $residencial = $daoResidencial->findById($casa->getIdResidencial());
        if ($first){
          $first = false;
        }
        else {
          echo ',';
        }
        echo '{
          "id": "'.$casa->getId().'",
          "cep": "'.$residencial->getCep().'",
          "numero": "'.$residencial->getNumero().'",
          "complemento": "'.$casa->getComplemento().'"
        }';
      }
    echo ']';
?>