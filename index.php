<?php
	include("class/class-nodo.php");
	include("class/class-cursor.php");
	include("class/class-lista.php");
	include("class/class-proceso.php");
	//$probarMemoria = new Lista();
	//Para usar el proceso indefinidamente hasta que uno lo decide borrar.
	if (isset($_POST["btn-borrar"])) {
			unlink('data/procesos.txt');
			header('Location: index.php');
	}
	$detalles = false;
	if (isset($_POST["btn-detalles"])) {
			$detalles = true;
	}
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
	//si ya hay un archivo guardado empieza, si no pedira subirlo.
	if(file_exists($direccion)){
		$archivo =  fopen($direccion, "r") or die("No se pudo abrir");
		//$todos contiene todo el archivo de los procesos sin separar ni nada.
		$todos = fread($archivo, filesize($direccion));
		//$raw un arreglo con cada proceso crudo separado.
		$raw = array();
		//$proceso un arreglo de objetos con los procesos buenos metidos en el.
		$proceso = array();
		//echo $todos.'<br>';
		//separar los procesos 
		$raw = explode(";", $todos, -1);
		echo " Todos: ".sizeof($raw)."</h1><div class='grid'>";
		for ($i=0; $i < sizeof($raw); $i++) {
			$guardar = true;
			echo '<div class="grid-item cuadro-transparente">';
			echo ($i+1).': '.$raw[$i].'<br>';
			//separar un proceso en sus espacios.
			$dato = explode("/", $raw[$i]);
			//este ciclo busca los Id repetidos.
			for ($k=0; $k < sizeof($proceso); $k++) { 
				if (trim($dato[0])==($proceso[$k])->getId_proceso()) {
					echo "ID Repetido: ". trim($dato[0]).' ';
					$guardar = false;
					break;
				}
			}
			//este if revisa que el proceso tenga exactamente los 6 espacios.
			if (!(sizeof($dato)==6)&&$guardar) {
				echo "Cantidad de Datos: ".sizeof($dato).' ';
				$guardar = false;
			}
			//este if mira de que la instruccion de bloqueo no este despues de las instrucciones totales.
			if ((((integer)trim($dato[4]))>=((integer)trim($dato[3])))&&$guardar) {
				echo "Instrucciones ".trim($dato[3]).'<br>no alcanzan a<br>Bloqueo: '.trim($dato[4]).' ';
				$guardar = false;
			}
			//revisa el tamaño adecuado de cada espacio y si es numerico o no.
			for ($j=0; ($j < sizeof($dato))&&$guardar; $j++) {
				if ($detalles) {
					echo "* ".($j+1).': '.$dato[$j].' is_numeric: '.((is_numeric($dato[$j]))?'True':'False').'| Tamanio: '.strlen(trim($dato[$j])).'<br>';
				}
				if(!(is_numeric($dato[$j]))){
					echo "Tipo de Datos: ". gettype($dato[$j]).' ';
					$guardar = false;
					break;
				}
				//comprobar que los procesos no sean negativos.
				if(!((integer)$dato[$j]>=0)){
					echo "Dato Invalido: ". trim($dato[$j]).' ';
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
			//si esta correcto guarda el proceso en el arreglo $proceso[]
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
		//Empieza el ROLLO DE LOS PROCESOS
		if (isset($_POST["btn-ejecutar"])&&!empty($_POST["numero_ciclos"])) {
				$numero_ciclos = $_POST["numero_ciclos"];
				echo "<div class='cuadro-transparente espacio'>".$numero_ciclos.'<br>';
				for ($i=0; $i < sizeof($proceso); $i++) { 
					echo ($i+1).' '.$proceso[$i].'<br>';
				}
				echo '</div>';
			}
		?>
		<form action="index.php" id="procede" method="POST" class='cuadro-transparente espacio'>Número de Ciclos:
			<div class="input-group">
				<input name="numero_ciclos" type="number" min="0" class="form-control">
				<span class="input-group-btn">
					<input type="submit" name="btn-ejecutar" value="Ejecutar" class="btn btn-default negrito">
				</span>
			</div>
		</form>
		<!--boton de borrar procesos-->
		<form class='cuadro-transparente espacio centrar' action="index.php" method="POST">
			<input type="submit" name="btn-borrar" value="Borrar Proceso" class="btn btn-default negrito">
			<?php
			//boton de ver detalles de los espacios del proceso.
			if(!$detalles){
				echo '<input type="submit" name="btn-detalles" value="Ver Detalles" class="btn btn-default negrito">';
			}else{
				echo '<input type="submit" name="btn" value="No Ver Detalles" class="btn btn-default negrito">';
			}
			?>
		</form>
		<?php
	}else{
		//contraseña: tantan
		?>
		</h1>
		<div id="cuadro-contra" class='cuadro-transparente espacio centrar'>Escriba la Contraseña:<br><br>
			<div class="input-group">
				<input type="password" id="contra" class="form-control">
				<span class="input-group-btn">
					<button type="button" id="btn-contra" class="btn btn-default negrito">Entrar</button>
				</span>
			</div>
			<br><div id="invalido"></div>
		</div>
		<div id="subir" class='cuadro-transparente espacio centrar' style="display: none;">No se encontro proceso
			<form class="centrar" method="post" id="formulario" enctype="multipart/form-data">
			    Subir Proceso:<input type="file" name="file" class="form-control">
			</form>
		</div>
		<?php
	}
?>
<script src="js/jquery.min.js"></script>
<script src="js/jquery.highlight-5.js"></script>
<script src="js/jquery.crypt.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/masonry.pkgd.min.js"></script>
<script src="js/imagesloaded.pkgd.min.js"></script>
<script src="js/controlador-gestor.js"></script>
</body>
</html>