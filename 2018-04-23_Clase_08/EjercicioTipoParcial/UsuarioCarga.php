<?php

    //var_dump ($_GET);

    $nombre = $_GET["nombre"];
    $email = $_GET["email"];
    $edad = $_GET["edad"];
    $clave = $_GET["clave"];
    $perfil = $_GET["perfil"];

    //Valido parametro "User".
    if($perfil != "user" || $perfil != "admin" )
    {
        return "Perfil debe ser -admin- o -user-";
    }

    //Creo el objeto file.
    $usuariosTxt = fopen("usuarios.txt", "w") or die("Unable to open file!");

    $usuario = $nombre+"\t"+$email+"\t"+$edad+"\t"+$clave+"\t"+$perfil;

    //Escribo el archivo
    fwrite($usuariosTxt, $usuario);

?>