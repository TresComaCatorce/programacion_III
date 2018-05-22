<?php
    
    require_once "Localidad.php";

    //Creo la Localidad con los datos recibidos.
    $localidad = new Localidad($_GET["nombre"], $_GET["provincia"], $_GET["estado"]);

    //Guardo los datos.
    if( $localidad != NULL )
    {
        $localidad->GuardarLocalidad();
    }
?>