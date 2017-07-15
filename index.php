<?php
	include("class/class-cursor.php");
	include("class/class-nodo.php");
	include("class/class-proceso.php");

	$probarMemoria = new Cursor();
	$probarMemoria->memoria();
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<?php
	$probarMemoria->memoria();
	$boo = false;
	if ($boo) {
		echo "# code...";
	}
	echo '<br>'.'H: '.$boo . '<br>';
		$probarMemoria->INSERTA("Juana", $probarMemoria->PRIMERO());
		$probarMemoria->INSERTA("Pedro", $probarMemoria->ANTERIOR($probarMemoria->FIN()));
		$probarMemoria->INSERTA("Maria", $probarMemoria->PRIMERO());
		$probarMemoria->INSERTA("Sara", $probarMemoria->SIGUIENTE($probarMemoria->PRIMERO()));
		echo '<br>'."Vacia? " . $probarMemoria->VACIA(). " FIN:".$probarMemoria->FIN().'<br>';
		$probarMemoria->INSERTA("Karina", $probarMemoria->SIGUIENTE($probarMemoria->PRIMERO()));
		$probarMemoria->imprimeLista();
		echo '<br>'."Vacia? " . $probarMemoria->PRIMERO(). " Localiza:".$probarMemoria->LOCALIZA("Sara").'<br>';
		$probarMemoria->imprimeLista();
		echo '<br>'."Vacia? " . $probarMemoria->VACIA(). " FIN:".$probarMemoria->FIN();
		$probarMemoria->ANULA();
		$probarMemoria->INSERTA("Juana", $probarMemoria->PRIMERO());
		$probarMemoria->INSERTA("Pedro", $probarMemoria->SIGUIENTE($probarMemoria->PRIMERO()));
		$probarMemoria->INSERTA("Maria", $probarMemoria->PRIMERO());
		$probarMemoria->INSERTA("Sara", $probarMemoria->ANTERIOR($probarMemoria->FIN()));
		$probarMemoria->imprimeLista();
		echo '<br>'."Vacia? " . $probarMemoria->VACIA(). " FIN:".$probarMemoria->FIN();
		//$probarMemoria->ANULA();
		$probarMemoria->INSERTA("Karina", $probarMemoria->SIGUIENTE($probarMemoria->PRIMERO()));
		echo '<br>'."Vacia? " . $probarMemoria->PRIMERO(). " Localiza:".$probarMemoria->LOCALIZA("Sara").'<br>';
		$probarMemoria->imprimeLista();
		echo '<br>'."Vacia? " . $probarMemoria->VACIA(). " FIN:".$probarMemoria->FIN();
		echo '<br>'."Recupera " . $probarMemoria->RECUPERA($probarMemoria->ANTERIOR($probarMemoria->FIN()));
		echo '<br>'."Vacia? " . $probarMemoria->PRIMERO(). " Localiza:".$probarMemoria->LOCALIZA("Pedro").'<br>';
		echo '<br>'."<<<<";
		$probarMemoria->imprimeLista();
		$probarMemoria->SUPRIME($probarMemoria->FIN());
		echo '<br>'."<<<<";
		$probarMemoria->imprimeLista();
		echo '<br>'."Vacia? " . $probarMemoria->VACIA(). " FIN:".$probarMemoria->FIN();
		echo '<br>'."Vacia? " . $probarMemoria->PRIMERO(). " Localiza:".$probarMemoria->LOCALIZA("Sara")."\n".'<br>';
?>
</body>
</html>