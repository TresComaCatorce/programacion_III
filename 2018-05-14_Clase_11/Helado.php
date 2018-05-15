<?php
    require_once "AccesoDatos.php";
    
    class Helado
    {
        private $sabor;
        private $precio;
        private $tipo;
        private $cantidad;

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

        //Funcion que guarda el helado en el archivo.
        public function GuardarHelado()
        {
            //Creo la conexion a la DB.
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();

            //Creo la consulta INSERT.
            $consulta = $objetoAccesoDato->RetornarConsulta("INSERT into helado (sabor,precio,tipo,cantidad)values('$this->sabor','$this->precio','$this->tipo','$this->cantidad')");

            //Ejecuto la consulta.
            $consulta->execute();

            //Retorno
            return $objetoAccesoDato->RetornarUltimoIdInsertado();
        }

        //Lee el archivo y devuelve los helados guardados en un array.
        public static function LeerArchivo( )
        {
            //Creo la conexion a la DB.
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
            
            //Creo la consulta INSERT.
            $consulta = $objetoAccesoDato->RetornarConsulta("INSERT into helado (sabor,precio,tipo,cantidad)values('$this->sabor','$this->precio','$this->tipo','$this->cantidad')");

            //Ejecuto la consulta.
            $consulta->execute();

            //Retorno
            return $objetoAccesoDato->RetornarUltimoIdInsertado();
        }

        //Consulta la lista de helados.
        public static function Consultar( $sabor, $tipo )
        {
            $retorno = NULL;

            $hay = FALSE;
            $haySaborSolo = FALSE;
            $hayTipoSolo = FALSE;

            //Leo el archivo guardado.
            $listado = Helado::LeerArchivo();

            //Recorro el listado.
            foreach( $listado as $key=>$helado )
            {
                //Comparo sabor y tipo.
                if( strcmp( $sabor, $helado[0])==0 && strcmp( $tipo, $helado[1] )==0)
                {
                    $hay = TRUE;
                    $retorno = $helado;
                    $retorno[] = $key;
                    break;
                }

                //Comparo sabor solo.
                if( strcmp( $sabor, $helado[0])==0 )
                {
                    $haySaborSolo = TRUE;
                }

                //Comparo tipo solo.
                if( strcmp( $tipo, $helado[1] )==0 )
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

        //Realiza una venta.
        public static function Vender( $email, $sabor, $tipo, $cantidad )
        {
            $consulta = Helado::Consultar($sabor,$tipo);

            if( $consulta!=NULL )
            {
                if( $consulta[3] >= $cantidad )
                {
                    //Guardo el archivo VENTAS.TXT
                    $myFile = fopen("Venta.txt", "a");
                    $stringAGuardar = $email.  " - "  .$sabor. " - " .$tipo. " - " .$cantidad. "\r\n";
                    $cant = fwrite( $myFile, $stringAGuardar);
                    //FIN Guardo el archivo VENTAS.TXT

                    

                }
                else
                {
                    echo "No hay stock suficiente";
                }
            }
        }
    }
?>