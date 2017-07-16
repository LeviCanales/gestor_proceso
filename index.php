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
	<title>Simulador Procesos</title>
</head>
<body style="font-size: 40px">
<?php
	$direccion = "data/procesos.txt";
	if(file_exists($direccion)){
		$proceso = array();
		$archivo =  fopen($direccion, "r") or die("No se pudo abrir");
		$todos = fread($archivo, filesize($direccion));
		//echo $todos.'<br>';
		/*$txt = fopen("data/TXT.txt", "w");
		fwrite($txt, $todos);
		fclose($txt);*/
		$proceso = explode(";", $todos, -1);
		echo '<span style="background-color:rgba(255,0,50,0.6);"> Tamaño: '.sizeof($proceso).'<br>';
		for ($i=0; $i < sizeof($proceso); $i++) {
			echo $i.': '.$proceso[$i].'<br>';
			$dato = explode("/", $proceso[$i]);
			for ($j=0; $j < sizeof($dato); $j++) { 
				echo ". ".$j.': '.$dato[$j].'<br>';
			}
			echo "<br>";
		}
		echo "</span>";
		fclose($archivo);
	}else{
		echo "No se encontro proceso.";
	}
?>
</body>
</html>