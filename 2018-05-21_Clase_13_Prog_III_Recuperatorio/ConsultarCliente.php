<?php

    require_once "Cliente.php";

    $clientes = Cliente::ConsultarPorNacYSexo( $_POST["nacionalidad"], $_POST["sexo"] );

    if( $clientes != NULL )
    {
        var_dump( $clientes );
    }

?>