<?php
	$datetime = '2023-09-05 11:44:23';
	
	function formatDate($datetime) {
		$date = date_create($datetime);
		return date_format($date, 'd/m/Y');
	}
	
	function formatTime($datetime, $include_seconds = false) {
		$date = date_create($datetime);
		return date_format($date, 'H:i'.($include_seconds? ':s': ''));
	}
	
	echo formatTime($datetime, true);
?>