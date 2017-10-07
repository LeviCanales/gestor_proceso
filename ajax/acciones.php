<?php
	include("../class/class-nodo.php");
	include("../class/class-cursor.php");
	include("../class/class-lista.php");
	include("../class/class-proceso.php");
	switch ($_GET["accion"]) {
		case '1':
			//sleep(2);
			echo '<div class="cuadro-transparente espacio negrito"> Número de Ciclos: '.$_POST['numero_ciclos'];
			//Empieza el ROLLO DE LOS PROCESOS AJAX...
			$listo = new Lista();
			$p = $listo->PRIMERO();
			//Guardar los procesos en la lista de listos.
			echo '<br><br>'.'Nuevo';
			for ($i=0; $i < $_POST["tamanio_proceso"]; $i++) { 
				$dato = explode("/", $_POST["proceso".$i]);
				$listo->INSERTA((new Proceso(trim($dato[0]),trim($dato[1]),trim($dato[2]),trim($dato[3]),trim($dato[4]),trim($dato[5]))), ($p+$i));
				echo '<br>'.($i+1).': '.$listo->RECUPERA($p+$i)->proceso();
			}
			//empezando ordenamiento "burbuja"
			ordenarBurbuja($listo);

			echo '<br><br>'.'Listo';
			//$listo->getContenedor()->imprimeLista();
			for ($i=0; $i < ($listo->FIN()-1); $i++) {
				$listo->RECUPERA($p+$i)->setEstado(1);
				echo '<br>'.($i+1).': '.$listo->RECUPERA($p+$i)->proceso();
			}
			echo '<br><br>';
			//CICLO PRINCIPAL
			$contadorTres = 0;
			$seRepite = null;
			$buscarProceso = true;
			$contadorCinco = 0;
			$contadorSegmento = 1;
			echo '<div class="row">';
			for ($i=0; $i < $_POST["numero_ciclos"]; $i++) {
				//Ver si se repite el proceso elegido seguidamente
				if ($buscarProceso) {
					if ($seRepite == $listo->RECUPERA($p)->getId_proceso()) {
						$contadorTres++;
					}else{
						$contadorTres = 0;
					}
					//si seguidamente lleva 3 veces.
					if ($contadorTres == 3) {
						if ($listo->RECUPERA($p)->getPrioridad()!=3) {
							$listo->RECUPERA($p)->setPrioridad((($listo->RECUPERA($p)->getPrioridad())+1));
						}
						ordenarBurbuja($listo);
						if ($seRepite == $listo->RECUPERA($p)->getId_proceso()) {
							if ($listo->PRIMERO()!=($listo->FIN()-1)) {
								$listo->INSERTA($listo->RECUPERA($p),$listo->SIGUIENTE($listo->SIGUIENTE($p)));
								$listo->SUPRIME($p);
							}
						}
						$contadorTres = 0;
					}
				}
				//Segmento de 5 ciclos
				if ($contadorCinco<5) {
					$listo->RECUPERA($p)->setEstado(2);
					$listo->RECUPERA($p)->setNum_instruccion(1+($listo->RECUPERA($p)->getNum_instruccion()));
					$buscarProceso = false;
					$contadorCinco++;
				}
				if (!($contadorCinco<5)) {
					$buscarProceso = true;
					$contadorCinco = 0;
				}
				echo '<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4" id="borde">Segmento: '.$contadorSegmento.'<br>Ciclo: '.($i+1).': Repetido: '.$contadorTres.'. ID:'.$listo->RECUPERA($p)->getId_proceso();
				//Solo para ver los cambios en las prioridades.
				for ($z=0; $z < ($listo->FIN()-1); $z++) {
					echo '<br>&nbsp&nbsp'.($z+1).': '.$listo->RECUPERA($p+$z)->proceso().'<br>&nbsp&nbsp&nbsp'.$listo->RECUPERA($p+$z)->estado();
				}
				echo '</div>';
				if ($buscarProceso) {
					$seRepite = $listo->RECUPERA($p)->getId_proceso();
					$listo->RECUPERA($p)->setEstado(1);
					$contadorSegmento++;
				}
			}
			echo '</div></div>';
			break;
		
		default:
			# code...
			break;
	}

	function ordenarBurbuja($tipoLista){
		$p = $tipoLista->PRIMERO();
		for ($i=1; $i < ($tipoLista->FIN()-1); $i++) { 
			for ($j=0; $j <(($tipoLista->FIN()-1)-$i); $j++) { 
				if (($tipoLista->RECUPERA($p+$j)->getPrioridad())>($tipoLista->RECUPERA($tipoLista->SIGUIENTE($p+$j))->getPrioridad())) {
					$tipoLista->INSERTA($tipoLista->RECUPERA($p+$j),$tipoLista->SIGUIENTE($tipoLista->SIGUIENTE($p+$j)));
					$tipoLista->SUPRIME($p+$j);
				}
			}
		}
	}
?>