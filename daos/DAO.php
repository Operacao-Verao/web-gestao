<?php
	class DAO{
		protected PDO $pdo;
		protected string $sql_offset = '';
		protected string $sql_length = '';
		
		public function setListOffset(int $offset=0) {
			$this->sql_offset = ' OFFSET '.$offset;
		}
		
		public function setListLength(int $length=ALL_REMAIN_ENTRIES) {
			if ($length==ALL_REMAIN_ENTRIES){
				$this->sql_length = '';
			}
			else {
				$this->sql_length = ' LIMIT '.$length;
			}
		}
	}
?>