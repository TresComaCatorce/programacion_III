<?php

    require_once "Localidad.php";

    $Localidades = Localidad::ConsultarPorNombreYProvincia( $_POST["nombre"], $_POST["provincia"] );

    if( $Localidades != NULL )
    {
        var_dump( $Localidades );
    }

?>