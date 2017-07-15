<?php
	class Cursor {
		private $cabeza;

		private $arreglo = array();
		private $memoria = array();

		private $numElementos;
		private $empty;

		private $indice;
		private $index = 0;

		private $suprOK;

		public function __construct(){
			for ($i=0; $i < 10; $i++) { 
				$this->memoria[$i] = false;
			}
			for ($i=0; $i < 10; $i++) { 
				$this->arreglo[$i] = new NODO(null,null);
			}
		}

		function memoria(){
			for ($i=0; $i < 10; $i++) { 
				echo "hola: " . $this->memoria[$i] . '<br>';
				//$this->arreglo[4]->setEncadenamiento(5);
				echo $i . ": " . $this->arreglo[$i] . '<br>';
			}
		}

		function LOCALIZA($x){
			$in = $this->cabeza;
			$cont = -1;
			for($k = 0; $k < 10; $k++){
				//echo "Local " . ($k+1) . " ".$this->arreglo[$in]->getDato() . "<br>";
				if($this->arreglo[$in]->getEncadenamiento()==-1){
					if($this->arreglo[$in]->getDato()!=$x){
						break;
					}
				}
				if($this->arreglo[$in]->getDato()==$x){
					$cont = ($k+1);
					break;
				}
				$in = $this->arreglo[$in]->getEncadenamiento();
			}
			if($cont!=(-1)){
				return $cont;
			} else{
				return FIN();
			}
			
		}

		function INSERTA($x, $p){
			$this->index = $this->indexActual();
			if(($this->FIN()>=$p)&&($this->PRIMERO()<=$p)&&($this->index!=-1)){
				if($this->VACIA()){
					$this->cabeza=$this->index;
					//$index = $indexActual();
					$this->arreglo[$this->index]->setDato($x);
					$this->memoria[$this->index] = true;
					$this->arreglo[$this->index]->setEncadenamiento(-1);
				}else if($p==$this->PRIMERO()){
					//$index = $indexActual();
					$this->arreglo[$this->index]->setDato($x);
					$this->arreglo[$this->index]->setEncadenamiento($this->cabeza);
					$this->memoria[$this->index] = true;
					$this->cabeza = $this->index;
				}else if($p==$this->FIN()){
					$in = 0;
					for($k = 0; $k < 10; $k++){
						if($this->arreglo[$k]->getEncadenamiento()==-1){
							$in = $k;
							break;
						}
					}
					//echo "------in " +in;
					//$index = $indexActual();
					$this->arreglo[$in]->setEncadenamiento($this->index);
					$this->arreglo[$this->index]->setDato($x);
					$this->arreglo[$this->index]->setEncadenamiento(-1);
					$this->memoria[$this->index] = true;
				}else{
					$in = $this->cabeza;
					$anter = $in;
					//echo "------ " +p+" +++++ $this->$cabeza "+ $this->$cabeza;
					for($k = 0; $k < ($p-1); $k++){
						$anter=$in;
						$in = $this->arreglo[$in]->getEncadenamiento();
						//echo "$k:  " +$k+" +++++ $in "+ $in;
					}
					//$$index = $$indexActual();
					//echo "pos:  " +p+" +++++ $in "+ $in+" "+$this->arreglo[$in].Dato;
					$this->arreglo[$anter]->setEncadenamiento($this->index);
					$this->arreglo[$this->index]->setDato($x);
					$this->arreglo[$this->index]->setEncadenamiento($in);
					$this->memoria[$this->index] = true;
				}
				$this->suprOK = true;
				return $p;
			}else {
				echo "********No se puede insertar ahí";
				return -1;
			}
		}
		
		function SUPRIME($p){
			if(($this->FIN()>$p)&&($this->PRIMERO()<=$p)){
				if($this->VACIA()){
					echo "No puede se puede suprimir si esta vacia";
				}else 
					$this->suprOK = true;
					if($p==$this->PRIMERO()){
					$this->memoria[$this->cabeza] = false;
					$this->cabeza = $this->arreglo[$this->cabeza]->getEncadenamiento();
				}else{
					$in = $this->cabeza;
					$anter = $in;
					$sig = $this->arreglo[$in]->getEncadenamiento();
					for($k = 0; $k < ($p-1); $k++){
						$anter=$in;
						$in = $this->arreglo[$in]->getEncadenamiento();
						$sig = $this->arreglo[$in]->getEncadenamiento();
					}
					$this->arreglo[$anter]->setEncadenamiento($sig);
					$this->memoria[$in] = false;
				}
			}else {
				$this->suprOK = false;
				echo "********No se puede Suprimir ahí";
			}
		}
		
		function RECUPERA($p){
			$in = $this->cabeza;
			if(!$this->VACIA()){
				for($k = 0; $k < ($p-1); $k++){
					$in = $this->arreglo[$in]->getEncadenamiento();
				}
				return $this->arreglo[$in]->getDato();
			}
			return null;
		}

		function ANULA(){
			$this->cabeza = -1;
			$this->numElementos = 0;
			$this->empty = true;
			for($k = 0; $k < 10; $k++){
				$this->memoria[$k] = false;
				$this->arreglo[$k]->setDato(null);
			}
			echo "<br>La lista ahora se encuentra vacia<br>";
		}
		
		function VACIA(){
			for($k = 0; $k < 10; $k++){
				if($this->memoria[$k]==true){
					$this->empty = false;
					break;
				}else{
					$this->empty = true;
				}
			}
			return $this->empty;
		}

		//Clases de apoyo
		function ANTERIOR($p){
			return $p-1;
		}

		function SIGUIENTE($p){
			return $p+1;
		}

		function PRIMERO(){
			return 1;
		}

		function FIN(){
			$this->numElementos = 0;
			for($i = 0; $i<10;$i++){
				if($this->memoria[$i]!=false){
					$this->numElementos++;
				}
			}
			return $this->numElementos+1;
		}
		
		//Verdaderos metodos de apoyo
		function indexActual(){
			$this->indice = -1;
			for($k = 0; $k < 10; $k++){
				if($this->memoria[$k]==false){
					$this->indice = $k;
					break;
				}
			}
			return $this->indice;
		}
		
		function imprimeLista(){
			$in = $this->cabeza;
			if(!$this->VACIA()){
				for($k = 0; $k < 10; $k++){
					echo ($k+1).": ".$this->arreglo[$in]->getDato().'<br>';
					if($this->arreglo[$in]->getEncadenamiento()==-1){
						echo "<br>fin<br>";
						break;
					}
					$in = $this->arreglo[$in]->getEncadenamiento();
				}
			}else {
				echo "Esta Vacia<br>";
			}
		}

	}
?>