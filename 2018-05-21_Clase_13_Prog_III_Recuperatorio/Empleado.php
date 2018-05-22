<?php

require_once "AccesoDatos.php";

class Empleado
{
    private $nombre;
    private $tipo;
    private $turno;
    private $id;



    //Metodo generico para manejar la sobrecarga de los constructores.
    public function Empleado()
    {
        //Obtengo un array con los parámetros enviados a la funcion.
        $params = func_get_args();
        
		//Saco el numero de parametros que estoy recibiendo.
        $num_params = func_num_args();
        
		//Cada constructor de un número dado de parámtros tendrá un nombre de función
		//Atendiendo al siguiente modelo Empleado0() Empleado3()
		$funcion_constructor ='Empleado'.$num_params;
        if (method_exists($this,$funcion_constructor))
        {
			call_user_func_array(array($this,$funcion_constructor),$params);
		}
    }

    //Constructor sin parametros.
    public function Empleado0()
    {
    }

    //Constructor con 3 parametros.
    public function Empleado3($nombre, $tipo, $turno)
    {
        $this->nombre = $nombre;
        $this->tipo = $tipo;
        $this->turno = $turno;
    }



    //Funcion que guarda el empleado en la DB.
    public function GuardarEmpleado()
    {
        //Creo la conexion a la DB.
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();

        //Creo la consulta INSERT.
        $consulta = $objetoAccesoDato->RetornarConsulta("INSERT into empleado (nombre,turno,tipo)values('$this->nombre','$this->turno','$this->tipo')");

        //Ejecuto la consulta.
        $consulta->execute();

        //Guardo su ID.
        $this->id = $objetoAccesoDato->RetornarUltimoIdInsertado();

        //Retorno
        return $this->id;
    }

    //Lee el archivo y devuelve los clientes guardados en un array.
    public static function LeerTodosLosEmpleados()
    {
        //Creo la conexion a la DB.
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        
        //Creo la consulta SELECT * FROM.
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * FROM empleado");

        //Ejecuto la consulta.
        $consulta->execute();

        //Retorno
        return $consulta->fetchAll();
    }

    //Consulta la lista de empleados por turno y tipo.
    public static function ConsultarPorTurnoYTipo( $turno, $tipo )
    {
        $retorno = NULL;

        $hay = array();
        $hayTurno = FALSE;
        $hayTipo = FALSE;

        //Leo el archivo guardado.
        $listado = Empleado::LeerTodosLosEmpleados();

        //var_dump($listado);

        //Recorro el listado.
        foreach( $listado as $key=>$empleado )
        {
            //Comparo turno y tipo.
            if( $empleado["turno"]==$turno && $empleado["tipo"]==$tipo )
            {
                $hay = TRUE;
                $retorno[] = $empleado;
            }

            //Comparo turno solo.
            if( $empleado["turno"] == $turno )
            {
                $hayTurno = TRUE;
            }

            //Comparo tipo solo.
            if( $empleado["tipo"] == $tipo )
            {
                $hayTipo = TRUE;
            }
        }

        
        if( !$hay )
        {
            if( $hayTurno )
            {
                echo "Hay empleado/s en el turno ".$turno." pero no del tipo ".$tipo.".\r\n";
            }
            else
            {
                if( $hayTipo )
                {
                    echo "Hay empleado/s del tipo ".$tipo." pero no en el turno ".$turno.".\r\n";
                }
                else
                {
                    echo "No hay empleado de ese tipo ni en ese turno.\r\n";
                }
            }
        }

        return $retorno;
       
    }
}
?>