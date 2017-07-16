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
		    font-family: 'Orbitron';
		    src: url(fonts/Arual.ttf);
		  }
		  @font-face{
		    font-family: 'Monoton';
		    src: url(fonts/Children-of-the-Starlight.ttf);
		  }
	</style>
	<link rel="icon" href="img/icon.png">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/disenio-gestor.css" rel="stylesheet">
	<title>Simulador Procesos</title>
</head>
<body style="color:#ffffff;background-image: url(img/thumb-1920-593483.jpg);background-size: cover;background-attachment: fixed; font-size: 20px; font-weight: 900">
<h1 style="font-family: 'Monoton', cursive;">Simulador de Procesos
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
			echo $i.': '.$raw[$i].'<br>';
			$dato = explode("/", $raw[$i]);
			for ($j=0; $j < sizeof($dato); $j++) { 
				echo "* ".$j.': '.$dato[$j].' is_numeric(): '.((is_numeric($dato[$j]))?'True':'False').' son 6?: '.((sizeof($dato)==6)?'True':'False').' Tamanio: '.strlen(trim($dato[$j])).'<br>';
				if(!(sizeof($dato)==6)){
					echo "Cantidad de Datos: ".sizeof($dato).' ';
					$guardar = false;
					break;
				}
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
			}
			echo (($guardar)?'Proceso Adecuado':'Proceso Fallido');
			echo "</div><br>";
		}
		echo "</div>";
		fclose($archivo);
	}else{
		echo "No se encontro proceso.";
	}
?>
<script src="js/jquery.min.js"></script>
<script src="js/jquery.highlight-5.js"></script>
<script src="js/jquery.highlightn-5.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/masonry.pkgd.min.js"></script>
<script src="js/imagesloaded.pkgd.min.js"></script>
<script src="js/controlador-gestor.js"></script>
</body>
</html>