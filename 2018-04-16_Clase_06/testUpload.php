<?php

//var_dump($_POST);
//var_dump($_FILES);


//Solicitud con un atributo de nombre "file" del tipo archivo.$_COOKIE
$destino = "archivos/".$_FILES["file"]["name"];
//echo $destino;


//---------------------------------------------------------------------------------------------------
// FUNCION: move_uploaded_file( stmp , dest );
//
// Mueve los archivos que fueron subidos al servidor, desde el temporal a la ruta destino indicada.
// No crea la carpeta destino en caso de no existir.
//
// @param <stmp> Ruta del temporal.
// @param <dest> Ruta destino.
//
// @return Caso fallido retorna 0, caso exitoso 1. ( True / False ?? )
//---------------------------------------------------------------------------------------------------
move_uploaded_file( $_FILES["file"]["tmp_name"] , $destino );

//Separo el nombre del archivo en el punto (.)
$arrayNombre = explode( ".", $destino);

var_dump( $arrayNombre );

//---------------------------------------------------------------------------------------------------
// FUNCION pathinfo( path, const )
//
// Devuelve informacion de un archivo o directorio.
// La informacion que devuelve depende de la constante enviada.
//
// @param <path> Ruta del directorio o archivo.
// @param <const> Constante para seleccionar el dato a recibir. Del tipo PATHINFO_*
//
// @return Informacion de la ruta.
//---------------------------------------------------------------------------------------------------
$tipoArchivo = pathinfo( $destino , PATHINFO_EXTENSION );

var_dump( $tipoArchivo );

?>