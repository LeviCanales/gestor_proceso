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
<body>
<?php
	$direccion = "data/procesos.txt";
	if(file_exists($direccion)){
		$archivo =  fopen($direccion, "r") or die("No se pudo abrir");
		echo fread($archivo, filesize($direccion));
		fclose($archivo);
	}else{
		echo "No se encontro proceso.";
	}
?>
</body>
</html>