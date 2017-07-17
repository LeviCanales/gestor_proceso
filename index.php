<?php
	include("class/class-nodo.php");
	include("class/class-cursor.php");
	include("class/class-lista.php");
	include("class/class-proceso.php");
	$probarMemoria = new Lista();
?>
<!DOCTYPE html>
<html>
<head>
	<style>
		@font-face{
		    font-family: 'Arual';
		    src: url(fonts/Arual.ttf);
		  }
		@font-face{
		    font-family: 'Children-of-the-Starlight';
		    src: url(fonts/Children-of-the-Starlight.ttf);
		  }
		@font-face{
		    font-family: 'Hanged-Letters';
		    src: url(fonts/Hanged-Letters.ttf);
		  }
		@font-face{
		    font-family: 'Basscrw';
		    src: url(fonts/Basscrw.ttf);
		  }
	</style>
	<link rel="icon" href="img/icon.png">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/disenio-gestor.css" rel="stylesheet">
	<title>Simulador Procesos</title>
</head>
<body style="color:#ffffff;background-image: url(img/thumb-1920-593483.jpg);background-size: cover;background-attachment: fixed; font-size: 20px;">
<h1 style="font-family: 'Children-of-the-Starlight', cursive;">Simulador de Procesos
<?php
	$direccion = "data/procesos.txt";
	if(file_exists($direccion)){
		$raw = array();
		$archivo =  fopen($direccion, "r") or die("No se pudo abrir");
		$todos = fread($archivo, filesize($direccion));
		$proceso = array();
		//echo $todos.'<br>';
		/*$txt = fopen("data/TXT.txt", "w");
		fwrite($txt, $todos);
		fclose($txt);*/
		$raw = explode(";", $todos, -1);
		echo " Todos: ".sizeof($raw)."</h1><div class='grid'>";
		for ($i=0; $i < sizeof($raw); $i++) {
			$guardar = true;
			echo '<div class="grid-item cuadro-transparente">';
			echo ($i+1).': '.$raw[$i].'<br>';
			$dato = explode("/", $raw[$i]);
			for ($k=0; $k < sizeof($proceso); $k++) { 
				if (trim($dato[0])==($proceso[$k])->getId_proceso()) {
					echo "ID Repetido: ". trim($dato[0]).' ';
					$guardar = false;
					break;
				}
			}
			if (!(sizeof($dato)==6)) {
				echo "Cantidad de Datos: ".sizeof($dato).' ';
				$guardar = false;
			}
			if ((((integer)trim($dato[4]))>=((integer)trim($dato[3])))&&$guardar) {
				echo "Instrucciones ".trim($dato[3]).'<br>no alcanzan a<br>Bloqueo: '.trim($dato[4]).' ';
				$guardar = false;
			}
			for ($j=0; ($j < sizeof($dato))&&$guardar; $j++) {
				echo "* ".($j+1).': '.$dato[$j].' is_numeric: '.((is_numeric($dato[$j]))?'True':'False').'| Tamanio: '.strlen(trim($dato[$j])).'<br>';
				if(!(is_numeric($dato[$j]))){
					echo "Tipo de Datos: ". gettype($dato[$j]).' ';
					$guardar = false;
					break;
				}
				if(($j==0)&&!(strlen(trim($dato[$j]))==4)){
					echo "Tamaño Id ";
					$guardar = false;
					break;
				}
				if(($j==1)&&!(strlen(trim($dato[$j]))==1)){
					echo "Tamaño Estado: ".strlen(trim($dato[$j])).' ';
					$guardar = false;
					break;
				}
				if(($j==2)&&!(strlen(trim($dato[$j]))==1)){
					echo "Tamaño Prioridad: ".strlen(trim($dato[$j])).' ';
					$guardar = false;
					break;
				}
				if(($j==2)&&(!((integer)trim($dato[$j])<=3)||!((integer)trim($dato[$j])>=1))){
					echo 'La Prioridad es: '.trim($dato[$j]).' ';
					$guardar = false;
					break;
				}
				if(($j==3)&&!(strlen(trim($dato[$j]))==3)){
					echo "Tamaño Instrucciones ".strlen(trim($dato[$j])).' ';
					$guardar = false;
					break;
				}
				if(($j==4)&&!(strlen(trim($dato[$j]))==3)){
					echo "Tamaño Bloqueo: ".strlen(trim($dato[$j])).' ';
					$guardar = false;
					break;
				}
				if(($j==5)&&!(strlen(trim($dato[$j]))==1)){
					echo "Tamaño Evento ";
					$guardar = false;
					break;
				}
				if(($j==5)&&!((trim($dato[$j])==5)||(trim($dato[$j])==3))){
					echo "No se reconoce Evento: ".trim($dato[$j]).' ';
					$guardar = false;
					break;
				}
			}
			if ($guardar) {
				echo '<span class="highlightn">Proceso Adecuado ID: '.trim($dato[0]).'</span>';
				$proceso[] = new Proceso(trim($dato[0]),trim($dato[1]),trim($dato[2]),trim($dato[3]),trim($dato[4]),trim($dato[5]));
			}else{
				echo 'Proceso Fallido';
			}
			//echo (($guardar)?'<span class="highlightn">Proceso Adecuado</span>':'Proceso Fallido');
			echo "</div><br>";
		}
		echo "</div><div class='cuadro-transparente espacio'><div class='titulillo'>Procesos Aceptados ".sizeof($proceso)."</div><div class='row'>";
		for ($i=0; $i < sizeof($proceso); $i++) { 
			echo "<div class='col-xs-12 col-sm-6 col-md-4 col-lg-4' id='borde'><div class='letra' style='font-size: 80px; text-align:center; font-family: 'Basscrw',fantasy;'>".($i+1).':</div>'.$proceso[$i].'</div>';
		}
		echo "</div></div>";
		fclose($archivo);
		unlink('data/procesos.txt');
	}else{
		echo "</h1><div class='cuadro-transparente espacio'>No se encontro proceso.";
		?>
		<form method="post" id="formulario" enctype="multipart/form-data">
		    <span class="negrito">Subir Proceso:<input type="file" name="file" class="form-control"></span>
		</form>
		<div id="respuesta"></div>
		</div>
		<?php
	}
	?>
	<div class='cuadro-transparente espacio'>Número de Ciclos:
		<div class="input-group">
			<input type="number" min="0" class="form-control">
			<span class="input-group-btn">
				<button type="button" class="btn btn-default negrito">Ejecutar</button>
			</span>
		</div>
	</div>
	<?php
?>
<script src="js/jquery.min.js"></script>
<script src="js/jquery.highlight-5.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/masonry.pkgd.min.js"></script>
<script src="js/imagesloaded.pkgd.min.js"></script>
<script src="js/controlador-gestor.js"></script>
</body>
</html>