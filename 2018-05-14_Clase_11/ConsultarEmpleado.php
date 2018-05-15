<?php

    require_once "Empleado.php";

    $resultadoBusqueda = Empleado::BuscarEmpleadoPorTurnoYTipo( $_POST["turno"], $_POST["tipo"] );

    foreach( $resultadoBusqueda as $xx )
    {
        echo gettype($xx);
        echo "\n";
    }

    var_dump( $resultadoBusqueda );

?>