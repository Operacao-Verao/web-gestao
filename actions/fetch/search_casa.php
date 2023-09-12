<?php
    $input = json_decode(file_get_contents('php://input'), true);

  	require '../conn.php';
    require '../../models/Local.php';
    require '../../daos/DAOLocal.php';
    require '../../models/Casa.php';
    require '../../daos/DAOCasa.php';

    $daoLocal = new DAOLocal($pdo);
    $daoCasa = new DAOCasa($pdo);

    $casas = $daoCasa->listBySearch($input['text']);

    if($casas == null) {
      echo '{}';
		  exit();
    }

    $first = true;
    
    echo '[';
      foreach($casas as $casa) {
        $local = $daoLocal->findById($casa->getIdLocal());
        if ($first){
          $first = false;
        }
        else {
          echo ',';
        }
        echo '{
          "id": "'.$casa->getId().'",
          "cep": "'.$local->getCep().'",
          "numero": "'.$local->getNumero().'",
          "complemento": "'.$casa->getComplemento().'"
        }';
      }
    echo ']';
?>