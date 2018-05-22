<?php
    
    require_once "Cliente.php";

    //Creo el cliente con los datos recibidos.
    $cliente = new Cliente($_GET["nombre"], $_GET["nacionalidad"], $_GET["sexo"], $_GET["edad"]);

    //Guardo los datos.
    if( $cliente != NULL )
    {
        if( $cliente->sexo=="m" || $cliente->sexo=="f" )
        {
            $cliente->GuardarCliente();
        }
        else
        {
            echo "El sexo debe ser 'f' o 'm'.";
        }
    }
    else
    {
        echo "Debe ingresar datos.";
    }
?>