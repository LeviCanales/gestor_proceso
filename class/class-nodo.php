<?php
	class Nodo{

		private $dato;
		private $encadenamiento;

		public function __construct($dato,
					$encadenamiento){
			$this->dato = $dato;
			$this->encadenamiento = $encadenamiento;
		}
		public function getDato(){
			return $this->dato;
		}
		public function setDato($dato){
			$this->dato = $dato;
		}
		public function getEncadenamiento(){
			return $this->encadenamiento;
		}
		public function setEncadenamiento($encadenamiento){
			$this->encadenamiento = $encadenamiento;
		}
		public function __toString(){
			return "Dato: " . $this->dato . 
				" Encadenamiento: " . $this->encadenamiento;
		}
	}
?>