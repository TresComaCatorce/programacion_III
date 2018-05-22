<?php
    
    require_once "Venta.php";
   

    $venta = new Venta($_POST["idLocal"], $_POST["idUsuario"], $_POST["idEmpleado"], $_POST["idHelado"], $_POST["fecha"], $_POST["sabor"], $_POST["tipo"], $_POST["cantidad"]);

    $venta->Vender( );
    
?>