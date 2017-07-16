<?php

	class Proceso{

		private $id_proceso;
		private $estado;
		private $prioridad;
		private $cantidad_instruccion;
		private $intruccion_bloqueo;
		private $evento;

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