<?php
if (isset($_FILES["file"]))
{
    $file = $_FILES["file"];
    $tipo = $file["type"];
    $ruta_provisional = $file["tmp_name"];
        move_uploaded_file($ruta_provisional, "data/procesos.txt");
        echo "<span class='negrito'><a href='/'>esto</a>";
}else{
    echo "No hay archivo";
}
?>