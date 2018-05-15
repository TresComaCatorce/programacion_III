<?php
    
    require_once "Helado.php";

    Helado::Vender( $_POST["email"], $_POST["sabor"], $_POST["tipo"], $_POST["cantidad"] );
    
?>