<?php

require('Direccion.php');

class Persona implements IMostrable
{
	private $nombre;
	private $apellido;
	private $dni;

	public function Persona( $nombre, $apellido, $dni)
	{
		$this->nombre = $nombre;
		$this->apellido = $apellido;
		$this->dni = $dni;
	}

	//Getters & Setters.
	public function getNombre ()
	{
		return $this->nombre;
	}

	public function setNombre ($nombre)
	{
		$this->nombre = $nombre;
	}

	public function getApellido ()
	{
		return $this->apellido;
	}

	public function setApellido ($apellido)
	{
		$this->apellido = $apellido;
	}

	public function getDni()
	{
		return $this->dni;
	}

	public function setDni($dni)
	{
		$this->dni = $dni;
	}

	public function MostrarHTML()
	{
		echo "Apellido: getApellido()<br>Nombre: getNombre()<br>DNI N&deg;: getDni()<br>";
	}
}

?>
