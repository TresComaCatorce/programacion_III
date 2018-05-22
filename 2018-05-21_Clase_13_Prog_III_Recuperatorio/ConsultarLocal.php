<?php

    require_once "Local.php";

    $Locales = Local::ConsultarPorLocalidadYTipo( $_POST["idLocalidad"], $_POST["estado"] );

    if( $Locales != NULL )
    {
        var_dump( $Locales );
    }

?>