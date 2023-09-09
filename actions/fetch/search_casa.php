<?php
    $input = json_decode(file_get_contents('php://input'), true);

  	require '../conn.php';
    require '../../models/Casa.php';
    require '../../daos/DAOCasa.php';

    $daoCasa = new DAOCasa($pdo);

    $casas = $daoCasa->findBySearch($input['text']);

    if($casas == null) {
      echo '{}';
		  exit();
    }

    $first = true;
    
    echo '[';
      foreach($casas as $casa) {
        if ($first){
          $first = false;
        }
        else {
          echo ',';
        }
        echo '{
          "id": "'.$casa->getId().'",
          "cep": "'.$casa->getCep().'",
          "numero": "'.$casa->getNumero().'",
          "complemento": "'.$casa->getComplemento().'"
        }';
      }
    echo ']';
?>