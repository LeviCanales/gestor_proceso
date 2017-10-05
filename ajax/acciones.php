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
			//CICLO PRINCIPAL
			$contadorTres = 0;
			$seRepite = null;
			for ($i=0; $i < $_POST["numero_ciclos"]; $i++) {
				//Ver si se repite el proceso elegido seguidamente
				if ($seRepite == $listo->RECUPERA($p)->getId_proceso()) {
					$contadorTres++;
				}else{
					$contadorTres = 0;
				}
				//si seguidamente lleva 3 veces.
				if ($contadorTres == 3) {
					$listo->RECUPERA($p)->setPrioridad((($listo->RECUPERA($p)->getPrioridad())+1));
					ordenarBurbuja($listo);
					$contadorTres = 0;
				}
				echo '<br>Ciclo: '.($i+1).': '.$contadorTres.'. ID:'.$listo->RECUPERA($p)->getId_proceso();
				//Solo para ver los cambios en las prioridades.
				for ($z=0; $z < ($listo->FIN()-1); $z++) {
					echo '<br>&nbsp&nbsp'.($z+1).': '.$listo->RECUPERA($p+$z)->proceso();
				}
				$seRepite = $listo->RECUPERA($p)->getId_proceso();
			}
			echo '</div>';
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