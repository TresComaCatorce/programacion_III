<?php
    
    require_once "Helado.php";

    //Creo el helado con los datos recibidos.
    $helado = new Helado($_GET["sabor"], $_GET["precio"], $_GET["tipo"], $_GET["cantidad"]);

    //Guardo los datos.
    if( $helado != NULL )
    {
        if( $helado->tipo=="crema" || $helado->tipo=="agua" )
        {
            $helado->GuardarHelado();
        }
        else
        {
            echo "El tipo debe ser 'crema' o 'agua'.";
        }
    }
    else
    {
        echo "Debe ingresar datos.";
    }
?>