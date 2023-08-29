<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title></title>
	</head>
	<body>
		
		<fieldset>
			
			<legend>Cadastro de ocorrência</legend>
			
			<form method="post" action="../../../actions/cad_ocorrencia.php">
				
				<label>Civil:</label><br/>
				<select name="inputCivil" <?php echo 'value="'.($_POST['civilid']?$_POST['civilid']:0).'"'; ?>>
					<?php
						require '../../../actions/conn.php';
						
						require '../../../models/Civil.php';
						require '../../../daos/DAOCivil.php';
						
						$daoCivil = new DAOCivil($pdo);
						$civis = $daoCivil->listAll();
						
						foreach ($civis as $civil){
							echo '<option value="'.$civil->getId().'">'.$civil->getNome().'</option>';
						}
					?>
				</select><br/><br/>
				
				<label>Acionamento:</label><br/>
				<input type="text" name="inputAcionamento"><br/><br/>
				
				<label>Relato:</label><br/>
				<input type="text" name="inputRelato"><br/><br/>
				
				<label>Quantidade de casas:</label><br/>
				<input type="number" name="inputNumCasas"><br/><br/>
				
				<label>CEP:</label><br/>
				<input type="text" name="inputCep"><br/><br/>
				
				<label>Rua:</label><br/>
				<input type="text" name="inputRua"><br/><br/>
				
				<label>Bairro:</label><br/>
				<input type="text" name="inputBairro"><br/><br/>
				
				<label>Cidade:</label><br/>
				<input type="text" name="inputCidade"><br/><br/>
				
				<label>Numero da Casa:</label><br/>
				<input type="text" name="inputNumero"><br/><br/>
				
				<label>Complemento:</label><br/>
				<input type="text" name="inputComplemento"><br/><br/>
				
				<input type="submit" value="Cadastrar"><br/>
				
			</form>
			
		</fieldset>
		
	</body>
</html>