<?php
    require_once "AccesoDatos.php";
    
    class Helado
    {
        public $sabor;
        public $precio;
        public $tipo;
        public $cantidad;

        //Constructor.
        public function Helado( $sabor, $precio, $tipo, $cantidad )
        {
            if( $sabor !== NULL && $tipo !== NULL)
            {
                $this->sabor = $sabor;
                $this->precio = $precio;
                $this->tipo = $tipo;
                $this->cantidad = $cantidad;
            }
        }

        //Funcion que guarda el helado en la DB.
        public function GuardarHelado()
        {
            //Creo la conexion a la DB.
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();

            //Creo la consulta INSERT.
            $consulta = $objetoAccesoDato->RetornarConsulta("INSERT into helados (sabor,precio,tipo,cantidad)values('$this->sabor','$this->precio','$this->tipo','$this->cantidad')");

            //Ejecuto la consulta.
            $consulta->execute();

            //Retorno
            return $objetoAccesoDato->RetornarUltimoIdInsertado();
        }

        //Lee el archivo y devuelve los helados guardados en un array.
        public static function LeerTodosLosHelados()
        {
            //Creo la conexion a la DB.
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
            
            //Creo la consulta SELECT * FROM.
            $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * FROM helados");

            //Ejecuto la consulta.
            $consulta->execute();

            //Retorno
            return $consulta->fetchAll();
        }

        //Devuelve 0 si no hay stock.
        //Devuelve la cantidad si hay stock.
        //Devuelve -1 si el helado no existe.
        public static function HayStock( $idHelado )
        {
            $retorno = -1;

            //Creo la conexion a la DB.
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
            
            //Creo la consulta SELECT * FROM.
            $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * FROM helados WHERE id_helado='".$idHelado."'");

            //Ejecuto la consulta.
            $consulta->execute();

            //Retorno
            $elHelado = $consulta->fetchAll();

            if( count($elHelado) == 0 )
            {
                $retorno = -1;
            }
            else if( count($elHelado) >= 1 )
            {
                $retorno = $elHelado[0]["cantidad"];
            }

            return $retorno;
        }

        //Consulta la lista de helados.
        public static function ConsultarPorSaborYTipo( $sabor, $tipo )
        {
            $retorno = NULL;

            $hay = FALSE;
            $haySaborSolo = FALSE;
            $hayTipoSolo = FALSE;

            //Leo el archivo guardado.
            $listado = Helado::LeerTodosLosHelados();

            //var_dump($listado);

            //Recorro el listado.
            foreach( $listado as $key=>$helado )
            {
                //Comparo sabor y tipo.
                if( $helado["tipo"]==$tipo && $helado["sabor"]==$sabor )
                {
                    $hay = TRUE;
                    $retorno = $helado;
                    $retorno[] = $key;
                    break;
                }

                //Comparo sabor solo.
                if( $helado["sabor"] == $sabor )
                {
                    $haySaborSolo = TRUE;
                }

                //Comparo tipo solo.
                if( $helado["tipo"] == $tipo )
                {
                    $hayTipoSolo = TRUE;
                }
            }

            //
            if( $hay )
            {
                echo "Si hay ese sabor y gusto\r\n";
            }
            else
            {
                if( $haySaborSolo )
                {
                    echo "Hay helado del sabor ".$sabor." pero no del tipo ".$tipo."\r\n";
                }
                else
                {
                    if( $hayTipoSolo )
                    {
                        echo "Hay helado del tipo ".$tipo." pero no del sabor ".$sabor."\r\n";
                    }
                    else
                    {
                        echo "No hay ese sabor ni ese tipo\r\n";
                    }
                }
            }

            return $retorno;
           
        }
    }
?>