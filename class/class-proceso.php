<?php

	class Proceso{

		private $id_proceso;
		private $estado;
		private $prioridad;
		private $cantidad_instruccion;
		private $intruccion_bloqueo;
		private $evento;

		//Las que cambiaram em el ciclo.
		private $num_instruccion;
		private $num_bloqueo;

		public function __construct($id_proceso,
					$estado,
					$prioridad,
					$cantidad_instruccion,
					$intruccion_bloqueo,
					$evento){
			$this->id_proceso = $id_proceso;
			$this->estado = $estado;
			$this->prioridad = $prioridad;
			$this->cantidad_instruccion = $cantidad_instruccion;
			$this->intruccion_bloqueo = $intruccion_bloqueo;
			$this->evento = $evento;

			$this->num_instruccion = 0;
			$this->num_bloqueo = 0;
		}
		public function getId_proceso(){
			return $this->id_proceso;
		}
		public function setId_proceso($id_proceso){
			$this->id_proceso = $id_proceso;
		}
		public function getEstado(){
			return $this->estado;
		}
		public function setEstado($estado){
			$this->estado = $estado;
		}
		public function getPrioridad(){
			return $this->prioridad;
		}
		public function setPrioridad($prioridad){
			$this->prioridad = $prioridad;
		}
		public function getCantidad_instruccion(){
			return $this->cantidad_instruccion;
		}
		public function setCantidad_instruccion($cantidad_instruccion){
			$this->cantidad_instruccion = $cantidad_instruccion;
		}
		public function getIntruccion_bloqueo(){
			return $this->intruccion_bloqueo;
		}
		public function setIntruccion_bloqueo($intruccion_bloqueo){
			$this->intruccion_bloqueo = $intruccion_bloqueo;
		}
		public function getEvento(){
			return $this->evento;
		}
		public function setEvento($evento){
			$this->evento = $evento;
		}

		public function getNum_instruccion(){
			return $this->num_instruccion;
		}
		public function setNum_instruccion($num_instruccion){
			$this->num_instruccion = $num_instruccion;
		}
		public function getNum_bloqueo(){
			return $this->num_bloqueo;
		}
		public function setNum_bloqueo($num_bloqueo){
			$this->num_bloqueo = $num_bloqueo;
		}
		
		function proceso(){
			return $this->id_proceso . '/'.$this->estado . '/'.$this->prioridad . '/'.$this->cantidad_instruccion . '/'.$this->intruccion_bloqueo . '/'.$this->evento;
		}
		public function __toString(){
			return 'Id del proceso: ' . $this->id_proceso . '<br>'.
				" Estado del proceso: " . $this->estado . '<br>'.
				" Prioridad: " . $this->prioridad . '<br>'.
				" Cantidad de instrucciones: " . $this->cantidad_instruccion . '<br>'.
				" Intruccion de bloqueo: " . $this->intruccion_bloqueo . '<br>'.
				" Evento: " . $this->evento . '<br><br>';
		}
	}
?>