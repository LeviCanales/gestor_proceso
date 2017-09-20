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
			echo '<br>'.'sin arreglo'.'<br>';
			for ($i=0; $i < $_POST["tamanio_proceso"]; $i++) { 
				$dato = explode("/", $_POST["proceso".$i]);
				$listo->INSERTA((new Proceso(trim($dato[0]),trim($dato[1]),trim($dato[2]),trim($dato[3]),trim($dato[4]),trim($dato[5]))), ($p+$i));
				echo '<br>'.($i+1).': '.$listo->RECUPERA($p+$i)->proceso();
			}
			//empezando ordenamiento "burbuja"
			for ($i=1; $i < ($listo->FIN()-1); $i++) { 
				for ($j=0; $j <(($listo->FIN()-1)-$i); $j++) { 
					if (($listo->RECUPERA($p+$j)->getPrioridad())>($listo->RECUPERA($listo->SIGUIENTE($p+$j))->getPrioridad())) {
						$listo->INSERTA($listo->RECUPERA($p+$j),$listo->SIGUIENTE($listo->SIGUIENTE($p+$j)));
						$listo->SUPRIME($p+$j);
					}
				}
			}
			echo '<br><br>'.'Ordenado por prioridades';
			//$listo->getContenedor()->imprimeLista();
			for ($i=0; $i < ($listo->FIN()-1); $i++) { 
				echo '<br>'.($i+1).': '.$listo->RECUPERA($p+$i)->proceso();
			}
			echo '</div>';
			break;
		
		default:
			# code...
			break;
	}
?>