<?php
require_once ("Entidades/alumno.php");
require_once ("Entidades/archivo.php");

//var_dump($_REQUEST);
//var_dump($_GET);
//var_dump($_POST);
//var_dump($_FILES);



//var_dump($action);

if( $_POST )
{
	$action = isset($_POST['action']) ? $_POST['action'] : NULL;

	switch($action)
	{
		case "UPLOAD":

			$respuestaDeSubir = Archivo::Subir();

			if(!$respuestaDeSubir["Exito"]){
				echo "error " .$respuestaDeSubir["Mensaje"];
				break;
			}
			$archivo = $respuestaDeSubir["PathTemporal"];
			echo "Bien " ;
			/*
			$codBarra = isset($_POST['codBarra']) ? $_POST['codBarra'] : NULL;
			$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : NULL;
			$archivo = $res["PathTemporal"];

		//	$p = new Producto($codBarra, $nombre, $archivo);
			
			$p = new Producto(666, "Jamon del diablo",$archivo );

			if(!Producto::Guardar($p)){
				echo "Error al generar archivo";
				break;
			}
		*/

		
			
			break;
			
		case "eliminar":
			$codBarra = isset($_POST['codBarra']) ? $_POST['codBarra'] : NULL;
		
			if(!Producto::Eliminar($codBarra)){
				$mensaje = "Lamentablemente ocurrio un error y no se pudo escribir en el archivo.";
			}
			else{
				$mensaje = "El archivo fue escrito correctamente. PRODUCTO eliminado CORRECTAMENTE!!!";
			}
		
			echo $mensaje;
			
			break;
			
		default:
			echo "Error, habilitame el action bigotudo";
	}
}
else if($_GET)
{
	//Hago el listado.
}
?>