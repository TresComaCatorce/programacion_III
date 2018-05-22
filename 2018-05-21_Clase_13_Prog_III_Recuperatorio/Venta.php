<?php

require_once "AccesoDatos.php";
require_once "Helado.php";

class Venta
{
    public $idLocal;
    public $idUsuario;
    public $idEmpleado;
    public $idHelado;
    public $fecha;
    public $sabor;
    public $tipo;
    public $cantidad;



    //Constructor.
    public function Venta( $idLocal, $idUsuario, $idEmpleado, $idHelado, $fecha, $sabor, $tipo, $cantidad )
    {
        if( $idLocal !== NULL && $idUsuario !== NULL)
        {
            $this->idLocal = $idLocal;
            $this->idUsuario = $idUsuario;
            $this->idEmpleado = $idEmpleado;
            $this->idHelado = $idHelado;
            $this->fecha = $fecha;
            $this->sabor = $sabor;
            $this->tipo = $tipo;
            $this->cantidad = $cantidad;
        }
    }



    //Funcion que guarda la venta en la DB.
    public function Vender()
    {
        //Traigo el helado.
        $elHelado = Helado::HayStock( $this->idHelado );

        var_dump($elHelado);

        if( $elHelado == -1 )
        {
            echo "El atributo idHelado es incorrecto.";
        }
        else if( $elHelado == 0 )
        {
            echo "No hay stock de ese producto.";
        }
        else if( $elHelado > 0 )
        {
            //Creo la conexion a la DB.
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
    
            //Creo la consulta INSERT.
            $consulta = $objetoAccesoDato->RetornarConsulta("INSERT into venta (idLocal,idUsuario,idEmpleado,idHelado,fecha,sabor,tipo,cantidad)values('$this->idLocal','$this->idUsuario','$this->idEmpleado','$this->idHelado','$this->fecha','$this->sabor','$this->tipo','$this->cantidad')");
            
            //Ejecuto la consulta.
            $consulta->execute();

            return NULL;
        }


        


        //Guardo su ID.
        //$this->id = $objetoAccesoDato->RetornarUltimoIdInsertado();

        //Retorno
       
    }

    /*
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
       
    }*/
}
?>