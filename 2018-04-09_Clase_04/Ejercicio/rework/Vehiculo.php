<?php
	class Vehiculo
	{
		private $Patente;
		private $HoraIngreso;
		
		public function Vehiculo( $patente, $horaIngreso )
		{
			$this->Patente = $patente;
			$this->HoraIngreso = $horaIngreso;
		}
		
		public function Estacionar( $patente )
		{
			$archivo=fopen("archivos/estacionados.txt", "a");//escribe y mantiene la informacion existente		
			$ahora=date("Y-m-d H:i:s"); 
			$renglon=$patente."=>".$ahora."\n";
			fwrite($archivo, $renglon); 		 
			fclose($archivo);
		}
		
		public function GetPatente()
		{
			return $this->Patente;
		}
		
		public function Sacar ( $patente )
		{
			$listado = $this->Leer();
			$ListadoAdentro = array();
			$estaElVehiculo = false;
			$importe = 0;
			foreach( $listado as $auto ) 
			{
				if( $auto[0] == $patente )
				{
					$estaElVehiculo = true;
					$inicio = $auto[1];	
					$ahora = date("Y-m-d H:i:s"); 			 
					$diferencia = strtotime($ahora)- strtotime($inicio) ;
					//http://www.w3schools.com/php/func_date_strtotime.asp
					$importe = $diferencia*15;
					$mensaje = "tiempo transcurrido:".$diferencia." segundos <br> costo $importe ";
					
					$archivo = fopen("archivos/facturacion.txt", "a"); 		  
					$dato = $patente ."=> $".$importe."\n" ;
					fwrite( $archivo, $dato );
					fclose( $archivo );
				}
				else
				{
					$ListadoAdentro[]=$auto;				
				}

			if(!$estaElVehiculo)
			{
				$mensaje= "no esta esa patente!!!";
			}


			return$ListadoAdentro);


			echo $mensaje;
		}
		
		public function Leer()
		{
			$ListaDeAutosLeida=   array();
			$archivo = fopen("archivos/estacionados.txt", "r");//escribe y mantiene la informacion existente

				
			while( !feof($archivo) )
			{
				$renglon=fgets($archivo);
				//http://www.w3schools.com/php/func_filesystem_fgets.asp
				$auto=explode("=>", $renglon);
				//http://www.w3schools.com/php/func_string_explode.asp
				$auto[0]=trim($auto[0]);
				if($auto[0]!="")
					$ListaDeAutosLeida[]=$auto;
			}

			fclose($archivo);
			return $ListaDeAutosLeida;
		}
		
	}
?>