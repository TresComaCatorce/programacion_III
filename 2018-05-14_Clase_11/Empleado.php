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
        $consulta = $objetoAccesoDato->RetornarConsulta("INSERT into empleado (nombre,turno,tipo)values('$this->nombre','$this->tipo','$this->turno')");

        //Ejecuto la consulta.
        $consulta->execute();

        //Guardo su ID.
        $this->id = $objetoAccesoDato->RetornarUltimoIdInsertado();

        //Retorno
        return $this->id;
    }


    
    //Busca los empleados en la DB que tengan un turno y sean de un tipo particular.
    //Los devuelve en un array.
    public static function BuscarEmpleadoPorTurnoYTipo( $turno, $tipo )
    {
        $retorno;

        if( $turno != NULL  && ($tipo=="jefe" || $tipo=="encargado" || $tipo=="novato") )
        {
            //Creo la conexion a la DB.
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
            
            //Creo la consulta.
            $consultaString = "SELECT * FROM empleado WHERE tipo = '".$tipo."' AND turno = '".$turno."'";
            $consulta = $objetoAccesoDato->RetornarConsulta( $consultaString );
    
            //Ejecuto la consulta.
            $consulta->execute();
    
            //Guardo el resultado.
            $resultado = $consulta->fetchAll(PDO::FETCH_CLASS, "Empleado");

            //Si existe un retorno
            if( count($resultado)>0 )
            {
                $retorno = $resultado;
            }

            //Si no existe un retorno.
            else
            {
                $retorno = "No existen resultados para esa consulta. ";
                
                //Verifico si no existen con ese tipo o con ese turno.
                $consultaStringTipo = "SELECT * FROM empleado WHERE tipo = '".$tipo."'";
                $consultaTipo = $objetoAccesoDato->RetornarConsulta($consultaStringTipo);
        
                //Ejecuto la consulta.
                $consultaTipo->execute();
        
                //Guardo el resultado.
                $resultadoTipo = $consultaTipo->fetchAll(PDO::FETCH_CLASS, "Empleado");

                //Si hay de ese tipo => No hay de ese turno
                if( count($resultadoTipo)>0 )
                {
                    $retorno =+ "No hay empleados con ese turno asignado.";
                }

                //Si NO hay de ese tipo
                if( count($resultadoTipo)>0 )
                {
                    $retorno =+ "No hay empleados de ese tipo.";
                }
            }
        }
        else
        {
            $retorno = "Verifique los parametros de busqueda";
        }

        //var_dump ($retorno);

        //Retorno
        return $retorno;
    }
}
?>