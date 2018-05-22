<?php

require_once "AccesoDatos.php";

class Local
{
    private $direccion;
    private $idLocalidad;
    private $estado; //"abierto" o "cerrado".


    //Metodo generico para manejar la sobrecarga de los constructores.
    public function Local()
    {
        //Obtengo un array con los parámetros enviados a la funcion.
        $params = func_get_args();
        
		//Saco el numero de parametros que estoy recibiendo.
        $num_params = func_num_args();
        
		//Cada constructor de un número dado de parámtros tendrá un nombre de función
		//Atendiendo al siguiente modelo Local0() Local3()
		$funcion_constructor ='Local'.$num_params;
        if (method_exists($this,$funcion_constructor))
        {
			call_user_func_array(array($this,$funcion_constructor),$params);
		}
    }

    //Constructor sin parametros.
    public function Local0()
    {
    }

    //Constructor con 3 parametros.
    public function Local3($direccion, $idLocalidad, $estado)
    {
        $this->direccion = $direccion;
        $this->idLocalidad = $idLocalidad;
        $this->estado = $estado;
    }



    //Funcion que guarda el local en la DB.
    public function GuardarLocal()
    {
        //Creo la conexion a la DB.
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();

        //Creo la consulta INSERT.
        $consulta = $objetoAccesoDato->RetornarConsulta("INSERT into local (dirección,idLocalidad,estado)values('$this->direccion','$this->idLocalidad','$this->estado')");

        //Ejecuto la consulta.
        $consulta->execute();

        //Guardo su ID.
        $this->id = $objetoAccesoDato->RetornarUltimoIdInsertado();

        //Retorno
        return $this->id;
    }

    //Lee el archivo y devuelve los locales guardados en un array.
    public static function LeerTodosLosLocales()
    {
        //Creo la conexion a la DB.
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        
        //Creo la consulta SELECT * FROM.
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * FROM local");

        //Ejecuto la consulta.
        $consulta->execute();

        //Retorno
        return $consulta->fetchAll();
    }

    //Consulta la lista de locales por idLocalidad y estado.
    public static function ConsultarPorLocalidadYTipo( $idLocalidad, $estado )
    {
        $retorno = NULL;

        $hay = array();
        $hayIdLocalidad = FALSE;
        $hayEstado = FALSE;

        //Leo los datos guardados.
        $listado = Local::LeerTodosLosLocales();

        //var_dump($listado);

        //Recorro el listado.
        foreach( $listado as $key=>$local )
        {
            //Comparo idLocalidad y estado.
            if( $local["idLocalidad"]==$idLocalidad && $local["estado"]==$estado )
            {
                $hay = TRUE;
                $retorno[] = $local;
            }

            //Comparo idLocalidad solo.
            if( $local["idLocalidad"] == $idLocalidad )
            {
                $hayIdLocalidad = TRUE;
            }

            //Comparo estado solo.
            if( $local["estado"] == $estado )
            {
                $hayEstado = TRUE;
            }
        }

        
        if( !$hay )
        {
            if( $hayIdLocalidad )
            {
                echo "Hay local/es en la localidad ".$idLocalidad." pero no en el estado ".$estado.".\r\n";
            }
            else
            {
                if( $hayEstado )
                {
                    echo "Hay local/es en el estado ".$estado." pero no en la localidad ".$idLocalidad.".\r\n";
                }
                else
                {
                    echo "No hay local/es en ese estado ni en esa localidad.\r\n";
                }
            }
        }

        return $retorno;
       
    }
}
?>