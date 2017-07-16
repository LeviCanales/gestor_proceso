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
		$proceso = array();
		$archivo =  fopen($direccion, "r") or die("No se pudo abrir");
		$todos = fread($archivo, filesize($direccion));
		echo $todos;
		/*$txt = fopen("data/TXT.txt", "w");
		fwrite($txt, $todos);
		fclose($txt);*/
		$proceso = explode(";", $todos, -1);
		echo '<br><span style="background-color:rgba(255,0,50,0.6);">';
		for ($i=0; $i < sizeof($proceso); $i++) { 
			echo $i.': '.$proceso[$i].'<br>';
		}
		echo "</span>";
		fclose($archivo);
	}else{
		echo "No se encontro proceso.";
	}
?>
</body>
</html>