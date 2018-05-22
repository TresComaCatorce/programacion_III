<?php

require_once "AccesoDatos.php";

class Localidad
{
    private $nombre;
    private $provincia;
    private $estado; //"abierto" o "cerrado".


    //Metodo generico para manejar la sobrecarga de los constructores.
    public function Localidad()
    {
        //Obtengo un array con los parámetros enviados a la funcion.
        $params = func_get_args();
        
		//Saco el numero de parametros que estoy recibiendo.
        $num_params = func_num_args();
        
		//Cada constructor de un número dado de parámtros tendrá un nombre de función
		//Atendiendo al siguiente modelo Localidad0() Localidad3()
		$funcion_constructor ='Localidad'.$num_params;
        if (method_exists($this,$funcion_constructor))
        {
			call_user_func_array(array($this,$funcion_constructor),$params);
		}
    }

    //Constructor sin parametros.
    public function Localidad0()
    {
    }

    //Constructor con 3 parametros.
    public function Localidad3($nombre, $provincia, $estado)
    {
        $this->nombre = $nombre;
        $this->provincia = $provincia;
        $this->estado = $estado;
    }



    //Funcion que guarda la localidad en la DB.
    public function GuardarLocalidad()
    {
        //Creo la conexion a la DB.
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();

        //Creo la consulta INSERT.
        $consulta = $objetoAccesoDato->RetornarConsulta("INSERT into localidad (nombre,provincia,estado)values('$this->nombre','$this->provincia','$this->estado')");

        //Ejecuto la consulta.
        $consulta->execute();

        //Guardo su ID.
        $this->id = $objetoAccesoDato->RetornarUltimoIdInsertado();

        //Retorno
        return $this->id;
    }

    //Lee el archivo y devuelve las localidades en un array.
    public static function LeerTodasLasLocalidades()
    {
        //Creo la conexion a la DB.
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        
        //Creo la consulta SELECT * FROM.
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * FROM localidad");

        //Ejecuto la consulta.
        $consulta->execute();

        //Retorno
        return $consulta->fetchAll();
    }

    //Consulta la lista de localidades por nombre y provincia.
    public static function ConsultarPorNombreYProvincia( $nombre, $provincia )
    {
        $retorno = NULL;

        $hay = array();
        $hayNombre = FALSE;
        $hayProvincia = FALSE;

        //Leo el archivo guardado.
        $listado = Localidad::LeerTodasLasLocalidades();

        //var_dump($listado);

        //Recorro el listado.
        foreach( $listado as $key=>$localidad )
        {
            //Comparo nombre y provincia.
            if( $localidad["nombre"]==$nombre && $localidad["provincia"]==$provincia )
            {
                $hay = TRUE;
                $retorno[] = $localidad;
            }

            //Comparo nombre solo.
            if( $localidad["nombre"] == $nombre )
            {
                $hayNombre = TRUE;
            }

            //Comparo provincia solo.
            if( $localidad["provincia"] == $provincia )
            {
                $hayProvincia = TRUE;
            }
        }

        
        if( !$hay )
        {
            if( $hayNombre )
            {
                echo "Hay localidad/es con en el nombre ".$nombre." pero no de la provincia ".$provincia.".\r\n";
            }
            else
            {
                if( $hayProvincia )
                {
                    echo "Hay localidad/es de la provincia ".$provincia." pero no con el nombre ".$nombre.".\r\n";
                }
                else
                {
                    echo "No hay localidad/es de esa provincia ni con ese nombre.\r\n";
                }
            }
        }

        return $retorno;
       
    }
}
?>