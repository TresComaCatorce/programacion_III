<?php
    
    require_once "Empleado.php";

    //Creo el empleado con los datos recibidos.
    $empleado = new Empleado($_GET["nombre"], $_GET["tipo"], $_GET["turno"]);

    //Guardo los datos.
    if( $empleado != NULL )
    {
        $empleado->GuardarEmpleado();
    }
?>