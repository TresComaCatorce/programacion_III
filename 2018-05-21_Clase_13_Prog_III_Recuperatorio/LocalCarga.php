<?php
    
    require_once "Local.php";

    //Creo el local con los datos recibidos.
    $local = new Local($_GET["direccion"], $_GET["idLocalidad"], $_GET["estado"]);

    //Guardo los datos.
    if( $local != NULL )
    {
        $local->GuardarLocal();
    }
?>