<?php
	class Lista {
		private $contenedor;

		public function __construct(){
			$this->contenedor = new Cursor();
		}
		
		public function getContenedor(){
			return $this->contenedor;
		}
		public function setContenedor($contenedor){
			$this->contenedor = $contenedor;
		}

		function INSERTA($x, $p){
			return $this->contenedor->INSERTA($x, $p);
		}
		function LOCALIZA($x){
			return 	$this->contenedor->LOCALIZA($x);
		}
		function RECUPERA($p){
			return $this->contenedor->RECUPERA($p);
		}
		function SUPRIME($p){
			$this->contenedor->SUPRIME($p);
		}
		function SIGUIENTE($p){
			return $this->contenedor->SIGUIENTE($p);
		}
		function ANTERIOR($p){
			return $this->contenedor->ANTERIOR($p);
		}
		function ANULA(){
			$this->contenedor->ANULA();
		}
		function PRIMERO(){
			return $this->contenedor->PRIMERO();
		}
		function FIN(){
			return $this->contenedor->FIN();
		}
		function VACIA(){
			return $this->contenedor->VACIA();
		}
	}
?>