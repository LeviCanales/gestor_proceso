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
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<style>
	.cuadro-transparente{
        background-color: rgba(0,0,0,0.5);
        border: 1px; border-color: #ffffff;
        border-style: solid;
        padding: 20px;
        margin: 20px;
        font-family:'Orbitron', sans-serif;
      }
      .highlight {
      	color: black;
      	background-color:red;
      	padding-left:
      	20px; padding-right: 20px;
      }
      .gigante {
        font-size: 40px;
		}
	</style>
	<title>Simulador Procesos</title>
</head>
<body style="color:#ffffff;background-image: url(img/thumb-1920-593483.jpg);background-size: cover;background-attachment: fixed; font-size: 20px">
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
		echo "<div class='grid'>";
		for ($i=0; $i < sizeof($proceso); $i++) {
			echo '<div class="grid-item cuadro-transparente">';
			echo $i.': '.$proceso[$i].'<br>';
			$dato = explode("/", $proceso[$i]);
			for ($j=0; $j < sizeof($dato); $j++) { 
				echo "* ".$j.': '.$dato[$j].' is_numeric(): '.((is_numeric($dato[$j]))?'True':'False').' son 6?: '.((sizeof($dato)==6)?'True':'False').'<br>';
			}
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
<script src="js/bootstrap.min.js"></script>
<script src="js/masonry.pkgd.min.js"></script>
<script src="js/imagesloaded.pkgd.min.js"></script>
<script>
var $grid = $('.grid').imagesLoaded( function() {
  // init Masonry after all images have loaded
  $grid.masonry({
    columnWidth: 40
  });
});
$grid.on( 'click', '.grid-item', function() {
  $(this).toggleClass('gigante');
  // trigger layout after item size changes
  $grid.masonry('layout');
});
$('.grid').highlight('False');
</script>
</body>
</html>