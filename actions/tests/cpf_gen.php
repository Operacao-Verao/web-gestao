<?php
	
	// Generating cpf
	$cpf = str_pad(''.rand(0, 999999999), 9, '0', STR_PAD_LEFT);
	$acu_v1 = 0;
	for ($i=0; $i<9; $i++){
		$digit = $cpf[$i];//floor(($cpf/pow(10, $i)) % 10);
		$acu_v1 += $digit*(10-$i);
	}
	$ver1 = (11 - ($acu_v1%11));
	$ver1 = $ver1>=10? 0: $ver1;
	$cpf .= $ver1;
	
	$acu_v2 = 0;
	for ($i=0; $i<10; $i++){
		$digit = $cpf[$i];//floor(($cpf/pow(10, $i)) % 10);
		$acu_v2 += $digit*(11-$i);
	}
	$ver2 = (11 - ($acu_v2%11));
	$ver2 = $ver2>=10? 0: $ver2;
	$cpf .= $ver2;
	
	echo $cpf;
	
?>