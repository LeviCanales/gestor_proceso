<?php
	include("class/class-nodo.php");
	include("class/class-cursor.php");
	include("class/class-lista.php");
	include("class/class-proceso.php");

	$probarMemoria = new Lista();
	$probarMemoria->getContenedor()->memoria();
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<?php
	/*$probarMemoria->memoria();
	$boo = false;
	if ($boo) {
		echo "# code...";
	}
	echo '<br>'.'H: '.$boo . '<br>';*/
		$probarMemoria->INSERTA("1050", $probarMemoria->PRIMERO());
		$probarMemoria->INSERTA("1072", $probarMemoria->ANTERIOR($probarMemoria->FIN()));
		$probarMemoria->INSERTA("1144", $probarMemoria->PRIMERO());
		$probarMemoria->INSERTA("1378", $probarMemoria->SIGUIENTE($probarMemoria->PRIMERO()));
		echo '<br>'."Vacia? " . $probarMemoria->VACIA(). " FIN:".$probarMemoria->FIN().'<br>';
		$probarMemoria->INSERTA("1391", $probarMemoria->SIGUIENTE($probarMemoria->PRIMERO()));
		$probarMemoria->getContenedor()->imprimeLista();
		echo '<br>'."Vacia? " . $probarMemoria->PRIMERO(). " Localiza:".$probarMemoria->LOCALIZA("1378").'<br>';
		$probarMemoria->getContenedor()->imprimeLista();
		echo '<br>'."Vacia? " . $probarMemoria->VACIA(). " FIN:".$probarMemoria->FIN();
		$probarMemoria->ANULA();
		$probarMemoria->INSERTA("1050", $probarMemoria->PRIMERO());
		$probarMemoria->INSERTA("1072", $probarMemoria->SIGUIENTE($probarMemoria->PRIMERO()));
		$probarMemoria->INSERTA("1144", $probarMemoria->PRIMERO());
		$probarMemoria->INSERTA("1378", $probarMemoria->ANTERIOR($probarMemoria->FIN()));
		$probarMemoria->getContenedor()->imprimeLista();
		echo '<br>'."Vacia? " . $probarMemoria->VACIA(). " FIN:".$probarMemoria->FIN();
		//$probarMemoria->ANULA();
		$probarMemoria->INSERTA("1391", $probarMemoria->SIGUIENTE($probarMemoria->PRIMERO()));
		echo '<br>'."Vacia? " . $probarMemoria->PRIMERO(). " Localiza:".$probarMemoria->LOCALIZA("1378").'<br>';
		$probarMemoria->getContenedor()->imprimeLista();
		echo '<br>'."Vacia? " . $probarMemoria->VACIA(). " FIN:".$probarMemoria->FIN();
		echo '<br>'."Recupera " . $probarMemoria->RECUPERA($probarMemoria->ANTERIOR($probarMemoria->FIN()));
		echo '<br>'."Vacia? " . $probarMemoria->PRIMERO(). " Localiza:".$probarMemoria->LOCALIZA("1072").'<br>';
		echo '<br>'."<<<<";
		$probarMemoria->getContenedor()->imprimeLista();
		$probarMemoria->SUPRIME($probarMemoria->FIN());
		echo '<br>'."<<<<";
		$probarMemoria->getContenedor()->imprimeLista();
		echo '<br>'."Vacia? " . $probarMemoria->VACIA(). " FIN:".$probarMemoria->FIN();
		echo '<br>'."Vacia? " . $probarMemoria->PRIMERO(). " Localiza:".$probarMemoria->LOCALIZA("1378")."\n".'<br>';
?>
</body>
</html>