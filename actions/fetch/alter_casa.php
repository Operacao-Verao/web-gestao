<?php
  $input = json_decode(file_get_contents('php://input'), true);

  require '../conn.php';
  require '../../models/Casa.php';
  require '../../daos/DAOCasa.php';
  require '../../models/Relatorio.php';
  require '../../daos/DAORelatorio.php';

  $daoCasa = new DAOCasa($pdo);
  $daoRelatorio = new DAORelatorio($pdo);

  $casa = $daoCasa->findById($input['idCasa']); 
  $relatorios = $daoRelatorio->findByCasa($casa);
  
  if ($casa){
    echo $input['interdicao'];
    $casa->setInterdicao(intval($input['interdicao']));
    $daoCasa->update($casa);
  }
  /*
  if($casa && $relatorios) {    
    foreach($relatorios as $relatorio_) {
      $relatorio_->setInterdicao(intval($input['interdicao']));
      $daoRelatorio->update($relatorio_);
    }
  }
  */
?>