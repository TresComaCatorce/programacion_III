<?php

    require_once "Empleado.php";

    $Empleados = Empleado::ConsultarPorTurnoYTipo( $_POST["turno"], $_POST["tipo"] );

    if( $Empleados != NULL )
    {
        var_dump( $Empleados );
    }

?>