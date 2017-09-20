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
			for ($i=0; $i < ($listo->FIN()-1); $i++) { 
				echo '<br>'.(($listo->VACIA())?'si':'no').'<br>';
			}
			echo '<br>'.$listo->RECUPERA($listo->PRIMERO())->getId_proceso().'<br>';
			$listo->getContenedor()->imprimeLista();
			echo '</div>';
			break;
		
		default:
			# code...
			break;
	}
?>