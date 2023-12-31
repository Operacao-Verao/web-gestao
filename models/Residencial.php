<?php
	
	class Residencial{
		private int $id;
		private string $cep;
		private string $numero;
		
		public function __construct(int $id, string $cep, string $numero){
			$this->id = $id;
			$this->cep = $cep;
			$this->numero = $numero;
		}
		
		public function getId(): int{
			return $this->id;
		}
		
		public function getCep(): string{
			return $this->cep;
		}
		
		public function setCep(string $cep): void{
			$this->cep = $cep;
		}
		
		public function getNumero(): string{
			return $this->numero;
		}
		
		public function setNumero(string $numero): void{
			$this->numero = $numero;
		}
	};
	
?>