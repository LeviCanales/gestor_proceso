<?php
	include("../class/class-nodo.php");
	include("../class/class-cursor.php");
	include("../class/class-lista.php");
	include("../class/class-proceso.php");
	switch ($_GET["accion"]) {
		case '1':
			//sleep(2);
			echo '<div class="cuadro-transparente espacio negrito"><div class="text-center">Número de Ciclos: '.$_POST['numero_ciclos'];
			echo '&nbsp&nbsp&nbsp<a class="btn btn-default negrito" href="#final">Ir al Final</a></div>';
			//Empieza el ROLLO DE LOS PROCESOS AJAX...
			$listo = new Lista();
			$p = $listo->PRIMERO();
			$bloqueado = new Lista();
			$pb = $bloqueado->PRIMERO();
			$saliente = new Lista();
			$ps = $saliente->PRIMERO();
			//Guardar los procesos en la lista de listos.
			//echo '<br><br>'.'Nuevo';
			for ($i=0; $i < $_POST["tamanio_proceso"]; $i++) { 
				$dato = explode("/", $_POST["proceso".$i]);
				$listo->INSERTA((new Proceso(trim($dato[0]),trim($dato[1]),trim($dato[2]),trim($dato[3]),trim($dato[4]),trim($dato[5]))), ($p+$i));
				//echo '<br>'.($i+1).': '.$listo->RECUPERA($p+$i)->proceso();
			}
			//empezando ordenamiento "burbuja"
			ordenarBurbuja($listo);

			//echo '<br><br>'.'Listo';
			//$listo->getContenedor()->imprimeLista();
			for ($i=0; $i < ($listo->FIN()-1); $i++) {
				$listo->RECUPERA($p+$i)->setEstado(1);
				//echo '<br>'.($i+1).': '.$listo->RECUPERA($p+$i)->proceso();
			}
			echo '<br><br>';
			//CICLO PRINCIPAL
			$contadorTres = 0;
			$seRepite = null;
			$buscarProceso = true;
			$contadorCinco = 0;
			$contadorSegmento = 1;
			$seBloqueo = false;
			$seTermino = false;
			$idSeleccionado = '';
			echo '<div class="row">';
			for ($i=0; $i < $_POST["numero_ciclos"]; $i++) {
				//Ver si se repite el proceso elegido seguidamente
				if ($buscarProceso&&!$listo->VACIA()) {
					if ($seRepite == $listo->RECUPERA($p)->getId_proceso()) {
						$contadorTres++;
					}else{
						$seRepite = $listo->RECUPERA($p)->getId_proceso();
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
			if (!$listo->VACIA()) {
				$idSeleccionado = $listo->RECUPERA($p)->getId_proceso();
				if (($contadorCinco<5)&&!$seBloqueo) {
					$listo->RECUPERA($p)->setEstado(2);
					$listo->RECUPERA($p)->setNum_instruccion(1+($listo->RECUPERA($p)->getNum_instruccion()));
					//Ver si se bloquea.
					if (($listo->RECUPERA($p)->getNum_instruccion())==($listo->RECUPERA($p)->getIntruccion_bloqueo())) {
						$seBloqueo = true;
					}
					//Ver si termina
					if (($listo->RECUPERA($p)->getNum_instruccion())==($listo->RECUPERA($p)->getCantidad_instruccion())) {
						$seTermino = true;
					}
					$buscarProceso = false;
					$contadorCinco++;
				}
			}
				if (!(($contadorCinco<5)&&!$seBloqueo&&!$seTermino)) {
					$buscarProceso = true;
					$contadorCinco = 0;
				}
				//meter en el tda de bloqueo
				if ($seBloqueo) {
					$listo->RECUPERA($p)->setEstado(3);
					$bloqueado->INSERTA($listo->RECUPERA($p),$pb);
					$listo->SUPRIME($p);
					$seBloqueo = false;
				}
				//Sumar una instruccion de bloqueo, a todos los bloqueos en cada ciclo.
				if (!$bloqueado->VACIA()) {
					for ($b=0; $b < ($bloqueado->FIN()-1); $b++) {
						if (($bloqueado->RECUPERA($pb+$b)->getPrimer_bloqueo())) {
								$bloqueado->RECUPERA($pb+$b)->setPrimer_bloqueo(false);
						}else{
							$bloqueado->RECUPERA($pb+$b)->setNum_bloqueo(1+($bloqueado->RECUPERA($pb+$b)->getNum_bloqueo()));
						}
						//Ver si ya cumplio su evento de bloqueo.
						if (($bloqueado->RECUPERA($pb+$b)->getNum_bloqueo())==$bloqueado->RECUPERA($pb+$b)->evento()) {
							$bloqueado->RECUPERA($pb+$b)->setEstado(1);
							$listo->INSERTA($bloqueado->RECUPERA($pb+$b),$listo->FIN());
							$bloqueado->SUPRIME($pb+$b);
						}						
					}
				}
				//Meter en el TDA de terminado.
				if ($seTermino) {
					$listo->RECUPERA($p)->setEstado(4);
					$saliente->INSERTA($listo->RECUPERA($p),$ps);
					$listo->SUPRIME($p);
					$seTermino = false;
				}
				
				echo '<table class="table">
				<tr>
					<th colspan="4">Ciclo: '.($i+1).'.	Segmento: '.$contadorSegmento.'.	Segmento Seguido: '.($contadorTres+1).'.	ID Seleccionado: '.$idSeleccionado.'</th>
				</tr>
				<tr>
					<th>Proceso</th>
					<th>Prioridad</th>
					<th>Estado</th>
					<th>Evento de bloqueo</th>
					<th>Instrucción Actual</th>
					<th>Instrucción Bloqueo</th>
				</tr>';
				for ($z=0; $z < ($listo->FIN()-1); $z++) { 
					echo '<tr>
						<td>'.$listo->RECUPERA($p+$z)->proceso().'</td>
						<td>'.$listo->RECUPERA($p+$z)->getPrioridad().'</td>
						<td>'.$listo->RECUPERA($p+$z)->estado().'</td>
						<td>'.(($listo->RECUPERA($p+$z)->evento()==13)?'E/S 13 ciclos':'D.D 27 ciclos').'</td>
						<td>'.$listo->RECUPERA($p+$z)->getNum_instruccion().'</td>
						<td>'.$listo->RECUPERA($p+$z)->getNum_bloqueo().'</td>
					<tr>';
				}
				for ($z=0; $z < ($bloqueado->FIN()-1); $z++) { 
					echo '<tr>
						<td>'.$bloqueado->RECUPERA($pb+$z)->proceso().'</td>
						<td>'.$bloqueado->RECUPERA($pb+$z)->getPrioridad().'</td>
						<td>'.$bloqueado->RECUPERA($pb+$z)->estado().'</td>
						<td>'.(($bloqueado->RECUPERA($pb+$z)->evento()==13)?'E/S 13 ciclos':'D.D 27 ciclos').'</td>
						<td>'.$bloqueado->RECUPERA($pb+$z)->getNum_instruccion().'</td>
						<td>'.$bloqueado->RECUPERA($pb+$z)->getNum_bloqueo().'</td>
					<tr>';
				}
				for ($z=0; $z < ($saliente->FIN()-1); $z++) { 
					echo '<tr>
						<td>'.$saliente->RECUPERA($ps+$z)->proceso().'</td>
						<td>'.$saliente->RECUPERA($ps+$z)->getPrioridad().'</td>
						<td>'.$saliente->RECUPERA($ps+$z)->estado().'</td>
						<td>'.(($saliente->RECUPERA($ps+$z)->evento()==13)?'E/S 13 ciclos':'D.D 27 ciclos').'</td>
						<td>'.$saliente->RECUPERA($ps+$z)->getNum_instruccion().'</td>
						<td>'.$saliente->RECUPERA($ps+$z)->getNum_bloqueo().'</td>
					<tr>';
				}echo "</table>";
				/*echo '<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4" id="borde">Segmento: '.$contadorSegmento.'<br>Ciclo: '.($i+1).': Repetido: '.$contadorTres.((!$listo->VACIA())?('. ID:'.$listo->RECUPERA($p)->getId_proceso()):(''));
				//Solo para ver los cambios en las prioridades.
				for ($z=0; $z < ($listo->FIN()-1); $z++) {
					echo '<br>&nbsp&nbsp'.($z+1).': '.$listo->RECUPERA($p+$z)->proceso().'<br>&nbsp&nbsp&nbsp'.$listo->RECUPERA($p+$z)->estado();
				}
				for ($z=0; $z < ($bloqueado->FIN()-1); $z++) {
					echo '<br>&nbsp&nbsp'.($z+1).': '.$bloqueado->RECUPERA($pb+$z)->proceso().'<br>&nbsp&nbsp&nbsp'.$bloqueado->RECUPERA($pb+$z)->estado();
				}
				for ($z=0; $z < ($saliente->FIN()-1); $z++) {
					echo '<br>&nbsp&nbsp'.($z+1).': '.$saliente->RECUPERA($ps+$z)->proceso().'<br>&nbsp&nbsp&nbsp'.$saliente->RECUPERA($ps+$z)->estado();
				}
				echo '</div>';*/
				//Terminar antes si ya termino.
				if ($listo->VACIA()&&$bloqueado->VACIA()) {
					echo "<br>Termino antes...";
					$i = $_POST["numero_ciclos"];
				}
				if ($buscarProceso) {
					if (!$listo->VACIA()) {
						$listo->RECUPERA($p)->setEstado(1);
					}
					$contadorSegmento++;
				}
			}
			echo
				'<div id="final"></div><div class="text-center"><a class="btn btn-default negrito" href="#poner">Poner Número de ciclos</a></div>';
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