<?php
	include("../class/class-nodo.php");
	include("../class/class-cursor.php");
	include("../class/class-lista.php");
	include("../class/class-proceso.php");
	switch ($_GET["accion"]) {
		case '1':
			echo '<div class="cuadro-transparente espacio negrito">'.$_POST['numero_ciclos'];
			$procesos = array();
			for ($i=0; $i < $_POST["tamanio_proceso"]; $i++) {
				$dato = explode("/", $_POST["proceso".$i]);
				$procesos[] = new Proceso(trim($dato[0]),trim($dato[1]),trim($dato[2]),trim($dato[3]),trim($dato[4]),trim($dato[5]));
				echo '<br>'.($i+1).' '.$procesos[$i];
			}
			echo '</div>';
			//Empieza el ROLLO DE LOS PROCESOS AJAX...
			break;
		
		default:
			# code...
			break;
	}
?>