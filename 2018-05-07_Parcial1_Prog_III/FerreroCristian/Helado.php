<?php
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
            $retorno = FALSE;

            //Creo o abro el archivo.
            $myFile = fopen("Helados.txt", "a");

            //Creo el string del helado a guardar.
            $stringAGuardar = $this->sabor.  " - "  .$this->tipo. " - " .$this->precio. " - " .$this->cantidad. "\r\n";

            //Escribo el archivo.
            $cant = fwrite( $myFile, $stringAGuardar);

            if($cant > 0)
            {
                $retorno = TRUE;			
            }

            //Cierro el archivo.
            fclose($myFile);
            
            return TRUE;
        }

        //Lee el archivo y devuelve los helados guardados en un array.
        public static function LeerArchivo( )
        {
            $ListaLeida = array();

            //Abro el listado.
            $archivo = fopen("Helados.txt", "r");
            
            //Leo el archivo.
            while(!feof($archivo))
            {
                $renglon = fgets($archivo);

                $helado = explode(" - ", $renglon);

                $helado[0] = trim($helado[0]);
                if($helado[0] != "")
                {
                    $ListaLeida[] = $helado;
                }
            }
    
            //Cierro el archivo.
            fclose($archivo);

            return $ListaLeida;
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