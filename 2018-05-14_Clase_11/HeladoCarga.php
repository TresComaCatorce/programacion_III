<?php
    
    require_once "Helado.php";

    //Creo el helado con los datos recibidos.
    $helado = new Helado($_GET["Sabor"], $_GET["precio"], $_GET["Tipo"], $_GET["cantidad"]);

    //Guardo los datos.
    if( $helado != NULL )
        $helado->GuardarHelado();
?>