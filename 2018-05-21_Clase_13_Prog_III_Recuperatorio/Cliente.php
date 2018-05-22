<?php
    require_once "AccesoDatos.php";
    
    class Cliente
    {
        public $nombre;
        public $nacionalidad;
        public $sexo;
        public $edad;

        //Constructor.
        public function Cliente( $nombre, $nacionalidad, $sexo, $edad )
        {
            $this->nombre = $nombre;
            $this->nacionalidad = $nacionalidad;
            $this->sexo = $sexo;
            $this->edad = $edad;
        }

        //Funcion que guarda el helado en el archivo.
        public function GuardarCliente()
        {
            //Creo la conexion a la DB.
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();

            //Creo la consulta INSERT.
            $consulta = $objetoAccesoDato->RetornarConsulta("INSERT into clientes (nombre,nacionalidad,sexo,edad)values('$this->nombre','$this->nacionalidad','$this->sexo','$this->edad')");

            //Ejecuto la consulta.
            $consulta->execute();

            //Retorno
            return $objetoAccesoDato->RetornarUltimoIdInsertado();
        }

        //Lee el archivo y devuelve los clientes guardados en un array.
        public static function LeerTodosLosClientes()
        {
            //Creo la conexion a la DB.
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
            
            //Creo la consulta SELECT * FROM.
            $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * FROM clientes");

            //Ejecuto la consulta.
            $consulta->execute();

            //Retorno
            return $consulta->fetchAll();
        }

        //Consulta la lista de clientes por nacionalidad y sexo.
        public static function ConsultarPorNacYSexo( $nacionalidad, $sexo )
        {
            $retorno = NULL;

            $hay = FALSE;
            $hayNacionalidad = FALSE;
            $haySexo = FALSE;

            //Leo el archivo guardado.
            $listado = Cliente::LeerTodosLosClientes();

            //var_dump($listado);

            //Recorro el listado.
            foreach( $listado as $key=>$cliente )
            {
                //Comparo nacionalidad y sexo.
                if( $cliente["nacionalidad"]==$nacionalidad && $cliente["sexo"]==$sexo )
                {
                    $hay = TRUE;
                    break;
                }

                //Comparo nacionalidad sola.
                if( $cliente["nacionalidad"] == $nacionalidad )
                {
                    $hayNacionalidad = TRUE;
                }

                //Comparo sexo solo.
                if( $cliente["sexo"] == $sexo )
                {
                    $haySexo = TRUE;
                }
            }

            
            if( $hay )
            {
                $retorno = $listado;
            }
            else
            {
                if( $hayNacionalidad )
                {
                    echo "Hay cliente/s de nacionalidad ".$nacionalidad." pero no de sexo ".$sexo.".\r\n";
                }
                else
                {
                    if( $haySexo )
                    {
                        echo "Hay cliente/s de sexo ".$sexo." pero no de nacionalidad ".$nacionalidad.".\r\n";
                    }
                    else
                    {
                        echo "No hay clientes de esa nacionalidad ni ese sexo.\r\n";
                    }
                }
            }

            return $retorno;
           
        }
    }
?>